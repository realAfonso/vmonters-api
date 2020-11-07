<?php 

	function sendMessage($push) {

	    $fields = json_encode($push);

	    $auth = "Authorization: Basic ZTFmMGUxMWMtNTc4ZS00NTZlLWE0YzUtMDhiNWMzNGQ2ZWIx";
	    
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	    $response = curl_exec($ch);
	    curl_close($ch);
	    
	    return $response;
	}

	function preparePush($dados)
	{

		if(!empty($dados['title']) && !empty($dados['message'])){

			try {

			    $contents = array();
			    $contents['en'] = $dados['message'];
			    $contents['pt'] = $dados['message'];

				/* array para enviar dados extras ao app,
				adicione nesse array tudo que for considerado
				dados extras, ou seja, que não for parâmetro
				para a onesignal, mas que deve ser entregue ao app */
				$data = array();

				/* cria o objeto do push que será enviado */
				$push = array(
			      'app_id' => "66f2d6e2-e493-4ab4-a19f-8c3cd718426a",
		      	  'included_segments' => array('All'),
			      'contents' => $contents
			    );

				/* verifica se o push vai ser enviado para
				um usuário específico ou não */
				if(!empty($dados['filter'])){
					$push['filters'] = array();
					array_push($push['filters'], $dados['filter']);
				}

				$sufix = "dsv";

				/* configura o ambiente para produção */
			    if (strpos($_SERVER["HTTP_HOST"], "dsv") === false) {
			    	$sufix = "prd";
				}

		    	$operator = array(
		    		"operator" => "AND"
		    	);

				$ambient = array(
						"field" => "tag", 
						"key" => "ambient", 
						"relation" => "=", 
						"value" => $sufix
				);

				array_push($push['filters'], $operator);
				array_push($push['filters'], $ambient);

				/* verifica se o push vai ser enviado agora,
				ou em uma hora pré-definida pelo usuário */
				if(!empty($dados['date'])){
					$push['send_after'] = $dados['date'].' GMT-0300';
				}

				/* verifica se o push vai ser enviado
				para dispositivos com iOS */
				if(!empty($dados['ios'])){
					$push['isIos'] = true;
					$push['ios_badgeType'] = 'Increase';
					$push['ios_badgeCount'] = '1';
				}

				/* verifica se o push vai ser enviado
				para dispositivos com Android */
				if(!empty($dados['android'])){
					$push['isAndroid'] = true;
				}

				/* verifica se existe uma url para
				ser enviada ao aplicativo */
				if(!empty($dados['url'])){
					$push['url'] = $dados['url'];
				}

				/* verifica se existe uma imagem para
				ser enviada ao aplicativo */
				if(!empty($dados['image'])){
					$push['big_picture'] = $dados['image'];
				}
			   
			   	/* cria o título do push com o que foi informado
			   	se o título vier sem nada, carrega o nome do
			   	app no lugar do título do push */
			    $headings = array();

			    if(!empty($dados['title'])){
				    $headings['en'] = $dados['title'];
				    $headings['pt'] = $dados['title'];
			    }else{
				    $headings['en'] = "DigiColle";
				    $headings['pt'] = "DigiColle";
			    }

			    $push['headings'] = $headings;

			    /* cria o subtítulo do push com o que foi informado
			   	se o subtítulo vier sem nada, não será enviado */
			    $subtitle = array();

			    if(!empty($dados['subtitle'])){
				    $subtitle['en'] = $dados['subtitle'];
				    $subtitle['pt'] = $dados['subtitle'];
			    	$push['subtitle'] = $subtitle;
			    }

				$response = sendMessage($push);

				//print_r($response);

			  	/* mostra o retorno da onesignal na tela
			  	por favor, não remova esse código */
			  	/*$return["allresponses"] = $response;
				$return = json_encode($return);

				$data = json_decode($response, true);
				print_r($data);
				$id = $data['id'];
				print_r($id);

				print("\n\nJSON received:\n");
				print($return);
				print("\n");*/	

			}catch(Exception $e) {
				//code
			}
			
		} else {
			//code
		}
	}
?>
