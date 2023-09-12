<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChartDatasource
 *
 * @property int $id
 * @property string $datasource_name
 * @property string $sp_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ChartDatasourceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource whereDatasourceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource whereSpName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartDatasource whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChartDatasource extends Model
{
    use HasFactory;

    public const DOCUMENT_STATUS = [
        'Internal'                      => '#0069a5',
        'Pending'                       => '#ffb800',
        'Pending Approval'              => '#0098ee',
        'Released'                      => '#ff8517',
        'Delivered'                     => '#7bd2f6',
        'Deleted'                       => '#5e113f',
        'Server Processing Delivery'    => '#414ce0',
        'Pending Delivery'              => '#7652cc',
        'Delivery Failed'               => '#f2431f',
        'Approved'                      => '#72f283',
        'Hold'                          => '#48594b',
        'PendingRelease'                => '#ebe571',
    ];

    public const EMAIL_STATUS = [
        'Pending'   => '#cecece',
        'Received'  => '#22db9b'
    ];

    protected $fillable = [
        'datasource_name',
        'sp_name',
    ];
}
