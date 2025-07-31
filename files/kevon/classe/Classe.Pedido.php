<?php
require_once 'Classe.Conexao.php';

class Pedido {

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}
	
	// Cadastro de Pedido
	function Cadastrar($_id_cliente, $_subtotal, $_desc_perc, $_desc_valor, $_total, $_forma, $_obs, $_dt_pedido, $_num_parcela, $_situacao) {
		$sql = "INSERT INTO pedido (id_cliente,
						    subtotal,
						    desc_perc,
						    desc_valor,
						    total,
						    forma,
						    obs,
						    dt_pedido,
							num_parcela,
							situacao) VALUES ('" . $_id_cliente . "',
								     '" . $_subtotal . "',
								     '" . $_desc_perc . "',
								     '" . $_desc_valor . "',
								     '" . $_total . "',
								     '" . $_forma . "',
								     '" . $_obs . "',
								     '" . $_dt_pedido . "',
									 '" . $_num_parcela . "',
									 '" . $_situacao . "')";
		
		$result = self::$pdo->query($sql) or die();
		
		return true;
	}
	
	// lanca item de pedido
	function LancaItemPedido($_id_produto, $_valor, $_quantidade, $_id_pedido) {
		$sql = "INSERT INTO item_pedido (id_produto,
							   valor,
							   quantidade,
							   id_pedido) VALUES ('" . $_id_produto . "',
										    '" . $_valor . "',
										    '" . $_quantidade . "',
										    '" . $_id_pedido . "')";
		
											$result = self::$pdo->query($sql) or die();
		
		return true;
	}
	
	// Busca Pedido com base Nome e Retorna o ID
	function BuscarPedidoNomeId($_nome) {
		$sql = "select id_Pedido, nome from Pedido where nome like '%" . $_nome . "%'";
		// print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		print '<table class="table">
					<tr>
						<td>Codigo</td><td>Nome</td><td>Ação</td>
					</tr>';
		
		while ( $linha = $result->fetch(PDO::FETCH_ASSOC) ) {
			
			print '<tr>
						<td>' . $linha ['id_Pedido'] . '</td>
				   		<td>' . $linha ['nome'] . '</td>
				   		<td><a href="secao.php?secao=Pedido&acao=Alterar&id=' . $linha ['id_Pedido'] . '" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   			<!--onclick="javascript:return confirm(\'Deseja Excluir Registro ?\');"<i class="icon-remove-sign"></i>-->
				   		</td>
					</tr>';
		}
		
		print '</table>';
	}
	
	// busca pedido com base no id para alterar
	function BuscaPedidoIdAlterar($_id_pedido) {
		$dados = array ();
		
		$sql = "SELECT p.id_pedido as id_pedido,
				   p.id_cliente as id_cliente,
				   p.subtotal as subtotal,
				   p.desc_perc as desc_perc,
				   p.desc_valor as desc_valor,
				   p.total as total,
				   p.forma as forma,
				   p.obs as obs,
				   p.dt_pedido as dt_pedido,
				   c.nome_razao as nome,
				   c.endereco as endereco,
				   c.tel1 as tel1,
				   c.bairro as bairro,
				   p.num_parcela as num_parcela,
				   p.situacao as situacao
				   FROM pedido p
				   INNER JOIN cliente c
				   ON p.id_cliente = c.id_cliente
				   WHERE p.dt_pgto is null
				   AND p.id_pedido = " . $_id_pedido;
		
		$result = self::$pdo->query($sql) or die();
		
		while ( $linha = $result->fetch(PDO::FETCH_ASSOC)  ) {
			
			$dados = $linha;
		}
		
		return $dados;
	}
	
	// Busca Pedido com base no Identificador e retorna todos os dados para alteração
	function BuscarPedidoAlterar($_id_pedido = false, $_dt_pedido = false, $_id_cliente = false) {
		$dados = array ();
		$filtro = "";
		
		// print $_dt_pedido;
		// somente o numero pedido
		if (($_id_pedido != "") && ($_dt_pedido == "//") && ($_id_cliente == "")) {
			
			$filtro = 'where id_pedido = ' . $_id_pedido;
			
			// somente a data pedido
		} elseif (($_id_pedido == "") && ($_dt_pedido != "//") && ($_id_cliente == "")) {
			
			$filtro = 'where dt_pedido = "' . $_dt_pedido . '"';
			
			// data e cliente somente
		} elseif (($_id_pedido == "") && ($_dt_pedido != "") && ($_id_cliente != "")) {
			
			$filtro = 'where dt_pedido = ' . $_dt_pedido . " AND id_cliente = " . $_id_cliente;
		}
		
		$sql = "SELECT id_pedido,
				   id_cliente,
				   subtotal,
				   desc_perc,
				   desc_valor,
				   total,
				   forma,
				   obs,
				   dt_pedido,
				   dt_pgto,
				   num_parcela,
				   situacao
				   FROM pedido " . $filtro . "";
		
		// print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		while ( $linha = $result->fetch(PDO::FETCH_ASSOC)  ) {
			
			$dados [] = $linha;
		}
		
		return $dados;
	}
	
	// Alterar Cadastro Pedido
	function ALterar($_id_Pedido, $_nome, $_volume, $_id_linha) {
		$sql = "UPDATE Pedido SET nome = '" . $_nome . "',
							volume = '" . $_volume . "',
							id_linha = '" . $_id_linha . "'
							WHERE id_Pedido = " . $_id_Pedido . "";
		
		$result = self::$pdo->query($sql) or die();
		
		return true;
	}
	
	// busca Pedido para adicionar na cesta
	// parametros nome ou id e quantidade
	function BuscaPedidoNomeId($_id_linha, $_nome) {
		$filtro = "";
		
		if (($_id_linha == "") and ($_nome != "")) {
			
			$filtro = "where nome like '%" . $_nome . "%'";
		} elseif (($_id_linha != "") and ($_nome == "")) {
			
			$filtro = "where id_Pedido = " . $_id_linha;
		}
		
		$sql = "select id_Pedido, nome, volume, id_linha
			 from Pedido " . $filtro;
		
		$result = self::$pdo->query($sql) or die();
		
		while ( $linha = $result->fetch(PDO::FETCH_BOTH)  ) {
			
			$dados [] = $linha;
		}
		
		return $dados;
	}
	function BuscaPedidoNomeIdCategoria($_nome) {
		$sql = "select p.id_Pedido, p.nome, p.volume, c.nome
			 from Pedido p
			 inner join linha c
			 on p.id_linha = c.id_linha
			 where p.nome like '%" . $_nome . "%'";
		
		$result = self::$pdo->query($sql) or die();
		
		while ( $linha = $result->fetch(PDO::FETCH_BOTH) ) {
			
			$dados [] = $linha;
		}
		
		return $dados;
	}
	
	// Pega o ultimo Pedido
	function getUltimoPedido() {
		$dados = null;
		
		$sql = "SHOW TABLE STATUS LIKE 'pedido'";
		
		$result = self::$pdo->query($sql) or die();
		
		$linha = $result->fetch(PDO::FETCH_ASSOC) ;
		
		$dados = $linha ['Auto_increment'];
		
		return $dados;
	}
	
	// Adicionar Produto Cesta
	function AdicionarCesta($_id_produto, $_id_linha, $_nome, $_quantidade, $_valor, $_volume) {
		if (! isset ( $_SESSION ['cesta'] )) {
			
			// session_start();
		}
		
		$_SESSION ['cesta'] [] = array (
				$_id_produto,
				$_id_linha,
				$_nome,
				$_quantidade,
				$_valor,
				$_volume 
		);
	}
	
	// Lista Item pedido
	static function ListaItemPedido($_id_pedido) {
		$dados = array ();
		
		$sql = "SELECT i.id_produto as id_produto,
				   c.id_linha as id_linha,
				   p.nome as nome,
				   i.quantidade as quantidade,
				   i.valor as valor,
				   p.volume
				   FROM item_pedido i
           		   INNER JOIN produto p
				   ON i.id_produto = p.id_produto 
				   INNER JOIN linha c
				   ON p.id_linha = c.id_linha
				   WHERE i.id_pedido = " . $_id_pedido;
		
		// print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		while ( $linha = $result->fetch(PDO::FETCH_BOTH) ) {
			
			$dados [] = $linha;
		}
		
		return $dados;
	}
	
	// Cancela pedido
	function CancelaPedido($_id_pedido) {
		
		// deletar o pedido
		$sql = "UPDATE pedido SET situacao = 2, dt_pgto = '" . date ( 'Y/m/d' ) . "' WHERE id_pedido = " . $_id_pedido;
		
		 print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		return true;
	}
	
	// remove todos os itens do pedido
	function RemoveItem($_id_pedido) {
		
		// deletar os itens do pedido
		$sql = "DELETE FROM item_pedido WHERE id_pedido = " . $_id_pedido;
		
		$result = self::$pdo->query($sql) or die();
		
		return true;
	}
	
	// remove item do pedido (Altera Pedido)
	function RemoveItemAlteraPedido($_id_pedido, $_id_produto) {
	
		// deletar os itens do pedido na alteracao do pedido
		$sql = "DELETE FROM item_pedido WHERE id_pedido = " . $_id_pedido." and id_produto = ".$_id_produto;
	
		$result = self::$pdo->query($sql) or die();
	
		return $result;
	}
	
	// Impressao de Pedido
	function PedidoImpressao($_id_pedido) {
		$sql = "SELECT id_pedido,
				   id_cliente,
				   subtotal,
				   desc_perc,
				   desc_valor,
				   total,
				   forma,
				   obs,
				   dt_pedido,
				   dt_pgto,
				   num_parcela
				   FROM pedido 
				   WHERE id_pedido = " . $_id_pedido;
		
		// print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		$linha = $result->fetch(PDO::FETCH_BOTH) ;
		
		$dados [] = $linha;
		
		$dados [] [] = Pedido::ListaItemPedido ( $_id_pedido );
		
		return $dados;
	}
	
	
	#@ buscar pedido Quitar
	function BuscarPedidoQuitar($_id_pedido) {
			
		
				
			$filtro = "AND id_pedido = ".$_id_pedido;

		
		$_dados = array();
		
		$sql = "SELECT id_pedido,
					  dt_pedido,
					  id_cliente,
					  situacao
					  FROM pedido
					  WHERE situacao = 0 " . $filtro;
					  
		//print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		while ($linha = $result->fetch()) {
			
			$_dados[] = $linha;
		}
		
		return $_dados;
		
	}
	
	#@ quitar Pedido
	function QuitarPedido($_id_pedido, $_dt_pgto) {
		
		$sql = "UPDATE pedido
				SET dt_pgto = '".$_dt_pgto."',
				situacao = 1
				WHERE id_pedido = ".$_id_pedido;
		
		$result = self::$pdo->query($sql) or die();
		
		//print $sql;
		
		return true;
		
		
	}
}
?>