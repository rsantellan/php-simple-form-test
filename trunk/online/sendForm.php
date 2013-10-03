<?php
session_start();

error_reporting(E_ALL);

if(!isset($_SESSION['questionNumber']))
{
    exit(0);
}
if(!isset($_SESSION['questionAnswers']))
{
    $_SESSION['questionAnswers'] = 0;
}
$goodAnswers = $_SESSION['questionAnswers'];
$questionNumber = (int) $_POST['questionNumber'];
/*
if($questionNumber == 15)
{
    $_SESSION['lastQuestionNumber'] = true;
    $_SESSION['lastQuestionAnswers'] = $goodAnswers;
    
}
*/
if($questionNumber < 15)
{
    $_SESSION['questionNumber'] = $questionNumber + 1;
}
else
{
    $_SESSION['questionNumber'] = 1;
    $goodAnswers = 0;
}
$q1 = (isset($_POST['q1']) ? $_POST['q1'] : null);
$q2 = (isset($_POST['q2']) ? $_POST['q2'] : null);
$q3 = (isset($_POST['q3']) ? $_POST['q3'] : null);
$q4 = (isset($_POST['q4']) ? $_POST['q4'] : null);

include_once 'defines/functions.php';
$dbserver = DBSERVER;
$dbuser = DBUSER;
$dbpass = DBPASS;
$dbname = DBNAME;



$questions = retrieveAllQuestionsAndAnswers($dbserver, $dbuser, $dbpass, $dbname);
if(isset($questions[$questionNumber]))
{
    //var_dump($questions[$questionNumber]);
    //var_dump($questions[$questionNumber]->opciones);
    $ok = 0;
    $cantidadok = 0;
    
    if($questions[$questionNumber]->opciones[0]->correcto == 1)
    {
        $cantidadok++;
        if(!is_null($q1))
        {
            $ok++;
        }
    }
    else
    {
        if(!is_null($q1))
        {
            $ok--;
        }
        
    }
    if($questions[$questionNumber]->opciones[1]->correcto == 1)
    {
        $cantidadok++;
        if(!is_null($q2))
        {
            $ok++;
        }
    }
    else
    {
        if(!is_null($q2))
        {
            $ok--;
        }
        
    }
    if($questions[$questionNumber]->opciones[2]->correcto == 1)
    {
        $cantidadok++;
        if(!is_null($q3))
        {
            $ok++;
        }
    }
    else
    {
        if(!is_null($q3))
        {
            $ok--;
        }
        
    }
    if($questions[$questionNumber]->opciones[3]->correcto == 1)
    {
        $cantidadok++;
        if(!is_null($q4))
        {
            $ok++;
        }
    }
    else
    {
        if(!is_null($q4))
        {
            $ok--;
        }
        
    }

    if($ok == $cantidadok)
    {
        echo json_encode(array('response' => 'ok'));
        $_SESSION['questionAnswers']  = $goodAnswers + 1;
        if($questionNumber == 15)
        {
            $_SESSION['lastQuestionNumber'] = true;
            $_SESSION['lastQuestionAnswers'] = 15;
        }
    }
    else
    {
        echo json_encode(array('response' => 'error'));
    }
}
else
{
    echo json_encode(array('response' => 'error'));
    //echo 'error';
}


