<?php session_start();
  print "<!DOCTYPE html>";
include_once 'include.inc.php';

require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_login = new Login();

$_login->logado();

$_pedido = new Pedido();

$_cliente = new Cliente();

$_produto = new Produto();

$_linha = new Linha();

$_id_pedido = isset($_GET['id']) ? $_GET['id'] : null;

# tipo do flag para voltar 
$_tipo = isset($_GET['tp']) ? $_GET['tp'] : null;


  //$_id_pedido = $_pedido->getUltimoPedido();
  

?>


<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <style>
  
  @media print {
  	
  	.voltar {
  		
  		display: none;
  		
  	}
  	
  	
  }
  
  body {
    height: 29.5cm;
    width:21cm ;
    /* to centre page on screen*/
    margin-left: auto;
    margin-right: auto;
    background-image: url('img/fdo_pedido.png');
    background-position: center center;
    background-repeat: no-repeat;
    /*border: 0.1em solid;*/
    font-family: tahoma;
    font-size: 12px;

  }

  .tab_produto{

    /*border-right: 0.1em solid; */

  }

  .tab_cabecalho{

    background-color: "#C0C0C0";

  }

  .produto {

    height: 500px;

  }

  .obs {

    min-height: 100px;


  }
  </style>
  <head>
    <body>

     <?php

     $dados_pedido = $_pedido->PedidoImpressao($_id_pedido);
     $dados_cliente = $_cliente->BuscarClienteIdDados($dados_pedido[0]['id_cliente']);
     $dados_itens = $_pedido->ListaItemPedido($_id_pedido);

    //var_dump($dados_cliente);
    //var_dump($dados_pedido);
     ?>




     <table border="1" width="100%" cellspacing="0" cellpadding="0">
     	<tr>
          <td colspan="6" align="center"><button type="button" class="voltar" onclick="javascript:window.location.href = '<?php print ($_tipo == "0") ? "secao.php?secao=pedido&acao=cadastrar" : "secao.php?secao=pedido&acao=buscarAlterar";?>';" title="Voltar para a Busca de Pedido">Voltar</button>
          	<button type="button" class="voltar" onclick="javascrip: window.print();" title="Clique para Impressão">Imprimir</button
          </td>
        </tr>
        <tr>
          <td width="90%" colspan="3" align="center"><h1>ORÇAMENTO</h1></td>
          <td width="10%" align="center">Nº<h2><?php print $dados_pedido[0]['id_pedido'];?><h2></td>
        </tr>
         <tr>
          <td width="80%" colspan="2"><?php print EMPRESA."<br />".ENDERECO."-".TELEFONE;?></td>
          <td colspan="2">Data: <?php print DataMysql::dataVisual($dados_pedido[0]['dt_pedido']);?></td> 
        </tr>

       <tr>
        <td width="15%">Cliente :</td>
        <td colspan="3"><?php print $dados_cliente[0]['nome_razao'];?></td>
      </tr>
      <tr>
        <td>Representante :</td>
        <td colspan="3"><?php print $dados_cliente[0]['responsavel']?></td>
      </tr>
      <tr>
        <td>Telefone:</td>
        <td colspan="3"><?php print $dados_cliente[0]['tel1'];?></td> 
      </tr>
      <tr>
        <td>Endereço:</td>
        <td colspan="3"><?php print $dados_cliente[0]['endereco'];?></td>
      </tr>
      <tr>
        <td>Bairro:</td>
        <td colspan="3"><?php print $dados_cliente[0]['bairro'];?></td>
      </tr>
      <tr>
        <td colspan="4">

        	<!-- Produdos do pedido  -->
            <table class="table" border='1' cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="center" width="10%">Cod</td>
                <td align="center" width="30%">Produto / Volume</td>
                <td align="center" width="25%">Linha</td>
                <td align="center" width="5%">Qtd</td>
                <td align="center" width="15%">Valor Unid.</td>
                <td align="center" width="15%">Valor</td>
              </tr>
              <?php

              //var_dump($dados_itens);

              #@ total unidades de itens do pedido
              $_qtd_total_produto = 0;

              #@ quantidade de itens de pedido
              $_qtd_itens_pedido = count($dados_itens);
              
              //var_dump($dados_itens);
              
              //if($_qtd_itens_pedido <)

              $_tab_produto = 15 - $_qtd_itens_pedido;

              for ($i=0; $i < $_qtd_itens_pedido; $i++) {
                $_vr_qtd_produto = $dados_itens[$i]['valor']*$dados_itens[$i]['quantidade'];
                $_qtd_produto = $dados_itens[$i]['quantidade'];
                print "<tr>
                <td align=\"center\" class=\"tab_produto\">".$dados_itens[$i]['id_produto']."</td>
                <td class=\"tab_produto\">".$_produto->getProduto($dados_itens[$i]['id_produto'])." - ".$dados_itens[$i]['volume']." </td>
                <td class=\"tab_produto\">".$_linha->getLinha($dados_itens[$i]['id_linha'])."</td>
                <td align=\"center\"class=\"tab_produto\">".$_qtd_produto."</td>
                <td>R$".number_format($dados_itens[$i]['valor'], 2, ',', '.')."</td>
                <td>R$".number_format($_vr_qtd_produto, 2, ',', '.')."</td>
                </tr>";
                $_qtd_total_produto += $_qtd_produto;
              }
              
              if($_tab_produto < 15){

	              #@ preencher restante da tabela de itens
	              for ($i=0; $i < $_tab_produto; $i++) {
	
	                  print "</tr><td>&nbsp;</td>
	                          <td></td>
	                          <td></td>
	                          <td></td>
	                          <td></td>
	                          <td></td></tr>";
	              }
	           }
              ?>
              <tr>
                <td align="right" colspan="3">Qtd Itens &nbsp;</td>
                <td><?php print $_qtd_total_produto;?></td>
                <td>SubTotal</td>
                <td>R$ <?php print number_format($dados_pedido[0]['subtotal'], 2, ',', '.');?></td>
              </tr>
              <tr>
                <td colspan="3">Forma Pagamento :
                    <?php if($dados_pedido[0]['forma'] == 0){

                      print "À Vista";

                    }elseif ($dados_pedido[0]['forma'] == 1) {

                      print "Cheque : " . $dados_pedido[0]['num_parcela'] . "X de R$ ".number_format($dados_pedido[0]['total'] / $dados_pedido[0]['num_parcela'], 2, ',', '.');;

                    }elseif ($dados_pedido  [0]['forma'] == 2) {

                      print "Cartão : ". $dados_pedido[0]['num_parcela'] . "X de R$ ".number_format($dados_pedido[0]['total'] / $dados_pedido[0]['num_parcela'], 2, ',', '.');

                    };?>
                </td>
                <td></td>
                <td style="color: red;">Desconto (-)</td>  
                <td style="color: red;">R$<?php print number_format($dados_pedido[0]['desc_valor'], 2, ',', '.');?></td>
              </tr>
              <tr>
                <td colspan="4"></td>
                <td><b>Total</b></td>
                <td><b>R$ <?php print number_format($dados_pedido[0]['total'], 2, ',', '.');?></b></b></td>
              </tr>
              <tr>
                <td colspan="6">Observação :<br /><p class="obs"><?php print $dados_pedido[0]['obs'] ?></td>
              </tr>
            </table>
        </td>
        </tr>
      </table>
    </body>
    </html>