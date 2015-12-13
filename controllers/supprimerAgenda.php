<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");
	require_once("models/Activity.class.php");	
	require_once("models/ActivityManager.class.php");


	$agendaManager = new AgendaManager($db);
	$actManager = new ActivityManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Suppression d'agenda");
	$viewG->navBar("Suppression d'agenda");
	if(isset($_SESSION['login'])){
		$agenda = $agendaManager->getAgenda(htmlspecialchars($_GET['idAgenda']));
		$activities = $agendaManager->getAllActivities(htmlspecialchars($_GET['idAgenda']));
		var_dump($agenda);
		var_dump($activities);
	}
	var_dump($agenda);
	var_dump($_GET['idAgenda']);
?>
<p> Suppression de l'agenda</p>
<?php
	if(isset($_GET['idAgenda'])){
		if(($activities)!=false){
			foreach ($activities as $act) {
				$actManager->remove($act);
			}
			
		}
		$agendaManager->remove($agenda);	
		echo('Félicitations, l\'agenda a bien été supprimé');
	}
	$viewG->footer();

?>