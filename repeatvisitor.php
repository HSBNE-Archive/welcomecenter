<?php

include 'printme.php';

$con = mysql_connect("localhost","root","hsbne");

mysql_select_db("doorlog", $con);

if ( array_key_exists( 'element_1', $_POST )  || array_key_exists( 'element_2', $_POST ) ) { 

//print "this page is not implemented yet - TODO<br>";

// visid = visitor id
if ( array_key_exists('element_1',$_POST) ) { 
$visid = $_POST['element_1'];
} else { $visid = 0; }

// email as alt lookup:
if ( array_key_exists('element_2',$_POST) ) { 
$emaillookup = $_POST['element_2'];
} else { $emaillookup = ''; }

// tru using an ID: 
if ( $visid != 0 )  { 

$sql = "SELECT * from visitorcentre where visitor_rego_no = '$visid' ";

} else {  // otherwise try email search
$sql = "SELECT * from visitorcentre where email = '$emaillookup' ";

}

$result = mysql_query($sql);

if ( mysql_num_rows($result)  < 1 ) {

print '<html><body><h1><a href="/welcomecentre/index.php"><-- Start Over <--</a></h1>';
print "<h1>Sorry, no visitor ID found with that info, sorry.</h1>\n";
print '</body></html>';
exit();

}


$visitcount = 0; // default to zero

while ($row = mysql_fetch_assoc($result)) {
 $first = $row['first'];
 $last = $row['last'];
 $email = $row['email'];
 $nick = $row['nick'];
 $subscribe = $row['subscribe'];
 $visid = $row['visitor_rego_no']; // if doing search-by-email we need this populated here
 $ts = $row['ts'];
 $visitcount = $row['visitcount'];
}

$visitcount++; // whatever it was before, its 1 bigger now.

$sql = "UPDATE visitorcentre SET visitcount=$visitcount  WHERE visitor_rego_no = '$visid' ";

$result = mysql_query($sql);

print '<html><body><h1><a href="/welcomecentre/index.php"><-- Start Over <--</a></h1>';
print "<h1>Thanks $first $last ( $nick )  for Visiting Us again!<br>You have now visited <font color=orange>$visitcount</font> times</h1>\n";
$url = 'http://10.0.1.253/welcomecentre/thanks.php';
print "<h1><a href='$url'>PLEASE CLICK HERE TO CONTINUE</a></h1><br>";

// reprint, but only if user used their email, not by scanning...

if ( array_key_exists('element_2',$_POST)  && $_POST['element_2'] != '' ) {
print "<h1> Reprinting your Visitor ID now: ........ ";
printme($visid, $first, $last, $email,$nick,$subscribe,'');
print "done</h1><br>\n";
}
print '</body></html>';


} else {

//
//[please scan your ID]
//
//TODO [increment your visitor count]
//
//TODO [you have now visited us X times]
//
//TODO thanks!
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Returning Visitor?</title>
<link rel="stylesheet" type="text/css" href="./colors/color1/view.css" media="all">
<link rel="stylesheet" href="/res/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/res/font-awesome/css/font-awesome.min.css">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript">
window.onload
=
function()
{
document.getElementById("element_1").focus();
} 
</script>


<script src="js/jquery.js"></script>
<script src="js/longpoll.js"></script>
   <style type="text/css" media="screen">
body { font-size:1.5em; }
    </style>

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
<a type="button" class="btn btn-default btn-block btn-lg" href="newform.php"><i class="glyphicon glyphicon-plus fa-lg"></i> I am a first time visitor.
<a type="button" class="btn btn-primary btn-block btn-lg active" href="repeatvisitor.php"><i class="glyphicon glyphicon-plus-sign"></i> I'm back, baby. (Return Visitor)</a>
<a type="button" class="btn btn-default btn-block btn-lg" href="signup.php"><i class="glyphicon glyphicon-user"></i> I want to sign up as a member.</a>
</div>
<div class="list-group col-md-8">
<form id="form_567974" class="appnitro"  method="post" action="repeatvisitor.php">
<div class="form_description">
<h4>Please either scan your visitor ID or please enter your email address.</h4>
</div>						
	<div class="input-group margin-bottom-sm">
		 <span class="input-group-addon"><i class="fa fa-barcode fa-fw fa-2x"></i></span>
		<input id="element_1" name="element_1" class="input-lg form-control" type="text" maxlength="255" value="" placeholder="Scan your VISITOR ID here" /> 
</div>
<p class="input-group margin-bottom-sm btn disabled btn-block">OR</p>
	<div class="input-group margin-bottom-sm">
  		<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw fa-2x"></i></span>
		<input id="element_2" name="element_2" class="form-control input-lg" type="text" maxlength="255" value="" placeholder="Type Your Email Address" /> 
	</div>
   <input type="hidden" name="form_id" value="567974" />
<input id="saveForm" class="btn btn-success btn-block" type="submit" name="submit" />

		</form>	
	</div></div>
</body>
</html>
<?php }  ?>
