<?php


	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");

	require_once("private/config.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");
	require_once("models/User.class.php");
	require_once("models/UserManager.class.php");
	require_once("models/Commentaire.class.php");
	require_once("models/CommentaireManager.class.php");


	$viewG = new GeneralView();
	$manager = new AgendaManager($db);
	$userMan = new UserManager($db);
	$commentMan = new CommentaireManager($db);

	$viewG->header("CalendarFactory");
	$viewG->navBar("Admin");
	$dataTabAgenda = $manager->getAllAllAgenda();
	$dataTabUser = $userMan->getAllUsers();
	$dataTabComm = $commentMan->getAllComments();
	$viewG->generateAdminPanel($dataTabUser, $dataTabAgenda, $dataTabComm);
	$viewG->footer();
?>