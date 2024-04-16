//----------------------Validación Campo E-mail------------------------------------
function comprobar_email(email){ 
		var mailres = true;             
		var cadena = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890@._-"; 
		 
		var arroba = email.indexOf("@",0); 
		if ((email.lastIndexOf("@")) != arroba){ 
			arroba = -1; 
			var punto = email.lastIndexOf("."); 	 
			 for (var contador = 0 ; contador < email.length ; contador++){ 
				if (cadena.indexOf(email.substr(contador, 1),0) == -1){ 
					mailres = false; 
					break; 
			 	} 
			} 
	
		if ((arroba > 1) && (arroba + 1 < punto) && (punto + 1 < (email.length)) && (mailres == true) && (email.indexOf("..",0) == -1)) {
		 	mailres = true; 
		}else{ 
		 	mailres = false; 
			//cont++
		}
					 
		return mailres; 
	} 
		
} 

//------------------Validación Crear Usuario---------------------------------------------
function valadmin(accion){
	var cont = 0;
	var errores = '';
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==" "){
		errores +='Debe seleccionar el tipo de identificación\n';
		cont++
	}
	
	if(document.form1.documento.value==''){
		errores +='Debe ingresar el número de identificación\n';
		cont++
	}
	if(document.getElementById("tipo_usuario").options[document.getElementById("tipo_usuario").selectedIndex].value==" "){
		errores +='Debe seleccionar el tipo de usuario\n';
		cont++
	}
	if(document.form1.nombres.value==''){
		errores +='Debe ingresar el nombre\n';
		cont++
	}
	if(document.form1.apellidos.value==''){
		errores +='Debe ingresar los apellidos\n';
		cont++
	}
	
	if(document.form1.telefono.value==''){
		errores +='Debe ingresar un telefono\n';
		cont++
	}
	if(document.form1.email.value==''){
		errores +='Debe ingresar el email\n';
		cont++
	}
	
	if(document.form1.pass.value==''){
		errores +='Debe ingresar el password\n';
		cont++
	}
	if(document.form1.veri_pass.value==''){
		errores +='Debe ingresar la validación del password\n';
		cont++
	}
	
	if(document.form1.pass.value==''){
		errores +='Debe digitar la contraseña\n';
		cont++
	}
	if(document.form1.veri_pass.value==''){
		errores +='Debe digitar la verificación de la contraseña\n';
		cont++
	}
	if(document.form1.pass.value!=document.form1.veri_pass.value){
		errores +='Las contraseñas no coinciden, por favor digetelas de nuevo\n';
		document.form1.pass.value='';
		document.form1.veri_pass.value='';
		document.form1.pass.focus();
		cont++
		
	}
	
	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

//------------------Validación Crear Vendedor---------------------------------------------
function valvendedor(accion){
	var cont = 0;
	var errores = '';
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==" "){
		errores +='Debe seleccionar el tipo de identificación\n';
		cont++
	}
	
	if(document.form1.documento.value==''){
		errores +='Debe ingresar el numero de identificacion\n';
		cont++
	}
	if(document.form1.nombres.value==''){
		errores +='Debe ingresar el nombre\n';
		cont++
	}
	if(document.form1.apellidos.value==''){
		errores +='Debe ingresar los apellidos\n';
		cont++
	}
	
	if(document.form1.celular.value==''){
		errores +='Debe ingresar un numero de celular\n';
		cont++
	}
	
	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

//--------------------Validación Buscar Usuario---------------------------------
function eviar_form_usuarios(tarea,id){
	document.form1.tarea.value = tarea
	document.form1.id.value = id
	document.form1.submit()
}

//--------------------Validación Editar Usuario---------------------------------
function tarea_editar_usuario(tarea){
	if(tarea=='guardar'){
				var cont = 0;
				var errores = '';
				if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==" "){
					errores +='Debe seleccionar el tipo de identificación\n';
					cont++
				}
				if(document.form1.documento.value==''){
					errores +='Debe digitar el número de identificación\n';
					cont++
				}
				if(document.form1.nombres.value==''){
					errores +='Debe digitar el nombre\n';
					cont++
				}
				if(document.form1.apellidos.value==''){
					errores +='Debe digitar los apellidos\n';
					cont++
				}
				
				if(document.form1.telefono.value==''){
					errores +='Debe ingresar el telefono\n';
					cont++
				}
				
				if(document.form1.email.value==''){
					errores +='Debe digitar el email\n';
					cont++
				}
				
				if(document.getElementById("tipo_usuario").options[document.getElementById("tipo_usuario").selectedIndex].value==""){
					errores +='Debe seleccionar un tipo de usuario\n';
					cont++
				}			
				
				
				if(!errores==""){
					alert(errores)
					
				}
				
				//el formulario se envia 
				if(cont == 0){ 
					document.form1.tarea.value=tarea;
					document.form1.submit(); 
				}	
		
	}
	
	if(tarea=='activar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='desactivar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='salir'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
}

//--------------------Validación Cambio de contraseña Usuario------------------------
function validar_pass_usuario(valor){
		cont = 0;
		errores = ''; 
		if(document.form1.pass_ant.value==''){
			errores +='Debe digitar la contraseña anterior\n';
			cont++
		}
		if(document.form1.nuevo_pass.value==''){
			errores +='Debe digitar la contraseña nueva\n';
			cont++
		}
		if(document.form1.ver_pass.value==''){
			errores +='Debe digitar la verificación de la contraseña nueva\n';
			cont++
		}
		if(document.form1.nuevo_pass.value!=document.form1.ver_pass.value){
			errores +='Las contraseñas nuevas no coinciden\n';
			document.form1.nuevo_pass.value='';
			document.form1.ver_pass.value='';
			document.form1.nuevo_pass.focus();
			cont++
		}
		if(document.form1.pass_ant.value==document.form1.nuevo_pass.value){
			errores +='La contraseña nueva debe ser diferente a la contraseña anterior\n';
			document.form1.nuevo_pass.value='';
			document.form1.ver_pass.value='';
			document.form1.nuevo_pass.focus();
			cont++
		}	
				
		if(!errores==""){
			alert(errores)
		}
				
		if(cont == 0){
			document.form1.tarea.value=valor;
			document.form1.submit(); 
		}	

}


//--------------------Validación Cambio de contraseña Administrador------------------------
function validar_pass_admin(valor){
		cont = 0;
		errores = ''; 

		if(document.form1.nuevo_pass.value==''){
			errores +='Debe digitar la contraseña nueva\n';
			cont++
		}
		if(document.form1.ver_pass.value==''){
			errores +='Debe digitar la verificación de la contraseña nueva\n';
			cont++
		}
		if(document.form1.nuevo_pass.value!=document.form1.ver_pass.value){
			errores +='Las contraseñas nuevas no coinciden\n';
			document.form1.nuevo_pass.value='';
			document.form1.ver_pass.value='';
			document.form1.nuevo_pass.focus();
			cont++
		}

				
		if(!errores==""){
			alert(errores)
		}
				
		if(cont == 0){
			document.form1.tarea.value=valor;
			document.form1.submit(); 
		}	

}

