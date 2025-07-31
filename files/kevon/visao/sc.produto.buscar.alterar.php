<?php session_start();
    header("Cache-Control: no-cache, must-revalidate");
    include_once 'include.inc.php';
    print "<!DOCTYPE html>";

        require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
        
        $_login = new Login();
        
        $_login->logado();

        $_produto = new Produto();

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
                     <br />
                    <form action="secao.php?secao=produto&acao=buscarAlterar" method="POST" name="frm_cliente">
                    <legend class="text-center">Pesquisa Produto</legend>
                    <div class="controls controls-row">
                        <input class="span7" type="text" placeholder="Digite Nome para Pesquisar" name="txt_nome">
                        <button type="submit" class="btn" name="btn_enviar">Pesquisar</button>
                    </div>
                    </form>
                    <?php

                       $_enviar = isset($_POST['btn_enviar']) ? true : "";
                       $_nome   = isset($_POST['txt_nome']) ? $_POST['txt_nome'] : "";

                       if($_enviar){
                           
                           $_produto->BuscarProdutoNomeId($_nome);

                       }
                    ?>
               </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
                                    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    </body>
    </html>
