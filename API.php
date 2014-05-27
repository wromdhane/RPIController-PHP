<?php
	class API{
    		public function connect($data){
			if(isset($data["user"]) && isset($data["password"])){
				$user = $data["user"];
				$password = $data["password"];
				if($this->isUser($user, $password)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}

		private function isUser($user, $password){
			$file = fopen ("user.json", "r");
    		$file_content = fread ($file, filesize('user.json'));
    		fclose ($file);
 
    		$users = json_decode ($file_content);
    		for($i=0; $i<sizeof($users); $i++){
    			$temp_user = $users[$i]->user;
    			$temp_password = $users[$i]->password;
    			if( $user == $temp_user && $password == $temp_password){
    				return true;
    				break;
    			}
    		}
		}

		public function executeGET(){
			$nb_files = 0;
			$script_list = array();
			if($directory = opendir("./config")){
				while(false !== ($file = readdir($directory)))
				{
					if(!is_dir("./config/".$file))
					{
						$file_content = file_get_contents("./scripts/".$file);
						$json = json_decode($file_content);
						$script = array("id" => $file, "name" => $json->name, "args" => $json->args);
						$script_list[$nb_files] = $script;
						$nb_files++;
					}
				}
				closedir($directory);
				$result = array("result" => $script_list, "error" => "");
				$json = json_encode($result);
				echo $json;
			}else{
				$result = array("result" => "", "error" => "Probleme interne");
				$json = json_encode($result);
				echo $json;
			}
		}
	}
?>
