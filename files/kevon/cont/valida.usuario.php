<?php session_start();

	include_once 'include.inc.php';
	require_once 'classe/Classe.Conexao.php';

	
	//$_conexao = new Conexao();
	
	$_funcaoBase = new FuncaoBase();
	
	$_login = new Login();
    
	$_usuario = isset($_POST['txt_usuario'])? $_POST['txt_usuario'] : null;
	
	if($_funcaoBase->validaEmail($_usuario)){
		
		$_userValido = $_usuario;
		
	}else {
		
		$_userValido = "";
		
	}
		
	$_senha = isset($_POST['txt_senha'])? preg_replace('/[^[:alnum:]_]/', '',$_POST['txt_senha']) : null;

	$_login->logar($_userValido, md5($_senha), true);
	//var_dump($_POST);
?>