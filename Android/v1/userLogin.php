<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) and 
           isset($_POST['password'])){
		
               $db = new DbOperations(); 

		if($db->userLogin($_POST['email'], $_POST['password'])){
			$user = $db->getUserByUsername($_POST['email']);
			$response['error'] = false;
                        $response['student'] = true;
                        $response['stuff'] = false; 
			$response['Student_ID'] = $user['Student_ID'];
			$response['Student_Email'] = $user['Student_Email'];
			$response['Student_Name'] = $user['Student_Name'];
                        $response['Section_Number'] = $user['Section_Number'];
                         $response['Section_ID'] = $user['Section_ID'];
                        $response['Group_number'] = $user['Group_number'];
	
                        $response['Name'] = $user['Name'];
                       $response['Department_Name'] = $user['Department_Name'];
		}else if($db->stuffLogin($_POST['email'], $_POST['password'])){
			$user = $db->getStuffByUsername($_POST['email']);

			$response['error'] = false; 
                        $response['student'] = false;
                        $response['stuff'] = true;
                        $response['Teaching_Staff_ID'] = $user['Teaching_Staff_ID'];
			$response['Teaching_Staff_Ssn'] = $user['Teaching_Staff_Ssn'];
			$response['Teaching_Staff_Email'] = $user['Teaching_Staff_Email'];
                        $response['Teaching_Staff_Name'] = $user['Teaching_Staff_Name'];
                        $response['Office_houres'] = $user['Office_houres'];
                        $response['Department_Name'] = $user['Department_Name'];
                        $response['Degree'] = $user['Degree'];
                        $response['Code'] = $user['Code'];
                        $response['Position_ID'] = $user['Position_ID'];
                        $response['room_name'] = $user['room_name'];
                        $response['Name'] = $user['Name'];
                        
              }
            else if($db->youthcare($_POST['email'], $_POST['password'])){

			$user = $db->getyouthcaredatea($_POST['email']);
			$response['error'] = false; 
                        $response['student'] = false;
                        $response['stuff'] = false;
                         $response['care'] = true;
                         $response['UserID'] = $user['UserID'];
                        $response['userName'] = $user['userName'];
                        $response['userPassword'] = $user['userPassword'];
                           $response['type'] = $user['type'];



			   }
                        


                   else{
			$response['error'] = true; 
			$response['message'] = "Invalid username or password";	      		
		}

	}else{
		$response['error'] = true; 
		$response['message'] = "userlogin  Required fields are missing";
	}
}

echo json_encode($response,JSON_UNESCAPED_UNICODE);


