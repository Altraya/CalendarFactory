<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	$viewG->header("CalendarFactory");
	$viewG->navBar("Mes agendas");
	$viewG->body();
	$viewG->footer();
?>