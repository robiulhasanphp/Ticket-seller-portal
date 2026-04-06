<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrokerConversation extends Model
{
    use SoftDeletes;

    protected $fillable = ['seller_id', 'sale_id', 'ticket_id', 'subject', 'closed'];
    protected $appends = ['updated_at_formatted', 'user_has_unread_messages', 'status'];
    protected $with = ['sale', 'ticket', 'last_message'];

    // Relationship with BrokerMessage
    public function messages()
    {
        return $this->hasMany(BrokerMessage::class)->orderBy('created_at', 'DESC');
    }

    // Relationship with Sale
    public function sale()
    {
        return $this->hasOne(Sale::class, 'ORDR_id', 'sale_id');
    }

    // Relationship with Ticket with custom fields
    public function ticket()
    {
        $fields = [
            'TICK_id',
            'TICK_id AS id',
            'EVEN_id',
            'TICT_id',
            'TICD_id',
            'TICA_id',
            'TIDE_id',
            'HPBN_id',
            'TICK_type',
        ];

        return $this->hasOne(Ticket::class, 'TICK_id', 'ticket_id')->select($fields);
    }

    // Relationship to get last message
    public function last_message()
    {
        return $this->hasOne(BrokerMessage::class)->orderBy('created_at', 'DESC');
    }

    // Relationship with Seller (User)
    public function seller()
    {
        return $this->hasOne('App\Models\User', 'USER_id', 'seller_id');
    }

    // Format the updated_at timestamp
    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at->formatLocalized('%d. %b %Y, %H:%M');
    }

    // Determine if the user has unread messages in this conversation
    public function getUserHasUnreadMessagesAttribute()
    {
        if (!empty($this->last_message)) {
            $field = Auth::user()->isAdmin() ? 'read_by_admin' : 'read_by_seller';
            return !$this->last_message->$field;
        }

        return false;
    }

    // Get the conversation status based on the user's role and message status
    public function getStatusAttribute()
    {
        if (Auth::user()->isAdmin()) {
            return $this->closed == 1 ? 'closed' : 'open';
        } else {
            return $this->messages->where('read_by_seller', 0)->count() > 0
                ? 'open'
                : ($this->closed == 1 ? 'closed' : 'open');
        }
    }

    // Fetch conversations for the logged-in user (admin or seller)
    public function getByUser()
    {
        $query = $this->orderBy('updated_at', 'DESC');

        if (Auth::user()->isAdmin()) {
            return $query->with('seller')->get();
        }

        return $query->whereSellerId(Auth::user()->id)->get();
    }

    // Mark the last message of the conversation as read
    public function setConversationAsRead($id)
    {
        $field = Auth::user()->isAdmin() ? 'read_by_admin' : 'read_by_seller';
        $conversation = $this->find($id);

        // Mark the last message as read
        $conversation->last_message()->update([$field => 1]);

        if (!Auth::user()->isAdmin()) {
            $conversation->last_message()->update(['read_at' => now()]);
        }
    }
}
