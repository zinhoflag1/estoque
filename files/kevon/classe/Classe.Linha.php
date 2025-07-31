<?php
require_once 'Classe.Conexao.php';

class Linha 
{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}
	
	#@ Cadastro de Linha de Produtos
	function Cadastrar($_nome){

		$sql = "INSERT INTO linha (nome) VALUES ('".$_nome."')";
		
		$result = self::$pdo->query($sql) or die();

		return $result;
	}

	#@ getLinha retorna o nome da linha
	function getLinha($_id_linha){

		$sql = "select nome from linha where id_linha = ".$_id_linha;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch();

		return $linha['nome'];

	}

	#@ Busca linha com base Nome e Retorna o ID
	function BuscarLinhaNomeId($_nome){

		$sql = "select id_linha, nome from linha where nome like '%".$_nome."%'";

		$result = self::$pdo->query($sql) or die();


		print 	'<table class="table">
					<tr>
						<td>Codigo</td><td>Nome</td><td>Ação</td>
					</tr>';

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			print 	'<tr>
						<td>'.$linha['id_linha'].'</td>
				   		<td>'.$linha['nome'].'</td>
				   		<td><a href="secao.php?secao=linha&acao=Alterar&id='.$linha['id_linha'].'" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   			<a href="cont/remove.php?secao=linha&id='.$linha['id_linha'].'" onclick="javascript:return confirm(\'Deseja Excluir Registro ?\');" class="btn" title="Clique aqui para Deletar !">Remover <i class="icon-remove-sign"></i></a></td>
					</tr>';

		}

			print '</table>';

	}

	#@ Busca linha com base no Identificador e retorna todos os dados para alteração
	function BuscarLinhaNomeAlterar($_id_linha){

		$dados = array();

		$sql = "select id_linha, nome
					   	     from linha where id_linha = ".$_id_linha;

							$result = self::$pdo->query($sql) or die();

							$linha = $result->fetch(PDO::FETCH_ASSOC);

							$dados[] = $linha;

							return $dados;


	}

	#@ Alterar Cadatro linha
	function ALterar($_id_linha,
                     	$_nome) {

		$sql = "UPDATE linha SET nome 	= '".$_nome."'
									WHERE id_linha = ".$_id_linha."";

$result = self::$pdo->query($sql) or die();

		return $result;

	}

	#@ combobox com as linhas
	function ComboLinha($_id_linha = null){

		if($_id_linha == null) {

			$_id_linha = 0;
			$_nome_linha = "Selecione a Linha de Produtos";

		}else {

			$_nome_linha = Linha::getLinha($_id_linha);
		}

		$sql = "select id_linha, nome from linha order by nome";

		$result = self::$pdo->query($sql) or die();

		print "<select name=\"sel_linha\" id=\"sel_linha\">";
		print "<option value=\"".$_id_linha."\">".$_nome_linha."</option>";

		while($linha = $result->fetch(PDO::FETCH_ASSOC)){

			print "<option value=\"".$linha['id_linha']."\">".$linha['nome']."</option>";
		}

		print "<select>";


	}

	#@ remove Categoria
	function RemoveCategoria($_id_linha){

		$sql = "DELETE FROM linha WHERE id_linha =".$_id_linha;

		$result = self::$pdo->query($sql) or die();

		if(!$result ){

				$erro = $result->errorInfo();
				
				if(strpos($erro, 'CONSTRAINT'))	{
    			
		    		print "<script type='text/javascript'>";
				
					print "alert('Esta Linha esta cadastrada em Algum Produto !');";
					
					print "window.location=\"../secao.php?secao=linha&acao=buscarAlterar\";";
					
					print "</script>";
					
					die();
				
				}else {
					# se o erro nao for de chave estrangeira nao faz nada
				}
    		
    		}else {
				
				return true;
			}
	}
	
	/**
	* total de registro de Linha
	* @param
	**/
	function totalLinha() {
		$sql = "SELECT count(id_linha) as id_linha
				FROM linha";
		
		$result = self::$pdo->query($sql) or die();
		
		$linha = $result->fetch(PDO::FETCH_ASSOC);
		
		return $linha['id_linha'];
	}
	
}?>