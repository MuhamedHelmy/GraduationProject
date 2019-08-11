<?php

    define('DB_NAME','graduation');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');

    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

     $con->set_charset('utf8');
if($_SERVER['REQUEST_METHOD'] == "POST"){
     if (isset($_POST['mail'])and isset($_POST['password'])){

             $pass=sha1($_POST['password']);
               $email=$_POST['mail'];

$stmt=$con->prepare("  UPDATE student SET Student_Password='".$pass."' WHERE Student_Email='".$email."'"); 
$stmt->bind_param("ss",$pass,$email);

$stmt->execute(); 
}
}                       

