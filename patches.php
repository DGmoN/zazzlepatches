<?php

namespace zazzle\patches;

global $PatchStack;
$PatchStack = [];

function add_stack($name, $path){
	global $PatchStack;
	$PatchStack[$name] = $path;
}

function stitch($alias){
	global $PatchStack;
	if($alias[0] == "@"){
		$alias = $PatchStack[substr($alias, 1, strlen($alias)-1)];
	}
	
	$data = patchesConfig::$TemplateAliases;
	$path = explode(":", $alias);
	$path = array_reverse($path);
	$current = $data;
	
	while(is_array($current)){
		$find = array_pop($path);
		//echo "finding ".$find."<br>";
		
		$current = find($find, $current);
		if(!$current){ 
		echo $alias;
		die("No thing here");};
	}
	require(\zazzle\core\Registry::$MODULES['patches']->TemplateDir.$current);
	
}

function find($target, $stack){
		foreach($stack as $k=>$v){
			if($k === $target){
				return $v;
			}
		}
		return false;
}

?>