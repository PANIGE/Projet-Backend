<?php

/*
 * Ce fichier source est un projet réalisé pour une formation Believemy.
 *
 * Il a généreusement été créé par Charlotte, une étudiante d'une de nos formations.
 * Merci énormément à elle pour sa contribution ! :)
 */

//ENVOI DE FICHIERS PHP
if(isset($_FILES['image']) && $_FILES['image']['error'] ==0){  //l'image existe et a été stockée temporairement sur le serveur

	if ($_FILES['image']['size']<= 3000000){ //l'image fait moins de 3MO

		$informationsImage = pathinfo($_FILES['image']['name']);
		$extensionImage = $informationsImage['extension'];
		$extensionsArray = array('png', 'gif', 'jpg', 'jpeg'); //extensions qu'on autorise

		if(in_array($extensionImage, $extensionsArray)){  // le type de l'image correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur

			move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.time().basename($_FILES['image']['name'])); // on renomme notre image avec une clé unique suivie du nom du fichier

			echo 'Envoi bien réussi !' ;

		}
	}
}

echo'<form method="post" action="index.php" enctype="multipart/form-data">
	<p>
		<h1>Formulaire</h1>
		<input type="file" name="image" /><br />
		<button type="submit">Envoyer</button>
	</p>
	</form>';