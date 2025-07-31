<?php
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe manipulacao de dadas para visualizacao e inser��o no banco mysql			*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/02/2012															*
************************************************************************************/
require_once 'Classe.Conexao.php';
	
	class DataMysql # data para Gravar no banco Mysql
		{

	public static $conexao;
	public static $pdo;

	public function __construct()
	{
		self::$conexao = ConexaoPDO::getInstance();
		self::$pdo = self::$conexao->getPDO();
	}

			
			#@  parametro : 31/12/2012 padrao brasil,  formata a data gravar no banco 
			static function dataForm($nDtForm) 
			{
				
				$dia = substr($nDtForm, 0, 2);
				$mes = substr($nDtForm, 3, 2); 
				$ano = substr($nDtForm, 6, 8);
							
				return $ano.'/'.$mes.'/'.$dia; # saida para gravar no banco 2012/12/31
			
			}

			# entrada 2012/12/31, formata a data para visualizacao do formulario ou usuario
			static function dataVisual($nDtForm) 
			{
			
				$ano = substr($nDtForm, 0, 4);
				$mes = substr($nDtForm, 5, 2);
				$dia = substr($nDtForm, 8, 2);
					
				return $dia.'/'.$mes.'/'.$ano; # saida para visualizacao no Form
					
			}
		
		
			#@ devolve a data para documentos por extenso no padrao 31/12/2012
			#@ retorno '31 de Dezembro de 2012'
			function dataExtensoDocumento($nDtForm){
				
				$_mes = substr($nDtForm, 3, 2);
				$_dia = substr($nDtForm, 0, 2);
				$_ano = substr($nDtForm, 6, 4);
				
				//global $mes, $dia, $ano;
				

				
				$array_dia = array(1=>'Segunda',
								2=>'Terca',
								3=>'Quarta',
								4=>'Quinta',
								6=>'Sexta',
								7=>'Sabado',
								8=>'Domingo');
				
				$array_mes = array(1=>'Janeiro',
							 2=>'Fevereiro',
							 3=>'Mar�o',
							 4=>'Abril',
							 5=>'Maio',
							 6=>'Junho',
							 7=>'Julho',
							 8=>'Agosto',
							 9=>'Setembro',
							10=>'Outubro',
							11=>'Novembro',
							12=>'Dezembro');


					for($i=1; $i <= count($array_mes); $i++){
						
							if($_mes == $i)
								return $_dia.' de '. $array_mes[$i]. ' de '.$_ano;
						
					}
				
			}
			
			
			function SomarData($data, $dias, $meses, $ano){
   
				//passe a data no formato dd/mm/yyyy 
				$data = explode("/", $data);
				$newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
				return $newData;
			}
			
			
			#@ extrai a data de um campo datetime
			function extraiData($data){
				
				$ano = substr($data, 0, 4);
				$mes = substr($data, 5, 2);
				$dia = substr($data, 8, 2);
					
				return $dia.'/'.$mes.'/'.$ano;
				
			}
			
			#@ extrai a hora do campo date time
			function extraiHora($hora){
				
				$hor = substr($hora, 11,2);
				$min = substr($hora, 14, 2);
				$seg = substr($hora, 17, 2);
					
				return $hor.':'.$min.':'.$seg;
				
			}
			
			function dataCompleta($data){
				
				switch ($data){
					
					case 01:
						$mes = 'Janeiro';
						break;
					case 02:
						$mes = 'Fevereiro';
						break;
					case 03:
						$mes = 'Mar�o';
						break;
					case 04:
						$mes ='Abril';
						break;
					case 05:
						$mes = 'Maio';
						break;
					case 06:
						$mes = 'Junho';
						break;
					case 07:
						$mes = 'Julho';
						break;
					case "08":
						$mes = 'Agosto';
						break;
					case "09":
						$mes = 'Setembro';
						break;
					case 10:
						$mes = 'Outubro';
						break;
					case 11:
						$mes = 'Novembro';
						break;
					case 12:
						$mes = 'Dezembro';
						break;
					default: 
						$mes = null;
						break;
					
				}
				
				
				return $mes;
					
				
			}
			
			#@ validar data
			function validaData($data) {
				
				$dia = substr($data, 0, 2);
				$mes = substr($data, 3, 2); 
				$ano = substr($data, 6, 8);
				
				
				return checkdate($mes, $dia, $ano);
				
				
			}
			

}
		
	
		
		//$obj = new dataMysql();
		//$obj->dataForm('06/07/1978');

		//$obj->dataVisual('2012/04/26');
		
		//$obj->dataExtenso('06/07/1978');
		
		//FuncaoBase::vd($obj);
		
	
		
		
		
		
?>