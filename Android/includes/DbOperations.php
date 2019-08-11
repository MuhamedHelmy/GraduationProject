<?php 

	class DbOperations{

		private $con; 

		function __construct(){

			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();

		}

		/*CRUD -> C -> CREATE */

/*__________________________________Create user___________________________________________________*/


	    	public function createUser($username, $pass, $email){
			if($this->isUserExist($username,$email)){
				return 0; 
			}else{
				$password = md5($pass);
				$stmt = $this->con->prepare("INSERT INTO `users` (`id`,`username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");
				$stmt->bind_param("sss",$username,$password,$email);

				if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
			}
		}
/*_________________________________Student login________________________________*/

		public function userLogin($Student_Email, $Student_password){
			$pass= sha1($Student_password);
			$stmt = $this->con->prepare("SELECT student.Student_Name  FROM student WHERE student.Student_Email=? and student.Student_Password=? ");
			$stmt->bind_param("ss",$Student_Email,$pass);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}

/*___________________________________get student data by mail__________________________________*/

		public function getUserByUsername($Student_Email){
			$stmt = $this->con->prepare("SELECT student.Student_ID,SSN,student.Student_Name,student.Student_Email,section.Section_Number,section.Section_ID,section.Group_number,academic_year.Name,department.Department_Name from student JOIN section JOIN academic_year_department join academic_year join department where student.Section_ID=section.Section_ID AND section.Academic_Year_Depatment_ID=academic_year_department.ID and academic_year_department.Academic_Year_ID=academic_year.ID and academic_year_department.Department_ID=department.Department_ID AND student.Student_Email= ? " );
			$stmt->bind_param("s",$Student_Email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		



/*______________________________________Stuff Login ____________________________________*/


                   public function stuffLogin($Student_Email, $Student_password){
			$pass= sha1($Student_password);
			$stmt = $this->con->prepare("SELECT teaching_staff.Teaching_Staff_Name FROM teaching_staff WHERE teaching_staff.Teaching_Staff_Email=? and teaching_staff.Teaching_Staff_Password= ? ");
			$stmt->bind_param("ss",$Student_Email,$pass);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}






/*___________________________________get Stuff data by mail________________________________________________*/


        public function getStuffByUsername($Student_Email){
			$stmt = $this->con->prepare("SELECT teaching_staff.Teaching_Staff_ID,teaching_staff. 	Position_ID,teaching_staff.Teaching_Staff_Ssn,teaching_staff.Teaching_Staff_Name,teaching_staff.Teaching_Staff_Email,teaching_staff.Office_houres, department.Department_Name ,scientific_degree.Degree,room.Code,room.Name As room_name ,position.Name from teaching_staff JOIN department JOIN scientific_degree JOIN room join position where teaching_staff.Department_id =department.Department_ID AND teaching_staff.Scientific_Degree_ID=scientific_degree.Scientific_Degree_ID AND room.Room_ID=teaching_staff.Room_ID and position.ID= teaching_staff.Position_ID and teaching_staff.Teaching_Staff_Email=? ");
			$stmt->bind_param("s",$Student_Email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}


/*---------------------------------- youth_Care----------------------------*/

public function youthcare($Student_Email, $Student_password){
			$pass= sha1($Student_password);
			$stmt = $this->con->prepare("SELECT * FROM `student_affairs` WHERE type = 'youth_care'  and userEmail =? AND userPassword=? ");
			$stmt->bind_param("ss",$Student_Email,$pass);
			$stmt->execute();
			$stmt->store_result(); 

			return $stmt->num_rows > 0; 
		}


public function getyouthcaredatea($Student_Email){
			//$pass= sha1($Student_password);
			$stmt = $this->con->prepare("SELECT * FROM `student_affairs` WHERE type = 'youth_care'  and userEmail =? AND userPassword=?  ");
			$stmt->bind_param("s",$Student_Email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}









	
	
}


