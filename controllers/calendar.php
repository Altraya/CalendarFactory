<?php

	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("private/config.php");
	require_once("models/AgendaManager.class.php");

	$viewG = new GeneralView();
	$errorView = new ErrorOrSuccessView();
	$agendaManager = new AgendaManager($db);

	$viewG->header("CalendarFactory");
	$viewG->navBar("Mes agendas");

	if(isset($_SESSION['login'])){
		$tabInfoAgenda = $agendaManager->getAllAgendaIdOfUser($_SESSION['idUser']);
		$viewG->body($tabInfoAgenda);
	}else{
		$errorView->errorNotConnected();
	}
	
	$viewG->footer();
?>