<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Commentaire.class.php");
	require_once("models/CommentaireManager.class.php");

	$comManager = new CommentaireManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Modification d'un commentaire");
	$viewG->navBar("Modification d'un commentaire");
	if(isset($_SESSION['login'])) {

		$com = $comManager->getComment(htmlspecialchars($_GET['idCom']));
	}
	?>
	<p>Modification du commentaire, changez les champs incorrects :
			<br/><br/>
			<form action="commentaireModified.php" method="post">
				<input type="hidden" name="idCommentaire" value="<?php echo($com->getIdCommentaire()) ?>"/>
				<input type="hidden" name="idCommentaireParent" value="<?php echo($com->getIdCommentaireParent()) ?>"/>
				<input type="hidden" name="idActivite" value="<?php echo($com->getIdActivite()) ?>"/>
				<input type="hidden" name="dateCommentaire" value="<?php echo($com->getDateCommentaire()) ?>"/>
				<input type="hidden" name="heureCommentaire" value="<?php echo($com->getHeureCommentaire()) ?>"/>
				Commentaire : <input type="int" name="commentaire" value="<?php echo($com->getCommentaire()) ?>"/>
				<br/><br/>
					
				<input type="submit" name="EnvoyerModifCom" value="Envoyer" />
			</form>
		</p>
	