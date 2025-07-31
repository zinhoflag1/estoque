<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'classe/Classe.Conexao.php';
require_once 'classe/Classe.Permissao.php';

    $conexao = ConexaoPDO::getInstance();
	
	$_login = new Login();
	
	$_login->logado();
	
	$_permissao = new Permissao(); 
		
	$_id_usuario = $_SESSION['seguranca']['login']['id_usuario'];
	
	$acesso = $_permissao->AcessoMenu($_id_usuario);


	print '
                    <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="secao.php?secao=inicio">Inicio</a>
                </li>
';
                if($acesso['cad_cliente'] == 1){

                                    print   '<!-- CLIENTE -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Clientes</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="secao.php?secao=cliente&acao=cadastrar" title="Cadastro de Clientes">Cadastro</a></li>
                        <li><a class="dropdown-item" href="secao.php?secao=cliente&acao=buscarAlterar" title="Pesquisa de Cliente">Pesquisa</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </li>';
                }


            //     <li class="nav-item">
            //         <a class="nav-link" href="#">Link</a>
            //     </li>
            //     <li class="nav-item">
            //         <a class="nav-link disabled">Disabled</a>
            //     </li>
            // </ul>
                            

                                if($acesso['cad_vendedor'] == 1){

                                    print '<!-- VENDEDOR -->
                                     <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Vendedores</a>
                    <ul class="dropdown-menu">
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a href="secao.php?secao=vendedor&acao=cadastrar" title="Cadastro de Vendedores">Cadastro</a></li>
                                                <li class="nav-item"><a href="secao.php?secao=vendedor&acao=buscarAlterar" title="Pesquisa de Vendedor">Pesquisa</a></li>
                                            </ul>
                                    </li>';
                                }

                                print '
                                <!-- PRODUTO/ CATEGORIA -->
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Manter dados do Produto e Categoria">Produto/Linha<b class="caret"></b></a>
                                        <ul class="dropdown-menu">';

                                        if($acesso['cad_produto'] == 1){

                                            print   '<li class="dropdown-submenu">
                                                        <a href="#" title="Cadastro de Produtos">Produtos</a>
                                                            <ul class="dropdown-menu">
                                                                <li class="nav-item"><a href="secao.php?secao=produto&acao=cadastrar" title="Cadastrar Produtos">Cadastro</a></li>
                                                                <li class="nav-item"><a href="secao.php?secao=produto&acao=buscarAlterar" title="Pesquisa de Produtos">Pesquisa </a></li>
                                                            </ul>
                                                    </li>';
                                        }

                                        if($acesso['cad_linha'] == 1){

                                            print   '<li class="dropdown-submenu">
                                                        <a href="#" title="Categorias de Produtos">Linha Produto</a>
                                                            <ul class="dropdown-menu">
                                                                <li class="nav-item"><a href="secao.php?secao=linha&acao=cadastrar" title="Cadastrar Linha de Produtos">Cadastro</a></li>
                                                                <li class="nav-item"><a href="secao.php?secao=linha&acao=buscarAlterar" title="Pesquisar Linha de Produtos">Pesquisar</a></li>
                                                            </ul>
                                                    </li>';
                                        }
                                        print '</ul>';

                                print '</li>';

                                if($acesso['pedido'] == 1){

                                    print '<!-- PEDIDO -->
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Manter Pedidos de Produtos">Pedido<b class="caret"></b></a>
                                                    <ul class="dropdown-menu">';
                                    					
                                    					if($acesso['gerapedido'] == 1) {
                                    						
                                    						print '<li class="nav-item"><a href="secao.php?secao=pedido&acao=cadastrar" title="Gerar Pedido">Gerar Pedido</a></li>';
                                    					}
                                    					
                                    					print '<li class="nav-item"><a href="secao.php?secao=pedido&acao=buscarAlterar" title="Pesquisa de Pedido">Pesquisa</a></li>';
                                    					
                                    					if($acesso['fechapedido'] == 1){
                                    					
                                    						print '<li class="nav-item"><a href="secao.php?secao=pedido&acao=buscarQuitar" title="Quitar Pedido">Fechar</a></li>';
                                    					}
                                    					print '
                                                    </ul>
                                            </li>';
                                }

                                if($acesso['estoque'] == 1){

                                    print '
                                        <!-- ESTOQUE -->
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Manter o Estoque dos Produtos">Estoque<b class="caret" title=""></b></a>
                                                <ul class="dropdown-menu">
                                                    <li class="nav-item"><a href="secao.php?secao=estoque&acao=cadastrar" title="Lançamento Estoque">Cadastro</a></li>
                                                    <li class="nav-item"><a href="secao.php?secao=estoque&acao=buscarAlterar" title="Pesquisa de Estoque">Pesquisa</a></li>
                                                </ul>
                                        </li>';
                                }

                                if($acesso['rota'] == 1){

                                    print '<!-- ROTA -->
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Manter as Rotas dos Vendedores">Rota<b class="caret" title=""></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li class="nav-item"><a href="sc.rota.cadastrar.php" title="Cadastro de Rota de Vendedores ">Cadastro</a></li>
                                                        <li class="nav-item"><a href="sc.rota.pesquisar.alterar.php" title="Alteração de Rota de Vendedores">Alteração</a></li>
                                                        <li class="nav-item"><a href="sc.rota.pesquiar.mapa.gerar.php" title="Gerar Mapa de Rota de Vendedores">Mapa</a></li>
                                                    </ul>
                                            </li>';
                                }

                                if($acesso['relatorio'] == 1){

                                    print '<!-- RELATORIO -->
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Relatorios Gerenciais">Relatório<b class="caret" title=""></b></a>
                                                    <ul class="dropdown-menu">';
                                    
                                    					if($acesso['posicao_estoque'] == 1){
                                    						
                                    						print '<li class="nav-item"><a href="secao.php?secao=relatorio&acao=estoque" title="Posição Geral do Estoque">Posição Estoque</a></li>';
                                    					}
                                    					
                                    					if($acesso['tabela_preco'] == 1){
                                    						
                                    						print '<li class="nav-item"><a href="secao.php?secao=relatorio&acao=tabelaPreco" title="">Tabela de Preços</a></li>';	
                                    					}
                                    					
                                    					if($acesso['pos_pedido'] == 1){
                                    					
                                    						print '<li class="dropdown-submenu">
                                                                		<a href="#" title="Posição dos Pedidos">Posição Pedidos</a>
                                                                		<ul class="dropdown-menu">
                                                                    	<li class="nav-item"><a href="secao.php?secao=relatorio&acao=pedidoAbertoQuitado&op=0" title="Relatório Pedidos em Aberto">Relatório Pedidos em Aberto</a></li>
                                    									<li class="nav-item"><a href="secao.php?secao=relatorio&acao=pedidoAbertoQuitado&op=1" title="Relatório Pedidos Quitados">Relatório Pedidos Quitados</a></li>
                                                                </ul>
                                                            </li>';
                                    					}
                                    					
                                    					if($acesso['resumo'] == 1){
                                    					
                                    							print '<li class="dropdown-submenu">
                                                                		<a href="#" title="Resumo">Resumos</a>
                                                                		<ul class="dropdown-menu">
                                    										<li class="nav-item"><a href="secao.php?secao=relatorio&acao=resumoGeral" title="Resumo Geral de Contas">Resumo Geral</a></li>
                                                                    		<li class="nav-item"><a href="secao.php?secao=relatorio&acao=resumoQuitacao" title="Resumo Quitacao">Resumo Quitação</a></li>
                                    										<li class="nav-item"><a href="secao.php?secao=relatorio&acao=resumoAberto" title="Resumo Pedido Aberto">Resumo Pedido em Aberto</a></li>
                                                                		</ul>
                                                            		 </li>';
                                    					}
                                                    print '</ul>

                                                    
                                            </li>';
                                }

                                if($acesso['configuracao'] == 1){

                                    print '<!-- CONFIGURACAO -->
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Configurações">Configurações<b class="caret" title=""></b></a>
                                                <ul class="dropdown-menu">
                                                    <li class="nav-item"><a href="secao.php?secao=config&acao=configuracao" title="Sair com Segurança do Sistema">Configuração</a></li>
                                                    <li class="nav-item"><a href="secao.php?secao=config&acao=adm" title="Administração do Sistema">Administração</a></li>
                                                </ul>';
                                }
        print '</div>';
?>