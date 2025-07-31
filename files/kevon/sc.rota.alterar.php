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

                    <fieldset>
                        <legend>Alterar Rota </legend>
                    </fieldset>

                    <form action="" method="">

                    <div class="controls controls-row">
                        <input class="span3"type="text" value="Número Rota : 11">
                        <input class="span3" type="text" value="Vendedor: Antônio">
                    </div>

                    <div class="controls controls-row">
                        <input class="span3 field" type="text" placeholder="Cliente" title="Nome do Cliente "><button type="submit" class="btn">Adicionar Cliente</button>
                    </div>
                    <br />
                    <br />                  
                    <div class="span5">
                        <table class="table">
                            <tr><td>Item</i><td><td>Cliente</td></tr>
                            <tr><td><i class="icon-remove-sign"></i><td><td>Salão 1</td></tr>
                            <tr><td><i class="icon-remove-sign"></i><td><td>Salão 2</td></tr>
                            <tr><td><i class="icon-remove-sign"></i><td><td>Salão 3</td></tr>
                        </table>
                    </div>
                </div>    
                    <!-- RODAPE -->
                    <div class="container">
                        <?php include_once 'pagina.rodape.php';?>
                    </div>
                                    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>