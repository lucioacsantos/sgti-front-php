<?php
require_once 'src/db/Database.php';
require_once 'src/dao/BaseDAO.php';
require_once 'src/dao/AtivoDAO.php';
require_once 'src/dao/ConfigDAO.php';
require_once 'src/dao/RelacionamentoDAO.php';


// =========================
// ADAPTER (CMDB → VIEW LEGADA)
// =========================

function getHostsView() {
    $dao = new AtivoDAO();
    $hosts = $dao->getAll();

    $result = [];

    foreach ($hosts as $h) {
        $result[] = [
            'id' => $h['id'],
            'nome' => $h['nome'],
            'descricao' => $h['descricao'],
            'tipo_id' => $h['tipo_id'],
            'ambiente_id' => $h['ambiente_id'],
            'ambiente' => $h['ambiente'],
            'status_id' => $h['status_id'],
            'criticidade_id' => $h['criticidade_id'],
            'criticidade' => $h['criticidade'],
            'responsavel' => $h['responsavel'],
            'created_at' => $h['created_at'],
            'updated_at' => $h['updated_at'],
            'sor_id' => $h['sor_id'],
            'sor' => $h['sor']
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

function getAllStatusAtivo() {
    $dao = new ConfigDAO();
    return $dao->getAllStatusAtivo();
}

function getAllTipoAtivo() {
    $dao = new ConfigDAO();
    return $dao->getAllTipoAtivo();
}

function getAllAmbiente() {
    $dao = new ConfigDAO();
    return $dao->getAllAmbiente();
}

function getAllCriticidade() {
    $dao = new ConfigDAO();
    return $dao->getAllCriticidade();
}

function getAllTipoRelacionamento() {
    $dao = new ConfigDAO();
    return $dao->getAllTipoRelacionamento();
}

function getAllRelacionamentos() {
    $dao = new RelacionamentoDAO();
    return $dao->getAll();
}

function getAllSOR() {
    $dao = new ConfigDAO();
    return $dao->getAllSOR();
}

function getAllAreas() {
    $dao = new ConfigDAO();
    return $dao->getAllAreas();
}

?>