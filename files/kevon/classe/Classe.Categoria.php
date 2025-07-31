<?php
require_once 'Classe.Conexao.php';

class Categoria 
{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}
	
	#@ Cadastro de Categoria de Produtos
	function Cadastrar($_nome){

		$sql = "INSERT INTO categoria (nome) VALUES ('".$_nome."')";
		
		$result = self::$pdo->query($sql) or die('erro Cadastro Categoria');

		return $result;
	}

	#@ getCategoria
	function getCategoria($_id_categoria){

		$sql = "select nome from categoria where id_categoria = ".$_id_categoria;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch();

		return $linha['nome'];

	}

	#@ Busca categoria com base Nome e Retorna o ID
	function BuscarCategoriaNomeId($_nome){

		$sql = "select id_categoria, nome from categoria where nome like '%".$_nome."%'";

		$result = self::$pdo->query($sql) or die();

		print 	'<table class="table">
					<tr>
						<td>Codigo</td><td>Nome</td><td>Ação</td>
					</tr>';

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			print 	'<tr>
						<td>'.$linha['id_categoria'].'</td>
				   		<td>'.$linha['nome'].'</td>
				   		<td><a href="secao.php?secao=categoria&acao=Alterar&id='.$linha['id_categoria'].'" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   			<a href="cont/remove.php?secao=categoria&id='.$linha['id_categoria'].'" onclick="javascript:return confirm(\'Deseja Excluir Registro ?\');" class="btn" title="Clique aqui para Deletar !">Remover <i class="icon-remove-sign"></i></a></td>
					</tr>';

		}

			print '</table>';

	}

	#@ Busca Categoria com base no Identificador e retorna todos os dados para alteração
	function BuscarCategoriaNomeAlterar($_id_categoria){

		$dados = array();

		$sql = "select id_categoria, nome
					   	     from categoria where id_categoria = ".$_id_categoria;

							$result = self::$pdo->query($sql) or die();

							$linha = $result->fetch(PDO::FETCH_ASSOC);

							$dados[] = $linha;

							return $dados;


	}

	#@ Alterar Cadatro categoria
	function ALterar($_id_categoria,
                     	$_nome) {

		$sql = "UPDATE categoria SET nome 	= '".$_nome."'
									WHERE id_categoria = ".$_id_categoria."";

		$result = self::$pdo->query($sql) or die();

		return true;

	}

	#@ combobox com as categorias
	function ComboCategoria($_id_categoria = null){

		if($_id_categoria == null) {

			$_id_categoria = 0;
			$_nome_categoria = "Selecione a Categoria";

		}else {

			$_nome_categoria = Categoria::getCategoria($_id_categoria);
		}

		$sql = "select id_categoria, nome from categoria order by nome";

		$result = self::$pdo->query($sql) or die();

		print "<select name=\"sel_categoria\" id=\"sel_categoria\">";
		print "<option value=\"".$_id_categoria."\">".$_nome_categoria."</option>";

		while($linha = $result->fetch(PDO::FETCH_ASSOC)){

			print "<option value=\"".$linha['id_categoria']."\">".$linha['nome']."</option>";
		}

		print "<select>";


	}

	#@ remove Categoria
	function RemoveCategoria($_id_categoria){

		$sql = "DELETE FROM categoria WHERE id_categoria =".$_id_categoria;

		$result = self::$pdo->query($sql) or die();

		return true;
	}
	
}?>