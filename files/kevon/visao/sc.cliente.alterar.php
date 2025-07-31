<?php session_start();
    header("Cache-Control: no-cache, must-revalidate");
    print "<!DOCTYPE html>";
    include_once 'include.inc.php';

    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();

        $clienteAlterar = new Cliente();

        $_id_cliente = isset($_GET['id']) ? $_GET['id'] : "";

        if($_id_cliente != "") {

            $dados = $clienteAlterar->BuscarClienteNomeAlterar($_id_cliente);

        }else {

            $dados = array();
        }

        //var_dump($dados);

        $_data = new DataMysql();

        $_dado_cpf = $dados['cpf_cnpj'];

        $_dado_cnpj = $dados['cpf_cnpj'];

        if($dados['pessoa'] == 'PF')
        {
            $_pf = 'checked="checked"';
            $_pj = '';

        }
        else
        {

            $_pj = 'checked="checked"';
            $_pf = '';

        }
    ?>
    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
    </head>
    <body onload="javascript:pessoa();">
        <!-- CABECALHO -->
        <div class="container">
                <?php include_once 'visao/pagina.cabecalho.php';?>
        </div>
        <div class="container">
            <?php include_once 'pagina.barraVersao.php';?>
        </div>  
        <div class="container"><hr></div>
            <!-- MENU -->
            <div class="container">
                <?php include_once 'pagina.menu.php';?>

                </div>
            </div>
               <!-- CORPO -->
               <div class="container fdo_corpo">
                     <br />
                    <form action="secao1.php?secao=clienteAlterar" method="POST" name="frm_cliente" autocomplete="off">
                    <input type="hidden" name="id_cliente" value="<?php print $dados['id_cliente'];?>">
                    <legend class="text-center">Alterar Cadastro de Cliente</legend>
                    <div class="controls controls-row">
                        <div class="span1">PF<input type="radio" name="rdb_pessoa" id="rdb_pessoa_pf" value="PF" <?php print $_pf;?> onchange="javascript:pessoa();"></div>
                        <div class="span1">PJ<input type="radio" name="rdb_pessoa" id="rdb_pessoa_pj" value="PJ" <?php print $_pj;?> onchange="javascript:pessoa();"></div>
                        <div class="span8"><br /><br /></div>
                    </div>
                    <div class="controls controls-row">

                        <input class="span7" type="text" title="Nome do Cliente" autocomplete="off" value="<?php print $dados['nome_razao'];?>" name="txt_nome">
                        <input class="span4" type="text" title="CPF Cliente"  data-mask="999.999.999-99"     id="txt_cpf"  value="<?php print $_dado_cpf;?>" name="txt_cpf">
                        <input class="span4" type="text" title="CNPJ Cliente" data-mask="99.999.999/9999-99" id="txt_cnpj" value="<?php print $_dado_cnpj;?>" name="txt_cnpj">
                    </div>
                    <div class="controls controls-row">

                        <input class="span8" type="text" placeholder="Endereço"           title="Endereco do Cliente"    value="<?php print $dados['endereco'];?>" name="txt_endereco">
                        <input class="span4" type="text" placeholder="C.I"                title="Carteira de Identidade" value="<?php print $dados['ci_inscr'];?>" name="txt_ci" id="txt_ci">
                        <input class="span4" type="text" placeholder="Inscrição Estadual" title="Inscriçãoo Estadual"    value="<?php print $dados['ci_inscr'];?>" name="txt_inscr" id="txt_ie" >

                    </div>
                    <div class="controls controls-row">
                        <input class="span4" type="text" placeholder="Bairro" title="Bairro do Cliente" value="<?php print $dados['bairro'];?>" name="txt_bairro">
                        <input class="span4" type="text" placeholder="Cidade" title="Cidade do Cliente" value="<?php print $dados['cidade'];?>" name="txt_cidade">
                        <input class="span1" type="text" placeholder="Estado" title="Estado do Cliente" data-mask="aa" value="<?php print $dados['estado'];?>" name="txt_estado">
                        <input class="span3" type="text" placeholder="Cep"    title="Cep do Cliente"    data-mask="99999-999" value="<?php print $dados['cep'];?>" name="txt_cep">
                    </div>
                    <div class="controls controls-row">
                        <input class="span4" type="text" placeholder="Data Nascimento" title="Data de Nascimento do Cliente" name="txt_dt_nasc"  id="txt_dt_nascimento"  value="<?php print $_data->dataVisual($dados['dt_nasc']);?>" data-mask="99/99/9999"  >
                        <input class="span4" type="text" placeholder="Data Fundação"   title="Data Fundação"                 name="txt_fundacao" id="txt_fundacao" value="<?php print $_data->dataVisual($dados['dt_nasc']);?>" data-mask="99/99/9999">
                        <input class="span7" type="text" placeholder="Email"           title="Email do Cliente"              name="txt_email"    id=""             value="<?php print $dados['email'];?>" >                 
                        <div class="span1"></div>

                    </div>

                    <div class="controls controls-row">
                        <input class="span3" type="text" placeholder="Telefone1" title="Telefone 1" data-mask="(99)9999-9999" value="<?php print $dados['tel1'];?>" name="txt_tel1">
                        <input class="span3" type="text" placeholder="Telefone2" title="Telefone 2" data-mask="(99)9999-9999" value="<?php print $dados['tel2'];?>" name="txt_tel2">
                        <input class="span3" type="text" placeholder="Telefone3" title="Telefone 3" data-mask="(99)9999-9999" value="<?php print $dados['tel3'];?>" name="txt_tel3">
                    </div>
                    <div class="controls controls-row">
                        <input class="span6" type="text" placeholder="Responsável" title="Responsavel Pelo Cliente" value="<?php print $dados['responsavel'];?>" name="txt_responsavel" id="txt_id_responsavel">                        
                    </div>

                        <br />
                    <button type="submit" class="btn" name="btn_enviar" onclick="return confirm('Confirma a Alteração de Dados ?');">Alterar</button>
                    </form>
               </div>
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    <script type="text/javascript">

        function pessoa(){

            /* pessoa fisica marcada */
            if($("#rdb_pessoa_pf").is(":checked")){

                $("#txt_cnpj").hide();
                $("#txt_ie").hide();
                $("#txt_id_responsavel").hide();
                $("#txt_fundacao").hide();
                $("#txt_ci").show();
                $("#txt_cpf").show();
                $("#txt_dt_nascimento").show();


                /* Pessoa Juridica marcada */
            }else if($("#rdb_pessoa_pj").is(":checked")){

                $("#txt_cpf").hide();
                $("#txt_cnpj").show();
                $("#txt_ie").show();
                $("#txt_ci").hide();
                $("#txt_dt_nascimento").hide();
                $("#txt_fundacao").show();
                $("#txt_id_responsavel").show();
            }
        }
    </script>
    </body>
    </html>