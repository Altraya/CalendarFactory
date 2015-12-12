

<?php
class Commentaire{
  private $_idCommentaire;
  private $_commentaire;
  private $_dateCommentaire;
  private $_heureCommentaire;
  private $_idCommentaireParent;
  private $_idUtilisateur;
  private $_idActivite;


  /*constructeur*/
  public function __construct($donnees){
    $this->hydrate($donnees);
  }
  /***************************
    Accesseur de la classe
  ****************************/
  public function getIdCommentaire(){
    return $this->_idCommentaire;
  }

  public function getCommentaire(){
    return $this->_commentaire;
  }

  public function getDateCommentaire(){
    return $this->_dateCommentaire;
  }

  public function getHeureCommentaire(){
    return $this->_heureCommentaire;
  }

  public function getIdCommentaireParent(){
    return $this->_idCommentaireParent;
  }

  public function getIdUtilisateur(){
    return $this->_idUtilisateur;
  }

  public function getIdActivite(){
    return $this->_idActivite;
  }

  /************************/

    public function setIdCommentaire($idCommentaire){
    return $this->_idCommentaire = htmlspecialchars($idCommentaire);
  }

  public function setCommentaire($commentaire){
    return $this->_commentaire = htmlspecialchars($commentaire);
  }

  public function setDateCommentaire($dateCommentaire){
    return $this->_dateCommentaire = htmlspecialchars($dateCommentaire);
  }

  public function setHeureCommentaire($heureCommentaire){
    return $this->_heureCommentaire = htmlspecialchars($heureCommentaire);
  }

  public function setIdCommentaireParent($idCommentaireParent){
    return $this->_idCommentaireParent = htmlspecialchars($idCommentaireParent);
  }

  public function setIdUtilisateur($idUtilisateur){
    return $this->_idUtilisateur = htmlspecialchars($idUtilisateur);
  }

  public function setIdActivite($idActivite){
    return $this->_idActivite = htmlspecialchars($idActivite);
  }

  /************************/

  public function hydrate($donnees)
  {
    foreach($donnees as $key => $value)
    {
      // On récupère le nom du setter correspondant à l'attribut.
      $method = 'set'.ucfirst($key);

      // Si le setter correspondant existe.
      if(method_exists($this, $method))
      {
        // On appelle le setter.
        $this->$method($value);
      }
    }
  }  
}