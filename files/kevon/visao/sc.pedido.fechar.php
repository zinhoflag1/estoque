<?php session_start();
    header("Cache-Control: no-cache, must-revalidate");
    print "<!DOCTYPE html>";
    include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_login = new Login();
    
    $_login->logado();


   /*#######################################################################################################################

                                                    FECHAR PEDIDO

    #######################################################################################################################*/


    ?>
    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <!-- CABECALHO -->
        <div class="container">
            <?php include_once 'pagina.cabecalho.php';?>
        </div>
        <div class="container">
            <?php include_once 'pagina.barraVersao.php';?>
        </div>
        <div class="container"><hr></div>
            <!-- MENU -->
            <div class="container">
               <?php include_once 'pagina.menu.php';?>
            </div>
                <!-- CORPO -->
                <div class="container">
                    <form action="secao1.php?secao=pedido" method="POST" name="frm_pedido_cadastrar">
                        <legend>Fechar Pedido</legend>

                        </form>
                </div>
                    <!-- RODAPE -->
                    <div class="container">
                        <br /><br /><br /><br /><br /><br /><br />
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

    <script src="<?php print SISTEMA;?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    </body>
    </html>