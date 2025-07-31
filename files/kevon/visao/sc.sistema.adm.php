<?php session_start();
	print "<!DOCTYPE html>";
	include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

    $_linha = new Linha();

    $_produto = new Produto();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
    </head>
    <body onload="esconde()">
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
                     <br />
                    <form action="secao1.php?secao=reajuste" method="POST" name="frm_cliente">
                    <legend class="text-center">Reajuste de Preços de Produtos</legend>
                        <div class="controls controls-row">
                            <label class="radio">
                            <input type="radio" id="rdb_reajuste_total" value="0" name="rdb_reajuste" onchange="javascript:escondeFunc();" checked="checked"> Reajutes Geral de Valores
                            </label>
                            <label class="radio">
                            <input type="radio" id="rdb_reajuste_linha" value="1" name="rdb_reajuste" onchange="javascript:escondeFunc();"> Reajuste por Categoria
                            </label>
                            <label class="radio">
                            <input type="radio" id="rdb_reajuste_produto" value="2" name="rdb_reajuste" onchange="javascript:escondeFunc();"> Reajuste por Produto
                            </label>
                            <br />
                            <label>Índice</label><p style="color:red"></b>
                            <div class="controls controls-row">
                                <input class="span1" type="text" placeholder="Índice" name="txt_indice" id="txt_indice" onblur="javascript: removeVirgula();">
                            </div>
                            <label id="lbl_linha">Categoria</label>
                            <?php print $_linha->ComboLinha();?>
                            <br />
                            <label id="lbl_produto">Produto</label>
                            <?php print $_produto->ComboProduto();?>
                            <br /><br />
                            <div class="span6">
                                <button type="submit" class="btn" id="pesquisa_produto" name="btn_enviar">Reajustar</button>
                            </div>
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

        function esconde() {

            $("#sel_produto").hide();
            $("#lbl_produto").hide();
            $("#sel_linha").hide();
            $("#lbl_linha").hide();
        }

        function escondeFunc(){

            if($("#rdb_reajuste_total").is(":checked")){

                $("#sel_produto").hide();
                $("#lbl_produto").hide();
                $("#sel_linha").hide();
                $("#lbl_linha").hide();

            }else if($("#rdb_reajuste_produto").is(":checked")){

                $("#sel_produto").show();
                $("#lbl_produto").show();
                $("#sel_linha").hide();
                $("#lbl_linha").hide();

            }else if($("#rdb_reajuste_linha").is(":checked")){

                $("#sel_produto").hide();
                $("#lbl_produto").hide();
                $("#sel_linha").show();
                $("#lbl_linha").show();

            }
        }

        function removeVirgula() {

    		var indice = $("#txt_indice").val();
    		        	  
        	indice = indice.replace( ",", "." );

        	$("#txt_indice").val(indice);


          }
    </script>
    </body>
    </html>