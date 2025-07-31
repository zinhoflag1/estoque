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
	<div class="fdo_corpo">
		<br />
		<form action="secao.php?secao=cliente&acao=buscarAlterar" method="POST" name="frm_cliente">
			<legend class="text-center">Pesquisa Cliente</legend>
			<div class="controls controls-row">
				<input class="span7" type="text" placeholder="Digite Nome para Pesquisar" name="txt_nome">
				<button type="submit" class="btn" name="btn_enviar">
					Pesquisar <i class="icon-search"></i>
				</button>
			</div>
		</form>
		<div class="span8">
            <?php
												
												$_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
												$_nome = isset ( $_POST ['txt_nome'] ) ? $_POST ['txt_nome'] : "";
												
												if ($_enviar) {
													
													$cliente = new Cliente ();
													
													$cliente->BuscarClienteNomeId ( $_nome );
												}
												?>
        </div>
	</div>
	<!-- RODAPE -->
	<div class="container">
        <?php include_once 'pagina.rodape.php';?>
    </div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script language="JavaScript">
		function abrirPopup(url,w,h) {
			var newW = w + 100;
			var newH = h + 100;
			var left = (screen.width-newW)/2;
			var top = (screen.height-newH)/2;
			var newwindow = window.open(url, 'name', 'width='+newW+',height='+newH+',left='+left+',top='+top);
			newwindow.resizeTo(newW, newH);
			 
			//posiciona o popup no centro da tela
			newwindow.moveTo(left, top);
			newwindow.focus();
			return false;
			}
	</script>
</body>
</html>