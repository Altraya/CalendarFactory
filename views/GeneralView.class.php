<?php
/* General view */

class GeneralView{

    public function __construct(){
    }

    public function header($pageTitle){
        session_start();
        $html = "";
        $html.= '
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <title>'.$pageTitle.'</title>

                <!-- Bootstrap -->
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link href="css/custom.css" rel="stylesheet">

                <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
                <script src="js/jquery.min.js"></script>

                <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
                <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
            </head>
        <body>';

        echo($html);
    }

    public function navBar($pageTitle){
        $html = "";
        $html.='
        <div id="wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-inverse white_bg notRound">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Brand and toggle get grouped for better mobile display -->
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                            <div class="bigNavTitle">
                                                '.$pageTitle.'
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Collect the nav links, forms, and other content for toggling -->
                                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                    <ul class="nav navbar-nav navbar-right">
                                                        <li><a href="calendar.php">Mes agendas</a></li>
                                                        <li><a href="account.php">Mon compte</a></li>
                                                        <li><a href="createCalendar.php">Creer un agenda / une activité</a></li>
                                                        <li><a href="admin.php">Admin</a></li>
                                                    ';
                                                    if(isset($_SESSION['login'])){
                                                        $html.='<li><a href="deconnexion.php">Deconnexion</a></li>';
                                                    }else{
                                                        $html.='<li><a href="connexion.php">Connexion</a></li>';
                                                    }
                                            $html.='</ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>';
        echo($html);
    }


    public function body(){
        $html = "";
        $html.='
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default notRound noMargin">
                    <div class="panel-body">
                        <div class="row">
                            Calendar?
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="panel panel-default notRound noMargin">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="smallerTitle red gras noMargin">VULPUTATE ADIPISCING</h1>
                                    <p>Ici recherche et tri pour les agendas</p>
                                </div>

                                <div class="col-md-6">
                                    <div class="floatRight">
                                        Hide Option
                                        <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            ';
        //$html.= $this->calendar();
        $html.='
            </div>
            <div class="col-md-4">
                Ecrire ici une petite div pour pouvoir commenter / sabonner a lagenda selectionné / evaluer / liker et la description
            </div>
        </div>
          
        ';
        echo($html);
    }

    public function footer(){
        $html = "";
        $html.='
            </div>
        </div>
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default noMargin">
                            <div class="panel-body">
                                
                                <p class="center">&#169; CalendarFactory - 2015 - Karakayn</p>
                                    
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </footer>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

        ';
        echo($html);

        /*
                                    </div>
                        </div>
                    </div>
                </body>
            </html>  

        */
    }

    /*
        Could be on an other view file @TODO
    */

    //return string to show calendar
    public function calendar(){
        $html="";
        $html.='

            <div id="calendar"></div>

            <script src="js/myCalendar.js"></script>
            <script>
                $(document).ready(function() {
                    generateCalendar();
                });
            </script>

        ';
        return $html;
    }

    //return a string who contain a form using for connexion
    public function formConnexion(){
        $html="";
        $html.='
        <div class="col-md-12">       
            <form role="connexionForm" action="connexion.php" method="post">
                <div class="form-group">
                    <label for="login">Login :</label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Le pseudo renseigné à votre inscription">
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe :</label>
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Le mot de passe renseigné à votre inscription">
                </div>
        </div>
        <div class="col-md-6">  
                <div class="checkbox center">
                    <label><input name="remember" type="checkbox">Remember me</label>
                </div>
        </div>
            <div class="col-md-6"> 
                <div class="center"> 
                    <button type="submit" name="connexion" class="btn btn-default">Connexion</button>
                </div>
            </form>
        </div>
        ';
        return $html;
    }

