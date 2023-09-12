<?php

namespace Engage\Downloadcenter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_version',
        'product_name',
        'created_by',
    ];

    public static function product_list($version){
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            //$products = self::where('product_version',$version)->get()->toArray();
			// Add the orderBy
            $products = self::where('product_version',$version)->orderBy('product_name', 'asc')->get()->toArray();
            return $products;
        }else{
            //$products = Products::join('product_permissions', 'products.id', '=', 'product_permissions.product_id')->where('product_permissions.tenant_id',tenant('tenant_id'))->where('product_version',$version)->get()->toArray();
			// Add the orderBy
            $products = \Products::join('product_permissions', 'products.id', '=', 'product_permissions.product_id')->where('product_permissions.tenant_id',tenant('tenant_id'))->where('product_version',$version)->orderBy('product_name', 'asc')->get()->toArray();
            return $products;
        }
    }
}
