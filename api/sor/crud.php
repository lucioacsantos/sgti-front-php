<?php
require_once '../../src/db/Database.php';
require_once '../../src/dao/BaseDAO.php';
require_once '../../src/dao/ConfigDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $abreviacao = $_POST['abreviacao'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $lifecycle = $_POST['lifecycle'] ?? null;
    $id = $_POST['id'] ?? null;
    $action = $_POST['_method'] ?? 'POST';

    if ($action === 'POST' && $abreviacao) {
        $dao = new ConfigDAO();
        $success = $dao->insertSOR($abreviacao, $descricao, $lifecycle);

        if ($success) {
            echo "<script>alert('SOR criado com sucesso'); window.location='../../index.php?page=sor';</script>";
        } else {
            echo "<script>alert('Falha ao criar SOR.'); window.location='../../index.php?page=sor';</script>";
        }
    }
    elseif ($action === 'DELETE' && $id) {
        $dao = new ConfigDAO();
        $success = $dao->deleteSOR($id);
        if ($success) {
            echo "<script>alert('SOR deletado com sucesso'); window.location='../../index.php?page=sor';</script>";
        } else {
            echo "<script>alert('Falha ao deletar SOR.'); window.location='../../index.php?page=sor';</script>";
        }
    }
    else {
        echo "<script>alert('Abreviação é necessária.'); window.location='../../index.php?page=sor';</script>";
    }
}
else {
    echo "<script>alert('Método de requisição inválido.'); window.location='../../index.php?page=sor';</script>";
}