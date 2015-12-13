<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/User.class.php");
	require_once("models/UserManager.class.php");

	$userManager = new UserManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Modification d'utilisateur");
	$viewG->navBar("Modification d'utilisateur");
	if(isset($_SESSION['login'])) {

		$user = $userManager->getUser(htmlspecialchars($_GET['idUser']));
	}
	?>
	<p>Modification de l'agenda, changez les champs incorrects :
			<br/><br/>
			<form action="userModified.php" method="post">
				<input type="hidden" name="idUtilisateur" value="<?php echo($user->getIdUtilisateur()) ?>"/>
				<input type="hidden" name="pwd" value="<?php echo($user->getPwd()) ?>"/>
				Login : <input type="int" name="login" value="<?php echo($user->getLogin()) ?>"/>
				<br/><br/>
				Nom : <input type="text" name="nom" value="<?php echo($user->getNom()) ?>"/>
				<br/><br/>
				Prénom : <input type="text" name="prenom" value="<?php echo($user->getPrenom()) ?>"/>
				<br/><br/>
				Adresse : <input type="text" name="adresse" value="<?php echo($user->getAdresse()) ?>"/>
				<br/><br/>

				
				<input type="submit" name="EnvoyerModifUser" value="Envoyer" />
			</form>
		</p>
	<?php
		
		if (isset($_POST['login'])&& isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse'])&&$_POST['EnvoyerModifUser'] == 'Envoyer')
		{
			$activite = new Activity($_POST);
			$manager->modify($activite);
			echo('La modification de votre agenda a bien été prise en compte.<br/>');
		
			
		}
		$viewG->footer();
	?>