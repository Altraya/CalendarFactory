<?php
/* Class for display error or success message */

class ErrorOrSuccessView{

    public function __construct(){
    }

    public function alreadyConnected(){
    	$html="";
    	$html.='
			<div class="alert alert-warning center">
				<strong>Erreur :</strong> Vous êtes déja connecté !
			</div>
    	';
    	echo($html);
    }

    public function errorButtonNotClicked(){
    	$html="";
    	$html.='
			<div class="alert alert-warning center">
				<strong>Erreur :</strong> Vous devez valider le formulaire pour pouvoir vous connecter !
			</div>
    	';
    	echo($html);
    }

    public function redirection($time){
    	$html="";
    	$html.='
			<div class="alert alert-info center">
				<strong>Attention :</strong> Vous allez être redirigé dans '.$time.' secondes.
			</div>
    	';
    	echo($html);
    }

    public function errorNeedToCompleteForm(){
    	$html="";
    	$html.='
			<div class="alert alert-warning center">
				<strong>Erreur :</strong> Vous devez valider tous les champs du formulaire avant de pouvoir vous connecter !
			</div>
    	';
    	echo($html);
    }
}
?>