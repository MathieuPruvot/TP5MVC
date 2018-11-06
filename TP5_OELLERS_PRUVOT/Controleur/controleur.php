<?php
require_once('..\conf.php');
require_once('..\autoload.php');

date_default_timezone_set('Europe/Paris'); // paramétrage de la timezone pour la fonction strtotime()

//fonction de controle sur les données client en POST
function controleDonneesForm(){ // appelle les tests sur chaque type de données du formulaire
	return (testAge() && testNom() && testPrenom() && testDate()) ;
	echo "Test";
}
//controle sur l'age en POST
function testAge(){ // test la bonne forme de la donnée age
	return ($_POST['user_age']!='' && is_numeric($_POST['user_age']) && $_POST['user_age']> 0);
}
//controle sur la date en POST
function testDate(){ // test la bonne forme de la donnée date
	return (preg_match( '^[0-9]{4}\-[0-9]{2}\-[0-9]{2}^' , $_POST['user_date']) && strtotime($_POST['user_date']));
}
//controle sur le nom en POST
function testNom(){ // test la bonne forme de la donnée nom
	return ($_POST['user_nom']!='' && is_string($_POST['user_nom']));
}
//controle sur prenom en POST
function testPrenom(){ // test la bonne forme de la donnée prenom
	return $_POST['user_prenom']!='' && is_string($_POST['user_prenom']);
}
//controle sur l'id en POST
function controleId(){
	return ( isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id']) );
}

//initialisation des variables
$client= new Client('','','','',''); //Classe client pas encore créée
$erreur= '';
$action='insert';
$allClients='';
$user_id = '';
$user_nom = '';
$user_prenom = '';
$user_age = '';
$user_date = '';

// fonction de création du client avec les données passées en POST
// les données sont déjà controlées
function nouveauclient(){
	return new Client($_POST['user_nom'], $_POST['user_prenom'], $_POST['user_age'], $_POST['user_date']); //constructeur class Client
}

// fonction de création du client pour modification
// les données en POST sont déjà controlées en amont 
function modifClient(){
	$modClient = nouveauClient();
	$modClient->setId($_POST['user_id']); // ajout de l'id
	return $modClient;
}


//routeur sur les vues
if(isset($_POST)){
	//var_dump($_POST);
	if(empty($_POST) || empty($_POST['action'])) {// controle si données post est vide
		require('..\Vues\formulaire.php'); // appelle la vue formulaire
	}
	else{
		if (controleId()){ 
			$id = $_POST['user_id']; // récup l'id s'il existe
		}
		$db=Database::getInstance();  // établi la connexion à la BDD
		$action=$_POST['action'];

		switch ($action){ // vérifie l'action demander
			case 'affiche':
				$allClients=$db->getAllClients(); //demande à la db de donner tout les clients sous forme de tableau de tableau
				require('..\Vues\tableau.php');
				break;
			case 'insert':
				if(!controleDonneesForm()){
					$erreur='une ou plusieurs données erronées ';
					require('..\Vues\formulaire.php'); // appelle la vue du formulaire
				}
				else{
					$doublon =$db->selectClientsParNom($_POST['user_nom']);
					var_dump($doublon);
					if(!$doublon){
						$client = nouveauclient();
						$db->insertClient($client); //demande d'insérer le client dans la db
						$allClients=$db->getAllClients(); //demande à la db de donner tout les clients sous forme de tableau de tableau
						require('..\Vues\tableau.php');
					}
					else 
						$erreur= "doublon";
						require('..\Vues\formulaire.php'); // appelle la vue du formulaire
				}
				break;
			case 'modifie':
				if (!controleId() || !controleDonneesForm()){
					$erreur='erreur sur les données du client à modifier';
					$allClients=$db->getAllClients();
					require('..\Vues\tableau.php');
				}
				else{
					$ModifClient = modifClient();
					$user_id = $ModifClient->user_id;
					$user_nom = $ModifClient->user_nom;
					$user_prenom = $ModifClient->user_prenom;
					$user_age = $ModifClient->user_age;
					$user_date = $ModifClient->user_date;	
					$action='update';
					require('..\Vues\formulaire.php');
				}
				break;
			case 'supprime':
				if (!controleId()){
					$erreur='erreur sur les données du client à supprimer';
				}
				else{
					$db->supprimeClient($id); //demande à la db de supprimer le client 
				}
				$allClients=$db->getAllClients();
				require('..\Vues\tableau.php');
				break;
			case'update':
				if (!controleId() || !controleDonneesForm()){
					$erreur='une ou plusieurs données erronées ';
					require('..\Vues\formulaire.php');
				}
				else{
					$client = modifClient();
					$db->updateClient($client); //demande modification du client
					$allClients=$db->getAllClients();
					require('..\Vues\tableau.php');
				}
			default:
				break;
		}
		echo $erreur;
	}	
}
?>

