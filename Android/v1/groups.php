<?php

    define('DB_NAME','graduation');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');

    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $SQL= 'SET CHARACTER SET utf8';
mysqli_query($con,$SQL);
if($_SERVER['REQUEST_METHOD']=='POST'){
             if(isset($_POST['year'])){
            $year=$_POST['year'];
                    $contractDateBegin = date('m/d', strtotime("01/02"));
                    $contractDateEnd = date('m/d', strtotime("07/01"));
                    $date=date('Y');
                    if (date('m/d')<$contractDateEnd && date('m/d')>$contractDateBegin) {
                        $date=($date-1)."/".($date);
                    }else{
                        $date=$date.'/'.$date+1 ;
                    }
                                             
  $stmt=$con->prepare("select DISTINCT section.Group_number from section join academic_year join academic_year_department WHERE academic_year_department.Academic_Year_ID=academic_year.ID and academic_year_department.ID=section.Academic_Year_Depatment_ID  and academic_year.id=$year  and section.Academic_Year_Date='".$date."'");

         $stmt->bind_result($Group_number);
       // $stmt->bind_param("s",$_POST('id'));
	$stmt->execute();
           
     
    

$info=array();
$i=0;
while($stmt->fetch()){
$info[$i]['error']=false;
$info[$i]['group']=$Group_number;


$i++;


}
}




             





}







echo json_encode($info,JSON_UNESCAPED_UNICODE);

