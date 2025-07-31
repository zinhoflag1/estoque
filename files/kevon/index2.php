<?php session_start();
print "<!DOCTYPE html>";
include_once 'include.inc.php';
require_once 'classe/Classe.Conexao.php';

$conexao = ConexaoPDO::getInstance();

$login = new Login();

$login->Logado();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title><?php print TITULO; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Estilos customizados para o layout */
        body {
            background-color: #f4f7f6;
            /* Um cinza claro suave para o fundo */
        }

        .wrapper {
            display: flex;
            /* Habilita flexbox para sidebar e conteúdo */
            width: 100%;
            min-height: 100vh;
            /* Garante que o conteúdo ocupe toda a altura da viewport */
        }

        /* Sidebar */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #34495e;
            /* Azul petróleo escuro */
            color: #fff;
            transition: all 0.3s;
            /* Transição suave ao expandir/colapsar */
            position: sticky;
            /* Fixa o sidebar enquanto o conteúdo rola */
            top: 0;
            left: 0;
            height: 100vh;
            /* Ocupa toda a altura da viewport */
            overflow-y: auto;
            /* Permite rolagem se o menu for grande */
            padding-top: 20px;
        }

        #sidebar.active {
            margin-left: -250px;
            /* Esconde a sidebar */
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #2c3e50;
            /* Um tom um pouco mais escuro para o cabeçalho do sidebar */
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 10px 20px;
            font-size: 1.1em;
            display: block;
            color: #ecf0f1;
            /* Branco/cinza claro para links */
            text-decoration: none;
            transition: all 0.3s;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: #3a536e;
            /* Um tom ligeiramente mais claro ao passar o mouse */
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #007bff;
            /* Azul padrão do Bootstrap para ativo */
        }

        /* Content */
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Navbar top (header) */
        .navbar-top {
            background-color: #ffffff;
            /* Branco para o cabeçalho superior */
            border-bottom: 1px solid #e0e0e0;
            /* Linha sutil na parte inferior */
            padding: 1rem 1.5rem;
            margin-bottom: 20px;
            /* Espaço entre o cabeçalho e o conteúdo principal */
        }

        /* Botão de toggle para sidebar */
        #sidebarCollapse {
            background: none;
            border: none;
            color: #34495e;
            /* Cor do ícone para combinar com o sidebar */
            font-size: 1.5em;
            cursor: pointer;
        }

        #sidebarCollapse:focus {
            outline: none;
            box-shadow: none;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                /* Esconde a sidebar em telas pequenas */
                position: fixed;
                /* Fixa para não rolar com o conteúdo */
                height: 100vh;
                z-index: 1000;
                /* Garante que fique acima de outros elementos */
            }

            #sidebar.active {
                margin-left: 0;
                /* Mostra a sidebar quando ativa */
            }

            #content {
                width: 100%;
                /* Conteúdo ocupa 100% da largura */
                padding: 15px;
                /* Ajusta o padding para telas menores */
            }

            #sidebarCollapse {
                display: block;
                /* Garante que o botão de toggle apareça */
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><?php print TITULO; ?></h3>
            </div>

            

            <ul class="list-unstyled components">

                <?php include_once 'visao/pagina.menu.php'; ?>
            </ul>
        </nav>

        <div id="content" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-top shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info d-block d-md-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-flex align-items-center w-100 justify-content-end">
                        <?php include_once 'visao/pagina.cabecalho.php'; ?>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mt-3 mb-4">
                <?php include_once 'visao/pagina.barraVersao.php'; ?>
                <hr>
            </div>

            <div class="container-fluid">
                <div class="card shadow-sm p-4">
                    <h3>Bem-vindo ao Sistema!</h3>
                    <p>Este é o corpo principal da sua aplicação. Você pode substituir este texto pelo conteúdo dinâmico da sua página.</p>
                    <p>Aqui você pode adicionar formulários, tabelas, gráficos, ou qualquer outro elemento necessário.</p>
                    <div>
                        Conteúdo da página: *
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-5">
                <?php include_once 'visao/pagina.rodape.php'; ?>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // JavaScript para o toggle da sidebar
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarCollapse = document.getElementById('sidebarCollapse');
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');

            if (sidebarCollapse) {
                sidebarCollapse.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    content.classList.toggle('active'); // Opcional: para ajustar o conteúdo se a sidebar colapsar
                });
            }

            // Opcional: Fecha a sidebar em telas pequenas ao clicar fora dela
            // (Requer mais lógica se o overlay for complexo)
            // Ou se preferir que ela feche ao redimensionar para desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 769) { // Acima de telas pequenas
                    sidebar.classList.remove('active');
                    content.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>