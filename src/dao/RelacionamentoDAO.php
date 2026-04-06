<?php
class RelacionamentoDAO extends BaseDAO {

    public function create($origem, $destino, $tipo_id) {
        $sql = "
            INSERT INTO relacionamento (origem_id, destino_id, tipo_id)
            VALUES (?, ?, ?)
        ";

        return $this->db->prepare($sql)->execute([$origem, $destino, $tipo_id]);
    }

    public function getAll() {
        $sql = "
            SELECT 
                r.id,
                o.nome as origem,
                d.nome as destino,
                tr.nome as tipo
            FROM relacionamento r
            JOIN ativo o ON r.origem_id = o.id
            JOIN ativo d ON r.destino_id = d.id
            JOIN tipo_relacionamento tr ON r.tipo_id = tr.id
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔥 IMPACTO (RECURSIVO)
    public function getImpacto($ativo_id) {
        $sql = "
            WITH RECURSIVE grafo AS (
                SELECT r.origem_id, r.destino_id
                FROM relacionamento r
                WHERE r.origem_id = ?

                UNION

                SELECT r.origem_id, r.destino_id
                FROM relacionamento r
                JOIN grafo g ON r.origem_id = g.destino_id
            )
            SELECT * FROM grafo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$ativo_id]);

        return $stmt->fetchAll();
    }
}