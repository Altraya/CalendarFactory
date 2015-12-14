<?php

	require_once("../private/config.php");
	require_once("../views/GeneralView.class.php");

    require_once("../models/ActivityManager.class.php");
    

	$activityManager = new ActivityManager($db);
	$gView = new GeneralView();

	
	$idActivity = htmlspecialchars($_GET['idActivity']);
	$idUser = htmlspecialchars($_GET['idUtilisateur']);
	$act = $activityManager->getActivity($idActivity);
	//show activity
	$gView->showActivity($act, $idUser);


?>