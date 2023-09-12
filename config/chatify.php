<?php

use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

return [

    /*
    |-------------------------------------
    | Messenger display name
    |-------------------------------------
    */
    'name' => env('CHATIFY_NAME', 'Chat'),

    /*
    |-------------------------------------
    | Routes configurations
    |-------------------------------------
    */
    'routes' => [
        'prefix'     => env('CHATIFY_ROUTES_PREFIX', '{tenant}/chat'),
        'middleware' => env('CHATIFY_ROUTES_MIDDLEWARE', [
            'web',
            'auth',
            InitializeTenancyByPath::class,
        ]),
        'namespace' => env('CHATIFY_ROUTES_NAMESPACE', 'Chatify\Http\Controllers'),
    ],
    'api_routes' => [
        'prefix'     => env('CHATIFY_API_ROUTES_PREFIX', 'chatify/api'),
        'middleware' => env('CHATIFY_API_ROUTES_MIDDLEWARE', ['api']),
        'namespace'  => env('CHATIFY_API_ROUTES_NAMESPACE', 'Chatify\Http\Controllers\Api'),
    ],

    /*
    |-------------------------------------
    | Pusher API credentials
    |-------------------------------------
    */
    'pusher' => [
        'key'     => env('PUSHER_APP_KEY'),
        'secret'  => env('PUSHER_APP_SECRET'),
        'app_id'  => env('PUSHER_APP_ID'),
        'options' => (array)[
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS'  => env('PUSHER_APP_USETLS'),
        ],
    ],

    /*
    |-------------------------------------
    | User Avatar
    |-------------------------------------
    */
    'user_avatar' => [
        'folder'  => '',
        'default' => 'avatar.png',
    ],

    /*
    |-------------------------------------
    | Attachments
    |-------------------------------------
    */
    'attachments' => [
        'folder'              => 'attachments',
        'download_route_name' => 'attachments.download',
        'allowed_images'      => (array)[
            'png',
            'jpg',
            'jpeg',
            'gif',
        ],
        'allowed_files' => (array)[
            'zip',
            'rar',
            'txt',
        ],
    ],
];
