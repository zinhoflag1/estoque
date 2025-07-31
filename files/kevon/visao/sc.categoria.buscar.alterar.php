    <!DOCTYPE html>
    <?php include_once 'include.inc.php';

    $Conexao = new Conexao();

    $_categoria = new Categoria();

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
                    <form action="#" method="POST" name="frm_cliente">
                    <fieldset>
                    <legend class="text-center">Pesquisa Categoria Produto</legend>
                    <div class="controls controls-row">
                        <input class="span7" type="text" placeholder="Digite Nome para Pesquisar" name="txt_nome">
                        <button type="submit" class="btn" name="btn_enviar">Pesquisar</button>
                    </div>

                    </fieldset>
                    </form>
                    <?php

                       $_enviar = isset($_POST['btn_enviar']) ? true : "";

                       $_nome   = isset($_POST['txt_nome']) ? $_POST['txt_nome'] : "";

                       if($_enviar){

                           $_categoria->BuscarCategoriaNomeId($_nome);

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