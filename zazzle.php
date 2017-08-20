<?php

namespace zazzle\patches;

use zazzle\core\Registry;
require_once("patches.php");
Registry::register_module("patches");


use zazzle\core\classes\Config;

	class patchesConfig extends Config{
		
		public $TemplateDir = "Template/";
		public static $TemplateAliases = [];
		
		public function __construct(){
			parent::__construct(__DIR__."/config.json");
		}
		
		public function config(){
			patchesConfig::$TemplateAliases = json_decode(file_get_contents($this->TemplateDir."alias.json"), true);
		}
		
		function get_manifest(){
			return ["CONFIG_HASH", "TemplateDir"];
		}
				
		function get_hash_exclution(){
			return ["CONFIG_HASH"];
		}
	}

	
function inset_bootstrap_cdn(){
	echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
}

function inset_jquery_cdn(){
	echo "<script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>";
}
	
?>