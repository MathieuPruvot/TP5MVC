
<?php

require('modele.php');

if (isset($_POST)) {
     require('postView.php');
}
else {
    echo 'Erreur : aucun identifiant de billet envoyé';
}

?>
