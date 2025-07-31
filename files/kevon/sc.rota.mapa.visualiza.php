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
                    <div class="span12 text-center">
                    <iframe width="600" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?saddr=Av.+Amazonas,+115,+Centro,+Belo+Horizonte+-+Minas+Gerais&amp;daddr=R.+Tabaiares+-+Floresta,+Belo+Horizonte+-+MG,+30150-040+to:Rua+dos+Timbiras,+450,+Belo+Horizonte+-+Minas+Gerais+to:Rua+S%C3%A3o+Paulo,+1048,+Belo+Horizonte+-+Minas+Gerais+to:Acesso+para+Av+dos+Andradas,+169,+Belo+Horizonte+-+Minas+Gerais&amp;hl=pt-BR&amp;ie=UTF8&amp;sll=-19.918119,-43.931883&amp;sspn=0.012185,0.013797&amp;geocode=FfwT0P4dzpVh_SmT6f9N-pmmADGDvBe_1HFIZw%3BFdkS0P4dFadh_Sl5BKPc8JmmADFWo0QwxQhBxQ%3BFVblz_4d5Llh_SntSR6n65mmADGA7peqcfd6rg%3BFS0B0P4dMoNh_SnvfMe145mmADHvCNI0txZB3A%3BFQ4b0P4dXP9h_Slr3wjqK5qmADH1xfYLxkvfiQ&amp;oq=Rua+dos+Andradas,+169+be&amp;mra=ls&amp;t=m&amp;ll=-19.922804,-43.925103&amp;spn=0.014217,0.03233&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?saddr=Av.+Amazonas,+115,+Centro,+Belo+Horizonte+-+Minas+Gerais&amp;daddr=R.+Tabaiares+-+Floresta,+Belo+Horizonte+-+MG,+30150-040+to:Rua+dos+Timbiras,+450,+Belo+Horizonte+-+Minas+Gerais+to:Rua+S%C3%A3o+Paulo,+1048,+Belo+Horizonte+-+Minas+Gerais+to:Acesso+para+Av+dos+Andradas,+169,+Belo+Horizonte+-+Minas+Gerais&amp;hl=pt-BR&amp;ie=UTF8&amp;sll=-19.918119,-43.931883&amp;sspn=0.012185,0.013797&amp;geocode=FfwT0P4dzpVh_SmT6f9N-pmmADGDvBe_1HFIZw%3BFdkS0P4dFadh_Sl5BKPc8JmmADFWo0QwxQhBxQ%3BFVblz_4d5Llh_SntSR6n65mmADGA7peqcfd6rg%3BFS0B0P4dMoNh_SnvfMe145mmADHvCNI0txZB3A%3BFQ4b0P4dXP9h_Slr3wjqK5qmADH1xfYLxkvfiQ&amp;oq=Rua+dos+Andradas,+169+be&amp;mra=ls&amp;t=m&amp;ll=-19.922804,-43.925103&amp;spn=0.014217,0.03233&amp;source=embed" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>
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