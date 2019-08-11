<?php
	define('DB_NAME','tet');
		define('DB_USER','root');
		define('DB_PASSWORD','');
		define('DB_HOST','localhost');

	 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	  $SQL= 'SET CHARACTER SET utf8';

mysqli_query($conn,$SQL);

$stmt=$conn->prepare("select teaching_staff.Teaching_Staff_Name,notifiction.Notification_Contents,notifiction.URL,notifiction.Image,notifiction.File from  teaching_staff JOIN notifiction where teaching_staff.Teaching_Staff_ID=notifiction.teaching_stuff_id");

$stmt->bind_result($Teaching_Staff_Name,$Notification_Contents,$URL,$Image,$File);
$stmt->execute();
$products=array();
$i=0;
while($stmt->fetch()){

$products[$i]['name']=$Teaching_Staff_Name;
$products[$i]['content']=$Notification_Contents;
$products[$i]['link']=$URL;
$products[$i]['image']=$Image;
$products[$i]['file']=$File;



$i++;



}
echo json_encode($products,JSON_UNESCAPED_UNICODE);
