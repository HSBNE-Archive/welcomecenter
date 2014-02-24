<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Beam me up Scotty!</title>
<link rel="stylesheet" href="/res/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/res/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./colors/color1/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script src="/res/bootstrap/js/bootstrap.min.js"></script>
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
<a type="button" class="btn btn-default btn-block btn-lg" href="newform.php"><i class="glyphicon glyphicon-plus fa-lg"></i> I am a first time visitor.
<a type="button" class="btn btn-default btn-block btn-lg" href="repeatvisitor.php"><i class="glyphicon glyphicon-plus-sign"></i> I'm back, baby. (Return Visitor)</a>
<a type="button" class="btn btn-primary active btn-block btn-lg" href="signup.php"><i class="glyphicon glyphicon-user"></i> I want to sign up as a member.</a>
</div>	
<div class="list-group col-md-8">
<p> To become a member, please fill in this expression of interest form:</p>
<form class="form-horizontal" role="form" action="https://docs.google.com/spreadsheet/formResponse?formkey=ckJkaU1nWldWazd4MkZTamJfbFFjNFE6MQ&theme=0AX42CRMsmRFbUy02YWQwYTNiZC04Yjc1LTRkNWUtYTQ4My03Y2NlZmY1NjMzZjM&ifq" target="iframe_joinform" method="post">
<div class="input-group margin-bottom-sm col-md-6">
  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
	<input type="text" name="entry.2.single" required="required" class="form-control input-lg" placeholder="Full Name" />
</div>
<div class="input-group margin-bottom-sm col-md-6">
  <span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>
	<input type="text" name="entry.3.single" required="required" class="form-control input-lg" placeholder="Handle / Nickname" />
</div>
<div class="input-group margin-bottom-sm col-md-6">
<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
	<input type="email" name="entry.4.single" required="required" class="form-control input-lg" placeholder="Email" />
</div>
<div class="input-group margin-bottom-sm col-md-6">
  <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
	<input type="text" name="entry.5.single" class="form-control input-lg" pattern="\d{8,10}" placeholder="Phone Number" />
</div>
<div class="btn-group btn-group-justified btn-group-lg">
<label class="btn btn-default"><input type="radio" name="entry.7.single" value="Working" id="option1"><i class="fa fa-cogs"></i> Working</label>
<label class="btn btn-default"><input type="radio" name="entry.7.single" value="Student" id="option2" /><i class="fa fa-book"></i> Studying</label>
<label class="btn btn-default"><input type="radio" name="entry.7.single" value="Unemployed" id="option2" /><i class="fa fa-spinner"></i> Unemployed</label></h3>
</div>
		<input type="hidden" name="pageNumber" value="0" />
	<input type="hidden" name="backupCache" value="" />
	<input type="hidden" name="submit" value="Submit" />
	<button type="submit" name="" class="btn btn-block btn-success btn-med"><i class="glyphicon glyphicon-user"></i> Apply</button>
</form>
        <div class="thanks hidden alert alert-success">
          You're on our list, congratulations!
        </div>
</div>
<div class="col-xs-6 col-md-4"></div>
</div>
<div id="virtualKeyboard"></div>
</body>
</html>

