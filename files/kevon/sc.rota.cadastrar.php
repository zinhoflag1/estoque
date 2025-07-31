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
                    <fieldset>
                        <legend class="text-center">Cadastro de Rota</legend>
                        <form action="valida.rota.cadastro.php" methos="POST">

                            <input class="span2" type="text" placeholder="Código" name="txt_numero">
                            <br />
                            <input class="span2" type="text" placeholder="Nº Rota" name="txt_numero">
                            <br />
                            <button type="submit" class="btn">Adicionar Vendedor</button>
                            <button type="submit" class="btn">Adicioar Cliente</button>
                            <br />
                            <br />
                                <textarea class="span8" rows="4" placeholder="Observação" name="txt_numero"></textarea>
                            <br />
                                <button type="submit" class="btn">Cadastrar</button>

                            </div>
                        </form>
                    </fieldset>
                </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
                                    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>