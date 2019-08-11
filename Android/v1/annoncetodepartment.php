<?php

    define('DB_NAME','graduation');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');

    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

     $con->set_charset('utf8');
    $URL        ='';
    $SID='';
    $SName='';
    $Content='';
  
$upload_path_pdf='uploadspdf/';

$upload_path_img = 'uploadsimg/';

$server_ip = gethostbyname(gethostname());

$upload_url_img = 'http://'.$server_ip.'/AndroidUpload/'.$upload_path_img;
$upload_url_pdf = 'http://'.$server_ip.'/AndroidUpload/'.$upload_path_pdf;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
     /*-----------------------------post content-----------------------------------*/


                             	 if (isset($_POST['content'])){

                                        $Content=$_POST['content'];
                                       }


/**************************************post url*************************/

            if (isset($_POST['url'])){
                                      $URL = $_POST['url']; 
				}   



/******************************************************post image***************************/
 

        if(isset($_FILES['image']['name']) ){

            $avatarName = $_FILES['image']['name'];
            $avatarSize = $_FILES['image']['size'];
            $avatarType = $_FILES['image']['type'];
            $avatarTmp  = $_FILES['image']['tmp_name'];
            $avaterAllowExt = array("jpeg","jpg","gif","png");
            $avatarExtt = explode(".", $avatarName);
            $avatarExt = $avatarExtt[1];

            if(! empty($avatarName) && ! in_array($avatarExt, $avaterAllowExt)){
                $formError[] = "Ù‡Ø°Ø§ Ø§Ù„Ù†ÙˆØ¹ Ù…Ù† Ø§Ù„ØµÙˆØ± ØºÙŠØ± <strong>Ù…Ø¯Ø¹Ù…</strong>";
            }

            if(empty($avatarName)){
                $formError[] = "Avatar IS <strong>Required</strong>";
            }

            if($avatarSize > 4194304){
                $formError[] = "Ø­Ø¬Ù… Ø§Ù„ØµÙˆØ±Ù‡ Ø§Ù† Ù„Ø§ØªØ°ÙŠØ¯ Ø¹Ù†  <strong>4Ù…ÙŠØ¬Ø§</strong>";
            }

            if(empty($formError)){

                $avatar = rand(0,100000000.0) . '_' . $avatarName;
                move_uploaded_file($avatarTmp,"/opt/lampp/htdocs/AndroidUpload/".$upload_path_img. $avatar);
                   $avatar =$upload_url_img.$avatar;

            }

        }else{
            $avatar     ='';
        }
         if(isset($_FILES['pdf_file']['name']) ==true ){
            $allowedExts = array("pdf");
            $temp = explode(".", $_FILES["pdf_file"]["name"]);
            $extension = end($temp);
            $upload_pdf=$_FILES["pdf_file"]["name"];

            if(empty($formError)){
        
                $name=rand(0,100000000.0) . '_' .$_FILES["pdf_file"]["name"];
                move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"/opt/lampp/htdocs/AndroidUpload/".$upload_path_pdf. $name);
               $upload_pdf=  $upload_url_pdf.$name;
                
            } 

        }else{
            $upload_pdf ='';
        }





 if(isset( $_POST['senderid'] )){

        $stmt = $con->prepare("INSERT INTO notifiction(Notification_Contents, URL, Image, File,Teaching_staff_id ) VALUES('".$Content."', '".$URL."', '".$avatar."',  '".$upload_pdf."','".$_POST['senderid']."')");

                                                                                             
                                         $stmt->execute();
}
        
                        if($stmt){

                                $last_id_sql_stmt= "SELECT MAX(notifiction.Notification_ID) max_id FROM notifiction ";

                                $result = mysqli_query($con, $last_id_sql_stmt);

				    if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
					    $last_id =  $row["max_id"];
					}
				   }
  if($_POST['depart']=="all"){
                                                                  


								
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from teaching_staff JOIN department WHERE teaching_staff.Department_id=department.Department_ID ";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO ts_notification(ts_notification.Teaching_Staff_ID,ts_notification.Notification_ID)VALUES(".$row['Teaching_Staff_ID'].", ".$last_id.")";
                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                              }
                                     }   

                               }    
                             

                 }

   elseif($_POST['depart']=="is"){
                                                                  

						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from teaching_staff JOIN department WHERE teaching_staff.Department_id= department.Department_ID and department.Department_ID=7  ";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO ts_notification(ts_notification.Teaching_Staff_ID,ts_notification.Notification_ID)VALUES(".$row['Teaching_Staff_ID'].", ".$last_id.")";


                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                              }
                                     }   

		   }

                 }

 elseif($_POST['depart']=="cs"){
                                                                
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from teaching_staff JOIN department WHERE teaching_staff.Department_id= department.Department_ID and department.Department_ID=8  ";

						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO ts_notification(ts_notification.Teaching_Staff_ID,ts_notification.Notification_ID)VALUES(".$row['Teaching_Staff_ID'].", ".$last_id.")";
                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                              }
                                     }   

                           
		   }

                 }
elseif($_POST['depart']=="net"){
                                                               
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from teaching_staff JOIN department WHERE teaching_staff.Department_id= department.Department_ID and department.Department_ID=9  ";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO ts_notification(ts_notification.Teaching_Staff_ID,ts_notification.Notification_ID)VALUES(".$row['Teaching_Staff_ID'].", ".$last_id.")";
                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                    
                               }    
                          }
		   }

                 }
 elseif($_POST['depart']=="gen"){
                                                                   
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from teaching_staff JOIN department WHERE teaching_staff.Department_id= department.Department_ID and department.Department_ID=10  ";

						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO ts_notification(ts_notification.Teaching_Staff_ID,ts_notification.Notification_ID)VALUES(".$row['Teaching_Staff_ID'].", ".$last_id.")";
                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                              }
                                   
                          }
		   }

                 }
 elseif($_POST['depart']=="doc"){
                                                                   
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from teaching_staff JOIN department WHERE teaching_staff.Department_id= department.Department_ID and department.Department_ID=15 ";

						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO ts_notification(ts_notification.Teaching_Staff_ID,ts_notification.Notification_ID)VALUES(".$row['Teaching_Staff_ID'].", ".$last_id.")";
                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                              }
                                   
                          }
		   }

                 }
 

                          }
		   }

                 





