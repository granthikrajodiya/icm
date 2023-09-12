<?php

namespace Engage\Ilinxengage_qapp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QappDefinition extends Model
{
    use HasFactory;

    protected $table = 'qapp_definitions';

    protected $fillable = [
        'tenant_id',
        'name',
        'description',
        'online',
        'allow_upload',
        'allow_download',
        'allow_print',
        'form_json',
        'ics_appname',
        'card_mode',
        'navigation_mode'
    ];
}
