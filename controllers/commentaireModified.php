<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Commentaire.class.php");
	require_once("models/CommentaireManager.class.php");
		
	$manager = new CommentaireManager($db);

	$viewG = new GeneralView();

	$viewG->header("Modification d'un commentaire");
	$viewG->navBar("Modification d'un commentaire");
		
		if (isset($_POST['idCommentaire'])&& isset($_POST['idCommentaireParent']) && isset($_POST['idActivite']) && isset($_POST['commentaire'])&&$_POST['EnvoyerModifCom'] == 'Envoyer')
		{
			$commentaire = new Commentaire($_POST);
			$manager->modify($commentaire);
			echo('La modification de votre commentaire a bien été prise en compte.<br/>');
		
			
		}
		$viewG->footer();
	
?>