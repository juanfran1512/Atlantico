function getModelo(producto_id) {

	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {	
			document.getElementById("modeloList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../controlador/getModelo.php?producto_id="+producto_id,true);
	xmlhttp3.send();
}function getTela(producto_id) {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("telaList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../controlador/getTela.php?producto_id="+producto_id,true);
	xmlhttp3.send();
}
function getTipoTela(tipotela_id) {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("telaList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../controlador/getTipoTela.php?tipotela_id="+tipotela_id,true);
	xmlhttp3.send();
}
function getTalla(talla_id) {

	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("tallaList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../controlador/getTalla.php?talla_id="+talla_id,true);
	xmlhttp3.send();
}
function getPrecioColor(color_id) {

	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("precio").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../controlador/getPrecioColor.php?color_id="+color_id,true);
	xmlhttp3.send();
}
function getColor(color_id) {

	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("colo_r").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../controlador/getColor.php?color_id="+color_id,true);
	xmlhttp3.send();
}
