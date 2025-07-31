<?php

/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe para controle de usuario login											*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 ************************************************************************************/
include_once 'Classe.Log.php';
require_once 'Classe.Conexao.php';

class Login extends Log
{
	private static $login;
	private $senha;
	private $tipo;
	private static $nivel;
	private static $acesso;
	private static $id_usuario;
	private static $_id_deposito;
	private $linha;
	public static $conexao;
	public static $pdo;

	public static $idUser;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// Valida o usuario e Senha
	function logar($_login, $_senha, $redireciona = true)
	{
		if ((($_login != "") && ($_login != null)) && (($_senha != "") && ($_senha != null))) {

			$sql = "SELECT email, nivel, trsenha, id_usuario FROM usuario WHERE email = '" . $_login . "' and senha = '" . $_senha . "'
					and situacao = 1";

			$result = self::$pdo->query($sql) or die(' erro select user');

			$linha = $result->fetchAll();

			if (! $linha) {

				// redirecionar em case de erro de senha e usuario
				print "<script type='text/javascript'>";

				print "alert(\"Usuario ou Senha invalida !\");";

				//print "window.location = '../index.php'";

				print "</script>";
			} else if ($linha) {

				// $id = mysql_fetch_array($result) or die (mysql_error());

				// var_dump($linha);

				self::$nivel = $linha[1];

				self::$login = $linha[0];

				self::$id_usuario = $linha[3];

				$_SESSION['seguranca'] = array(
					'login' => self::$login,
					'nivel' => self::$nivel,
					'id_usuario' => self::$id_usuario
				);

				// var_dump($_SESSION);

				if ($linha['trsenha'] == 1) {

					print "<script type='text/javascript'>";

					print "window.open(\"core/sc.cedec.trocasenha.php\", \"Pagina2\" , \"left=300, top=200, height = 300 , width = 400\");";

					print "</script>";
				} else {

					if ($redireciona)

						// Log::GravaLog('Acesso ao Portal cedec');
						// se redirecionar for necessario
						print "<script type='text/javascript'>";

					print "location.href='index2.php';</script>";

					print "</script>";
				}
			}
		} else {

			print "<script type='text/javascript'>";

			print "alert('Usuario ou Senha em Branco !');";

			print "history.back(2);";

			print "</script>";
		}
	}

	// verifica a senha do usuario
	function TrocaSenha($login, $senha_antiga, $senha_nova)
	{
		$sql_busca = "select login, senha, id_usuario from cedec_usuario where login ='" . $login . "' and senha='" . md5($senha_antiga) . "'";

		// print $sql_busca;

		$result = self::$pdo->query($sql_busca) or die();

		$linha = $result->fetch();

		$total_linha = count($linha['id_usuario']);

		// var_dump($linha);

		if ($total_linha == 0) {

			print "<script type='text/javascript'>";

			print "alert('Senha Inválida !')";

			print "history.back();";

			print "</script>";
		} elseif ($total_linha == 1) {

			$sql_troca = "UPDATE cedec_usuario SET senha='" . md5($senha_nova) . "', trsenha ='0' WHERE id_usuario =" . $linha['id_usuario'];

			// print $sql_troca;

			$result = self::$pdo->query($sql_troca) or die();

			return $result;
		}
	}

