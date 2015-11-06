<?php

	require_once("views/GeneralView.class.php");

	$viewG = new GeneralView();

	require_once("views/ErrorOrSuccessView.class.php");

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
				require_once("models/Agenda.class.php");
				require_once("private/config.php");
				require_once("models/AgendaManager.class.php");
				$agendaManager = new AgendaManager($db);
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
		}elseif (isset($_POST['createActivity'])) {
			# code...
		}else{
			$viewG->createAgendaOrActivity();
		}
	}else{
		$errorView->errorNotConnected();
	}
	
	$viewG->footer();
?>