<?php
/* Class for display error or success message */

class ErrorOrSuccessView{

    public function __construct(){
    }

/**
*           Warning message
*/

    public function redirection($time){
        $html="";
        $html.='
            <div class="alert alert-warning center">
                <strong>Attention :</strong> Vous allez être redirigé dans '.$time.' secondes.
            </div>
        ';
        echo($html);
    }

/**
*           Error message
*/

    public function alreadyConnected(){
    	$html="";
    	$html.='
			<div class="alert alert-danger center">
				<strong>Erreur :</strong> Vous êtes déja connecté !
			</div>
    	';
    	echo($html);
    }

    public function errorButtonNotClicked(){
    	$html="";
    	$html.='
			<div class="alert alert-danger center">
				<strong>Erreur :</strong> Vous devez valider le formulaire pour pouvoir vous connecter !
			</div>
    	';
    	echo($html);
    }

    public function errorNeedToCompleteForm(){
    	$html="";
    	$html.='
			<div class="alert alert-danger center">
				<strong>Erreur :</strong> Vous devez valider tous les champs du formulaire avant de pouvoir vous connecter !
			</div>
    	';
    	echo($html);
    }

    public function errorUserDoesntExist(){
    	$html="";
    	$html.='
			<div class="alert alert-danger center">
				<strong>Erreur :</strong> Vous devez être inscrit pour pouvoir vous connecter !
			</div>
    	';
    	echo($html);
    }

    public function errorCompleteForm($type){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> Vous devez completer le champ '.$type.' pour continuer !
            </div>
        ';
        echo($html);
    }

    public function errorMismatchPwd(){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> Vous devez entrer deux mots de passe identique !
            </div>
        ';
        echo($html);
    }

    public function errorUserAlreadyExist(){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> ce nom d\'utilisateur existe déjà !
            </div>
        ';
        echo($html);
    }

    public function errorNotConnected(){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> vous devez être connecté pour voir cette page. <a href="index.php">Cliquez ici pour vous connectez.</a>
            </div>
        ';
        echo($html);
    }

    public function errorAgendaCreateFailed(){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> Une erreur c\'est produite, votre agenda n\'a pas été crée.
            </div>
        ';
        echo($html);
    }

    public function errorActivityCreateFailed(){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> Une erreur c\'est produite, votre activité n\'a pas été crée.
            </div>
        ';
        echo($html);
    }

    public function errorGeneral(){
        $html="";
        $html.='
            <div class="alert alert-danger center">
                <strong>Erreur :</strong> Une erreur c\'est produite.
            </div>
        ';
        echo($html);
    }

/**
*           Success message
*/

    public function successInscription(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Votre inscription à bien été validé. Vous pouvez dès à présent vous connecter !
            </div>
        ';
        echo($html);
    }

    public function successConnexion(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Vous vous êtes bien connecté !
            </div>
        ';
        echo($html);
    }

    public function successDeconnexion(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Vous vous êtes bien deconnecté !
            </div>
        ';
        echo($html);
    }

    public function successAgendaCreated(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Votre agenda a bien été crée !
            </div>
        ';
        echo($html);
    }

    public function successActivityCreated(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Votre activité a bien été crée !
            </div>
        ';
        echo($html);
    }

    public function successSubscribe(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Vous vous êtes bien inscrit à cette activité !
            </div>
        ';
        echo($html);
    }

    public function successCreateComment(){
        $html="";
        $html.='
            <div class="alert alert-success center">
                <strong>Félicitations :</strong> Votre commentaire a bien été crée ! :)
            </div>
        ';
        echo($html);
    }

}
?>