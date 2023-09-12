<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CaseNote
 *
 * @property int $id
 * @property string $batch_id
 * @property string|null $notes
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdBy
 * @method static \Database\Factories\CaseNoteFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CaseNote extends Model
{
    use HasFactory, CreatedBy;

    protected $fillable = [
        'notes',
        'created_by',
        'batch_id'
    ];
}
