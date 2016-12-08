<?php
	session_start();
	include_once 'class/class.user.php';
	include_once 'class/Validate.php';
	$user = new User();

	if (isset($_POST['submit'])) { 
		//extract($_POST);
		$emailusername=$_POST['emailusername'];
		$password=$_POST['password'];
		$validate= new Validate();
		$validation=$validate->check($_POST, array(
              'emailusername'=>array(
                      'required'=>true,
                      'min'=>4
              	),
              'password'=>array(
                      'required'=>true,
                      'min'=>4
              	)
			));
        if($validation->passed()) {
		    $login = $user->check_login($emailusername, $password);
		    if ($login) {
		        // Registration Success
		       header("location:home.php");
		    } else {
		        // Registration Failed
		        echo 'Wrong username or password';
		    }
	
        }
        else{
        	foreach($validation->errors() as $error){
                echo $error, '<br>';
             }
        }

	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>OOP Login Module</title>
		<style>
            #container{width:400px; margin: 0 auto;}
		</style>
		<script language="javascript" type="text/javascript"> 
            
            /*function submitlogin() {
                var form = document.login;
				if(form.emailusername.value == ""){
					alert( "Enter email or username." );
					return false;
				}
				else if(form.password.value == ""){
					alert( "Enter password." );
					return false;
				}	 
			}*/
		</script>
	</head>

	<body>
		<div id="container">
			<h1>Login Here</h1>
			<form action="" method="post" name="login">
				<table>
					<tr>
						<th>UserName or Email:</th>
						<td><input type="text" name="emailusername" required></td>
					</tr>
					<tr>
						<th>Password:</th>
						<td><input type="password" name="password" required></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="submit" value="Login" onclick="return(submitlogin());"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><a href="registration.php">Register new user</a></td>
					</tr>
					
				</table>
			</form>
		</div>
	</body>
</html>