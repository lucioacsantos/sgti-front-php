<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário Técnico OCP/IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar vh-100 text-white p-3">
            <h4><i class="bi bi-box-seam"></i> Inventário</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="?page=host" class="nav-link text-white"><i class="bi bi-pc-display"></i> Hosts</a></li>
                <!--<li class="nav-item"><a href="?page=ambiente" class="nav-link text-white"><i class="bi bi-cloud"></i> Ambientes</a></li>
                <li class="nav-item"><a href="?page=ocp_cluster" class="nav-link text-white"><i class="bi bi-hdd-stack"></i> OCP Clusters</a></li>-->
                <li class="nav-item"><a href="?page=aplicacao" class="nav-link text-white"><i class="bi bi-cpu"></i> Aplicações</a></li>
                <!--class="nav-item"><a href="?page=servico" class="nav-link text-white"><i class="bi bi-gear-wide-connected"></i> Serviços/Portas</a></li>-->
            </ul>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>