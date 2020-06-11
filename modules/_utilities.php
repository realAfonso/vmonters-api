<?

	function createNewPassword($size = 8)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';

		$retorno = '';
		$caracteres = '';

		$caracteres .= $lmin;
		$caracteres .= $lmai;
		$caracteres .= $num;
		$caracteres .= $simb;

		$len = strlen($caracteres);
		for ($n = 1; $n <= $size; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

?>