<?php
class DominioDAO extends BaseDAO {

    public function getTiposAtivo() {
        return $this->db->query("SELECT * FROM tipo_ativo ORDER BY nome")->fetchAll();
    }

    public function getTiposRelacionamento() {
        return $this->db->query("SELECT * FROM tipo_relacionamento ORDER BY nome")->fetchAll();
    }

    public function getAmbientes() {
        return $this->db->query("SELECT * FROM ambiente")->fetchAll();
    }

    public function getStatus() {
        return $this->db->query("SELECT * FROM status_ativo")->fetchAll();
    }
}