<?php

    define('DB_NAME','graduation');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');

    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $SQL= 'SET CHARACTER SET utf8';
mysqli_query($con,$SQL);

$info=array();

  if($_SERVER['REQUEST_METHOD']=='POST'){
             if(isset($_POST['id'])){

$id=$_POST['id'];

$i=0;

$stmt="SELECT ts_notification.Notification_ID FROM ts_notification WHERE ts_notification.Teaching_Staff_ID =". $id ."";


$result = mysqli_query($con, $stmt);

if (mysqli_num_rows($result) > 0) {

	  while($row = mysqli_fetch_assoc($result)) {
		$var = $row['Notification_ID'];
	        $stmt2="SELECT * from notifiction where Notification_ID = ". $var ."";
		$result2 = mysqli_query($con, $stmt2);


	    	if (mysqli_num_rows($result2) > 0) {

			  while($row2 = mysqli_fetch_assoc($result2)) {
				if($row2['Student_Affairs_ID'] != null)
				{

					$stmt_1 = "SELECT student_affairs.userName from student_affairs where student_affairs.UserID=".$row2['Student_Affairs_ID']."  and student_affairs.type not in ('youth_care','student_affairs')";
					$result_1 = mysqli_query($con, $stmt_1);

    					if (mysqli_num_rows($result_1) > 0) {

		  				while($row_1 = mysqli_fetch_assoc($result_1)) {
							$info[$i]['error']=false;
							$info[$i]['name']=$row_1['userName'];
							$info[$i]['content']=$row2['Notification_Contents'];
							$info[$i]['url']=$row2['URL'];
							$info[$i]['image']=$row2['Image'];
							$info[$i]['file']=$row2['File'];
							
							$i++;
						}
					}
				} else if($row2['Teaching_staff_id'] != null)
					{
						$stmt_0 = "select teaching_staff.Teaching_Staff_Name from teaching_staff where teaching_staff.Teaching_Staff_ID=". $row2['Teaching_staff_id'] ."";
						$result_0 = mysqli_query($con, $stmt_0);

	    					if (mysqli_num_rows($result_0) > 0) {

			  				while($row_0 = mysqli_fetch_assoc($result_0)) {

								$info[$i]['error']=false;
								$info[$i]['name']=$row_0['Teaching_Staff_Name'];
								$info[$i]['content']=$row2['Notification_Contents'];
								$info[$i]['url']=$row2['URL'];
								$info[$i]['image']=$row2['Image'];
								$info[$i]['file']=$row2['File'];
								
								$i++;
							}
						}
					
				}

				
			  }
		}
	  }
}
                                                                                 }

}

echo json_encode($info,JSON_UNESCAPED_UNICODE);

