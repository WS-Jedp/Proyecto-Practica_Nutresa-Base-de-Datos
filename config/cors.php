<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['Authorization', 'Content-Type', 'X-Requested-With'],
    'allowedMethods' => ['POST', 'GET'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
