<?php
    session_start();
    include_once 'class/class.user.php';
    $user = new User();

    $uid = $_SESSION['uid'];
    $uname = $_SESSION['uname'];

    if (!$user->get_session()){
       header("location:login.php");
    }

 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Home</title>
		<style>
    		body{
    			font-family:Arial, Helvetica, sans-serif;
    		}
    		h1{
    		    font-family:'Georgia', Times New Roman, Times, serif;
    		}
		</style>
    </head>

    <body>
        <div id="container">
            <div id="header">
            
                <a href="chat/indexc.php">CHAT</a>
            </div>
            <div id="main-body">
    			<br/><br/><br/><br/>
    			<h1>
                  Hello <?php $user->get_fullname($uid); ?>
    			</h1>	
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
