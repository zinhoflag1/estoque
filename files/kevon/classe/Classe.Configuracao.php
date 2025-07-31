<?php

/*#######################################
 * 
 * Parametro o nome do campo da tabela conficuracao a ser testado
 * 
 * campo : 
 * 
 * 	# saldo_negativo
 * 
 * 
 * 
 #######################################################*/
 require_once 'Classe.Conexao.php';

class Config {

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}
	
	
	
	function Parametro($_parametro) {
		$sql = "SELECT " . $_parametro . "
				   FROM configuracao
				   WHERE " . $_parametro . " = 1";
		
		//print $sql;
		
		$result = self::$pdo->query($sql) or die();
		
		$linha = $result->fetch(PDO::FETCH_NUM) ( $result );
		
		if ($linha == 1) {
			
			return true;
		} else {
			
			return false;
		}
	}
}
?>