//------------------Validación Crear Cliente---------------------------------------------
function valcliente(accion, val){
	var cont = 0;
	var errores = '';
	if(accion == 'guardar'){
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==""){
				errores +='Debe seleccionar el tipo de identificación\n';
				cont++
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="31"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="21"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="12"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="11"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="41"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="42"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.documento.value==''){
				errores +='Debe ingresar el número de identificación\n';
				cont++
			}
						
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			
			if(document.getElementById("regimen").options[document.getElementById("regimen").selectedIndex].value==""){
				errores +='Debe seleccionar la Clase de Régimen\n';
				cont++
			}
			
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}
			if(val=='2'){
				errores +='Debe ingresar minimo un contacto\n';
				cont++
			}
			if(document.getElementById("fuente").options[document.getElementById("fuente").selectedIndex].value==""){
				errores +='Debe seleccionar la retención de fuente\n';
				cont++
			}
			if(document.getElementById("gran_contribuyente").options[document.getElementById("gran_contribuyente").selectedIndex].value==""){
				errores +='Debe seleccionar si es gran contribuyente\n';
				cont++
			}
			
	}
	
	if(accion == 'contactos'){
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==""){
				errores +='Debe seleccionar el tipo de identificación\n';
				cont++
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="31"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="21"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="12"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="11"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="41"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="42"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.documento.value==''){
				errores +='Debe ingresar el número de identificación\n';
				cont++
			}
						
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			
			if(document.getElementById("regimen").options[document.getElementById("regimen").selectedIndex].value==""){
				errores +='Debe seleccionar la Clase de Régimen\n';
				cont++
			}
			
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}

			if(document.getElementById("fuente").options[document.getElementById("fuente").selectedIndex].value==""){
				errores +='Debe seleccionar la retención de fuente\n';
				cont++
			}
			if(document.getElementById("gran_contribuyente").options[document.getElementById("gran_contribuyente").selectedIndex].value==""){
				errores +='Debe seleccionar si es gran contribuyente\n';
				cont++
			}
	}
	
	if(accion == 'contactosed'){
			if(document.form1.tipoDoc.value=="31"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="21"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="12"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="11"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="41"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="42"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			
			if(document.getElementById("regimen").options[document.getElementById("regimen").selectedIndex].value==""){
				errores +='Debe seleccionar la Clase de Régimen\n';
				cont++
			}
			
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}

			if(document.getElementById("fuente").options[document.getElementById("fuente").selectedIndex].value==""){
				errores +='Debe seleccionar la retención de fuente\n';
				cont++
			}
			if(document.getElementById("gran_contribuyente").options[document.getElementById("gran_contribuyente").selectedIndex].value==""){
				errores +='Debe seleccionar si es gran contribuyente\n';
				cont++
			}
	}
	
	if(accion == 'salir'){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
	
	if(!errores==""){
		alert(errores);
	}
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

//--------------------Validación Buscar Cliente---------------------------------
function enviar_form_clientes(tarea,id){
	document.form1.tarea.value = tarea
	document.form1.id.value = id
	document.form1.submit()
}

//--------------------Validación Editar Cliente---------------------------------
function tarea_editar_cliente(tarea){
	if(tarea=='guardar'){
		var cont = 0;
		var errores = '';
		
			if(document.form1.tipoDoc.value=="31"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="21"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="12"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="11"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="41"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="42"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			
			if(document.getElementById("regimen").options[document.getElementById("regimen").selectedIndex].value==""){
				errores +='Debe seleccionar la Clase de Régimen\n';
				cont++
			}
			
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}

			if(document.getElementById("fuente").options[document.getElementById("fuente").selectedIndex].value==""){
				errores +='Debe seleccionar la retención de fuente\n';
				cont++
			}
			if(document.getElementById("gran_contribuyente").options[document.getElementById("gran_contribuyente").selectedIndex].value==""){
				errores +='Debe seleccionar si es gran contribuyente\n';
				cont++
			}		
	
				if(!errores==""){
					alert(errores)
					
				}
				
				//el formulario se envia 
				if(cont == 0){ 
					document.form1.tarea.value=tarea;
					document.form1.submit(); 
				}	
		
	}
	
	if(tarea=='activar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='desactivar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}

}

//-----------------Activar desactivar campos en clientes---------------------
function valcamposcliente(){
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="31"){
		document.form1.nombre2.value='';
		document.form1.apellido1.value='';
		document.form1.apellido2.value='';
		document.form1.nombre2.disabled=true;
		document.form1.apellido1.disabled=true;
		document.form1.apellido2.disabled=true;
		div = document.getElementById('primernom');
		div.style.display ='none';
		div2 = document.getElementById('razonso');
		div2.style.display ='';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="13"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
		
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="12"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="22"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="21"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="11"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="41"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="43"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	}
}
function valcampoclie(){
	if(document.getElementById("regimen").options[document.getElementById("regimen").selectedIndex].value=="SIMPLIFICADO"){
		document.form1.fuente.selectedIndex=2;
		document.form1.fuente.readonly=true;
		document.form1.gran_contribuyente.selectedIndex=2;
		document.form1.gran_contribuyente.readonly=true;
		document.form1.ret_ica.selectedIndex=2;
		document.form1.ret_ica.readonly=true;
	}
	else{
		document.form1.fuente.readonly=false;
		document.form1.gran_contribuyente.readonly=false;
		document.form1.ret_ica.readonly=false;
	}
}
function valcamposclientedit(){
	if(document.form1.tipo_doc.value=="NIT "){
		div = document.getElementById('razonso');
		div.style.display ='';
		div2 = document.getElementById('primernom');
		div2.style.display ='none';
	}
}

//----------------------------------------------------Función Crear Contactos proveedor--------------------------------------
function valcampopro(){
	if(document.getElementById("clase_regimen").options[document.getElementById("clase_regimen").selectedIndex].value=="SIMPLIFICADO"){
		document.form1.retenedor.selectedIndex=2;
		document.form1.retenedor.readonly=true;
		document.form1.iva.selectedIndex=2;
		document.form1.iva.readonly=true;
	}
	else{
		document.form1.retenedor.readonly=false;
		document.form1.iva.readonly=false;
	}
}
function valcontactos(tarea){
	var cont = 0;
	var errores = '';
	if(document.form1.nombre.value==''){
		errores +='Debe ingresar el nombre\n';
		cont++
	}
	if(document.form1.cargo.value==''){
		errores +='Debe ingresar el cargo\n';
		cont++
	}
	if(document.form1.telefono.value==''){
		errores +='Debe ingresar el telefono\n';
		cont++
	}
	if(document.form1.email.value==''){
		errores +='Debe ingresar el email\n';
		cont++
	}
	
	if(!errores==""){
		alert(errores)
	}
				
				//el formulario se envia 
	if(cont == 0){ 
		document.form1.tarea.value=tarea;
		document.form1.submit(); 
	}	
				
}

//----------------------------------------------------Función Editar Contactos Clientes--------------------------------------
function valeditcontactos(tarea){
	if(tarea == 'guardar'){
		var cont = 0;
		var errores = '';

		if(document.form1.nombre.value==''){
			cont++
		}
		if(document.form1.cargo.value==''){
			cont++
		}
		if(document.form1.telefono.value==''){
			cont++
		}
		if(document.form1.email.value==''){
			cont++
		}
		
		if(cont != 0){
			alert('Debe seleccionar o digitar un Contacto')
		} 
		if(cont == 0){ 
			document.form1.tarea.value=tarea;
			document.form1.submit(); 
		}	
	}
	if(tarea == 'activar' || tarea == 'desactivar' ){
		document.form1.tarea.value=tarea;
		document.form1.submit(); 
	} 
}

