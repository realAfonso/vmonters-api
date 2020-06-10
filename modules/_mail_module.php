<?

	function sendMail($to, $subject, $message)
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <no-reply@redigitize.com.br>' . "\r\n";

		return mail($to,$subject,$message,$headers);
	}

	function sendVerificationMail($to, $hash)
	{
		$subject = "Verification | VMONSTERS";
		$message = "Welcome to Vmonsters.<br>Please click on the link below to verify your account.<br><br><a href='http://redigitize.com.br/vmonsters/verify?h=$hash' target='_blank'>Click here to verify your account!</a><br><br>If you have not requested an account in our game, just ignore this email.";

		return sendMail($to, $subject, $message);
	}

?>