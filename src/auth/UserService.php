<?php
require_once __DIR__ . '/../db/Database.php';

class UserService {

    public function findOrCreate($ldapUser) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM usuario WHERE username = ?");
        $stmt->execute([$ldapUser['username']]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $stmt = $db->prepare("
                INSERT INTO usuario (username, nome, email)
                VALUES (?, ?, ?)
                RETURNING *
            ");
            $stmt->execute([
                $ldapUser['username'],
                $ldapUser['nome'],
                $ldapUser['email']
            ]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $user;
    }
}