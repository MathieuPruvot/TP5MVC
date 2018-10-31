
<?php

class Database {
 
    private static $_instance = null;

    private $cnx;
   
    private function __construct() {  
        //$this->cnx = new PDO("mysql:host = hostname; dbname = database",username, password);
        $this->cnx = new PDO('mysql:host=localhost;dbname=mysql;port=3306;charset=utf8','root','');
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $this->cnx;
            } 
        catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }
   
    public static function getInstance() {
   
        if(is_null(self::$_instance)) {
            self::$_instance = new Database();  
        }
   
        return self::$_instance;
    }

    public function selectClientsParNom($nom) {  //demande à la db de rechercher un client par son nom
        $query = $this->cnx->prepare("SELECT COUNT(*) FROM client WHERE Nom = :Nom");
        $resultat=$query->execute([':Nom' => $nom]);
        return $num_rows = $query->fetchColumn();
    }

    public function insertClient($client) {  //demande d'insérer le client dans la db
        try {
			$inserer = $this->cnx->prepare("INSERT INTO client (Nom, Prenom, Age, DateN) VALUES (:Nom, :Prenom, :Age, :DateN)");
            $inserer->execute(array(':Nom' => $client[0], ':Prenom' => $client[1], ':Age' => $client[2], ':DateN' => $client[3]));      
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		} //return $inserer;
    }

    public function getAllClients() {  //demande à la db de donner tout les clients sous forme de tableau
        $query = $this->cnx->prepare('SELECT * FROM client');
        $query->execute();
        $resultat=$query->fetchAll();
        return $resultat;
       /*
        foreach ($this->cnx->query($resultat) as $row) {
            var_dump($row); // just pour moi pour tester
        }
        */
    }

    public function supprimeClient($id) {  //demande à la db de supprimer le client
        try {
            $sql = "DELETE FROM CLIENT WHERE ID = :ID Limit 1";
            $supprimer=$this->cnx->prepare($sql);
			$supprimer->execute([':ID' =>$id]);
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		} //return $supprimer;
    }

    public function updateClient($client) {  //demande modification du client
        try {
			$mettreajour = $this->cnx->prepare("UPDATE client SET Nom=:Nom, Prenom=:Prenom, Age=:Age, DateN=:DateN WHERE ID = :ID Limit 1");
			$mettreajour->execute(array(':Nom' => $client[1], ':Prenom' => $client[2], ':Age' => $client[3], ':DateN' => $client[4], ':ID' =>$client[0]));
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		} //return $mettreajour;
    }
}

//new Client($_POST['user_nom'],$_POST['user_prenom'],$_POST['user_age'], $_POST['user_datNais']);  //constructeur Client
//$modifClient.setId($_POST['user_id']);  //défini l'id du client
//$db=Database::getInstance();  //établi la connexion à la BDD
//$clients=$db->selectClientsParNom($nom);  //demande à la db de rechercher un client par son nom
//$db->insertClient($client);  //demande d'insérer le client dans la db
//$allClients=$db->getAllClients();  //demande à la db de donner tout les clients sous forme de tableau de tableau
//$db->supprimeClient($client);  //demande à la db de supprimer le client 
//$db->updateClient($client);  //demande modification du client

?>