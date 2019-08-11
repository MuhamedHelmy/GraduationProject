<?php
define('DB_NAME','graduation');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$SQL= 'SET CHARACTER SET utf8';

mysqli_query($conn,$SQL);

$stmt=$conn->prepare("SELECT teaching_staff.Teaching_Staff_Ssn,teaching_staff.Teaching_Staff_Name,teaching_staff.Teaching_Staff_Email,teaching_staff.Office_houres, department.Department_Name ,scientific_degree.Degree,room.Code,room.Name As room_name ,position.Name from teaching_staff JOIN department JOIN scientific_degree JOIN room join position where teaching_staff.Department_id =department.Department_ID AND teaching_staff.Scientific_Degree_ID=scientific_degree.Scientific_Degree_ID AND room.Room_ID=teaching_staff.Room_ID and position.ID= teaching_staff.Position_ID ");

$stmt->bind_result($Teaching_Staff_SSN,$Teaching_Staff_Name,$Teaching_Staff_Email,$Office_houres,$Department_Name,$Degree,$Code,$room_name,$Name);
$stmt->execute();
$products=array();
$i=0;
while($stmt->fetch()){

$products[$i]['ssn']=$Teaching_Staff_SSN;
$products[$i]['name']=$Teaching_Staff_Name;
$products[$i]['mail']=$Teaching_Staff_Email;
$products[$i]['hours']=$Office_houres;
$products[$i]['depart']=$Department_Name;
$products[$i]['degree']=$Degree;
$products[$i]['code']=$Degree;
$products[$i]['room_name']=$room_name;
$products[$i]['position']=$Name;




$i++;



}
echo json_encode($products,JSON_UNESCAPED_UNICODE);

