                                              CONSIGNES D'UTILISATION

Aller dans fichier conf.php afin de définir :<br/>
      USER = nom d'utilisateur pour s'identifier à la BDD ('root' par défaut);
      PASS = mot de passe pour s'identifier à la BDD ('root' par défaut);
      HOST = adresse de la BDD ('localhost' par défaut);
      DBNAME = nom donné à la BDD que l'on va utilisé ('client' par défaut);
      TABLENAME = nom de la table utilisé pour la gestion des clients ('client' par défaut);
   
Une fois le fichier conf correctement renseigné, appeler le fichier installDatabase.php à la racine du dossier pour effectuer les action suivante :
    Créer la DATABASE nommée DBNAME ( ATTENTION si la DATABSE existe déjà elle sera DROP avant d'être recréée)
    Execute la commande USE DATABASE DBNAME pour sélectionner la base créer précédemment
    Créer la TABLE commée TABLENAME ( ATTENTION si la TABLE existe déjà elle sera DROP avant d'être recréée)
    
Une fois l'install passé sans erreur alors faire appelle au controleur au chemin suivant:
    TP5_OELLERS_PRUVOT/Controleur/controleur.php
    
Il n'y plus qu'à gérer votre base de donnée de clients ! 
