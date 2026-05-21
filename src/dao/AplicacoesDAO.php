<?php
class AplicacoesDAO extends BaseDAO {

    public function getAll() {
        $sql = "
            SELECT 
                a.*
            FROM aplicacao a
            ORDER BY a.sistema
        ";

        return $this->db->query($sql)->fetchAll();
    }
}