<?php
	var_dump($_POST);

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	$viewG->header("Connexion");

	require_once("views/ErrorOrSuccessView.class.php");

	$errorView = new ErrorOrSuccessView();

	if(isset($_SESSION['pseudo'])){
		$errorView->alreadyConnected();
	}else{
		//the user have not click on the connexion button => redirect and display error
		if(!isset($_POST['connexion'])){
			$errorView->errorButtonNotClicked();
			$errorView->redirection(5);
			header('Refresh: 5; url=index.php');
		}

		//Check if the user have complete the form
		if((isset($_POST['login']) && $_POST['login'] != '') && (isset($_POST['pwd']) && $_POST['pwd'] != ''))
			$login = htmlspecialchars($_POST['login']);
			$pass = htmlspecialchars($_POST['pwd']);
			$passCrypt = sha1($pass);

			//@TODO SESSION VARIABLE + Check DB
		}else{
			$errorView->errorNeedToCompleteForm();
		}

	}
?>