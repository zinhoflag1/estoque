<?php session_start ();
print "<!DOCTYPE html>";
include_once 'include.inc.php';

require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_login = new Login();

$_login->logado();

$_relatorio = new Relatorio();

$_tipo = isset($_GET['op']) ? $_GET['op'] : "";

// busca de pedido em aberto
if($_tipo == "0"){

	$_url_acao = "rel/sc.relatorio.pedido.aberto.php";
	$_titulo_pagina = "Relatório de Pedido em Aberto";
	
}
// busca de pedido Quitado
if($_tipo == "1"){

	$_url_acao = "rel/sc.relatorio.pedido.quitado.php";
	$_titulo_pagina = "Relatório de Pedido Quitado";

}



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
	<div class="container">
		<hr>
	</div>
	<!-- MENU -->
	<div class="container">
               <?php include_once 'pagina.menu.php';?>
            </div>
	<!-- CORPO -->
	<div class="container">
		<legend><?php print $_titulo_pagina; ?></legend>
		<form action="<?php print $_url_acao;?>" method="POST" name="frm_pesquisa">
			<br />

			<label>Data Inicial</label>
			<input type="text" name="txt_dt_inicial" id="txt_dt_inicial" data-mask="99/99/9999"></input>

			<label>Data Final</label>
			<input type="text" name="txt_dt_final" id="txt_dt_final" data-mask="99/99/9999"></input>
			<br />

			<input type="submit" class="btn" name="btn_enviar" title="Pesquisar Pedido em Aberto" value="Pesquisar">

		</form>

	</div>
	<!-- RODAPE -->
	<div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
</body>
</html>