<?php
require_once __DIR__ . '/../db/Database.php';

class BackupCodeService {

    public function generate($userId) {
        $db = Database::getConnection();

        $codes = [];

        for ($i = 0; $i < 8; $i++) {
            $code = strtoupper(bin2hex(random_bytes(4)));
            $hash = password_hash($code, PASSWORD_DEFAULT);

            $db->prepare("
                INSERT INTO usuario_backup_code (usuario_id, codigo_hash)
                VALUES (?, ?)
            ")->execute([$userId, $hash]);

            $codes[] = $code;
        }

        return $codes;
    }

    public function verify($userId, $input) {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            SELECT id, codigo_hash 
            FROM usuario_backup_code
            WHERE usuario_id = ? AND usado = false
        ");
        $stmt->execute([$userId]);

        foreach ($stmt->fetchAll() as $c) {
            if (password_verify($input, $c['codigo_hash'])) {

                $db->prepare("
                    UPDATE usuario_backup_code SET usado = true WHERE id = ?
                ")->execute([$c['id']]);

                return true;
            }
        }

        return false;
    }
}