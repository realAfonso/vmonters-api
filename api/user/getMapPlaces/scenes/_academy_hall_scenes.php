<?

	function getAcademyEmptyScene()
	{
		$scenes = array();

		$place = array(
			"id" => "ACADEMYHALLMAYOR_EMPTY",
			"background" => getBackgroundAcademy(),
			"text" => "Não há ninguém aqui no momento...",
			"firstActionType" => "END_SCENE_WITHOUT_SAVE",
			"firstButton" => "Voltar",
			"firstAction" => "ACADEMYHALLMAYOR_EMPTY"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getAcademyMayorScene()
	{
		$scenes = array();

		$place = array(
			"id" => "ACADEMYHALLMAYOR_001",
			"background" => getBackgroundAcademy(),
			"image" => getCharAgumon(),
			"text" => "Hey <USERNAME>!! Temos um visitante na academia hoje, o prefeito Jijimon veio nos visitar!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "ACADEMYHALLMAYOR_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "ACADEMYHALLMAYOR_002",
			"background" => getBackgroundAcademy(),
			"image" => getCharJijimon(),
			"text" => "Olá novato! Eu sou Jijimon, sou o prefeito de Activity City, seja bem vindo!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "ACADEMYHALLMAYOR_003"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "ACADEMYHALLMAYOR_003",
			"background" => getBackgroundAcademy(),
			"image" => getCharJijimon(),
			"text" => "Venha nos visitar na prefeitura, vou adorar receber você.",
			"firstActionType" => "UNLOCK_PLACE_AND_NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALL,ACADEMYHALLMAYOR_004"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "ACADEMYHALLMAYOR_004",
			"background" => getBackgroundAcademy(),
			"image" => getCharJijimon(),
			"text" => "Até porque, acho que a prefeitura vai ser um local que você vai visitar bastante.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "ACADEMYHALLMAYOR_005"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "ACADEMYHALLMAYOR_005",
			"background" => getBackgroundAcademy(),
			"image" => getCharJijimon(),
			"text" => "Nos vemos por ai meu jovem...",
			"firstActionType" => "END_SCENE",
			"firstButton" => "Voltar",
			"firstAction" => "ACADEMYHALLMAYOR_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

?>