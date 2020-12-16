<?

	function getTownhallJijiRoomEmptyScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TOWNHALLJIJIROOM_EMPTY",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "O prefeito está um pouco ocupado agora <USERNAME>, volte outra hora se puder...",
			"firstActionType" => "END_SCENE_WITHOUT_SAVE",
			"firstButton" => "Voltar",
			"firstAction" => "TOWNHALLJIJIROOM_EMPTY"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getTownhallJijiRoomHakaseScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASE_001",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Esperamos que você consiga trazer o Prof. Hakase de volta...",
			"firstActionType" => "END_SCENE_WITHOUT_SAVE",
			"firstButton" => "Voltar",
			"firstAction" => "TOWNHALLJIJIROOMHAKASE_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getTownhallJijiRoomHakaseSaveScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_001",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "<USERNAME>!! Como foi com o Prof. Hakase, tudo bem?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Na verdade...",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_002",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => ". . .",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => ". . .",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_003"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_003",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Entendo... acho que devemos investigar melhor isso Tentomon!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_004"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_004",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Certo senhor prefeito! Vou solicitar que os White Omegas investiguem o que pode ser isso!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Ok",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_007",
			"secondActionType" => "NEXT_SCENE",
			"secondButton" => "White Omegas?",
			"secondAction" => "TOWNHALLJIJIROOMHAKASESAVE_005"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_005",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Os White Omegas são os Tamers de elite...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_006"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_006",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Só quem já é muito experiente e formado na academia pode participar do Exame Omega para se tornar um White Omega.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_007"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_007",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Odeio ter que acionar eles... mas não tem outro jeito.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_008"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLJIJIROOMHAKASESAVE_008",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Por hora é isso, muito obrigado pela sua ajuda <USERNAME>!",
			"firstActionType" => "END_SCENE",
			"firstButton" => "Voltar",
			"firstAction" => "TOWNHALLJIJIROOMHAKASESAVE_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

?>