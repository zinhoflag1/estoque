<?php session_start();
print "<!DOCTYPE html>";
include_once 'include.inc.php';
require_once 'Classe/Classe.Conexao.php';

$conexao = ConexaoPDO::getInstance();

$_cliente = new Cliente();

$_login = new Login();


$_login->logado();



?>
<html>

<head>
    <title><?php print TITULO; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
</head>

<body onload="javascript:pessoa();">
    <!-- CABECALHO -->
    <div class="container">
        <?php include_once 'pagina.cabecalho.php'; ?>
    </div>
    <div class="container">
        <?php include_once 'pagina.barraVersao.php'; ?>
    </div>
    <div class="container">
        <hr>
    </div>
    <!-- MENU -->
    <div class="container">
        <?php include_once 'pagina.menu.php'; ?>
    </div>
    <!-- CORPO -->
    <div class="container fdo_corpo">
        <br />
        <form action="secao1.php?secao=cliente" method="POST" name="frm_cliente">
            <legend class="text-center">Cadastro de Clientes</legend>


            <div class="controls controls-row">
                <div class="span1">PF<input type="radio" name="rdb_pessoa" id="rdb_pessoa_pf" value="PF" checked="checked" onchange="javascript:pessoa();"></div>
                <div class="span1">PJ<input type="radio" name="rdb_pessoa" id="rdb_pessoa_pj" value="PJ" onchange="javascript:pessoa();"></div>
                <div class="span8"><br /><br /></div>
            </div>
            <div class="controls controls-row">
                <input class="span8" type="text" title="Nome do Cliente" placeholder="Nome Razão" name="txt_nome">
                <input class="span4" type="text" title="CPF Cliente" placeholder="CPF" name="txt_cpf" id="txt_cpf" data-mask="999.999.999-99">
                <input class="span4" type="text" title="CNPJ Cliente" placeholder="CNPJ" name="txt_cnpj" id="txt_cnpj" data-mask="99.999.999/9999-99">
            </div>
            <div class="controls controls-row">

                <input class="span8" type="text" title="Endereço do Cliente" placeholder="Endereço" name="txt_endereco">
                <input class="span4" type="text" title="Carteira de Identidade do Cliente" placeholder="C.I" id="txt_ci" name="txt_ci">
                <input class="span4" type="text" title="Inscriçãoo Estadual" placeholder="Inscrição Estadual" id="txt_ie" name="txt_inscr">

            </div>
            <div class="controls controls-row">
                <input class="span4" type="text" title="Bairro do Cliente" placeholder="Bairro" name="txt_bairro">
                <input class="span4" type="text" title="Cidade do Cliente" placeholder="Cidade" name="txt_cidade">
                <input class="span1" type="text" title="Estado do Cliente" placeholder="Estado" name="txt_estado" data-mask="aa">
                <input class="span3" type="text" title="Cep do Cliente" placeholder="Cep" name="txt_cep" data-mask="99999-999">
            </div>
            <div class="controls controls-row">
                <input class="span4" type="text" title="Data de Nascimento do Cliente" placeholder="Data Nascimento" name="txt_dt_nascimento" id="txt_dt_nascimento" data-mask="99/99/9999">
                <input class="span4" type="text" title="Data Fundação" placeholder="Data Fundação" name="txt_fundacao" id="txt_fundacao" data-mask="99/99/9999">
                <input class="span7" type="text" title="Email do Cliente" placeholder="Email" name="txt_email">
            </div>

            <div class="controls controls-row">
                <input class="span3" type="text" title="Telefone 1 do Cliente" placeholder="Telefone1" name="txt_tel1" data-mask="(99)9999-9999">
                <input class="span3" type="text" title="Telefone 2 do Cliente" placeholder="Telefone2" name="txt_tel2" data-mask="(99)9999-9999">
                <input class="span3" type="text" title="Telefone 3 do Cliente" placeholder="Telefone3" name="txt_tel3" data-mask="(99)9999-9999">

            </div>
            <div class="controls controls-row">
                <input class="span6" type="text" title="Responsável Pela Empresa" placeholder="Responsável" name="txt_responsavel" id="txt_id_responsavel">
            </div>

            <br />
            <button type="submit" class="btn" name="btn_cad_cliente">Cadastrar</button>
        </form>
        <div class="row text-right">Total Registros :<?php print $_cliente->totalCliente(); ?></div>

    </div>
    <!-- RODAPE -->
    <div class="container">
        <?php include_once 'visao/pagina.rodape.php'; ?>
    </div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
    <script type="text/javascript">
        function pessoa() {

            /* pessoa fisica marcada */
            if ($("#rdb_pessoa_pf").is(":checked")) {

                $("#txt_cnpj").hide();
                $("#txt_ie").hide();
                $("#txt_id_responsavel").hide();
                $("#txt_fundacao").hide();
                $("#txt_ci").show();
                $("#txt_cpf").show();
                $("#txt_dt_nascimento").show();




                /* Pessoa Juridica marcada */
            } else if ($("#rdb_pessoa_pj").is(":checked")) {


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