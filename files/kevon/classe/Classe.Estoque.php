<?php
require_once 'Classe.Conexao.php';

class Estoque
{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	#@ Cadastro de Estoque
	function Cadastrar($_id_produto,
				$_id_linha,
				$_valor_compra,
				$_quantidade,
				$_obs,
				$_valor_venda,
				$_percentual){

		$sql = "INSERT INTO estoque (id_produto,
							id_linha,
							valor_compra,
							qtd,
							obs,
							valor_venda,
							percentual) VALUES ('".$_id_produto."',
									 	  '".$_id_linha."',
									 	  '".$_valor_compra."',
									 	  '".$_quantidade."',
									 	  '".$_obs."',
										  '".$_valor_venda."',
										  '".$_percentual."')";

		$result = self::$pdo->query($sql) or die();

		return true;
	}
	
	#@ Atualiza Estoque
	function AtualizaEstoque($_id_produto,
							 $_id_linha,
							 $_valor_compra,
							 $_quantidade,
							 $_obs,
							 $_valor_venda,
							 $_percentual){
	
		$sql = "UPDATE estoque 
				SET valor_compra = '".$_valor_compra."',
					qtd = qtd + '".$_quantidade."',
					obs = '".$_obs."',
					valor_venda = '".$_valor_venda."',
					percentual = '".$_percentual."'
					WHERE id_produto = ".$_id_produto."
					AND id_linha = ".$_id_linha;
		
		//print $sql;
	
		$result = self::$pdo->query($sql) or die();
	
		return true;
	}
	
	#@ registro Estoque
	function RegistraEstoque($_id_produto,
							 $_id_linha,
							 $_valor_compra,
							 $_quantidade,
							 $_obs,
							 $_valor_venda,
							 $_percentual,
							 $_dt_entrada){

		$sql = "INSERT INTO reg_estoque (id_produto,
										 id_linha,
										 valor_compra,
										 qtd,
										 obs,
										 valor_venda,
										 percentual,
										 dt_entrada) VALUES ('".$_id_produto."',
												 	 		 '".$_id_linha."',
												 	  		'".$_valor_compra."',
												 	  		'".$_quantidade."',
												 	  		'".$_obs."',
													  		'".$_valor_venda."',
													  		'".$_percentual."',
															'".$_dt_entrada."')";

		$result = self::$pdo->query($sql) or die();

		return true;
	}
	
	
	#@ Busca Estoque com base Nome e Retorna o ID (pesquisa alteracao)
	function BuscarEstoqueNomeId($_nome){

		$sql = "select e.id_linha as id_linha,
				p.nome as produto,
				p.id_produto as id_produto,
				c.nome as linha,
				e.qtd as quantidade,
				e.valor_venda as valor_venda,
				p.volume
				from estoque e
				inner join produto p
				on e.id_produto = p.id_produto
				inner join linha c
				on e.id_linha = c.id_linha
				where p.nome like '%".$_nome."%'";

		//print $sql;

		$result = self::$pdo->query($sql) or die();

		print 	'<table class="table text-center">
					<tr>
						<td>Código</td>
						<td>Produto</td>
						<td>Volume</td>
						<td>Categoria</td>
						<td>Quantidade</td>
						<td>Valor</td>
						<td style="text-align:center;">Ação</td>
					</tr>';

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			print 	'<tr>
						<td>'.$linha['id_produto'].'</td>
						<td>'.$linha['produto'].'</td>
				   		<td>'.$linha['volume'].'</td>
				   		<td>'.$linha['linha'].'</td>
				   		<td>'.$linha['quantidade'].'</td>
				   		<td>'.$linha['valor_venda'].'</td>
				   		<td><a href="secao.php?secao=estoque&acao=Alterar&id='.$linha['id_produto'].'" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   		<a href="cont/remove.php?secao=estoque&id='.$linha['id_produto'].'" class="btn" title="Clique aqui para Excluir !" onclick="javascript:return confirm(\'Confirmar o Exclusão do Produto no Estoque ?\');">Excluir <i class="icon-remove-sign"></i></a>
				   		</td>
					</tr>';

		}

			print '</table>';

	}

	#@ Busca Estoque com base no Identificador e retorna todos os dados para alteração
	function BuscarEstoqueNomeAlterar($_id_produto){

		$dados = array();

		$sql = "select e.id_produto as id_produto,
				 e.id_linha as id_linha,
				 p.nome as produto,
				 c.nome as linha,
				 e.qtd as quantidade,
				 e.valor_venda as valor_venda,
				 e.obs as observacao,
				 e.valor_compra as valor_compra,
				 e.percentual as percentual
			 from estoque e
			 inner join produto p
			 on e.id_produto = p.id_produto
			 inner join linha c
			 on e.id_linha = c.id_linha
			 where e.id_produto = ".$_id_produto;

							$result = self::$pdo->query($sql) or die();

							$linha = $result->fetch(PDO::FETCH_ASSOC);

							$dados[] = $linha;

							return $dados;


	}

	#@ Alterar Cadatro Estoque
	function Alterar($_txt_codigo,
			     $_txt_id_produto,
			     $_txt_id_linha,
			     $_txt_valor_compra,
			     $_txt_quantidade,
			     $_txt_observacao,
				 $_txt_valor_venda,
				 $_txt_percentual) {

		$sql = "UPDATE estoque
			  SET id_produto = ".$_txt_id_produto.",
			  	id_linha = ".$_txt_id_linha.",
			  	valor_compra = '".$_txt_valor_compra."',
			  	qtd = '".$_txt_quantidade."',
			  	obs = '".$_txt_observacao."',
			  	valor_venda = '".$_txt_valor_venda."',
			  	percentual = '".$_txt_percentual."'
			  WHERE id_produto = ".$_txt_id_produto;

		print $sql;

		$result = self::$pdo->query($sql) or die();

		return true;

	}


	#@ busca Estoque para adicionar nacesta
	#@ parametros nome ou id e quantidade
	function BuscaEstoqueNomeId($_id_linha, $_nome){

		$filtro = "";

		if(($_id_linha == "") and ($_nome != "")){


			$filtro = "where nome like '%".$_nome."%'";

		}elseif (($_id_linha != "") and ($_nome == "")) {

			$filtro = "where id_Estoque = ".$_id_linha;
		}

		$sql = "select id_Estoque, nome, volume, id_linha
			 from Estoque ".$filtro;

		$result = self::$pdo->query($sql) or die();

		while ($linha = $result->fetch()) {

			$dados[] = $linha;

		}

		return $dados;




	}

	function BuscaEstoqueNomeIdCategoria($_nome){

		$sql = "select p.id_Estoque, p.nome, p.volume, c.nome
			 from Estoque p
			 inner join linha c
			 on p.id_linha = c.id_linha
			 where p.nome like '%".$_nome."%'";

		$result = self::$pdo->query($sql) or die();



		while ($linha = $result->fetch()) {

			$dados[] = $linha;

		}

		return $dados;




	}

	#@ Faz a checagem de saldo
	Function ChecaSaldo($_id_produto, $_quantidade){

		$sql = "select id_produto, qtd from estoque
			 where id_produto = ".$_id_produto."
			 and qtd >= ".$_quantidade;

		//print $sql;

		$result = self::$pdo->query($sql) or die();

		if($result->fetch(PDO::FETCH_NUM) == 1) {

			return true;
		
		}else {

			return false;
		}

	}

	#@ debita estoque
	function DebitaEstoque($_id_produto, $_quantidade){

		$sql = "UPDATE estoque SET qtd = qtd - ".$_quantidade." WHERE id_produto = ".$_id_produto;

		$result = self::$pdo->query($sql) or die();

		return true;
	}

	#@ credita saldo estoque (cancelamento de Pedido)
	function CreditaEstoque($_id_produto, $_quantidade){

		$sql = "UPDATE estoque SET qtd = qtd + ".$_quantidade." WHERE id_produto = ".$_id_produto;

		$result = self::$pdo->query($sql) or die();

		return true;
	}

	
	#@ busca estoque para cadastro de produto no estoque
	function BuscaEstoque($_id_produto, $_id_linha){
		
		$sql = "SELECT id_produto
				FROM estoque
				WHERE id_produto = ".$_id_produto."
				AND id_linha = ".$_id_linha;
		
		$result = self::$pdo->query($sql) or die();
		
		$num_linha = $result->fetch(PDO::FETCH_NUM);
		
		return $num_linha;
	}

	/**
	*
	* remove o estoque do produto
	* @param id_produto
	*/
	function removeEstoque($id_produto){
		
		$sql = "DELETE FROM estoque
				WHERE id_produto = ".$id_produto."
				AND id_estoque > 0";
		
		$result = self::$pdo->query($sql) or die();
		
		return true;
	}

}?>