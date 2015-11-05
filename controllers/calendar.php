<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	require_once("views/ErrorOrSuccessView.class.php");

	$errorView = new ErrorOrSuccessView();

	$viewG->header("CalendarFactory");
	$viewG->navBar("Mes agendas");

	if(isset($_SESSION['login'])){
		$viewG->body();
	}else{
		$errorView->errorNotConnected();
	}
	
	$viewG->footer();
?>