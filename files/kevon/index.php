<!DOCTYPE html>
<?php
include_once 'config.inc.php';
?>
<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid">
			<!-- TOPO -->
			<div class="span2"></div>
			<div class="span10">
				<br />
				<br />
				<br />
				<br /> <img src="img/topo1.png" width="300px" heigth="100px;">
				<h4>Web Administrator</h4>

				<br />
				<br />
				<br />
			</div>

		</div>
		<!-- CONTEUDO-->
		<div class="row">
			<div class="row">
				<div class="span5"></div>
				<div class="span2">
					<h4>Login</h4>
				</div>
				<div class="span5"></div>
			</div>
			<div class="span4"></div>
			<form action="secao.php?secao=login&acao=logar" method="POST" name="frm_logar">
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="txt_usuario">Usuário</label>
						<div class="controls">
							<input type="text" id="txt_usuario" name="txt_usuario" placeholder="Usuário">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="txt_senha">Password</label>
						<div class="controls">
							<input type="password" id="txt_senha" name="txt_senha" placeholder="Password">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox">
								Lembrar
							</label>
							<button type="submit" class="btn" title="Acesso ao Sistema">Entrar</button>
						</div>
					</div>
				</div>
			</form>
			<div class="span4"></div>
		</div>
		<div class="row">
			<div class="span12"></div>
		</div>


	</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
</body>
</html>