	// Valida usuario Adm
	function logarAdm($_login, $_senha, $redireciona = false)
	{
		if ((($_login != "") && ($_login != null)) && (($_senha != "") && ($_senha != null))) {

			$sql = "SELECT login, id_usuario, nivel, m_deposito, m_pipa, m_cce, m_decretacao FROM cedec_usuario WHERE login = '$_login' and senha = '$_senha'
			and situacao = 1 and nivel = 33";

			print $sql;

			$result = self::$pdo->query($sql) or die();

			if ($linha = $result->fetch(PDO::FETCH_NUM) == 0) {

				// redirecionar em case de erro de senha e usuario
				print '<script> alert("Usuario ou Senha invalida !");
				history.back();</script>';

				header("Location : index.php");
			} else {

				$id = $result->fetch() or die();

				// self::$nivel = $id[2];

				self::$login = $id[0];

				$aux = array(
					'm_deposito' => $id[3],
					'm_pipa' => $id[4],
					'm_cce' => $id[5],
					'm_decretacao' => $id[6]
				);

				self::$acesso = $aux;

				self::$id_usuario = $id[2];

				// se o usuario existir inicia sessao e adiciona os dados nela
				session_start();

				$_SESSION['seguranca'] = array(
					'login' => self::$login,
					'nivel' => self::$nivel,
					'acesso' => self::$acesso,
					'idUser' => self::$id_usuario
				);

				if ($redireciona)

					Log::GravaLog('Acesso ao Painel Administrativo');
				// se redirecionar for necessario
				header("Location: administrator/adm.php");
			}
		} else {

			print '<script> alert("Usuario ou Senha em Branco !");
				history.back();</script>';
		}
	}

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	function setId($id)
	{
		 $this -> idUser = $id;

	}

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	function getId()
	{
		return $this->idUser;
	}

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// verifica se o usuario está logado
	function logado()
	{
		// session_start(); # se estiver logado abre a sessao
		if (! isset($_SESSION['seguranca']['login'])) {

			print "<script type='text/javascript'>";

			print "alert('Você não Está logado');";

			print "window.location = 'secao.php?secao=inicio';";

			print "</script>";
		}
	}


	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// funcao logout
	function logout($redireciona = true)
	{

		// session_destroy();
		$_SESSION = array();
		// Destroi a Sessão
		session_destroy();
		// Modifica o ID da Sessão
		// session_regenerate_id();
		// Se for necessário redirecionar
		if ($redireciona) {

			print "<script type='text/javascript'>";

			print "window.location = 'secao.php?secao=inicio';";

			print "</script>";
		}
	}

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	// Lembrete de liberacoes na tela inicial
	function LembreteLiberacao($_id_dep_destino)
	{
		$sql = 'SELECT l.dataLibera, l.id_municipio, l.depDestino, l.evento, l.id_liberacao
					FROM aju_liberacao l
					WHERE l.dataLibera <= curDate() AND situacao = 0 AND l.depDestino = ' . $_id_dep_destino;

		$result = self::$pdo->query($sql) or die();

		if ($result) {

			while ($linha = $result->fetch()) {

				print "<a href=\"javascript:abrir('../rel/rel.consulta.liberacao.espera.php?id=" . $linha[4] . "', 950, 750)\">&nbsp;&nbsp;<img style=\"vertical-align:middle\" src=\"../images/user-available.png\">&nbsp;&nbsp;Libera&ccedil;&atilde;o No: " . $linha[4] . " - " . DataMysql::dataVisual($linha[0]) . "</a><br />";
			}
		}
	}

	// filtro de acesso lembrete de Liberacoes
	function AcessoLembrete($idUser, $_id_dep_destino)
	{

		// sql que filtra dos dados de permissao aos cadastros
		$sql = "SELECT lembrete_libera FROM aju_permissao WHERE login = {$idUser}";

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_NUM);

