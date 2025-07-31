<?php
require_once 'Classe.Conexao.php';

class Vendedor
{
	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	function Cadastrar(
		$_nome,
		$_cpf,
		$_ci,
		$_dt_nasc,
		$_endereco,
		$_bairro,
		$_cidade,
		$_estado,
		$_cep,
		$_tel1,
		$_tel2,
		$_tel3,
		$_email
	) {

		$sql = "INSERT INTO vendedor (nome,
									  cpf,
									  ci,
									  dt_nasc,
									  endereco,
									  bairro,
									  cidade,
									  estado,
									  cep,
									  tel1,
									  tel2,
									  tel3,
									  email) VALUES ('" . $_nome . "',
													 '" . $_cpf . "',
													 '" . $_ci . "',
													 '" . $_dt_nasc . "',
													 '" . $_endereco . "',
													 '" . $_bairro . "',
													 '" . $_cidade . "',
													 '" . $_estado . "',
													 '" . $_cep . "',
													 '" . $_tel1 . "',
													 '" . $_tel2 . "',
													 '" . $_tel3 . "',
													 '" . $_email . "')";

		$result = self::$pdo->query($sql) or die();


		return true;
	}

	#@ Busca Vendedor com base Nome e Retorna o ID
	function BuscarVendedorNomeId($_nome)
	{

		$sql = "select id_vendedor, nome from vendedor where nome like '%" . $_nome . "%'";

		$result = self::$pdo->query($sql) or die();


		print 	'<table class="table">
					<tr>
						<td>Codigo</td><td>Nome</td><td>Ação</td>
					</tr>';

		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

			print 	'<tr>
						<td>' . $linha['id_vendedor'] . '</td>
				   		<td>' . $linha['nome'] . '</td>
				   		<td><a href="secao.php?secao=vendedor&acao=Alterar&id=' . $linha['id_vendedor'] . '" class="btn" title="Clique aqui para Alterar !">Alterar <i class="icon-ok"></i></a>
				   		<a href="cont/remove.php?secao=vendedor&id=' . $linha['id_vendedor'] . '" onclick="javascript:return confirm(\'Deseja Excluir Registro ?\');" class="btn" title="Clique aqui para Excluir !">Remover <i class="icon-remove-sign"></i></a>
				   		</td>
					</tr>';
		}

		print '</table>';
	}

	#@ Busca Cliente com base no Identificador e retorna todos os dados para alteração
	function BuscarVendedorNomeAlterar($_id_vendedor)
	{

		$dados = array();

		$sql = "select id_vendedor,
					   nome,
					   cpf,
					   ci,
					   dt_nasc,
					   endereco,
					   bairro,
					   cidade,
					   estado,
					   cep,
					   tel1,
					   tel2,
					   tel3,
					   email from vendedor where id_vendedor = " . $_id_vendedor;

		$result = self::$pdo->query($sql) or die();


		$linha = $result->fetch(PDO::FETCH_ASSOC);

		$dados[] = $linha;

		return $dados;
	}

	#@ Alterar Cadatro Vendedor
	function ALterar(
		$_id_vendedor,
		$_nome,
		$_cpf,
		$_ci,
		$_dt_nasc,
		$_endereco,
		$_bairro,
		$_cidade,
		$_estado,
		$_cep,
		$_tel1,
		$_tel2,
		$_tel3,
		$_email
	) {

		$sql = "UPDATE vendedor SET nome 	= '" . $_nome . "',
									cpf 	= '" . $_cpf . "',
									ci  	= '" . $_ci . "',
									dt_nasc = '" . $_dt_nasc . "',
									endereco= '" . $_endereco . "',
									bairro  = '" . $_bairro . "',
									cidade  = '" . $_cidade . "',
									estado  = '" . $_estado . "',
									cep     = '" . $_cep . "',
									tel1    = '" . $_tel1 . "',
									tel2    = '" . $_tel2 . "',
									tel3    = '" . $_tel3 . "',
									email   = '" . $_email . "'
									WHERE id_vendedor = " . $_id_vendedor . "";

		$result = self::$pdo->query($sql) or die();


		return true;
	}

	#@ remove Vendedor
	function RemoveVendedor($_id_vendedor)
	{

		$sql = "DELETE FROM vendedor WHERE id_vendedor=" . $_id_vendedor;

		$result = self::$pdo->query($sql) or die();

		return $result;
	}

	/**
	 * total de registro de vendedor
	 * @param
	 **/
	function totalVendedor()
	{
		$sql = "SELECT count(id_vendedor) as id_vendedor
				FROM vendedor";

		$result = self::$pdo->query($sql) or die();


		$linha = $result->fetch(PDO::FETCH_ASSOC);

		return $linha['id_vendedor'];
	}
}
