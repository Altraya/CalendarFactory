<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	require_once("views/ErrorOrSuccessView.class.php");

	$errorView = new ErrorOrSuccessView();

	$viewG->header("Creation d'agenda ou d'activité");
	$viewG->navBar("Creation d'agenda ou d'activité");

	if(isset($_SESSION['login'])){
		if(isset($_POST['createAgenda'])){

		}elseif (isset($_POST['createActivity'])) {
			# code...
		}else{
			$viewG->createAgendaOrActivity();
		}
	}else{
		$errorView->errorNotConnected();
	}
	
	$viewG->footer();
?>