//----------------------------------------------------Función Editar Contactos Clientes--------------------------------------
function valeditcontactosbodega(tarea){
	if(tarea == 'guardar'){
		var cont = 0;
		var errores = '';
		if(document.form1.nombre.value==''){
			cont++
		}
		if(document.form1.telefono.value==''){
			cont++
		}
		if(document.form1.email.value==''){
			cont++
		}

		if(cont != 0){
			alert('Debe seleccionar o digitar un Contacto')
		} 
		if(cont == 0){ 
			document.form1.tarea.value=tarea;
			document.form1.submit(); 
		}	
	}
	if(tarea == 'activar' || tarea == 'desactivar' ){
		document.form1.tarea.value=tarea;
		document.form1.submit(); 
	} 
}
//--------------------Validación Boton Editar Contacto Cliente---------------------------------
function enviar_form_edit_contactos(tarea,id){
	document.form1.funcion.value='1';
	document.form1.tarea.value = tarea;
	document.form1.id.value = id;
	document.form1.submit()
}



//------------------Validación Crear Obra---------------------------------------------
function valobra(accion, val){
	var cont = 0;
	var errores = '';
	if(accion == 'guardar'){
			if(document.form1.nombre.value==''){
				errores +='Debe ingresar el nombre de la obra\n';
				cont++
			}
		
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la dirección de la obra\n';
				cont++
			}
			
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			if(document.form1.tarifa_transporte.value==''){
				errores +='Debe ingresar el valor del transporte\n';
				cont++
			}
			
			if(val=='2'){
				errores +='Debe ingresar minimo un contacto\n';
				cont++	
			}
	}
	
	if(accion == 'contactos'){
			if(document.form1.nombre.value==''){
				errores +='Debe ingresar el nombre de la obra\n';
				cont++
			}
		
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la dirección de la obra\n';
				cont++
			}
			
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			if(document.form1.tarifa_transporte.value==''){
				errores +='Debe ingresar el valor del transporte\n';
				cont++
			}
	}
	
	
	if(accion == 'salir'){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
	
	if(!errores==""){
		alert(errores);
	}
	
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

//-------------------------------------------Validar Cambio Id Cliente-----------------------------

function valIdCliente(accion){
	if(document.form1.documento.value==''){
			alert('Debe digitar el nuevo documento')
			return;
		}
		if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==""){
				alert('Debe seleccionar el tipo de identificación');
				return;
		}
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}
function valIdClienteRegrtesar(accion){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}
//---------------------------------------------Validar General-------------------------------
function valgeneral(accion){
		document.form1.tarea.value=accion;
    	document.form1.submit();
		
	}


//---------------------------------------------Validar campo criterio busqueda-------------------------------
function valcampobusquedaObra(valor){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="1"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="2"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre_cliente"){
		document.form1.palabra.disabled=false;
	}
	
}
	
function valcampobusquedaCliente(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="1"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="2"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre1"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="documento"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="apellido1"){
		document.form1.palabra.disabled=false;
	}
	
}


function valcampobusquedaClienteEditar(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre1"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="documento"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="apellido1"){
		document.form1.palabra.disabled=false;
	}
	
}


function valcampobusquedaUsuario(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="documento_identidad"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombres"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="apellidos"){
		document.form1.palabra.disabled=false;
	}
	
}
function valcampobusquedaPlaca(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="placa"){
		document.form1.palabra.disabled=false;
	}
}
function valcampobusquedaCupo(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	else{
		document.form1.palabra.disabled=false;
	}
}
function valcampobusquedavalorTransporte(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	else{
		document.form1.palabra.disabled=false;
	}
}
function valcampobusquedaGrupo(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	else{
		document.form1.palabra.disabled=false;
	}
}
function valcheckequipo(){
	if(document.form1.electromecanico.checked==true){
		document.form1.cantidad.value='1';
		document.form1.cantidad.blur();
		document.form1.electromecanic.value='1';
	}
	if(document.form1.electromecanico.checked==false){
		document.form1.cantidad.value='';
		document.form1.electromecanic.value='0';
	}
}
function valcheckoperador(){
	if(document.form1.si_op.checked==true){
		document.form1.si_operador.value='1';
	}
	if(document.form1.si_op.checked==false){
		document.form1.si_operador.value='';
	}
	if(document.form1.no_op.checked==true){
		document.form1.no_operador.value='1';
	}
	if(document.form1.no_op.checked==false){
		document.form1.no_operador.value='';
	}
}
function verremision(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	else{
		document.form1.palabra.disabled=false;
	}
}
/*function valselectequipo(num){
		//valor2=document.form1.idfami.value;
		//valor3=document.form1.idclas.value;
		//alert(document.form1.idgrup.value);
		var selObj=document.getElementById('id_grupo')
		var selIndex = selObj.selectedIndex;
		//alert(selObj.options[selIndex].value);
	if(num == '1'){
		valor1=selObj.options[selIndex].value;
		valor2=document.form1.idfami.value;
		valor3=document.form1.idclas.value;
		document.form1.referencia.value= valor1 + valor2 + valor3 + document.form1.id_equipo.value;
	}
	if(num == '2'){
		valor2=valor;
		//valor1=document.form1.idgrup.value;
	    //valor3=document.form1.idclas.value;
		document.form1.referencia.value= valor1 + valor2 + valor3 + document.form1.id_equipo.value;
	}
	if(num == '3'){
		valor3=valor;
		//valor1=document.form1.idgrup.value;
	    //valor2=document.form1.idfami.value;
		document.form1.referencia.value= valor1 + valor2 + valor3 + document.form1.id_equipo.value;
	}
}*/

function valselectequipo(){
	var selObj=document.getElementById('id_grupo')
	var selIndex = selObj.selectedIndex;
		
	var selObj1=document.getElementById('id_familia')
	var selIndex1 = selObj1.selectedIndex;
		
	var selObj2=document.getElementById('id_clase')
	var selIndex2 = selObj2.selectedIndex;
		
	document.form1.referencia.value= selObj.options[selIndex].value + selObj1.options[selIndex1].value + selObj2.options[selIndex2].value + document.form1.id_equipo.value;
}

