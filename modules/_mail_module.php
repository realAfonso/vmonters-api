<?

	function sendMail($to, $subject, $message)
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <no-reply@vmonsters.com>' . "\r\n";

		return mail($to,$subject,$message,$headers);
	}

	function sendVerificationMail($to, $hash)
	{
		$subject = "Verification | VMONSTERS";
		$message = "Welcome to Vmonsters.<br>Please click on the link below to verify your account.<br><br><a href='http://api.vmonsters.com/verify?h=$hash' target='_blank'>Click here to verify your account!</a><br><br>If you have not requested an account in our game, just ignore this email.";

		return sendMail($to, $subject, $message);
	}

	function sendWelcomeMail($to, $name)
	{
		$subject = "Welcome | VMONSTERS";
		$message = "Welcome to Vmonsters $name!<br>I would like to welcome our game and say that we are doing our best to make it better every day.<br><br>I already apologize for any bugs you may face, the game is still in the testing phase and thank you for helping us test it.<br><br>Welcome to Kokeen!";

		return sendMail($to, $subject, $message);
	}

	function sendNewPasswordMail($to, $name, $newPass)
	{
		$subject = "Your new password | VMONSTERS";
		$message = "Hello $name,<br>A new password has been requested for your Vmonsters account, this is your new password:<br><br><b>$newPass</b><br><br>You can exchange it using the profile menu within the Vmonsters app.";

		return sendMail($to, $subject, $message);
	}

?>