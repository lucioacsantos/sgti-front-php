<?php
session_start();

require_once 'src/auth/Totp.php';
require_once 'src/auth/BackupCodeService.php';

if (!isset($_SESSION['2fa_setup'])) exit;

$t = new Totp();

$secret = $t->createSecret();
$_SESSION['tmp_secret'] = $secret;

$qr = $t->getQR($_SESSION['2fa_setup']['username'], $secret);
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
            <h3>Configure 2FA</h3>
                <img src="<?= $qr ?>">
            <form method="POST" action="confirm_2fa.php">
                <input name="code" type="number" class="form-control mb-2" autofocus required >
                <button class="btn btn-primary w-100">Confirmar</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>