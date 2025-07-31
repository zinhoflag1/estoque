<?php session_start();
	include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

$_cliente = new Cliente();

?>
<!DOCTYPE html>
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
                    <legend class="text-center">Pesquisa Cliente</legend>
                    <div class="controls controls-row">
                        <input class="span5" type="text" placeholder="Digite Nome para Pesquisar" name="txt_nome">
                        &nbsp;&nbsp;&nbsp;<button type="submit" class="btn" name="btn_enviar">Pesquisar</button>
                    </div>
                </form>
                <?php

                   $_enviar = isset($_POST['btn_enviar']) ? true : "";
                   $_nome   = isset($_POST['txt_nome']) ? $_POST['txt_nome'] : "";

                   if($_enviar){

                       $dados = $_cliente->BuscarClienteNomeDados($_nome);
                      // var_dump($dados);


                        print "<table class=\"table\">
                                <tr>
                                    <td>Código</td>
                                    <td>Nome/Razão</td>
                                    <td>CPF/CNPJ</td>
                                    <td>Endereço</td>
                                    <td>Ação</td>
                                </tr>";

                       for ($i=0; $i < count($dados); $i++) { 

                           print "<tr><form action=\"#\" method=\"POST\" name=\"frm_cliente".$i."\">

                                    <td><input type=\"text\" value=\"".$dados[$i]['id_cliente']."\" class=\"span3 field\" name=\"txt_add_id_cliente\" readonly=\"readonly\"></td>
                                    <td><input type=\"text\" value=\"".$dados[$i]['nome_razao']."\" class=\"span12 field\" name=\"\" readonly=\"readonly\"></td>
                                    <td><input type=\"text\" value=\"".$dados[$i]['cpf_cnpj']."\"   class=\"span12 field\" name=\"\" readonly=\"readonly\"></td>
                                    <td><input type=\"text\" value=\"".$dados[$i]['endereco']."\"   class=\"span12 field\" name=\"\" readonly=\"readonly\"></td>
                                    <td><input type=\"submit\" name=\"btn_add_cliente\" id=\"btn_add_cliente\" class=\"btn\" value=\"Adicionar\" onclick=\"fechar_atualiza\"></td>
                                </tr>
                                </form>";
                       }

                        print "</table>";
//onclick=\"javascript:levarCodigo(".$dados[$i]['id_cliente'].",'".$dados[$i]['nome_razao']."','".$dados[$i]['cpf_cnpj']."','".$dados[$i]['endereco']."', '".$dados[$i]['bairro']."');\">


                   }

                   $_btn_add_enviar = isset($_POST['btn_add_cliente']) ? true : "";

                        $_id_cliente = isset($_POST['txt_add_id_cliente']) ? $_POST['txt_add_id_cliente'] : "";

                   if($_btn_add_enviar) {

                            $_SESSION['cliente'] = $_id_cliente;

                            print "Cliente Adicionado !<br />";

                            print "<a class='btn' onclick='javascript:fechar_atualiza();'>Fechar</a>";
                        }

                ?>
            </div>
        </div>
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
                : '660x450';
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

        function levarCodigo( id_cliente, nome, telefone, endereco, bairro ){
            window.opener.document.getElementById("txt_id_cliente").value = id_cliente;
            window.opener.document.getElementById("txt_nome").value = nome;
            window.opener.document.getElementById("txt_telefone").value = telefone;
            window.opener.document.getElementById("txt_endereco").value = endereco;
            window.opener.document.getElementById("txt_bairro").value = bairro;
            //window.close();


        }

        function fechar_atualiza(){

            opener.location.reload();
            window.close();

        }

    </script>

    </body>
    </html>