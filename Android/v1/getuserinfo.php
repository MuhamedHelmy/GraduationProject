<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) ){
		
               $db = new DbOperations(); 
	       $user = $db->getUserByUsername($_POST['email']);
			$response['error'] = false;
                        $response['student'] = true;
                        $response['stuff'] = false; 
                         $response['SSN'] = $user['SSN'];
			$response['Student_ID'] = $user['Student_ID'];
			$response['Student_Email'] = $user['Student_Email'];
			$response['Student_Name'] = $user['Student_Name'];
                        $response['Section_Number'] = $user['Section_Number'];
                         $response['Section_ID'] = $user['Section_ID'];
                        $response['Group_number'] = $user['Group_number'];
                        $response['Name'] = $user['Name'];
                       $response['Department_Name'] = $user['Department_Name'];


}
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>
