<?php
class ConfigDAO extends BaseDAO {

    // Métodos para Criticidade
    public function getAllCriticidade() {
        $sql = "SELECT id, nivel FROM criticidade";
        return $this->db->query($sql)->fetchAll();
    }

    public function getCriticidadeById($id) {
        $stmt = $this->db->prepare("SELECT id, nivel FROM criticidade WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insertCriticidade($nivel) {
        $stmt = $this->db->prepare("INSERT INTO criticidade (nivel) VALUES (?)");
        return $stmt->execute([$nivel]);
    }

    public function updateCriticidade($id, $nivel) {
        $stmt = $this->db->prepare("UPDATE criticidade SET nivel = ? WHERE id = ?");
        return $stmt->execute([$nivel, $id]);
    }

    public function deleteCriticidade($id) {
        $stmt = $this->db->prepare("DELETE FROM criticidade WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Métodos para Status do Ativo
    public function getAllStatusAtivo() {
        $sql = "SELECT id, nome FROM status_ativo";
        return $this->db->query($sql)->fetchAll();
    }

    public function getStatusAtivoById($id) {
        $stmt = $this->db->prepare("SELECT id, nome FROM status_ativo WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insertStatusAtivo($nome) {
        $stmt = $this->db->prepare("INSERT INTO status_ativo (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function updateStatusAtivo($id, $nome) {
        $stmt = $this->db->prepare("UPDATE status_ativo SET nome = ? WHERE id = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function deleteStatusAtivo($id) {
        $stmt = $this->db->prepare("DELETE FROM status_ativo WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Métodos para Tipo de Ativo
    public function getAllTipoAtivo() {
        $sql = "SELECT id, nome, descricao FROM tipo_ativo";
        return $this->db->query($sql)->fetchAll();
    }

    public function getTipoAtivoById($id) {
        $stmt = $this->db->prepare("SELECT id, nome, descricao FROM tipo_ativo WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insertTipoAtivo($nome, $descricao) {
        $stmt = $this->db->prepare("INSERT INTO tipo_ativo (nome, descricao) VALUES (?, ?)");
        return $stmt->execute([$nome, $descricao]);
    }

    public function updateTipoAtivo($id, $nome, $descricao) {
        $stmt = $this->db->prepare("UPDATE tipo_ativo SET nome = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $id]);
    }

    public function deleteTipoAtivo($id) {
        $stmt = $this->db->prepare("DELETE FROM tipo_ativo WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Métodos para Ambiente
    public function getAllAmbiente() {
        $sql = "SELECT id, nome FROM ambiente ORDER BY nome";
        return $this->db->query($sql)->fetchAll();
    }

    public function getAmbienteById($id) {
        $stmt = $this->db->prepare("SELECT id, nome FROM ambiente WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insertAmbiente($nome) {
        $stmt = $this->db->prepare("INSERT INTO ambiente (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function updateAmbiente($id, $nome) {
        $stmt = $this->db->prepare("UPDATE ambiente SET nome = ? WHERE id = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function deleteAmbiente($id) {
        $stmt = $this->db->prepare("DELETE FROM ambiente WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Métodos para Tipo de Relacionamento
    public function getAllTipoRelacionamento() {
        $sql = "SELECT id, nome, descricao FROM tipo_relacionamento";
        return $this->db->query($sql)->fetchAll();
    }

    public function getTipoRelacionamentoById($id) {
        $stmt = $this->db->prepare("SELECT id, nome, descricao FROM tipo_relacionamento WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insertTipoRelacionamento($nome, $descricao) {
        $stmt = $this->db->prepare("INSERT INTO tipo_relacionamento (nome, descricao) VALUES (?, ?)");
        return $stmt->execute([$nome, $descricao]);
    }

    public function updateTipoRelacionamento($id, $nome, $descricao) {
        $stmt = $this->db->prepare("UPDATE tipo_relacionamento SET nome = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $id]);
    }

    public function deleteTipoRelacionamento($id) {
        $stmt = $this->db->prepare("DELETE FROM tipo_relacionamento WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Métodos para SOR
    public function getAllSOR() {
        $sql = "SELECT id, abreviacao, descricao, lifecycle FROM sor ORDER BY abreviacao";
        return $this->db->query($sql)->fetchAll();
    }

    public function getSORById($id) {
        $stmt = $this->db->prepare("SELECT id, abreviacao, descricao, lifecycle FROM sor WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insertSOR($abreviacao, $descricao, $lifecycle) {
        $stmt = $this->db->prepare("INSERT INTO sor (abreviacao, descricao, lifecycle) VALUES (?, ?, ?)");
        return $stmt->execute([$abreviacao, $descricao, $lifecycle]);
    }

    public function updateSOR($id, $abreviacao, $descricao, $lifecycle) {
        $stmt = $this->db->prepare("UPDATE sor SET abreviacao = ?, descricao = ?, lifecycle = ? WHERE id = ?");
        return $stmt->execute([$abreviacao, $descricao, $lifecycle, $id]);
    }

    public function deleteSOR($id) {
        $stmt = $this->db->prepare("DELETE FROM sor WHERE id = ?");
        return $stmt->execute([$id]);
    }

}