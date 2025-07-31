<?php
require_once 'Classe.Conexao.php';


class Relatorio
{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	#@ Saldo Geral de estoque
	function SaldoGeral(){

		$total = 0;

		$sql	=	"select p.nome as produto,
				 c.nome as linha,
				 e.valor_venda as valor_venda,
				 e.qtd as quantidade, 
				 e.id_produto as id_produto,
				 e.valor_compra as valor_compra
				from estoque e
				inner join produto p
				on e.id_produto = p.id_produto
				inner join linha c
				on e.id_linha = c.id_linha";

		$result = self::$pdo->query($sql) or die();

		print '<table class="table table-bordered">
				<tr>
					<th style="text-align:center">Código</th>
					<th style="text-align:center">Nome</th>
					<th style="text-align:center">Linha</th>
					<th style="text-align:center">Valor</th>
					<th style="text-align:center">Quantidade</th>
					<th style="text-align:center">Total</th>
				</tr>';

		while($linha = $result->fetch()){

			$_sub_total = $linha['valor_venda']*$linha['quantidade'];

			print '<tr>
					<td>'.$linha['id_produto'].'</td>
					<td>'.$linha['produto'].'</td>
					<td>'.$linha['linha'].'</td>
					<td>R$ '.number_format($linha['valor_venda'], 2, ',', '.').'</td>
					<td>'.$linha['quantidade'].'</td>
					<td>R$ '.number_format($_sub_total, 2, ',', '.').'</td>
				</tr>';
			$total += $_sub_total;

		}

		print '<tr>
				<td colspan="5"></td>
				<td class="alert alert-info"><b>R$ '.number_format($total, 2, ',', '.').'</b></td>
				</tr>';

		print '</table>';

	}

	#@ Tabela de Preco
	function RelatorioTabelaPreco(){

		$dados = array();

		$sql = "select id_linha, nome from linha order by nome";



		/*$sql	=	"select p.nome as produto, c.nome as linha, e.valor as valor, e.qtd as quantidade, e.id_produto as id_produto
				from estoque e
				inner join produto p
				on e.id_produto = p.id_produto
				inner join linha c
				on e.id_linha = c.id_linha";*/

		$result = self::$pdo->query($sql) or die();

		while($linha = $result->fetch()){

			$dados[] = $linha;

		}

		$total = count($dados);

		//var_dump($dados);

		print '<table align="center" class="table table-bordered">';

		for ($i=0; $i < $total ; $i++) { 

			print '<tr>
					<td colspan="3" style="text-align:center"><h4>'.$dados[$i]['nome'].'</h4></td>
				</tr>';

			$sql1 = "select p.nome as produto,
				e.valor_venda as valor_venda,
				e.qtd as quantidade,
				e.id_produto as id_produto,
				p.volume
				from estoque e
				inner join produto p
				on e.id_produto = p.id_produto
				where e.id_linha = ".$dados[$i]['id_linha']."";
				
				//print $sql1;

			$result1 = self::$pdo->query($sql1) or die();

			print "<tr>
					<td style=\"text-align:center\"><label>Código</label></td>
					<td style=\"text-align:center\"><label>Nome</label></td>
					<td style=\"text-align:center\"><label>Volume</label></td>
					<td style=\"text-align:center\"><label>Valor</label></td>
				</tr>";

			while ($linha1 = $result1->fetch(PDO::FETCH_BOTH)){

				print '<tr>
					<td>'.$linha1['id_produto'].'</td>
					<td>'.$linha1['produto'].'</td>
					<td>'.$linha1['volume'].'</td>
					<td>R$ '.$linha1['valor_venda'].'</td>
				</tr>';

			}

		}
		print '</table>';

	}


	#@ relatorio de Pedidos em Aberto
	function PedidoAberto($_dt_inicial, $_dt_final){
		
		$_filtro = "";
		
		if(($_dt_inicial == "") && ($_dt_final != "")){
			
			$_filtro = "WHERE dt_pedido < '".$_dt_final."'";
			
			
		} 
		if(($_dt_inicial != "") && ($_dt_final != "")){
				
			$_filtro = "WHERE dt_pedido
			BETWEEN '".$_dt_inicial."' AND '".$_dt_final."'";
				
		}
		if(($_dt_inicial != "") && ($_dt_final == "")){
				
			$_filtro = "WHERE dt_pedido > '".$_dt_inicial."'";
				
		}
		
		// nao retornar registros
		if(($_dt_inicial == "") && ($_dt_final == "")){
		
			$_filtro = "WHERE dt_pedido < '1900/01/01'";
		
		}
		
		$dados = array();
		
		$sql = "SELECT id_pedido,
				id_cliente,
				subtotal,
				desc_valor,
				total,
				forma,
				obs,
				dt_pedido,
				num_parcela,
				situacao
				FROM pedido ".$_filtro." AND situacao = 0";
		
		//print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		while ($linha = $result->fetch()) {
			
			$dados[] = $linha;
			
		}
		
