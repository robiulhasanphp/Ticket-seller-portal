<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * BrokerConversation Model
 *
 * Manages broker-seller conversations with support for messages,
 * sales, tickets, and read/unread status tracking.
 */
class BrokerConversation extends Model
{
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'seller_id',
        'sale_id',
        'ticket_id',
        'subject',
        'closed',
    ];

    /**
     * @var array<string>
     */
    protected $appends = [
        'updated_at_formatted',
        'user_has_unread_messages',
        'status',
    ];

    /**
     * @var array<string>
     */
    protected $with = ['sale', 'ticket', 'last_message'];

    /**
     * Get all messages in this conversation.
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(BrokerMessage::class)->orderBy('created_at', 'DESC');
    }

    /**
     * Get the associated sale.
     *
     * @return HasOne
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class, 'ORDR_id', 'sale_id');
    }

    /**
     * Get the associated ticket with selected fields.
     *
     * @return HasOne
     */
    public function ticket(): HasOne
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

    /**
     * Get the most recent message in this conversation.
     *
     * @return HasOne
     */
    public function last_message(): HasOne
    {
        return $this->hasOne(BrokerMessage::class)->orderBy('created_at', 'DESC');
    }

    /**
     * Get the seller associated with this conversation.
     *
     * @return HasOne
     */
    public function seller(): HasOne
    {
        return $this->hasOne(User::class, 'USER_id', 'seller_id');
    }

    /**
     * Format the updated_at timestamp for display.
     *
     * @return string
     */
    public function getUpdatedAtFormattedAttribute(): string
    {
        return $this->updated_at?->formatLocalized('%d. %b %Y, %H:%M') ?? '';
    }

    /**
     * Determine if the current user has unread messages.
     *
     * @return bool
     */
    public function getUserHasUnreadMessagesAttribute(): bool
    {
        if ($this->last_message === null) {
            return false;
        }

        $field = Auth::user()?->isAdmin() ? 'read_by_admin' : 'read_by_seller';
        return !$this->last_message->{$field};
    }

    /**
     * Get the conversation status based on closed state and user role.
     *
     * @return string Either 'open' or 'closed'
     */
    public function getStatusAttribute(): string
    {
        $user = Auth::user();

        if ($user?->isAdmin()) {
            return $this->closed === 1 ? 'closed' : 'open';
        }

        $unreadCount = $this->messages->where('read_by_seller', 0)->count();
        return ($unreadCount > 0 || $this->closed !== 1) ? 'open' : 'closed';
    }

    /**
     * Retrieve conversations for the logged-in user.
     *
     * @return Collection
     */
    public function getByUser(): Collection
    {
        $query = $this->orderBy('updated_at', 'DESC');

        if (Auth::user()?->isAdmin()) {
            return $query->with('seller')->get();
        }

        return $query->whereSellerId(Auth::user()->id)->get();
    }

    /**
     * Mark the latest message in conversation as read.
     *
     * Updates the read status based on user role (admin or seller).
     * For non-admin users, also records the read timestamp.
     *
     * @param int $id The conversation ID
     * @return void
     */
    public function setConversationAsRead(int $id): void
    {
        $field = Auth::user()?->isAdmin() ? 'read_by_admin' : 'read_by_seller';
        $conversation = $this->find($id);

        if ($conversation === null) {
            return;
        }

        $lastMessage = $conversation->last_message;
        if ($lastMessage !== null) {
            $lastMessage->update([$field => true]);

            if (!Auth::user()?->isAdmin()) {
                $lastMessage->update(['read_at' => now()]);
            }
        }
    }
}
