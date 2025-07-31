<?php
require_once 'Classe.Conexao.php';

class Permissao
{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	function Cadastrar(
		$_cad_cliente,
		$_cad_vendedor,
		$_cad_produto,
		$_cad_linha,
		$_pedido,
		$_estoque,
		$_posicao_estoque,
		$_tabela_preco,
		$_configuracao,
		$_id_usuario,
		$_gerapedido,
		$_fechapedido,
		$_rota,
		$_mapa,
		$_pos_pedido,
		$_resumo
	) {

		$sql = "INSERT INTO permissao (cad_cliente,
										cad_vendedor,
										cad_produto,
										cad_linha,
										pedido,
										estoque,
										posicao_estoque,
										tabela_preco,
										configuracao,
										id_usuario,
										gerapedido,
										fechapedido,
										rota,
										mapa,
										pos_pedido,
										resumo)
										VALUES ($_cad_cliente,
												$_cad_vendedor,
												$_cad_produto,
												$_cad_linha,
												$_pedido,
												$_estoque,
												$_posicao_estoque,
												$_tabela_preco,
												$_configuracao,
												$_id_usuario,
												$_gerapedido,
												$_fechapedido,
												$_rota,
												$_pos_pedido,
												$_resumo)";



		$result = self::$pdo->query($sql) or die();

		return $result;
	}

	#@ acesso Menu
	function AcessoMenu($_id_usuario)
	{

		$sql = "SELECT cad_cliente,
						cad_vendedor,
						cad_produto,
						cad_linha,
						pedido,
						estoque,
						posicao_estoque,
						tabela_preco,
						configuracao,
						id_usuario,
						gerapedido,
						fechapedido,
						rota,
						mapa,
						pos_pedido,
						resumo,
						relatorio
						from permissao
						where id_usuario = '" . $_id_usuario . "'";

		$result = self::$pdo->query($sql) or die(' erro select user');

		$linha = $result->fetch(PDO::FETCH_ASSOC);
		return $linha;
	}


	// ################################################################################################################################################
	// filtro de acesso ao relatório do sistema
	function AcessoRel($_login)
	{

		// item do relatórios do sistema

		// Tela de relatorio posicao geral dos depositos
		$item_rel_pos_geral = "<a href=\"?op=posg\">- Posi&ccedil;&atilde;o Geral do Estoque</a>";

		// tela de relatorio posicao geral filtrado por deposito
		$item_rel_pos_dep = "<a href=\"?op=posd\">- Posi&ccedil;&atilde;o Saldo por Dep&oacute;sito</a>";

		// tela de tela de relatório de materiais pagos
		$item_rel_cons_mat_pago = "<a href=\"?secao=cmatp\">- Consulta Material Pago </a>";

		// tela de relatórios de recebimento de materiais
		$item_rel_recebimento = "<a href=\"#\">- Recebimento de Materiais</a>";

		// relatórios de materiais em trânsito
		$item_rel_mat_transito = "<a href=\"?op=cmatt\">- Consulta Material em Tr&acirc;nsito </a>";

		// relatórios de Transferencia de Materiais
		$item_rel_transferencia = "<a href=\"#\">- Transferencia de Materiais</a>";

		// relatorio consulta de materiais liberados (liberacoes)
		$item_rel_cons_mat_lib = "<a href=\"?secao=rlib\">- Consulta Material Liberado</a>";

		// tela de relatório consulta materia esperando pagamento
		$item_rel_cons_mat_espera = "<a href=\"core/sc.consulta.material.espera.pgto.php\">- Consulta Material Esperando Pagamento </a>";

		// relatorio de material em transito
		$item_rel_cons_mar_transito = "<a href=\"rel.consulta.material.transito.php\">- Consulta Material em Tr&acirc;nsito </a>";

		$mostraRel = array(
			$item_rel_pos_geral,
			$item_rel_pos_dep,
			$item_rel_cons_mat_pago,
			$item_rel_recebimento,
			$item_rel_mat_transito,
			$item_rel_transferencia,
			$item_rel_cons_mat_lib,
			$item_rel_cons_mat_espera
		);

		$sql = "SELECT rel_saldo_geral, rel_saldo_p_deposito, rel_pagmto, rel_transf_mat, rel_mat_transito, " . "rel_liberacao, rel_mat_liberado, rel_mat_espera_pgto " . "FROM permissao " . "WHERE login = {$_login}";

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_ASSOC);


		// busca os campos de 2 a 9 na tabela do banco que refere-se ao cadastro
		for ($i = 0; $i < count($mostraRel); $i++) {

			if ($linha[$i] != 0) {

				echo $mostraRel[$i] . "<br />";
			}
		}
	}
}
