<?php

	function updateAuthorizedNumberOfBeds($number, $user_id){
		return setField($number, $user_id, 13);
	}
	
	function updateNumberOfBedsByPay($number, $user_id){
		return setField($number, $user_id, 14);
	}
	
	function updateNumberOfBedsByService($medicine, $obstetrics, $gynecology, $pediatrics, $pedia_surgery, $adult_surgery, $user_id){
		return updateNumberOfBedsMedicine($medicine, $user_id)
				. updateNumberOfBedsObstetrics($obstetrics, $user_id)
				. updateNumberOfBedsGynecology($gynecology, $user_id)
				. updateNumberOfBedsPediatrics($pediatrics, $user_id)
				. updateNumberOfBedsPediaSurgery($pedia_surgery, $user_id)
				. updateNumberOfBedsAdultSurgery($adult_surgery, $user_id);
	}
		function updateNumberOfBedsMedicine($number, $user_id){
			return setField($number, $user_id, 15);
		}
		function updateNumberOfBedsObstetrics($number, $user_id){
			return setField($number, $user_id, 16);
		}
		function updateNumberOfBedsGynecology($number, $user_id){
			return setField($number, $user_id, 17);
		}
		function updateNumberOfBedsPediatrics($number, $user_id){
			return setField($number, $user_id, 18);
		}
		function updateNumberOfBedsPediaSurgery($number, $user_id){
			return setField($number, $user_id, 19);
		}
		function updateNumberOfBedsAdultSurgery($number, $user_id){
			return setField($number, $user_id, 20);
		}
