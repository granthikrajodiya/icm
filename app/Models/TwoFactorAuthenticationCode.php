<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TwoFactorAuthenticationCode
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoFactorAuthenticationCode whereUserId($value)
 * @mixin \Eloquent
 */
class TwoFactorAuthenticationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function matches(string $code): bool
    {
        return $this->code === $code;
    }
}
