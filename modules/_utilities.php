<?

	function createNewPassword($size = 5)
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
		//$caracteres .= $simb;

		$len = strlen($caracteres);
		for ($n = 1; $n <= $size; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

	function getRandomRarity()
	{
		return getRarity(rand(1,100));
	}

	function getRarity($value)
	{
		if($value >= 1 && $value <= 5) return "ULTRARARE";
		if($value >= 6 && $value <= 20) return "RARE";
		if($value >= 21 && $value <= 50) return "UNCOMMON";
		if($value >= 51 && $value <= 100) return "COMMON";
	}

?>