    <?php include_once 'config.inc.php';?>
    <!DOCTYPE html>
    <html>
    <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <!-- CABECALHO -->
        <div class="container">
            <?php include_once 'pagina.cabecalho.php';?>
        </div>
        <div class="container">
            <?php include_once 'pagina.barraVersao.php';?>
        </div>  
        <div class="container"><hr></div>
            <!-- MENU -->
            <div class="container">
               <?php include_once 'pagina.menu.php';?>
            </div>
               <!-- CORPO -->
               <div class="container">
                     <br />
                    <form action="sc.rota.alterar.php" method="POST" name="frm_cliente">
                    <fieldset>
                    <legend class="text-center">Pesquisa Alteração Rota</legend>
                    <div class="controls controls-row">
                        <input class="span7" type="text" placeholder="Digite o Numero da Rota" name="txt_numero">
                        <button type="submit" class="btn">Pesquisar</button>
                    </div>
                    
                    </fieldset>
                    </form>
               </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
                                    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>