<?php session_start();
	print "<!DOCTYPE html>";
	
    include_once 'include.inc.php';
    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_vendedor = new Vendedor();
    
    $_login = new Login();
    
    $_login->logado();

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
                    <form action="secao1.php?secao=vendedor" method="POST" name="frm_cadastroVendedor">
                        <legend>Cadastro de Vendedores</legend>
                            <div class="controls controls-row">
                                <input class="span8" type="text" placeholder="Nome" title="Nome do Vendedor" name="txt_nome"> 
                                <input class="span4" type="text" placeholder="CPF" data-mask="999.999.999-99" title="CPF do Vendedor" name="txt_cpf">
                            </div>
                                
                            <div class="controls controls-row">
                                <input class="span3" type="text" placeholder="Carteira de Identidade" title="Carteira de Identidade do Vendedor" name="txt_ci">
                                <input class="span6" type="text" placeholder="Endereco" title="Endereço do Vendedor" name="txt_endereco">
                                <input class="span3" type="text" placeholder="Bairro" title="Bairro do Vendedor" name="txt_bairro">
                            </div>
                            
                            <div class="controls controls-row">
                                <input class="span3" type="text" placeholder="Cidade" title="Cidade do Vendedor" name="txt_cidade">
                                <input class="span3" type="text" placeholder="Estado" title="Estado do Vendedor" name="txt_estado" data-mask="aa">
                                <input class="span3" type="text" placeholder="Cep" data-mask="99999-999" title="Cep do Vendedor" name="txt_cep">
                                <input class="span3" type="text" placeholder="Data Nascimento" data-mask="99/99/9999" title="Data de Nascimento do Vendedor" name="txt_dt_nasc">
                            </div>

                            <div class="controls controls-row">
                                <input class="span2" type="text" placeholder="Telefone1" data-mask="(99)9999-9999" title="Telefone 1 do Vendedor" name="txt_tel1">
                                <input class="span2" type="text" placeholder="Telefone2" data-mask="(99)9999-9999" title="Telefone 2 do Vendedor" name="txt_tel2">
                                <input class="span2" type="text" placeholder="Telefone3" data-mask="(99)9999-9999" title="Telefone 3 do Vendedor" name="txt_tel3">
                                <input class="span6" type="text" placeholder="Email" title="Email do Vendedor" name="txt_email">
                            </div>
                            <br />
                            <button type="submit" class="btn" name="btn_enviar">Cadastrar</button>
                    </form>
                    <div class="row text-right">Total Registros :<?php print $_vendedor->totalVendedor();?></div>
    


                </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
                                    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    </body>
    </html>


    