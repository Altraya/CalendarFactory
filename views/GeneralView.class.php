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

                <link href="css/metro.css" rel="stylesheet">
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
                                                        <li><a href="search.php">Rechercher</a></li>
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


    public function body($tabIdAgenda){

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
                                    <h1 class="smallerTitle noMargin">Options</h1>
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
            <div class="col-md-12">
            ';
        $html.= $this->calendar($tabIdAgenda);
        $html.='
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
    public function calendar(Array $tabIdAgenda){
        $html="";
        $html.='

        <script src="js/metro.js"></script>
        <script src="js/myCalendar.js"></script>
            <div class="darcula" data-role="calendar" data-week-start="1" data-locale="fr" data-day-click="day_click"></div>
            ';
        $html.= $this->modal();
        if($tabIdAgenda){
            $html.='
                <script>
                    function day_click(short, full) {
                        $(\'#myModalLabel\').html("Activités de vos agendas du "+short);
                        $(\'#myModalBody\').html(function(){

                        $.ajax({
                            url: \'script/getInfosShowAgenda.php?'.http_build_query($tabIdAgenda).'&date=\'+short, 
                            type: \'GET\',
                            success: function(msg){
                                $(\'#myModalBody\').html(msg);
                            }
                        })
                            
                        });
                        $(\'#myModal\').modal(\'show\');
                        console.log("hey Short: "+short+"\nFull: " + full);
                    }
                </script>
            ';
        }else{
            $html.='
                <script>
                    function day_click(short, full) {
                        $(\'#myModalLabel\').html("Activités de vos agendas du "+short);
                        $(\'#myModalBody\').html(function(){
                            Vous n\'avez pas d\'activité à cette date.
                        });
                        $(\'#myModal\').modal(\'show\');
                        console.log("hey Short: "+short+"\nFull: " + full);
                    }
                </script>
            ';
        }
        return $html;
    }

    public function dayCalendar($data){
        $lastIdActivite = 0;
        $lastColor = "hotpink";
        $tab = array(); //contain color for a same event
        $couple = array(); //couple id - color

        $html="";
        if($data){
            $html.='
                <table class="table table-striped table-condensed table-responsive">
                    <thead>

                    </thead>
                    <tbody>
                ';
                
                    for ($i=0; $i < 24; $i++) {
                    $html.='
                            <tr>
                                <td id='.$i.'>'.$i.':00</td>
                        ';
                                $timeI = date('H:i:s', mktime($i, 0, 0, 0,0,0)); //Borne inf
                                $timeAfterI =  date('H:i:s', mktime($i+1, 0, 0, 0,0,0)); //Borne supp

                                foreach ($data as $key => $act) {
                                    //if we have an event in this creneau
                                    if($act->getStartHour() <= $timeI && $act->getEndHour() >= $timeAfterI){
                                        //don't touch color if we have the same activity > one activity is with the same color

                                        if(!in_array($act->getIdActivity(), $couple)){
                                            $lastColor = $this->generateColor();
                                            $couple[] = $act->getIdActivity();
                                            $couple[] = $lastColor;
                                        }else{
                                            //search the key where the id of us activity is
                                            $keyTab = array_search($act->getIdActivity(), $couple);
                                            //the next key in the array will have the good color
                                            $keyColor = $keyTab + 1;
                                            $lastColor = $couple[$keyColor];
                                        }
                                            $html.='<td style=background-color:'.$lastColor.'>'.$act->getIdActivity() .' - '.$act->getTitle().' - '.$act->getDescription().'</td>';
                                            $lastIdActivite = $act->getIdActivity();
                                    }else{
                                        $html.='<td></td>';
                                    }
                                }
                    $html.='

                            </tr>
                        ';
                    }
                    $html.='
                    </tbody>
                </table>
            ';
        }else{
            $html.='<div class="center"> Vous ne disposez d\'aucun agenda qui possède une activité à cette date.</div>';
        }
        echo($html);
    }

    public function generateColor(){
        $autorizedColor = array(
            0 => "hotpink",
            1 => "#F7BE81",
            2 => "#A9D0F5",
            3 => "#FA5858",
            4 => "#9FF781",
            5 => "#BE81F7",
            6 => "#FA5882",
            7 => "#F3F781"
        );

        $result = rand(0, 7);
        
        $color = $autorizedColor[$result];

        return $color;

    }

    //show a modal 
    public function modal(){
        $html="";
        $html.='

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body" id="myModalBody">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
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

    public function displayAgendaList($agendas) {

        $html = '<table class="table table-striped">
         <tr>
                   <td>Id</td>
                   <td>Nom</td>
                   <td>Priorité</td>
                   <td>Dernière activité</td>
                   <td>Est superposable</td>
                   <td>Id Propriétaire</td>
                   <td>Edit</td>
                   <td>Delete</td>
                </tr>
        ';
        if($agendas != '')
        {
            foreach ($agendas as $ag)
            {
                $html.='
                <tr>
                   <td>'. $ag->getId() .'</td>
                   <td>'. $ag->getNom() .'</td>
                   <td>'. $ag->getPriorite() .'</td>
                   <td>'. $ag->getLastEdition() .'</td>
                   <td>'. $ag->getIsSuperposable() .'</td>
                   <td>'. $ag->getOwnerId() .'</td>
                   <td><a href="modifierAgenda.php?idAgenda='.$ag->getId().'"><img src="http://www.cesbio.ups-tlse.fr/data_all/images/16x16/edit.png" alt="Bouton edit"/>Edit</td>
                   <td><a href="supprimerAgenda.php?idAgenda='.$ag->getId().'"><img src="http://www.sportrelax-vicemil.cz/en/css/DeleteIcon.gif" alt="Bouton delete"/>Delete</td>
                </tr>
                ';
            }
        }
        $html .= '</table>';
        return $html;
        
    }

    public function displayUserList($users){
        $html = '<table class="table table-striped">
        <tr>
                   <td>Id</td>
                   <td>Login</td>
                   <td>Mot de passe</td>
                   <td>Nom</td>
                   <td>Prénom</td>
                   <td>Adresse</td>
                   <td>Edit</td>
                   <td>Delete</td>
                </tr>
        ';
        if($users != '')
        {
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
                   <td><a href="modifierUser.php?idUser='.$us->getIdUtilisateur().'"><img src="http://www.cesbio.ups-tlse.fr/data_all/images/16x16/edit.png" alt="Bouton edit"/>Edit</td>
                   <td><a href="supprimerUser.php?idUser='.$us->getIdUtilisateur().'"><img src="http://www.sportrelax-vicemil.cz/en/css/DeleteIcon.gif" alt="Bouton delete"/>Delete</td>
                </tr>
                ';
            }
        }
        $html .= '</table>';
        return $html;
    }

    public function displayCommentList($comments){
        $html = '<table class="table table-striped">
        <tr>
            <td>Id</td>
           <td>Commentaire</td>
           <td>Date d\'écriture</td>
           <td>Heure d\'écriture</td>
           <td>Id commentaire parent</td>
           <td>Id auteur</td>
           <td>Id activité associée</td>
           <td>Edit</td>
           <td>Delete</td>
        </tr>
          ';
        if($comments != ''){
            foreach ($comments as $com)
            {
                $html .='
                <tr>
                   <td>'. $com->getIdCommentaire() .'</td>
                   <td>'. $com->getCommentaire() .'</td>
                   <td>'. $com->getDateCommentaire() .'</td>
                   <td>'. $com->getHeureCommentaire() .'</td>
                   <td>'. $com->getIdCommentaireParent() .'</td>
                   <td>'. $com->getIdUtilisateur() .'</td>
                   <td>'. $com->getIdActivite() .'</td>
                   <td><a href="modifierComment.php?idCom='.$com->getIdCommentaire().'"><img src="http://www.cesbio.ups-tlse.fr/data_all/images/16x16/edit.png" alt="Bouton edit"/>Edit</td>
                   <td><a href="supprimerComment.php?idCom='.$com->getIdCommentaire().'"><img src="http://www.sportrelax-vicemil.cz/en/css/DeleteIcon.gif" alt="Bouton delete"/>Delete</td>
                </tr>
                ';
            }
        }
        $html.='</table>';
        return $html;
    }

    public function generateAdminPanel($dataTabUser, $dataTabAgenda, $dataTabComment)
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
                                            <div class="col-md-12">
                                            ';
                                                $html.= $this->displayUserList($dataTabUser);
                                    $html.='
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="adminAgenda">
                                        <div class="row">

                                            <div class="col-md-12">
                                            ';
                                                $html.= $this->displayAgendaList($dataTabAgenda);
                                    $html.='
                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="adminCommentaire">
                                        <div class="row">

                                            <div class="col-md-12">
                                            ';
                                                $html.= $this->displayCommentList($dataTabComment);
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
}
?>