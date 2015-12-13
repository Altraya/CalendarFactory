<?php

	require_once("../private/config.php");
	require_once("../models/AgendaManager.class.php");
	require_once("../views/GeneralView.class.php");

	$agendaManager = new AgendaManager($db);
	$gView = new GeneralView();


	//get all URL params
	$params = urldecode(http_build_query($_GET, '', '&'));
	//get just ids params > last param is for date
	$idPart = explode('&', $params, -1);

	/*
		generate an array who have the same key without value
		Example : 
		For $params = id_0=60&id_1=61&id_2=62&date='2015-12-01
		$idPart will have :
		array (size=3)
			0 => string 'id_0=60' (length=7)
			1 => string 'id_1=61' (length=7)
			2 => string 'id_2=62' (length=7)

		$arrayBase will have :
		array (size=3)
			0 => string 'id_0=' (length=5)
			1 => string 'id_1=' (length=5)
			2 => string 'id_2=' (length=5)

		Then agendasId array will contain only agendasId 
		array (size=3)
			0 => string '60' (length=2)
			1 => string '61' (length=2)
			2 => string '62' (length=2)

	*/
	$arrayBase = generateArrayIdNum(count($idPart));

	$agendasId = array();
	for ($i=0; $i < count($idPart); $i++) { 
		$agendasId[] = str_replace($arrayBase[$i],'', $idPart[$i]);
	}

	//get date
	$date = htmlspecialchars($_GET['date']);

	$infos = $agendaManager->getAllActivitiesByDate($agendasId, $date);

	$gView->dayCalendar($infos);

	//Generate an array because we want to do diff with the other
	function generateArrayIdNum($length){
		$arrayNum = array();
		for ($i=0; $i < $length; $i++) { 
			$arrayNum[] = "id_$i=";
		}
		return $arrayNum;
	}

?>