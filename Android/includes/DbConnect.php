<?php 

	class DbConnect{

		private $con; 

		function __construct(){

		}

		function connect(){
			include_once dirname(__FILE__).'/Constants.php';
                          $SQL= 'SET CHARACTER SET utf8';
			   $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        mysqli_query($this->con,$SQL); 
 

			if(mysqli_connect_errno()){
				echo "Failed to connect with database".mysqli_connect_err(); 
			}

			return $this->con; 
		}
	}
