<?php

	require_once("../private/config.php");
	require_once("../views/ErrorOrSuccessView.class.php");

    require_once("../models/UserManager.class.php");
    

	$userManager = new UserManager($db);
	$infView = new ErrorOrSuccessView();

	$ok = true;
	
	$idActivity = htmlspecialchars($_GET['idActivity']);
	$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);
	if(!$userManager->subscribeExist($idActivity, $idUtilisateur)){
		$ok = $userManager->subscribe($idActivity, $idUtilisateur);
	}
	//show activity
	if($ok){
		$infView->successSubscribe();
	}




?>