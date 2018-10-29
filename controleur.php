<?php
require_once('Database.php');

date_default_timezone_set('Europe/Paris'); // paramétrage de la timezone pour la fonction strtotime()

function controleDonneesForm(){ // appelle les tests sur chaque type de données du formulaire
	return (testAge() && testNom() && testPrenom() && testDate()) ;
}
function testAge(){ // test la bonne forme de la donnée age
	return ($_POST['user_age']!='' && is_numeric($_POST['user_age']) && $_POST['user_age']> 0);
}
function testDate(){ // test la bonne forme de la donnée date
	return (preg_match( '^[0-9]{4}\-[0-9]{2}\-[0-9]{2}^' , $_POST['user_date']) && strtotime($_POST['user_date']));
}
function testNom(){ // test la bonne forme de la donnée nom
	return ($_POST['user_nom']!='' && is_string($_POST['user_nom']));
}
function testPrenom(){ // test la bonne forme de la donnée prenom
	return $_POST['user_prenom']!='' && is_string($_POST['user_prenom']);
}
function controleId(){
	return ( isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id']) );
}

$fantome= new Client('','','','','');
$erreur= '';

clientForm(){
	return new Client($_POST['user_nom'],$_POST['user_prenom'],$_POST['user_age'], $_POST['user_datNais']);
}

modifClient(){
	$modifC=clientForm();
	$modif.setId($_POST['user_id']);
	return $modif
}

if(isset($_POST)){
	if(empty($_POST) || empty($_POST['action'])// controle si données post est vide
		require('formulaire.php');
	else{
		if (controleId()){
			$id = $_POST['user_id'];
		}
		$db=Database::getInstance();
		$action=$_POST['action'];
		switch ($action){ // vérifie l'action demander
			case 'affiche':
				$clients=$db->selectClientsParNom($nom);
				require('vueTableau.php')
			case 'insert':
				if(!controleDonneesForm()){
					$erreur='une ou plusieurs données erronées ';
					require('formulaire.php');
				}
				else{
					$client= nouveauclient();
					$db->insertClient($client);
					$allClients=$db->getAllClients();
					require('vueTableau.php');
				}
			case 'modifie':
				if (!controleId() || !controleDonneesForm()){
					$erreur='erreur sur les données du client à modifier';
					$allClients=$db->getAllClients();
					require('vueTableau.php');
				}
				else{
					$client=modifClient();
					require('formulaire.php');
				}
				break;
			case 'supprime':
				if (!controleId() || !controleDonneesForm()){
					$erreur='erreur sur les données du client à modifier';
				}
				else{
					$client=modifClient();
					$db->supprimeClient($client);
				}
				$allClients=$db->getAllClients();
				require('vueTableau.php');
				break;
			case'update':
				if (!controleId() || !controleDonneesForm()){
					$erreur='une ou plusieurs données erronées ';
					require('formulaire.php');
				}
				else{
					$client=modifClient();
					$db->updateClient($client);
					$allClients=$db->getAllClients();
					require('vueTableau.php');
				}
			default:
				break;
		}
	}	
}
?>

