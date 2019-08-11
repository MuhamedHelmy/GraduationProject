	<?php
	define('DB_NAME','graduation');
		define('DB_USER','root');
		define('DB_PASSWORD','');
		define('DB_HOST','localhost');

	 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	  $SQL= 'SET CHARACTER SET utf8';
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['mail'])and isset($_POST['day'])){
		       mysqli_query($conn,$SQL);

	$stmt=$conn->prepare("select courses.Course_Name,day.Day_Name,teaching_staff.Teaching_Staff_Name,room.Description,room.Name,schedule.Start_Time,schedule.End_Time,schedule.Type from schedule JOIN courses JOIN day JOIN teaching_staff JOIN room join schedule_section join section JOIN student WHERE schedule.Schedule_ID=schedule_section.Schedule_ID AND courses.Course_ID=schedule.Course_ID and day.Day_ID= schedule.Day_ID and teaching_staff.Teaching_Staff_ID=schedule.Teaching_Staff_ID and room.Room_ID= schedule.Room_ID and section.Section_ID=schedule_section.Section_ID AND section.Section_ID =student.Section_ID and student.Student_Email=? and day.Day_ID=?");
    
        $stmt->bind_param("ss",$_POST['mail'],$_POST['day']);
	$stmt->execute();
        $stmt->store_result(); 
        $num=$stmt->num_rows; 
	$stmt->bind_result($Course_Name,$Day_Name,$Teaching_Staff_Name,$Description,$Name,$Start_Time,$End_Time,$Type);
      
	
	$info=array();
	$i=0;
	while($stmt->fetch()){
	
	$info[$i]['error']=false;
	$info[$i]['course']=$Course_Name;
	$info[$i]['place']=$Name;
         $info[$i]['des']=$Description;
	$info[$i]['name']=$Teaching_Staff_Name;
	$info[$i]['day']=$Day_Name;
	$info[$i]['etime']=$End_Time;
	$info[$i]['stime']=$Start_Time;
	$info[$i]['type']=$Type;



	$i++;



	}

	}



	else echo("you must enter section");

        echo json_encode($info,JSON_UNESCAPED_UNICODE);

	}



