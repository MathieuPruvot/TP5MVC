
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Traitement inscription</title>
        <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
		<p></p>
		<table>
		<tr>
            <th>ID</th>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Age</th>
			<th>Date de naissance</th>
			<th></th>
			<th></th>
		</tr>
		<?php
		foreach ($allClients as $row):
		?>
			<tr>
				<td>  <?php echo $row["ID"] ?></td>
                <td>  <?php echo $row["Nom"] ?></td>
				<td>  <?php echo $row["Prenom"] ?> </td>
				<td>  <?php echo $row["Age"] ?> </td>
				<td>  <?php echo $row["DateN"] ?> </td>
				<td>
				    <form action="controleur.php" method="post">
                        <input type="hidden" value ="supprime" name="action"/>
                        <input type="hidden" value ="<?php echo($row["ID"]) ?>" name="user_id"/>
                        <input type="submit" value="Supprimer"/>
                    </form>
				</td>
				<td>
                    <form action="controleur.php" method="post">
                        <input type="hidden" value ="modifie" name="action"/>
                        <input type="hidden" value ="<?php echo($row["ID"]); ?>" name="user_id"/>
                        <input type="hidden" value ="<?php echo($row["Nom"]) ?>" name="user_nom"/>
                        <input type="hidden" value ="<?php echo($row["Prenom"]) ?>" name="user_prenom"/>
                        <input type="hidden" value ="<?php echo($row["Age"]) ?>" name="user_age"/>
                        <input type="hidden" value ="<?php echo($row["DateN"]) ?>" name="user_date"/>
                        <input type="submit" value="Modifier"/>
                    </form>
				</td>
			</tr>
			<?php 
		endforeach;
		?>
		</table>
        <form action="controleur.php" method="post">
                        <input type="hidden" value ="" name="action"/>
                        <input type="submit" value="Accueil"/>
            </form>
    </body>
</html>
