<?php
include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_cliente = new Cliente ();

$dados = $_cliente->BuscarClienteIdDados ( $_id );

// var_dump ( $dados );

?>

<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<br /><br />
	<table border="1" class="table">
	
		<tr>
			<td colspan="2" class="text-center"><legend>Dados do Cliente</legend></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<b>Código :</b><?php print $dados[0]['id_cliente']?></td>
		</tr>
		<tr>
			<td colspan="2">
				<b>Nome :</b><?php print $dados[0]['nome_razao']?></td>
		</tr>
		<tr>
			<td colspan="2">
				<b>Endereço :</b><?php print $dados[0]['endereco']?></td>
		</tr>
		
			<td>
				<b>CNPJ/CPF: </b><?php print $dados[0]['cpf_cnpj']?></td>
			<td>
				<b>Inscr.Est.</b><?php print $dados[0]['ci_inscr']?></td>
		</tr>
		<tr>
			<td>
				<b>Bairro :</b><?php print $dados[0]['bairro']?></td>
			<td>
				<b>email : </b><?php print $dados[0]['email']?></td>
		</tr>
		<tr>
			<td>
				<b>Cidade :</b><?php print $dados[0]['cidade']?></td>
			<td>
				<b>Estado :</b><?php print $dados[0]['estado']?></td>
		</tr>
		<tr>
			<td>
				<b>Cep :</b><?php print $dados[0]['cep']?></td>
			<td>
				<b>Responsável :</b><?php print $dados[0]['responsavel']?></td>
		</tr>
		<tr>
			<td>
				<b>Telefone 1 :</b><?php print $dados[0]['tel1']?></td>
			<td>
				<b>Telefone 2 :</b><?php print $dados[0]['tel2']?></td>
		</tr>
		<tr>
			<td>
				<b>Telefone 3 :</b><?php print $dados[0]['tel3']?></td>
			<td>
				<b>Dt Nasc :</b><?php //print $dados[0]['dt_nasc']?></td>
		</tr>

	</table>
</body>
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>