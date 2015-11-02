<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	$viewG->header("CalendarFactory");
	$viewG->navBar("Mes calendriers");
	$viewG->body();
	$viewG->footer();
?>