
<?php
	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");

	$agendaManager = new AgendaManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Modification d'agenda");
	$viewG->navBar("Modification d'agenda");
if (isset($_POST['nom'])&& isset($_POST['priorite']) && isset($_POST['lastEdition'])  && $_POST['EnvoyerModifAgenda']=="Envoyer")
		{

			$agenda = new Agenda($_POST);

			$agendaManager->modify($agenda);


			echo('La modification de votre agenda a bien été prise en compte.<br/>');
		
			
		}
		$viewG->footer();

?>