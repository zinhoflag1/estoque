<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


	include_once 'include.inc.php';

	$conexao = new Conexao();

	$_usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";

	$_senha = isset($_POST['senha']) ? $_POST['senha'] : "";

	$login = new Login();

	$login->logar($_usuario, $_senha, true);


?>