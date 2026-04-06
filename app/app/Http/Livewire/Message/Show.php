<?php

namespace App\Http\Livewire\Message;

use App\Models\User;
use App\Models\BrokerConversation;
use App\Models\BrokerMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public string $search = '';
    public $closeConversation;
    public $searchPagination;
    protected $listeners = ['getConversationByType'];

    // Render method for displaying conversations
    public function render()
    {
        $BrokerConversation = new BrokerConversation();
        $status = $BrokerConversation->append(['status', 'open']);

        if (Auth::user()->isAdmin()) {
            $conversations = $this->getAdminConversations($status);
        } else {
            $conversations = $this->getSellerConversations($status);
        }

        return view('livewire.message.show', [
            'conversations' => $conversations,
        ]);
    }

    // Get conversations for admin
    private function getAdminConversations($status)
    {
        if (!empty($this->search)) {
            $searchTerm = $this->search;
            return $status::with('seller')
                ->orderBy('updated_at', 'DESC')
                ->where('sale_id', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('sale.detail.ticket.event.performer', function ($performer) use ($searchTerm) {
                    $performer->where('PERF_name', 'like', '%' . $searchTerm . '%')->orderBy('PERF_name');
                })
                ->get();
        }

        $this->searchPagination = 'yes';
        return $status::with('seller')->orderBy('updated_at', 'DESC')->paginate(20);
    }

    // Get conversations for seller
    private function getSellerConversations($status)
    {
        if (!empty($this->search)) {
            $searchTerm = $this->search;
            return $status::whereSellerId(Auth::user()->id)
                ->orderBy('updated_at', 'DESC')
                ->where('sale_id', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('sale.detail.ticket.event.performer', function ($performer) use ($searchTerm) {
                    $performer->where('PERF_name', 'like', '%' . $searchTerm . '%')->orderBy('PERF_name');
                })
                ->get();
        }

        $this->searchPagination = 'yes';
        return $status::whereSellerId(Auth::user()->id)->orderBy('updated_at', 'DESC')->paginate(20);
    }

    // Get conversations by type
    public function getConversationByType($request)
    {
        $conversationTypes = $this->conversation_types = $request;
        $BrokerConversation = new BrokerConversation();

        if ($request == 'open') {
            $status = $BrokerConversation->append(['status', 'open']);
            $conversations = Auth::user()->isAdmin()
                ? $status::with('seller')->orderBy('updated_at', 'DESC')
                : $status::whereSellerId(Auth::user()->id)->orderBy('updated_at', 'DESC');
        } else {
            $conversations = Auth::user()->isAdmin()
                ? $BrokerConversation::with('seller')->orderBy('updated_at', 'DESC')
                : $BrokerConversation::whereSellerId(Auth::user()->id)->orderBy('updated_at', 'DESC');
        }

        return view('livewire.message.show', [
            'conversation_types' => $conversationTypes,
            'conversations' => $conversations->paginate(20),
        ]);
    }

    // Get conversation by ID
    public function getConversationByID($id, $isUnread)
    {
        $BrokerConversation = new BrokerConversation();
        if ($isUnread === 'true') {
            $BrokerConversation->setConversationAsRead($id);
        }

        $BrokerMessage = new BrokerMessage();
        $conversationById = $BrokerMessage->getConversationByID($id);

        $data = [];
        foreach ($conversationById as $con) {
            $messageType = Auth::user()->isAdmin()
                ? ($con->author->rights->USAR_type === 'broker' ? 'receiver' : 'sender')
                : (Auth::user()->id === $con->sender_id ? 'sender' : 'receiver');

            $authorName = Auth::user()->isAdmin()
                ? $con->author_name
                : (Auth::user()->id === $con->sender_id ? $con->author_name : 'Ticketbande');

            $data[] = [
                'user_type' => Auth::user()->isAdmin() ? 'admin' : 'seller',
                'message_id' => $id,
                'author_name' => $authorName,
                'message_type' => $messageType,
                'message' => $con->message,
                'created_at_formatted' => $con->created_at_formatted,
            ];
        }

        $this->conversationById = $data;
    }

    // Store message in conversation
    public function storeMessage($request)
    {
        $id = $request['message_id'];
        $BrokerConversation = BrokerConversation::with('seller')->find($id);

        if ($this->closeConversation) {
            $BrokerConversation->update(['closed' => 1]);
        } else if ($BrokerConversation->closed === 1) {
            $BrokerConversation->update(['closed' => 0]);
        }

        if (!empty($request['message'])) {
            $fieldRead = Auth::user()->isAdmin() ? 'read_by_admin' : 'read_by_seller';

            $message = new BrokerMessage([
                'sender_id' => Auth::user()->id,
                'message' => $request['message'],
                $fieldRead => true,
            ]);

            $BrokerConversation->messages()->save($message);
            $BrokerConversation->touch();

            if (Auth::user()->isAdmin()) {
                $this->sendMail($BrokerConversation, $request['message']);
            }

            session()->flash('message', 'Nachricht erfolgreich gesendet.');
        }
    }

    // Get unread conversations count
    public function getUnreadConversationsCount()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->USER_state !== 'admin' || strstr($user->USER_mail, '_blocked')) {
                return redirect()->route('logout');
            }

            if (Auth::user()->isAdmin()) {
                return BrokerConversation::whereHas('last_message', function ($q) {
                    $q->where('read_by_admin', 0)
                        ->where('sender_id', '<>', Auth::user()->id)
                        ->whereHas('author.rights', function ($q) {
                            $q->where('USAR_type', 'broker');
                        });
                })->count();
            }

            return BrokerConversation::whereSellerId(Auth::user()->id)
                ->whereHas('last_message', function ($q) {
                    $q->where('read_by_seller', 0)
                        ->where('sender_id', '<>', Auth::user()->id)
                        ->whereHas('author.rights', function ($q) {
                            $q->where('USAR_type', '<>', 'broker');
                        });
                })->count();
        }
    }

    // Send email notification for a new message
    public function sendMail($conversation, $bodyMessage)
    {
        $mailSent = Mail::send('email.seller_message', ['bodyMessage' => $bodyMessage], function ($message) use ($conversation) {
            $message->to($conversation->seller->email)
                ->subject('Neue Nachricht im Seller-Portal');
        });

        session()->flash('message', $mailSent ? 'Nachricht erfolgreich gesendet' : 'Etwas stimmt nicht. Nachricht wurde nicht gesendet');
        return redirect(route('login'));
    }
}
