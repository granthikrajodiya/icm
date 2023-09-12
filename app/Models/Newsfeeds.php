<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Session;

class Newsfeeds extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'detail',
        'image',
        'image_placement',
        'excerpt_length',
        'tenants',
        'created_by',
    ];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public static function imagePlacementOption() {
        return ['left' => 'Left', 'right' => 'Right', 'center' => 'Center'];
    }

    public static function getNewsfeedListByTenant() {
        $tenant_id = user()->tenant_id;

        $newsfeeds = Newsfeeds::orWhere('tenants', 'like', "%{$tenant_id}%")
            ->orWhere('tenants', 'ALL')
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return $newsfeeds;
    }

    public static function getAllNewsfeedsByTenant() {
        $tenant_id = user()->tenant_id;

        $newsfeeds = Newsfeeds::orWhere('tenants', 'like', "%{$tenant_id}%")
            ->orWhere('tenants', 'ALL')
            ->orderBy('id', 'DESC')
            ->get();

        return $newsfeeds;
    }

    public static function getAllNewsfeedsIdsByTenant() {
        $tenant_id = user()->tenant_id;

        $newsfeeds = Newsfeeds::orWhere('tenants', 'like', "%{$tenant_id}%")
            ->orWhere('tenants', 'ALL')
            ->orderBy('id', 'DESC')
            ->get()
            ->pluck('id');

        Session::put('newsfeeds', $newsfeeds);
    }

    public static function getAllNewsfeedWithLimit($limit) {
        $tenant_id = user()->tenant_id;

        $newsfeeds = Newsfeeds::orWhere('tenants', 'like', "%{$tenant_id}%")
            ->orWhere('tenants', 'ALL')
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get();

        return $newsfeeds;
    }

    public static function manageNewsfeeds($userPerms, $tenant_id){
        $tenant_id = user()->tenant_id;

        if(user()->account_type == User::INTERNAL_TENANT_ADMIN || in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)){

            // $newsfeeds = Newsfeeds::orWhere('tenants', 'is', "\[%")
            //     ->orWhere('tenants', 'like', "%\"{$tenant_id}\"%")
            //     ->orWhere('tenants', 'ALL')
            //     ->orderBy('id', 'DESC')
            //     ->get();

            $newsfeeds = Newsfeeds::orderBy('id', 'DESC')->get();

            //get only array or with all only because those are made from INTERNAL Admin or USERS

            $newsfeeds = $newsfeeds->filter(function ($newsfeed, $key) {
                return $newsfeed->tenants == 'ALL' ||  (strpos($newsfeed->tenants, '["') === 0) ;
            });


        }elseif(user()->account_type == User::EXTERNAL_TENANT_ADMIN){

            $newsfeeds = Newsfeeds::where('tenants', $tenant_id)
                ->orderBy('id', 'DESC')
                ->get();
        }else{
            $newsfeeds = [];
        }

        return $newsfeeds;
    }
}
