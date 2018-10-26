
<?php

require('modele.php');

if (isset($_POST)) {
     require('vue.php');
}
else {
    echo 'Erreur : aucun identifiant de billet envoyé';
}

?>
