<?php
class AtivoDAO extends BaseDAO {

    public function getAll() {
        $sql = "
            SELECT 
                a.*,
                t.nome as tipo,
                amb.nome as ambiente,
                s.nome as status,
                c.nivel as criticidade,
                sor.abreviacao as sor
            FROM ativo a
            JOIN tipo_ativo t ON a.tipo_id = t.id
            LEFT JOIN ambiente amb ON a.ambiente_id = amb.id
            LEFT JOIN status_ativo s ON a.status_id = s.id
            LEFT JOIN criticidade c ON a.criticidade_id = c.id
            LEFT JOIN sor ON a.sor_id = sor.id
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
                amb.nome as ambiente,
                s.nome as status,
                c.nome as criticidade,
                sor.nome as sor
            FROM ativo a
            JOIN tipo_ativo t ON a.tipo_id = t.id
            LEFT JOIN ambiente amb ON a.ambiente_id = amb.id
            LEFT JOIN status_ativo s ON a.status_id = s.id
            LEFT JOIN criticidade c ON a.criticidade_id = c.id
            LEFT JOIN sor ON a.sor_id = sor.id
            WHERE LOWER(t.nome) = LOWER(?)
            ORDER BY a.nome
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tipoNome]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}