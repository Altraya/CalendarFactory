<?php

	require_once("../private/config.php");
	require_once("../views/ErrorOrSuccessView.class.php");

    require_once("../models/UserManager.class.php");
    

	$userManager = new UserManager($db);
	$infView = new ErrorOrSuccessView();

	$ok = true;
	
	$idActivity = htmlspecialchars($_GET['idActivity']);
	$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);
	$note = htmlspecialchars($_GET['note']);
	//if notation don't exist > insert / else update
	if(!$userManager->notationExist($idUtilisateur, $idActivite, $note)){
		$ok = $userManager->addNotation($note);
	}else{
		$ok = $userManager->updateNotation($note);
	}
	//show activity
	if($ok){
		$infView->successSubscribe();
	}




?>