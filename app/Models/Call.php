<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Call
 *
 * @property int $id
 * @property string $batch_id
 * @property string $subject
 * @property string $call_type
 * @property string $duration
 * @property int $user_id
 * @property string|null $description
 * @property string|null $call_date
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CallFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Call newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Call newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Call query()
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereCallDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereCallType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Call whereUserId($value)
 * @mixin \Eloquent
 */
class Call extends Model
{
    use CreatedBy, HasFactory;

    protected $fillable = [
        'subject',
        'call_type',
        'duration',
        'description',
        'call_date',
        'created_by',
        'user_id',
        'batch_id',
    ];

    public const CALL_TYPE_OUTBOUND = 0;
    public const CALL_TYPE_INBOUND  = 1;

    public const CALL_TYPES = [
        self::CALL_TYPE_OUTBOUND => 'outbound',
        self::CALL_TYPE_INBOUND  => 'inbound',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
