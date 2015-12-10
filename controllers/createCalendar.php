<?php

	require_once("private/config.php");
	require_once("views/GeneralView.class.php");
	require_once("views/ErrorOrSuccessView.class.php");
	require_once("models/Agenda.class.php");
	require_once("models/AgendaManager.class.php");

	$agendaManager = new AgendaManager($db);

	$viewG = new GeneralView();
	$errorView = new ErrorOrSuccessView();

	$viewG->header("Creation d'agenda ou d'activité");
	$viewG->navBar("Creation d'agenda ou d'activité");

	if(isset($_SESSION['login'])){
		if(isset($_POST['createAgenda'])){
			$nomAgenda = htmlspecialchars($_POST['nomAgenda']);
			$prioriteAgenda = htmlspecialchars($_POST['prioriteAgenda']);
			if($nomAgenda == '' && $priorite == ''){
				$errorView->errorNeedToCompleteForm();
			}else{

				//check is la valeur de isSuperposable
					$isSuperposable = 1;
				$isSuperposable = 0;
				$data['id'] = null;
				$data['nom'] = $nomAgenda;
				$data['priorite'] = $prioriteAgenda;
				$data['lastEdition'] = null;
				$data['isSuperposable'] = $isSuperposable;
				$data['ownerId'] = $_SESSION['idUser'];
				$agenda = new Agenda($data);
				if($agendaManager->add($agenda)){
					$nomCategorie = htmlspecialchars($_POST['categorieAgenda']);
					if($nomCategorie != ''){
						if(!($idCategorie = checkCategorieExist($nomCategorie))){
							//this categorie dos not exist -> we add it in database
							if($agendaManager->addCategorie($nomCategorie)){
								//insert success -> get the id
								$idCategorie = checkCategorieExist($nomCategorie); 
							}else{
								//error the categorie was not add in DB
								$errorView->errorGeneral();
							}
						}
						//we already have idCategorie in $idCategorie -> join agenda and categorie
						if($agendaManager->addCategorieAgenda($idAgenda, $idCategorie)){
							//all work -> success message
							$errorView->successAgendaCreated();
						}else{
							//link between categorie and agenda failed
							$errorView->errorGeneral();
						}
					}
					$errorView->successAgendaCreated();
					/*$errorView->redirection(1);
					header('Refresh: 1; url=calendar.php');
					Marche pas a cause despace introuvable <<
					*/
				}else{
					$errorView->errorAgendaCreateFailed();
				}
			}
			//we want to create an activity / event
		}elseif (isset($_POST['createActivity'])) {
			$dataActivity["name"] = htmlspecialchars($_POST['nom']);

			//we always need a title for us event
			if($dataActivity["name"] == ""){
				$errorView->errorNeedToCompleteForm();
			}else{
				$dataActivity["description"] = htmlspecialchars($_POST['description']);
				$dataActivity["geoPos"] = htmlspecialchars($_POST['localisation']);
				$dataActivity["startDate"] = htmlspecialchars($_POST['dateDebut']);
				$dataActivity["endDate"] = htmlspecialchars($_POST['dateFin']);
				$dataActivity["startHour"] = htmlspecialchars($_POST['heureDebut']);
				$dataActivity["endHour"] = htmlspecialchars($_POST['heureFin']);
				$dataActivity['type'] = htmlspecialchars($_POST['type']);
				$dataActivity["periodicity"] = htmlspecialchars($_POST['periodicite']);
				$dataActivity["nbOccur"] = htmlspecialchars($_POST['occurence']);

				//in all case if we dont have a starting date > error
				if($dataActivity["startDate"] == ""){
					$errorView->errorNeedToCompleteForm();
				}else{
					//if we dont have a starting date + a ending date or a startDate + a periodicity or a number of occurence > error
					if($dataActivity["endDate"] == "" || $dataActivity["periodicite"] == "" || $dataActivity["occurence"] == ""){
						$errorView->errorNeedToCompleteForm();
					}else{
						//start to add in database us activity
						require_once("models/Activity.class.php");
						require_once("models/ActivityManager.class.php");
						$activityManager = new ActivityManager($db);
						$activity = new Activity($dataActivity);
					}
				}
			}
		}else{
			$dataIdAgenda[] = $agendaManager->getAllAgenda($_SESSION['idUser']);
			$viewG->createAgendaOrActivity($dataIdAgenda);
		}
	}else{
		$errorView->errorNotConnected();
	}
	
	$viewG->footer();
?>