    public function startingPage(){
        $html = "";
        $html.='
                <div class="container">
                    <div class="row center">
                        <div class="col-md-12">
                            <h1>Bienvenue sur CalendarFactory</h1>
                            <p>Vous souhaitez gérer vos évenements ou rendez-vous ? <a href="inscription.php">Inscrivez-vous maintenant !</a></p> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                ';
                                $html.= $this->formConnexion();
        $html.='
                            </div>
                        </div>

                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </body>
        </html>
        ';
        echo($html);
    }

    //return a string who contain a form using for registration
    public function formInscription(){
        $html="";
        $html.='
        <div class="col-md-12">       
            <form role="inscriptionForm" action="inscription.php" method="post">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" class="form-control" name="login" id="login" placeholder="Le pseudo que vous utiliserez pour vous connecter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Le mot de passe que vous utiliserez pour vous connecter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pwdConfirm">Confirmation de mot de passe :</label>
                            <input type="password" class="form-control" name="pwdConfirm" id="pwdConfirm" placeholder="Confirmation de mot de passe">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom">
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prenom">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="adresse">Adresse :</label>
                            <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Votre adresse">
                        </div>
                    </div> 
                </div>
        
                <div class="col-md-12"> 
                    <div class="center"> 
                        <button type="submit" name="inscription" class="btn btn-default">Inscription</button>
                    </div>
                </div>
            </form>
        </div>
        ';
        return $html;
    }

    public function inscriptionPage(){
        $html = "";
        $html.='
                <div class="container">
                    <div class="row center">
                        <div class="col-md-12">
                            <h1>Inscription</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                ';
                                $html.= $this->formInscription();
        $html.='
                            </div>
                        </div>

                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </body>
        </html>
        ';
        echo($html);
    }

    public function createAgendaOrActivity($dataIdAgendaOfUser){
        $html = "";
        $html.='
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Outils de création</h1>
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#createAgenda" aria-controls="createAgenda" role="tab" data-toggle="tab">Creation d\'agenda</a></li>      
                                    <li role="presentation"><a href="#createActivity" aria-controls="createActivity" role="tab" data-toggle="tab">Creation d\'activité</a></li>
                                </ul>
                                

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="createAgenda">
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-8">
                                ';
                                        $html.=$this->formCreateAgenda();
                                $html.='
                                            </div>
                                            <div class="col-md-2">
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="createActivity">
                                        <div class="row">

                                            <div class="col-md-12">
                                ';
                                        $html.=$this->formCreateActivity($dataIdAgendaOfUser);
                                $html.='
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
        ';
        echo($html);
    }

    public function formCreateAgenda(){
        $html="";
        $html.='
        <div class="col-md-12">       
            <form role="createAgendaForm" action="createCalendar.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nomAgenda">Nom de l\'agenda:</label>
                            <input type="text" class="form-control" name="nomAgenda" id="nomAgenda" placeholder="Ex : Mes cours">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="prioriteAgenda">Priorité :</label>
                            <input type="text" class="form-control" name="prioriteAgenda" id="prioriteAgenda" placeholder="Ex : 1 (si plus important qu\'un evenement 0)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="categorieAgenda">Catégorie :</label>
                            <input type="text" class="form-control" name="categorieAgenda" id="categorieAgenda" placeholder="Ex : Sport">
                        </div>
                    </div>
                </div>
                <div class="row center">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="isSuperposable" value="isSuperposable">
                            Superposition possible <br/>
                            <small>Indiquez si vous pouvez superposer plusieurs activités dans le même créneau pour votre agenda.</small>
                        </label>
                    </div>
                </div>

                <div class="row center">
                    <div class="col-md-12"> 
                        <div class="center"> 
                            <button type="submit" name="createAgenda" class="btn btn-default">Créer l\'agenda</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        ';
        return $html;
    }

