<?php

class AuthService {

    public static function mapRole($groups) {

        $config = require 'config/config.php';

        $groups = array_map('strtoupper', $groups);

        foreach ($config['auth']['roles']['admin'] as $g) {
            if (in_array(strtoupper($g), $groups)) {
                return 'admin';
            }
        }

        foreach ($config['auth']['roles']['read'] as $g) {
            if (in_array(strtoupper($g), $groups)) {
                return 'read';
            }
        }

        return 'none';
    }

    public static function requireLogin() {
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit;
        }
    }

    public static function requireRead() {
        self::requireLogin();

        if (!in_array($_SESSION['user']['role'], ['admin', 'read'])) {
            http_response_code(403);
            die("Acesso negado");
        }
    }

    public static function requireAdmin() {
        self::requireLogin();

        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            die("Acesso negado");
        }
    }

    function filterRelevantGroups($groups) {

        $allowed = [
            'G_GESIN_GOSD_OMIS',
            'G_GESIN'
        ];

        return array_values(array_intersect($groups, $allowed));
    }
}