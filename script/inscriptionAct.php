<?php

	require_once("../private/config.php");
	require_once("../views/ErrorOrSuccessView.class.php");

    require_once("../models/UserManager.class.php");
    

	$userManager = new UserManager($db);
	$infView = new ErrorOrSuccessView();

	
	$idActivity = htmlspecialchars($_GET['idActivity']);
	$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);
	$ok = $userManager->subscribe($idActivity, $idUtilisateur);
	//show activity
	$infView->successSubscribe();




?>