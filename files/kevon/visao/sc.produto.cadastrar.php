<?php session_start();
	print "<!DOCTYPE html>";
	
    include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_produto = new Produto();
    
    $_login = new Login();
    
    $_login->logado();

    $_linha = new Linha();

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
                    <form action="secao1.php?secao=produto" method="POST" name="frm_cad_produto">

                        <legend>Cadastro de Produto</legend>

                            <input class="" type="text" title="Nome do Produto" placeholder="Nome Produto" name="txt_nome">
                            <br />
                            <input class="" type="text" title="Volume do Produto" placeholder="Volume" name="txt_volume" maxlength="10">
                            <br />
                            <?php $_linha->ComboLinha();?>
                        <br />
                        <button type="submit" class="btn" name="btn_enviar" title="Cadastrar Produto">Cadastrar</button>

                    </form>
                    <div class="row text-right">Total Registros :<?php print $_produto->totalProduto();?></div>
    

                </div>
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    </body>
    </html>