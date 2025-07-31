<?php session_start(); 

include_once 'include.inc.php';

	$conexao = new Conexao();
	
	$_login = new Login();

	if($logout == "s"){
		
	#@ Faz o logout 
	$_login->logout();	
		
	}

	
	

?>