<?php session_start();
    print "<!DOCTYPE html>";
    include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_login = new Login();
    
    $_login->logado();

    $_relatorio = new Relatorio();

    ?>
    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" >
    <style>
 
@media print
{
    * {font-size: 10px;}

    .imprimir {

        display: none;
    }

}


</style>
    
    </head>
    <body>
        <!-- CABECALHO -->
        <div class="container">
            <div class="row">
                <?php include_once 'pagina.cabecalho.php';?>
            </div>
            <?php include_once 'pagina.barraVersao.php';?>
            <div class="row">
                <hr>
            </div>
            <!-- MENU -->
            <div class="row">
                    <?php include_once 'pagina.menu.php';?>

            </div>
                <!-- CORPO -->
                <div class="row">
                    <div class="span2"></div>
                    <div class="span8 text-center">
                        <br /></br />
                        <legend>Tabela de Preços</legend>

                        <?php $_relatorio->RelatorioTabelaPreco();?>
                    </div>
                    <div class="span2"></div>
                </div>    
                    <!-- RODAPE -->
                    <div class="row">
                        <div class="span12">
                            <?php include_once 'pagina.rodape.php';?>
                        </div>
                    </div>
        </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    </body>
    </html>