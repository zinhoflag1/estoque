<?php session_start ();
header ( "Cache-Control: no-cache, must-revalidate" );
print "<!DOCTYPE html>";
include_once 'include.inc.php';

require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_login = new Login();

$_login->logado();

$_produto = new Produto ();

$_estoque = new Estoque ();

$_pedido = new Pedido ();

$_linha = new Linha();

$_configuracao = new Config();

?>

<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>

	<div class="container-fluid">
		<div class="row-fluid">
			<br />
			<div class="span12">
				<form action="#" method="POST" name="frm_adiciona_prod">
					<legend>Buscar Produtos</legend>
					<div class="controls">
						<input class="span2" name="txt_id_produto" id="txt_id_produto" type="text" placeholder="Código">
						<input class="span3" name="txt_nome" id="txt_nome" type="text" placeholder="Nome do Produto">
					</div>
					<br />
					<button name="txt_btn_enviar" id="txt_btn_enviar" type="submit" class="btn" value="btn_enviar">Buscar</button>
				</form>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
    				<?php
								
								$_enviar = isset ( $_POST ['txt_btn_enviar'] ) ? true : "";
								
								$_id_produto = isset ( $_POST ['txt_id_produto'] ) ? $_POST ['txt_id_produto'] : "";
								
								$_nome = isset ( $_POST ['txt_nome'] ) ? $_POST ['txt_nome'] : "";
								
								if ($_enviar) {
									
									$dados = $_produto->BuscaProdutoNomeId ( $_id_produto, $_nome );
									
									$_registro = count ( $dados );
									
									if ($_registro == 0) {
										
										print 'Produto sem Lancamento no Estoque';
									} else {
										
										print "<table class='table'>
                                        <tr>
											<td>Código</td>
											<td>Nome</td>
											<td>Volume</td>
											<td>Linha</td>
											<td>Qtd&nbsp;&nbsp;&nbsp;</td>
											<td>Ação</td>
										</tr>";
										
										for($i = 0; $i < count ( $dados ); $i ++) {
											
											print '<form action="#" method="POST" name="frm_add' . $i . '">';
											
											print "<tr>
									<td><input class=\"span12\"type='text' name='txt_add_id_produto" . $i . "' value='" . $dados [$i] ['id_produto'] . "' readonly=\"readonly\"></td>
									<td><input type='text' name='txt_add_nome" . $i . "' value='" . $dados [$i] ['nome'] . "' readonly=\"readonly\"></td>
									<td><input type='text' name='txt_add_volume" . $i . "' value='" . $dados [$i] ['volume'] . "' readonly=\"readonly\"></td>
									<td><input type='text' name='txt_add_linha" .$i . "' value='" .$_linha->getLinha($dados[$i]['id_linha']) . "' readonly=\"readonly\"></td>
                                    <td><input type='text' class='span12' name='txt_add_qtd" . $i . "'></td>
									<td><input type='hidden' name='txt_add_linha" . $i . "' value='" . $dados [$i] ['id_linha'] . "' readonly=\"readonly\">
                                    <input type='hidden' name='txt_add_valor" . $i . "' value='" . $dados [$i] ['valor_venda'] . "'>
                                    <button class='btn' type='submit' name='btn_add" . $i . "' value='btn_add' >Adicionar</button></td>
                                    </tr></form>";
										}
										print "</table>";
									}
								}
								
								//var_dump($dados);
								
								//var_dump($_POST);
																
								$teste = $_POST;
								
								
								
								$_teste2 = array_values ( $teste );
								
								//var_dump ( $_teste2 );
								
								$_txt_add_id_produto = isset ( $_teste2 [0] ) ? $_teste2 [0] : "";
								$_txt_add_nome       = isset ( $_teste2 [1] ) ? $_teste2 [1] : "";
								$_txt_add_volume     = isset ( $_teste2 [2] ) ? $_teste2 [2] : "";
								$_txt_add_linha      = isset ( $_teste2 [3] ) ? $_teste2 [3] : "";
								$_txt_add_qtd        = isset ( $_teste2 [4] ) ? $_teste2 [4] : 0;
								$_txt_add_valor      = isset ( $_teste2 [5] ) ? $_teste2 [5] : "";
								
								
								$_btn_add = isset ( $_teste2 [6] ) ? true : "";
								
								if ($_btn_add) {
										
									if($_txt_add_qtd > 0){
									
									
										//var_dump ( $_POST );
										
										if($_configuracao->Parametro("saldo_negativo")){
	
											//adiciona o saldo no pedido
											$_pedido->AdicionarCesta ( $_txt_add_id_produto, $_txt_add_linha, $_txt_add_nome, $_txt_add_qtd, $_txt_add_valor, $_txt_add_volume );
												
											print "<script type='text/javascript'>";
												
											print "alert('Produto Adicionado Com Sucesso !');";
												
											print "opener.location.reload();";
												
											print "window.close();";
												
											print "</script>";
										
										}else {
										
											// checa o saldo antes de adiciona-lo
											if ($_estoque->ChecaSaldo ( $_txt_add_id_produto, $_txt_add_qtd )) {
												
												//adiciona o saldo no pedido
												$_pedido->AdicionarCesta ( $_txt_add_id_produto, $_txt_add_linha, $_txt_add_nome, $_txt_add_qtd, $_txt_add_valor, $_txt_add_volume );
												
												print "<script type='text/javascript'>";
												
												print "alert('Produto Adicionado Com Sucesso !');";
												
												print "opener.location.reload();";
												
												print "window.close();";
												
												print "</script>";
											
											} else {
												
												print "<script type='text/javascript'>";
												
												print "alert('Saldo Insuficiente !');";
												
												print "</script>";
											}
										
										}
										
										}else {
											
									print "<script type='text/javascript'>";
												
												print "alert('Inserir a quantidade de produtos !');";
												
												print "history.back();";
												
												print "</script>";
									
								}
									}
								
								// var_dump($_POST);
								?>
    			</div>

		</div>

	</div>

</body>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script type="text/javascript">

    	$("#btn_adicionar").click(function(){
    		
            opener.location.reload();
            window.close();
    		
	});

    </script>
</body>
</html>

