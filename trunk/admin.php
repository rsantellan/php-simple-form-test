<?php

session_start();
include_once 'defines/functions.php';

$message = "";
$generated_winners = array();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //var_dump($_POST);
    if(!isset($_SESSION['user']))
    {
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            if(($_POST['login'] == "administrador") && ($_POST['password'] == "M9TrXKiAxo"))
            {
              $_SESSION['user'] = true;  
            }
            else
            {
                $message = "Usuario o Contraseña incorrecta";
            }
        }
    }
    else
    {
        if(isset($_POST['generateWinners']))
        {
            $generated_winners = returnRandomWinners($_POST['generateWinners']);
        }
        
        if(isset($_POST['logout']))
        {
            unset($_SESSION['user']);
        }
    }
    //die('aca');
}

if(!isset($_SESSION['user'])):
//Me logueo
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/admin.css">
  <link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Surco Trivia Administrador</h1>
      <form method="post" action="admin.php">
        <p><input type="text" name="login" value="" placeholder="Usuario"></p>
        <p><input type="password" name="password" value="" placeholder="Contraseña"></p>
        <p class="submit"><input type="submit" name="commit" value="Ingresar"></p>
      </form>
    </div>

    <div class="login-help">
      <span style="color: red !important; font-size: 18px; font-weight: bold;"><?php echo $message;?></span>
    </div>
  </section>

  <section class="about">
    <p class="about-author">
      Creado por <a href="mailto:rsantellan@gmail.com?Subject=Surco%20Trivia" target="_top">Rodrigo Santellan</a>
    </p>  
  </section>
</body>
</html>
<?php
else: 
//Veo el admin

$winners = retrieveTodayWinners(10);
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Administrador</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/tables.css">
  <link type="image/x-icon" href="favicon.ico" rel="shortcut icon">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <div class="salir">
      
  </div>  
  <div class="contenido">
    <h2>Primeros concursantes del dia en llenarlo correctamente</h2>
    <table id="newspaper-b">
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Departamento</th>
                <th>Escuela</th>
                <th>Grado</th>
                <th>Transporte</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($winners as $winner): ?>
            <tr>
                <td><?php echo $winner->ci;?></td>
                <td><?php echo $winner->name;?></td>
                <td><?php echo $winner->lastname;?></td>
                <td><?php echo $winner->age;?></td>
                <td><?php echo $winner->phone;?></td>
                <td><?php echo $winner->email;?></td>
                <td><?php echo $winner->state;?></td>
                <td><?php echo $winner->school;?></td>
                <td><?php echo $winner->grade;?></td>
                <td><?php echo $winner->transportation;?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h2>Generar ganadores (Los ganadores se generan de a 2)</h2>
    <?php if(count($generated_winners) > 0): ?>
        <table id="newspaper-b">
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Departamento</th>
                <th>Escuela</th>
                <th>Grado</th>
                <th>Transporte</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($generated_winners as $winner): ?>
            <tr>
                <td><?php echo $winner->ci;?></td>
                <td><?php echo $winner->name;?></td>
                <td><?php echo $winner->lastname;?></td>
                <td><?php echo $winner->age;?></td>
                <td><?php echo $winner->phone;?></td>
                <td><?php echo $winner->email;?></td>
                <td><?php echo $winner->state;?></td>
                <td><?php echo $winner->school;?></td>
                <td><?php echo $winner->grade;?></td>
                <td><?php echo $winner->transportation;?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php endif; ?>
        <form method="post" action="admin.php">
            <input type="hidden" value="2" name="generateWinners" />
            <p class="submit"><input type="submit" value="Generar"></p>
        </form>
        
        <hr style="margin-top: 10px" />
        
        <form method="post" action="admin.php">
            <input type="hidden" value="1" name="logout" />
            <p class="submit"><input type="submit" value="Salir"></p>
        </form>
  </div>
</body>
</html>
<?php
endif;

