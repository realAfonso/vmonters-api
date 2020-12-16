<?

	function getHakaseLabBuyScene()
	{
		$scenes = array();

		$place = array(
			"id" => "HAKASELABBUY_001",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Olá <USERNAME>! Trouxe mais DigiDatas para mim?",
			"firstActionType" => "START_DIGIDATA_SAIL",
			"firstButton" => "Vender DigiDatas",
			"firstAction" => "HAKASELABBUY_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getHakaseLabFirstScene()
	{
		$scenes = array();

		$place = array(
			"id" => "HAKASELABFIRST_001",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Ah olá, humano!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Olá",
			"firstAction" => "HAKASELABFIRST_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_002",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "No corre-corre acabei esquecendo de lhe perguntar seu nome...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => ". . .",
			"firstAction" => "HAKASELABFIRST_003"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_003",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "<USERNAME>, claro!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_004"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_004",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Eu sou muito ocupado, sabe...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_005"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_005",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Neste laboratório eu estudo as DigiDatas, e os efeitos delas nos Digimons e no DigiMundo como um todo.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Entendo",
			"firstAction" => "HAKASELABFIRST_011",
			"secondActionType" => "NEXT_SCENE",
			"secondButton" => "O que são as Digidatas?",
			"secondAction" => "HAKASELABFIRST_006"
		);
		array_push($scenes, $place);

		//-------------------------------------------------------- O QUE SÃO DIGIDATAS

		$place = array(
			"id" => "HAKASELABFIRST_006",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Uma DigiData é uma energia que emana de um brasão.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_007"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_007",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Quando essa energia está com muita força e é feita uma conexão entre dois portadores de brasões, ela se torna sólida...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_008"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_008",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Criando pequenos cristais que nós chamamos de DigiDatas.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_009"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_009",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Sabemos que esses cristais podem ser usados para evoluir alguns Digimons...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_010"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_010",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Mas acredito que não conhecemos todo o poder das DigiDatas, e por isso estudo elas todos os dias!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_011"
		);
		array_push($scenes, $place);

		//-------------------------------------------------------- FIM

		$place = array(
			"id" => "HAKASELABFIRST_011",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Aliás, eu preciso de muitas DigiDatas, já que estudo elas todos os dias e faço vários experimentos...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_012"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_012",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Se você tiver DigiDatas para vender, vou ficar feliz em comprar!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELABFIRST_013"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HAKASELABFIRST_013",
			"background" => getBackgroundHakaseLab(),
			"image" => getCharHakaseAgumon(),
			"text" => "Agora preciso ir, deixei minhas DigiDatas no forno! Até mais!!",
			"firstActionType" => "END_SCENE",
			"firstButton" => "Voltar",
			"firstAction" => "HAKASELABFIRST_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

?>