<?php
define('DB_NAME','graduation');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$SQL= 'SET CHARACTER SET utf8';

mysqli_query($conn,$SQL);
$stmt=$conn->prepare("select Department_Name from department  ");
$stmt->bind_result($Department_Name);
$stmt->execute();
$products=array();
$i=0;
while($stmt->fetch()){


$products[$i]['name']=$Department_Name;





$i++;



}
echo json_encode($products,JSON_UNESCAPED_UNICODE);


