<?php

return [

    'paths' => ['api/*', 'sanctum/csrf
    -cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',
        'http://localhost:8080',
        'http://127.0.0.1:8000',
        'http://localhost',
        'http://127.0.0.1',
        'http://localhost:5173', // For Vite
        'http://localhost:3001',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
