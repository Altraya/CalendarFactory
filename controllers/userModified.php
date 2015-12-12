<?php
	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/User.class.php");
	require_once("models/UserManager.class.php");
		
	$manager = new UserManager($db);

	$viewG = new GeneralView();

	$viewG->header("Modification d'utilisateur");
	$viewG->navBar("Modification d'utilisateur");

	if (isset($_POST['login'])&& isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse'])&&$_POST['EnvoyerModifUser'] == 'Envoyer')
	{


		$user = new User($_POST);
		$manager->modify($user);
		echo('La modification de l\'utilisateur a bien été prise en compte.<br/>');
	
		
	}
	$viewG->footer();
?>