<?
	ini_set("memory_limit","500M");
	header('Content-type: application/json');
	date_default_timezone_set("America/Recife");

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");
	include("../../../class/specie.php");
	include("../../../class/crest.php");

	include("_opponents.php");

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$return = array();
	$return[success] = true;
	$return[response] = array();

	$challenger = getUser($data[challengerId]);

	$c1 = $challenger[buddy];
	$c2 = getOpponent($data[opponentId]);

	$return[response][challenger] = $challenger;
	$return[response][opponent] = $c2;

	$ad1 = advantage($c1, $c2);
	$ad2 = advantage($c2, $c1);

	$mon1 = array();
	$mon2 = array();

	$adv1 = 0;
	$adv2 = 0;

	$hp1 = 0;
	$hp2 = 0;

	$mon1desc = "";
	$mon2desc = "";

	if($c1[spd] > $c2[spd]){
		$mon1 = $c1;
		$mon2 = $c2;
		$hp1 = $c1[hp];
		$hp2 = $c2[hp];
		$adv1 = $ad1;
		$adv2 = $ad2;
		$mon1desc = "CHALLENGER";
		$mon2desc = "OPPONENT";
	}else{
		$mon1 = $c2;
		$mon2 = $c1;
		$hp1 = $c2[hp];
		$hp2 = $c1[hp];
		$adv1 = $ad2;
		$adv2 = $ad1;
		$mon2desc = "CHALLENGER";
		$mon1desc = "OPPONENT";
	}

	$return[response]["steps"] = array();

	$bits = 0;

	while($mon1[hp]>0 && $mon2[hp]>0){
		$hp2 = $mon2[hp];
		$mon2 = atack($mon1, $adv1, $mon2);

		$dam = $hp2 - $mon2[hp];

		$step = array();
		$step[attacker] = $mon1desc;
		$step[damage] = $dam;

		$bits = $bits + $dam;

		array_push($return[response][steps], $step);

		if($mon2[hp]>0){
			$hp1 = $mon1[hp];
			$mon1 = atack($mon2, $adv2, $mon1);

			$dam = $hp1 - $mon1[hp];

			$step = array();
			$step[attacker] = $mon2desc;
			$step[damage] = $dam;

			$bits = $bits + $dam;

			array_push($return[response][steps], $step);
		}

	}

	if($mon1[hp]>0) $return[response][winner] = $mon1desc;
	else $return[response][winner] = $mon2desc;

	if($return[response][winner] == "CHALLENGER"){
		$return[response][bits] = intval($bits * 90 / 100);
	}else{
		$return[response][bits] = intval($bits * 10 / 100);
	}

	print_r(pretty_json(json_encode($return)));

	function atack($attacker, $advantage, $defender)
	{
		$atk = 0;
		$def = 0;

		if($attacker[atk] > $attacker[spatk]){
			$atk = $attacker[atk];
			$def = $defender[def];
		}else if($attacker[atk] == $attacker[spatk]){
			if($defender[def] >= $defender[spdef]){
				$atk = $attacker[spatk];
				$def = $defender[spdef];
			}else{
				$atk = $attacker[atk];
				$def = $defender[def];
			}
		}else{
			$atk = $attacker[spatk];
			$def = $defender[spdef];
		}

		$atk = intval(getAdvantageNumber($atk));
		$def = intval(getAdvantageNumber($def));

		$atk = intval($atk + ($atk * $advantage / 100));

		$ratk = $atk - $def;
		if($ratk <= 0) $ratk = 1;

		$hp = intval($defender[hp] - $ratk);

		if($hp <= 0) $hp = 0;

		$defender[hp] = $hp;

		//echo "$attacker[name] atacou com $atk<br>";
		//echo "$defender[name] defendeu com $def<br><br>";
		//echo "$defender[name] levou $ratk de dano<br><br>";

		return $defender;
	}

	function getAdvantageNumber($num)
	{
		$aMaior = $num + 15;
		$aMenor = $num - 15;

		$arand1 = rand($aMenor, $aMaior);
		$arand2 = rand($aMenor, $aMaior);
		$arand3 = rand($aMenor, $aMaior);

		$vant = max($arand1, $arand2, $arand3);
		$desv = min($arand1, $arand2, $arand3);

		$op = rand(1,100);

		if($op >= 51) $num = $vant;
		else $num = $desv;

		$critic = rand(1,100);
		if($critic <= 10) $num = $num * 2;

		return $num;
	}

?>