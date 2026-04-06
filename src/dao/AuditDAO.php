<?php
class AuditDAO extends BaseDAO {

    public function log($entidade, $id, $acao, $antes, $depois, $usuario) {
        $sql = "
            INSERT INTO audit_log (entidade, entidade_id, acao, antes, depois, usuario)
            VALUES (?, ?, ?, ?, ?, ?)
        ";

        return $this->db->prepare($sql)->execute([
            $entidade,
            $id,
            $acao,
            json_encode($antes),
            json_encode($depois),
            $usuario
        ]);
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM audit_log ORDER BY id DESC")->fetchAll();
    }
}