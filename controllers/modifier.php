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

	$viewG->header("Modification d'activité");
	$viewG->navBar("Modification d'activité");
	$viewAct->displayActivities($manager->getAllActivities());
	if(isset($_SESSION['login'])) {
		if (isset($_POST['supprActivity']) && isset($_POST['idActivity'])) {
			require_once('config.php');

			require_once('Activity.class.php');

			require_once('ActivityManager.class.php');
		}

		$activite = $manager->getActivity(htmlspecialchars($_GET['idActivite']));
	}
	?>
	<p>Modification de l'activité, changez les champs incorrects :
			<br/><br/>
			<form action="modifier.php" method="post">
				<input type="hidden" name="idActivite" value="<?php echo($activite->getIdActivity()) ?>"/>
				Titre : <input type="text" name="titre" value="<?php echo($activite->getTitle()) ?>"/>
				<br/><br/>
				Description : <input type="text" name="description" value="<?php echo($activite->getDescription()) ?>"/>
				<br/><br/>
				Position Geographique : <input type="text" name="positionGeographique" value="<?php echo($activite->getGeoPos()) ?>"/>
				<br/><br/>
				Type : <input type="text" name="type" value="<?php echo($activite->getType()) ?>"/>
				<br/><br/>
				Priorité : <input type="text" name="priorite" value="<?php echo($activite->getPriority()) ?>"/>
				<br/><br/>
				Date de début : <input type="date" name="dateDebut" value="<?php echo($activite->getStartDate()) ?>"/>
				<br/><br/>
				Date de fin : <input type="date" name="dateFin" value="<?php echo($activite->getEndDate()) ?>"/>
				<br/><br/>
				Heure de début : <input type="time" name="heureDebut" value="<?php echo($activite->getStartHour()) ?>"/>
				<br/><br/>
				Heure de fin : <input type="time" name="heureFin" value="<?php echo($activite->getEndHour()) ?>"/>
				<br/><br/>
				Périodicité : <input type="text" name="periodicite" value="<?php echo($activite->getPeriodic()) ?>"/>
				<br/><br/>
				Nombre d'occurences : <input type="number" name="nbOccurence" value="<?php echo($activite->getNbOccur()) ?>"/>
				<br/><br/>
				Est en pause : <input type="number" name="estEnPause" value="<?php echo($activite->getIsInBreak()) ?>"/>
				<br/><br/>
				Possible de s'incrire : <input type="number" name="estPossibleDeSinscrire" value="<?php echo($activite->getIsPossibleToSubscribe()) ?>"/>
				<br/><br/>
				Activité publique : <input type="number" name="estPublic" value="<?php echo($activite->getIsPublic()) ?>"/>
				<br/><br/>
				<input type="submit" name="Envoyer2" value="Envoyer" />
			</form>
		</p>
	<?php
		
		if (isset($_POST['Envoyer2'])&& $_POST['Envoyer2'] == 'Envoyer')
		{
			$activite = new Activity($_POST);
			$manager->modify($activite);
			echo('La modification de votre activité a bien été prise en compte.<br/>');
		
			
		}
		$viewG->footer();
	?>
