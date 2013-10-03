<?php
session_start();

if(((!isset($_SESSION['lastQuestionNumber']) && !isset($_SESSION['lastQuestionAnswers'])) || $_SESSION['lastQuestionAnswers'] != 15))
{
    //unset($_SESSION['lastQuestionNumber']);
    //unset($_SESSION['lastQuestionAnswers']);
    header("Location: index.html");
    die();
}
//var_dump($_SESSION);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Surco Formulario</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
    </head>
    <body>
        <div class="container">
			<div class="header">
				<div class="headerText">
					RELLENA EL FORMULARIO A CONTINUACI&Oacute;N
				</div>
			</div>
			<div class="clear"></div>
			<div class="mainBody">
				
				<div class="headerFadeContainer">
					<div class="headerFade headerFade1"></div>
					<div class="headerFade headerFade2"></div>
					<div class="headerFade headerFade3"></div>
				</div>
				
				<div class="lapiz_container">
				    <img src="images/lapiz.png" />
				</div>
				
				<div class="form_container">
					<div class="form_questions_container">
						<form class="real_form" id="data_form" method="POST" onsubmit="return sendData(this);" action="saveFormData.php">
							<div class="form_space_div"></div>
							<div class="input_name input_label">
								<label for="name">Nombre:</label>
								<input type="text" value="" id="name" name="name" />
							</div>
							<div class="clear"></div>
							<div class="input_lastname input_label">
								<label for="lastname">Apellido:</label>
								<input type="text" value="" id="lastname" name="lastname" />
							</div>
							<div class="clear"></div>
							<div class="input_ci input_label">
								<label for="ci">*C&eacute;dula de Identidad:</label>
								<input type="text" value="" id="ci" name="ci" size="8" />
							</div>
							<div class="clear"></div>
							<div class="input_age input_label">
							    <label for="age">Edad:</label>
							    <input type="text" value="" id="age" name="age" />
							</div>
							<div class="clear"></div>
							<div class="input_phone input_label">
							    <label for="phone">Tel&eacute;fono:</label>
							    <input type="text" value="" id="phone" name="phone" />
							</div>
							<div class="clear"></div>
							<div class="input_email input_label">
							    <label for="email">E-mail:</label>
							    <input type="text" value="" id="email" name="email" />
							</div>
							<div class="clear"></div>
							<div class="input_state input_label">
							    <label for="state">Departamento:</label>
							    <input type="text" value="" id="state" name="state" />
							</div>
							<div class="clear"></div>
							<div class="input_school input_label">
							    <label for="school">Escuela:</label>
							    <input type="text" value="" id="school" name="school" />
							</div>
							<div class="clear"></div>
							<div class="input_grade input_label">
							    <label for="grade">Grado:</label>
							    <input type="text" value="" id="grade" name="grade" />
							</div>
							<div class="clear"></div>
							<div class="input_transportation input_label">
							    <label for="transportation">&iquest;En qu&eacute; vas a la escuela?:</label>
							    <div class="clear"></div>
							    <input type="text" value="" id="transportation" name="transportation" />
							</div>
							<div class="clear"></div>
							
							<a id="link_enviar" class="link_enviar" href="javascript:void(0)" onclick="validateFormAndSend(this)">
							    <img src="images/enviar.png" alt="Enviar" />
							</a>
							<div class="clear"></div>
							<label class="input_ci_aclaration">
							    *C&eacute;dula de Identidad sin puntos ni guiones
							</label>
							<div id="messageBox" title="Por favor corrige estos errores."></div>
						</form>
						
					</div>
				</div>
			</div>
			
			<div class="clear"></div>
			
			<div class="footer">
				<img src="images/surco-logo-horizontal.png" alt="Surco Seguros" />
			</div>
        </div>
    <script type="text/javascript">
	   var validator = $("#data_form").validate({
		rules: {
			name: "required",
			lastname: "required",
			ci: {
				required: true,
				digits: true
			},
			age: {
				required: true,
				digits: true
			},
			phone: {
				required: true,
				digits: true
			},
			email: {
				required: true,
				email: true
			},
			state: {
				required: true
			},
			school: "required",
			grade: "required",
			transportation: "required"
		},
		messages: {
			name: "Ingresa tu nombre",
			lastname: "Ingresa tu apellido",
			ci: {
				required: "Ingresa tu cedula",
				digits: "Acuerdate que tu cedula tiene que ser sin puntos ni guiones"
			},
			age: {
				required: "Ingresa cuantos a&ntilde;os tienes",
				digits: "En tu edad solo pueden ser n&ucaute;meros"
			},
			phone: {
				required: "Ingresa tu tel&eacute;fono",
				digits: "Tu tel&eacute;fono solo pueden ser n&uacute;meros"
			},
			email: "Ingresa una direcci&oacute;n valida de e-mail",
			state: "Ingresa tu departamento",
			school: "Ingresa tu escuela",
			grade: "Ingresa el grado que estas",
			transportation: "Ingresa la forma de transporte que utilizas para ir a la escuela.",
		},
	     errorLabelContainer: "#messageBox",
	     wrapper: "li"
	    });
	
	function validateFormAndSend(element)
	{
	    if(!$(element).closest('form').valid())
	    {
		$("#messageBox").css({color:'Red'});  
		$( "#messageBox" ).dialog({
		  modal: true,
		  buttons: {
		    Cerrar: function() {
		      $( this ).dialog( "close" );
		    }
		  }
		});
		return false;
		console.info('no es valido');
	    }
	    else
	    {
		$.ajax({
		  url: $("#data_form").attr('action'),
		  data: $("#data_form").serialize(),
		  type: 'post',
		  dataType: 'json',
		    success: function(json){
			  if(json.result == 'ok')
			  {
			      alert('Gracias por llenar la encuesta');
			  }
			  setTimeout(function(){
			    window.location = "index.html";
			  }, 3000);
		    }
		    , 
		    complete: function()
		    {
			
		    }
		  }); 
	    }
	    return false;
	}
	
    </script>
    </body>
</html>
