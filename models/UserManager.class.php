<?php
/*
*	UserManager.class.php : Manage users
*
*	
*	Author : Karakayn
*/
require_once('User.class.php');

class UserManager{
	
	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}

	//Add a kreatur in database
	public function add(User $user){

		$login = $user->getLogin();
		$pwd = $user->getPwd();
		$nom = $user->getNom();
		$prenom = $user->getPrenom();
		$adresse = $user->getAdresse();

		$sql = "INSERT INTO utilisateur (login, pwd, nom, prenom, adresse)
			VALUES (:login, :pwd, :nom, :prenom, :adresse)";
		$req = $this->_db->prepare($sql);                     
		$req->bindParam(':login', $login, PDO::PARAM_STR);
		$req->bindParam(':pwd', $pwd, PDO::PARAM_STR);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
		$req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
		$req->execute();
		$req->closeCursor();
	}

	/**
	*	Search if the user identified by parameters already exist or not. 
	*	Return a user object if the user exist
	* 	Return false if the user not exist
	*/
	public function verifConnexion($login, $pwd){
		$users = array();
		$sql = 'SELECT * FROM utilisateur WHERE login = \''.$login.'\' AND pwd = \''.$pwd.'\'';
		$req = $this->_db->query($sql);
		while ($data = $req->fetch(PDO::FETCH_ASSOC)){

			$users[] = new User($data);
			
		}
		$req->closeCursor();

		if(empty($users))
			return false;
		else
			return $users[0];
	}

}
?>