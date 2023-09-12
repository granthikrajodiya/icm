<?php

namespace Engage\Downloadcenter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPermissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'tenant_id',
        'created_by',
    ];

    public static function checkPermissions(int|string $product_id, string $tenant_id): object|null
    {
       return self::where(['product_id' => (int)$product_id, 'tenant_id' => $tenant_id])->first();
    }

    public function product(): HasOne
    {
        return $this->hasOne(Products::class, 'product_id', 'id');
    }
}
