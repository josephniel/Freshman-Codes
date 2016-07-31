<section id='general-information' class='row'>	
	<h5 class='text-center'>Financial Status</h5>
	
	<table>
		<thead id='stick-table-1'>
			<tr>
				<th>Field Name</th>
				<th>Parameters</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>updateFinancialStatus</td>
				<td>
					<ol style='padding-left:10px;'>
						<li>$total_budget</li>
						<li>$total_income</li>
						<li>$total_expenditures</li>
					</ol>
				</td>
				<td>
					<p>
						Updates the hospital's financial status for the year's record; If record doesn't exist, it creates the record. 
					</p>
				</td>
			</tr>
			
			<tr>
				<td class='level-2'>updateTotalBudget</td>
				<td>
					<ul class='no-bullet' style='padding-left:10px;'>
						<li>$total</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's total budget for the year's record; If record doesn't exist, it creates the record. 
					</p>
				</td>
			</tr>
			<tr>
				<td class='level-2'>updateTotalIncome</td>
				<td>
					<ul class='no-bullet' style='padding-left:10px;'>
						<li>$total</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's total income for the year's record; If record doesn't exist, it creates the record. 
					</p>
				</td>
			</tr>
			<tr>
				<td class='level-2'>updateTotalExpenditures</td>
				<td>
					<ul class='no-bullet' style='padding-left:10px;'>
						<li>$total</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's total expenditures for the year's record; If record doesn't exist, it creates the record. 
					</p>
				</td>
			</tr>
		</tbody>
	</table>
</section>