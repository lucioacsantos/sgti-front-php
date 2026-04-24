<?php
require_once '../../src/db/Database.php';
require_once '../../src/dao/BaseDAO.php';
require_once '../../src/dao/ConfigDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $id = $_POST['id'] ?? null;
    $action = $_POST['_method'] ?? 'POST';

    if ($action === 'POST' && $nome) {
        $dao = new ConfigDAO();
        $success = $dao->insertTipoRelacionamento($nome,$descricao);

        if ($success) {
            echo "<script>alert('Tipo de relacionamento criado com sucesso'); window.location='../../index.php?page=relacionamentos';</script>";
        } else {
            echo "<script>alert('Falha ao criar tipo de relacionamento.'); window.location='../../index.php?page=relacionamentos';</script>";
        }
    }
    elseif ($action === 'DELETE' && $id) {
        $dao = new ConfigDAO();
        $success = $dao->deleteTipoRelacionamento($id);
        if ($success) {
            echo "<script>alert('Tipo de relacionamento deletado com sucesso'); window.location='../../index.php?page=relacionamentos';</script>";
        } else {
            echo "<script>alert('Falha ao deletar tipo de relacionamento.'); window.location='../../index.php?page=relacionamentos';</script>";
        }
    }
    else {
        echo "<script>alert('Nome é necessário.'); window.location='../../index.php?page=relacionamentos';</script>";
    }
}
else {
    echo "<script>alert('Método de requisição inválido.'); window.location='../../index.php?page=relacionamentos';</script>";
}