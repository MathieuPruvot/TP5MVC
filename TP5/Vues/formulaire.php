<!DOCTYPE html>

<html>
	<head>
		<style>
		#formulaire input{
			position: absolute;
			left: 150px;
		}
		form div{
			margin: 5px;
			display:block;
			height:20px;
		}
		table{
			width: 800px;
			text-align:center;
		}
		</style>
	</head>
	<body>
<!-- affichage du formulaire de base -->
<form id="formulaire" action="controleur.php" method="post">
				<div>
					<label for="name">Nom :</label>
					<input type="text" id="nom" value="<?php echo $client[1]; ?>" name="user_nom">
				</div>
				<div>
					<label for="mail">Prenom:</label>
					<input type="text" id="prenom" value="<?php echo $client[2]; ?>" name="user_prenom">
				</div>
				<div>
					<label for="msg">Age:</label>
					<input type="number" id="age" value="<?php echo $client[3]; ?>" name="user_age">
				</div>
				<div>
					<label for="msg">Date de naissance:</label>
					<input type="date" id="date" value="<?php echo $client[4]; ?>" name="user_date">
				</div>
				<div>
					<input type="hidden" value ="<?php echo $action ?>" name="action"/>
					<?php if($action=='update'): ?>
					<input type="hidden" value ="<?php echo $client[0]; ?>" name="user_id"/>
					<?php endif; ?>
					<input type="submit" value="<?php echo $action ?> donnée"/>
				</div>
			</form>
		
		<!-- formulaire pour demander l'affichage de la table -->
			<form action="" method="post">
				<input type="hidden" value ="affiche" name="action"/>
				<input type="submit" value="Afficher tableau"/>
			</form>
		
		
	</body>
</html>
