<?php 
print "<!DOCTYPE html>";
include_once 'include.inc.php';

require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

    $login = new Login();
    
    //var_dump($_SESSION);

    //$login->Logado();
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
                <div class="container fdo_corpo">
                </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    
    </body>
    </html>