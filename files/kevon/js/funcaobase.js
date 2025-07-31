
function hide_caixa(){
	
	$("#id_rota").hide("slow");
	
}

/*
 * Funcao para marcara de CPF ou de CNPJ
 * 
 * 
 */
	function pessoa() {
	
		if($("#ch_pessoa").val == "pf"){
			
			$("#pessoa").mask("999.999.999-99");
			
		}else if($("#ch_pessoa").val == "pj"){
			
			$("#pessoa").mask("99.999.999/9999-99");
			
		}
				
	}
	
	function pf() {
		$("#cpf_cnpj").mask("999.999.999-99");
	}

	function pj() {
		$("#cpf_cnpj").mask("99.999.999/9999-99");
	}


	/* Enviar Formularios */
	function enviar_formulario(){
	
		document.form1.submit();
	
	}

	
	/*
	 * <script language="JavaScript"> function abrir(URL) {
	 * 
	 * var width = 150; var height = 250;
	 * 
	 * var left = 99; var top = 99;
	 * 
	 * window.open(URL,'janela', 'width='+width+', height='+height+',
	 * top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no,
	 * location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
	 *  } </script>
	 * 
	 * <a href="javascript:abrir('http://codigofonte.net/');">Clique Aqui</a>
	 */
	function abrir(URL,largura, altura, topo, esquerdo) {
		var width = largura;
		var height = altura;
	
		var left = esquerdo;
		var top = topo;
		
		window.open(URL,'', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
	}

	/* abrir janela */
	function open_win()	{
			
		window.open("http://www.w3schools.com");
		
	}




/*
 * Fechar Janela
 * 
 * ex : <a href="javascript:;" onclick="fecha_janela()">Fechar</a>
 * 
 */
function fecha_janela(){
window.opener = window;
window.close();
}

/**
 * @author Demetrio da Silva Passos
 * 
 * Message Box de Confirmacao ou abandono de fun��o Exemplo de uso
 * 
 * externo <script src="js/messageBox.js" type="text/javascript" ></script>
 * 
 * incorporado <SCRIPT language=JavaScript>
 * 
 * function MsgOkCancel() { var fRet; fRet = confirm('Are you sure?');
 * alert(fRet); }
 * 
 * </SCRIPT> <BODY> href=javascript:MsgOkCancel(); >test me</a> </BODY> </HTML>
 * 
 */

function MsgOkCancel()
{
	var tit;
	tit = confirm("Deseja Confirmar esta Operacao  ?");
	alert(tit);
}


function mensagem() {
	var name=confirm("Deseja confirmar a Libera��o ?");
	if (name==true)
	{
		document.write("Voc� pressionou o bot�o OK!");
	}
	else
	{
		document.write("Voc� pressionou o bot�o CANCELAR");
	}
}


/* conta os caracteres */
function mostrarResultado(box,num_max,campospan){
	var contagem_carac = box.length;
	if (contagem_carac != 0){
		document.getElementById(campospan).innerHTML = contagem_carac + " caracteres digitados";
		if (contagem_carac == 1){
			document.getElementById(campospan).innerHTML = contagem_carac + " caracter digitado";
		}
		if (contagem_carac >= num_max){
			document.getElementById(campospan).innerHTML = "Limite de caracteres excedido!";
		}
	}else{
		document.getElementById(campospan).innerHTML = "Ainda não temos nada digitado..";
	}
}

function contarCaracteres(box,valor,campospan){
	var conta = valor - box.length;
	document.getElementById(campospan).innerHTML = "Você ainda pode digitar " + conta + " caracteres";
	if(box.length >= valor){
		document.getElementById(campospan).innerHTML = "Opss.. você não pode mais digitar..";
		document.getElementById("campo").value = document.getElementById("campo").value.substr(0,valor);
	}	
}

/* Abre Janela no meio da tela
*  Parametros : string URL
*  opcionais : largura, altura, topo, esquerdo
*  Autor : Demetrio Silva Passos
*  Data : 24.04.2013
*/
function janelaMeio(URL, width, height, top, left){
	
	var width = screen.width / 1.5;
	
	var height = screen.height;

	var top = 5;

	var left = screen.width / 4;
	 
	window.open(URL,'', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}


function NovaJanela(pagina,nome,w,h,scroll){

	var win = null;
	
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';
	win = window.open(pagina,nome,settings);
}

function ValidaCampoBranco() {
	
		var allInputs = $(":input[type=text], select");
		var valores = new Array();

		allInputs.each(function(key, value){
		  
			if($(this).val() == "") {
				
				$("#erro").show();
				
			}else {
				
				$("#erro").hide();
				
			}
		
			/*alert(key + ': ' + $(this).val());*/
		  /*alert(key + ': ' + $(this).attr("id"));*/
		});

		return false;
	
	
}

function levarcodigo( placa, id_caminhao )
    {
       /** O "segredo" está aqui nessas duas linhas, onde é passado o codigo para o <input>
       *    e a descricao para o <label>
       */
       top.opener.document.getElementById("placa").value = placa;
       top.opener.document.getElementById("id_caminhao").value = id_caminhao;
       
       window.close();

    }


/* funcao para letras maiusculas
function upperCase() {
				var x = document.getElementById("fname");
				x.value = x.value.toUpperCase();
			}*/


//$(document).ready(function(){
     /* ao pressionar uma tecla em um campo que seja de class="pula" */
     //$('.pula').keypress(function(e){
        /* * verifica se o evento é Keycode (para IE e outros browsers) * se não for pega o evento Which (Firefox) */
       // var tecla = (e.keyCode?e.keyCode:e.which);
            
            /* verifica se a tecla pressionada foi o ENTER */
           // if(tecla == 13){
                /* guarda o seletor do campo que foi pressionado Enter */ 
                //campo = $('.pula');
                /* pega o indice do elemento*/
               // indice = campo.index(this);
                    
                    /*soma mais um ao indice e verifica se não é null *se não for é porque existe outro elemento */
                   // if(campo[indice+1] != null){
                        /* adiciona mais 1 no valor do indice */
                      //  proximo = campo[indice + 1];
                        /* passa o foco para o proximo elemento */
                      //  proximo.focus();
                  //  }
           // } /* impede o sumbit caso esteja dentro de um form */
                //    e.preventDefault(e); return false; })
//}

/* espera mouse */
function cursor_espera() {
document.body.style.cursor = 'wait';
}

/*normal mouse */
function cursor_normal() {
document.body.style.cursor = 'default';
}


