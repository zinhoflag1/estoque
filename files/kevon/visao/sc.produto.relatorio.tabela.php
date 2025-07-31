    <?php session_start();
    	print "<!DOCTYPE html>";
    include_once 'config.inc.php';
    
    require_once 'Classe/Classe.Conexao.php';
    
    $conexao = ConexaoPDO::getInstance();
    
    $_login = new Login();
    
    $_login->logado();
    
    ?>
    
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
            <div class="row">
                <div class="span12">
                    <?php include_once 'pagina.barraVersao.php';?>
                </div>
            </div>
        </div>  
        <div class="container">
            <div class="row">
                <div class="span12">
                    <table class="table">
                        <tr><td colspan="3"><h3>Linha Profissiona</h3></td></tr>
                        <tr><td>Código</td><td>Produto</td><td>Valor</td></tr>
                        <tr><td>01</td><td>Shampoo</td><td>R$ 10,40</td></tr>
                        <tr><td>02</td><td>Creme</td><td>R$ 100,00</td></tr>
                        <tr><td>03</td><td>Máscara</td><td>R$ 50,69</td></tr>
                        <tr><td>04</td><td>Shampoo</td><td>R$ 50,69</td></tr>
                        <tr><td colspan="3"><hr></td></tr>
                        <tr><td colspan="3"><h3>Linha Pessoal</h3></td></tr>
                        <tr><td>Código</td><td>Produto</td><td>Valor</td></tr>
                        <tr><td>01</td><td>Shampoo</td><td>R$ 10,40</td></tr>
                        <tr><td>02</td><td>Creme</td><td>R$ 100,00</td></tr>
                        <tr><td>03</td><td>Máscara</td><td>R$ 50,69</td></tr>
                        <tr><td>04</td><td>Shampoo</td><td>R$ 50,69</td></tr>
                    </table>
                </div>
            </div>
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