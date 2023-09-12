<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChFavorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $favorite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereFavoriteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereUserId($value)
 * @mixin \Eloquent
 */
class ChFavorite extends Model
{
    protected $fillable = [
        'user_id',
        'favorite_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
