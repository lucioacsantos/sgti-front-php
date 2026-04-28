<?php
require_once '../../src/db/Database.php';
require_once '../../src/dao/BaseDAO.php';
require_once '../../src/dao/ConfigDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $sigla = $_POST['sigla'] ?? null;
    $id = $_POST['id'] ?? null;
    $action = $_POST['_method'] ?? 'POST';

    if ($action === 'POST' && $nome && $sigla) {
        $dao = new ConfigDAO();
        $success = $dao->insertArea($nome, $sigla);

        if ($success) {
            echo "<script>alert('Área criada com sucesso'); window.location='../../index.php?page=areas';</script>";
        } else {
            echo "<script>alert('Falha ao criar área.'); window.location='../../index.php?page=areas';</script>";
        }
    }
    elseif ($action === 'DELETE' && $id) {
        $dao = new ConfigDAO();
        $success = $dao->deleteArea($id);
        if ($success) {
            echo "<script>alert('Área deletada com sucesso'); window.location='../../index.php?page=areas';</script>";
        } else {
            echo "<script>alert('Falha ao deletar área.'); window.location='../../index.php?page=areas';</script>";
        }
    }
    else {
        echo "<script>alert('Nome e sigla são necessários.'); window.location='../../index.php?page=areas';</script>";
    }
}
else {
    echo "<script>alert('Método de requisição inválido.'); window.location='../../index.php?page=areas';</script>";
}