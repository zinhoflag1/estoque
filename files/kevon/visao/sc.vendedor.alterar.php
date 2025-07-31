<?php session_start();
	header("Cache-Control: no-cache, must-revalidate");
	print "<!DOCTYPE html>";
	include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_login = new Login();
    
    $_login->logado();

    $_vendedor = new Vendedor();
    
    $dados = $_vendedor->BuscarVendedorNomeAlterar($_id_vendedor);

    
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
                    <form action="secao1.php?secao=vendedorAlterar" method="POST" name="frm_alterarVendedor">
                        <fieldset>
                            <legend>Alterar Cadastro Vendedor</legend>
                                <div class="controls controls-row">
                                    <input type="hidden" name="id_vendedor" value="<?php print $dados[0]['id_vendedor'];?>">
                                    <input class="span8" type="text" placeholder="Nome" value="<?php print $dados[0]['nome'];?>" title="Re-digite o Nome do Vendedor " name="txt_nome"> 
                                    <input class="span4" type="text" placeholder="CPF" value="<?php print $dados[0]['cpf'];?>" title="Re-digite o CPF do Vendedor" data-mask="999.999.999-99" name="txt_cpf">
                                </div>
                                    
                                <div class="controls controls-row">
                                    <input class="span3" type="text" placeholder="Carteira de Identidade" value="<?php print $dados[0]['ci'];?>" title="Re-digite a Carteira de Identidade do Vendedor" name="txt_ci">
                                    <input class="span6" type="text" placeholder="Endereco" value="<?php print $dados[0]['endereco'];?>" title="Re-digite o Endereço do Vendedor" name="txt_endereco">
                                    <input class="span3" type="text" placeholder="Bairro" value="<?php print $dados[0]['bairro'];?>" title="Re-digite o Bairro do Vendedor" name="txt_bairro">
                                </div>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" placeholder="Cidade" value="<?php print $dados[0]['cidade'];?>" title="Re-digite a Cidade do Vendedor" name="txt_cidade">
                                    <input class="span3" type="text" placeholder="Estado" value="<?php print $dados[0]['estado'];?>" title="Re-digite o Estado do Vendedor" data-mask="aa" name="txt_estado" >
                                    <input class="span3" type="text" placeholder="Cep" value="<?php print $dados[0]['cep'];?>" title="Re-digite o CEP do Vendedor" data-mask="99999-999" name="txt_cep">
                                    <input class="span3" type="text" placeholder="Data Nascimento" value="<?php print $dados[0]['dt_nasc'];?>" title="Re-digite a Data de Nascimento do Vendedor" data-mask="99/99/9999" name="txt_dt_nasc">
                                </div>

                                <div class="controls controls-row">
                                    <input class="span2" type="text" placeholder="Telefone1" value="<?php print $dados[0]['tel1'];?>" title="Re-digite o Telefone 1 do Vendedor" data-mask="(99)9999-9999" name="txt_tel1">
                                    <input class="span2" type="text" placeholder="Telefone2" value="<?php print $dados[0]['tel2'];?>" title="Re-digite o Telefone 2 do Vendedor" data-mask="(99)9999-9999" name="txt_tel2">
                                    <input class="span2" type="text" placeholder="Telefone3" value="<?php print $dados[0]['tel3'];?>" title="Re-digite o Telefone 3 do Vendedor" data-mask="(99)9999-9999" name="txt_tel3">
                                    <input class="span6" type="text" placeholder="Email" value="<?php print $dados[0]['email'];?>" title="Re-digite o Email do Vendedor" name="txt_email">
                                </div>
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
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    </body>
    </html>