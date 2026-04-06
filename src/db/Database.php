<?php
class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            $config = require __DIR__ . '/../../config/config.php';

            $dsn = "pgsql:host={$config['db']['host']};dbname={$config['db']['dbname']}";

            self::$conn = new PDO(
                $dsn,
                $config['db']['user'],
                $config['db']['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return self::$conn;
    }
}