function valequipo(accion){
	var cont = 0;
	var errores = '';
	if(accion=='guardar'){
		if(document.form1.nombre.value==''){
			errores +='Debe ingresar el nombre del equipo\n';
			cont++
		}
		if(document.getElementById("id_grupo").options[document.getElementById("id_grupo").selectedIndex].value==""){
			errores +='Debe seleccionar el grupo\n';
			cont++
		}
		if(document.getElementById("id_familia").options[document.getElementById("id_familia").selectedIndex].value==""){
			errores +='Debe seleccionar la familia\n';
			cont++
		}
		if(document.getElementById("id_bodega").options[document.getElementById("id_bodega").selectedIndex].value==""){
			errores +='Debe seleccionar la bodega\n';
			cont++
		}
		if(document.getElementById("id_clase").options[document.getElementById("id_clase").selectedIndex].value==""){
			errores +='Debe seleccionar la clase\n';
			cont++
		}
		if(document.form1.fec_compra.value==''){
			errores +='Debe ingresar la fecha de compra\n';
			cont++
		}
		if(document.form1.nom_proveedor.value==''){
			errores +='Debe seleccionar el proveedor\n';
			cont++
		}

		if(document.form1.cantidad.value==''){
			errores +='Debe ingresar la cantidad\n';
			cont++
		}
		if(document.form1.si_op.checked==false && document.form1.no_op.checked==false){
			errores +='Debe seleccionar si tiene o no operador\n';
			cont++
		}

		/*if(document.form1.archivos.value==''){
			errores +='Debe seleccionar un archivo\n';
			cont++
		}*/
	}
	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}	
	
}
function valequiposel(accion){
	document.form2.tarea.value=accion;
	document.form2.submit();
	
}

function seleccionar(referencia, nombre, tarea, id){
   	opener.document.form1.ref_equipo_sel.value = referencia;
	opener.document.form1.nom_equipo_sel.value = nombre;
	document.form2.tarea.value = tarea
	document.form2.id.value = id
	document.form2.submit() 
}

function seleccionarPro(nombre, documento, tarea, id){
   	opener.document.form1.nom_proveedor.value = nombre;
	opener.document.form1.doc_proveedor.value = documento;
	document.form2.tarea.value = tarea
	document.form2.id.value = id
	document.form2.submit() 
}

function seleccionarCliente(tarea, id){
	document.form2.tarea.value = tarea;
	document.form2.id.value = id;
	document.form2.submit(); 
}

function seleccionarValorTransporte(tarea, id){
	document.form2.tarea.value = tarea;
	document.form2.id.value = id;
	document.form2.submit(); 
}

function seleccionarObra(tarea, id){
	document.form2.tarea.value = tarea;
	document.form2.id.value = id;
	document.form2.submit();
}
//------------------------Proveedores-------------------------------------------------------
//------------------Validación Crear Proveedor---------------------------------------------
function valproveedor(accion, val){
	var cont = 0;
	var errores = '';
	if(accion == 'guardar'){
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==""){
				errores +='Debe seleccionar el tipo de identificación\n';
				cont++
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="31"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombres\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			
			if(document.form1.documento.value==''){
				errores +='Debe ingresar el número de identificación\n';
				cont++
			}
	
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			if(document.form1.barrio.value==''){
				errores +='Debe ingresar el barrio\n';
				cont++
			}
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la direccion\n';
				cont++
			}		
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}
			if(val=='2'){
				errores +='Debe ingresar minimo un contacto\n';
				cont++
			}
			if(document.form1.clase_regimen.value==''){
	        	errores +='Debe seleccionar el regimen\n';
				cont++
			}
			if(document.form1.retenedor.value==''){
	    		errores +='Debe seleccionar la retención\n';
				cont++
			}
			if(document.form1.iva.value==''){
	    		errores +='Debe seleccionar el iva\n';
				cont++
			}
			
	}

	if(accion == 'contactos'){
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==""){
				errores +='Debe seleccionar el tipo de identificación\n';
				cont++
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="31"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombres\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			
			if(document.form1.documento.value==''){
				errores +='Debe ingresar el número de identificación\n';
				cont++
			}
	
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			if(document.form1.barrio.value==''){
				errores +='Debe ingresar el barrio\n';
				cont++
			}
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la direccion\n';
				cont++
			}		
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}
			if(document.form1.clase_regimen.value==''){
	        	errores +='Debe seleccionar el regimen\n';
				cont++
			}
			if(document.form1.retenedor.value==''){
	    		errores +='Debe seleccionar la retención\n';
				cont++
			}
			if(document.form1.iva.value==''){
	    		errores +='Debe seleccionar el iva\n';
				cont++
			}
	}
	if(accion == 'contactosed'){
		if(document.form1.tipoDoc.value=="31"){
			if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="21"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="12"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="11"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="41"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="42"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			if(document.form1.barrio.value==''){
				errores +='Debe ingresar el barrio\n';
				cont++
			}
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la dirección\n';
				cont++
			}
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}
			if(document.form1.clase_regimen.value==''){
	        	errores +='Debe seleccionar el regimen\n';
				cont++
			}
			if(document.form1.retenedor.value==''){
	    		errores +='Debe seleccionar la retención\n';
				cont++
			}
			if(document.form1.iva.value==''){
	    		errores +='Debe seleccionar el iva\n';
				cont++
			}
	}
	if(accion == 'salir'){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
	
	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}
//----------------------------------------------------Función Crear Contactos Proveedor--------------------------------------

function valcontactospro(tarea){
	var cont = 0;
	var errores = '';
	if(document.form1.nombre.value==''){
		errores +='Debe ingresar el nombre\n';
		cont++
	}
	if(document.form1.cargo.value==''){
		errores +='Debe ingresar el cargo\n';
		cont++
	}
	if(document.form1.telefono.value==''){
		errores +='Debe ingresar el telefono\n';
		cont++
	}
	if(document.form1.email.value==''){
		errores +='Debe ingresar el email\n';
		cont++
	}
	
	if(!errores==""){
		alert(errores)
	}
				
				//el formulario se envia 
	if(cont == 0){ 
		document.form1.tarea.value=tarea;
		document.form1.submit(); 
	}	
				
}
//--------------------Validación Buscar Proveedor---------------------------------
function enviar_form_proveedores(tarea,id){
	document.form1.tarea.value = tarea
	document.form1.id.value = id
	document.form1.submit()
}
//--------------------Validación Editar Proveedor---------------------------------
function tarea_editar_proveedor(tarea){
	if(tarea=='guardar'){
		var cont = 0;
		var errores = '';
		if(document.form1.tipoDoc.value=="31"){
			if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="13"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="22"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="21"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="12"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="11"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="41"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.tipoDoc.value=="42"){
				if(document.form1.nombre1.value==''){
					errores +='Debe ingresar un nombre\n';
					cont++
				}
				if(document.form1.apellido1.value==''){
					errores +='Debe ingresar un apellido\n';
					cont++
				}
			}
			if(document.form1.pais.value==''){
				errores +='Debe ingresar el pais\n';
				cont++
			}
			if(document.form1.departamento.value==''){
				errores +='Debe ingresar el departamento\n';
				cont++
			}
			if(document.form1.municipio.value==''){
				errores +='Debe ingresar el municipio\n';
				cont++
			}
			if(document.form1.barrio.value==''){
				errores +='Debe ingresar el barrio\n';
				cont++
			}
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la dirección\n';
				cont++
			}
			if(document.form1.telefono.value==''){
				errores +='Debe ingresar un telefono\n';
				cont++
			}			
				
				
				if(!errores==""){
					alert(errores)
					
				}
				
				//el formulario se envia 
				if(cont == 0){ 
					document.form1.tarea.value=tarea;
					document.form1.submit(); 
				}	
		
	}
	
	if(tarea=='activar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='desactivar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}

}
//-----------------Activar desactivar campos en proveedor---------------------
function valcamposproveedor(){
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="31"){
		document.form1.nombre2.value='';
		document.form1.apellido1.value='';
		document.form1.apellido2.value='';
		document.form1.nombre2.disabled=true;
		document.form1.apellido1.disabled=true;
		document.form1.apellido2.disabled=true;
		div = document.getElementById('primernom');
		div.style.display ='none';
		div2 = document.getElementById('razonso');
		div2.style.display ='';
		
		div = document.getElementById('primernom3');
		div.style.display ='none';
		div2 = document.getElementById('razonso3');
		div2.style.display ='';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="13"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
		
		div = document.getElementById('primernom3');
		div.style.display ='';
		div2 = document.getElementById('razonso3');
		div2.style.display ='none';
		
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="12"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
		
		div = document.getElementById('primernom3');
		div.style.display ='';
		div2 = document.getElementById('razonso3');
		div2.style.display ='none';
	
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="22"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
		
		div = document.getElementById('primernom3');
		div.style.display ='';
		div2 = document.getElementById('razonso3');
		div2.style.display ='none';
	
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="21"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
		
		div = document.getElementById('primernom3');
		div.style.display ='';
		div2 = document.getElementById('razonso3');
		div2.style.display ='none';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="11"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="41"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
		
		div = document.getElementById('primernom3');
		div.style.display ='';
		div2 = document.getElementById('razonso3');
		div2.style.display ='none';
	}
	if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value=="43"){
		document.form1.nombre2.disabled=false;
		document.form1.apellido1.disabled=false;
		document.form1.apellido2.disabled=false;
		div = document.getElementById('primernom');
		div.style.display ='';
		div2 = document.getElementById('razonso');
		div2.style.display ='none';
	}
}
function valcampobusquedaProveedor(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="1"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="2"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre1"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="documento"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="apellido1"){
		document.form1.palabra.disabled=false;
	}
	
}
function valcampobusquedaProveedorEditar(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre1"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="documento"){
		document.form1.palabra.disabled=false;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="apellido1"){
		document.form1.palabra.disabled=false;
	}
	
}
//-------------------------------------------Validar Cambio Id Proveedor-----------------------------

