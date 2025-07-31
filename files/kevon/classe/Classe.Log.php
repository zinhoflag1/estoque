<?php
require_once 'Classe.Conexao.php';



	/**
	 * 
	 */
	class Log {
	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}		
		function GravaLog($_acao) {
			
			$_login = $_SESSION['seguranca']['login'];
			
			$_data = date('Y/m/d H:i:s');
			
			$_ip = $_SERVER['REMOTE_ADDR'];
			
			$sql = 'INSERT INTO cedec_log (login, dt_user, acao, ip) VALUES ('.$_login.', "'.$_data.'", "'.htmlentities($_acao).'", "'.$_ip.'")';
			
			//print_r($sql);
			
			$result = self::$pdo->query($sql) or die();

			return $result;
			
		}
	}
	



















?>