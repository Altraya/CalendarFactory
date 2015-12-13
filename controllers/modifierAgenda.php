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
			<form action="agendaModified.php" method="post">
				<input type="hidden" name="id" value="<?php echo($agenda->getId()) ?>"/>
				<input type="hidden" name="lastEdition" value="<?php echo($agenda->getLastEdition()) ?>"/>
				<input type="hidden" name="ownerId" value="<?php echo($agenda->getOwnerId()) ?>"/>

				Nom : <input type="text" name="nom" value="<?php echo($agenda->getNom()) ?>"/>
				<br/><br/>
				Priorité : <input type="int" name="priorite" value="<?php echo($agenda->getPriorite()) ?>"/>
				<br/><br/>
				Est superposable : <input type="checkbox" name="isSuperposable" value="1"/>
				<br/><br/>

				
				<input type="submit" name="EnvoyerModifAgenda" value="Envoyer" />
			</form>
		</p>
	<?php
		
		
		$viewG->footer();
	?>
