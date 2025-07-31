<!DOCTYPE html>
<?php include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

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
		<legend>Cadastro Permissao de Usuário</legend>

		<form action="#" method="POST" name="frm_cad_usuario">

			<label>Cadastro Cliente</label><input type="checkbox" name="cad_cliente" id="cad_cliente" title="">

			<label>Cadastro Vendedor</label><input type="checkbox" name="cad_vendedor" id="cad_vendedor" title="">

			<label>Cadastro Produto</label><input type="checkbox" name="cad_produto" id="cad_produto" title="">

			<label>Cadastro Categoria</label><input type="checkbox" name="cad_linha" id="cad_linha" title="">

			<label>Cadastro Pedido</label><input type="checkbox" name="pedido" id="pedido" title="">

			<label>Cadastro Estoque</label><input type="checkbox" name="estoque" id="estoque" title="">

			<label>Posição Estoque</label><input type="checkbox" name="posicao_estoque" id="posicao_estoque" title="">

			<label>Tabela de Preço</label><input type="checkbox" name="tabela_preco" id="tabela_preco" title="">

			<label>Configuração</label><input type="checkbox" name="configuracao" id="configuracao" title="">

			<label>Gerar Pedido</label><input type="checkbox" name="gerapedido" id="gerapedido" title="">

			<label>Fechar Pedido</label><input type="checkbox" name="fechapedido" id="fechapedido" title="">

			<label>Cadastro Rota</label><input type="checkbox" name="rota" id="rota" title="">

			<label>Relatório Posição Pedido</label><input type="checkbox" name="pos_pedido" id="pos_pedido" title="">

			<label>Resumo de Contas</label><input type="checkbox" name="resumo" id="resumo" title="">
			
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