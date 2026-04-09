<?php
return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'cmdb',
        'user' => 'cmdb',
        'pass' => 'cmdb',
    ],

    'auth' => [
        'mode' => 'dev', // dev | oauth | ldap

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
        ],

        // LDAP / AD
        'ldap' => [
            'host' => 'ldap://pwdc01.energia.org.br',
            'port' => 389,
            'base_dn' => 'dc=energia,dc=org,dc=br',
            'domain' => 'energia.org.br',
            'use_ssl' => false, // true se usar ldaps://
        ]
    ]
];