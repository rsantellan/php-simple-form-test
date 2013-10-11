<?php

session_start();

error_reporting(E_ALL);

if(isset($_SESSION['lastQuestionNumber']))
{
    unset($_SESSION['lastQuestionNumber']);
    $answers = (isset($_SESSION['lastQuestionAnswers'])) ? $_SESSION['lastQuestionAnswers'] : 0 ;
    if($answers == 15)
    {
	header("Location: formulario.php");
    }
    else
    {
	header("Location: index.html");
    }
    
    die();
}

if(!isset($_SESSION['questionNumber']))
{
    $_SESSION['questionNumber'] = 1;
}
if(!isset($_SESSION['questionAnswers']))
{
    $_SESSION['questionAnswers'] = 0;
}
if($_SESSION['questionNumber'] == 1)
    $_SESSION['questionAnswers'] = 0;
    
// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');
 
// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

include_once 'defines/functions.php';
$dbserver = DBSERVER;
$dbuser = DBUSER;
$dbpass = DBPASS;
$dbname = DBNAME;



$questions = retrieveAllQuestionsAndAnswers($dbserver, $dbuser, $dbpass, $dbname);

header('Content-type: text/html; charset=UTF-8') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Surco preguntas</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="js/functions.js"></script>
	<link rel="shortcut icon" href="favicon.ico" >
	
	<![if !IE]>
	    <link rel="stylesheet" type="text/css" href="css/not-ie.css" />
	<![endif]>
    </head>
    
    <body>
        <div class="container">
	    <div class="header">
		<div class="headerQuestionText">
		    MARQUE LA/S OPCI&Oacute;N/ES CORRECTA/S. puede existir que una, varias o todas sean correctas o incorrectas
		</div>
	    </div>
	    
		<div class="clear"></div>
		
		<form id="question_form" action="sendForm.php" onsubmit="return false;" method="POST" class="question_container">
		    <div class="question"><label id="questionText">1) ?Existe para todo el uruguay una ley de transito vial?</label></div>
			<div class="answer answer1">
				<div class="answerNumber answerNumber1">
					<img src="images/answer1.png" alt="1" />
				</div>
				<div class="answerText">
				    <label id="answerText1">Si.</label>
				</div>
				<div class="answerCheck">
				    <div class="insideAnswerCheck">
					 <input type='checkbox' name='q1' value='1' id="q1"/>
					 <label for="q1"></label>
				    </div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="answer answer2">
				<div class="answerNumber answerNumber1">
					<img src="images/answer2.png" alt="1" />
				</div>
				<div class="answerText">
				    <label id="answerText2">Dos de ellas son la 18113 y la 18191.</label>
				</div>
				<div class="answerCheck">
					<div class="insideAnswerCheck">
					 <input type='checkbox' name='q2' value='2' id="q2"/>
					 <label for="q2"></label>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="answer answer3">
				<div class="answerNumber answerNumber1">
					<img src="images/answer3.png" alt="1" />
				</div>
				<div class="answerText">
				    <label id="answerText3">Otra es la ley 19061.</label>
				</div>
				<div class="answerCheck">
					<div class="insideAnswerCheck">
					 <input type='checkbox' name='q3' value='3' id="q3"/>
					 <label for="q3"></label>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="answer answer4">
				<div class="answerNumber answerNumber1">
					<img src="images/answer4.png" alt="1" />
				</div>
				<div class="answerText">
				    <label id="answerText4">No existe ninguna ley  de transito.</label>
				</div>
				<div class="answerCheck">
					<div class="insideAnswerCheck">
					 <input type='checkbox' name='q4' value='4' id="q4"/>
					 <label for="q4"></label>
					</div>
				</div>
			</div>
			<input type="hidden" value="1" id="questionNumber" name="questionNumber" />
		</form>
	    <div class="mainQuestionBody">
			<div class="corregirContainer">
				<a id="corregir_link" href="javascript:void(0)" class="corregir-link" onclick="checkSendAndSaveQuestion()">
					<img src="images/corregir.png" alt="Corregir" />
				</a>
			</div>
			<div class="semaforoContainer">
				<div class="semaforoInnerContainer">
					<img id="semaforo" src="images/semaforo.png" alt="semaforo" />
				</div>
			</div>
			
			<div id="finalScore" class="finalTextContainer finalTextResult">
			    <a href="javascript:void(0)">
				<img id="img_puntaje" src="images/puntaje1_15.png" />
			    </a>
			</div>
			<div class="clear"></div>
			<div id="messageGoingOn" class="messageTextContainer">
			    <img id="messageGoingOnImage" src="images/continua.png" />
			</div>
			<div class="clear"></div>
			<div id="finalScoreAllGood" class="finalTextContainer finalOkTextContainer">
			    <a href="formulario.php">
				<img src="images/felicitaciones.png" />
			    </a>
			</div>
			<div id="finalScoreNotGood" class="finalTextErrorContainer finalErrorTextContainer">
			    <img src="images/texto_perdedor.png" />
			    <div class="clear"></div>
			    <a href="http://www.unasev.gub.uy/inicio/normativa/leyes" target="_blank"><img src="images/ingresando_aqui.png" /></a>
			</div>
			<div class="clear"></div>
			<div id="moveToNext" class="moveToNextContainer">
			    <a href="javascript:void(0)" onclick="nextQuestion()">
				<img id="img_puntaje" src="images/boton_siguiente.png" />
			    </a>
			</div>
	    </div>
	    <div class="footer">
		<img src="images/logo_pie_preguntas.png" alt="Surco Seguros" />
	    </div>
        </div>
	
	<script type="text/javascript">
	    var questionNumber = 1;<?php //echo $_SESSION['questionNumber'];?>;
	    var goodAnswers = 0;<?php //echo $_SESSION['questionAnswers'];?>;
	    var questionList = <?php echo json_encode($questions);?>;
	    //console.info(questionNumber);
	    //console.info(goodAnswers);
	    showQuestion(questionNumber);
	    //console.info(questionList);
	</script>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44792852-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    </body>
</html>
