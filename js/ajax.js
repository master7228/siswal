var isIE = false;
var req;

function cargaXML(url) {
	if(url==''){
		return;
	}
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true);
		req.send(null);
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange;
			req.open("GET", url, true);
			req.send();
		}
	}
}

function mostrarFecha(anno) {
	if(anno==''){
		return;
	}
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open("GET", "fecha.php?anno="+anno, true);
		req.send(null);
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange;
			req.open("GET", "fecha.php?anno="+anno, true);
			req.send();
		}
	}
}

function mostrarPaises() {
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open("GET", "paises.php", true);
		req.send(null);
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange;
			req.open("GET", "paises.php", true);
			req.send();
		}
	}
}

function mostrarDepartamentos(pais) {
	if(pais==''){
		pais='NA';
		//return;
	}
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange1;
		req.open("GET", "departamentos.php?pais="+pais, true);
		req.send(null);
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange1;
			req.open("GET", "departamentos.php?pais="+pais, true);
			req.send();
		}
	}
}

function mostrarMunicipios(depto) {
	if(depto==''){
		depto='NA';
		//return;
	}
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange2;
		req.open("GET", "municipios.php?depto="+depto, true);
		req.send(null);
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange2;
			req.open("GET", "municipios.php?depto="+depto, true);
			req.send();
		}
	}
}

function mostrarEdad(dia,mes,anno) {
	if(dia=='' && mes==''){
		return;
	}
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChangeEdad;
		req.open("GET", "fecha.php?dia="+dia+"&mes="+mes+"&anno="+anno, true);
		req.send(null);
	} else if (window.ActiveXObject) {
		isIE = true;
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChangeEdad;
			req.open("GET", "fecha.php?dia="+dia+"&mes="+mes+"&anno="+anno, true);
			req.send();
		}
	}
}

function processReqChange(){
	var detalles = document.getElementById("detalles");
	if(req.readyState == 4){
		detalles.innerHTML = req.responseText;
	} else {
		detalles.innerHTML = '<img src="loading.gif" align="middle" /> Loading...';
	}
}

function processReqChange1(){
	var detalles = document.getElementById("departamentos");
	if(req.readyState == 4){
		detalles.innerHTML = req.responseText;
	} else {
		detalles.innerHTML = '<img src="loading.gif" align="middle" /> Cargando...';
	}
}

function processReqChange2(){
	var detalles = document.getElementById("municipios");
	if(req.readyState == 4){
		detalles.innerHTML = req.responseText;
	} else {
		detalles.innerHTML = '<img src="loading.gif" align="middle" /> Cargando...';
	}
}
function processReqChangeEdad(){
	var detalles = document.getElementById("edad");
	if(req.readyState == 4){
		detalles.innerHTML = req.responseText;
	} else {
		detalles.innerHTML = '<img src="loading.gif" align="middle" /> Cargando...';
	}
}