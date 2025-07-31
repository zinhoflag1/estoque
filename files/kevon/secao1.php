<?php
session_start ();

print "<!DOCTYPE html>";
include_once 'include.inc.php';

require_once 'Classe/Classe.Conexao.php';
    
$conexao = ConexaoPDO::getInstance();

$_campoBranco = new FuncaoBase ();

$_cliente = new Cliente ();

$_vendedor = new Vendedor ();

$_dataClass = new DataMysql ();

$_produto = new Produto ();

$_linha = new Linha ();

$_estoque = new Estoque ();

$_pedido = new Pedido ();

?>
<html>
<head>
<title><?php print TITULO;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<!-- Bootstrap -->
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<?php

// ################################################## Cadastro cliente ############################################

$operacao = $_GET ['secao'];

if ($operacao == 'cliente') {
	
	$_enviar = isset ( $_POST ['btn_cad_cliente'] ) ? true : "";
	$_pessoa = isset ( $_POST ['rdb_pessoa'] ) ? $_POST ['rdb_pessoa'] : "";
	$_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	$_cpf = isset ( $_POST ['txt_cpf'] ) ? $_POST ['txt_cpf'] : "";
	$_cnpj = isset ( $_POST ['txt_cnpj'] ) ? $_POST ['txt_cnpj'] : "";
	$_ci = isset ( $_POST ['txt_ci'] ) ? $_POST ['txt_ci'] : "";
	$_ie = isset ( $_POST ['txt_inscr'] ) ? $_POST ['txt_inscr'] : "";
	$_endereco = isset ( $_POST ['txt_endereco'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_endereco'] ) : "";
	$_bairro = isset ( $_POST ['txt_bairro'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_bairro'] ) : "";
	$_cidade = isset ( $_POST ['txt_cidade'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_cidade'] ) : "";
	$_estado = isset ( $_POST ['txt_estado'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_estado'] ) : "";
	$_cep = isset ( $_POST ['txt_cep'] ) ? $_POST ['txt_cep'] : "";
	$_responsavel = isset ( $_POST ['txt_responsavel'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_responsavel'] ) : "";
	$_tel1 = isset ( $_POST ['txt_tel1'] ) ? $_POST ['txt_tel1'] : "";
	$_tel2 = isset ( $_POST ['txt_tel2'] ) ? $_POST ['txt_tel2'] : "";
	$_tel3 = isset ( $_POST ['txt_tel3'] ) ? $_POST ['txt_tel3'] : "";
	$_dt_nascimento = isset ( $_POST ['txt_dt_nascimento'] ) ? $_POST ['txt_dt_nascimento'] : "";
	$_dt_fundacao = isset ( $_POST ['txt_fundacao'] ) ? $_POST ['txt_fundacao'] : "";
	$_email = isset ( $_POST ['txt_email'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_email'] ) : "";
	
	// var_dump($_POST);
	
	if ($_pessoa == "PF") {
		
		$_cpf_cnpj = $_cpf;
		$_doc = $_ci;
		$_data = $_dt_nascimento;
		$_responsavel = ".";
	} elseif ($_pessoa == "PJ") {
		
		$_cpf_cnpj = $_cnpj;
		$_doc = $_ie;
		$_data = $_dt_fundacao;
	}
	
	if (($_enviar) & (! $_nome == "")) {
		
		if ($_cliente->Cadastrar ( $_pessoa, $_nome, $_cpf_cnpj, $_doc, $_endereco, $_bairro, $_cidade, $_estado, $_cep, $_responsavel, $_tel1, $_tel2, $_tel3, $_dataClass->dataForm ( $_data ), $_email )) {
			
			print "Cliente Cadastrado Com Sucesso !<br />";
			
			print "<a href=\"#\" onclick=\"javascript:window.location = 'secao.php?secao=cliente&acao=cadastrar';\">Voltar</a>";
		}
	} else {
		
		print "<div class=\"text-center\"><br /><br /><br />O Campo nome não pode Ficar em Branco !<br /><br />";
		
		print "<a class=\"btn\" href=\"javascript:window.location='secao.php?secao=cliente&acao=cadastrar';\">Voltar</a>";
		
		print "</script></div>";
	}
	
	// ################################################## cliente Alterar #####################################################
} elseif ($operacao == 'clienteAlterar') {
	
	$_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	$_id_cliente = isset ( $_POST ['id_cliente'] ) ? $_POST ['id_cliente'] : "";
	$_cpf = isset ( $_POST ['txt_cpf'] ) ? $_POST ['txt_cpf'] : "";
	$_cnpj = isset ( $_POST ['txt_cnpj'] ) ? $_POST ['txt_cnpj'] : "";
	$_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	$_ci = isset ( $_POST ['txt_ci'] ) ? $_POST ['txt_ci'] : "";
	$_endereco = isset ( $_POST ['txt_endereco'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_endereco'] ) : "";
	$_bairro = isset ( $_POST ['txt_bairro'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_bairro'] ) : "";
	$_cidade = isset ( $_POST ['txt_cidade'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_cidade'] ) : "";
	$_estado = isset ( $_POST ['txt_estado'] ) ? $_POST ['txt_estado'] : "";
	$_cep = isset ( $_POST ['txt_cep'] ) ? $_POST ['txt_cep'] : "";
	$_responsavel = isset ( $_POST ['txt_responsavel'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_responsavel'] ) : "";
	$_tel1 = isset ( $_POST ['txt_tel1'] ) ? $_POST ['txt_tel1'] : "";
	$_tel2 = isset ( $_POST ['txt_tel2'] ) ? $_POST ['txt_tel2'] : "";
	$_tel3 = isset ( $_POST ['txt_tel3'] ) ? $_POST ['txt_tel3'] : "";
	$_dt_nascimento = isset ( $_POST ['txt_dt_nasc'] ) ? $_POST ['txt_dt_nasc'] : "";
	$_dt_fundacao = isset ( $_POST ['txt_fundacao'] ) ? $_POST ['txt_fundacao'] : "";
	$_email = isset ( $_POST ['txt_email'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_email'] ) : "";
	$_pessoa = isset ( $_POST ['rdb_pessoa'] ) ? $_POST ['rdb_pessoa'] : "";
	
	if ($_pessoa == 'PF') {
		
		$_cpf_cnpj = $_cpf;
		$_data = $_dt_nascimento;
	} elseif ($_pessoa == 'PJ') {
		
		$_cpf_cnpj = $_cnpj;
		$_data = $_dt_fundacao;
	}
	
	if ($_enviar) {
		
		if ($_cliente->Alterar ( $_id_cliente, $_pessoa, $_nome, $_cpf_cnpj, $_ci, $_endereco, $_bairro, $_cidade, $_estado, $_cep, $_responsavel, $_tel1, $_tel2, $_tel3, $_dataClass->dataForm ( $_data ), $_email )) {
			
			print "Cliente Alterado Com Sucesso !";
			
			print "<a href=\"javascript:window.location.href ='secao.php?secao=cliente&acao=buscarAlterar'\";>Voltar</a>";
		}
	}
	
	// ################################################## Vendedor #####################################################
} elseif ($operacao == 'vendedor') {
	
	$_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	$_txt_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	$_txt_cpf = isset ( $_POST ['txt_cpf'] ) ? $_POST ['txt_cpf'] : "";
	$_txt_ci = isset ( $_POST ['txt_ci'] ) ? $_POST ['txt_ci'] : "";
	$_txt_endereco = isset ( $_POST ['txt_endereco'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_endereco'] ) : "";
	$_txt_bairro = isset ( $_POST ['txt_bairro'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_bairro'] ) : "";
	$_txt_cidade = isset ( $_POST ['txt_cidade'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_cidade'] ) : "";
	$_txt_estado = isset ( $_POST ['txt_estado'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_estado'] ) : "";
	$_txt_cep = isset ( $_POST ['txt_cep'] ) ? $_POST ['txt_cep'] : "";
	$_txt_dt_nasc = isset ( $_POST ['txt_dt_nasc'] ) ? $_POST ['txt_dt_nasc'] : "";
	$_txt_tel1 = isset ( $_POST ['txt_tel1'] ) ? $_POST ['txt_tel1'] : "";
	$_txt_tel2 = isset ( $_POST ['txt_tel2'] ) ? $_POST ['txt_tel2'] : "";
	$_txt_tel3 = isset ( $_POST ['txt_tel3'] ) ? $_POST ['txt_tel3'] : "";
	$_txt_email = isset ( $_POST ['txt_email'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_email'] ) : "";
	
	if (($_enviar) & ($_txt_nome != "")) {
		
		if ($_vendedor->Cadastrar ( $_txt_nome, $_txt_cpf, $_txt_ci, $_dataClass->dataForm ( $_txt_dt_nasc ), $_txt_endereco, $_txt_bairro, $_txt_cidade, $_txt_estado, $_txt_cep, $_txt_tel1, $_txt_tel2, $_txt_tel3, $_txt_email )) {
			
			print '<div class="container"><br /><br />
  						<div class="row">
  							<div class="span12">
  								<div class="span4"></div>
  								<div class="span4 text-center alert alert-success">Vendedor Cadastrado Com Sucesso !</div>
  								<div class="span4"></div>
  							</div>
  						</div>
  						<br />
  						<div class="row">
  							<div class="span12">
  				            		<div class="span4"></div>
  				            		<div class="span4 text-center"><a class="btn" href="secao.php?secao=vendedor&acao=cadastrar">Voltar</a></div>
  				            		<div class="span4"></div>
  			            		</div>
  		            		</div>
  		            	</div>';
		}
	} else {
		
		print "O Campo nome não pode Ficar em Branco !<br />";
		
		print "<a class=\"btn\" href=\"javascript:window.location='secao.php?secao=vendedor&acao=cadastrar';\">Voltar</a>";
		
		print "</script>";
	}
	
	// ################################################## vendedor Alterar #####################################################
} elseif ($operacao == 'vendedorAlterar') {
	
	$_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	$_id_vendedor = isset ( $_POST ['id_vendedor'] ) ? $_POST ['id_vendedor'] : "";
	$_txt_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	$_txt_cpf = isset ( $_POST ['txt_cpf'] ) ? $_POST ['txt_cpf'] : "";
	$_txt_ci = isset ( $_POST ['txt_ci'] ) ? $_POST ['txt_ci'] : "";
	$_txt_endereco = isset ( $_POST ['txt_endereco'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_endereco'] ) : "";
	$_txt_bairro = isset ( $_POST ['txt_bairro'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_bairro'] ) : "";
	$_txt_cidade = isset ( $_POST ['txt_cidade'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_cidade'] ) : "";
	$_txt_estado = isset ( $_POST ['txt_estado'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_estado'] ) : "";
	$_txt_cep = isset ( $_POST ['txt_cep'] ) ? $_POST ['txt_cep'] : "";
	$_txt_dt_nasc = isset ( $_POST ['txt_dt_nasc'] ) ? $_POST ['txt_dt_nasc'] : "";
	$_txt_tel1 = isset ( $_POST ['txt_tel1'] ) ? $_POST ['txt_tel1'] : "";
	$_txt_tel2 = isset ( $_POST ['txt_tel2'] ) ? $_POST ['txt_tel2'] : "";
	$_txt_tel3 = isset ( $_POST ['txt_tel3'] ) ? $_POST ['txt_tel3'] : "";
	$_txt_email = isset ( $_POST ['txt_email'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_email'] ) : "";
	
	if ($_enviar) {
		
		$dados = array (
				"id_vendedor" => $_id_vendedor,
				"Nome" => $_txt_nome);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			if ($_vendedor->Alterar ( $_id_vendedor,
									  $_txt_nome,
									  $_txt_cpf,
									  $_txt_ci,
									  $_dataClass->dataForm ( $_txt_dt_nasc),
									  $_txt_endereco,
									  $_txt_bairro,
									  $_txt_cidade,
									  $_txt_estado,
									  $_txt_cep,
									  $_txt_tel1,
									  $_txt_tel2,
									  $_txt_tel3,
									  $_txt_email)) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Vendedor Alterado Com Sucesso !');";
				
				print "window.location=\"secao.php?secao=vendedor&acao=buscarAlterar\";";
				
				print "</script>";
			}
		}
	}
	
	// ################################################## produto cadastrar #####################################################
} elseif ($operacao == 'produto') {
	
	$_txt_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	
	$_txt_volume = isset ( $_POST ['txt_volume'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_volume'] ) : "";
	
	$_sel_linha = isset ( $_POST ['sel_linha'] ) ? $_POST ['sel_linha'] : "";
	
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	
	if ($_btn_enviar) {
		
		$dados = array (
				"Nome" => $_txt_nome,
				"Volume" => $_txt_volume,
				"Categoria" => $_sel_linha 
		);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			if ($_produto->Cadastrar ( $dados ['Nome'], $dados ['Volume'], $dados ['Categoria'] )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Produto Cadastrado Com Sucesso !');";
				
				print "window.location=\"secao.php?secao=produto&acao=cadastrar\";";
				
				print "</script>";
			}
		}
	}
	
	// ################################################## produto Alterar #####################################################
} elseif ($operacao == 'produtoAlterar') {
	
	$_id_produto = isset ( $_POST ['txt_id_produto'] ) ? $_POST ['txt_id_produto'] : "";
	$_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	$_volume = isset ( $_POST ['txt_volume'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_volume'] ) : "";
	$_id_linha = isset ( $_POST ['sel_linha'] ) ? $_POST ['sel_linha'] : "";
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	
	
	
	if ($_btn_enviar) {
			
		//var_dump($_POST);
		
		
		$dados = array (
				"id_produto" => $_id_produto,
				"Nome" => $_nome,
				"Volume" => $_volume,
				"Linha" => $_id_linha 
		);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			if ($_produto->Alterar ( $dados ['id_produto'], $dados ['Nome'], $dados ['Volume'], $dados ['Linha'] )) {
				
				print "<script type='text/javascript'>";
				
				print "window.location=\"secao.php?secao=produto&acao=buscarAlterar\";";
				
				print "alert('Produto Alterado Com Sucesso !');";
				
				print "</script>";
			}
		}
	}
	
	// ################################################## linha #####################################################
} elseif ($operacao == 'linha') {
	
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	
	$_txt_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	
	if ($_btn_enviar) {
		
		$dados = array (
				"Nome" => $_txt_nome 
		);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			if ($_linha->Cadastrar ( $dados ['Nome'] )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Linha Cadastrada Com Sucesso !');";
				
				print "window.location=\"secao.php?secao=linha&acao=cadastrar\";";
				
				print "</script>";
			}
		}
	}
	
	// ################################################## linha Alterar #####################################################
} elseif ($operacao == 'linhaAlterar') {
	
	$_id_linha = isset ( $_POST ['txt_id_linha'] ) ? $_POST ['txt_id_linha'] : "";
	
	$_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	
	if ($_btn_enviar) {
		
		$dados = array (
				"id_linha" => $_id_linha,
				"Nome" => $_nome 
		);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			if ($_linha->Alterar ( $dados ['id_linha'], $dados ['Nome'] )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Alteração Realizada Com Sucesso !');";
				
				print "window.location=\"secao.php?secao=linha&acao=buscarAlterar\";";
				
				print "</script>";
			}
		}
	}
	
	// ################################################## estoque #####################################################
} elseif ($operacao == 'estoque') {
	
	//var_dump ( $_POST );
	
	$_txt_id_produto = isset ( $_POST ['txt_id_produto'] ) ? $_POST ['txt_id_produto'] : "";
	$_txt_id_linha = isset ( $_POST ['txt_id_linha'] ) ? $_POST ['txt_id_linha'] : "";
	$_txt_nome = isset ( $_POST ['txt_nome'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_nome'] ) : "";
	$_txt_quantidade = isset ( $_POST ['txt_quantidade'] ) ? $_POST ['txt_quantidade'] : "";
	$_txt_valor_compra = isset ( $_POST ['txt_valor_compra'] ) ? $_POST ['txt_valor_compra'] : "";
	$_txt_valor_venda = isset ( $_POST ['txt_valor_venda'] ) ? $_POST ['txt_valor_venda'] : "";
	$_txt_percentual = isset ( $_POST ['txt_percentual'] ) ? $_POST ['txt_percentual'] : "";
	$_txt_observacao = isset ( $_POST ['txt_observacao'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_observacao'] ) : "-";
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	
	if ($_btn_enviar) {
		
		$dados = array (
				"id_produto" => $_txt_id_produto,
				"id_linha" => $_txt_id_linha,
				"Nome" => $_txt_nome,
				"Quantidade" => $_txt_quantidade,
				"Valor_compra" => $_txt_valor_compra,
				"Valor_venda" => $_txt_valor_venda,
				"Percentual" => $_txt_percentual);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			// busca se tem registrado valor no estoque
			if ($_estoque->BuscaEstoque ( $_txt_id_produto, $_txt_id_linha ) == 1) {
				
				// tendo produto registrado no estoque faz uma autualizacao no registro de estoque
				if ($_estoque->AtualizaEstoque ( $_txt_id_produto, $_txt_id_linha, $_txt_valor_compra, $_txt_quantidade, $_txt_observacao, $_txt_valor_venda, $_txt_percentual )) {
					
					// lanca na tabela reg_estoque para registrar os produtos do estque
					if ($_estoque->RegistraEstoque ( $_txt_id_produto, $_txt_id_linha, $_txt_valor_compra, $_txt_quantidade, $_txt_observacao, $_txt_valor_venda, $_txt_percentual, date('Y/m/d'))) {
						
						print "<script type='text/javascript'>";
						
						print "alert('Estoque Atualizado Com Sucesso !');";
						
						print "window.location=\"secao.php?secao=estoque&acao=cadastrar\";";
						
						print "</script>";
					}
				}

			} else {
			
				// se o produto nao existir na tabela estoque faz um lancamento.
				if ($_estoque->Cadastrar ( $_txt_id_produto, $_txt_id_linha, $_txt_valor_compra, $_txt_quantidade, $_txt_observacao, $_txt_valor_venda, $_txt_percentual )) {
					
					// lanca na tabela reg_estoque para registrar os produtos do estque
					if ($_estoque->RegistraEstoque ( $_txt_id_produto, $_txt_id_linha, $_txt_valor_compra, $_txt_quantidade, $_txt_observacao, $_txt_valor_venda, $_txt_percentual, date('Y/m/d') )) {
						
						print "<script type='text/javascript'>";
						
						print "alert('Estoque Cadastrado Com Sucesso !');";
						
						print "window.location=\"secao.php?secao=estoque&acao=cadastrar\";";
						
						print "</script>";
					}
				}
			}
		}
	}
	
	// ################################################## Estoque Alterar #####################################################
} elseif ($operacao == 'estoqueAlterar') {
	
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	$_txt_codigo = isset ( $_POST ['txt_codigo'] ) ? $_POST ['txt_codigo'] : "";
	$_txt_id_produto = isset ( $_POST ['txt_id_produto'] ) ? $_POST ['txt_id_produto'] : "";
	$_txt_quantidade = isset ( $_POST ['txt_quantidade'] ) ? $_POST ['txt_quantidade'] : "";
	$_txt_valor_compra = isset ( $_POST ['txt_valor_compra'] ) ? $_POST ['txt_valor_compra'] : "";
	$_txt_valor_venda = isset ( $_POST ['txt_valor_venda'] ) ? $_POST ['txt_valor_venda'] : "";
	$_txt_observacao = isset ( $_POST ['txt_observacao'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_observacao'] ) : "";
	$_txt_id_linha = isset ( $_POST ['txt_id_linha'] ) ? $_POST ['txt_id_linha'] : "";
	$_txt_percentual = isset ( $_POST ['txt_percentual'] ) ? $_POST ['txt_percentual'] : "";
	
	if ($_btn_enviar) {
		
		$dados = array (
				"codigo" => $_txt_codigo,
				"id_produto" => $_txt_id_produto,
				"linha" => $_txt_id_linha,
				"Valor_Compra" => $_txt_valor_compra,
				"Valor_Venda" => $_txt_valor_venda,
				"quantidade" => $_txt_quantidade,
				"observacao" => $_txt_observacao,
				"percentual" => $_txt_percentual 
		);
		
		if ($_campoBranco->campoBranco ( $dados )) {
			
			if ($_estoque->Alterar ( $_txt_codigo, $_txt_id_produto, $_txt_id_linha, $_txt_valor_compra, $_txt_quantidade, $_txt_observacao, $_txt_valor_venda, $_txt_percentual )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Estoque Alterado Com Sucesso !');";
				
				//print "window.location=\"secao.php?secao=estoque&acao=buscarAlterar\";";
				
				print "</script>";
			}
		}
	}
	
	// ################################################## Pedido #####################################################
} elseif ($operacao == 'pedido') { // cadastrar
                                   
	// situacao = 0 do pedido
                                   
	// var_dump($_POST);
	
	$_btn_fechar_pedido = isset ( $_POST ['btn_fechar_pedido'] ) ? true : "";
	
	$_txt_id_cliente = isset ( $_POST ['txt_id_cliente'] ) ? $_POST ['txt_id_cliente'] : "";
	$_txt_subtotal = isset ( $_POST ['txt_subtotal'] ) ? $_POST ['txt_subtotal'] : "";
	$_txt_desc_perc = isset ( $_POST ['txt_desc_perc'] ) ? $_POST ['txt_desc_perc'] : "";
	$_txt_desc_valor = isset ( $_POST ['txt_desc_valor'] ) ? $_POST ['txt_desc_valor'] : "";
	$_txt_total = isset ( $_POST ['txt_total'] ) ? $_POST ['txt_total'] : "";
	$_rdb_pagamento = isset ( $_POST ['rdb_pagamento'] ) ? $_POST ['rdb_pagamento'] : "";
	$_txt_obs = isset ( $_POST ['txt_obs'] ) ? FuncaoBase::RemoveAcento ( $_POST ['txt_obs'] ) : "-";
	$_txt_dt_pedido = isset ( $_POST ['txt_dt_pedido'] ) ? $_POST ['txt_dt_pedido'] : "-";
	$_txt_num_pedido = isset ( $_POST ['txt_num_pedido'] ) ? $_POST ['txt_num_pedido'] : "-";
	$_sel_parcela = isset ( $_POST ['sel_parcela'] ) ? $_POST ['sel_parcela'] : "1";
	
	if ($_txt_id_cliente == 0) {
		
		$_txt_id_cliente = "";
	}
	
	$_txt_obs = ($_txt_obs == '') ? '-' : $_txt_obs;
	
	if ($_btn_fechar_pedido) {
		
		$campos = array (
				'Cliente' => $_txt_id_cliente,
				'FormaPagamento' => $_rdb_pagamento,
				'Obs' => $_txt_obs 
		);
		
		if (isset ( $_SESSION ['cesta'] )) {
			
			$_dados = $_SESSION ['cesta'];
			
			$_totalItens = count ( $_dados );
		} else {
			
			$_totalItens = 0;
		}
		
		// var_dump($_SESSION);
		
		if ($_campoBranco->campoBranco ( $campos )) {
			
			if ($_totalItens > 0) {
				
				// lanca pedido na tabela pedido do banco
				if ($_pedido->Cadastrar ( $_txt_id_cliente, $_txt_subtotal, $_txt_desc_perc, $_txt_desc_valor, $_txt_total, $_rdb_pagamento, $_txt_obs, $_dataClass->dataForm ( $_txt_dt_pedido ), $_sel_parcela, 0 )) {
					
					// $_id_pedido = $_pedido->getUltimoPedido ();
					
					// var_dump($_id_pedido);
					
					/*
					 * $_SESSION['cesta'] <0 => string '10' - ID_PRODUTO> <1 => string '5' - CATEGORIA> <2 => string 'TINTA' - NOME> <3 => string '10' - QUANTIDADE> <4 => string '10.00' - VALOR>
					 */
					
					for($i = 0; $i < $_totalItens; $i ++) {
						
						// debita o saldo do estoque
						$_estoque->DebitaEstoque ( $_dados [$i] [0], $_dados [$i] [3] );
						
						// lanca os iten na tabela bando de dados
						$_pedido->LancaItemPedido ( $_dados [$i] [0], $_dados [$i] [4], $_dados [$i] [3], $_txt_num_pedido );
					}
					
					// limpa os itens do pedido apos gravar corretamente.
					unset ( $_SESSION ['cesta'] );
					unset ( $_SESSION ['cliente'] );
					
					print "<br /><br /><div class=\"text-center\">Pedido Realizado com Sucesso !<br /><br />";
					
					print "<a class=\"btn\" href=\"secao.php?secao=pedido&acao=cadastrar\">Voltar</a>";
					
					print "<a class=\"btn\" href=\"secao.php?secao=pedido&acao=imprimir&id=" . $_txt_num_pedido . "&tp=0\">Impressão</a></div>";
					
					/* tp = 0 tipo da entrada pedido novo
							para saber para onde voltar na
							visualizacao do pedido
					*/
					
				}
			} else {
				
				print "<br /><br /><div class=\"text-center\">Pedido não tem Produtos !<br /><br />";
				
				print "<a class=\"btn\" href=\"secao.php?secao=pedido&acao=cadastrar\">Voltar</a></div>";
			}
		}
	}
	
	// ##################################################### validar quitação #########################################################
} elseif ($operacao == 'fecharQuitar') {
	
	$_id_pedido = isset ( $_GET ['id'] ) ? $_GET ['id'] : "";
	$_dt_pgto = isset ( $_GET ['dt'] ) ? DataMysql::dataForm ( $_GET ['dt'] ) : "";
	
	// var_dump($_GET);
	
	if ($_pedido->QuitarPedido ( $_id_pedido, $_dt_pgto )) {
		
		print "<script type='text/javascript'>";
		
		print "alert('Quitação Realizada com Sucesso !');";
		
		print "window.location=\"secao.php?secao=pedido&acao=buscarQuitar\";";
		
		print "</script>";
	}
	
	// ################################################## alterar #####################################################
} elseif ($operacao == 'pedidoAlterar') {
	
	var_dump ( $_POST );
	
	// ################################################## REAJUSTE #####################################################
} elseif ($operacao == 'reajuste') {
	
	//var_dump ( $_POST );
	
	$_rdb_reajuste = isset ( $_POST ['rdb_reajuste'] ) ? $_POST ['rdb_reajuste'] : "";
	$_txt_indice = isset ( $_POST ['txt_indice'] ) ? $_POST ['txt_indice'] : "";
	$_sel_linha = isset ( $_POST ['sel_linha'] ) ? $_POST ['sel_linha'] : "";
	$_sel_produto = isset ( $_POST ['sel_produto'] ) ? $_POST ['sel_produto'] : "";
	$_btn_enviar = isset ( $_POST ['btn_enviar'] ) ? true : "";
	
	if (($_btn_enviar) && ($_txt_indice > 0)) {
		
		if ($_rdb_reajuste == 0) {
			
			if ($_produto->reajustePreco ( $_txt_indice )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Reajuste Realizado com Sucesso !');";
				
				print "window.location=\"secao.php?secao=config&acao=adm\";";
				
				print "</script>";
			}
		} elseif ($_rdb_reajuste == 1) {
			
			if ($_produto->reajustePreco ( $_txt_indice, $_sel_linha )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Reajuste Realizado com Sucesso !');";
				
				print "window.location=\"secao.php?secao=config&acao=adm\";";
				
				print "</script>";
			}
		} elseif ($_rdb_reajuste == 2) {
			
			if ($_produto->reajustePreco ( $_txt_indice, $_sel_produto )) {
				
				print "<script type='text/javascript'>";
				
				print "alert('Reajuste Realizado com Sucesso !');";
				
				print "window.location=\"secao.php?secao=config&acao=adm\";";
				
				print "</script>";
			}
		}
	}else {

		print "<script type=\"text/javascript\">";
		
		print "alert('O Índice não pode ficar em branco !');";
		
		print "history.back();";
		
		print "</script>";
		



	}
	
	// ################################################## #####################################################
} elseif ($operacao == '') {

}

?>

<script src="http://code.jquery.com/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
</body>
</html>
