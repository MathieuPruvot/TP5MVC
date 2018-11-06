<?php
class Database {
 
    private static $_instance = null;
    private $cnx;
   
    private function __construct() {  
        //$this->cnx = new PDO("mysql:host = hostname; dbname = database",username, password);
        $this->cnx = new PDO('mysql:host='.HOST.';charset=utf8',USER,PASS);
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $this->cnx;
            } 
        catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }
	
	public static function getConnect() {
        if(is_null(self::$_instance)) {
            self::$_instance = new Database();  
        }
        return self::$_instance;
    }
   
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new Database();  
        }
		self::$_instance->useDB(DBNAME);
        return self::$_instance;
    }
	
	public function createDB($db){
		$newDB="DROP DATABASE IF EXISTS ".$db."; CREATE DATABASE ".$db.";";
		var_dump($newDB);
		$this->cnx->exec($newDB);
	}
	
	public function useDb($dbname){
		$this->cnx->exec("USE ".$dbname);
	}
	
	public function createTable($tableName,$attributs,$primary,$foreign){
		$newTable='CREATE TABLE '.$tableName.' (';
		foreach ($attributs as $key => $line){
			foreach ($line as $name => $type){
				$newTable.= $name.' '.$type.',';
			}
		}
		$newTable.= 'PRIMARY KEY (';
		foreach ($primary as $key => $name)
			$newTable.= $name;
		$newTable.= '));';
		$this->cnx->exec($newTable);
	}
	
    public function selectClientsParNom($nom) {  //demande à la db de rechercher un client par son nom
        $query = $this->cnx->prepare("SELECT COUNT(*) FROM client WHERE Nom = :Nom");
        $resultat=$query->execute([':Nom' => $nom]);
        return $num_rows = $query->fetchColumn();
    }
    public function insertClient($client) {  //demande d'insérer le client dans la db
        try {
			$inserer = $this->cnx->prepare("INSERT INTO client (Nom, Prenom, Age, DateN) VALUES (:Nom, :Prenom, :Age, :DateN)");
            $inserer->execute(array(':Nom' => $client->get_user_nom(), ':Prenom' => $client->get_user_prenom(), ':Age' => $client->get_user_age(), ':DateN' => $client->get_user_date()));      
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
			$mettreajour->execute(array(':ID' => $client->get_user_id(), ':Nom' => $client->get_user_nom(), ':Prenom' => $client->get_user_prenom(), ':Age' => $client->get_user_age(), ':DateN' => $client->get_user_date()));
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		} //return $mettreajour;
    }
}

?>
