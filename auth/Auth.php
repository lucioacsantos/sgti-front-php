<?php
class Auth {

    public static function authenticate() {
        $config = require __DIR__ . '/../config/config.php';

        // =====================
        // DEV MODE
        // =====================
        if ($config['auth']['mode'] === 'dev') {
            return (object)[
                'username' => $config['auth']['dev_user']['username'],
                'roles' => $config['auth']['dev_user']['roles']
            ];
        }

        // =====================
        // OAUTH2 (Bearer Token)
        // =====================
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            throw new Exception("No token provided");
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        $payload = self::decodeJWT($token);

        return (object)[
            'username' => $payload['preferred_username'] ?? 'unknown',
            'roles' => $payload['roles'] ?? []
        ];
    }

    private static function decodeJWT($jwt) {
        $parts = explode('.', $jwt);
        return json_decode(base64_decode($parts[1]), true);
    }
}