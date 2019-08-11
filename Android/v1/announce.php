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
        


/*******************************pdf_file******************************/

        if(isset($_FILES['pdf_file']['name']) ==true ){
            $allowedExts = array("pdf");
            $temp = explode(".", $_FILES["pdf_file"]["name"]);
            $extension = end($temp);
            $upload_pdf=$_FILES["pdf_file"]["name"];

            if(empty($formError)){
        
                $name=rand(0,100000000.0) . '_' .$_FILES["pdf_file"]["name"];
                move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"/opt/lampp/htdocs/AndroidUpload/".$upload_path_pdf.$name);
              $upload_pdf=  $upload_url_pdf.$name;
                
            } 

        }else{
            $upload_pdf ='';
        }


 /**************************************post year num************************/



        if(!empty($_POST['yearnumber'] )) {


                                  if(isset($_POST['ssn']) ){
                                      $stmt = "SELECT * FROM student WHERE SSN= '".$_POST['ssn']."' ";

                                      $result = mysqli_query($con, $stmt);

                                             if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                                                  while($row = mysqli_fetch_assoc($result)) {
                                                       $SID=$row['Student_ID'];
                                                       $SName=$row['Student_Name'];
                                                       echo($SID);
                                                  }
                                                                                 }

                                           else{
                                                $formError[] = "error";
                                               }
                                                           }

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

    /************************************post yearnum    ******************************/

           
	                     if(isset($_POST['yearnumber'])){


      /************************************* yearnum==student**********************/

  
                                             if($_POST['yearnumber']=="student"){

                $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$SID.", ".$last_id.") ";
                if (mysqli_multi_query($con, $sql)) {
                                                   echo "New records created successfully";
                                                    }                                    
                                               else {
                                                       echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                                    }


                                                                                  }  


/*********************************************yearnum==all*********************/

      
                               elseif($_POST['yearnumber']=="all"){
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
                                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                               }

                                              }
                                     }   

                               }    
                          }
		   }

                 }



/*************************************************yearnum not equal********************************/




