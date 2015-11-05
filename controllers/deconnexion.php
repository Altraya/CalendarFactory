<?php
	/*
		deconnexion.php : deconnexion controller

		Author : Karakayn
	*/

	require_once('./views/GeneralView.class.php');

	$viewG = new GeneralView();

	require_once("views/ErrorOrSuccessView.class.php");

	$errorView = new ErrorOrSuccessView();
	
	$viewG->header("KreaturWorld - Deconnexion");

	//destroy session variable => deconnexion
	$_SESSION = array();
	session_destroy();

	$errorView->successDeconnexion();
	$errorView->redirection(5);
	header('Refresh: 5; url=index.php');

	$viewG->footer();

?>