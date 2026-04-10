<?php
session_start();

require_once 'src/auth/Totp.php';
require_once 'src/auth/BackupCodeService.php';

if (!isset($_SESSION['2fa_pending'])) exit;

$t = new Totp();
$backup = new BackupCodeService();

$user = $_SESSION['2fa_pending'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $code = $_POST['code'];

    if (
        $t->verify($user['totp_secret'], $code) ||
        $backup->verify($user['id'], $code)
    ) {
        $_SESSION['user'] = $user;
        unset($_SESSION['2fa_pending']);
        header("Location: index.php");
        exit;
    }

    echo "Código inválido";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login CMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-4 offset-md-4">
        <div class="card p-4 shadow">
            <h3>Digite o código 2FA</h3>
            <form method="POST">
                <input name="code" type="number" class="form-control mb-2" autofocus required>
                <button class="btn btn-primary w-100">Validar</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>