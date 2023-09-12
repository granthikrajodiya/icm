<?php

namespace App\Traits;

use App\Models\User;

trait CreatedBy
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
