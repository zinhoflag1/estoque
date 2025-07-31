<?php session_start();
	print "<!DOCTYPE html>";
    include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

    $_estoque = new Estoque();

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
       <br />
       <legend class="text-center">Pesquisa Alteração Estoque</legend>

        <div class="row">

            <div class="spa12 fdo_corpo">

                <form action="secao.php?secao=estoque&acao=buscarAlterar" method="POST" name="frm_cliente">
                    <div class="controls controls-row">
                        <input class="span7" type="text" placeholder="Digite o Nome do Produto em Estoque" name="txt_nome">
                        <button type="submit" class="btn" name="btn_enviar" value="btn_enviar">Pesquisar</button>
                    </div>
                </form>

                <?php

                    $_enviar = isset($_POST['btn_enviar']) ? true : "";

                    $_nome   = isset($_POST['txt_nome']) ? $_POST['txt_nome'] : "";

                    if($_enviar){

                        $_estoque->BuscarEstoqueNomeId($_nome);

                    }
                ?>
            </div>

        </div>
        
    </div>
<!-- RODAPE -->
<div class="container">
    <?php include_once 'pagina.rodape.php';?>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
</body>
</html>