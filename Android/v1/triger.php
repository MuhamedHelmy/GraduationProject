<?php

    define('DB_NAME','graduation');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');

    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $SQL= 'SET CHARACTER SET utf8';
mysqli_query($con,$SQL);
 if($_SERVER['REQUEST_METHOD']=='POST'){
             if(isset($_POST['id']) and isset($_POST['returnid'])){
                       

      $real_id=$_POST['returnid'];
      $id=$_POST['id'];

 $last_id_sql_stmt= "SELECT MAX(Notification_Triger.id) max_id FROM Notification_Triger";

                                $result = mysqli_query($con, $last_id_sql_stmt);

				    if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
					    $last_id =  $row["max_id"];

                                       echo($last_id);
if($last_id>$real_id){


 $stmt=$con->prepare= $con->prepare("select notifiction.Notification_Contents, notifiction.URL ,notifiction.Image,notifiction.File from notifiction join student_notification join Notification_Triger where notifiction.Notification_ID=student_notification.notification_id and student_notification.student_id=$id and Notification_Triger.id > $real_id and Notification_Triger.notificatin_id=notifiction.Notification_ID  ");
 $stmt->bind_result($Notification_Contents,$URL,$Image,$File);
	$stmt->execute();
$info=array();
$i=0;
while($stmt->fetch()){
$info[$i]['error']=false;
$info[$i]['id']=$last_id;
$info[$i]['content']=$Notification_Contents;
$info[$i]['url']=$URL;
$info[$i]['image']=$Image;
$info[$i]['file']=$File;


$i++;



}
}
else echo("Nothing NEW !!!");





 




}





					}}
}

echo json_encode($info,JSON_UNESCAPED_UNICODE);
