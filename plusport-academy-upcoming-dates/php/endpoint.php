<?php
	header('Access-Control-Allow-Origin: *');

	if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) <= strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']))
	{
		header('HTTP/1.0 304 Not Modified');
		exit;
	}

	header('Content-type: application/json');
	date_default_timezone_set('UTC');
	$secondsToEndOfDay = strtotime('tomorrow') - time();
	$tomorrow = gmdate("D, d M Y H:i:s", time() + $secondsToEndOfDay) . " GMT";
	header("Expires: $tomorrow");
	header("Pragma: cache");
	header("Cache-Control: max-age=$secondsToEndOfDay");
	$secondsSinceMidnight = time() - strtotime("today");
 	header("Last-Modified: " . gmdate('D, d M Y 00:00:00', time()) . ' GMT');

	require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
	error_reporting(E_ERROR); // Show only errors

	function objectToArray($object)
	{
		if(!is_array($object))
		{
			$array = array();
			array_push($array, $object);
			return $array;
		}
		return $object;
	}

	$company_id = get_option('pp_academy_portal_id', '');
	$company_guid = get_option('pp_academy_portal_guid', '');
	$linkToWebshop = $_GET['pp_academy_link_to_webshop'];
	$mergedSessionDates = $_GET['pp_academy_merge_sessiondates'];

	switch(get_option('pp_academy_environment', ''))
	{
		case 'live':
			$soapURL = "http://sl.plusport.com/Academy.svc?wsdl";
			break;
		case 'staging':
			$soapURL = "http://staging.plusport.com/Academy.svc?wsdl";
			break;
		case 'test':
		default:
			$soapURL = "http://test.plusport.com/Academy.svc?wsdl";
			break;
	}

	$client = new SoapClient($soapURL);

	// $userInfo = new ArrayObject();
	$userInfo->p_usr_login = get_option('pp_academy_username', '');
	$userInfo->p_usr_password = get_option('pp_academy_password', '');

	$userInfoResult = $client->getUserInfo($userInfo)->getUserInfoResult;
	$session_guid = $userInfoResult->SessionGuid;

	// $trainingdata = new ArrayObject();
	$trainingdata->p_session_guid = $userInfoResult->SessionGuid;
	$trainingdata->p_intTrainingID = $_GET['pp_academy_trainings_id'];
	$trainingdata->p_intMonth = '';
	$trainingdata->p_intYear = '';
	$trainingdata->p_strState = '';
	$trainingdata->p_intResults = $_GET['pp_academy_maxsession'];

	$response = $client->getTrainingSessionList($trainingdata);
	$response->getTrainingSessionListResult->SessionInfo = objectToArray($response->getTrainingSessionListResult->SessionInfo);

	foreach ($response->getTrainingSessionListResult->SessionInfo as $session)
	{
		if($linkToWebshop)
		{
			$url = 'https://plusportdashboard.com/formulier/getPakket.php?training_id=' . $session->TrainingID;
			$json = file_get_contents($url);
			$data = json_decode($json);

			$session->WebshopCategorie = $data->categorie_id;
			$session->WebshopPakket = $data->pakket_id;
			$session->LinkToWebshop = !empty($data->pakket_id) && !empty($data->categorie_id) ? true : false;
		} else
		{
			$session->WebshopCategorie = '';
			$session->WebshopPakket = '';
			$session->LinkToWebshop = false;
		}
		$session->SessionDates = objectToArray($session->SessionDates);

		foreach($session->SessionDates as $sessionDate)
		{
			$sessionDate->SessionDate = objectToArray($sessionDate->SessionDate);
		}

		if($mergedSessionDates)
		{
			$session->SessionDates[0]->SessionDate[0]->DateUntil = $session->SessionDates[count($session->SessionDates)-1]->SessionDate[count($session->SessionDates[count($session->SessionDates)-1]->SessionDate)-1]->DateUntil; // Set last session until date in first session date
			$session->SessionDates[0]->SessionDate = array_slice($session->SessionDates[0]->SessionDate, 0, 1); // Remove all other sessiondate dates
			$session->SessionDates = array_slice($session->SessionDates, 0, 1); // Remove all other session dates
		}
	}

	echo json_encode($response);
?>
