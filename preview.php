<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Contact us Forms in Php and Css</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h2>Simple Contact us Forms using Php and Css</h2>
<?php 
if(isset($_POST['sendmail'])){
	$name = $_POST['name'];	
	$email = $_POST['email'];	
	$website = $_POST['website'];	
	$subject = $_POST['subject'];	
	$message = $_POST['message'];
	$to = "support@urphp.com";	// << write your own email here
	if(empty($name) OR empty($email) OR empty($subject) OR empty($message)){
	echo "<div class='errors'>Sorry, You must fill the required fields<strong>(*)</strong></div>";
	}else{
	@mail($to,$subject,$message,"From: $name  <$email>");
	echo "<div class='done'>Email has been sent, we will get back to you ASP!</strong></div>";
	}
}?>
<form action="" class="form" method="post" name="contactus">
<fieldset>
<legend>Your Info</legend>
<label>Name</label><input name="name" type="text" size="45" /><br />
<label>Email</label><input name="email" type="text" size="45" /><br />
<label>Website</label><input name="website" type="text" size="45" /><br />
</fieldset>
<fieldset>
<legend>Your Message</legend>
<label>Subject</label><input name="subject" type="text" size="45" /><br />
<label>Message</label><textarea name="message" cols="35" rows="7"></textarea>
</fieldset>
<input name="sendmail" type="submit" value="Send Email" />
</form>
</body>
</html>