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
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-inverse black notRound">
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
                                                        <li><a href="admin.php">Admin</a></li>
                                                        <li><a href="connexion.php">Connexion</a></li>
                                                        <li><a href="deconnexion.php">Deconnexion</a></li>                                                </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div><!-- /.navbar-collapse -->
                                
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
        ';

        echo($html);
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
                        
                ';
        $html.= $this->formConnexion();

        $html.='
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

                                        <div class="row">
                                            <div class="panel panel-default notRound">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <span class="glyphicon glyphicon-th-large moreTransparent" aria-hidden="true"></span>
                                                            <span class="glyphicon glyphicon-list red" aria-hidden="true"></span>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="inlineuh floatRight">
                                                                <div class="miniMarginRight gras inlineuh">Show</div>
                                                                <select class="form-control notRound inlineuh selectWidth">
                                                                    <option>12 per pages</option>
                                                                    <option>24 per pages</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="inlineuh floatRight">
                                                                <div class="miniMarginRight gras inlineuh">Sort by</div>
                                                                
                                                                <select class="form-control notRound inlineuh selectWidth">
                                                                    <option>position</option>
                                                                    <option>others</option>
                                                                </select>
                                                                
                                                                <span class="glyphicon glyphicon-arrow-up miniMarginLeft" aria-hidden="true"></span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                             
                                    </div>
                                </div>
          
        ';
        echo($html);
    }

    public function footer(){
        $html = "";
        $html.='
        <footer>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="center">&#169; CalendarFactory - 2015 - Karakayn</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

            <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>

        ';
        echo($html);

        /**
                                    </div>
                        </div>
                    </div>
                </body>
            </html>  

        */
    }
}
?>