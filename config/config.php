<?php
return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'cmdb',
        'user' => 'cmdb',
        'pass' => 'cmdb',
    ],

    'auth' => [
        'mode' => 'dev', // dev | oauth

        // usuário fallback
        'dev_user' => [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'roles' => ['cmdb-admin']
        ],

        // OAuth2 / AD
        'oauth' => [
            'issuer' => 'https://login.microsoftonline.com/{tenant}/v2.0',
            'client_id' => 'SEU_CLIENT_ID',
            'audience' => 'api://default',
        ]
    ]
];