<?

	function getHackmonScene()
	{
		$scenes = array();

		$place = array(
			"id" => "HACKMON_001",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Então você voltou <USERNAME>... Quer trocar seu brasão por 200$ agora?",
			"firstActionType" => "CHOISES",
			"firstButton" => "Escolher novo brasão",
			"firstAction" => "Courage,Friendship,Love,Knowledge,Sincerity,Reliability,Hope,Light,Kindness,Destiny,Miracles,HACKMONOCRESTCHANGE,HACKMON_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMON_002",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Sempre bom fazer negócios com você... até logo!",
			"firstActionType" => "END_SCENE_WITHOUT_SAVE",
			"firstButton" => "Voltar",
			"firstAction" => "HACKMON_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getHackmonFirstScene()
	{
		$scenes = array();

		$place = array(
			"id" => "HACKMONFIRST_001",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Olha só... alguém acordado essa hora...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HACKMONFIRST_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_002",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Meu nome é Hackmon... eu sou um Appmon.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HACKMONFIRST_005",
			"secondActionType" => "NEXT_SCENE",
			"secondButton" => "Appmon?",
			"secondAction" => "HACKMONFIRST_003"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_003",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Appmon é como um Digimon... mas digamos que eu venho de outro universo.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HACKMONFIRST_004"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_004",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Consegui encontrar o código fonte deste mundo, e abri um portal para cá.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HACKMONFIRST_005"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_005",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Sou especialista em hackear coisas... eu poderia hackear algo pra você...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HACKMONFIRST_006"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_006",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Por um preço, é claro.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HACKMONFIRST_007"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_007",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Você não gostaria de trocar seu brasão por 200$ agora?",
			"firstActionType" => "CHOISES",
			"firstButton" => "Escolher novo brasão",
			"firstAction" => "Courage,Friendship,Love,Knowledge,Sincerity,Reliability,Hope,Light,Kindness,Destiny,Miracles,HACKMONOCRESTCHANGE,HACKMONFIRST_008"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "HACKMONFIRST_008",
			"background" => getBackgroundHackmonApp(),
			"image" => getCharHackmonApp(),
			"text" => "Obrigado por fazer negócio comigo... até logo!",
			"firstActionType" => "END_SCENE",
			"firstButton" => "Voltar",
			"firstAction" => "HACKMONFIRST_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

?>