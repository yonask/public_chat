<?php 
	require_once(dirname(__DIR__).'/database/DB.php');
	require_once(dirname(__DIR__).'/database/Database.php');
	require_once('display_online.php');
	require_once('Hash.php');
    
	class User{
		private $db,$database;
		public function __construct(){
			   $this->db= DB::getInstance();
		
			if(mysqli_connect_errno()) {
	 
				echo "Error: Could not connect to database.";
	 
			exit;
 
			}
		}

        /*** for registration  process ***/
		public function registrationUser($tablename, $parameter_order, $values) {
				  
	                   $this->database= new Database();
	                   return $this->database->insert($tablename, $parameter_order, $values);
		}


	      

			/*** for login process ***/

		public function check_login($emailusername, $password){
	        	
	             // checking the user name or the email available in the table
				$sql2="SELECT * from users WHERE uemail='$emailusername' or uname='$emailusername'";
				
			   	$result = $this->db->query($sql2);
	        	$user_data = $result->fetch_assoc();
	        	$count_row = $result->num_rows;
			
		        if ($count_row == 1) {
		            // retrive the salt from the database
		            $salt=$user_data['salt'];
		            $passwordnew=Hash::make($password,$salt);
		            // if the new password hash equvalent with the database password login OKay
		            if($passwordnew===$user_data['password']) {
			            $_SESSION['login'] = true; 
			            $_SESSION['uid'] = $user_data['uid'];
			            $_SESSION['uname']=$user_data['uname'];
			            $user_name= $_SESSION['uname'];
		                // add user from online status 
			            $onlineuser = new Userstatus();
			            $onlineuser->online_users($user_name);
			            return true;
		           }
		        }
		        else{
				    return false;
				}
	    }

    	/*** for showing the username or fullname ***/
    	public function get_fullname($uid){
    		$sql3="SELECT fullname FROM users WHERE uid = $uid";
	        $result = $this->db->query($sql3);
	        $user_data = $result->fetch_assoc();
	        echo $user_data['fullname'];
    	}
  
    	/*** starting the session ***/
	    public function get_session(){    
	        return $_SESSION['login'];
	    }

	    public function user_logout() {
	    	$username=$_SESSION['uname'];
	    	// remove user from online status 
	    	$offlineuser = new Userstatus();
	    	$offlineuser->offline_users($username);
	        $_SESSION['login'] = FALSE;
	        session_destroy();
	    }

	
		public function get($rule_value,$item, $value){
		      $_query = "SELECT * FROM {$rule_value} WHERE {$item} = '$value'";
		    
		          $result = $this->db->query($_query);
		          $user_data = $result->fetch_assoc();
		          $count_row = $result->num_rows;
		    
		     if($count_row==1){
		       return true;
		     }else 
		      return false;
	    }

    }
?>