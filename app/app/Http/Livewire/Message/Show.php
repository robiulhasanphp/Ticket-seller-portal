<?php

declare(strict_types=1);

namespace App\Http\Livewire\Message;

use App\Models\BrokerConversation;
use App\Models\BrokerMessage;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Message Show Component
 *
 * Manages broker-seller message conversations with search,
 * filtering, and sending capabilities.
 */
class Show extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $closeConversation = false;

    public string $searchPagination = 'no';

    /**
     * @var array<string>
     */
    protected $listeners = ['getConversationByType'];

    /**
     * Render the message conversations view.
     *
     * @return View
     */
    public function render(): View
    {
        $user = Auth::user();
        $conversations = $user?->isAdmin()
            ? $this->getAdminConversations(new BrokerConversation())
            : $this->getSellerConversations(new BrokerConversation());

        return view('livewire.message.show', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * Get admin conversations with optional search filtering.
     *
     * @param BrokerConversation $brokerConversation
     * @return Paginator|Collection
     */
    private function getAdminConversations(BrokerConversation $brokerConversation)
    {
        $query = $brokerConversation
            ->with('seller')
            ->orderBy('updated_at', 'DESC');

        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';

            return $query
                ->where('sale_id', 'like', $searchTerm)
                ->orWhereHas('sale.detail.ticket.event.performer', function ($performer) use ($searchTerm) {
                    $performer->where('PERF_name', 'like', $searchTerm)
                        ->orderBy('PERF_name');
                })
                ->get();
        }

        $this->searchPagination = 'yes';
        return $query->paginate(20);
    }

    /**
     * Get seller conversations with optional search filtering.
     *
     * @param BrokerConversation $brokerConversation
     * @return Paginator|Collection
     */
    private function getSellerConversations(BrokerConversation $brokerConversation): Paginator|Collection
    {
        $userId = Auth::user()?->id;
        $query = $brokerConversation
            ->whereSellerId($userId)
            ->orderBy('updated_at', 'DESC');

        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';

            return $query
                ->where('sale_id', 'like', $searchTerm)
                ->orWhereHas('sale.detail.ticket.event.performer', function ($performer) use ($searchTerm) {
                    $performer->where('PERF_name', 'like', $searchTerm)
                        ->orderBy('PERF_name');
                })
                ->get();
        }

        $this->searchPagination = 'yes';
        return $query->paginate(20);
    }

    /**
     * Filter conversations by type (open/closed).
     *
     * @param string $conversationType The type of conversation ('open' or 'closed')
     * @return View
     */
    public function getConversationByType(string $conversationType): View
    {
        $user = Auth::user();
        $isAdmin = $user?->isAdmin();
        $baseQuery = match ($conversationType) {
            'open' => BrokerConversation::where('closed', 0),
            default => BrokerConversation::query(),
        };

        if (!$isAdmin) {
            $baseQuery->whereSellerId($user->id);
        }

        if ($isAdmin) {
            $conversations = $baseQuery->with('seller')->orderBy('updated_at', 'DESC')->paginate(20);
        } else {
            $conversations = $baseQuery->orderBy('updated_at', 'DESC')->paginate(20);
        }

        return view('livewire.message.show', [
            'conversation_types' => $conversationType,
            'conversations' => $conversations,
        ]);
    }

    /**
     * Load and display a specific conversation by ID.
     *
     * Marks messages as read if required and formats conversation data.
     *
     * @param int $conversationId The conversation ID
     * @param string $isUnread Whether messages are unread ('true' or 'false')
     * @return void
     */
    public function getConversationByID(int $conversationId, string $isUnread): void
    {
        if ($isUnread === 'true') {
            (new BrokerConversation())->setConversationAsRead($conversationId);
        }

        $messages = (new BrokerMessage())->getConversationByID($conversationId);
        $formattedData = [];
        $user = Auth::user();

        foreach ($messages as $message) {
            $messageType = $this->determineMessageType($message, $user);
            $authorName = $this->determineAuthorName($message, $user);

            $formattedData[] = [
                'user_type' => $user?->isAdmin() ? 'admin' : 'seller',
                'message_id' => $conversationId,
                'author_name' => $authorName,
                'message_type' => $messageType,
                'message' => $message->message,
                'created_at_formatted' => $message->created_at_formatted,
            ];
        }

        $this->conversationById = $formattedData;
    }

    /**
     * Determine the message type (sender or receiver).
     *
     * @param BrokerMessage $message
     * @param User|null $user
     * @return string
     */
    private function determineMessageType(BrokerMessage $message, ?User $user): string
    {
        if ($user?->isAdmin()) {
            return $message->author?->rights?->USAR_type === 'broker' ? 'receiver' : 'sender';
        }

        return $user?->id === $message->sender_id ? 'sender' : 'receiver';
    }

    /**
     * Determine the display name of the message author.
     *
     * @param BrokerMessage $message
     * @param User|null $user
     * @return string
     */
    private function determineAuthorName(BrokerMessage $message, ?User $user): string
    {
        if ($user?->isAdmin()) {
            return $message->author_name;
        }

        return $user?->id === $message->sender_id ? $message->author_name : 'Ticketbande';
    }

    /**
     * Store a new message in the conversation.
     *
     * Handles message storage, conversation status updates, and email notifications.
     *
     * @param array<string, mixed> $request The message data
     * @return void
     */
    public function storeMessage(array $request): void
    {
        $conversationId = $request['message_id'] ?? null;
        $messageContent = $request['message'] ?? '';

        if (!$conversationId || empty($messageContent)) {
            session()->flash('error', 'Ungültige Anfrage.');
            return;
        }

        $conversation = BrokerConversation::with('seller')->find($conversationId);

        if ($conversation === null) {
            session()->flash('error', 'Gespräch nicht gefunden.');
            return;
        }

        // Update conversation closed status
        $conversation->update(['closed' => $this->closeConversation ? 1 : 0]);

        // Create and save new message
        $fieldRead = Auth::user()?->isAdmin() ? 'read_by_admin' : 'read_by_seller';

        $newMessage = new BrokerMessage([
            'sender_id' => Auth::user()->id,
            'message' => $messageContent,
            $fieldRead => true,
        ]);

        $conversation->messages()->save($newMessage);
        $conversation->touch();

        // Send notification email to seller if admin sends message
        if (Auth::user()?->isAdmin()) {
            $this->sendNotificationEmail($conversation, $messageContent);
        }

        session()->flash('success', 'Nachricht erfolgreich gesendet.');
    }

    /**
     * Get count of unread conversations for current user.
     *
     * Filters by user role and status.
     *
     * @return int
     */
    public function getUnreadConversationsCount(): int
    {
        $user = Auth::user();

        if (!$user) {
            return 0;
        }

        // Check user is active
        if ($user->USER_state !== 'active' || str_contains($user->USER_mail, '_blocked')) {
            Auth::logout();
            return 0;
        }

        if ($user->isAdmin()) {
            return BrokerConversation::whereHas('last_message', function ($query) {
                $query->where('read_by_admin', false)
                    ->where('sender_id', '<>', Auth::user()->id)
                    ->whereHas('author.rights', function ($q) {
                        $q->where('USAR_type', 'broker');
                    });
            })->count();
        }

        return BrokerConversation::whereSellerId($user->id)
            ->whereHas('last_message', function ($query) use ($user) {
                $query->where('read_by_seller', false)
                    ->where('sender_id', '<>', $user->id)
                    ->whereHas('author.rights', function ($q) {
                        $q->where('USAR_type', '<>', 'broker');
                    });
            })->count();
    }

    /**
     * Send email notification to seller about new message.
     *
     * @param BrokerConversation $conversation
     * @param string $messageContent
     * @return void
     */
    private function sendNotificationEmail(BrokerConversation $conversation, string $messageContent): void
    {
        $seller = $conversation->seller;

        if ($seller === null || empty($seller->email)) {
            return;
        }

        try {
            Mail::send('email.seller_message', ['bodyMessage' => $messageContent], function ($message) use ($seller) {
                $message->to($seller->email)
                    ->subject('Neue Nachricht im Seller-Portal');
            });
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
    }
}