function valIdProveedor(accion){
	if(document.form1.tipo_doc.value==''){
			alert('Debe seleccionar el tipo de documento')
			return;
		}
	if(document.form1.documento.value==''){
			alert('Debe digitar el nuevo documento')
			return;
		}
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}
//--------------------Validación Boton Editar Contacto Proveedor---------------------------------
function enviar_form_edit_contactos_proveedor(tarea,id){
	document.form1.funcion.value='1';
	document.form1.tarea.value = tarea;
	document.form1.id.value = id;
	document.form1.submit()
}

//------------------solo para letras mayusculas y minusculas --------------------------------------------
function Letras(e){
var key;
if(window.event){// Internet Explorer
	key = e.keyCode;
}
else if(e.which){ // Netscape/Firefox/Opera
	key = e.which;
}

if ((key >= 97 && key <= 122)||(key >= 65 && key <= 90)||(key >= 209||key >= 241)||(key >= 180)||(key == 32)){
    return true;
}
else{
	return false; 
	}
}
//solo Numeros
function Numeros(e){
var key;
if(window.event){// Internet Explorer
	key = e.keyCode;
}
else if(e.which){ // Netscape/Firefox/Opera
	key = e.which;
}

if (key >= 48 && key <= 57){
    return true;
}
else{
	return false; 
	}
}
//-------------------validar email-------------------
function validarEmail(correo, nombre_del_elemento ){
	var s = correo.value;
	var filter=/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if (s.length == 0 ) return true;
    if (filter.test(s))
      return true;
    else
     alert("Entre una dirección de correo valida");
     correo.focus();
     return false;
}

//---------------------Bodega---------------------------
function valbodega(accion, val){
	var cont = 0;
	var errores = '';
	if(accion == 'guardar'){
			if(document.form1.nombre.value==''){
				errores +='Debe ingresar el nombre de la bodega\n';
				cont++
			}
			if(document.getElementById("tipo").options[document.getElementById("tipo").selectedIndex].value==" "){
					errores +='Debe seleccionar el tipo de Bodega\n';
					cont++
			}
				
			if(document.form1.direccion.value==''){
				errores +='Debe ingresar la dirección\n';
				cont++
			}
			
			if(val=='2'){
				errores +='Debe ingresar minimo un contacto\n';
				cont++
			}
			
	}

	
	if(accion == 'contactos'){
		if(document.form1.nombre.value==''){
			errores +='Debe ingresar el nombre de la bodega\n';;
			cont++
		}
		if(document.form1.direccion.value==''){
			errores +='Debe ingresar la dirección\n';
			cont++
		}
	}
	
	if(accion == 'salir'){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
	
	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}
//---------------------validación contactos bodega--------------------------------------------------------------

function valcontactosbodega(tarea){
	var cont = 0;
	var errores = '';
	if(document.form1.nombre.value==''){
		errores +='Debe ingresar el nombre\n';
		cont++
	}

	if(document.form1.telefono.value==''){
		errores +='Debe ingresar el telefono\n';
		cont++
	}
	if(document.form1.email.value==''){
		errores +='Debe ingresar el email\n';
		cont++
	}
	if(!errores==""){
		alert(errores)
	}
				
				//el formulario se envia 
	if(cont == 0){ 
		document.form1.tarea.value=tarea;
		document.form1.submit(); 
	}			
}
//-------------------------------------validación buscar bodega----------------------------------------------
function valcampobusquedabodega(){
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="1"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="2"){
		document.form1.palabra.disabled=true;
	}
	if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="nombre"){
		document.form1.palabra.disabled=false;
	}
}

//---------------------------------------------Validación Remision----------------------------------------------
function valcrearremision(tarea){
	if(tarea=='guardar'){
				var cont = 0;
				var errores = '';
				if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==" "){
					errores +='Debe seleccionar el tipo de identificación\n';
					cont++
				}
				if(document.form1.documento.value==''){
					errores +='Debe digitar el número de identificación\n';
					cont++
				}
				if(document.form1.nombres.value==''){
					errores +='Debe digitar el nombre\n';
					cont++
				}
				if(document.form1.apellidos.value==''){
					errores +='Debe digitar los apellidos\n';
					cont++
				}
				
				if(document.form1.telefono.value==''){
					errores +='Debe ingresar el telefono\n';
					cont++
				}
				
				if(document.form1.email.value==''){
					errores +='Debe digitar el email\n';
					cont++
				}
				
				if(document.getElementById("tipo_usuario").options[document.getElementById("tipo_usuario").selectedIndex].value==""){
					errores +='Debe seleccionar un tipo de usuario\n';
					cont++
				}			
				
				
				if(!errores==""){
					alert(errores)
					
				}
				
				//el formulario se envia 
				if(cont == 0){ 
					document.form1.tarea.value=tarea;
					document.form1.submit(); 
				}	
		
	}
	
	if(tarea=='activar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='desactivar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='salir'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
		if(tarea=='enc'){
			document.form1.tarea.value=tarea;
			document.form1.submit();
	}
}

