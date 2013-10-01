<?php

define("DBSERVER", 'localhost');
define("DBUSER", 'root');
define("DBPASS", 'root');
define("DBNAME", 'surco');

function retrieveAllQuestionsAndAnswers($dbserver, $dbuser, $dbpass, $dbname)
{
   $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
   // check connection
   if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    return array();
   }
   
   $data = array();
   $sql = "select pregunta.id, pregunta.pregunta, pregunta.nro, opcion.id as oid, opcion.texto, opcion.correcto from pregunta, opcion where opcion.pregunta_id = pregunta.id order by pregunta.nro asc";
   
   $sql_pregunta = "select id, pregunta, nro from pregunta order by nro";
   $rs_pregunta = $conn->query($sql);
   $rs_pregunta->data_seek(0);
   while($row = $rs_pregunta->fetch_assoc())
   {
       $obj = new stdClass();
       $obj->id = $row['id'];
       $obj->nro = $row['nro'];
       $obj->pregunta = htmlentities($row['pregunta']);
       $obj->opciones = array();
       $data[$obj->nro] = $obj;
       
   }
   //var_dump($data);
   foreach($data as $key => $obj)
   {
	$stmt = $conn->prepare("select id, texto, correcto from opcion where pregunta_id = ?");
	$stmt->bind_param("i", $key);
	$stmt->execute();
	/* Bind results to variables */
	$stmt->bind_result($opcionid, $opciontexto, $opcioncorrecto);

	/* fetch values */
	while ($stmt->fetch()) {
	    $opcion = new stdClass();
	    $opcion->id = $opcionid;
	    $opcion->texto = htmlentities($opciontexto);
	    $opcion->correcto = $opcioncorrecto;
	    $obj->opciones[] = $opcion;
	}
	
	$stmt->close();   
   }
   $conn->close();
   return $data;
}

function my_html_encode($var)
{
	return htmlentities($var) ;
}
