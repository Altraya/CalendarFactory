<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	$viewG->header("Inscription");
	$viewG->inscriptionPage();
	$viewG->footer();
?>