		return $dados;

	}

	
	#@ relatorio de Pedidos quitados
	function PedidoQuitado($_dt_inicial, $_dt_final){
	
		$_filtro = "";
	
		if(($_dt_inicial == "") && ($_dt_final != "")){
				
			$_filtro = "WHERE dt_pgto < '".$_dt_final."'";
				
				
		}
		if(($_dt_inicial != "") && ($_dt_final != "")){
	
			$_filtro = "WHERE dt_pgto
			BETWEEN '".$_dt_inicial."' AND '".$_dt_final."'";
	
		}
		if(($_dt_inicial != "") && ($_dt_final == "")){
	
			$_filtro = "WHERE dt_pgto > '".$_dt_inicial."'";
	
		}
	
		// nao retornar registros
		if(($_dt_inicial == "") && ($_dt_final == "")){
	
			$_filtro = "WHERE dt_pgto < '1900/01/01'";
	
		}
	
		$dados = array();
	
		$sql = "SELECT id_pedido,
				id_cliente,
				subtotal,
				desc_valor,
				total,
				forma,
				obs,
				dt_pedido,
				num_parcela,
				situacao,
				dt_pgto
				FROM pedido ".$_filtro." AND situacao = 1";
	
		//print $sql;
	
		$result = self::$pdo->query($sql) or die();
	
		while ($linha = $result->fetch()) {
				
			$dados[] = $linha;
				
		}
	
		return $dados;
	
	}
	
	#@ resumo de contas
	function ResumoConta($_dt_inicial, $_dt_final){
		
	$dados = array();
		
	$_filtro = "";
	
		if(($_dt_inicial == "") && ($_dt_final != "")){
				
			$_filtro = "WHERE dt_pgto < '".$_dt_final."'";
				
				
		}
		if(($_dt_inicial != "") && ($_dt_final != "")){
	
			$_filtro = "WHERE dt_pgto
			BETWEEN '".$_dt_inicial."' AND '".$_dt_final."'";
	
		}
		if(($_dt_inicial != "") && ($_dt_final == "")){
	
			$_filtro = "WHERE dt_pgto > '".$_dt_inicial."'";
	
		}
	
		// nao retornar registros
		if(($_dt_inicial == "") && ($_dt_final == "")){
	
			$_filtro = "WHERE dt_pgto < '1900/01/01'";
	
		}
		
		$sql = "SELECT desc_valor,
						dt_pedido,
						dt_pgto,
						situacao
						FROM pedido ".$_filtro;
		
		$result = self::$pdo->query($sql) or die();

		while ($linha = $result->fetch()) {
			
			$dados[] = $linha;
		}
		return $dados;
		
	}
	
	#@ resumo de produto
	function ResumoProdutos($_dt_inicial, $_dt_final){
		
		$dados = array();
		
		$_filtro = "";
		
		if(($_dt_inicial == "") && ($_dt_final != "")){
		
			$_filtro = "WHERE dt_pgto < '".$_dt_final."'";
		
		
		}
		if(($_dt_inicial != "") && ($_dt_final != "")){
		
			$_filtro = "WHERE dt_pgto
			BETWEEN '".$_dt_inicial."' AND '".$_dt_final."'";
		
		}
		if(($_dt_inicial != "") && ($_dt_final == "")){
		
			$_filtro = "WHERE dt_pgto > '".$_dt_inicial."'";
		
		}
		
		// nao retornar registros
		if(($_dt_inicial == "") && ($_dt_final == "")){
		
			$_filtro = "WHERE dt_pgto < '1900/01/01'";
		
		}
		
		$sql = "SELECT i.id_produto as id_produto,
				SUM(i.quantidade) as quantidade,
				p.dt_pgto as dt_pgto,
				i.valor as valor, 
				pro.volume as volume
				FROM item_pedido i
				INNER join pedido p
				ON p.id_pedido = i.id_pedido
				inner join produto pro
				on i.id_item = pro.id_produto "
				.$_filtro."	AND p.situacao = 1
				GROUP BY id_produto";

					   //print $sql;
		
		$result = self::$pdo->query($sql) or die();			

		while ($linha = $result->fetch()) {
			
			$dados[] = $linha;
			
		}
		return $dados;
	}
	
	#@ resumo de produto cancelados
	function ResumoProdutosCancelados($_dt_inicial, $_dt_final){
		
		$dados = array();
		
		$_filtro = "";
		
		if(($_dt_inicial == "") && ($_dt_final != "")){
		
			$_filtro = "WHERE dt_pgto < '".$_dt_final."'";
		
		
		}
		if(($_dt_inicial != "") && ($_dt_final != "")){
		
			$_filtro = "WHERE dt_pgto
			BETWEEN '".$_dt_inicial."' AND '".$_dt_final."'";
		
		}
		if(($_dt_inicial != "") && ($_dt_final == "")){
		
			$_filtro = "WHERE dt_pgto > '".$_dt_inicial."'";
		
		}
		
		// nao retornar registros
		if(($_dt_inicial == "") && ($_dt_final == "")){
		
			$_filtro = "WHERE dt_pgto < '1900/01/01'";
		
		}
		
		$sql = "SELECT i.id_produto as id_produto,
				SUM(i.quantidade) as quantidade,
				p.dt_pgto as dt_pgto,
				i.valor as valor, 
				pro.volume as volume
				FROM item_pedido i
				INNER join pedido p
				ON p.id_pedido = i.id_pedido
				inner join produto pro
				on i.id_item = pro.id_produto "
				.$_filtro."	AND p.situacao = 2
				GROUP BY id_produto";
		
		$result = self::$pdo->query($sql) or die();			

		while ($linha = $result->fetch()) {
			
			$dados[] = $linha;
			
		}
		return $dados;
	}
	

}?>