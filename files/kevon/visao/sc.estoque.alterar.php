<?php session_start();
	print "<!DOCTYPE html>";
    include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

    $_estoque = new Estoque();

    $dados = $_estoque->BuscarEstoqueNomeAlterar($_id_produto);

    //var_dump($dados);

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
        <div class="container"><hr></div>
            <!-- MENU -->
            <div class="container">
               <?php include_once 'pagina.menu.php';?>
            </div>
                <!-- CORPO -->
                <div class="container">
                        <legend class="text-center">Alteração Cadastro Estoque</legend>
                    </fieldset>
                    <form action="secao1.php?secao=estoqueAlterar" method="POST" name="frm_estoque">
                        <br />
                        
                        	<label>Código</label>
                            <input class="span2 " type="text" placeholder="Código Estoque" value="<?php print $dados[0]['id_produto'];?>" title="Código do Produto" readonly="readonly" name="txt_codigo">
                        
                            <input type="hidden" name="txt_id_produto" value="<?php print $dados[0]['id_produto'];?>">
                            <input type="hidden" name="txt_id_linha" value="<?php print $dados[0]['id_linha'];?>">
                            
                            <label>Nome</label>
                            <input class="span2" type="text" placeholder="Código Produto" value="<?php print $dados[0]['produto'];?>" title="Produto" name="txt_produto" readonly="readonly"></input>
                            
                            <label>Quantidade</label>
                            <input class="span2" type="text" placeholder="Quantidade"     value="<?php print $dados[0]['quantidade'];?>" title="Quantidade de Produtos em Estoque" name="txt_quantidade"></input>
                            
                            <label>Valor Compra</label>
                            <input class="span4" type="text" placeholder="Valor Compra" value="<?php print $dados[0]['valor_compra'];?>" title="Valor compra da Mercadoria" name="txt_valor_compra" id="txt_valor_compra" onblur="javascript: removeVirgula(); calculaPercentual();"></input>

                            <label>Valor Venda</label>
                            <input class="span4" type="text" placeholder="Valor Venda"  value="<?php print $dados[0]['valor_venda'];?>" title="Valor venda da Mercadoria" name="txt_valor_venda"  id="txt_valor_venda" onblur="javascript: removeVirgula(); calculaPercentual();"></input>
                            
                            <label>Percentual</label>
                            <input class="span4" type="text" placeholder="Percentual" value="<?php print $dados[0]['percentual'];?>" title="Percentual da Mercandoria" name="txt_percentual" id="txt_percentual"></input>
                            
                            <label>Observação</label>
                            <textarea rows="4" class="field span8" placeholder="Observação" title="" name="txt_observacao"><?php print $dados[0]['observacao'];?></textarea>
                       

                            <button type="submit" class="btn" name="btn_enviar" value="btn_enviar">Alterar</button>

                        </div>
                    </form>

                </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
                                    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script type="text/javascript">

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