var xmlhttp;
function loadDoc(string,url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(string);
}
$(document).ready(function(){


		//haremos un efecto ajax para llamar a los estados municipios y parroquia de  x lugar
		$(".select_estado").change(function(){
				idestado = $(this).val();
				municipio=document.getElementById("idmunicipio");
				//hacemos la funcion ajax
				$.post("controlador/ajax_combo.php",{idestado:idestado,nivel:'estado'},function(data){
				municipio.disabled = false;
						$(".select_municipio").html(data);
				});
			
		});//cierre del change  del select estado

    //haremos un efecto ajax para llamar a las parroquias del municipio y parroquia de  x lugar
		$(".select_municipio").change(function(){
				idmunicipio = $(this).val();
				parroquia=document.getElementById("idparroquia");
				
				//hacemos la funcion ajax
				$.post("controlador/ajax_combo.php",{idmunicipio:idmunicipio,nivel:'municipio'},function(data){
				parroquia.disabled = false;
						$(".select_parroquia").html(data);
				});
		});//cierre del change  del select municipio
		//haremos un efecto ajax para llamar a las parroquias del municipio y parroquia de  x lugar
		$(".select_parroquia").change(function(){
				idparroquia = $(this).val();
				ciudad=document.getElementById("idciudad");
				
				//hacemos la funcion ajax
				$.post("controlador/ajax_combo.php",{idparroquia:idparroquia,nivel:'parroquia'},function(data){
				ciudad.disabled = false;
						$(".select_ciudad").html(data);
				});
		});//cierre del change  del select parroquia

		
 });
function selec_producto(){
	
				modelo=document.getElementById("nom_mod");
				//hacemos la funcion ajax
				$.post("../controlador/ajax_combo.php",{codigo:codigo,nivel:'modelo'},function(data){
				genero.disabled = false;
						$(".select_modelo").html(data);
				});
			
}