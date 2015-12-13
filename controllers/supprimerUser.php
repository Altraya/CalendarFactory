<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");
	require_once("models/User.class.php");	
	require_once("models/UserManager.class.php");


	$agendaManager = new AgendaManager($db);
	$userManager = new UserManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Suppression d'utilisateur");
	$viewG->navBar("Suppression d'utilisateur");
	if(isset($_SESSION['login'])){
		$user = $userManager->getUser(htmlspecialchars($_GET['idUser']));
	}
	if(isset($_GET['idUser'])){
		
			
		
		$userManager->remove($user);	
		echo('Félicitations, l\'utilisateur a bien été supprimé');
	}
	$viewG->footer();

?>