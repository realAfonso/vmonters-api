<?

	function getTrailmonEmptyScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_EMPTY",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharNeemon(),
			"text" => "Desculpe, mas você não tem nenhum Trail Ticket de viagem...",
			"firstActionType" => "END_SCENE_WITHOUT_SAVE",
			"firstButton" => "Voltar",
			"firstAction" => "TRAILMONSTATIONHAKASE_EMPTY"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getTrailmonHakaseScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_001",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharNeemon(),
			"text" => "Olá! Eu sou o Neemon, sou o responsável por conferir os Trail Tickets para lhe ajudar a achar o Trailmon correto...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Jijimon me mandou aqui",
			"firstAction" => "TRAILMONSTATIONHAKASE_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_002",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharNeemon(),
			"text" => "Ah! O prefeito Jijimon mandou você aqui?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Isso",
			"firstAction" => "TRAILMONSTATIONHAKASE_003"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_003",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharNeemon(),
			"text" => "Imagino que seja para buscar o Prof. Hakase. Ele está chegando no próximo Trailmon...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Ok",
			"firstAction" => "TRAILMONSTATIONHAKASE_004"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_004",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharTrailmon(),
			"text" => "N E E M O N ! !",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_005"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_005",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharTrailmon(),
			"text" => "O Prof. Hakase está aqui! Mas ele está um pouco diferente, ele não está bem!!",
			"firstActionType" => "NEXT_SCENE_WITHOUT_SAVE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_006"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_006",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumonDark(),
			"text" => "ME SOLTEM, EU PRECISO IR EU PRECISO SAIR DAQUI!!",
			"firstActionType" => "NEXT_SCENE_WITHOUT_SAVE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_007"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_007",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharNeemon(),
			"text" => "Essa não! Precisamos segurar ele, ele está atacando todos!!",
			"firstActionType" => "NEXT_SCENE_WITHOUT_SAVE",
			"firstButton" => "Deixe comigo!",
			"firstAction" => "TRAILMONSTATIONHAKASE_008"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_008",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumonDark(),
			"text" => "ME SOLTEM!! G R R R ! !",
			"firstActionType" => "START_BATTLE",
			"firstButton" => "Batalhar",
			"firstAction" => "HAKASEAGUMONDARK,TRAILMONSTATIONHAKASE_009"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_009",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumon(),
			"text" => "Ué... onde eu estou?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Na estação dos Trailmons",
			"firstAction" => "TRAILMONSTATIONHAKASE_010"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_010",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharNeemon(),
			"text" => "Você estava descontrolado Prof. Hakase, estava atacando todo mundo!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_011"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_011",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumon(),
			"text" => "Eu não lembro de nada... Não sei nem como vim parar aqui...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_012"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_012",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumon(),
			"text" => "A última coisa que me lembro e de estar no meu laboratório...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_013"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_013",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumon(),
			"text" => "Essa não! Eu devo voltar ao meu laboratório, não posso deixar minhas pesquisas sozinhas!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATIONHAKASE_014"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_014",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumon(),
			"text" => "E você, garoto que me salvou, pode vir me ver no meu laboratório, quero lhe agradecer!",
			"firstActionType" => "UNLOCK_PLACES_AND_NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "HAKASELAB,TRAILMONSTATIONHAKASE_015"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TRAILMONSTATIONHAKASE_015",
			"background" => getBackgroundTrailmonStation(),
			"image" => getCharHakaseAgumon(),
			"text" => "Até mais!",
			"firstActionType" => "END_SCENES",
			"firstButton" => "Voltar",
			"firstAction" => "TOWNHALLJIJIROOMHAKASE_END,TRAILMONSTATIONHAKASE_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

?>