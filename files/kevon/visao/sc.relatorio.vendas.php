<?php session_start();
    print "<!DOCTYPE html>";
    include_once 'include.inc.php';
    
    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
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
    <body onload="javascript:pessoa();">
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

     		<form action="secao.php?" method="POST" name="frm_relatorio_venda" >
     			<div class="row">
     			<div class="span6">
     				Opções do Relatório<p>
     				<label>Data Inicial</label>
				<input class="" type="text" name="" id="" data-mask="99/99/9999">

				<label>Data Final</label>
				<input class="" type="text" name="" id="" data-mask="99/99/9999">

				<label>Cliente</label>
				<input class="" type="radio" name="" id="" value="">

				<label>Nome Cliente</label>
				<input class="" type="text" name="" id="" value=""><button class="btn" type="button" name="btn_pesquisa" id="btn_pesquisa" >Pesquisar</button>

				<label>Produto<label>
				<input class="" type="radio" name="" id="" value="">
				<br />
				<label>Nome Cliente</label>
				<input class="" type="text" name="" id="" value=""><button class="btn" type="button" name="btn_pesquisa" id="btn_pesquisa" >Pesquisar</button>
				<br />

     			</div>
     			<div class="span6">
     				Situação do Pedido<p>
     				Fechado<input type="radio" name="rdb_fechado" id="rdb_fechado" value="0"><br /> 
     				Aberto<input type="radio" name="rdb_aberto" id="rdb_aberto" value="1"> 
     				Cancelado<input type="radio" name="rdb_cancelado" id="rdb_cancelado" value="2"> 

     			</div>
     		</div>
		

		
		<br />
		<button class="btn" type="submit" name="btn_envia" id="btn_envia" >Visualizar</button>

		</form>
	</div>
	<!-- RODAPE -->
	<div class="container">
	    <?php include_once 'visao/pagina.rodape.php';?>
	</div>

	<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
<script type="text/javascript">

<?php

$_relatorio = new Relatorio();


$dados = $_relatorio->RelatorioVendas();




?>