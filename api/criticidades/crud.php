<?php
require_once '../../src/db/Database.php';
require_once '../../src/dao/BaseDAO.php';
require_once '../../src/dao/ConfigDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nivel = $_POST['nivel'] ?? null;
    $id = $_POST['id'] ?? null;
    $action = $_POST['_method'] ?? 'POST';

    if ($action === 'POST' && $nivel) {
        $dao = new ConfigDAO();
        $success = $dao->insertCriticidade($nivel);

        if ($success) {
            echo "<script>alert('Criticidade criada com sucesso'); window.location='../../index.php?page=criticidade';</script>";
        } else {
            echo "<script>alert('Falha ao criar criticidade.'); window.location='../../index.php?page=criticidade';</script>";
        }
    }
    elseif ($action === 'DELETE' && $id) {
        $dao = new ConfigDAO();
        $success = $dao->deleteCriticidade($id);
        if ($success) {
            echo "<script>alert('Criticidade deletada com sucesso'); window.location='../../index.php?page=criticidade';</script>";
        } else {
            echo "<script>alert('Falha ao deletar criticidade.'); window.location='../../index.php?page=criticidade';</script>";
        }
    }
    else {
        echo "<script>alert('Nível é necessário.'); window.location='../../index.php?page=criticidade';</script>";
    }
}
else {
    echo "<script>alert('Método de requisição inválido.'); window.location='../../index.php?page=criticidade';</script>";
}