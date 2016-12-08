<?php

require_once('class/class.user.php');

class Userstatus1{

	public $db;
		public function __construct(){
			//$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

			    $this->db= DB::getInstance();
		}
	}

	$user1 = new Userstatus1();



$user1->db= DB::getInstance();

$sql="SELECT username  FROM user_online";
			
				$display=$user1->db->query($sql);
			
             
				$count_row=$display->num_rows;
				if($count_row!=0) {
					while($user_data=$display->fetch_assoc()){
					  $username=$user_data['username'];

                          
					  echo $username . "<br>";}}


?>

					 