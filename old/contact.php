<?php
	function ValidateEmail($email)
	{
		$regex = '/([a-z0-9_.-]+)'. # name
		'@'. # at
		'([a-z0-9.-]+){1,255}'. # domain & possibly subdomains
		'.'. # period
		"([a-z]+){2,10}/i"; # domain extension 
		if($email == '') {
			return false;
		}
		else {
			$eregi = preg_replace($regex, '', $email);
		}
		return empty($eregi) ? true : false;
	}

	include 'config.php';

	error_reporting (E_ALL ^ E_NOTICE);

	$post = (!empty($_POST)) ? true : false;

	if($post)
	{
		$name = stripslashes($_POST['name']);
		$email = $_POST['email'];
		$subject = stripslashes($_POST['subject']);
		$message = stripslashes($_POST['message']);
		$error = '';
		if(!$name)
		{
			$error .= '<p>Please enter your name.</p>';
		}
		if(!$email)
		{
			$error .= '<p>Please enter an e-mail address.</p>';
		}
		if($email && !ValidateEmail($email))
		{
			$error .= '<p>Please enter a valid e-mail address.</p>';
		}
		if(!$subject || strlen($subject) < 2)
		{
			$error .= "<p>Please enter the subject.</p>";
		}
		if(!$message || strlen($message) < 2)
		{
			$error .= "<p>Please enter your message.</p>";
		}
		if(!$error)
		{
			$mail = mail(WEBMASTER_EMAIL, $subject, $message,
				 "From: ".$name." <".$email.">\r\n"
				."Reply-To: ".$email."\r\n"
				."X-Mailer: PHP/" . phpversion());
			if($mail)
			{
				echo 'OK';
			}
		}
		else
		{
			echo '<div id="notification" class="error">'.$error.'</div>';
		}
	}
?>