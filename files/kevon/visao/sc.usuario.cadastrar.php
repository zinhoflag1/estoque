<?php session_start();
	print "<!DOCTYPE html>";
	include_once 'include.inc.php';

require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_login = new Login();

$_login->logado();

$_usuario = new Usuario();

$_permissao = new Permissao();

// if(!isset($_percentual)) {

// $_percentual = Configura::Percentual();

// }

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
		
	<div class="row">
		<div class="span6">
			<legend>Cadastro de Usuário</legend>
			<form action="#" method="POST" name="frm_cad_usuario">

				<label>Nome Completo</label>
				<input type="text" name="txt_nome" id="txt_nome">
				
				<label>email</label>
				<input type="text" name="txt_email" id="txt_email">

				<label>senha</label>
				<input type="password" name="txt_senha" id="txt_senha">
				
				<label>Lembrete</label>
				<input type="text" name="txt_lembrete" id="txt_lembrete">
				
				<label>Tipo</label>
				<select name="sel_tipo">
					<option value="0">Usuario</option>
					<option value="1">Gerente</option>
				</select>
				
				<label>Situação</label>
				<select name="sel_situacao">
					<option value="1">Ativo</option>
					<option value="0">Desativado</option>
				</select>
				<br />
				<input class="btn" type="submit" name="btn_cad_usuario" id="btn_cad_usuario" value="Cadastrar">
			</form>
		</div>
		<?php 
		
			//var_dump($_POST);
		
			$_cad_permissao = isset($_GET['id']) ? $_GET['id'] : "";
			
			if($_cad_permissao == 1){

			
			?>
		<div class="span6 pull-right">
		
			<form action="#" method="POST" name="frm_permissao">

			<legend>Cadastro Permissão Usuário</legend>

			<label class="checkbox">
				<input type="checkbox" name="cad_cliente" id="cad_cliente" value="1" title="Acesso ao Cadastro, Alteração de Clientes">
				Cadastro de Cliente
			</label>

			<label class="checkbox">
			Cadastro de Vendedor
			<input type="checkbox" name="cad_vendedor" id="cad_vendedor" value="1" title="Acesso ao Cadastro, Alteração de Vendedores">
			</label>

			<label class="checkbox">
			Cadastro de Produto
			<input type="checkbox" name="cad_produto" id="cad_produto" value="1" title="Acesso ao Cadastro Alteração de Produtos">
			</label>

			<label class="checkbox">
			Cadastro de Linha de Produto
			<input type="checkbox" name="cad_linha" id="cad_linha" value="1" title="Acesso ao Cadastro, Alteração de Linha de Produtos">
			</label>

			<label class="checkbox">
			Manutenção Estoque
			<input type="checkbox" name="estoque" id="estoque" value="1" title="Acesso ao Cadastro, Alteração Estoque">
			</label>

			<label class="checkbox">
			Relatório Posição Estoque
			<input type="checkbox" name="posicao_estoque" id="posicao_estoque" value="1" title="Acesso a Relatório de Posição Estoque">
			</label>

			<label class="checkbox">
			Relatório Tabela de Preço
			<input type="checkbox" name="tabela_preco" id="tabela_preco" value="1" title="Acesso a Tabela de Propdutos">
			</label>

			<label class="checkbox">
			Configuração do Sistema
			<input type="checkbox" name="configuracao" id="configuracao" value="1" title="Acesso ao Item Configuração do Sistema">
			</label>

			<label class="checkbox">
			Gerar Pedido
			<input type="checkbox" name="gerapedido" id="gerapedido" value="1" title="Acesso a Gerar Pedido de Clientes">
			</label>

			<label class="checkbox">
			Quitar Pedido
			<input type="checkbox" name="fechapedido" id="fechapedido" value="1" title="Acesso a Quitar Pedido de Clientes">
			</label>

			<label class="checkbox">
			Cadastro Rota
			<input type="checkbox" name="rota" id="rota" value="1" title="Acesso ao Cadastro, Alteração de Rota">
			</label>

			<label class="checkbox">
			Relatório Posição Pedido
			<input type="checkbox" name="pos_pedido" id="pos_pedido" value="1" title="Acesso ao Relatório de Posição de Pedido">
			</label>

			<label class="checkbox">
			Resumo de Contas
			<input type="checkbox" name="resumo" id="resumo" value="1" title="Acesso ao Resumo de Contas">
			</label>
			<br />
			<input class="btn" type="submit" name="btn_cad_permissao" id="btn_cad_permissao" value="Cadastrar Permissão">
			
			</form>
		</div>
		<?php 
		
		}
		
		?>
		<div class="row">
			<div class="span12">
			
				<?php 
				
				//var_dump($_POST);
				
				$_txt_nome        = isset($_POST['txt_nome'])        ? $_POST['txt_nome']        : "";
				$_txt_senha       = isset($_POST['txt_senha'])       ? $_POST['txt_senha']       : "";
				$_txt_email       = isset($_POST['txt_email'])       ? $_POST['txt_email']       : "";
				$_sel_tipo        = isset($_POST['sel_tipo'])        ? $_POST['sel_tipo']        : "";
				$_lembrete        = isset($_POST['txt_lembrete'])    ? $_POST['txt_lembrete']    : "";
				$_situacao        = isset($_POST['sel_situacao'])    ? $_POST['sel_situacao']    : "";
				$_btn_cad_usuario = isset($_POST['btn_cad_usuario']) ? true 				 : "";
				
					
				if($_btn_cad_usuario){

					if($_usuario->Cadastrar("-",
											$_txt_senha,
											$_txt_email,
											$_lembrete,
											$_sel_tipo,
											$_situacao,
											0,
											$_txt_nome)){


					print "<script type='text/javascript'>";
					
					print "alert('Cadastro Realizado com Sucesso !');";
					
					print "window.location = 'secao.php?secao=usuario&acao=cadastrar&id=1&user=$_txt_email'";
					
					print "</script>";
					
					}

				}
				
			
				
				$_cad_cliente      = isset($_POST['cad_cliente'])       ? $_POST['cad_cliente']       : "0";
				$_cad_vendedor     = isset($_POST['cad_vendedor'])      ? $_POST['cad_vendedor']      : "0";
				$_cad_produto      = isset($_POST['cad_produto'])       ? $_POST['cad_produto']       : "0";
				$_cad_linha        = isset($_POST['cad_linha'])         ? $_POST['cad_linha']         : "0";
				$_estoque          = isset($_POST['estoque'])           ? $_POST['estoque']           : "0";
				$_posicao_estoque  = isset($_POST['posicao_estoque'])   ? $_POST['posicao_estoque']   : "0";
				$_tabela_preco     = isset($_POST['tabela_preco'])      ? $_POST['tabela_preco']      : "0";
				$_configuracao     = isset($_POST['configuracao'])      ? $_POST['configuracao']      : "0";
				$_gerapedido       = isset($_POST['gerapedido'])        ? $_POST['gerapedido']        : "0";
				$_fechapedido      = isset($_POST['fechapedido'])       ? $_POST['fechapedido']       : "0";
				$_rota             = isset($_POST['rota'])              ? $_POST['rota']              : "0";
				$_pos_pedido       = isset($_POST['pos_pedido'])        ? $_POST['pos_pedido']        : "0";
				$_resumo           = isset($_POST['resumo'])            ? $_POST['resumo']            : "0";
				$_btn_cad_permissao= isset($_POST['btn_cad_permissao']) ? true                        : false;
				
				
				#@ paga o login no reload pagina via get
				
				$_nome_usuario = isset($_GET['user']) ? $_GET['user'] : "";
				
				
				if(($_gerapedido == 0) && ($_fechapedido == 0)){
				
					$_pedido = 0; 
				
				}else {

					$_pedido = 1;

				}
				
				if(($_posicao_estoque == 0) && ($_tabela_preco == 0) && ($_pos_pedido == 0) && ($_resumo == 0)){

					$_relatorio = 0;
				}else {

					$_relatorio = 1;

				} 
				
				
				if($_btn_cad_permissao) {

				$_id_usuario = $_usuario->PegaIdUsuario($_nome_usuario);
				
				//var_dump($_id_usuario);



					if($_permissao->Cadastrar($_cad_cliente,
											 $_cad_vendedor,
											 $_cad_produto,
											 $_cad_linha,
											 $_pedido,
											 $_estoque,
											 $_posicao_estoque,
											 $_tabela_preco,
											 $_configuracao,
											 $_id_usuario,
											 $_gerapedido,
											 $_fechapedido,
											 $_rota,
											 1,
											 $_pos_pedido,
											 $_resumo,
											 $_relatorio)){

						print "<script type='text/javascript'>";
	
						print "alert('Cadastro Realizado com Sucesso !');";
							
						print "window.location = 'secao.php?secao=usuario&acao=cadastrar'";
							
						print "</script>";

					}

				}
							
				?>
			
			</div>
		
		</div>
	</div>

	</div>
	<!-- RODAPE -->
	<div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
</body>
</html>