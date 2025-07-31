<?php
require_once 'Classe.Conexao.php';

class Usuario
{
	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	#@ cadastro de usuario
	function Cadastrar($_login, $_senha, $_email, $_lembrete, $_nivel, $_situacao, $_trsenha, $_nome)
	{

		$sql = "INSERT INTO usuario (login,
									 senha,
									 email,
									 lembrete,
									 nivel,
									 situacao,
									 trsenha,
									 nome)
									 VALUES ('" . $_login . "',
											 '" . $_senha . "',
											 '" . $_email . "',
											 '" . $_lembrete . "',
											 '" . $_nivel . "',
											 '" . $_situacao . "',
											 '" . $_trsenha . "',
											 '" . $_nome . "')";

		$result = self::$pdo->query($sql) or die();

		return true;
	}



	#@ pega o id do usuario baseado no email (usuario)
	function PegaIdUsuario($_usuario)
	{

		$sql = "SELECT id_usuario FROM usuario WHERE email = '" . $_usuario . "'";

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch();

		return $linha['id_usuario'];
	}


	#@ combobox com o nome do usuario
	function ComboNomeUsuario()
	{

		$sql = "SELECT id_usuario, nome FROM usuario ORDER BY nome";

		$result = self::$pdo->query($sql) or die();

		print "<select name=\"sel_usuario\" id=\"sel_usuario\">";

		print "<option>Selecione o Usuario</option>";

		while ($linha = $result->fetch()) {

			print "<option value=" . $linha['id_usuario'] . ">" . $linha['nome'] . "</option>";
		}

		print "</select>";
	}
}
