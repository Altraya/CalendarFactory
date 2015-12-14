<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Commentaire.class.php");
	require_once("models/CommentaireManager.class.php");
		
	$manager = new CommentaireManager($db);
	$errV = new ErrorOrSuccessView();
	$viewG = new GeneralView();

	$viewG->header("Ajout d'un commentaire");
	$viewG->navBar("Ajout d'un commentaire");

		if (isset($_POST['commenter']))
		{
			if($_POST['commenter'] == ""){

				$data["commentaire"] = htmlspecialchars($_POST["commentUser"]);
				$data["dateCommentaire"] = date("Y-n-j");
				$data["heureCommentaire"] = date("G:i:s");;
				$data["idCommentaireParent"] = '';
				$data["idUtilisateur"] = $_SESSION["idUser"];
				$data["idActivite"] = 2;

				$com = new Commentaire($data);
				$manager->add($com);
				$errV->successCreateComment();
			}
			/*$commentaire = new Commentaire($_POST);
			$manager->add($commentaire);
			echo('Votre commentaire a bien été crée <br/>');*/
		}
		
		$viewG->footer();
	
?>