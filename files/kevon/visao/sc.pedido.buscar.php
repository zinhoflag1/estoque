<?php session_start();
	print "<!DOCTYPE html>";

	include_once 'config.inc.php';
	require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
	
	$_login = new Login();
	
	$_login->logado();
	
	?>
	
    
    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    </head>

    <body>
    	<div class="container">
    		<div class="row">
    			<div class="span5">
    				<form action="#" method="POST">
                        <fieldset>
                            <legend>Pesquisa de Produtos</legend>
                            	<div class="controls controls-row">

	                                <input class="input-xlarge span3" type="text" placeholder="Nome do Produto" name="">
	                                	<input class="input-large span2" type="text" placeholder="Quantidade" name=""/>
	                                
	                                <button type="submit" class="btn" id="pesquisa_produto">Pesquisar</button>       
	                            </div>
	                    </fieldset>
    			</div>
    		</div>
    	</div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    </body>
    </html>