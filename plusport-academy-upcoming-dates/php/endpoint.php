<?php
	header('Access-Control-Allow-Origin: *');
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
		$session->SessionDates = objectToArray($session->SessionDates);
		foreach($session->SessionDates as $sessionDate)
		{
			$sessionDate->SessionDate = objectToArray($sessionDate->SessionDate);
		}
	}

	echo json_encode($response);
?>
