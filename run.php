<?php
	require "API.php";
	$api = new API();
	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		if($api->connect($_POST)){
			$api->executeRUN($_POST);
		}else{
			$result = array( "result" => "", "error" => "Probleme d'authentification.");
			$json = json_encode($result);
			echo $json;
		}
	}
	else{
		$result = array("result" => "", "error" => "Vous devez utiliser la méthode POST");
		$json = json_encode($result);
		echo $json;
	}
?>
