<?php

session_start();
require_once('../class/class.user.php');
require_once('../class/display_online.php');

    $uid = $_SESSION['uid'];
    $user = new User();
    $onlineuser= new Userstatus();
if (isset($_GET['q']) or $uid==null){
        $user->user_logout();
        header("location: ../login.php");
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=1024">
<title>AJAX Chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="/lib/cmn_img/favicon.ico">
<link rel="stylesheet" href="../lib/cmn_css/normalize.css" media="all">
<link rel="stylesheet" href="../lib/cmn_css/base.css" media="all">
<link rel="stylesheet" href="../lib/cmn_css/component.css" media="all">
<link rel="stylesheet" href="css/uniq.css" media="all">
<link rel="stylesheet" href="../lib/font-awesome/font-awesome.min.css" media="all">
<link rel="stylesheet" href="../lib/cmn_css/print.css" media="print">
<link rel="stylesheet" href="../lib/cmn_css/sp.css" media="all">

<script src="/lib/cmn_js/import.js" charset="UTF-8"></script>
  <link href="chat.css" rel="stylesheet" type="text/css" />
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="chat.js" >  </script> 
  <script type="text/javascript" src="../js/online.js" >  </script> 
  <script type="text/javascript" >  




   </script> 
  
</head>
  <body onload="init();" id="pageTop">
  <div id="wrap">

    <noscript>
      Your browser does not support JavaScript!!
    </noscript>
  <nav id="gNav">
     <ul>
      <li class="li01"><a href="/"><span>NOTICE</span></a></li>
      <li class="li02"><a href="/"><span>DISCUSSION</span></a></li>
      <li class="li03"><a href="/"><span>VOTING</span></a></li>
      <li class="li04"><a href="/"><span>CHAT</span></a></li>
      <li class="li05"><a href="/"><span>PROFILE</span></a></li>
      <li class="li06"><a href="indexc.php?q=logout"><span>LOGOUT</span></a></li>
   </ul>
  </nav>
<div id="breadchumbs">
   <p> <a href="/">TOP</a>&nbsp;&gt;&nbsp; <strong></strong> </p>
</div>
<div class="container">
    <table id="content">
      <tr>
        <td>
          <div id="scroll">
          </div>
        </td>
        <td id="colorpicker">
          <p><img src="palette.png" id="palette" alt="Color 
               Palette" border="1" onclick="getColor(event);"/>
          </p>
          <input id="color" type="hidden" readonly="true" value="#000000" />
          <span id="sampleText">
            (text will look like this) <?php echo  $_SESSION['uname'];?>
          </span>
        </td>

        <td>
              <div>
              <p>Online User </p>
              
               <p id="onlineUsers"> </p>
              
              </div>
        </td>
      </tr>
    </table>

    <div>
      <input type="text" id="userName" maxlength="10" size="10" disabled value = <?php echo  $_SESSION['uname']; ?> />
      <input type="text" id="messageBox" maxlength="2000" size="50" 
             onkeydown="handleKey(event)"/>
      <input type="button" value="Send" onclick="sendMessage();" />
      <input type="button" value="Delete All" onclick="deleteMessages();" />
    </div>
</div>




    <script type="text/javascript" charset="utf-8">
    function addmsg(msg){
        /* Simple helper to add a div.
        type is the name of a CSS class (old/new/error).
        msg is the contents of the div */
       $("#onlineUsers").html(
            "<div>"+ msg +"</div>"
        );

        //$("#messages").innerHTML=msg;
    }

    function waitForMsg(){
        /* This requests the url "onlinusers.php"
        When it complete (or errors)*/
        $.ajax({
            type: "GET",
            url: "../onlinusers.php",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                addmsg(data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    waitForMsg, /* Request next message */
                    1000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    waitForMsg, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    };

    $(document).ready(function(){
        waitForMsg(); /* Start the inital request */
    });
    </script>
  </div>
  </body>


</html>
