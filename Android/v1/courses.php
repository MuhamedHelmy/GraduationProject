<?php
	define('DB_NAME','graduation');
		define('DB_USER','root');
		define('DB_PASSWORD','');
		define('DB_HOST','localhost');

	 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	  $SQL= 'SET CHARACTER SET utf8';
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['mail'])){
		       mysqli_query($conn,$SQL);

	$stmt=$conn->prepare("select DISTINCT courses.Course_Name from schedule JOIN courses JOIN day JOIN teaching_staff JOIN room join schedule_section join section JOIN student WHERE schedule.Schedule_ID=schedule_section.Schedule_ID AND courses.Course_ID=schedule.Course_ID and day.Day_ID= schedule.Day_ID and teaching_staff.Teaching_Staff_ID=schedule.Teaching_Staff_ID and room.Room_ID= schedule.Room_ID and section.Section_ID=schedule_section.Section_ID AND section.Section_ID =student.Section_ID and student.Student_Email= ?");
    
        $stmt->bind_param("s",$_POST['mail']);
	$stmt->execute();
        $stmt->store_result(); 

        $num=$stmt->num_rows; 
	$stmt->bind_result($Course_Name);
      
	
	$info=array();
	$i=0;
	while($stmt->fetch()){
	

	$info[$i]['course']=$Course_Name;
	
	$i++;



	}

	}



	else echo("you must enter section");

        echo json_encode($info,JSON_UNESCAPED_UNICODE);

	}



