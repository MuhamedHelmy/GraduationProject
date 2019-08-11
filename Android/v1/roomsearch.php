<?php
define('DB_NAME','graduation');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $SQL= 'SET CHARACTER SET utf8';

mysqli_query($conn,$SQL);
$stmt=$conn->prepare("SELECT room.Code,room.Name,room.Description  FROM room");

$stmt->bind_result($Code,$Name,$Description);
$stmt->execute();
$info=array();
$i=0;
while($stmt->fetch()){

$info[$i]['name']=$Name;
$info[$i]['code']=$Code;
$info[$i]['Description']=$Description;



$i++;



}
echo json_encode($info,JSON_UNESCAPED_UNICODE);

