<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) ){
		
               $db = new DbOperations(); 
                        $user = $db->getStuffByUsername($_POST['email']);
                        $response['error'] = false; 
                        $response['student'] = false;
                        $response['stuff'] = true;
                        $response['position_id'] =  $user['Position_ID'];
			$response['ssn'] = $user['Teaching_Staff_Ssn'];
			$response['email'] = $user['Teaching_Staff_Email'];
                        $response['name'] = $user['Teaching_Staff_Name'];
                        $response['houres'] = $user['Office_houres'];
                        $response['depatrment'] = $user['Department_Name'];
                        $response['degree'] = $user['Degree'];
                        $response['roomcode'] = $user['Code'];
                        $response['roomname'] = $user['room_name'];
                        $response['position'] = $user['Name'];

}
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);

?>

