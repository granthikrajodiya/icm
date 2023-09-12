<?php

return [
    'ics_url'           => endingSlash(env("ILINX_ICS_REST_URL", '')),
    'ic_url'           => endingSlash(env("ILINX_IC_REST_URL", '')),
    'flex_url'          => endingSlash(env('ILINX_FLEX_URL', '')),
    'flex_api_url'      => endingSlash(env('ILINX_FORM_URL', '')),
    'flex_init_url'     => endingSlash(env('ILINX_FORM_INIT_URL', '')),
    'custom_url'        => endingSlash(env('CUSTOM_REST_SERVICE_URL', '')),
    'activation_id'     => env('ILINX_ACTIVATION_ID', ''),
    'registration_user' => [
        'username' => env('ILINX_NEW_USER_REG_ACCOUNT', ''),
        'password' => env('ILINX_NEW_USER_REG_PASS', ''),
    ],
    'active_batch_profile_name'   => env('IRD_USER_ACTIVATION_PROFILE_NAME', 'IRD User Activation'),
    'delivery_batch_profile_name' => env('IRD_DOC_DELIVERY_PROFILE_NAME', 'ILINX Records Director - Document Delivery'),
    'include_tenant_id'           => env('INCLUDE_TENANTID_WITH_HOST_LOGINS', 'false'),
    'host_user_auto_registration' => env('HOST_USER_AUTO_REGISTRATION', false),
];
