<?php

namespace Engage\Downloadcenter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_download_history extends Model
{
    use HasFactory;

    protected $table = 'file_download_history';

    protected $fillable = [
        'tenant_id',
        'product_id',
        'filename',
        'download_date',
        'download_user_id',
    ];
}
