<?php
require_once 'src/db/Database.php';
require_once 'src/dao/BaseDAO.php';
require_once 'src/dao/AtivoDAO.php';
require_once 'src/dao/RelacionamentoDAO.php';


// =========================
// ADAPTER (CMDB → VIEW LEGADA)
// =========================

function getHostsView() {
    $dao = new AtivoDAO();
    $relDao = new RelacionamentoDAO();

    $hosts = $dao->getByTipo('host');
    $rels = $relDao->getAll();

    $result = [];

    foreach ($hosts as $h) {
        $apps = [];

        foreach ($rels as $r) {
            if ($r['origem'] == $h['nome'] && $r['tipo'] == 'roda_em') {
                $apps[] = $r['destino'];
            }
        }

        $result[] = [
            'nome' => $h['nome'],
            'ambiente' => $h['ambiente'] ?? 'N/A',
            'area' => '-', // não existe mais no modelo
            'so' => '-',   // não existe mais
            'aplicacoes' => implode(', ', $apps)
        ];
    }

    return $result;
}


function getAplicacoesView() {
    $dao = new AtivoDAO();
    $relDao = new RelacionamentoDAO();

    $apps = $dao->getByTipo('aplicacao');
    $rels = $relDao->getAll();

    $data = [];

    foreach ($apps as $app) {
        $instancias = [];

        foreach ($rels as $r) {
            if ($r['destino'] == $app['nome'] && $r['tipo'] == 'roda_em') {
                $instancias[] = [
                    'host' => $r['origem'],
                    'rotulo' => '-',
                    'usuario' => '-',
                    'path' => '-',
                    'validador' => '-'
                ];
            }
        }

        $data[] = [
            'id' => $app['id'],
            'nome' => $app['nome'],
            'categoria' => '-',
            'instancias' => $instancias
        ];
    }

    return $data;
}

?>