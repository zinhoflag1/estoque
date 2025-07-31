<?php
require_once 'Classe.Conexao.php';


class Produto
{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	// Cadastro de produto
	function Cadastrar($_nome, $_volume, $_id_linha)
	{
		$sql = "INSERT INTO produto (nome, volume, id_linha) VALUES ('" . $_nome . "',
									 '" . $_volume . "',
									 '" . $_id_linha . "')";

		$result = self::$pdo->query($sql) or die();

		return $result;
	}

	// Busca produto com base Nome e Retorna o ID
	function BuscarProdutoNomeId($_nome)
	{
		$sql = "select id_produto, nome, volume from produto where nome like '%" . $_nome . "%'";

		// print $sql;

		$result = self::$pdo->query($sql) or die();

		print '<table class="table">
					<tr>
						<td>Codigo</td>
						<td>Nome</td>
						<td>volume</td>
						<td>Ação</td>
					</tr>';

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			print '<tr>
						<td>' . $linha['id_produto'] . '</td>
				   		<td>' . $linha['nome'] . '</td>
				   		<td>' . $linha['volume'] . '</td>
				   		<td><a href="secao.php?secao=produto&acao=Alterar&id=' . $linha['id_produto'] . '" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   		<a href="cont/remove.php?secao=produto&id=' . $linha['id_produto'] . '" onclick="javascript:return confirm(\'Deseja Excluir Registro ?\');" class="btn" title="Clique aqui para Excluir !">Remover <i class="icon-remove-sign"></i></a>
				   		</td>
					</tr>';
		}

		print '</table>';
	}

	// Busca produto com base no Identificador e retorna todos os dados para alteração
	function BuscarProdutoNomeAlterar($_id_produto)
	{
		$dados = array();

		$sql = "select id_produto,
					   nome,
					   volume,
					   id_linha
					   from produto where id_produto = " . $_id_produto;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_ASSOC);

		$dados[] = $linha;

		return $dados;
	}

	// Alterar Cadatro produto
	function Alterar($_id_produto, $_nome, $_volume, $_id_linha)
	{
		$sql = "UPDATE produto SET nome = '" . $_nome . "',
							volume = '" . $_volume . "',
							id_linha = '" . $_id_linha . "'
							WHERE id_produto = " . $_id_produto . "";

		$result = self::$pdo->query($sql) or die();

		return $result;
	}

	// busca produto para adicionar nacesta
	// parametros nome ou id e quantidade
	function BuscaProdutoNomeId($_id_linha, $_nome)
	{
		$dados = array();

		$filtro = "";

		if (($_id_linha == "") and ($_nome != "")) {

			$filtro = "where p.nome like '%" . $_nome . "%'";
		} elseif (($_id_linha != "") and ($_nome == "")) {

			$filtro = "where e.id_produto = " . $_id_linha;
		}

		$sql = "select e.id_produto as id_produto, e.id_linha as id_linha, e.valor_venda as valor_venda, e.qtd as qtd, p.nome as nome,
				p.volume as volume
				from estoque e
				inner join produto p
				on e.id_produto = p.id_produto
				inner join linha c
				on e.id_linha = c.id_linha " . $filtro;

		print $sql;

				$result = self::$pdo->query($sql) or die();

		while ($linha = $result->fetch()) {

			$dados[] = $linha;
		}

		return $dados;
	}
	function BuscaProdutoNomeIdLinha($_nome)
	{
		$sql = "select p.id_produto, p.nome, p.volume, p.id_linha, c.nome 
			 from produto p
			 inner join linha c
			 on p.id_linha = c.id_linha
			 where p.nome like '%" . $_nome . "%'";

		// print $sql;

				$result = self::$pdo->query($sql) or die();

		while ($linha = $result->fetch()) {

			$dados[] = $linha;
		}

		return $dados;
	}

	// retorna o nome do produtos
	static function getProduto($_id_produto)
	{
		$sql = "select nome from produto where id_produto = " . $_id_produto;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_ASSOC);

		return $linha[0];
	}

	// remove Produto
	function removeProduto($_id_produto)
	{
		$sql = "DELETE FROM produto WHERE id_produto=" . $_id_produto;


		$result = self::$pdo->query($sql) or die();

		if (!$result = self::$pdo->query($sql)) {

			$erro = self::$pdo->errorInfo();

			if (strpos($erro[2], 'CONSTRAINT')) {

				print "<script type='text/javascript'>";

				print "alert('Este produto esta cadastrado no Estoque !');";

				print "window.location=\"../secao.php?secao=produto&acao=buscarAlterar\";";

				print "</script>";

				die();
			} else {
				# se o erro nao for de chave estrangeira nao faz nada
			}
		} else {

			return true;
		}
	}

	// combobox Produto
	function ComboProduto($_id_produto = null)
	{
		if ($_id_produto == null) {

			$_id_produto = 0;
			$_nome_produto = "Selecione a produto";
		} else {

			$_nome_produto = produto::getProduto($_id_produto);
		}

		$sql = "select p.id_produto as id_produto,
				   p.nome as nome,
				   p.volume as volume,
				   c.nome as linha
				   from produto p
				   inner join linha c
				   on p.id_linha = c.id_linha
				   order by nome";

		$result = self::$pdo->query($sql) or die();

		print "<select name=\"sel_produto\" id=\"sel_produto\" style=width:600px>";
		print "<option value=\"" . $_id_produto . "\">" . $_nome_produto . "</option>";

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			print "<option value=\"" . $linha['id_produto'] . "\">" . $linha['nome'] . " / " . $linha['volume'] . " / " . $linha['linha'] . "</option>";
		}

		print "<select>";
	}

	// reajusta preco de mercadoria
	function reajustePreco($_indice = false, $_linha = false, $_id_produto = false)
	{


		$sql = "";

		if (($_indice != "") && ($_linha == "") && ($_id_produto == "")) {

			$sql = "update estoque set valor_venda = valor_venda * (1 + " . $_indice / 100 . ") where id_estoque < 10000";
		} elseif (($_indice != "") && ($_linha != "") && ($_id_produto == "")) {

			$sql = "update estoque set valor_venda = valor_venda * (1 + " . $_indice / 100 . ") where id_linha = " . $_linha;
		} elseif (($_indice != "") && ($_linha == "") && ($_id_produto != "")) {

			$sql = "update estoque set valor_venda = valor_venda * (1 + " . $_indice / 100 . " ) where id_linha = " . $_id_produto;
		}

		$result = self::$pdo->query($sql) or die();

		return $result;
	}

	/**
	 * total de registro de Produtos
	 * @param
	 **/
	function totalProduto()
	{
		$sql = "SELECT count(id_produto) as id_produto
				FROM produto";

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_ASSOC);

		return $linha['id_produto'];
	}
}
