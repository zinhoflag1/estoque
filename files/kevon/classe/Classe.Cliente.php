<?php
require_once 'Classe.Conexao.php';


class Cliente
{
	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	function Cadastrar(
		$_pessoa,
		$_nome_razao,
		$_cpf_cnpj,
		$_ci_inscr,
		$_endereco,
		$_bairro,
		$_cidade,
		$_estado,
		$_cep,
		$_responsavel,
		$_tel1,
		$_tel2,
		$_tel3,
		$_dt_nasc,
		$_email
	) {

		$sql = "INSERT INTO cliente (pessoa,
										nome_razao,
										cpf_cnpj,
										ci_inscr,
										endereco,
										bairro,
										cidade,
										estado,
										cep,
										responsavel,
										tel1,
										tel2,
										tel3,
										dt_nasc,
										email) VALUES ('" . $_pessoa . "',
														'" . $_nome_razao . "',
														'" . $_cpf_cnpj . "',
														'" . $_ci_inscr . "',
														'" . $_endereco . "',
														'" . $_bairro . "',
														'" . $_cidade . "',
														'" . $_estado . "',
														'" . $_cep . "',
														'" . $_responsavel . "',
														'" . $_tel1 . "',
														'" . $_tel2 . "',
														'" . $_tel3 . "',
														'" . $_dt_nasc . "',
														'" . $_email . "')";

		$result = self::$pdo->query($sql) or die('erro Cadastro Cliente');

		return $result;
	}

	#@ Busca Cliente com base Nome e Retorna o ID
	function BuscarClienteNomeId($_nome)
	{

		$sql = "select id_cliente, nome_razao from cliente where nome_razao like '%" . $_nome . "%'";

		$result = self::$pdo->query($sql) or die(' erro busca Cliente');

		print 	'<table class="table">
					<tr>
						<td>Codigo</td><td>Nome</td><td>Ação</td>
					</tr>';

		while ($linha = $result->fetch()) {

			print 	'<tr>
						<td>' . $linha['id_cliente'] . '</td>
				   		<td><a href="#" onclick="abrirPopup(\'secao.php?secao=cliente&acao=dados&id=' . $linha['id_cliente'] . '\', 500, 400)" title="Clique para Informações sobre Cliente">' . $linha['nome_razao'] . '</a></td>
				   		<td><a href="secao.php?secao=cliente&acao=Alterar&id=' . $linha['id_cliente'] . '" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   			<a href="cont/remove.php?secao=cliente&id=' . $linha['id_cliente'] . '" onclick="javascript:return confirm(\'Deseja Excluir Registro ?\');" class="btn" title="Clique aqui para Excluir !">Remover<i class="icon-remove-sign"></i></a></td>
					</tr>';
		}

		print '</table>';
	}

	#@ Busca Cliente com base Nome e Retorna os Dados
	function BuscarClienteNomeDados($_nome)
	{

		$dados = array();

		$sql = "SELECT id_cliente,
				   pessoa,
 				   nome_razao,
				   cpf_cnpj,
				   ci_inscr,
				   endereco,
				   bairro,
				   cidade,
				   estado,
				   cep,
				   responsavel,
				   tel1,
				   tel2,
				   tel3,
				   dt_nasc,
				   email
                           FROM cliente
                           WHERE nome_razao LIKE '%" . $_nome . "%'";

		//print $sql;

		$result = self::$pdo->query($sql) or die();


		while ($linha = $result->fetch()) {

			$dados[] = $linha;
		}

		return $dados;
	}

	#@ Busca Cliente com base ID e Retorna os Dados
	function BuscarClienteIdDados($_id_cliente)
	{

		$dados = array();

		$sql = "SELECT id_cliente,
				   pessoa,
 				   nome_razao,
				   cpf_cnpj,
				   ci_inscr,
				   endereco,
				   bairro,
				   cidade,
				   estado,
				   cep,
				   responsavel,
				   tel1,
				   tel2,
				   tel3,
				   dt_nasc,
				   email
                           FROM cliente
                           WHERE id_cliente = " . $_id_cliente;

		//print $sql;

		$result = self::$pdo->query($sql) or die();


		while ($linha = $result->fetch()) {

			$dados[] = $linha;
		}

		return $dados;
	}

	#@ Busca Cliente com base no Identificador e retorna todos os dados para alteração
	function BuscarClienteNomeAlterar($_id_cliente)
	{

		$dados = array();

		$sql = "select id_cliente,
				pessoa,
				nome_razao,
				cpf_cnpj,
				ci_inscr,
				endereco,
				bairro,
				cidade,
				estado,
				cep,
				responsavel,
				tel1,
				tel2,
				tel3,
				dt_nasc,
				email from cliente where id_cliente = " . $_id_cliente;

		$result = self::$pdo->query($sql) or die(' erro busca Cliente');

		$linha = $result->fetch(PDO::FETCH_ASSOC);

		$dados = $linha;

		return $dados;
	}

	#@ Alterar Cadatro Cliente
	function ALterar(
		$_id_cliente,
		$_pessoa,
		$_nome_razao,
		$_cpf_cnpj,
		$_ci_inscr,
		$_endereco,
		$_bairro,
		$_cidade,
		$_estado,
		$_cep,
		$_responsavel,
		$_tel1,
		$_tel2,
		$_tel3,
		$_dt_nasc,
		$_email
	) {

		$sql = "UPDATE cliente SET pessoa      = '" . $_pessoa . "',
								   nome_razao  = '" . $_nome_razao . "',
								   cpf_cnpj    = '" . $_cpf_cnpj . "',
								   ci_inscr    = '" . $_ci_inscr . "',
								   endereco    = '" . $_endereco . "',
								   bairro      = '" . $_bairro . "',
								   cidade      = '" . $_cidade . "',
								   estado      = '" . $_estado . "',
								   cep         = '" . $_cep . "',
								   responsavel = '" . $_responsavel . "',
								   tel1        = '" . $_tel1 . "',
								   tel2        = '" . $_tel2 . "',
								   tel3        = '" . $_tel3 . "',
								   dt_nasc     = '" . $_dt_nasc . "',
								   email       = '" . $_email . "'
								   WHERE id_cliente = " . $_id_cliente . "";


		$result = self::$pdo->query($sql) or die(' erro busca Cliente');

		return $result;
	}

	#@ retorna o nome do clente com o id
	function getNomeCliente($_id_cliente)
	{

		$sql = "select nome_razao from cliente where id_cliente = " . $_id_cliente;

		//print $sql;

		$result = self::$pdo->query($sql) or die();


		$linha = $result->fetch();

		//var_dump($linha);

		return $linha['nome_razao'];
	}

	#@ remove Cliente
	function RemoveCliente($_id_cliente)
	{

		$sql = "DELETE FROM cliente WHERE id_cliente =" . $_id_cliente;

		$result = self::$pdo->query($sql) or die();


		return true;
	}

	/**
	 * total de registro de clientes
	 * @param
	 **/
	function totalCliente()
	{
		$sql = "SELECT count(id_cliente) as id_cliente
				FROM cliente";


		$result = self::$pdo->query($sql) or die(' erro select user');

		$linha = $result->fetch(PDO::FETCH_ASSOC);


		return $linha['id_cliente'];
	}
}
