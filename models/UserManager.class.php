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

	//Add a user in database
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

	//remove user from database
	public function remove(User $user){
		$idUtilisateur = $user->getIdUtilisateur();
		$sql = "DELETE FROM utilisateur WHERE idUtilisateur = :idUtilisateur ";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
		$req->execute();
		$req->closeCursor();
	}

	//modifier un utilisateur
	public function modify(User $user){
		$sql = "UPDATE utilisateur
			SET login = :login,
			pwd = :pwd,
			nom = :nom,
			prenom = :prenom,
			adresse = :adresse,
			WHERE idUtilisateur = :idUtilisateur";
		$req = $this->_db->prepare($sql);
		$req->bindParam(':idUtilisateur', $user->getIdUtilisateur(), PDO::PARAM_STR);
		$req->bindParam(':login', $user->getLogin(), PDO::PARAM_STR);
		$req->bindParam(':pwd', $user->getPwd(), PDO::PARAM_STR);
		$req->bindParam(':nom', $user->getNom(), PDO::PARAM_STR);
		$req->bindParam(':prenom', $user->getPrenom(), PDO::PARAM_STR);
		$req->bindParam(':adresse', $user->getAdresse(), PDO::PARAM_STR);
		$req->execute();

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return true;
	}

	//retourne un tableau avec tout les utilisateurs
	public function getAllUsers(){
		$user = array();
		$query = $this->_db->query('SELECT *
									FROM utilisateur');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$user[] = new User($donnees);
		}

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $user;
	}

	//renvoie l'utilisateur associé à l'ID en argument
	public function getUser($id){
		$user;
		$req = $this->_db->query('SELECT * 
								FROM utilisateur WHERE idUtilisateur = \''.$id.'\' ');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$user = new User($donnees);
		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $user;
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