<?php
	
	require_once("./assets/class/lib/nusoap.php");

	$client = new nusoap_client("http://202.92.148.163/~jntuazon/HI191/post.php");

		define('USERID','123456');
		define('PASSWORD','qwerty');

		$connect = $client->call('connect', array(USERID, PASSWORD));
	
		echo $client->call('updateHospitalRegion', array("NCR", $connect));
		echo $client->call('updateHospitalRegion', array("", $connect));
		echo $client->call('hasMedicalRecordsCommittee', array(true, 'hey', $connect));
		echo $client->call('hasMedicalRecordsCommittee', array(false, '', $connect));
		echo $client->call('updateNumberOfSpecialist', array('contractual', '100', $connect));
		echo $client->call('updateContractualStaff', array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1, $connect));
		echo $client->call('updateContractualStaff', array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0, $connect));
		echo $client->call('hasTechnicalCommittee', array(true,'',true,'',false,'',true,'hey',false,'invalid',false,'',false,'',true,'',false,'',true,'',false,'', $connect));
		echo $client->call('updateFinancialStatus', array(1, 1, 1, $connect));


	echo "<h2>Request</h2>";
	echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
	echo "<h2>Response</h2>";
	echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";