<?php

function myAutoLoad($classname){
	$appDir =__DIR__ . DIRECTORY_SEPARATOR;
	$codeDirs = array('Modele',);
	
	foreach($codeDirs as $dir){
		$filepath = $appDir.$dir. DIRECTORY_SEPARATOR .$classname.'.php';
		if(is_file($filepath)){
			require_once $filepath;
		}
	}
}
spl_autoload_register('myAutoLoad');
?>