<?php session_start();
	print "<!DOCTYPE html>";
    include_once 'include.inc.php';
    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
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
                <div class="container">
                    <br />
                    <form action="secao1.php?secao=linha" method="POST" name="frm_cad_linha">

                            <legend>Cadastro de Linha de Produtos</legend>

                                <input class="span8" type="text" title="Nome da Categoria de Produtos" placeholder="Nome Categoria de Produtos" name="txt_nome">
                                <br />
                            <br />
                            <button type="submit" class="btn" name="btn_enviar" title="Cadastrar Categoria de Produtos">Cadastrar</button>

                    </form>
                    <div class="row text-right">Total Registros :<?php print $_linha->totalLinha();?></div>
    
                    <?php 
                    $_funcaoBase = new FuncaoBase();

                    $_funcaoBase->espaco(20);

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
