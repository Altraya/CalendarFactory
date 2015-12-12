<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	$viewG->header("Connexion");

	require_once("views/ErrorOrSuccessView.class.php");

	$errorView = new ErrorOrSuccessView();

	if(isset($_SESSION['pseudo'])){
		$errorView->alreadyConnected();
	}else{
		//the user has not click on the connexion button => redirect and display error
		if(!isset($_POST['connexion'])){
			$errorView->errorButtonNotClicked();
			$errorView->redirection(1);
			header('Refresh: 1; url=index.php');
		}

		//Check if the user have complete the form
		if((isset($_POST['login']) && $_POST['login'] != '') && (isset($_POST['pwd']) && $_POST['pwd'] != '')){
			//force login with uppercase
			$login = htmlspecialchars(ucfirst($_POST['login']));
			$pass = htmlspecialchars($_POST['pwd']);
			$passCrypt = sha1($pass);

			require_once("private/config.php");
			require_once("models/UserManager.class.php");
			$userManager = new UserManager($db);

			//verif if the user exist
			if(!($currentUser = $userManager->verifConnexion($login, $passCrypt))){
				$errorView->errorUserDoesntExist();
				$errorView->redirection(5);
				header('Refresh: 5; url=index.php');
			}else{
				$_SESSION['idUser'] = $currentUser->getIdUtilisateur();
				$_SESSION['login'] = $login;
				$errorView->successConnexion();
				$errorView->redirection(2);
				header('Refresh: 2; url=calendar.php');
			}
		}else{
			$errorView->errorNeedToCompleteForm();
		}

	}
?>