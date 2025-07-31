<?php session_start();
	print "<!DOCTYPE html>";
 	include_once 'include.inc.php';
 	
 	require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
 	
 	$_login = new Login();
 	
 	$_login->logado();
 	
 	$_usuario = new Usuario();


//if(!isset($_percentual)) {
	
	//$_percentual = Configura::Percentual();
	
//}


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
	<div class="container fdo_corpo">
		<legend>Configurações Gerais do Sistema</legend>

		<form action="#" method="POST" name="frm_configura">

			<label>Percentual</label>
			<input type="text" name="txt_percentual" id="txt_percentual" value="<?php print PERCENTUAL ;?>">
			
			
		</form>
		
		<label>Cadastro de Usuário</label>
		<a class="btn" href="secao.php?secao=usuario&acao=cadastrar">Cadastro</a>
		<br>
		<br>
		<br>
		
		<legend>Alterar Usuario </legend>
		
		
		<?php $_usuario->ComboNomeUsuario(); ?>
		
	</div>
	<!-- RODAPE -->
	<div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script>

	$("#sel_usuario").change(function(){
		
        window.location = 'secao.php?secao=usuario&acao=cadastrar&id=1&user=$_txt_email';
		
});


	</script>
</body>
</html>