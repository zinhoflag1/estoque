<?php session_start();
	header("Cache-Control: no-cache, must-revalidate");
	print "<!DOCTYPE html>";
	include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_login = new Login();
    
    $_login->logado();

    $_produto = new Produto();

    $_linha = new Linha();

    $dados = $_produto->BuscarProdutoNomeAlterar($_id_produto);

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
                    <form action="secao1.php?secao=produtoAlterar" method="POST" name="">
                        <fieldset>
                            <legend>Alterar Cadastro de Produto</legend>

                                <input class="" type="hidden" name="txt_id_produto" value="<?php print $dados[0]['id_produto']; ?>">
                                
                                <input class="" type="text" placeholder="Nome Produto" name="txt_nome" value="<?php print $dados[0]['nome'];?>" title="Nome do Produto">
                                <br />
                                <input class="" type="text" placeholder="Volume" name="txt_volume" value="<?php print $dados[0]['volume']; ?>" title="Volume" maxlength="10">
                                <br />
                                <?php $_linha->ComboLinha($dados[0]['id_linha']);?>
                            <br />
                            <button type="submit" class="btn" name="btn_enviar">Alterar</button>
                        </fieldset>
                    </form>

                </div>
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    </body>
    </html>