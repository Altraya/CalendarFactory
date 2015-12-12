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
	if(isset($_SESSION['login'])) {

		$agenda = $agendaManager->getAgenda(htmlspecialchars($_GET['idAgenda']));
	}
	?>
	<p>Modification de l'agenda, changez les champs incorrects :
			<br/><br/>
			<form action="modifierAgenda.php" method="post">
				<input type="hidden" name="idAgenda" value="<?php echo($agenda->getId()) ?>"/>
				Nom : <input type="text" name="nom" value="<?php echo($agenda->getNom()) ?>"/>
				<br/><br/>
				Priorité : <input type="int" name="priorite" value="<?php echo($agenda->getPriorite()) ?>"/>
				<br/><br/>
				Dernière Activité : <input type="date" name="lastEdition" value="<?php echo($agenda->getLastEdition()) ?>"/>
				<br/><br/>
				Est superposable : <input type="int" name="estSuperposable" value="<?php echo($agenda->getIsSuperposable()) ?>"/>
				<br/><br/>

				
				<input type="submit" name="EnvoyerModifAgenda" value="Envoyer" />
			</form>
		</p>
	<?php
		
		if (isset($_POST['nom'])&& $_POST['priorite'] && $_POST['lastEdition'] && $_POST['estSuperposable'] && $_POST['EnvoyerModifAgenda']=="Envoyer")
		{
			$agenda = new Agenda($_POST);
			$agendaManager->modify($agenda);
			echo('La modification de votre agenda a bien été prise en compte.<br/>');
		
			
		}
		$viewG->footer();
	?>
