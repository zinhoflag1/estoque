<?php session_start();
    header("Cache-Control: no-cache, must-revalidate");
    print "<!DOCTYPE html>";
    include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

    $_linha = new Linha();

    $_funcaoBase = new FuncaoBase();

    $dados = $_linha->BuscarLinhaNomeAlterar($_id_linha);

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
                    <form action="secao1.php?secao=linhaAlterar" method="POST" name="frm_cad_linha">
                            <legend>Alterar Cadastro de Linha de Produtos</legend>


                                <input class="" type="hidden" name="txt_id_linha" value="<?php print $_GET['id'];?>">
                                <input class="span8" type="text" placeholder="Nome Linha" name="txt_nome" value="<?php print $dados[0]['nome'];?>">
                                <br />

                                <button type="submit" class="btn" name="btn_enviar">Alterar</button>
                    </form>
                    <?php $_funcaoBase->espaco(20);?>
                </div
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    </body>
    </html>