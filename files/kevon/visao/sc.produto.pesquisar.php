<?php session_start();
	print "<!DOCTYPE html>";
	include_once 'include.inc.php';
	
	require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
	
	$_login = new Login();
	
	$_login->logado();
	
	$_produto = new Produto();

?>

<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <form action="#" method="POST" name="frm_cliente">
                    <legend class="text-center">Pesquisa Produto</legend>
                    <div class="controls controls-row">
                        <input class="span3" type="text" placeholder="Digite Nome para Pesquisar" name="txt_nome">
                        <button type="submit" class="btn" name="btn_enviar">Pesquisar</button>
                    </div>
                </form>
                <?php

                   $_enviar = isset($_POST['btn_enviar']) ? true : "";
                   $_nome   = isset($_POST['txt_nome']) ? $_POST['txt_nome'] : "";

                   if($_enviar){

                    $_produto = new Produto();

                    $dados = $_produto->BuscaProdutoNomeIdLinha($_nome);


                        print "<table class=\"table\">
                                <tr>
                                    <td>Código</td>
                                    <td>Nome</td>
                                    <td>Volume</td>
                                    <td>Categoria</td>
                                </tr>";

                       for ($i=0; $i < count($dados); $i++) { 
                           
                           print "<tr>
                                    <td>".$dados[$i][0]."</td>
                                    <td>".$dados[$i][1]."</td>
                                    <td>".$dados[$i][2]."</td>
                                    <td>".$dados[$i][4]."</td>
                                    <td><a class=\"btn\" href=\"javascript:levarCodigo(".$dados[$i][0].",".$dados[$i][3].",'".$dados[$i][1]."', '".$dados[$i][2]."');\">Adicionar</a></td>
                                </tr>";
                       }

                        print "</table>";




                   }
                ?>
            </div>
        </div>
    </div>    
            
                                
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
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
    </script>
    <script type="text/javascript">

        function levarCodigo( id_produto, id_linha, nome, volume ){
            window.opener.document.getElementById("txt_id_produto").value = id_produto;
            window.opener.document.getElementById("txt_id_linha").value = id_linha;
            window.opener.document.getElementById("txt_nome").value = nome;
            window.opener.document.getElementById("txt_volume").value = volume;
            window.close();
        }

    </script>
    
    </body>
    </html>