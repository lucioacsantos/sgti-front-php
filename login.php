<?php
session_start();

require_once 'src/auth/LdapAuth.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new LdapAuth();
    $user = $auth->authenticate($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuário ou senha inválidos";
    }
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
            <h4 class="mb-3">Login</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="username" class="form-control mb-2" placeholder="Usuário" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Senha" required>
                <button class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>