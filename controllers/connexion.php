<?php
	var_dump($_POST);
	require_once("views/errorOrSuccessView.class.php");
	$errorView = new errorOrSuccessView();
	if(isset($_SESSION['pseudo'])){
		$errorView->alreadyConnected();
	}else{
		//the user have not click on the connexion button => redirect and display error
		if(!isset($_POST['connexion'])){
			$errorView->errorButtonNotClicked();
			header('Refresh: 5; url=index.php');
		}
	}
?>