<?php

    /**
     * @author Filipe Mansano <filipemansano@gmail.com>
     */

    require "vendor/autoload.php";

    // https://developers.facebook.com/apps/APP_ID/settings/basic/
	$fb = new \Facebook\Facebook([
		'app_id' 				=> 'APP_ID',
		'app_secret' 			=> 'APP_SECRET',
		'default_graph_version' => 'v2.10',
	]);
    
    // https://developers.facebook.com/tools/explorer
	$facebookPageInfos = [
		'acess_token' => 'PAGE_TOKEN'
	];

	try {
        
        // https://developers.facebook.com/docs/graph-api/reference/v2.10/post
		$publishData = [
            'message'   => "Depois de Spectre e Meltdown, Spoiler é nova vulnerabilidade encontrada nas CPUs da fabricante. Chips AMD estariam imunes.",
            'link'      => "https://noticiaplus.com.br/noticia/pesquisadores-encontram-falha-spoiler-em-processadores-intel.html",
		];

		$responseFB = $fb->post("/feed", $publishData , $facebookPageInfos['acess_token']);
        $graphNode = $responseFB->getGraphNode()->asArray();
        
        $id = explode("_", $graphNode['id']);

        echo "Noticia publicada -> https://www.facebook.com/PAGENAME/posts/{$id[1]}";

	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		throw new \Exception('Graph retornou o seguinte erro: ' . $e->getMessage());
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		throw new \Exception('Facebook SDK retornou o seguinte erro: ' . $e->getMessage());
	} catch(\Exception $e) {
		throw new \Exception('Erro: ' . $e->getMessage());
    }
    
?>