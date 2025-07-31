<?php 
header ( "Cache-Control: no-cache, must-revalidate" );

    ###################################################  home ##################################################
    
    #@ pagina inicial
    if((isset($_GET['secao']) && $_GET['secao'] == 'inicio')){

        include_once 'index.php';
        exit();

    }
    
    #@ Formulario cadastro cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'login') && (isset($_GET['acao']) && $_GET['acao'] == 'logar')){
    
    	include 'cont/valida.usuario.php';
    	exit();
    
    }



    ###################################################  cadastro cliente ##################################################
    
    #@ Formulario cadastro cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){

        include 'visao/sc.cliente.cadastrar.php';
        exit();

    }

    #@ Valida cadastro cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'validarCadastrar')){

        include 'controle/validar.cliente.cadastrar.php';
        exit();

    }

    #@ Busca cliente Altera
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarAlterar')){

        include 'visao/sc.cliente.buscar.alterar.php';
        exit();

    }


    #@ Altera cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'Alterar')){

        //$_id_cliente = $_GET['id'];

        include 'visao/sc.cliente.alterar.php';
        exit();

    }

    #@ Valida Altera cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'validarAlterar')){

        include 'controle/validar.cliente.alterar.php';
        exit();

    }

    #@ busca dados cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'pesquisar')){

        include 'visao/sc.cliente.pesquisar.php';
        exit();

    }
    
    #@ dados do cliente
    if((isset($_GET['secao']) && $_GET['secao'] == 'cliente') && (isset($_GET['acao']) && $_GET['acao'] == 'dados')){
    	
    	$_id = $_GET['id'];    
    	include 'visao/sc.cliente.dados.php';
    	exit();
    
    }

    ###################################################  cadastro vendedor ##################################################
    
    #@ Formulario cadastro vendedor
    if((isset($_GET['secao']) && $_GET['secao'] == 'vendedor') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){

        include_once 'visao/sc.vendedor.cadastrar.php';
        exit();

    }

    #@ Valida cadastro vendedor
    if((isset($_GET['secao']) && $_GET['secao'] == 'vendedor') && (isset($_GET['acao']) && $_GET['acao'] == 'validarCadastrar')){

        include_once 'controle/validar.vendedor.cadastrar.php';
        exit();

    }

    #@ Busca vendedor Altera
    if((isset($_GET['secao']) && $_GET['secao'] == 'vendedor') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarAlterar')){

        include_once 'visao/sc.vendedor.buscar.alterar.php';
        exit();

    }
    #@ Altera vendedor
    if((isset($_GET['secao']) && $_GET['secao'] == 'vendedor') && (isset($_GET['acao']) && $_GET['acao'] == 'Alterar')){

        $_id_vendedor = $_GET['id'];
        include_once 'visao/sc.vendedor.alterar.php';
        exit();

    }

    #@ Valida Altera vendedor
    if((isset($_GET['secao']) && $_GET['secao'] == 'vendedor') && (isset($_GET['acao']) && $_GET['acao'] == 'validarAlterar')){

        include_once 'controle/validar.vendedor.alterar.php';
        exit();

    }


     ###################################################  cadastro produto ##################################################
    
    #@ Formulario cadastro produto
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){

        include_once 'visao/sc.produto.cadastrar.php';
        exit();

    }

    #@ Valida cadastro produto
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'validarCadastrar')){

        include_once 'controle/validar.produto.cadastrar.php';
        exit();

    }

    #@ Busca produto Altera
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarAlterar')){

        include_once 'visao/sc.produto.buscar.alterar.php';
        exit();

    }
    #@ Altera produto
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'Alterar')){

        $_id_produto = $_GET['id'];
        include_once 'visao/sc.produto.alterar.php';
        exit();

    }

    #@ Valida Altera produto
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'validarAlterar')){

        include_once 'controle/validar.produto.alterar.php';
        exit();

    }

    #@ adicionar produto cesta
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'adicionar')){

        include_once 'visao/sc.produto.cesta.adicionar.php';
        exit();

    }

    #@ pesquisa de produtos por nome
    if((isset($_GET['secao']) && $_GET['secao'] == 'produto') && (isset($_GET['acao']) && $_GET['acao'] == 'pesquisar')){

        include_once 'visao/sc.produto.pesquisar.php';
        exit();

    }




     ###################################################  cadastro Linha ##################################################
    
    #@ Formulario cadastro linha
    if((isset($_GET['secao']) && $_GET['secao'] == 'linha') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){

        include_once 'visao/sc.linha.cadastrar.php';
        exit();

    }

    #@ Valida cadastro linha
    if((isset($_GET['secao']) && $_GET['secao'] == 'linha') && (isset($_GET['acao']) && $_GET['acao'] == 'validarCadastrar')){

        include_once 'controle/validar.linha.cadastrar.php';
        exit();

    }

    #@ Busca linha Altera
    if((isset($_GET['secao']) && $_GET['secao'] == 'linha') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarAlterar')){

        include_once 'visao/sc.linha.buscar.alterar.php';
        exit();

    }
    #@ Altera linha
    if((isset($_GET['secao']) && $_GET['secao'] == 'linha') && (isset($_GET['acao']) && $_GET['acao'] == 'Alterar')){

        $_id_linha = $_GET['id'];
        include_once 'visao/sc.linha.alterar.php';
        exit();

    }

    #@ Valida Altera linha
    if((isset($_GET['secao']) && $_GET['secao'] == 'linha') && (isset($_GET['acao']) && $_GET['acao'] == 'validarAlterar')){

        include_once 'controle/validar.linha.alterar.php';
        exit();

    }


     ###################################################  cadastro pedido ##################################################
    
    #@ Formulario cadastro pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){

        include_once 'visao/sc.pedido.cadastrar.php';
        exit();

    }

    #@ Valida cadastro pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'validarCadastrar')){

        include_once 'controle/validar.pedido.cadastrar.php';
        exit();

    }

    #@ Busca pedido Altera
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarAlterar')){

        include_once 'visao/sc.pedido.buscar.alterar.php';
        exit();

    }
    #@ Altera pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'Alterar')){

        $_id_pedido = $_GET['id'];
        include_once 'visao/sc.pedido.alterar.php';
        exit();

    }

    #@ Valida Altera pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'validarAlterar')){

        include_once 'controle/validar.pedido.alterar.php';
        exit();

    }

    #@ fechar Pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'fechar')){

        include_once 'visao/sc.pedido.fechar.php';
        exit();

    }

    #@ Imprimir Pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'imprimir')){

        include_once 'visao/sc.pedido.imprimir.php';
        exit();

    }
    
    #@ quitar Pedido
    if((isset($_GET['secao']) && $_GET['secao'] == 'pedido') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarQuitar')){
    
    	include_once 'visao/sc.pedido.buscar.quitar.php';
    	exit();
    
    }
    
    ###################################################### estoque ##########################################################

     #@ Adicionar Estoque
    if((isset($_GET['secao']) && $_GET['secao'] == 'estoque') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){

        include_once 'visao/sc.estoque.cadastrar.php';
        exit();

    }

    #@ Valida cadastro estoque
    if((isset($_GET['secao']) && $_GET['secao'] == 'estoque') && (isset($_GET['acao']) && $_GET['acao'] == 'validarCadastrar')){

        include_once 'controle/validar.estoque.cadastrar.php';
        exit();
    }

    #@ buscar Alterar Estoque
    if((isset($_GET['secao']) && $_GET['secao'] == 'estoque') && (isset($_GET['acao']) && $_GET['acao'] == 'buscarAlterar')){

        include_once 'visao/sc.estoque.buscar.alterar.php';
        exit();
    }

    #@ Alterar Estoque
    if((isset($_GET['secao']) && $_GET['secao'] == 'estoque') && (isset($_GET['acao']) && $_GET['acao'] == 'Alterar')){
        $_id_produto = $_GET['id'];
        include_once 'visao/sc.estoque.alterar.php';
        exit();
    }

    ###################################################### relatorio ##########################################################

    #@ saldo geral de mercadorias
    if((isset($_GET['secao']) && $_GET['secao'] == 'relatorio') && (isset($_GET['acao']) && $_GET['acao'] == 'estoque')){

        include 'visao/sc.relatorio.estoque.posicao.php';
        exit();

    }

    #@ Tabela de Preços
    if((isset($_GET['secao']) && $_GET['secao'] == 'relatorio') && (isset($_GET['acao']) && $_GET['acao'] == 'tabelaPreco')){

        include 'visao/sc.relatorio.produto.tabela.php';
        exit();

    }

    #@ Relatorio Pedido em Aberto 
    if((isset($_GET['secao']) && $_GET['secao'] == 'relatorio') && (isset($_GET['acao']) && $_GET['acao'] == 'pedidoAbertoQuitado')){

        include 'visao/sc.relatorio.busca.pedido.aberto.quitado.php';
        exit();

    }

    
    #@ resumo geral
    if((isset($_GET['secao']) && $_GET['secao'] == 'relatorio') && (isset($_GET['acao']) && $_GET['acao'] == 'resumoGeral')){
    
    	include 'visao/sc.relatorio.resumo.pedido.php';
    	exit();
    
    }
    


    ###################################################### configuracao ##########################################################

    #@ pagina configuracao
    if((isset($_GET['secao']) && $_GET['secao'] == 'config') && (isset($_GET['acao']) && $_GET['acao'] == 'configuracao')){

        include_once 'visao/sc.sistema.configurar.php';
        exit();

    }

    #@ pagina administrador
    if((isset($_GET['secao']) && $_GET['secao'] == 'config') && (isset($_GET['acao']) && $_GET['acao'] == 'adm')){

        include_once 'visao/sc.sistema.adm.php';
        exit();

    }

    #@ logout do sistema
    if(isset($_GET['secao']) && $_GET['secao'] == 'logout'){

        $logout = 's';
        include 'visao/logout.php';
        exit();

    }
    
    
    
    ####################################################################  usuario##############################################

    #@ cadastro de usuario
    if((isset($_GET['secao']) && $_GET['secao'] == 'usuario') && (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar')){
    
    	include_once 'visao/sc.usuario.cadastrar.php';
    	exit();
    
    }
    
   

        


        


?>
