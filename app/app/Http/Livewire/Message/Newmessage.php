<?php

namespace App\Http\Livewire\Message;

use App\Models\BrokerConversation;
use App\Models\BrokerMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class NewMessage extends Component
{

    protected string $email;
    protected int $sellerID;

    /**
     * @param string $sellerId
     * @param string $sellerEmail
     */
    public function mount( $sellerId = '',  $sellerEmail = '')
    {
        $this->email = $sellerEmail ?: Auth::user()->email;
        $this->sellerID = $sellerId ?: Auth::user()->id;
    }

    // For creating a conversation by user and ticket
    public function storeConversation(array $request)
    {
        if (empty($request)) {
            return;
        }

        $subjectType = $_SESSION['subjectType'] ?? '';
        $subject = $_SESSION['subject'] ?? '';
        $saleId = $_SESSION['sale_id'] ?? 0;
        $ticketId = $_SESSION['ticket_id'] ?? 0;
        $sellerId = $request['sellerID'] ?? Auth::user()->id;

        $conversation = BrokerConversation::create([
            'seller_id' => $sellerId,
            'sale_id' => $subjectType === 'sale' ? $saleId : 0,
            'ticket_id' => $subjectType === 'ticket' ? $ticketId : 0,
            'subject' => $subjectType === 'other' ? $subject : '',
        ]);

        $fieldRead = Auth::user()->isAdmin() ? 'read_by_admin' : 'read_by_seller';

        $message = new BrokerMessage([
            'sender_id' => Auth::user()->id,
            'message' => $request['message'],
            $fieldRead => true,
        ]);

        $conversation->messages()->save($message);

        if (Auth::user()->isAdmin()) {
            $this->sendMail($conversation, $request['message']);
        } else {
            session()->flash('message', 'Nachricht erfolgreich gesendet');
        }
    }

    // For sending email
    private function sendMail(BrokerConversation $conversation, string $bodyMessage)
    {
        $lastUrl = str_replace(url('/'), '', url()->previous());
        $redirectUrl = ($lastUrl === '/seller') ? 'sales.show' : 'message.show';

        $mailSent = Mail::send('email.seller_message', ['bodyMessage' => $bodyMessage], function ($message) use ($conversation) {
            $message->to($conversation->seller->email)
                ->subject('Neue Nachricht im Seller-Portal');
        });

        $flashMessage = $mailSent ? 'Nachricht erfolgreich gesendet' : 'Etwas stimmt nicht. Nachricht wurde nicht gesendet';
        session()->flash('message', $flashMessage);

        return redirect(route($redirectUrl));
    }
}
