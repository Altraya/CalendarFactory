<?php

	require_once("../private/config.php");
	require_once("../models/CommentaireManager.class.php");
	require_once("../views/GeneralView.class.php");
    require_once("../models/UserManager.class.php");
    
    $userManager = new UserManager($db);
	$comManager = new CommentaireManager($db);
	$gView = new GeneralView();

	//Comment part	
	$infosParent = array();
	$infosSon = array();

	$idActivity = htmlspecialchars($_GET['idActivity']);

	$infosParent = $comManager->getParentCommentOfActivity($idActivity);
	if($infosParent){
		foreach ($infosParent as $key => $comParent) {

			$infosSon[] = $comManager->getSonComment($comParent->getIdCommentaire());

		}
	}else{
		$infosSon = false;
	}

	$gView->showComments($infosParent, $infosSon, $userManager);

?>