<?php

// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');
 
// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

$dbserver = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'surco';

function retrieveAllQuestionsAndAnswers($dbserver, $dbuser, $dbpass, $dbname)
{
   $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
   // check connection
   if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    return array();
   }
   $data = array();
   $sql = "select pregunta.id, pregunta.pregunta, pregunta.respuesta, pregunta.mensajeok, pregunta.mensajeerror, opcion.id as oid, opcion.texto from pregunta, opcion where opcion.pregunta_id = pregunta.id";
   $rs=$conn->query($sql);
   $rs->data_seek(0);
   
   while($row = $rs->fetch_assoc()){
     $obj = null;
     if(isset($data[$row['id']]))
     {
         $obj = $data[$row['id']];
     }
     else
     {
         $obj = new stdClass();
         $obj->id = $row['id'];
         $obj->pregunta = $row['pregunta'];
         $obj->respuesta = $row['respuesta'];
         $obj->mensajeok = $row['mensajeok'];
         $obj->mensajeerror = $row['mensajeerror'];
         $obj->opciones = array();
     }
     $opcion = new stdClass();
     $opcion->id = $row['oid'];
     $opcion->texto = $row['texto'];
     $obj->opciones[] = $opcion;
     $data[$obj->id] = $obj;
   }
   $conn->close();
   return $data;
}

function my_html_encode($var)
{
	return htmlentities($var) ;
	//return htmlentities($var, ENT_QUOTES | ENT_HTML401, 'UTF-8') ;
}

$questions = retrieveAllQuestionsAndAnswers($dbserver, $dbuser, $dbpass, $dbname);

header('Content-type: text/html; charset=UTF-8') ;
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>UTF-8 test page</title>
    </head>
    <body>
        <?php
        foreach($questions as $question):
        ?>
        <h4><?php echo my_html_encode($question->pregunta);?></h4>
            <ul>
            <?php foreach($question->opciones as $opcion): ?>
                <li><?php echo my_html_encode($opcion->id . " - ". $opcion->texto);?> <?php echo ($question->respuesta == $opcion->id)? "(Correcto)" : "";?></li>
            <?php endforeach; ?>
            </ul>
        <?php
        endforeach;
        ?>
    </body>
</html>