    public function formCreateActivity($dataIdAgendaOfUser){
        $html="";
        $html.='
        <div class="col-md-12">       
            <form role="createActivityForm" action="createCalendar.php" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label for="nom">Nom :</label>
                                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom de votre activite">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description">Description :</label>
                                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Entrez la description de votre évenement"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="localisation">Localisation :</label>
                                <input type="text" class="form-control" name="localisation" id="localisation" placeholder="Ex : Lyon / Centre équestre etc...">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>Horaires :</label><br/>
                        <small>Entrez une date de début et une date de fin (ou une date de début et un nombre d\'occurence).<br/>
                        Si vous ne renseignez pas d\'heure, l\'evenement prendra toute la journée.</small>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="dateDebut">Date de début :</label>
                                <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="Date sous forme : jj/mm/aaaa">
                            </div>
                            <div class="col-md-6">
                                <label for="dateFin">Date de fin :</label>
                                <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="Date sous forme : jj/mm/aaaa">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="heureDebut">Heure de début :</label>
                                <input type="time" class="form-control" name="heureDebut" id="heureDebut" placeholder="Heure sous forme : 20:57">
                            </div>
                            <div class="col-md-6">
                                <label for="heureFin">Heure de fin :</label>
                                <input type="time" class="form-control" name="heureFin" id="heureFin" placeholder="Heure sous forme : 20:57">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="type">Type :</label>
                                <input type="text" class="form-control" name="type" id="type" placeholder="Type de votre activité">
                            </div>
                            <div class="col-md-6">
                                <label for="priorite">Priorité :</label>
                                <input type="text" class="form-control" name="prioriteActivity" id="priorite" placeholder="Ex : 3 (0 < 1 < 2)">
                            </div>
                        </div>

                        <div class="row center">
                            <div class="col-md-6">
                                <label for="periodicite">Périodicité de votre evenement <br/>
                                <small>(Pas défaut non périodique)</small></label>
                                <select class="form-control" name="periodicite" id="periodicite">
                                    <option>Pas périodique</option>
                                    <option>Quotidien</option>
                                    <option>Hebdomadaire</option>
                                    <option>Trimestrielle</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="occurence">Nombre d\'occurence de votre evenement <br/>
                                <small>(Laissez vide si evenement ponctuel)</small></label>
                                <input type="text" class="form-control" name="occurence" id="occurence" placeholder="Ex : 2">
                            </div>
                        </div>

                        <div class="row center">
                            <div class="col-md-12">
                                <label for="idAgenda">Agenda :<br/></label>
                                <select class="form-control" name="idAgenda" id="idAgenda">
                            ';
                            if(isset($dataIdAgendaOfUser)){
                                //$dataIdAgendaOfUser can be equal to false
                                if($dataIdAgendaOfUser){ 
                                    foreach ($dataIdAgendaOfUser as $dat => $agenda) {
                                        $html.='<option>'.$agenda->getId().' - '.$agenda->getNom().'</option>';
                                    }
                                }else{
                                    $html.='<option>Vous devez créer un agenda pour pouvoir ajouter une activité dedant</option>';
                                }
                            }else{
                                $html.='<option>Vous devez créer un agenda pour pouvoir ajouter une activité dedant</option>';
                            }
                                
                        $html.='
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row center">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="isPossibleToSubscribe" value="isPossibleToSubscribe">
                                        Inscription possible <br/>
                                        <small>(tout le monde pourra s\'inscrire à votre evenement)</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="isPublic" value="isPublic">
                                        Evenement public <br/> 
                                        <small>(tout le monde pourra voir votre evenement)</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12"> 
                        <div class="center"> 
                            <div class="row">
                                <div class="col-md-4">
                                </div> 
                                <div class="col-md-4">
                                    <button type="submit" name="createActivity" class="btn btn-default marginTop allWidth">Créer l\'activité</button>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        ';
        return $html;
    }

    public function displayAgendaList($agenda) {

        $html = '<table>';
        foreach ($agenda as $ag)
        {
            $html .= '
            <tr>
               <td>'. $ag->getId() .'</td>
               <td>'. $ag->getNom() .'</td>
               <td>'. $ag->getPriorite() .'</td>
               <td>'. $ag->getLastEdition() .'</td>
               <td>'. $ag->getIsSuperposable() .'</td>
               <td>'. $ag->getOwnerId() .'</td>
               <td><a href="modifierAgenda.php?nom='.$ag->getId().'"><img src="http://www.cesbio.ups-tlse.fr/data_all/images/16x16/edit.png" alt="Bouton edit"/>Edit</td>
               <td><a href="supprimerAgenda.php?nom='.$ag->getId().'"><img src="http://www.sportrelax-vicemil.cz/en/css/DeleteIcon.gif" alt="Bouton delete"/>Delete</td>
            </tr>
            ';
        }
        $html .= '</table>';
        echo $html;
        
    }

    public function displayUserList($users){
         $html = '<table>';
         foreach ($users as $us)
        {
            $html .= '
            <tr>
               <td>'. $us->getIdUtilisateur() .'</td>
               <td>'. $us->getLogin() .'</td>
               <td>'. $us->getPwd() .'</td>
               <td>'. $us->getNom() .'</td>
               <td>'. $us->getPrenom() .'</td>
               <td>'. $us->getAdresse() .'</td>
               <td><a href="modifierUser.php?nom='.$us->getIdUtilisateur().'"><img src="http://www.cesbio.ups-tlse.fr/data_all/images/16x16/edit.png" alt="Bouton edit"/>Edit</td>
               <td><a href="supprimerUser.php?nom='.$us->getIdUtilisateur().'"><img src="http://www.sportrelax-vicemil.cz/en/css/DeleteIcon.gif" alt="Bouton delete"/>Delete</td>
            </tr>
            ';
        }
        $html .= '</table>';
        echo $html;
    }

    public function displayCommentList($comments){
         $html = '<table>';
         foreach ($agenda as $ag)
        {
            $html .= '
            <tr>
               <td>'. $ag->getIdCommentaire() .'</td>
               <td>'. $ag->getCommentaire() .'</td>
               <td>'. $ag->getPriorite() .'</td>
               <td>'. $ag->getDateCommentaire() .'</td>
               <td>'. $ag->getHeureCommentaire() .'</td>
               <td>'. $ag->getIdCommentaireParent() .'</td>
               <td>'. $ag->getIdUtilisateur() .'</td>
               <td>'. $ag->getIdActivite() .'</td>
               <td><a href="modifierComment.php?nom='.$ag->getIdCommentaire().'"><img src="http://www.cesbio.ups-tlse.fr/data_all/images/16x16/edit.png" alt="Bouton edit"/>Edit</td>
               <td><a href="supprimerComment.php?nom='.$ag->getIdCommentaire().'"><img src="http://www.sportrelax-vicemil.cz/en/css/DeleteIcon.gif" alt="Bouton delete"/>Delete</td>
            </tr>
            ';
        }
        $html .= '</table>';
        echo $html;
    }

    public function generateAdminPanel()
    {
        $html = "";
        $html.='
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Panel Admin</h1>
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#adminUser" aria-controls="adminUser" role="tab" data-toggle="tab">Utilisateur</a></li>
                                    <li role="presentation"><a href="#adminAgenda" aria-controls="adminAgenda" role="tab" data-toggle="tab">Agenda</a></li>
                                    <li role="presentation"><a href="#adminCommentaire" aria-controls="adminCommentaire" role="tab" data-toggle="tab">Commentaires</a></li>
                                </ul>


                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="adminUser">
                                        <div class="row">
                                            <div class="col-md-2">

                                            </div>

                                            <div class="col-md-8">

                                            </div>
                                            <div class="col-md-2">
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="adminAgenda">
                                        <div class="row">

                                            <div class="col-md-12">
                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="adminCommentaire">
                                        <div class="row">

                                            <div class="col-md-12">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
        ';
        echo($html);
    }
}
?>