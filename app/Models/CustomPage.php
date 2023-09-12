<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\CustomPage
 *
 * @property int $id
 * @property string $title
 * @property string $detail
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\CustomPageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'detail',
        'created_by',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public static function fetchCustomPage()
    {
        return self::get()->pluck('id', 'title');
    }
}
