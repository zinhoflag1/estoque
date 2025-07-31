<?php session_start();
header ( "Cache-Control: no-cache, must-revalidate" );
    print "<!DOCTYPE html>";
    include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_login = new Login();
    
    $_login->logado();

    $_pedido = new Pedido();

    $_cliente = new Cliente();

    $_dataClass = new DataMysql();


    ?>

    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <!-- CABECALHO -->
        <div class="container">
            <?php include_once 'pagina.cabecalho.php';?>
        </div>
        <div class="container">
            <?php include_once 'pagina.barraVersao.php';?>
        </div>  
        <div class="container"><hr></div>
            <!-- MENU -->
            <div class="container">
               <?php include_once 'pagina.menu.php';?>
            </div>
               <!-- CORPO -->
               <div class="container fdo_corpo">
                    <br />
                    <legend class="text-center">Pesquisa Pedido Quitar</legend>
                        <form action="secao.php?secao=pedido&acao=buscarQuitar" method="POST" name="frm_cliente">

								Número do Pedido<br>
                                <input class="span3" type="text" placeholder="Número do Pedido" title="Número do Pedido" name="txt_id_pedido"><br />
                                Data para o Fechamento<br>
                                <input class="span3" type="text" placeholder="Data Quitação" title="Data Quitação" name="txt_dt_pgto" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>"><br />
                               
                                <button type="submit" class="btn" name="btn_enviar" value="btn_enviar" title="Busca de Pedido">Pesquisar</button>
                             
                                
                                <br><br>
                                

                        </form>
                        <?php

                           $_txt_id_pedido = isset($_POST['txt_id_pedido']) ? $_POST['txt_id_pedido'] : "";  
                           $_txt_dt_pgto   = isset($_POST['txt_dt_pgto'])   ? $_POST['txt_dt_pgto']   : "";

                           $_txt_enviar = isset($_POST['btn_enviar']) ? true : "";

                           //var_dump($_POST);

                           //print $_txt_id_pedido;
                           $dados = array();

                           if(($_txt_enviar) && ($_txt_id_pedido == "") && ($_txt_dt_pgto == "")){
                               	
                               print "Favor preencher o Número do Pedido e a Data da Quitação !<br>";	
                              
  
						   }elseif (($_txt_enviar) && ($_txt_id_pedido != "") && ($_txt_dt_pgto != "")) {
						   			
						   		$dados = $_pedido->BuscarPedidoQuitar($_txt_id_pedido);

						   }else {
						   		print "Preencher a Data para a Quitação !<br>";
						   	
						   }
   
                               $count_registro = count($dados);
                               
                               if($count_registro <= 0){
                               	
                               	print "Pedido não Encontrado !";
                               
                               }else {

	                               //var_dump($dados);
	
	                               print "<table class=\"table\">
	                                       <tr>
	                                        <th>Código Pedido</th>
	                                        <th>Data Pedido</th>
	                                        <th>Cliente</th>
	                                        <th>Situação</th>
	                                        <th>Ação</th>
	                                        </tr>";
	
	                               for ($i=0; $i < count($dados); $i++) {
	                               	
	                                 switch ($dados[$i]['situacao']) {
	                                 	case 0:
	                                 	 	$_situacao = 'Em Aberto';
	
	                                 	break;
	                                 	case 1:
	                                 		$_situacao = 'Quitado';
	                                 		
	                                 		break;
	                                 	case 2:
	                                 		$_situacao = 'Cancelado';
	                                		
	                                 		break;
	                                 	
	                                 	default:
	                                 		;
	                                 	break;
	                                 }
	                                    print "<tr>
	                                        <td>".$dados[$i]['id_pedido']."</td>
	                                        <td>".$_dataClass->dataVisual($dados[$i]['dt_pedido'])."</td>
	                                        <td>".$_cliente->getNomeCliente($dados[$i]['id_cliente'])."</td>
	                                        <td>".$_situacao."</td>
	                                        <td><a class=\"btn\" onclick=\"return confirm('Deseja Realmente Quitar o Pedido ?');\" href=\"secao1.php?secao=fecharQuitar&id=".$dados[$i]['id_pedido']."&dt=".$_txt_dt_pgto."\">Quitar <i class=\"icon-ok\"></i></a></td>
	                                        </tr>";
	                               }
	
	                               print "</table>";
                               }    
                           
                        ?>
               </div>
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

    <script src="<?php print SISTEMA;?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    </body>
    </html>