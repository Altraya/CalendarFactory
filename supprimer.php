<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");

	$agendaManager = new AgendaManager($db);
	$manager = new ActivityManager($db);
	
	$viewG = new GeneralView();
	$viewAct = new ActivityView();

	$viewG->header("Suppression d'activité");
	$viewG->navBar("Suppression d'activité");
	$viewAct->displayActivities($manager->getAllActivities());
	if(isset($_SESSION['login'])){
		if(isset(($_POST['supprActivity']) && $_POST['idActivity']))
		{
			require_once('config.php');

			require_once('ActivityManager.class.php');
		}

		
		$manager->remove($manager->getActivity(htmlspecialchars($_GET['idActivity'])));
				echo('Félicitation, l\'activité '.htmlspecialchars($_GET['idActivity']).' a bien été supprimée.');
		
	}
	$viewG->footer();

?>
