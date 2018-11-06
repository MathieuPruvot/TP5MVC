                                              CONSIGNES D'UTILISATION


Aller dans fichier conf.php afin de définir :
<ul>
      <li>USER = nom d'utilisateur pour s'identifier à la BDD ('root' par défaut);</li>
      <li>PASS = mot de passe pour s'identifier à la BDD ('root' par défaut);</li>
      <li>HOST = adresse de la BDD ('localhost' par défaut);</li>
      <li>DBNAME = nom donné à la BDD que l'on va utilisé ('client' par défaut);</li>
      <li>TABLENAME = nom de la table utilisé pour la gestion des clients ('client' par défaut);</li>
</ul>
   <br/>
   <br/>
Une fois le fichier conf correctement renseigné, appeler le fichier installDatabase.php à la racine du dossier pour effectuer les action suivante :
<ul>
   <li> Créer la DATABASE nommée DBNAME ( ATTENTION si la DATABSE existe déjà elle sera DROP avant d'être recréée)</li>
   <li> Execute la commande USE DATABASE DBNAME pour sélectionner la base créer précédemment</li>
   <li> Créer la TABLE commée TABLENAME ( ATTENTION si la TABLE existe déjà elle sera DROP avant d'être recréée)</li>
</ul>    
   <br/>
   <br/>
Une fois l'install passé sans erreur alors faire appelle au controleur au chemin suivant: <br/>
    TP5_OELLERS_PRUVOT/Controleur/controleur.php
   <br/>
   <br/>
Il n'y plus qu'à gérer votre base de donnée de clients ! 
