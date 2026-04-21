<?php
require_once '../../src/db/Database.php';
require_once '../../src/dao/BaseDAO.php';
require_once '../../src/dao/ConfigDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $id = $_POST['id'] ?? null;
    $action = $_POST['_method'] ?? 'POST';

    if ($action === 'POST' && $nome) {
        $dao = new ConfigDAO();
        $success = $dao->insertAmbiente($nome);

        if ($success) {
            echo "<script>alert('Ambiente criado com sucesso'); window.location='../../index.php?page=ambiente';</script>";
        } else {
            echo "<script>alert('Falha ao criar ambiente.'); window.location='../../index.php?page=ambiente';</script>";
        }
    }
    elseif ($action === 'DELETE' && $id) {
        $dao = new ConfigDAO();
        $success = $dao->deleteAmbiente($id);
        if ($success) {
            echo "<script>alert('Ambiente deletado com sucesso'); window.location='../../index.php?page=ambiente';</script>";
        } else {
            echo "<script>alert('Falha ao deletar ambiente.'); window.location='../../index.php?page=ambiente';</script>";
        }
    }
    else {
        echo "<script>alert('Nome é necessário.'); window.location='../../index.php?page=ambiente';</script>";
    }
}
else {
    echo "<script>alert('Método de requisição inválido.'); window.location='../../index.php?page=ambiente';</script>";
}