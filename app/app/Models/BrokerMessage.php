<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrokerMessage extends Model
{
    use SoftDeletes;

    protected $fillable = ['broker_conversation_id', 'sender_id', 'message', 'read_by_admin', 'read_by_seller'];
    protected $appends = ['created_at_formatted', 'read_at_formatted', 'author_name'];
    protected $with = ['author'];

    // Relationship to get the author of the message
    public function author()
    {
        return $this->hasOne(User::class, 'USER_id', 'sender_id');
    }

    // Retrieve conversation messages by ID
    public function getConversationByID($id)
    {
        $query = $this->with('author')->where('broker_conversation_id', $id)->orderBy('created_at');

        // Admin check is handled within the query logic
        return Auth::user()->isAdmin() ? $query->get() : $query->get();
    }

    // Format message to handle new lines
    public function getMessageAttribute()
    {
        return nl2br($this->attributes['message']);
    }

    // Get the author's full name or a default name based on user role
    public function getAuthorNameAttribute()
    {
        if (Auth::user()->isAdmin()) {
            return $this->author->firstname.' '.$this->author->lastname;
        }

        // Seller messages use a different naming convention
        return $this->sender_id != Auth::user()->id ? 'ticketbande' : 'Sie';
    }

    // Format the creation date of the message
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->formatLocalized('%a %d. %B %Y, %H:%M');
    }

    // Format the read date of the message if available
    public function getReadAtFormattedAttribute()
    {
        if ($this->read_at !== null) {
            return Carbon::parse($this->read_at)->formatLocalized('%a %d. %B %Y, %H:%M');
        }

        return null;
    }
}
