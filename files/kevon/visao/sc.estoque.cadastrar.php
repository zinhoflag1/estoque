<?php
session_start ();
print "<!DOCTYPE html>";
include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
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
		<legend>Cadastro Estoque</legend>
		<form action="secao1.php?secao=estoque" method="POST">
			<br />
			
				

			<div class="controls">
				
				<input type="hidden" name="txt_id_produto" id="txt_id_produto"></input>
				<input type="hidden" name="txt_id_linha" id="txt_id_linha"></input>
				
				<label>Produto</label>
				<input class="span6" type="text" placeholder="Produto" name="txt_nome" id="txt_nome" readonly="readonly" title="Nome do Produto para Alimentar o Estoque"></input><br>
				<input class="span4" type="text" placeholder="Volume" name="txt_volume" id="txt_volume" readonly="readonly" title="Volume do Produto"></input>
				<a href="secao.php?secao=produto&acao=pesquisar" class="btn window" name="" id="">Buscar Produto</a>
				
				<label>Quantidade</label>
				<input class="span2" type="text" placeholder="Quantidade" name="txt_quantidade" title="Quantidade de Produtos para o Estoque"></input>
				
				<label>Valor Compra</label>
				<input class="span4" type="text" placeholder="Valor Compra" name="txt_valor_compra" id="txt_valor_compra" value="0" onblur="javascript: removeVirgula(); calculaPercentual();" title="Valor de Compra do Produto" ></input>
				
				<label>Valor Venda</label>
				<input class="span4" type="text" placeholder="Valor Venda" name="txt_valor_venda" id="txt_valor_venda" value="0" onblur="javascript: removeVirgula(); calculaPercentual();" title="Valor de Venda do Produto"></input>
				
				
				<label>Percentual</label>
				<input class="span4" type="text" placeholder="Valor" name="txt_percentual" id="txt_percentual" title="Porcentagem de lucro do Produto"></input>
				
				<div class="controls controls-row">
					<textarea rows="4" class="field span8" placeholder="Observação" name="txt_observacao" title="Informação Adicional do Produto em estoque"></textarea>
				</div>

				<button type="submit" class="btn" name="btn_enviar" onclick="return confirm('Confirmar o Cadastro ?');" title="Confirmar o Cadastro de Estoque">Cadastrar</button>

			</div>
		</form>

	</div>
	<!-- RODAPE -->
	<div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
	<script type="text/javascript">
      $(document).ready(function(){

          /* Quando algum hyperlink com a classe "window" for clicado */

          $('a.window').click(function()
          {
            var dimensions = (this.rel) 
              ? this.rel
              : '660x300';
            dimensions = dimensions.split('x');
            var width = dimensions[0];
            var height = dimensions[1];
            var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
            bWindow.focus();
            return false; 
          });
        });


      function removeVirgula() {

		var compra = $("#txt_valor_compra").val();
    	  
    	compra = compra.replace( ",", "." );

    	$("#txt_valor_compra").val(compra);

    	var venda = $("#txt_valor_venda").val();

    	venda = venda.replace( ",", "." );

    	$("#txt_valor_venda").val(venda);


      }



      function calculaPercentual(){

            var venda = $("#txt_valor_venda").val();

            var compra = $("#txt_valor_compra").val();

            var percentual = (((venda / compra) -1) *100);
	
            $("#txt_percentual").val(percentual.toFixed(2));


        }
            

    </script>


</body>
</html>