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
               $upload_pdf=  $upload_url_pdf.$upload_pdf;
                
            } 

        }else{
            $upload_pdf ='';
        }





 if(isset( $_POST['senderid'] )){

        $stmt = $con->prepare("INSERT INTO notifiction(Notification_Contents, URL, Image, File,Student_Affairs_ID ) VALUES('".$Content."', '".$URL."', '".$avatar."',  '".$upload_pdf."','".$_POST['senderid']."')");

                                                                                             
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
  if($_POST['yearnumber']=="all"){
                                                                    echo($_POST['yearnumber']);


								$yeardate=date('Y');
								$contractDateBegin = date('m/d', strtotime("01/02"));
								$contractDateEnd = date('m/d', strtotime("07/01"));
								$date=date('Y');
								if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
								    $date=($date-1).'/'.($date);
								}else{
								    $date=$date.'/'.$date+1 ;
								} 
							       
								$sec_stmt= "SELECT * FROM section WHERE Academic_Year_Date ='".$date."'";
								$result = mysqli_query($con, $sec_stmt);




                                if (mysqli_num_rows($result) > 0) {

                                                 while($get = mysqli_fetch_assoc($result)) {
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from student join section join academic_year_department WHERE student.Section_ID=section.Section_ID AND academic_year_department.ID=section.Academic_Year_Depatment_ID";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row['Student_ID'].", ".$last_id.")";
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

   elseif($_POST['yearnumber']==1){
                                                                    echo($_POST['yearnumber']);


								$yeardate=date('Y');
								$contractDateBegin = date('m/d', strtotime("01/02"));
								$contractDateEnd = date('m/d', strtotime("07/01"));
								$date=date('Y');
								if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
								    $date=($date-1).'/'.($date);
								}else{
								    $date=$date.'/'.$date+1 ;
								} 
							       
								$sec_stmt= "SELECT * FROM section WHERE Academic_Year_Date ='".$date."'";
								$result = mysqli_query($con, $sec_stmt);




                                if (mysqli_num_rows($result) > 0) {

                                                 while($get = mysqli_fetch_assoc($result)) {
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from student join section join academic_year_department join academic_year WHERE student.Section_ID=section.Section_ID AND academic_year_department.ID=section.Academic_Year_Depatment_ID and academic_year_department.Academic_Year_ID=academic_year.ID and academic_year.ID=1 ";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row['Student_ID'].", ".$last_id.")";
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

 elseif($_POST['yearnumber']==2){
                                                                    echo($_POST['yearnumber']);


								$yeardate=date('Y');
								$contractDateBegin = date('m/d', strtotime("01/02"));
								$contractDateEnd = date('m/d', strtotime("07/01"));
								$date=date('Y');
								if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
								    $date=($date-1).'/'.($date);
								}else{
								    $date=$date.'/'.$date+1 ;
								} 
							       
								$sec_stmt= "SELECT * FROM section WHERE Academic_Year_Date ='".$date."'";
								$result = mysqli_query($con, $sec_stmt);




                                if (mysqli_num_rows($result) > 0) {

                                                 while($get = mysqli_fetch_assoc($result)) {
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from student join section join academic_year_department join academic_year WHERE student.Section_ID=section.Section_ID AND academic_year_department.ID=section.Academic_Year_Depatment_ID and academic_year_department.Academic_Year_ID=academic_year.ID and academic_year.ID=2";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row['Student_ID'].", ".$last_id.")";
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
elseif($_POST['yearnumber']==3){
                                                                    echo($_POST['yearnumber']);


								$yeardate=date('Y');
								$contractDateBegin = date('m/d', strtotime("01/02"));
								$contractDateEnd = date('m/d', strtotime("07/01"));
								$date=date('Y');
								if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
								    $date=($date-1).'/'.($date);
								}else{
								    $date=$date.'/'.$date+1 ;
								} 
							       
								$sec_stmt= "SELECT * FROM section WHERE Academic_Year_Date ='".$date."'";
								$result = mysqli_query($con, $sec_stmt);




                                if (mysqli_num_rows($result) > 0) {

                                                 while($get = mysqli_fetch_assoc($result)) {
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from student join section join academic_year_department join academic_year WHERE student.Section_ID=section.Section_ID AND academic_year_department.ID=section.Academic_Year_Depatment_ID and academic_year_department.Academic_Year_ID=academic_year.ID and academic_year.ID=3";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row['Student_ID'].", ".$last_id.")";
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
elseif($_POST['yearnumber']==4){
                                                                    echo($_POST['yearnumber']);


								$yeardate=date('Y');
								$contractDateBegin = date('m/d', strtotime("01/02"));
								$contractDateEnd = date('m/d', strtotime("07/01"));
								$date=date('Y');
								if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
								    $date=($date-1).'/'.($date);
								}else{
								    $date=$date.'/'.$date+1 ;
								} 
							       
								$sec_stmt= "SELECT * FROM section WHERE Academic_Year_Date ='".$date."'";
								$result = mysqli_query($con, $sec_stmt);




                                if (mysqli_num_rows($result) > 0) {

                                                 while($get = mysqli_fetch_assoc($result)) {
						if(empty($_POST['section'])){
						    $stu_stmt= "SELECT * from student join section join academic_year_department join academic_year WHERE student.Section_ID=section.Section_ID AND academic_year_department.ID=section.Academic_Year_Depatment_ID and academic_year_department.Academic_Year_ID=academic_year.ID and academic_year.ID=4";
						        $result = mysqli_query($con, $stu_stmt);

                                               if (mysqli_num_rows($result) > 0) {


                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row['Student_ID'].", ".$last_id.")";
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
elseif($_POST['yearnumber']=='email'){
                                                                 if(isset($_POST['email'])){
							       
								$sec_stmt= "SELECT * FROM student WHERE student.Student_Email='".$_POST['email']."'";
								$result = mysqli_query($con, $sec_stmt);




                                if (mysqli_num_rows($result) > 0) {



                                          while($row = mysqli_fetch_assoc($result)) {

                                                       $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row['Student_ID'].", ".$last_id.")";
                                    if (mysqli_multi_query($con, $sql)) {
                                        echo "New records created successfully";
                                                                       }
                                             else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                               }

                                              }
                                     }   }

                               }    
                          }
		   }

                 





