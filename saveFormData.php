<?php
session_start();
include_once 'defines/functions.php';
if( (isset($_SESSION['lastQuestionNumber']) && isset($_SESSION['lastQuestionAnswers'])))
{
    
    if(isset($_POST["name"]) && isset($_POST["lastname"]) && isset($_POST["ci"]) 
    && isset($_POST["age"]) && isset($_POST["phone"]) && isset($_POST["state"]) 
    && isset($_POST["school"]) && isset($_POST["transportation"]))
    {
        
        
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $ci = $_POST["ci"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $state = $_POST["state"];
        $school = $_POST["school"];
        $grade = $_POST["grade"];
        $transportation = $_POST["transportation"];    
        
        if((int) $age <= 15)
        {
            saveNewContenstant($ci, $name, $lastname, $age, $phone, $email, $state, $school, $grade, $transportation);
        }
        unset($_SESSION['lastQuestionNumber']);
        unset($_SESSION['lastQuestionAnswers']);
        echo json_encode(array('result' => 'ok'));
        die;
    }
    else
    {
        //echo json_encode(array('result' => 'error'));
        //die;
    }    
}
echo json_encode(array('result' => 'error'));
die;
