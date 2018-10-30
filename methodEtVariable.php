Fonctions du modèle appelées dans controleur.php:

  .  new Client($_POST['user_nom'],$_POST['user_prenom'],$_POST['user_age'], $_POST['user_datNais']);  //constructeur Client
  .  $modifClient.setId($_POST['user_id']);  //défini l'id du client
  .  $db=Database::getInstance();  //établi la connexion à la BDD
  .  $clients=$db->selectClientsParNom($nom);  //demande à la db de rechercher un client par son nom
  .  $db->insertClient($client);  //demande d'insérer le client dans la db
  .  $allClients=$db->getAllClients();  //demande à la db de donner tout les clients sous forme de tableau de tableau
  .  $db->supprimeClient($client);  //demande à la db de supprimer le client 
  .  $db->updateClient($client);  //demande modification du client
  
  
Variables mise à disposition par le controleur pour les vues

  . vue tableaau :  _ $action // contient l'action demandé
                    _ $erreur // contient les messages d'erreur si besoin 
                    _ $allClients // contient tout les clients de la base
  . vue formulaire :  _ $action // contient l'action demandé
                      _ $erreur // contient les messages d'erreur si besoin 
                      _ $client // contient le client passé en POST si existe
