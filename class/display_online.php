<?php
require_once('class.user.php');
class Userstatus{

	private $db;
		public function __construct(){
			   $this->db= DB::getInstance();
		
			if(mysqli_connect_errno()) {
	 
				echo "Error: Could not connect to database.";
	 
			exit;
 
			}
		}


		  public function online_users($username){
			if($username){
		      $sql="SELECT * FROM user_online WHERE username='$username'";
			  $check= $this->db->query($sql);
			  $count_row = $check->num_rows;
			  if($count_row == 0) {
				$sql1="INSERT INTO user_online SET username='$username'";
				$result = $this->db->query($sql1) or die($this->db->connect_errno()."Data cannot inserted");
			  }
						
			}

		 }


		 public function offline_users($username){
		    if($username){
			   $sql="SELECT * FROM user_online WHERE username='$username'";
			   $check= $this->db->query($sql);
			   $count_row = $check->num_rows;
				   
				if($count_row != 0) {
				  $sql1="DELETE FROM user_online WHERE username='$username'";
				  $result = $this->db->query($sql1) or die($this->db->connect_errno()."Data cannot delete");

				}
			}

		 }


}


?>