else {

                    $contractDateBegin = date('m/d', strtotime("01/02"));
                    $contractDateEnd = date('m/d', strtotime("07/01"));
                    $date=date('Y');
                    if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
                        $date=($date-1)."/".($date);
                    }else{
                        $date=$date.'/'.$date+1 ;
                    }
                    $year_number = $_POST['yearnumber'];
                
                    echo($year_number);

   /*********************************************group num ***************************/

                    if(isset($_POST['groupnumber'])){
                      
                        if ($_POST['groupnumber']=="all") {

                         
                            if ($_POST['search']=='group') {
                      
				if(isset($_POST['section'])){
					if($_POST['section'] == "all"){
				                $stu_stmt= "select Section_ID from section where section.Academic_Year_Depatment_ID = (SELECT id FROM `academic_year_department` where Academic_Year_ID = ".$year_number." and Department_ID = 10) and Academic_Year_Date = '".$date."'";
				                $result = mysqli_query($con, $stu_stmt);
				                echo($year_number. "sdfghjk ".$date);
				                if (mysqli_num_rows($result) > 0) {
				                    // output data of each row
				                    while($row = mysqli_fetch_assoc($result)) {
				                        $stu_stmt2= "SELECT * FROM student WHERE Section_ID =".$row['Section_ID']." ";

				                        $result2 = mysqli_query($con, $stu_stmt2);

				                        if (mysqli_num_rows($result2) > 0) {
				                            // output data of each row
				                            while($row2 = mysqli_fetch_assoc($result2)) {
				                                echo($row2['Student_ID']);
				                                $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row2['Student_ID'].", ".$last_id.")";
				                                if (mysqli_multi_query($con, $sql)) {
				                                    echo "New records created successfully";
				                                } else {
				                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
				                                }
				                            }
				                        }
				                    }
				                }
					} 
//////////////////////////////**************************section not equal all***********************************/


                  else {

						$stu_stmt= "select Section_ID from section where section.Academic_Year_Depatment_ID = (SELECT id FROM `academic_year_department` where Academic_Year_ID = ".$year_number." and Department_ID = 10) and Academic_Year_Date = '".$date."' and Section_Number = ".$_POST['section']."";
				                $result = mysqli_query($con, $stu_stmt);
				                echo($year_number. "sdfghjk ".$date);
				                if (mysqli_num_rows($result) > 0) {
				                    // output data of each row
				                    while($row = mysqli_fetch_assoc($result)) {
				                        $stu_stmt2= "SELECT * FROM student WHERE Section_ID =".$row['Section_ID']." ";

				                        $result2 = mysqli_query($con, $stu_stmt2);

				                        if (mysqli_num_rows($result2) > 0) {
				                            // output data of each row
				                            while($row2 = mysqli_fetch_assoc($result2)) {
				                                echo($row2['Student_ID']);
				                                $sql = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$row2['Student_ID'].", ".$last_id.")";
				                                if (mysqli_multi_query($con, $sql)) {
				                                    echo "New records created successfully";
				                                } else {
				                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
				                                }
				                            }
				                        }
				                    }
				                }
					}
				}
                            }


                    }

 

/***************************************************post to four year*********************************/

                                     elseif ($_POST['groupnumber'] == 7) {

					if(isset($_POST['section'])){

///////////////////////////////////////******* all section in this department***************************/
						if($_POST['section'] == 'all'){
							$stu_stmt4 = "select Section_ID from section where Academic_Year_Depatment_ID = (SELECT id FROM `academic_year_department` where Academic_Year_ID = 4 and Department_ID = 7) and Academic_Year_Date = '".$date."'";
							$result4 = mysqli_query($con, $stu_stmt4);
							if (mysqli_num_rows($result4) > 0) {
echo("fuck");
								while($get4 = mysqli_fetch_assoc($result4)) {
								    
									$stu_stmt5 = "SELECT * FROM student WHERE Section_ID = ".$get4['Section_ID']." ";
echo("fuck2");
									$result5 = mysqli_query($con, $stu_stmt5);
									if (mysqli_num_rows($result5) > 0) {
echo("fuck3");
										while($get5 = mysqli_fetch_assoc($result5)) {
echo("fuck of");
											$sql2 = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$get5['Student_ID'].", ".$last_id.")";
											
										        if (mysqli_multi_query($con, $sql2)) {
										            echo "New records created successfully";
										        } else {
										            echo "Error: " . $sql . "<br>" . mysqli_error($con);
										        }
										}
									}
								    
								    
								}
							}
						}





//////////////////********************spcific section ******************////////////////
						else{
echo("dfg__");
							$stu_stmt4 = "select Section_ID from section where Academic_Year_Depatment_ID = (SELECT id FROM `academic_year_department` where Academic_Year_ID = 4 and Department_ID = 7) and Academic_Year_Date = '".$date."' and Section_Number = ".$_POST['section']."";
							$result4 = mysqli_query($con, $stu_stmt4);
							if (mysqli_num_rows($result4) > 0) {
echo("fuck");
								while($get4 = mysqli_fetch_assoc($result4)) {
								    
									$stu_stmt5 = "SELECT * FROM student WHERE Section_ID = ".$get4['Section_ID']." ";
echo("fuck2");
									$result5 = mysqli_query($con, $stu_stmt5);
									if (mysqli_num_rows($result5) > 0) {

										while($get5 = mysqli_fetch_assoc($result5)) {

											$sql2 = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$get5['Student_ID'].", ".$last_id.")";
			
											if (mysqli_multi_query($con, $sql2)) {
											    echo "New records created successfully";
											} else {
											    echo "Error: " . $sql . "<br>" . mysqli_error($con);
											}
										}
									}
								    
								    
								}
							}
								}
					}
                    }





         elseif ($_POST['groupnumber'] == 8) {

					if(isset($_POST['section'])){

///////////////////////////////////////******* all section in this department***************************/
						if($_POST['section'] == 'all'){
							$stu_stmt4 = "select Section_ID from section where Academic_Year_Depatment_ID = (SELECT id FROM `academic_year_department` where Academic_Year_ID = 4 and Department_ID = 8) and Academic_Year_Date = '".$date."'";
							$result4 = mysqli_query($con, $stu_stmt4);
							if (mysqli_num_rows($result4) > 0) {

								while($get4 = mysqli_fetch_assoc($result4)) {
								    
									$stu_stmt5 = "SELECT * FROM student WHERE Section_ID = ".$get4['Section_ID']." ";

									$result5 = mysqli_query($con, $stu_stmt5);
									if (mysqli_num_rows($result5) > 0) {

										while($get5 = mysqli_fetch_assoc($result5)) {

											$sql2 = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$get5['Student_ID'].", ".$last_id.")";
											
										        if (mysqli_multi_query($con, $sql2)) {
										            echo "New records created successfully";
										        } else {
										            echo "Error: " . $sql . "<br>" . mysqli_error($con);
										        }
										}
									}
								    
								    
								}
							}
						}





//////////////////********************spcific section ******************////////////////
						else{
echo("dfg__");
							$stu_stmt4 = "select Section_ID from section where Academic_Year_Depatment_ID = (SELECT id FROM `academic_year_department` where Academic_Year_ID = 4 and Department_ID = 8) and Academic_Year_Date = '".$date."' and Section_Number = ".$_POST['section']."";
							$result4 = mysqli_query($con, $stu_stmt4);
							if (mysqli_num_rows($result4) > 0) {
echo("fuck");
								while($get4 = mysqli_fetch_assoc($result4)) {
								    
									$stu_stmt5 = "SELECT * FROM student WHERE Section_ID = ".$get4['Section_ID']." ";

									$result5 = mysqli_query($con, $stu_stmt5);
									if (mysqli_num_rows($result5) > 0) {

										while($get5 = mysqli_fetch_assoc($result5)) {

											$sql2 = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$get5['Student_ID'].", ".$last_id.")";
			
											if (mysqli_multi_query($con, $sql2)) {
											    echo "New records created successfully";
											} else {
											    echo "Error: " . $sql . "<br>" . mysqli_error($con);
											}
										}
									}
								    
								    
								}
							}
								
                                              }
					
                           }
     } 

//********************************* send for all year four deparments/////////////////*/

 else  
{
$stu_stmt4 = "SELECT DISTINCT section.Section_ID from section JOIN academic_year_department JOIN academic_year WHERE section.Academic_Year_Depatment_ID=academic_year.ID and academic_year_department.Academic_Year_ID=academic_year.ID and academic_year.ID=4 ";

							$result4 = mysqli_query($con, $stu_stmt4);
							if (mysqli_num_rows($result4) > 0) {
echo("fuck");
								while($get4 = mysqli_fetch_assoc($result4)) {
$stu_stmt5 = "SELECT * FROM student WHERE Section_ID = ".$get4['Section_ID']." ";
$result5 = mysqli_query($con, $stu_stmt5);
									if (mysqli_num_rows($result5) > 0) {

										while($get5 = mysqli_fetch_assoc($result5)) {

											$sql2 = "INSERT INTO student_notification(Student_ID, Notification_ID) VALUES(".$get5['Student_ID'].", ".$last_id.")";
								    






}


                     
}
}
                    
      }
}}              
              
   }
}
}
}                 
    
?>
