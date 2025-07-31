<?php
session_start ();
print "<!DOCTYPE html>";
include_once '../include.inc.php';

$_conexao = new Conexao ();

$_pedido = new Pedido ();

$_relatorio = new Relatorio ();

$_cliente = new Cliente ();

$_produto = new Produto ();

// var_dump($_POST);

$_txt_dt_inicial = isset ( $_POST ['txt_dt_inicial'] ) ? DataMysql::dataForm ( $_POST ['txt_dt_inicial'] ) : "";

$_txt_dt_final = isset ( $_POST ['txt_dt_final'] ) ? DataMysql::dataForm ( $_POST ['txt_dt_final'] ) : "";

$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";

?>
<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
@media print {
	a:link {
		display: none;
	}
}
</style>
</head>
<body>
	<div class="container">
		<div class="span12 text-center">
			<a href="javascript:history.back();" class="btn" title="Voltar para Pesquisa">Voltar</a> <a href="javascript:window.print();"
				class="btn" titla="Imprimir Relatório">Imprimir</a>
		</div>

		<legend class="text-center">Resumo de Pedidos Fechados</legend>

Pedíodo : <?php

print ($_txt_dt_inicial == "//") ? "__/__/___" : DataMysql::dataVisual ( $_txt_dt_inicial );
print " à ";
print ($_txt_dt_final == "//") ? "__/__/____" : DataMysql::dataVisual ( $_txt_dt_final );
?>
<br> <br />

<?php

if ($_btn_enviar) {
	
	if ($_txt_dt_inicial == "//") {
		
		$_txt_dt_inicial = "";
	}
	if ($_txt_dt_final == "//") {
		
		$_txt_dt_final = "";
	}
	
	$_dado_produtos = $_relatorio->ResumoProdutos ( $_txt_dt_inicial, $_txt_dt_final );
	
	$_total_registro_produto = count ( $_dado_produtos );
	
	if ($_total_registro_produto == 0) {
		
		print "Consulta não Retornou nenhum Registro !";
	} else {
		
		print "<table class=\"table\" border=\"0\">
			<tr>
				<td>Código</td>
				<td>Produto / Volume</td>
				<td>Quantidade</td>
				<td>Valor Unitário</td>
				<td>Valor Total</td>
			</tr>";
		$_qtd_total_produto = 0;
		$_valor_total_produtos = 0;
		
		for($i = 0; $i < count ( $_dado_produtos ); $i ++) {
			
			print "<td>".$_dado_produtos [$i] ['id_produto']."</td>
				<td>" . $_produto->getProduto($_dado_produtos [$i] ['id_produto']) . " - ".$_dado_produtos [$i] ['volume']."</td>
				<td>" . $_dado_produtos [$i] ['quantidade'] . "</td>
				<td>R$ " . number_format ( $_dado_produtos [$i] ['valor'], 2, ',', '.' ) . "</td>
				<td>R$ " . number_format ($_dado_produtos [$i] ['quantidade'] * $_dado_produtos [$i] ['valor'], 2, ',', '.' ) . "</td>
				</tr>";
			$_qtd_total_produto += $_dado_produtos [$i] ['quantidade'] ;
			
			$_valor_total_produtos += $_dado_produtos[$i]['valor'] * $_dado_produtos [$i] ['quantidade'];
			
		}
		print "<tr>
				<td colspan='2'><b>Total Produtos</b></td>
				<td><b>".$_qtd_total_produto."</b></td>
				<td></td>
				<td><b>R$ ".number_format ($_valor_total_produtos, 2, ',', '.' )."</b></td>
				</tr>
				<tr>
				<td align=\"center\" colspan=\"4\"></td>
				</tr>
			</table>";
	}
	
	print "========================================================================================================================<br>
	
	<legend class=\"text-center\">Resumo de Pedidos Cancelados</legend>";
	
	$_dado_produtosCancelados = $_relatorio->ResumoProdutosCancelados ( $_txt_dt_inicial, $_txt_dt_final );
	
	$_total_registro_produtoCancelado = count ( $_dado_produtosCancelados );
	
	if ($_total_registro_produtoCancelado == 0) {
		
		print "Consulta não Retornou nenhum Registro !";
	} else {
	
	print "<table class=\"table\" border=\"0\">
			<tr>
				<td>Código</td>
				<td>Produto / Volume</td>
				<td>Quantidade</td>
				<td>Valor Unitário</td>
				<td>Valor Total</td>
			</tr>";
		$_qtd_total_produtoCancelado = 0;
		$_valor_total_produtosCancelados = 0;
		
		for($i = 0; $i < count ( $_dado_produtosCancelados ); $i ++) {
			
			print "<td>" . $_dado_produtosCancelados [$i] ['id_produto'] . "</td>
				<td>" . $_produto->getProduto($_dado_produtosCancelados [$i] ['id_produto']) . " - ".$_dado_produtosCancelados [$i] ['volume']."</td>
				<td>" . $_dado_produtosCancelados [$i] ['quantidade'] . "</td>
				<td>R$ " . number_format ( $_dado_produtosCancelados [$i] ['valor'], 2, ',', '.' ) . "</td>
				<td>R$ " . number_format ($_dado_produtosCancelados [$i] ['quantidade'] * $_dado_produtosCancelados [$i] ['valor'], 2, ',', '.' ) . "</td>
				</tr>";
			$_qtd_total_produtoCancelado += $_dado_produtosCancelados [$i] ['quantidade'] ;
			
			$_valor_total_produtosCancelados += $_dado_produtosCancelados[$i]['valor'] * $_dado_produtosCancelados [$i] ['quantidade'];
			
		}
		print "<tr>
				<td colspan='2'><b>Total Produtos</b></td>
				<td><b>".$_qtd_total_produtoCancelado."</b></td>
				<td></td>
				<td><b>R$ ".number_format ($_valor_total_produtosCancelados, 2, ',', '.' )."</b></td>
				</tr>
				<tr>
				<td align=\"center\" colspan=\"4\"></td>
				</tr>
			</table>";
	
	}
	
	?>

	
	

</div>

</body>

<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</html>

<?php
}

?>
