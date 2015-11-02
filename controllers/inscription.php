<?php
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");

	$viewG = new GeneralView();
	$errorView = new ErrorOrSuccessView();

	$viewG->header("Inscription");
	//if we dont have already complete the form, show it
	if(!isset($_POST['inscription'])){
		$viewG->inscriptionPage();
	//since here we will check all fields in the form
	}elseif(!isset($_POST['login']) && $_POST['login'] == ''){
		$errorView->errorCompleteForm("login");
		$errorView->redirection(5);
		header('Refresh: 5; url=inscription.php');
	}elseif (!isset($_POST['pwd']) && $_POST['pwd'] == '') {
		$errorView->errorCompleteForm("mot de passe");
		$errorView->redirection(5);
		header('Refresh: 5; url=inscription.php');
	}elseif (!isset($_POST['nom']) && $_POST['nom'] == '') {
		$errorView->errorCompleteForm("nom");
	}elseif (!isset($_POST['prenom']) && $_POST['prenom'] == '') {
		$errorView->errorCompleteForm("prenom");
		$errorView->redirection(5);
		header('Refresh: 5; url=inscription.php');
	}elseif (!isset($_POST['adresse']) && $_POST['adresse'] == '') {
		$errorView->errorCompleteForm("adresse");
		$errorView->redirection(5);
		header('Refresh: 5; url=inscription.php');
	//last check if the two password are the same
	}elseif($_POST['pwd'] != $_POST['pwdConfirm']){
		$errorView->errorMismatchPwd();
		$errorView->redirection(5);
		header('Refresh: 5; url=inscription.php');
	}else{
		//all is ok : success message / start session variable / add user in DB and redirect
		require_once("private/config.php");
		require_once("models/UserManager.class.php");
		$userManager = new UserManager($db);

		//Structure data
		$data = array();
		$data['id'] = null; //for the id
		$data['login'] = ucfirst(htmlspecialchars($_POST['login']));
		$data['pwd'] = sha1(htmlspecialchars($_POST['pwd']));
		$data['nom'] = htmlspecialchars($_POST['nom']);
		$data['prenom'] = htmlspecialchars($_POST['prenom']);
		$data['adresse'] = htmlspecialchars($_POST['adresse']);
		$newUser = new User($data);
		
		//verif if the user already exist
		if(!($currentUser = $userManager->verifConnexion($data['login'], $data['pwd']))){
			//the user dos not exit; we can add it and continue
			$userManager->add($newUser);
			$errorView->successInscription();
			$errorView->redirection(5);
			$_SESSION['login'] = $data['login'];
			header('Refresh: 5; url=calendar.php');
		}else{
			$errorView->errorUserAlreadyExist();
			$errorView->redirection(5);
			header('Refresh: 5; url=inscription.php');
		}
		
	}

	$viewG->footer();
?>