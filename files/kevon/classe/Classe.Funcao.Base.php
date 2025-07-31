<?php
require_once 'Classe.Conexao.php';

define('DEBUG', 1);
/**
 *
 */
class FuncaoBase {

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}


    function TrataCpf($_cpf) {

        //$_caracter = array('.',',',':',';','\\','/','-');

        //$certo =  str_replace($_caracter, "", $_cpf);

        if((strlen($_cpf) =='14') || (strlen($_cpf =='18'))) {

            return $_cpf;


        }else {

            return false;

        }
    }


    function formulario($texto){

        $_retorno = strtoupper(utf8_decode($texto));

        return $_retorno;

    }

    #@ retorna o numero no formato real
    function real($_valor) {

        return number_format($_valor, 2, ',', '.');
    }


    #@ retorna um selec com os meses do ano
    function mes(){

        print '<select name="mes" id="mes">
        <option></option>
        <option>Janeiro</option>
        <option>Fevereiro</option>
        <option>Março</option>
        <option>Abril</option>
        <option>Maio</option>
        <option>Junho</option>
        <option>Julho</option>
        <option>Agosto</option>
        <option>Setembro</option>
        <option>Outubro</option>
        <option>Novembro</option>
        <option>Dezembro</option>
        </select>';

    }

    #@ transforma o mes no formato letra para o numero ex janeiro = 1, dezembro = 12
    function mesTonum($_mes){

        $num_mes = array('1'=>'Janeiro',
                    '2'=>'Fevereiro',
                    '3'=>'Março',
                    '4'=>'Abril',
                    '5'=>'Maio',
                    '6'=>'Junho',
                    '7'=>'Julho',
                    '8'=>'Agosto',
                    '9'=>'Setembro',
                    '10'=>'Outubro',
                    '11'=>'Novembro',
                    '12'=>'Dezembro',);

        foreach ($num_mes as $key => $value) {

            if($_mes == $value) {

                return $key;

            }

        }
        	

    }

    #@ transforma o mes no formato letra para o numero ex janeiro = 1, dezembro = 12
    function numTomes($_mes){

        $num_mes = array('1'=>'Janeiro',
                    '2'=>'Fevereiro',
                    '3'=>'Março',
                    '4'=>'Abril',
                    '5'=>'Maio',
                    '6'=>'Junho',
                    '7'=>'Julho',
                    '8'=>'Agosto',
                    '9'=>'Setembro',
                    '10'=>'Outubro',
                    '11'=>'Novembro',
                    '12'=>'Dezembro',);

        foreach ($num_mes as $key => $value) {

            if($_mes == $key) {

                return $value;

            }

        }
        	

    }

    #@ funcao mensagem de ok na tela
    function alert($_msg, $volta = false){

        if($volta) {

            print '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("'.$_msg.'")
            history.back();
            </SCRIPT>
            ';

        }else {

            print '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("'.$_msg.'");
            </SCRIPT>';
            FuncaoBase::vd($_msg);

        }
    }


    #@ function FuncaoBase::vd()
    function vd($_deb){

        if(DEBUG == 1){

            return print 'Modo debug Ativo <br />'.var_dump($_deb);

        }else {

            return '';

        }



    }


    #@ funcao para fechar janela
    function Fechar(){

        return print '<a href="#" onclick="javascript:window.close();"><img src="'.SISTEMA.'/images/fechar.jpg" title="Fechar Janela"></a>';


    }

    #@ funcao para fechar imprimir
    function Imprimir(){

        return print '<a href="#" onclick="javascript:window.print();"><img src="/'.SISTEMA.'/images/imprimir.jpg" title="Iimprimir dados"></a>';


    }


    #@ funcao para voltar imprimir
    function voltar(){

        return print '<a href="#" onclick="javascript:history.back();"><img src="/'.SISTEMA.'/images/voltar.jpg" title="Volta Página"></a>';





    }

    #@ funcao paa abrir janela
    function AbriJanela($_pagina){

        print "<script language=\"javascript\">window.open('.$_pagina.', '_blank')></script>";

    }

    #@ backup do sistema
    function backup($nome) {

        $sql = '' ;
        	
        print $sql;

        $result = self::$pdo->query($sql) or die();

        while ($linha = $result->fetch()){

            //self::static_var$[] = $linha;

        }

        //return self::static_var$;

    }

    #@ tamanho da base
    function TamanhoBase(){

        $sql = 'show table status from
        gestaocedec';

        $tamanho = 0;

        $result = self::$pdo->query($sql) or die();

        //var_dump($linha = $result->fetch());

        while($linha = $result->fetch()){


            $tamanho += (($linha['Data_length'] + $linha['Index_length']) / 1024) /1024;




        }


        return $tamanho. ' MB';



    }

    #@ retorna o ultimo dia do mes
    function UltimoDiaMes($mes = false){

        $ultimo = array('1'=> 31,
                    '2'=> 28,
                    '3'=> 31,
                    '4'=> 30,
                    '5'=> 31,
                    '6'=> 30,
                    '7'=> 31,
                    '8'=> 31,
                    '9'=> 30,
                    '10'=> 31,
                    '11'=> 30,
                    '12'=> 31);
        var_dump($ultimo);

        for($i=1; $i< count($ultimo); $i++) {
            if(key($ultimo) == $mes){
                return $ultimo[$i];
            }
        }
        	

    }


    #@ funcao para pular linhas
    function espaco($nr_linha){

        for ($i = 0; $i < $nr_linha; $i++){
            print '<br />';
        }

    }

    #@protecao imput
    function prot(){



    }

    #@ combo, select dinamico universal
    /*
     parametros:
    - nometabela - nome da tabela
    - nomeCampo - nome do Campo da tabela
    - selected ? true, false
    - dadoCampoSelected - valor para ser o selected
    - nomeCampoMostraDados - campo para selected
    - debug ? necessidade de analisar o sql ? true, false
    */
    function comboDinamico($nomeTabela, $nomeCampo, $selected = false, $dadoNomeCampoSelected = false, $dadoCampoSelected = false, $debub = true){

        $sql = 'SELECT '.$nomeCampo.' FROM '.$nomeTabela;



        $result = self::$pdo->query($sql) or die();

        print '<select name='.$nomeCampo.'>';

        if($selected == true){

            $sql1 = 'SELECT '.$nomeCampo.' FROM '.$nomeTabela.' WHERE '.$dadoCampoSelected.' = '.$dadoNomeCampoSelected;

            $result1 = self::$pdo->query($sql1) or die();

            $linha1 = $result1->fetch(PDO::FETCH_BOTH);

            print '<option>'.$linha1[''.$nomeCampo.''].'</option>';

        }else {

            print '<option></option>';

        }

        while ($linha = $result->fetch()){

            print '<option>'.$linha['nivel'].'</option>';

        }

        print '</select>';

        if($debub == true){

            print $sql.'<br />';
            print $sql1;
            var_dump($linha1);
            print '<option>'.$linha[''.$nomeCampo.''].'</option>';

        }

    }

    #@ verifica campo em branco
    function campoBranco($campos){

        $mensagem = array();

        foreach ($campos as $key => $value) {

            if($value == ""){
                	
                $mensagem[] = $key;
            }
        }
        	
        	
        	
        // Total campos em branco
        $totCampoBranco = count($mensagem);

        if($totCampoBranco > 0) {

            print "<br /><table align=\"center\" border=\"0\">";

            for ($i =0; $i < $totCampoBranco; $i++){
                	
                print "<tr>
                <td>O Campo:</td>
                <td><b>$mensagem[$i]</b> Não pode Ficar em Branco</td>
                </tr>";
            }

            print "<tr>
                        <td align='center'>
                            <a class='btn' href='javascript:history.back();'>Voltar</a>
                        </td>
                    </tr>
                    </table>";


        }else {

            return true;

        }
    }

    #@ Mostrar mensagem do módulo ajuda
    function mostraMensagem() {

        $sql = "SELECT id_mensagem, titulo, mensagem
        FROM cedec_mensagem
        ORDER BY id_mensagem DESC
        LIMIT 1 ";

        $result = self::$pdo->query($sql) or die();

        $linha = $result->fetch();

        print "<table width=\"100%\" border=\"0\" align=\"center\">
        <tr>
        <td class=\"titulo\" align=\"center\">{$linha[1]}</td>
        </tr>
        <tr>
        <td class=\"aviso\" align=\"justify\">{$linha[2]}</td>
        </tr>
        </table>";
        	
    }

    #@ pesquisa generica
    function pesquisaGenerica($campo, $tabela, $pesquisa) {
        	

        if(!empty($pesquisa))
        {

            //var_dump($pesquisa);

            $sql = "select $campo from $tabela where $campo like '$pesquisa[valor]%'";


            print $sql;


            $result = self::$pdo->query($sql) or die();
            	

            $linhas= $result->fetch(PDO::FETCH_NUM);
            	
            if($linhas>0){

                while($pegar= $result->fetch(PDO::FETCH_BOTH))
                    echo "<a href=\"#\">$pegar[nome]<a/><br />";
                	
            }
            	
        }
        	
        	
        	
    }

    #@ metodo para incluir javascript automaticamento da pasta js
    function include_arquivos() {

        $diretorio = "js";

        $leitura = opendir('js');

        while($arquivo = readdir($leitura)) {


            //print $arquivo."<br />";

            if(($arquivo != "." && $arquivo != "..") && (substr($arquivo, -2) == "js"))
            {

                //print $arquivo."<br />";

                print "<script type=\"text/javascript\" src=\"".$diretorio."/".$arquivo."\"></script><p>";

            }

        }

    }

    #@ tamanho para o primeiro campo do select
    function TamanhoCampo($tamanho) {
    
        for ($i=0; $i <= $tamanho; $i++) {
    
            print "&nbsp;";
        }
    
    }
    
    #@ remover acentos de frases
    static function RemoveAcento($_string){
    	
    	$_map = array('á' => 'a',
	    			'à' => 'a',
	    			'ã' => 'a',
	    			'â' => 'a',
	    			'é' => 'e',
	    			'ê' => 'e',
	    			'í' => 'i',
	    			'ó' => 'o',
	    			'ô' => 'o',
	    			'õ' => 'o',
	    			'ú' => 'u',
	    			'ü' => 'u',
	    			'ç' => 'c',
	    			'Á' => 'A',
	    			'À' => 'A',
	    			'Ã' => 'A',
	    			'Â' => 'A',
	    			'É' => 'E',
	    			'Ê' => 'E',
	    			'Í' => 'I',
	    			'Ó' => 'O',
	    			'Ô' => 'O',
	    			'Õ' => 'O',
	    			'Ú' => 'U',
	    			'Ü' => 'U',
	    			'Ç' => 'C'
    	);
    	
    	return strtr($_string, $_map); // funciona corretamente
    	
    }
    
    
    #@ validar email
    function validaEmail($mail){
    
    	if(preg_match("/^([a-zA-z0-9_.-]){3,}@([a-z0-9.-]{3,})(.[a-z]{2,3})(.[a-z]{2})?$/", $mail)){
    			
    		return true;
    			
    	}else{
    			
    		return false;
    			
    	}
    }

     
}?>