<?php
session_start ();
print "<!DOCTYPE html>";
include_once '../include.inc.php';

$_conexao = new Conexao ();

$_pedido = new Pedido ();

$_relatorio = new Relatorio();

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

		<legend class="text-center">Relatório de Pedidos em Aberto</legend>

Pedíodo : <?php

print ($_txt_dt_inicial == "//") ? "__/__/___" : DataMysql::dataVisual($_txt_dt_inicial);
print " à ";
print ($_txt_dt_final == "//") ? "__/__/____" : DataMysql::dataVisual($_txt_dt_final);
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
	
	$_dados = $_relatorio->PedidoAberto ( $_txt_dt_inicial, $_txt_dt_final );
	
	$_total_registro = count($_dados);
	
	if ($_total_registro == 0) {
		
		print "Consulta não Retornou nenhum Registro !";
	} else {
		
		$_total_geral = 0;
		
		// var_dump($_dados);
		
		print "<table class=\"table\" border=\"0\">
			<tr>
				<td bgcolor='cbccda'>Nº Pedido</td>
				<td bgcolor='cbccda'>Cliente</td>
				<td bgcolor='cbccda'>Forma Pagamento</td>
				<td bgcolor='cbccda'>Data Pedido</td>
				<td bgcolor='cbccda'>Parcelas</td>
			</tr>";
		
		for($i = 0; $i < count ( $_dados ); $i ++) {
			
			print "<td>" . $_dados [$i] ['id_pedido'] . "</td>
				<td>" . $_cliente->getNomeCliente ( $_dados [$i] ['id_cliente'] ) . "</td>
		<td>" . $_dados [$i] ['forma'] . "</td>
		<td>" . DataMysql::dataVisual ( $_dados [$i] ['dt_pedido'] ) . "</td>
		<td>" . $_dados [$i] ['num_parcela'] . "</td>
		</tr>
		<tr><td colspan=\"5\">";
			$_itens = $_pedido->ListaItemPedido ( $_dados [$i] ['id_pedido'] );
			
			print "<table class=\"\" align=\"center\">
				<tr>
				<td>Produto</td>
				<td>Quantidade</td>
				<td>Valor</td>
				</tr>";
			
			for($j = 0; $j < count ( $_itens ); $j ++) {
				
				print "<tr>
					<td>" . $_produto->getProduto ( $_itens [$j] ['id_produto'] ) . "</td>
					<td>" . $_itens [$j] ['quantidade'] . "</td>
					<td>" . $_itens [$j] ['valor'] . "</td>
				</tr>";
			}
			print "</table>";
			print "</td>
				</tr>
				<tr>
					<td></td>
					<td>Desconto</td>
					<td>" . $_dados [$i] ['desc_valor'] . "</td>
					<td>Total</td>
					<td>" . $_dados [$i] ['total'] . "</td>
				</tr>
				<tr>
					<td colspan='6' bgcolor='cbccda'></td>
				</tr>";
			
			$_total_geral += $_dados [$i] ['total'];
		}
		
		print "<tr>
			<td colspan=\"3\" class=\"text-right\"></td>	
			<td>Total Geral</td>	
			<td>" . $_total_geral . "</td>		
			</tr></table>";
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
