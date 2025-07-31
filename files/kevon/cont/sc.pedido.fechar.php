

<?php

var_dump($_POST);

$_btn_fechar_pedido= isset($_POST['btn_fechar_pedido'])? true 			   : "";
$_txt_id_cliente   = isset($_POST['txt_id_cliente'])   ? $_POST['txt_id_cliente']: "";
$_txt_nome         = isset($_POST['txt_nome'])         ? $_POST['txt_nome']      : "";
$_txt_telefone     = isset($_POST['txt_telefone'])     ? $_POST['txt_telefone']  : "";
$_txt_endereco     = isset($_POST['txt_endereco'])     ? $_POST['txt_endereco']  : "";
$_txt_bairro       = isset($_POST['txt_bairro'])       ? $_POST['txt_bairro']    : "";
$_txt_subtotal     = isset($_POST['txt_subtotal'])     ? $_POST['txt_subtotal']  : "";
$_txt_desc_perc    = isset($_POST['txt_desc_perc'])    ? $_POST['txt_desc_perc'] : "";
$_txt_desc_valor   = isset($_POST['txt_desc_valor'])   ? $_POST['txt_desc_valor']: "";
$_txt_total        = isset($_POST['txt_total'])        ? $_POST['txt_total']     : "";
$_rdb_pagamento    = isset($_POST['rdb_pagamento '])   ? $_POST['rdb_pagamento'] : "";
$_txt_obs          = isset($_POST['txt_obs'])          ? $_POST['txt_obs']       : "";






?>