//--------------------Validación Editar Bodega---------------------------------
function tarea_editar_bodega(tarea){
	if(tarea=='guardar'){
		var cont = 0;
		var errores = '';
		
	if(document.form1.nombre.value==''){
		errores +='Debe ingresar el nombre\n';
		cont++
	}

	if(document.form1.direccion.value==''){
		errores +='Debe ingresar la direccion\n';
		cont++
	}		
	
				if(!errores==""){
					alert(errores)
					
				}
				
				//el formulario se envia 
				if(cont == 0){ 
					document.form1.tarea.value=tarea;
					document.form1.submit(); 
				}	
	}
	
	if(tarea=='activar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='desactivar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
}
//--------------------Validación Boton Editar Contacto Bodega---------------------------------
function enviar_form_edit_contactos_bodega(tarea,id){
	document.form1.funcion.value='1';
	document.form1.tarea.value = tarea;
	document.form1.id.value = id;
	document.form1.submit()
}
//-------------------------------------------Validar Cambio nombre bodega-----------------------------

function valIdBodega(accion){
	if(document.form1.nombre.value==''){
			alert('Debe digitar el nuevo nombre')
			return;
		}
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}

//-------------------------------------------Validar Tranporte-----------------------------	
function valtrans(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'guardar'){
		if(document.form1.placa.value==''){
			errores +='Debe ingresar la placa del vehículo\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

//-------------------------------------------Validar Valor Tranporte-----------------------------	
function valvalortrans(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'guardar'){
		if(document.form1.ciudad.value==''){
			errores +='Debe ingresar la ciudad\n';
			cont++
		}
		if(document.form1.valor.value==''){
			errores +='Debe ingresar el valor\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

function cliente_val(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'validar'){
		if(document.form1.placa.value==''){
			errores +='Debe ingresar el documento\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}

//-------------------------------------------Validar Cupo-----------------------------	
function valcupo(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'guardar'){
		if(document.form1.valor.value==''){
			errores +='Debe ingresar el valor\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}
//-------------------------------------------Validar Grupo-----------------------------	
function valgrupo(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'guardar'){
		if(document.form1.descripcion.value==''){
			errores +='Debe ingresar la descripcion\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}	

//-------------------------------------------Validar Traslado-----------------------------	
function valtraslado(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'guardar'){
		if(document.getElementById("id_bodega").options[document.getElementById("id_bodega").selectedIndex].value==""){
			errores +='Debe Seleccionar una bodega\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}	

//-------------------------------------------Validar Bodega Subalquiler-----------------------------	
function valbodegaSub(accion){
	var cont = 0;
	var errores = '';

	if(accion == 'guardar'){
		if(document.form1.nombre.value==''){
			errores +='Debe ingresar el nombre del la Bodega Subalquiler\n';
			cont++
		}
	}

	if(!errores==""){
		alert(errores);
	}
	
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit(); 
	}	
	
}
//------------------Validación Crear Remisión---------------------------------------------
function valrem(accion,valor,valor1){
	var cont = 0;
	var errores = '';
	var bool=true;
	if(accion == 'guardar'){
		if(document.getElementById("id_contacto").options[document.getElementById("id_contacto").selectedIndex].value==''){
			errores +='Debe seleccionar el contacto\n';
			id_contacto.focus();
		    cont++
	    }
		
		if(document.form1.remisionmanual.value==''){
			errores +='Digitar el número de remisión\n';
			document.form1.remisionmanual.focus();
		    cont++
	    }
		for(d = 0; d <= valor; d++){
			if(document.getElementById("cantidad"+d)!=null){
				if (document.getElementById("cantidad"+d).value == ''){
					errores +='Debe ingresar la cantidad en '+document.getElementById("nomb_post"+d).value+'\n';
					document.getElementById("cantidad"+d).focus();
					cont++
					bool=false;
				}
			}
		}
		for(f = 0; f <= valor1; f++){
			if(document.getElementById("valorSub"+f)!=null){
				if (document.getElementById("valorSub"+f).value == ''){
					errores +='Debe ingresar el valor en '+document.getElementById("nomb_post_sub"+f).value+'\n';
					document.getElementById("valorSub"+f).focus();
					cont++
					bool=false;
				}
			}
		}
		for(g = 0; g <= valor1; g++){
			if(document.getElementById("descuentoSub"+g)!=null){
				if (document.getElementById("descuentoSub"+g).value == ''){
					errores +='Debe ingresar el valor de descuento en'+document.getElementById("nomb_post_sub"+g).value+'\n';
					document.getElementById("descuentoSub"+g).focus();
					cont++
					bool=false;
				}
			}
		}
		for(h = 0; h <= valor; h++){
			if(document.getElementById("descuento"+h)!=null){
				if (document.getElementById("descuento"+h).value == ''){
					errores +='Debe ingresar el valor de descuento en'+document.getElementById("nomb_post"+h).value+'\n';
					document.getElementById("descuento"+h).focus();
					cont++
					bool=false;
				}
			}
		}
		for(e = 0; e <= valor; e++){
			if(document.getElementById("cantidad"+e)!=null){
				var valor0=document.getElementById("cantidad"+e).value;
				var valor1=document.getElementById("valcantidad"+e).value;
				valor0=parseFloat(valor0);
				valor1=parseFloat(valor1);
				if (valor0 > valor1){
					errores +='Error al asignar la cantidad seleccionada, solo quedan '+document.getElementById("valcantidad"+e).value+' unidades disponibles de '+document.getElementById("nomb_post"+e).value+'\n';
					cont++
				}
			}
		}
		
		if(bool==true){
			//var sumatoria=0;
			//var total;
			/*var val1=0;
			var val2=0;
			var val3=0;
			var sum=0;
			var sum1=0;
			var total=0*/
			//for(t = 0; t <=valor; t++){
				//alert(document.getElementById("cantidad"+t).value);
				//alert(document.getElementById("valordia"+t).value);
				
				/*if(document.getElementById("cantidad"+t)!=null){
					val=document.getElementById("cantidad"+t).value;
					val1=document.getElementById("valordia"+t).value;
					sum=sum+(val1*val);
				}
				else{
					val2=document.getElementById("valcantidad1"+t).value;
					val3=document.getElementById("valordia"+t).value;
					sum1=sum1+(val2*val3)
				}*/
				//total=parseFloat(document.getElementById("valordia"+t).value);
				//val=val+cupo;
				//sumatoria=sumatoria+total;
				//var cupo=document.getElementById("cupo").value;
				//alert(sumatoria+'    '+cupo);
				//var total=parseFloat(sumatoria);
				/*if(777 > 99){
					errores +='El cliente '+document.getElementById("nom_cliente").value+' solo tiene un cupo disponible de  '+document.getElementById("cupo").value+', el total de equipos a remisionar es de ' +total+'\n';
					cont++
				}*/
				
			//}
			/*total=sum+sum1;
			var cupo=document.getElementById("cupo").value;
			cupo=parseFloat(cupo);
			total=parseFloat(total);
			if(2 > 1){
				errores +='El cliente '+document.getElementById("nom_cliente").value+' solo tiene un cupo disponible de  '+document.getElementById("cupo").value+', el total de equipos a remisionar es de ' +total+'\n';
				cont++
			}*/
			
			var cupo=document.getElementById("cupo").value;
			var valor=document.getElementById("valordia").value;
			cupo=parseFloat(cupo);
			valor=parseFloat(valor);
			if(valor > cupo){
				errores +='El cliente '+document.getElementById("nom_cliente").value+' solo tiene un cupo disponible de  '+document.getElementById("cupo").value+', el total de equipos a remisionar es de '+valor+'\n';
				cont++
			}
		}
		
		if(document.form1.valor.value==0 && document.form1.valor1.value==0){
			errores +='Debe seleccionar al menos un equipo\n';
		    cont++
	    }
	}

	if(!errores==""){
		alert(errores);
	}
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
}

//--------------------Validación Buscar Cliente---------------------------------
function enviar_form_editar_remision(tarea,id,id_remision){
	document.form1.tarea.value = tarea
	document.form1.id.value = id
	document.form1.id_remision.value = id_remision
	document.form1.submit()
}
//------------------Validación Crear Remisión---------------------------------------------
function valremeditar(accion,valor,valor1,valor2,valor3){
	var cont = 0;
	var errores = '';
	var bool=true;
	if(accion == 'guardar'){
		if(document.getElementById("id_contacto").options[document.getElementById("id_contacto").selectedIndex].value==''){
			errores +='Debe seleccionar el contacto\n';
			id_contacto.focus();
		    cont++
	    }
		
		if(document.form1.remisionmanual.value==''){
			errores +='Digitar el número de remisión\n';
			document.form1.remisionmanual.focus();
		    cont++
	    }
		for(d = 0; d <= valor; d++){
			if(document.getElementById("cantidad"+d)!=null){
				if (document.getElementById("cantidad"+d).value == ''){
					errores +='Debe ingresar la cantidad en '+document.getElementById("nomb_post"+d).value+'\n';
					document.getElementById("cantidad"+d).focus();
					cont++
					bool=false;
				}
			}
		}
		for(h = 0; h <= valor; h++){
			if(document.getElementById("descuento"+h)!=null){
				if (document.getElementById("descuento"+h).value == ''){
					errores +='Debe ingresar el valor de descuento en '+document.getElementById("nomb_post"+h).value+'\n';
					document.getElementById("descuento"+h).focus();
					cont++
					bool=false;
				}
			}
		}
		for(f = 0; f <= valor1; f++){
			if(document.getElementById("valorSub"+f)!=null){
				if (document.getElementById("valorSub"+f).value == ''){
					errores +='Debe ingresar el valor en '+document.getElementById("nomb_post_sub"+f).value+'\n';
					document.getElementById("valorSub"+f).focus();
					cont++
					bool=false;
				}
			}
		}
		for(g = 0; g <= valor1; g++){
			if(document.getElementById("descuentoSub"+g)!=null){
				if (document.getElementById("descuentoSub"+g).value == ''){
					errores +='Debe ingresar el valor de descuento en '+document.getElementById("nomb_post_sub"+g).value+'\n';
					document.getElementById("descuentoSub"+g).focus();
					cont++
					bool=false;
				}
			}
		}

		
		///////////////////////////
		if(valor2!=0){
			for(v = 0; v <= valor2; v++){
				if(document.getElementById("cantidad_ed"+v)!=null){
					if (document.getElementById("cantidad_ed"+v).value == ''){
						errores +='Debe ingresar la cantidad en '+document.getElementById("nomb_post_ed"+v).value+'\n';
						document.getElementById("cantidad_ed"+v).focus();
						cont++
						bool=false;
					}
				}
			}
		}
		if(valor2!=0){
			for(h = 0; h <= valor2; h++){
				if(document.getElementById("descuento_ed"+h)!=null){
					if (document.getElementById("descuento_ed"+h).value == ''){
						errores +='Debe ingresar el valor de descuento en '+document.getElementById("nomb_post_ed"+h).value+'\n';
						document.getElementById("descuento_ed"+h).focus();
						cont++
						bool=false;
					}
				}
			}
		}
		if(valor3!=0){
			for(f = 0; f <= valor3; f++){
				if(document.getElementById("valorSub_ed"+f)!=null){
					if (document.getElementById("valorSub_ed"+f).value == ''){
						errores +='Debe ingresar el valor en '+document.getElementById("nomb_post_sub_ed"+f).value+'\n';
						document.getElementById("valorSub_ed"+f).focus();
						cont++
						bool=false;
					}
				}
			}
		}
		if(valor3!=0){
			for(g = 0; g <= valor3; g++){
				if(document.getElementById("descuentoSub_ed"+g)!=null){
					if (document.getElementById("descuentoSub_ed"+g).value == ''){
						errores +='Debe ingresar el valor de descuento en '+document.getElementById("nomb_post_sub_ed"+g).value+'\n';
						document.getElementById("descuentoSub_ed"+g).focus();
						cont++
						bool=false;
					}
				}
			}
		}
		/////////////////////////////
		for(e = 0; e <= valor; e++){
			if(document.getElementById("cantidad"+e)!=null){
				var valor0=document.getElementById("cantidad"+e).value;
				var valor1=document.getElementById("valcantidad"+e).value;
				var valor2=document.getElementById("cantidad_ac"+e).value;
				var sum=0;
				valor0=parseFloat(valor0);
				valor1=parseFloat(valor1);
				valor2=parseFloat(valor2);
				sum=valor1+valor2;
				if (valor0 > valor1){
					errores +='Error al asignar la cantidad seleccionada, solo quedan '+sum+' unidades disponibles de '+document.getElementById("nomb_post"+e).value+'\n';
					cont++
				}
			}
		}
		if(valor2!=0){
			for(e = 0; e <= valor; e++){
				if(document.getElementById("cantidad_ed"+e)!=null){
					var valor0=document.getElementById("cantidad_ed"+e).value;
					var valor1=document.getElementById("valcantidad_ed"+e).value;
					valor0=parseFloat(valor0);
					valor1=parseFloat(valor1);
					if (valor0 > valor1){
						errores +='Error al asignar la cantidad seleccionada, solo quedan '+document.getElementById("valcantidad_ed"+e).value+' unidades disponibles de '+document.getElementById("nomb_post_ed"+e).value+'\n';
						cont++
					}
				}
			}
		}
		if(bool==true){
			var cupo=document.getElementById("cupo").value;
			var valor=document.getElementById("valordia").value;
			var valor1=document.getElementById("valordia_ed").value;
			var sum=0;
			cupo=parseFloat(cupo);
			valor=parseFloat(valor);
			valor1=parseFloat(valor1);
			sum=valor+valor1;
			if(sum > cupo){
				errores +='El cliente '+document.getElementById("nom_cliente").value+' solo tiene un cupo disponible de  '+document.getElementById("cupo").value+', el total de equipos a remisionar es de '+sum+'\n';
				cont++
			}
		}

		if((document.form1.valor.value==0 && document.form1.valor1.value==0)&&((document.form1.valor2.value==0 && document.form1.valor3.value==0))){
			errores +='Debe de haber almenos un equipo\n';
		    cont++
	    }
	}

	if(!errores==""){
		alert(errores);
	}
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
}
//--------------------Validación seleccionar equipo subalquilado---------------------------------
function valequipsub(tarea){
		var cont = 0;
		var errores = '';
		if(tarea == 'seleccionar'){
			if(document.getElementById("id_bodega").options[document.getElementById("id_bodega").selectedIndex].value==''){
				errores +='Debe seleccionar la bodega\n';
				id_bodega.focus();
		    	cont++
			}
			if(document.form1.cantidad.value==''){
				errores +='Debe ingresar la cantidad\n';
				cantidad.focus();
				cont++
			}
			if(document.form1.cantidad.value==0){
				errores +='Cantidad no valida\n';
				cantidad.focus();
				cont++
			}
		}

		if(!errores==""){
			alert(errores);
		}
		if(cont == 0){
			document.form1.tarea.value = tarea;
		    document.form1.submit()
		}
}

function calculoDV(){ 
 var vpri, x, y, z, i, nit1, dv1;
 nit1=document.form1.documento.value;
 vpri = new Array(15); 
 x=0 ; y=0 ; z=nit1.length;
 vpri[1]=3;
 vpri[2]=7;
 vpri[3]=13;
 vpri[4]=17;
 vpri[5]=19;
 vpri[6]=23;
 vpri[7]=29;
 vpri[8]=37;
 vpri[9]=41;
 vpri[10]=43;
 vpri[11]=47;  
 vpri[12]=53;
 vpri[13]=59;
 vpri[14]=67;
 vpri[15]=71;
 for(i=0 ; i<z ; i++){
	 y=(nit1.substr(i,1));
	 x+=(y*vpri[z-i]);		
 	}
	y=x%11
	if (y > 1){
		dv1=11-y;
 	} 
	else{
		dv1=y;
 	}
 	document.form1.dv.value=dv1;
}
//funcion para no ir atras con la tecla backspace en formulario
function showDown(evt)
{
evt = (evt) ? evt : ((event) ? event : null);
if (evt)
{
if (window.event.keyCode == 8 && (window.event.srcElement.type != "text" && window.event.srcElement.type != "textarea" &&            window.event.srcElement.type != "password"))
{
// When backspace is pressed but not in form element
//alert("When backspace is pressed");
cancelKey(evt);
}

}
}

function cancelKey(evt){
	if (evt.preventDefault){
		evt.preventDefault();
		return false;
}
else
{
evt.keyCode = 0;
evt.returnValue = false;
}
}
//---------------------------------------------Validación Devolución----------------------------------------------
function valcreardevolucion(tarea){
	/*if(tarea=='guardar'){
				var cont = 0;
				var errores = '';
				if(document.getElementById("tipo_doc").options[document.getElementById("tipo_doc").selectedIndex].value==" "){
					errores +='Debe seleccionar el tipo de identificación\n';
					cont++
				}
				if(document.form1.documento.value==''){
					errores +='Debe digitar el número de identificación\n';
					cont++
				}
				if(document.form1.nombres.value==''){
					errores +='Debe digitar el nombre\n';
					cont++
				}
				if(document.form1.apellidos.value==''){
					errores +='Debe digitar los apellidos\n';
					cont++
				}
				
				if(document.form1.telefono.value==''){
					errores +='Debe ingresar el telefono\n';
					cont++
				}
				
				if(document.form1.email.value==''){
					errores +='Debe digitar el email\n';
					cont++
				}
				
				if(document.getElementById("tipo_usuario").options[document.getElementById("tipo_usuario").selectedIndex].value==""){
					errores +='Debe seleccionar un tipo de usuario\n';
					cont++
				}			
				
				
				if(!errores==""){
					alert(errores)
					
				}
				
				//el formulario se envia 
				if(cont == 0){ 
					document.form1.tarea.value=tarea;
					document.form1.submit(); 
				}	
		
	}
	
	if(tarea=='activar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='desactivar'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
	if(tarea=='salir'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}*/
	if(tarea=='enc'){
		document.form1.tarea.value=tarea;
		document.form1.submit();
	}
}

function limpiar(){
	if ((document.form1.min_dias.value!='' || document.form1.valor_dia.value!='')||(document.form1.min_dias.value=='' || document.form1.valor_dia.value=='')){
		document.form1.min_horas.value='';
		document.form1.valor_hora.value='';
		document.form1.min_metros.value='';
		document.form1.valor_metro.value='';
	}
}
function limpiar1(){
		if((document.form1.min_horas.value!='' || document.form1.min_horas.value!='')||(document.form1.min_horas.value=='' || document.form1.min_horas.value=='')){
		document.form1.min_dias.value='';
		document.form1.valor_dia.value='';
		document.form1.min_metros.value='';
		document.form1.valor_metro.value='';
	}
}
function limpiar2(){
		if((document.form1.min_metros.value!='' || document.form1.valor_metro.value!='')||(document.form1.min_metros.value=='' || document.form1.valor_metro.value=='')){
		document.form1.min_horas.value='';
		document.form1.valor_hora.value='';
		document.form1.min_dias.value='';
		document.form1.valor_dia.value='';
	}
}

function CalcularPorcentaje(valorbase, contador){
	var resultado = 0;
	var valor = 0;
	valor1 = document.getElementById("valorfinal"+contador).value;
	resultado = 100-((valor1 * 100)/valorbase);
	document.getElementById("descuento"+contador).value = resultado;
	return;

}

function CalcularValorFinal(valorbase, contador){
	var resultado = 0;
	var valor = 0;
	valor1 = document.getElementById("descuento"+contador).value;
	resultado = valorbase-((valor1 * valorbase)/100);
	document.getElementById("valorfinal"+contador).value = resultado;
	return;

}

/*function mostarReparacionTexto(contador){
	if(document.getElementById("reparacion"+contador).checked!=true){
		document.getElementById("descripcion_rep"+contador).style.visibility='hidden' 
	}else{
		document.getElementById("descripcion_rep"+contador).style.visibility=''
	} 
}
function mostarReparacionTextoSub(contador){
	if(document.getElementById("reparacionSub"+contador).checked!=true){
		document.getElementById("descripcion_repSub"+contador).style.visibility='hidden' 
	}else{
		document.getElementById("descripcion_repSub"+contador).style.visibility=''
	} 
}
function ocultartexto(valor){
	for(i=0;i<valor;i++){
		document.getElementById("descripcion_rep"+i).style.visibility='hidden';
	}
	
} 
function ocultartexto1(valor){
	for(i=0;i<valor;i++){
		document.getElementById("descripcion_repSub"+i).style.visibility='hidden';
	}
	
}*/
/*function enviar(val1,val2){
	<?php 
	$_SESSION['id_equipos']=serialize($val1);
	
	
	
	?>
}*/
//------------------Validación Crear Remisión---------------------------------------------
function valreparacion(accion){
	var cont = 0;
	var errores = '';
	var bool=true;
	if(accion == 'guardar'){
		if(document.form1.cantidad.value==''){
			errores +='Digitar el número de cantidad a reparar\n';
			document.form1.cantidad.focus();
		    cont++
	    }
		if(document.getElementById("valcantidad")!=null){
			var valor0=document.getElementById("valcantidad").value;
			var valor1=document.getElementById("cantidad").value;
			valor0=parseFloat(valor0);
			valor1=parseFloat(valor1);
			if (valor1 > valor0){
				errores +='Error al asignar la cantidad seleccionada\n';
				cont++
			}
		}
	}

	if(!errores==""){
		alert(errores);
	}
    //el formulario se envia 
    if(cont == 0){
		document.form1.tarea.value=accion;
    	document.form1.submit();
	}
}