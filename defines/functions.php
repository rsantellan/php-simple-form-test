<?php

define("DBSERVER", 'localhost');
define("DBUSER", 'root');
define("DBPASS", 'root');
define("DBNAME", 'surco');

function calculateNumberOfOkAnswers($data)
{
    $quantity = 0;
    foreach($data as $value)
    {
        if($value)
            $quantity ++;
    }
    return $quantity;
}

function retrieveTodayWinners($limit)
{
    $sql = "select ci, name, lastname, age, phone, email, state, school, grade, transportation from concursante concursante where DATE(updated_at) = DATE(now()) order by updated_at asc limit ?";
    $conn = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);
   // check connection
   if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    return array();
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    /* Bind results to variables */
    $stmt->bind_result($ci, $name, $lastname, $age, $phone, $email, $state, $school, $grade, $transportation);
    $list = array();
    /* fetch values */
    while ($stmt->fetch()) {
	$usuario = new stdClass();
	$usuario->ci = $ci;
	$usuario->name = $name;
	$usuario->lastname = $lastname;
	$usuario->age = $age;
	$usuario->phone = $phone;
	$usuario->email = $email;
	$usuario->state = $state;
	$usuario->school = $school;
	$usuario->grade = $grade;
	$usuario->transportation = $transportation;
	$list[] = $usuario;
    }
    
    $stmt->close(); 
    $conn->close();
    return $list; 
}

function returnRandomWinners($limit)
{
    $sql = "select ci, name, lastname, age, phone, email, state, school, grade, transportation from concursante concursante order by rand() limit ?";
    $conn = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);
   // check connection
   if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    return array();
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    /* Bind results to variables */
    $stmt->bind_result($ci, $name, $lastname, $age, $phone, $email, $state, $school, $grade, $transportation);
    $list = array();
    /* fetch values */
    while ($stmt->fetch()) {
	$usuario = new stdClass();
	$usuario->ci = $ci;
	$usuario->name = $name;
	$usuario->lastname = $lastname;
	$usuario->age = $age;
	$usuario->phone = $phone;
	$usuario->email = $email;
	$usuario->state = $state;
	$usuario->school = $school;
	$usuario->grade = $grade;
	$usuario->transportation = $transportation;
	$list[] = $usuario;
    }
    
    $stmt->close(); 
    $conn->close();
    return $list; 
}

function saveNewContenstant($ci, $name, $lastname, $age, $phone, $email, $state, $school, $grade, $transportation)
{
    $sql = "REPLACE INTO concursante (ci, name, lastname, age, phone, email, state, school, grade, transportation, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $conn = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);
   // check connection
   if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    return array();
   }
   
   $stmt = $conn->prepare($sql);
   //var_dump($conn->error);
   //var_dump($stmt);
   $stmt->bind_param("ississssss", $ci, $name, $lastname, $age, $phone, $email, $state, $school, $grade, $transportation);
   $stmt->execute();
   $stmt->close(); 
   $conn->close();
}

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

function cleanData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    if ($str=='') {$str='-';}
}

function exporttocsv($query_exp,$name)
{
    $mysqli = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);
    $filename = $name.' - '.date('Y.m.d').'.xls'; /*set desired output file name here*/
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");
    $flag = false;
    if ($result = $mysqli->query($query_exp))
    {
	if ($result->num_rows>0)
	{
	    $result->data_seek(0);
	    while ($row = $result->fetch_assoc())
	    {
		if(!$flag)
		{
		    print implode(",", array_keys($row)) . "\r\n";
		    $flag = true;
		}
		array_walk($row, 'cleanData');
		print implode(",", array_values($row)) . "\r\n";
	    }
	}
	else 
	{ 
	    $debug = $debug.'<br/>Empty result'; /*DEBUG*/ 
	}
    }
    else 
    { 
	$debug = $debug.'<br/>Oups, Query error!<br/>Query: '.$query_exp.'<br/>Error: '.$mysqli->error.'.'; /*DEBUG*/ 
    }
    $mysqli->close();
}
