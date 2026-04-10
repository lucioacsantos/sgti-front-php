<?php
session_start();

require_once 'src/auth/LdapAuth.php';
require_once 'src/auth/UserService.php';
require_once 'src/auth/AuthService.php';

// =========================
// PROCESSAMENTO LOGIN
// =========================

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $error = "Informe usuário e senha";
    } else {

        try {
            $ldap = new LdapAuth();
            $userService = new UserService();

            // 🔐 autenticação LDAP
            $ldapUser = $ldap->authenticate($username, $password);

            if (!$ldapUser) {
                $error = "Usuário ou senha inválidos";
            } else {

                // 🧠 grupos (evita undefined)
                $groups = $ldapUser['groups'] ?? [];

                // 🔥 normaliza
                $groups = array_map('strtoupper', $groups);

                // 👤 cria/busca usuário local
                $user = $userService->findOrCreate($ldapUser);

                // 🔐 role baseado em grupo
                $role = AuthService::mapRole($groups);

                // 🔴 bloqueio
                if ($role === 'none') {
                    $error = "Usuário sem acesso ao sistema";
                } else {

                    // salva dados completos
                    $user['groups'] = $groups;
                    $user['role'] = $role;

                    // =========================
                    // 2FA OBRIGATÓRIO
                    // =========================

                    if (!$user['totp_enabled']) {
                        $_SESSION['2fa_setup'] = $user;
                        header("Location: setup_2fa.php");
                        exit;
                    }

                    $_SESSION['2fa_pending'] = $user;
                    header("Location: verify_2fa.php");
                    exit;
                }
            }

        } catch (Exception $e) {
            $error = "Erro ao autenticar: " . $e->getMessage();
        }
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

        <div class="card shadow p-4">
            <h4 class="mb-3 text-center">CMDB Login</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="username" class="form-control mb-2" placeholder="Usuário" autofocus required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Senha" required>
                <button class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>