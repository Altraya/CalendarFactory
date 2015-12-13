<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");
	require_once("models/Commentaire.class.php");	
	require_once("models/CommentaireManager.class.php");


	$agendaManager = new AgendaManager($db);
	$comManager = new CommentaireManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Suppression d'un commentaire");
	$viewG->navBar("Suppression d'un commentaire");
	if(isset($_SESSION['login'])){
		$comment = $comManager->getComment(htmlspecialchars($_GET['idCom']));
	}
	if(isset($_GET['idCom'])){
		$commentairesFils = $comManager->getSonComment($comment->getIdCommentaire());
		if($commentairesFils ==false) {
			
			$comManager->remove($comment);	
		}
		else{
			foreach ($commentairesFils as $fils) {
				$fils->setIdCommentaireParent($comment->getIdCommentaireParent()); 
			}
			$comment->setIdCommentaireParent(null);
			$comManager->remove($comment);
		}
		
		echo('Félicitations, le commentaire a bien été supprimé');
	}
	$viewG->footer();

?>