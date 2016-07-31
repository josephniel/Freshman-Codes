<?php
	
	function updateFinancialStatus($total_budget, $total_income, $total_expenditures, $user_id){
		$return = updateTotalBudget($total_budget, $user_id);
		$return .= updateTotalIncome($total_income, $user_id);
		$return .= updateTotalExpenditures($total_expenditures, $user_id);
		return $return;
	}

		function updateTotalBudget($total, $user_id){
			return setField($total, $user_id, 80);
		}
		
		function updateTotalIncome($total, $user_id){
			return setField($total, $user_id, 81);
		}
		
		function updateTotalExpenditures($total, $user_id){
			return setField($total, $user_id, 82);
		}