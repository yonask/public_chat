<?php

    include_once 'class/class.user.php';
    include_once 'class/Validate.php';
    include_once 'class/Hash.php';
    $user = new User();

    if(isset($_POST['submit'])){
    
        //extract($_POST);
        $fullname=$_POST['fullname'];
        $uname=$_POST['uname'];
        $uemail=$_POST['uemail'];
        $password=$_POST['password'];
        $conform_password=$_POST['conform_password'];

        $validate= new Validate();

        $validation=$validate->check($_POST, array(
                'fullname' => array(
                   'required' => true,
                   'min' => 4
                    ),
                'uname'=> array(
                   'required' => true,
                   'min' => 4,
                   'unique'=>'users'
                    ),
                'uemail' => array(
                   'required' => true,
                   'min' =>4,
                   'email'=>true,
                   'unique'=>'users'
                    ),
                'password'=>array(
                   'required'=> true,
                   'min'=>4
                    ),
                 'conform_password'=>array(
                   'required'=> true,
                   'min'=>4,
                   'matches' => 'password'
                    )
                       
                ));
        if($validation->passed()) {

            $parameter_order = array("`fullname`","`uname`", "`uemail`","`salt`","`password`" );
            $salt=Hash::salt(32);
           
            $password= Hash::make($password,$salt);
            $values = array($fullname,$uname, $uemail, $salt, $password);
            $register=$user->registrationUser("`users`", $parameter_order, $values);
         
            if ($register) {
                    // Registration Success
                    echo 'Registration  successful <a href="login.php">Click here</a> to login';
            }else{
                    // Registration Failed
                    echo 'Registration failed. Email or Username already exits please try again';
                }

        }

        else{
             foreach($validation->errors() as $error){
                echo $error, '<br>';
             }
        }


  }
   
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
      
        <title>Register</title>
		<style>
            #container{width:400px; margin: 0 auto;}
		</style>
		
    </head>
    <body>
        <body>
        <div id="container">
            <h1>Registration Here</h1>
            <form action="" method="post" name="reg">
                <table>
                    <tr>
                        <th>Full Name:</th>
                        <td><input type="text" name="fullname" required></td>
                    </tr>
                    <tr>
                        <th>User Id:</th>
                        <td><input type="text" name="uname" required></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><input type="text" name="uemail" required></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td><input type="password" name="password" required></td>
                    </tr>
                     <tr>
                        <th>Conform Password:</th>
                        <td><input type="password" name="conform_password" required></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="Register" onclick="return(submitreg());"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><a href="login.php">Already registered! Click Here!</a></td>
                    </tr>
                    
                </table>
            </form>
        </div>
    </body>
    </body>
</html>
