<?php
define('DB_NAME','tet');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $SQL= 'SET CHARACTER SET utf8';

mysqli_query($conn,$SQL);


$stmt=$conn->prepare("SELECT  	history ,summer_training,study_years,conditions,future_work,location,name, 	departments_enroll ,adminstrators  from faculty_information ");
$stmt1=$conn->prepare("select Department_Name from department; ");

$stmt->bind_result($history,$summer_training,$study_years,$conditions,$future_work,$location,$name,$departments_enroll,$adminstrators );
$stmt->execute();

$info=array();
$i=0;
while($stmt->fetch()){
$info[$i]['error']=false;
$info[$i]['name']=$name;
$info[$i]['history']=$history;
$info[$i]['years']=$study_years;
$info[$i]['location']=$location;
$info[$i]['training']=$summer_training;
$info[$i]['conditions']=$conditions;
$info[$i]['futurework']=$future_work;
$info[$i]['depart_enroll']=$departments_enroll;
$info[$i]['adminstrators']=$adminstrators;

$i++;



}
echo json_encode($info,JSON_UNESCAPED_UNICODE);

