<?php
session_start();

require_once 'src/auth/Totp.php';
require_once 'src/auth/BackupCodeService.php';
require_once 'src/db/Database.php';

$t = new Totp();

$user = $_SESSION['2fa_setup'];
$secret = $_SESSION['tmp_secret'];

if ($t->verify($secret, $_POST['code'])) {

    $db = Database::getConnection();

    $db->prepare("
        UPDATE usuario SET totp_secret=?, totp_enabled=true WHERE id=?
    ")->execute([$secret, $user['id']]);

    $backup = new BackupCodeService();
    $codes = $backup->generate($user['id']);

} else {
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
            <h3>Guarde esses códigos:</h3>
            <ul>
                <?php 
                    foreach ($codes as $c) echo "<li>$c</li>"; 
                    unset($_SESSION['2fa_setup'], $_SESSION['tmp_secret']);
                ?>
            </ul>
            <a href="index.php" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i> Continuar
            </a>
        </div>
    </div>
</div>

</body>
</html>