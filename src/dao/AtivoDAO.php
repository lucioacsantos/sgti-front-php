<?php
class AtivoDAO extends BaseDAO {

    public function create($data) {
        $sql = "
            INSERT INTO ativo (nome, descricao, tipo_id, ambiente_id, responsavel)
            VALUES (?, ?, ?, ?, ?)
            RETURNING id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['nome'],
            $data['descricao'],
            $data['tipo_id'],
            $data['ambiente_id'],
            $data['responsavel']
        ]);

        return $stmt->fetchColumn();
    }

    public function getAll() {
        $sql = "
            SELECT 
                a.*,
                t.nome as tipo,
                amb.nome as ambiente
            FROM ativo a
            JOIN tipo_ativo t ON a.tipo_id = t.id
            LEFT JOIN ambiente amb ON a.ambiente_id = amb.id
            ORDER BY a.nome
        ";

        return $this->db->query($sql)->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM ativo WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM ativo WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByTipo($tipoNome) {
        $sql = "
            SELECT 
                a.id,
                a.nome,
                t.nome as tipo,
                amb.nome as ambiente
            FROM ativo a
            JOIN tipo_ativo t ON a.tipo_id = t.id
            LEFT JOIN ambiente amb ON a.ambiente_id = amb.id
            WHERE LOWER(t.nome) = LOWER(?)
            ORDER BY a.nome
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tipoNome]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}