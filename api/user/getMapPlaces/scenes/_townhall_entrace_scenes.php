<?

	function getTownhallEntraceEmptyScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TOWNHALLENTRACE_EMPTY",
			"background" => getBackgroundTownhallEntrage(),
			"text" => "Não há ninguém aqui no momento...",
			"firstActionType" => "END_SCENE_WITHOUT_SAVE",
			"firstButton" => "Voltar",
			"firstAction" => "TOWNHALLENTRACE_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

	function getTownhallEntraceScene()
	{
		$scenes = array();

		$place = array(
			"id" => "TOWNHALLENTRACE_001",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "Olá <USERNAME>, então você veio!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_002"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_002",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "Seja bem vindo a prefeitura!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_003"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_003",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharTentomon(),
			"text" => "PREFEITO JIJIMON!!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_004"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_004",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharTentomon(),
			"text" => "Ainda bem que o senhor chegou, temos um problema, o Prof. Hakase desapareceu!!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_005"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_005",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "O que!?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_006"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_006",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "Não acredito que mais um desapareceu...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_007"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_007",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => ". . .",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_008"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_008",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "Ah <USERNAME>! Este é Tentomon, ele é o meu assistente pessoal...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_009"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_009",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharTentomon(),
			"text" => "Muito prazer <USERNAME>! Desculpe minha pressa, mas estamos entrando em pânico com os habitantes de Activity City desaparecendo...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_010"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_010",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "Acho que devemos conversar no meu gabinete Tentomon, isto não é assunto para ser tratado aqui na rua...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_011"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_011",
			"background" => getBackgroundTownhallEntrage(),
			"image" => getCharJijimon(),
			"text" => "Venha conosco <USERNAME>, talvez você possa nos ajudar!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_012"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_012",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Esta é a minha sala, <USERNAME>.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_013"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_013",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Teoricamente ela é a sala do prefeito, mas eu gosto de chama-la de Jiji Room!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_014"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_014",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "HA HA HA HA ... Cof... Cof...",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_015"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_015",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Senhor prefeito, por favor, foco!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_016"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_016",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "<USERNAME>, os Digimons que vivem em Activity City estão indo embora... nós não sabemos o que está acontecendo, mas eles fazem isso involuntariamente.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_017"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_017",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Bom... nós sabemos onde o Prof. Hakase está?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_018"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_018",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Sim! Na estação dos Trailmons nos disseram que ele foi para Cooly Plain.",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_019"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_019",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Ótimo!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_020"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_020",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => ". . .",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_021"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_021",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "...e agora?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_022"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_022",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Agora a gente manda alguém buscar ele, senhor!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_023"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_023",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Isso! Mande alguém buscar ele!!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_024"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_024",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharTentomon(),
			"text" => "Já mandei senhor! Ele deve estar chegando na estação em poucos minutos!",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TOWNHALLENTRACE_025"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_025",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "<USERNAME>, você poderia fazer o favor de ir receber o Prof. Hakase e tentar convencê-lo a ficar em Activity City?",
			"firstActionType" => "NEXT_SCENE",
			"firstButton" => "Claro!",
			"firstAction" => "TOWNHALLENTRACE_026"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_026",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Ótimo! Vá até a estação dos Trailmons, ela fica ao norte de Activity City.",
			"firstActionType" => "UNLOCK_PLACES_AND_NEXT_SCENE",
			"firstButton" => "Próximo",
			"firstAction" => "TRAILMONSTATION,TOWNHALL_JIJIROOM,TOWNHALLENTRACE_027"
		);
		array_push($scenes, $place);

		$place = array(
			"id" => "TOWNHALLENTRACE_027",
			"background" => getBackgroundTownhallJijiRoom(),
			"image" => getCharJijimon(),
			"text" => "Esperamos que você consiga trazer o Prof. Hakase de volta...",
			"firstActionType" => "END_SCENE",
			"firstButton" => "Voltar",
			"firstAction" => "TOWNHALLENTRACE_END"
		);
		array_push($scenes, $place);

		return $scenes;
	}

?>