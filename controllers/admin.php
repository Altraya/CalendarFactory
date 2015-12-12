<?php

require_once("views/GeneralView.class.php");
require_once("private/config.php");
require_once("views/GeneralView.class.php");
require_once("views/ErrorOrSuccessView.class.php");
require_once("models/Agenda.class.php");
require_once("models/AgendaManager.class.php");
require_once("models/User.class.php");
require_once("models/UserManager.class.php");

$viewG = new GeneralView();
$manager = new AgendaManager($db);

$viewG->header("CalendarFactory");
$viewG->navBar("Admin");
$viewG->generateAdminPanel();
$viewG->displayAgendaList($manager->getAllAllAgenda());
$viewG->footer();
?>