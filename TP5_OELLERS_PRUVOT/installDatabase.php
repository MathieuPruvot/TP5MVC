<?php 
require_once('conf.php');
require_once('autoload.php');

	$db=Database::getConnect();
	$db->createDB(DBNAME);
	$db->useDb(DBNAME);
	$attributs=[
	['ID' => 'INT AUTO_INCREMENT'],
	['Nom'=> 'VARCHAR(50)'],
	['Prenom'=> 'VARCHAR(50)'],
	['Age'=> 'VARCHAR(50)'],
	['DateN'=> 'DATE']
	];
	$primary=['ID'];
	$db->createTable(DBNAME,$attributs,$primary,'');
?>