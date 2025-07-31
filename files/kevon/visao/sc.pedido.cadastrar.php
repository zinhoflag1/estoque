<?php
session_start ();
header ( "Cache-Control: no-cache, must-revalidate" );
print "<!DOCTYPE html>";
include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_login = new Login();

$_login->logado();

$_linha = new Linha();

$_pedido = new Pedido ();

$_num_pedido = $_pedido->getUltimoPedido ();

$_produto = new Produto ();

$_cliente = new Cliente ();

// var_dump($_SESSION);

/*
 * ####################################################################################################################### CADASTRAR PEDIDO #######################################################################################################################
 */


if (isset ( $_SESSION ['cliente'] )) {
	
	$dados_cliente = $_cliente->BuscarClienteIdDados ( $_SESSION ['cliente'] );
	
	// var_dump($dados_cliente);
} else {
	
	$dados_cliente [0] = array (
			'id_cliente' => 0,
			'tel1' => "",
			'endereco' => "",
			'bairro' => "" 
	);
}

?>

<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
	<!-- CABECALHO -->
	<div class="container">
            <?php include_once 'pagina.cabecalho.php';?>
        </div>
	<div class="container">
            <?php include_once 'pagina.barraVersao.php';?>
        </div>
	<div class="container">
		<hr>
	</div>
	<!-- MENU -->
	<div class="container">
               <?php include_once 'pagina.menu.php';?>
            </div>
	<!-- CORPO -->
	<div class="container">
		<form action="secao1.php?secao=pedido" method="POST" name="frm_pedido_cadastrar">
			<legend>Gerar Pedido</legend>
			<div class="controls controls-row">
				<input class="span2" type="text" name="txt_num_pedido" placeholder="Pedido" value="<?php print $_num_pedido;?>"
					title="Número do Pedido" readonly="readonly">
				&nbsp;&nbsp;&nbsp;<a class="btn window" href="secao.php?secao=cliente&acao=pesquisar" title="Pesquisa de Cliente">Buscar
					Cliente</a>
			</div>
			<div class="controls controls-row">


			
			?>
				<input type="hidden" name="txt_id_cliente" value="<?php print $dados_cliente[0]['id_cliente'];?>" id="txt_id_cliente">
				<input class="span7" type="text" placeholder="Nome do Cliente" name="txt_nome" title="Nome do Cliente"
					value="<?php print $_cliente->getNomeCliente($dados_cliente[0]['id_cliente']);?>" id="txt_nome" readonly="readonly">
				<input class="span3" type="text" placeholder="Telefone" name="txt_telefone" title="Telefone do Cliente"
					value="<?php print $dados_cliente[0]['tel1'];?>" id="txt_telefone" readonly="readonly">

				</dasiv>

				<div class="controls controls-row">
					<input class="span7" type="text" placeholder="Endereço" name="txt_endereco" title="Endereço do Cliente"
						value="<?php print $dados_cliente[0]['endereco'];?>" id="txt_endereco" readonly="readonly">
					<input class="span3" type="text" placeholder="Bairro" name="txt_bairro" title="Bairro do Cliente"
						value="<?php print $dados_cliente[0]['bairro'];?>" id="txt_bairro" readonly="readonly">
				</div>
				<div class="controls controls-row">
					<a href="secao.php?secao=produto&acao=adicionar" class="btn window" title="Adiciona Produto no Pedido" id="pesquisa_produto"
						onbeforeunload="AtualizaCesta();">Adicionar Produtos</a>
				</div>
				<br />
				<div class="span12 text-center">Produtos</div>
				<br />

				<div class="row">
				
				<?php
				
				// produtos do pedido
				print "<table class='table table-striped' border=\"0\">
                       <tr>
						<td>Código</td>
		                <td>Linha</td>
                        <td>Nome</td>
                        <td>Volume</td>
                        <td>Quantidade</td>
                        <td>Vr.Unitário</td>
                        <td>Vr.Total</td>
                        <td>Ação</td>
                      </tr>";
				
				// var_dump($_SESSION);
				
				// if(!isset($_SESSION['cesta'])){
				
				// $_dados = array();
				// $_SESSION['cesta'] = array();
				
				// }else {
				
				if (isset ( $_SESSION ['cesta'] )) {
					
					$_dados = $_SESSION ['cesta'];
					$_total = 0;
					
					// unset($_SESSION['cesta']);
					
					 //var_dump($_SESSION['cesta']);
				
					
					for($i = 0; $i < count ( $_dados ); $i ++) {
						
						$_soma = $_dados [$i] [3] * $_dados [$i] [4];
						
						print "<tr>
                               <td>" . $_dados [$i] [0] . "</td>
                               <td>" . $_linha->getLinha($_dados [$i] [1]) . "</td>
                               <td>" . $_dados [$i] [2] . "</td>
                               <td>" . $_dados [$i] [5] . "</td>
                               <td>" . $_dados [$i] [3] . "</td>
                               <td>R$" . number_format ( $_dados [$i] [4], 2, ',', '.' ) . "</td>
                               <td><b>R$" . number_format ( $_soma, 2, ',', '.' ) . "</b></td>
                               <td><a href=\"cont/remove.php?secao=item&id=" . $i . "\" title=\"Remove Item\"><i class=\"icon-remove-circle\"></i></a></td></tr>";
						
						$_total += $_soma;
					}
					
					$_btn_remove = isset ( $_POST ['btn_remove'] ) ? true : "";
					
					$_id_remove = isset ( $_POST ['item_remove'] ) ? $_POST ['item_remove'] : "";
					
					// var_dump($_POST);
					
					// if($_btn_remove){
					
					// unset($_SESSION['cesta'][$_id_remove]);
					// $_SESSION['cesta'] = array_values($_SESSION['cesta']);
					
					// }
					
					print "<tr>
							<td colspan=\"7\"><hr></td>
                           <tr>
						   <tr>
							<td colspan=\"5\">Sub-Total</td>
                            <td colspan=\"2\"><b>R$" . number_format ( $_total, 2, ',', '.' ) . "<input type=\"hidden\" name=\"txt_subtotal\" id=\"txt_subtotal\" value=\"" . $_total . "\"></b></td>
                            
                           </tr>";
				
				}
				?>

                                                <tr>
						<td colspan="4">Desconto</td>
						<td>
							<input type="text" class="span1" name="txt_desc_perc" id="txt_desc_perc" title="Percentual Desconto"
								onblur="javascript:percent_desconto();">
							%
						</td>
						<td colspan="2" class="alert alert-error">
							<input type="text" class="span2 inline" name="txt_desc_valor" id="txt_desc_valor" title="Valor Desconto"
								onchange="javascript:desconto();">
						</td>

					</tr>
					<tr>
						<td colspan="5">Total</td>
						<td colspan="2" class="alert alert-info span1">
							R$
							<input type="text" class="span2" name="txt_total" id="txt_total" readonly="readonly">
						</td>
					</tr>
					</table>
				</div>
				<div class="row">
					<div class="controls controls-row">
						<label>Data Pedido</label>
						<input class="" type="text" name="txt_dt_pedido" id="txt_dt_pedido" title="Data do Pedido" data-mask="99/99/9999"
							value="<?php print date('d/m/Y');?>">
						<label>Forma de Pagamento:</label>
						<label class="radio inline">
							<input type="radio" id="inlineradio1" value="0" name="rdb_pagamento" checked="checked">
							À Vista
						</label>
						<label class="radio inline">
							<input type="radio" id="inlineradio2" value="1" name="rdb_pagamento">
							Cheque
						</label>
						<label class="radio inline">
							<input type="radio" id="inlineradio3" value="2" name="rdb_pagamento">
							Cartão
						</label>
						
						<label>Parcelas</label>
						<select name="sel_parcela" id="sel_parcela">
							<option value="1">Nº de Parcelas</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
						</select>
						
						<input class="" type="text" name="txt_parcela" id="txt_parcela" title="Quantidade e valor da parcela" >

						<br /> <br />
						<label></label>
						<textarea placeholder="Observações:" class="field span6" rows="5" name="txt_obs"></textarea>
						<div class="span6">
							<br /> <br />
							<button type="submit" class="btn" id="pesquisa_produto" value="btn_fechar_pedido" name="btn_fechar_pedido"
								title="Gerar Pedido" onclick="javascript:return confirm('Confirmar o Fechamento do Pedido ?');">Gravar pedido</button>
						</div>

					</div>
				</div>




			</div>
		</form>


	</div>
	<!-- RODAPE -->
	<div class="container">
		<br /> <br /> <br /> <br /> <br /> <br /> <br />
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">
      $(document).ready(function(){

          /* Quando algum hyperlink com a classe "window" for clicado */

          $('a.window').click(function()
          {
            var dimensions = (this.rel)
              ? this.rel
              : '1000x500';
            dimensions = dimensions.split('x');
            var width = dimensions[0];
            var height = dimensions[1];
            var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
            bWindow.focus();
            return false;
          });

        });


        $("#btn_remove").click(function(){

            var i = $("#btn_remove").attr("name");

                //var i = $('hidden').attr('item_remove');

                var url = "visao/teste.php?index=" + i;

                // var data = $("#botao").attr("id");

                $.post(url, function(result) {
                    $("#resposta").html("Resultado do PHP: " + result); // Só pra verificar retorno
                });

            });

      function AtualizaCesta(){

        location.reload(this);

      };

      // gera o percentual de desconto
      function percent_desconto(){

        $("#txt_desc_valor").val($("#txt_subtotal").val() * $("#txt_desc_perc").val() / 100);

        $("#txt_total").val($("#txt_subtotal").val() - $("#txt_desc_valor").val());
      }

      // calcula o desconto do pedido
      function desconto(){

        valor_desconto = $("#txt_desc_valor").val();

        valor_desconto = valor_desconto.replace( ",", "." );

        $("#txt_total").val($("#txt_subtotal").val() - valor_desconto);

      }

      // calculo das parcelas do pedido
      $(document).ready(function(){

		$("#sel_parcela").change(function()
    	  	{

	          var valor = $("#txt_total").val(); 
	
	          var num_parcela = $("#sel_parcela").val();
	
	          var parcela = valor / num_parcela; 

	          //$("#parcela").val();	
	
	        	$("#txt_parcela").val(num_parcela + "X de R$ " + parcela.toFixed(2));	
	
	      	});

      });

    </script>
</body>
</html>