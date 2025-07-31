<?php session_start ();
include_once '../include.inc.php';

$_conexao = new Conexao ();

$_login = new Login ();

$_login->logado();

$_produto = new Produto ();

$_linha = new Linha ();

$_cliente = new Cliente ();

$_vendedor = new Vendedor ();

$_pedido = new Pedido ();

$_estoque = new Estoque ();

$secao = isset ( $_GET ['secao'] ) ? $_GET ['secao'] : "";

// indice do array dos produtos do pedido
$_id = isset ( $_GET ['id'] ) ? $_GET ['id'] : "";

// opcao remove item do pedido na alteracao
$_remove_item = isset($_GET['op']) ? $_GET['op'] : "";

// id_pedido para alteração pedido
$_id_pedido = isset($_GET['idpe']) ? $_GET['idpe'] : "";

// id do produto para remoção do pedido
$_id_produto = isset($_GET['idpr']) ? $_GET['idpr'] : "";

// print $secao;

// remover produto
if ($secao == 'produto') {

	//$_produto->removeProduto ( $_id );
	
	

	if ($_produto->removeProduto ( $_id )) {
		
		print "<script type='text/javascript'>";
		
		print "alert('Produto Excluido com Sucesso !');";
		
		print "window.location = '../secao.php?secao=produto&acao=buscarAlterar';";
		
		print "</script>";
	
	}else {
			
		 print "erro";		
		
	}
	
// remover linha de produtos
} elseif ($secao == 'linha') {
	
	if ($_linha->RemoveCategoria ( $_id )) {
		
		print "<script type='text/javascript'>";
		
		print "alert('Categoria Excluida com Sucesso !');";
		
		print "window.location = '../secao.php?secao=linha&acao=buscarAlterar';";
		
		print "</script>";
	}
	
// remover clientes
} elseif ($secao == 'cliente') {
	
	if ($_cliente->RemoveCliente ( $_id )) {
		
		print "<script type='text/javascript'>";
		
		print "alert('Cliente Excluido com Sucesso !');";
		
		print "window.location = '../secao.php?secao=cliente&acao=buscarAlterar';";
		
		print "</script>";
	}

// remver vendedor
} elseif ($secao == 'vendedor') {
	
	if ($_vendedor->RemoveVendedor ( $_id )) {
		
		print "<script type='text/javascript'>";
		
		print "alert('Vendedor Excluido com Sucesso !');";
		
		print "window.location = '../secao.php?secao=vendedor&acao=buscarAlterar';";
		
		print "</script>";
	}

	// remover item pedido
} elseif ($secao == 'item') {
	
	//var_dump($_SESSION['cesta']);
	
	unset ( $_SESSION ['cesta'] [$_id] );
	
	$_SESSION ['cesta'] = array_values ( $_SESSION ['cesta'] );
	
	if($_remove_item != ""){
		
		if($_pedido->RemoveItemAlteraPedido($_id_pedido, $_id_produto)){
			
			print "<script type='text/javascript'>";
			
			print "alert('Item Excluido com Sucesso !');";
			
			print "window.location = '../secao.php?secao=pedido&acao=Alterar&id=".$_id_pedido."';";
			
			print "</script>";
			
			unset($_remove_item);
			
		}
		
	}else {
	
	print "<script type='text/javascript'>";
		
	print "alert('Item Excluido com Sucesso !');";
		
	print "window.location = '../secao.php?secao=pedido&acao=cadastrar';";
		
	print "</script>";
	
	}
	
	
	################################################# PEDIDO ##########################################################
	
	# situacao = 2 no pedido
// cancelar pedido	
} elseif ($secao == 'pedido') {
	
	if ($_pedido->CancelaPedido ( $_id )) {
					
		$_dados = $_pedido->ListaItemPedido ( $_id );
			
		//var_dump ( $_dados );
			
		for($i = 0; $i < count ( $_dados ); $i ++) {
				
				$_estoque->CreditaEstoque ( $_dados [$i] ['id_produto'], $_dados [$i] ['quantidade'] );
		}
		
			print "<script type='text/javascript'>";
			
			print "alert('Pedido Cancelado com Sucesso !');";
			
			print "window.location = '../secao.php?secao=pedido&acao=buscarAlterar';";
			
			print "</script>";
	}
	
} elseif ($secao == 'estoque') {
		
	
	 if($_estoque->removeEstoque($_id)){
	 		
	 	 print "<script type='text/javascript'>";
	 	 
	 	 print "alert('Item Excluido com Sucesso !');";
	 	 
	 	 print "window.location = '../secao.php?secao=estoque&acao=buscarAlterar';";
	 	 
	 	 print "</script>"; 
	 	 
	 }
	 
}

?>