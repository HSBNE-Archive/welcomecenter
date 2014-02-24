<?php    
include 'printme.php';

$con = mysql_connect("localhost","root","hsbne");

mysql_select_db("doorlog", $con);


if ( array_key_exists( 'element_2_1', $_POST ) ) { 

$name1 = $_POST['element_2_1'];
$name2 = $_POST['element_2_2'];
$email = $_POST['element_3'];
$nick = $_POST['element_1'];
$subscribe = $_POST['element_4_1'];

//print "name: $name1 $name2 email: $email nick: $nick sub: $subscribe<br>";

//DONE print visitor label
//http://10.0.0.141/printer.php?printme=hello%20there%20%0Ais%20anybody%20out%20there%0A%20is%20anybody%20listening..

// issue an arbitrary 10 character ID to embed in the barcode: 
$id = str_pad(time(), 05, '0',STR_PAD_LEFT); // 1D barcode must be 10 chars/digits long exctly!

$url = 'http://10.0.1.253/welcomecentre/thanks.php';
printme($id, $name1, $name2, $email,$nick,$subscribe,$url);

//TODO sub userto email list if they asked to be.   to,subject, message


if ( $subscribe == '1') { 


$to      = 'hackerspace_brisbane+subscribe@googlegroups.com';
//$to      = 'davidbuzz@gmail.com';
$subject = 'subscribe request';
$message = 'subscribe';
$nobody = "nobody@hsbne.org"; // not used
$headers = "From: $email" . "\r\n" .
    "Reply-To: $email" . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

#mail($to, $subject, $message, $headers);

queue_mail($to,$subject,$headers,$message);

}

if ( $subscribe != 1 ) { $subscribe = 0; } 


//TODO push user/s details to a mysql databnase, and maybe one day to a google doc too...

// TODO email them users detais ot teh exec, to keep them included..
$message = " welcome centre visitor ID issued: $id
Name:   $name1 $name2
Email: $email
Nick:  $nick
Subscribed to google group?(1=yes, 0=no): $subscribe
";
$nobody = "nobody@hsbne.org"; // not used
$headers = "From: $nobody" . "\r\n" .
    "Reply-To: $nobody" . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

queue_mail('executive@hsbne.org', 'welcome centre visitor id issued', $headers, $message);
//queue_mail('davidbuzz@gmail.com', 'welcome centre visitor id issued', $headers, $message);

// note: the "id" colume is the primary key, and has nothing to do with the $id variable which is  is actually the visitor_rego_no column - whatever.
$sql = "INSERT INTO `visitorcentre` (`id`, `first`, `last`, `email`, `nick`, `sub`, `visitor_rego_no`) VALUES (NULL,'$name1','$name2','$email','$nick','$subscribe','$id')";
#print $sql;
mysql_query($sql);


} else { 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>New Visitor! </title>
<link rel="stylesheet" type="text/css" href="./colors/color1/view.css" media="all">
<link rel="stylesheet" href="/res/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/res/font-awesome/css/font-awesome.min.css">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script src="js/jquery.js"></script>
<script type="text/javascript">
window.onload
=
function()
{
document.getElementById("element_2_1").focus();
}
</script>


<script src="js/jquery.js"></script>
<script src="js/longpoll.js"></script>

   <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        waitForMsg(); /* Start the inital request */
    });
    </script>

</head>
<body id="main_body" >

    <div id="messages">
        <div class="msg alert"></div>
    </div>


<div class="container row" style="float:none; margin-left:auto; margin-right: auto;">
<div class="list-group col-md-4">
<h3><p class="btn-block"><i class="text-danger fa-spin glyphicon glyphicon-fire fa-lg"></i> Welcome to HSBNE! </p></h3>
<a type="button" class="btn btn-primary active btn-block btn-lg" href="newform.php"><i class="glyphicon glyphicon-plus fa-lg"></i> I am a first time visitor.
<a type="button" class="btn btn-default btn-block btn-lg" href="repeatvisitor.php"><i class="glyphicon glyphicon-plus-sign"></i> I'm back, baby. (Return Visitor)</a>
<a type="button" class="btn btn-default btn-block btn-lg" href="signup.php"><i class="glyphicon glyphicon-user"></i> I want to sign up as a member.</a>
</div>
<div class="list-group col-md-8">
<p class="btn disabled margin-bottom-sm btn-block">Please fill out this form with your details!</p>
<form id="form_567974" class="form-horizontal"  method="post" action="newform.php">
<div class="input-group margin-bottom-sm col-md-6">
  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
<input id="element_2_1" name="element_2_1" class="form-control input-lg col-md-7" placeholder="First Name" /></div>
<div class="input-group margin-bottom-sm col-md-6">
<input id="element_2_2" name="element_2_2" class="form-control input-lg col-md-6" placeholder="Last Name" />
</div>
<div class="input-group margin-bottom-sm col-md-12">
  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
<input id="element_3" name="element_3" class="form-control input-lg" type="text" maxlength="255" value="" placeholder="Email"/> 
<span class="input-group-addon">
<label class="margin-bottom-sm"><input id="element_4_1" name="element_4_1" class="" type="checkbox" value="1" /> Join our mailing list!</label>
</span>
</div>
<div class="input-group margin-bottom-sm col-md-12">
  <span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>
<input id="element_1" name="element_1" class="form-control input-lg" type="text" maxlength="255" value="" placeholder="Nickname"/> 
</div>

<input type="hidden" name="form_id" value="567974" />
<input id="saveForm" class="btn btn-block btn-success btn-lg" type="submit" name="submit" value="Submit" />
</form>	
	</div></div>
	</body>
</html>
<?php 
}

function queue_mail($to,$sub,$head,$mess) { 


$sql = "INSERT INTO `doorlog`.`email_queue` (`id`, `to`, `subject`, `headers`, `message`) VALUES (NULL, '$to', '$sub', '$head', '$mess');";
#print $sql;
mysql_query($sql);

}


?>