		if ($linha[0] != 0) {

			echo Login::LembreteLiberacao($_id_dep_destino);
		}
	}

	// Lembrete de Material em Transito
	function LembreteTransito($_id_dep_destino = false)
	{
		$filtro = '';

		if (is_int($_id_dep_destino)) {

			$filtro = ' and id_dep_destino = ' . $_id_dep_destino . '';
		} else {

			$filtro = '';
		}

		$sql = 'SELECT veiculo, motorista, saida
					FROM aju_transito
					WHERE chegada is null ' . $filtro;

		// print $sql;

		$result = self::$pdo->query($sql) or die();

		while ($linha = $result->fetch()) {

			print "<a href=\"javascript:abrir('sc.mostra.material.transito.php', 800, 900, 150, 150)\">&nbsp;&nbsp;<img style=\"vertical-align:middle\" src=\"../images/user-available.png\">&nbsp;&nbsp; " . $linha[0] . " / " . $linha[1] . " - " . DataMysql::dataVisual($linha[2]) . "</a></br />";
		}
	}

	// filtro de acesso ao lembrete de transito de materiais
	function AcessoLembreteTransito($_idUser, $_id_deposito)
	{

		// sql que filtra dos dados de permissao aos cadastros
		$sql = "SELECT lembrete_transito FROM aju_permissao WHERE login = {$_idUser}";

		// print $sql;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_BOTH);

		if ($linha[0] != 0) {

			print Login::LembreteTransito($_id_deposito);
		}
	}

	// gerar codigo de login de usuarios
	function GeraLogin()
	{
		$_novo_login = rand(1000, 1999);

		$sql = 'SELECT login FROM cedec_usuario WHERE login = ' . $_novo_login;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_NUM);

		if (! $linha) {

			return $_novo_login;
		} else {

			$this->GeraLogin();
		}
	}

	// pega o nome do usuario
	function PegaNomeUsuario($_login)
	{
		$sql = 'SELECT nome FROM cedec_usuario WHERE login = "' . $_login . '"';

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_NUM);

		return $linha[0];
	}

	// nivel de permissao acesso
	function getNivel($nivel)
	{
		if (($nivel == 2) || ($nivel == 3)) {

			return true;
		} elseif (($nivel == 1) || ($nivel == 4)) {

			return false;
		}
	}

	// acesso modulo
	function acessoModulo($_login)
	{
		$sql = 'SELECT m_deposito,
							m_pipa,
							m_cce,
							m_decretacao,
							m_comdec,
							m_apoio,
							m_poco,
							m_escola
							FROM cedec_usuario
							WHERE login = ' . $_login;

		// print $sql;

		$result = self::$pdo->query($sql) or die();

		$linha = $result->fetch(PDO::FETCH_NUM);

		return $linha;
	}

	// mostra Modulos
	function mostraModulos($_acesso)
	{

		/*
	 * 0 - modulo central 1 - modulo pipa 2 - modulo cce 3 - modulo decretacao 4 - modulo comdec 5 - modulo equipe apoio 6 - modulo poco artesiano 7 - modulo escola
	 */
		$chave_acesso = array(
			'0' => '<a href="?modulo=ajuda" title="Ajuda Humanitária"><img src="images/ajuda.png"><br />Ajuda Humanitária</a>',
			'1' => '<a href="?modulo=pipa" title="Caminhão Pipa"><img src="images/pipa.png"><br />Caminhão Pipa</a>',
			'2' => '<a href="?modulo=cce" title="Centro de Controle de Emergência"><img src="images/cce.png"><br />Centro de Controle de Emergência</a>',
			'3' => '<a href="?modulo=decreto" title="Processo de Decretação"><img src="images/processo.png"><br />Processo de Decretação</a>',
			'4' => '<a href="?modulo=escola" title="Escola de Defesa Civil"><img src="images/escola.png"><br />Escola de Defesa Civil</a>',
			'5' => '<a href="?modulo=poco" title="Poços Artesianos"><img src="images/poco.png"><br />Poços Artesianos</a>',
			'6' => '<a href="?modulo=equipe" title="Equipe de Apoio"><img src="images/equipe.png"><br />Equipe de Apoio</a>',
			'7' => '<a href="?modulo=compdec" title="Cadastro Compdec"><img src="images/comdec.png"><br />Cadastro Compdec</a>'
		);

		$acesso = array();

		for ($i = 0; $i < count($_acesso); $i++) {

			if ($_acesso[$i] == 1) {

				$acesso[] = $chave_acesso[$i];
			}
		}

		if (count($acesso) == 1) {

			print '<table class="table">
						<tr>
							<td style="text-align:center" class="" title="">' . $acesso[0] . '</td>
							<td style="text-align:center" class="" title=""></td>
							<td style="text-align:center" class="" title=""></td>
							<td style="text-align:center" class="" title=""></td>
						</tr>
						<tr>
							<td colspan="4"><br /><br /><br /></td>
						</tr>
						<tr>
							<td style="text-align:center" class="" title=""></td>
							<td style="text-align:center" class="" title=""></td>
							<td style="text-align:center" class="" title=""></td>
							<td style="text-align:center" class="" title=""></td>
						</tr>
					</table>';
		} elseif (count($acesso) == 2) {

			// 2 opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
				</tr>
				<tr>
					<td colspan="4"><br /><br /><br /></td>
				</tr>
				<tr>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
				</tr>
			</table>';
		} elseif (count($acesso) == 3) {

			// 3 opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class="">' . $acesso[2] . '</td>
					<td style="text-align:center" class=""></td>
				</tr>
				<tr>
					<td colspan="4"><br /><br /><br /></td>
				</tr>
				<tr>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
				</tr>
			</table>';
		} elseif (count($acesso) == 4) {

			// 4 opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class="">' . $acesso[2] . '</td>
					<td style="text-align:center" class="">' . $acesso[3] . '</td>
				</tr>
				<tr>
					<td colspan="4"><br /><br /><br /></td>
				</tr>
				<tr>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
				</tr>
			</table>';
		} elseif (count($acesso) == 5) {

			// 5 opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class="">' . $acesso[2] . '</td>
					<td style="text-align:center" class="">' . $acesso[3] . '</td>
				</tr>
				<tr>
					<td colspan="4"><br /><br /><br /></td>
				</tr>
				<tr>
					<td style="text-align:center" class="">' . $acesso[4] . '</td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
				</tr>
			</table>';
		} elseif (count($acesso) == 6) {

			// 6 opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class="">' . $acesso[2] . '</td>
					<td style="text-align:center" class="">' . $acesso[3] . '</td>
				</tr>
				<tr>
					<td colspan="4"><br /><br /><br /></td>
				</tr>
				<tr>
					<td style="text-align:center" class="">' . $acesso[4] . '</td>
					<td style="text-align:center" class="">' . $acesso[5] . '</td>
					<td style="text-align:center" class=""></td>
					<td style="text-align:center" class=""></td>
				</tr>
			</table>';
		} elseif (count($acesso) == 7) {

			// 7 opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class="">' . $acesso[2] . '</td>
					<td style="text-align:center" class="">' . $acesso[3] . '</td>
				</tr>
				<tr>
					<td colspan="4"><br /><br /><br /></td>
				</tr>
				<tr>
					<td style="text-align:center" class="">' . $acesso[4] . '</td>
					<td style="text-align:center" class="">' . $acesso[5] . '</td>
					<td style="text-align:center" class="">' . $acesso[6] . '</td>
					<td style="text-align:center" class=""></td>
				</tr>
			</table>';
		} elseif (count($acesso) == 8) {

			// todas opcoes
			print '<table class="table">
				<tr>
					<td style="text-align:center" class="">' . $acesso[0] . '</td>
					<td style="text-align:center" class="">' . $acesso[1] . '</td>
					<td style="text-align:center" class="">' . $acesso[2] . '</td>
					<td style="text-align:center" class="">' . $acesso[3] . '</td>
				</tr>
				<tr>
					<td style="text-align:center" class="">' . $acesso[4] . '</td>
					<td style="text-align:center" class="">' . $acesso[5] . '</td>
					<td style="text-align:center" class="">' . $acesso[6] . '</td>
					<td style="text-align:center" class="">' . $acesso[7] . '</td>
				</tr>
			</table>';
		}
	}
}
