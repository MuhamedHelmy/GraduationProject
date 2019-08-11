<?php
define('DB_NAME','graduation');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$SQL= 'SET CHARACTER SET utf8';

mysqli_query($conn,$SQL);
$stmt=$conn->prepare("SELECT office_boy.Office_Boy_ID, office_boy.Office_Boy_Name ,office_boy.Servic_name,office_boy.Phone FROM office_boy ");
$stmt->bind_result($Office_Boy_ID,$Office_Boy_Name,$Servic_name,$Phone);
$stmt->execute();
$products=array();
$i=0;
while($stmt->fetch()){

$products[$i]['ssn']=$Office_Boy_ID;
$products[$i]['name']=$Office_Boy_Name;
$products[$i]['service']=$Servic_name;
$products[$i]['phone']=$Phone;




$i++;



}
echo json_encode($products,JSON_UNESCAPED_UNICODE);


