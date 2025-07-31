<?php session_start();
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
                    <legend class="text-center">Pesquisa Pedido</legend>
                        <form action="secao.php?secao=pedido&acao=buscarAlterar" method="POST" name="frm_cliente">

                                <input class="span3" type="text" placeholder="Número do Pedido" title="Número do Pedido" name="txt_id_pedido"><br />
                                <input class="span3" type="text" placeholder="Data Pedido" title="Data do Pedido" name="txt_dt_pedido" data-mask="99/99/9999"><br />
                                <input class="span7" type="text" placeholder="Nome do Cliente À Implementar" title="Nome do Cliente" name="txt_nome"><br />
                                <button type="submit" class="btn" name="btn_enviar" value="btn_enviar" title="Busca de Pedido">Pesquisar</button>

                        </form>
                        <?php

                           $_txt_id_pedido  = isset($_POST['txt_id_pedido']) ? $_POST['txt_id_pedido'] : false;

                           $_txt_dt_pedido  = isset($_POST['txt_dt_pedido']) ? $_POST['txt_dt_pedido'] : false;

                           $_txt_id_cliente  = isset($_POST['txt_id_cliente']) ? $_POST['txt_id_cliente'] : false;

                           $_txt_enviar = isset($_POST['btn_enviar']) ? true : "";

                           //var_dump($_POST);

                           //print $_txt_id_pedido;

                           if($_txt_enviar){

                               $dados = $_pedido->BuscarPedidoAlterar($_txt_id_pedido,
                                                            DataMysql::dataForm($_txt_dt_pedido),
                                                            $_txt_id_cliente);

                               //var_dump($dados);

                               print "<table class=\"table\">
                                       <tr>
                                        <th bgcolor='cbccda'>Código Pedido</th>
                                        <th bgcolor='cbccda'>Data Pedido</th>
                                        <th bgcolor='cbccda'>Cliente</th>
                                        <th bgcolor='cbccda'>Situação</th>
                                        <th bgcolor='cbccda' style='text-align:center;'>Ação</th>
                                        </tr>";

                               for ($i=0; $i < count($dados); $i++) {
                               			
                               		$_cor = null;
                               	

                                 switch ($dados[$i]['situacao']) {
                                 	case 0:
                                 	 	$_situacao = 'Em Aberto';
                                 	 	$_opcao = "";
                                 	 	$_link = "cont/remove.php?secao=pedido&id=".$dados[$i]['id_pedido']."";
                                 	 	$_cor = "bgcolor='d7db57'";
                                 	break;
                                 	case 1:
                                 		$_situacao = 'Quitado';
                                 		$_opcao = "disabled";
                                 		$_link = "#";
                                 		$_cor = "bgcolor='4af9a3'";
                                 		break;
                                 	case 2:
                                 		$_situacao = 'Cancelado';
                                 		$_opcao = "disabled";
                                 		$_link = "#";
                                 		$_cor = "bgcolor='f87d6e'";
                                 		break;
                                 	
                                 	default:
                                 		;
                                 	break;
                                 }
                                    print "<tr>
                                        <td ".$_cor.">".$dados[$i]['id_pedido']."</td>
                                        <td ".$_cor.">".$_dataClass->dataVisual($dados[$i]['dt_pedido'])."</td>
                                        <td ".$_cor.">".$_cliente->getNomeCliente($dados[$i]['id_cliente'])."</td>
                                        <td ".$_cor.">".$_situacao."</td>
                                        <td ".$_cor."><a class=\"btn\" href=\"secao.php?secao=pedido&acao=Alterar&id=".$dados[$i]['id_pedido']."\" disabled >Alterar <i class=\"icon-ok\"></i></a>
                                            <a class=\"btn\" href=\"".$_link."\" title=\"Clique aqui para Cancelar\" ".$_opcao.">Cancelar <i class=\"icon-remove-circle\"></i></a>
                                            <a class=\"btn\" href=\"secao.php?secao=pedido&acao=imprimir&id=".$dados[$i]['id_pedido']."\" title=\"Clique aqui para Imprimir\">Impressão<i class=\"icon-remove-circle\"></i></a>
                                            </td>
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