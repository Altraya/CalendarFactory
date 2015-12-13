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
			<form action="agendaModified.php" method="post" class="form-group">
				<input type="hidden" name="id" value="<?php echo($agenda->getId()) ?>"/>
				<input type="hidden" name="lastEdition" value="<?php echo($agenda->getLastEdition()) ?>"/>
				<input type="hidden" name="ownerId" value="<?php echo($agenda->getOwnerId()) ?>"/>

				<div class="form-group">
					<label for="nom">Nom : </label></br>
					<input type="text" class="form-control" id="nom" name="nom" value="<?php echo($agenda->getNom()) ?>"/>
				</div>
				<div class="form-group">
					<label for="priorite">Priorité : </label></br>
					<input type="text" class="form-control" id="priorite" name="priorite" value="<?php echo($agenda->getPriorite()) ?>"/>
				</div>
				<div class="checkbox">
			    	<label><input type="checkbox" name="isSuperposable" value="1"> Est superposable</label>
			    </div>
				<button type="submit" name="EnvoyerModifAgenda" value="Envoyer" class="btn btn-default">Envoyer</button>				
			</form>
			
		</p>
	<?php
		
		
		$viewG->footer();
	?>
