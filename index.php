<?php
session_start();

// Autenticação e autorização
/* require_once 'src/auth/AuthService.php';

// exige leitura mínima
AuthService::requireRead();

$user = $_SESSION['user']; */

/* Usuário de desenvolvimento - sempre admin */
$user = [
    'username' => 'admin',
    'role' => 'cmdb-admin'
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGTI ::: CMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar vh-100 text-white p-3">
            <h4><i class="bi bi-box-seam"></i> SGTI ::: CMDB</h4>
            <hr>
            <div class="accordion accordion-flush" id="accordionMenu">
                <div class="accordion-item bg-dark border-secondary">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdministracao">
                            <i class="bi bi-gear"></i> Administração
                        </button>
                    </h2>
                    <div id="collapseAdministracao" class="accordion-collapse collapse" data-bs-parent="#accordionMenu">
                        <div class="accordion-body p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="?page=ambiente" class="nav-link text-white-50 ps-4"><i class="bi bi-people"></i> Ambiente</a></li>
                                <li class="nav-item"><a href="?page=criticidade" class="nav-link text-white-50 ps-4"><i class="bi bi-people"></i> Criticidade</a></li>
                                <li class="nav-item"><a href="?page=relacionamentos" class="nav-link text-white-50 ps-4"><i class="bi bi-people"></i> Relacionamentos</a></li>
                                <li class="nav-item"><a href="?page=sor" class="nav-link text-white-50 ps-4"><i class="bi bi-people"></i> Sistemas operacionais</a></li>
                                <li class="nav-item"><a href="?page=status" class="nav-link text-white-50 ps-4"><i class="bi bi-lock"></i> Status</a></li>
                                <li class="nav-item"><a href="?page=tipos" class="nav-link text-white-50 ps-4"><i class="bi bi-people"></i> Tipos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-dark border-secondary">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInventario">
                            <i class="bi bi-collection"></i> Inventário
                        </button>
                    </h2>
                    <div id="collapseInventario" class="accordion-collapse collapse" data-bs-parent="#accordionMenu">
                        <div class="accordion-body p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="?page=host" class="nav-link text-white-50 ps-4"><i class="bi bi-pc-display"></i> Hosts</a></li>
                                <li class="nav-item"><a href="?page=aplicacao" class="nav-link text-white-50 ps-4"><i class="bi bi-cpu"></i> Aplicações</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <?php
                require_once 'main.php';

                $page = $_GET['page'] ?? 'host';
                
                if ($page == 'host'):
                    $hosts = getHostsView();
                    include 'views/hosts.php';
                
                elseif ($page == 'aplicacao'):
                    $aplicacoes = getAplicacoesView();
                    include 'views/aplicacoes.php';

                elseif ($page == 'ambiente'):
                    $ambientes = getAllAmbiente();
                    include 'views/ambientes.php';

                elseif ($page == 'criticidade'):
                    $criticidades = getAllCriticidade();
                    include 'views/criticidades.php';

                elseif ($page == 'relacionamentos'):
                    $relacionamentos = getAllTipoRelacionamento();
                    include 'views/relacionamentos.php';

                elseif ($page == 'sor'):
                    $sor = getAllSOR();
                    include 'views/sor.php';

                elseif ($page == 'status'):
                    $status = getAllStatusAtivo();
                    include 'views/status.php';

                elseif ($page == 'tipos'):
                    $tipos = getAllTipoAtivo();
                    include 'views/tipos.php';

                else:
                    print('<h2><i class="bi bi-exclamation-triangle"></i> Página não encontrada</h2>');
                endif;
            ?>
        </main>
    </div>
</div>
                

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearSearch');
    // Selecionamos apenas as linhas do corpo da tabela de Hosts
    const tableRows = document.querySelectorAll('tbody tr');

    function filterTable(term) {
        const searchTerm = term.toLowerCase();
        
        tableRows.forEach(row => {
            // Extraímos o texto das colunas Hostname (1ª) e Área (3ª)
            const hostname = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase() || "";
            const area = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || "";
            
            // Verificamos se o termo de busca está presente em qualquer uma das duas
            if (hostname.includes(searchTerm) || area.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        // Controle do botão de limpar
        if (clearBtn) {
            clearBtn.style.display = searchTerm.length > 0 ? "block" : "none";
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterTable(this.value);
        });

        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            filterTable('');
            searchInput.focus();
        });
    }
});
</script>

<script>
function logoutConfirm() {
    if (confirm("Deseja realmente sair?")) {
        window.location.href = "logout.php";
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>