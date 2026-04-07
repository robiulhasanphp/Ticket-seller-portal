<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * BrokerMessage Model
 *
 * Manages broker conversation messages with soft deletes,
 * user relationships, and formatted output attributes.
 */
class BrokerMessage extends Model
{
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'broker_conversation_id',
        'sender_id',
        'message',
        'read_by_admin',
        'read_by_seller',
    ];

    /**
     * @var array<string>
     */
    protected $appends = [
        'created_at_formatted',
        'read_at_formatted',
        'author_name',
    ];

    /**
     * @var array<string>
     */
    protected $with = ['author'];

    /**
     * Get the author of the message.
     *
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'USER_id', 'sender_id');
    }

    /**
     * Retrieve conversation messages by broker conversation ID.
     *
     * @param int $id The conversation ID
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getConversationByID(int $id)
    {
        return $this->with('author')
            ->where('broker_conversation_id', $id)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Format message to handle line breaks.
     *
     * @return string
     */
    public function getMessageAttribute(): string
    {
        return nl2br($this->attributes['message'] ?? '');
    }

    /**
     * Get the author's full name or role-based display name.
     *
     * Returns full name for admin users, standardized names for sellers.
     *
     * @return string
     */
    public function getAuthorNameAttribute(): string
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return ($this->sender_id !== $user?->id) ? 'Ticketbande' : 'Sie';
        }

        return sprintf(
            '%s %s',
            $this->author?->firstname ?? 'Unknown',
            $this->author?->lastname ?? 'User'
        );
    }

    /**
     * Format creation date in localized format.
     *
     * @return string
     */
    public function getCreatedAtFormattedAttribute(): string
    {
        return $this->created_at?->formatLocalized('%a %d. %B %Y, %H:%M') ?? '';
    }

    /**
     * Format read date in localized format if available.
     *
     * @return string|null
     */
    public function getReadAtFormattedAttribute(): ?string
    {
        return $this->read_at !== null
            ? Carbon::parse($this->read_at)->formatLocalized('%a %d. %B %Y, %H:%M')
            : null;
    }
}
