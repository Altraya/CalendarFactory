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

	//subscription for a user
	public function subscribe($idActivity, $idUtilisateur){

		$sql = "INSERT INTO inscription (idUtilisateur, idActivite)
			VALUES (:idUtilisateur, :idActivite)";
		$req = $this->_db->prepare($sql);           
		$req->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
		$req->bindParam(':idActivite', $idActivity, PDO::PARAM_INT);
		$req->execute();
		$nbTupleInsere = $req->rowCount();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		return true;
	}

	//return true if subscribeExist / else false
	public function subscribeExist($idActivity, $idUtilisateur){
		$req = $this->_db->query('SELECT * FROM inscription WHERE idUtilisateur = '.$idUtilisateur.' AND idActivite = '.$idActivity);
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			$user = $donnees;
		}
		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1){
			return false;
		}else{
			return true;
		}
	}

	//notation for an activity
	public function addNotation($idUtilisateur, $idActivite, $note){
		$sql = "INSERT INTO notation (idUtilisateur, idActivite, note)
			VALUES (:idUtilisateur, :idActivite, :note)";
		$req = $this->_db->prepare($sql);           
		$req->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
		$req->bindParam(':idActivite', $idActivity, PDO::PARAM_INT);
		$req->bindParam(':note', $note, PDO::PARAM_INT);
		$req->execute();
		$nbTupleInsere = $req->rowCount();
		$req->closeCursor();

		//check if insert has failed
		if($nbTupleInsere < 1)
			return false;
		return true;
	}

	//modifier un utilisateur
	public function modify(User $user){
		$sql = "UPDATE utilisateur
			SET login = :login,
			pwd = :pwd,
			nom = :nom,
			prenom = :prenom,
			adresse = :adresse
			WHERE idUtilisateur = :idUtilisateur";

		$id = $user->getIdUtilisateur();
		$log = $user->getLogin();
		$password = $user->getPwd();
		$name = $user->getNom();
		$surname =  $user->getPrenom();
		$adress = $user->getAdresse();

		$req = $this->_db->prepare($sql);
		$req->bindParam(':idUtilisateur',$id , PDO::PARAM_STR);
		$req->bindParam(':login',$log , PDO::PARAM_STR);
		$req->bindParam(':pwd', $password, PDO::PARAM_STR);
		$req->bindParam(':nom',$name , PDO::PARAM_STR);
		$req->bindParam(':prenom',$surname, PDO::PARAM_STR);
		$req->bindParam(':adresse',$adress , PDO::PARAM_STR);
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
		$return = array();
		$req = $this->_db->query('SELECT *
									FROM utilisateur');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			$user['idUtilisateur'] = $donnees['idUtilisateur'];
			$user['pwd'] = $donnees['pwd'];
			$user['login'] = $donnees['login'];
			$user['nom'] = $donnees['nom'];
			$user['prenom'] = $donnees['prenom'];
			$user['adresse'] = $donnees['adresse'];
			$return[] = new User($user);
		}

		$nbTupleObt = $req->rowCount();	
		$req->closeCursor();

		if($nbTupleObt < 1)
			return false;
		return $return;
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