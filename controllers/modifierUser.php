<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/User.class.php");
	require_once("models/UserManager.class.php");

	$userManager = new UserManager($db);
	
	$viewG = new GeneralView();

	$viewG->header("Modification d'un utilisateur");
	$viewG->navBar("Modification d'un utilisateur");
	if(isset($_SESSION['login'])) {

		$user = $userManager->getUser(htmlspecialchars($_GET['idUser']));
	}
?>


	<p>Modification de l'agenda, changez les champs incorrects :
			<br/><br/>
			<form action="userModified.php" method="post" class="form-group">

				<input type="hidden" class="class-control" name="idUtilisateur" value="<?php echo($user->getIdUtilisateur()) ?>"/>
				<div class="form-group">
					<label for="login">Login : </label></br>
					<input type="text" class="form-control" id="login" name="login" value="<?php echo($user->getLogin()) ?>"/>
				</div>
				<div class="form-group">
					<label for="nom">Nom : </label></br>
					<input type="text" class="form-control" id="nom" name="nom" value="<?php echo($user->getNom()) ?>"/>
				</div>
				<div class="form-group">
					<label for="prenom">Prenom : </label></br>
					<input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo($user->getPrenom()) ?>"/>
				</div>
				<div class="form-group">
					<label for="adresse">Adresse : </label></br>
					<input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo($user->getAdresse()) ?>"/>
				</div>
				<div class="form-group">
					<label for="oldPassW">Ancien mot de passe : </label></br>
					<input type="text" class="form-control" id="oldPassW" name="pwd" value="<?php echo($user->getPwd()) ?>"/>
				</div>
				<div class="form-group">
					<label for="newPassW">Nouveau mot de passe : </label></br>
					<input type="text" class="form-control" id="newPassW" name="newpwd" value="<?php echo($user->getPwd()) ?>"/>
				</div>
				<div class="form-group">
					<label for="confPassW">Confirmer mot de passe : </label></br>
					<input type="text" class="form-control" id="confPassW" name="confpwd" value="<?php echo($user->getPwd()) ?>"/>
				</div>
				  <button type="submit" name="EnvoyerModifUser" value="Envoyer" class="btn btn-default">Envoyer</button>

				
			</form>
			
		</p>
		
	<?php
		
		if (isset($_POST['login'])&& isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse'])&&$_POST['EnvoyerModifUser'] == 'Envoyer')
		{
			$user = new User($_POST);
			if($_POST['newpwd'] != $_POST['confpwd']){
				echo('Mauvaise confirmation du mot de passe.');
			}
			else{
				$pass = htmlspecialchars($_POST['newpwd']);
				$nouveauPwd = sha1($pass);
				$user->setPwd($nouveauPwd);
			}
			$manager->modify($user);
			echo('La modification de votre agenda a bien été prise en compte.<br/>');
		
			
		}
		$viewG->footer();
	?>