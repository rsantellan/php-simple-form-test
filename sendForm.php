<?php
session_start();

error_reporting(E_ALL);

if(!isset($_SESSION['questionNumber']))
{
    exit(0);
}

$init_question_answers = array();
$init_question_answers[1] = false;
$init_question_answers[2] = false;
$init_question_answers[3] = false;
$init_question_answers[4] = false;
$init_question_answers[5] = false;
$init_question_answers[6] = false;
$init_question_answers[7] = false;
$init_question_answers[8] = false;
$init_question_answers[9] = false;
$init_question_answers[10] = false;
$init_question_answers[11] = false;
$init_question_answers[12] = false;
$init_question_answers[13] = false;
$init_question_answers[14] = false;
$init_question_answers[15] = false;

if(!isset($_SESSION['questionAnswers']))
{
    $_SESSION['questionAnswers'] = $init_question_answers;
}
//$_SESSION['questionAnswers'] = $init_question_answers;
$goodAnswers = $_SESSION['questionAnswers'];
$questionNumber = (int) $_POST['questionNumber'];
if($questionNumber == 1)
{
    $_SESSION['questionAnswers'] = $init_question_answers;
}
/*
if($questionNumber == 15)
{
    $_SESSION['lastQuestionNumber'] = true;
    $_SESSION['lastQuestionAnswers'] = $goodAnswers;
    
}
*/
if($questionNumber <= 15)
{
    $_SESSION['questionNumber'] = $questionNumber + 1;
}
else
{
    $_SESSION['questionNumber'] = 1;
    $goodAnswers = $init_question_answers;
    //$goodAnswers = 0;
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
        $_SESSION['questionAnswers'][$questionNumber] = true;
        echo json_encode(array('response' => 'ok', 'goodanswer' => calculateNumberOfOkAnswers($_SESSION['questionAnswers']) ));
        //$_SESSION['questionAnswers']  = $goodAnswers + 1;
        if($questionNumber == 15)
        {
            $_SESSION['lastQuestionNumber'] = true;
            $_SESSION['lastQuestionAnswers'] = calculateNumberOfOkAnswers($_SESSION['questionAnswers']);
        }
    }
    else
    {
        $_SESSION['questionAnswers'][$questionNumber] = false;
        echo json_encode(array('response' => 'error', 'goodanswer' => calculateNumberOfOkAnswers($_SESSION['questionAnswers'])));
    }
}
else
{
    echo json_encode(array('response' => 'error', 'goodanswer' => calculateNumberOfOkAnswers($_SESSION['questionAnswers'])));
    //echo 'error';
}


