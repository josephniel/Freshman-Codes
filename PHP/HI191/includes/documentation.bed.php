<section id='general-information' class='row'>	
	<h5 class='text-center'>Bed Capacity / Occupancy</h5>
	
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
				<td>updateAuthorizedNumberOfBeds</td>
				<td>
					<ul class='no-bullet'>
						<li>$number</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's number of authorized beds for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateNumberOfBedsByPay</td>
				<td>
					<ul class='no-bullet'>
						<li>$number</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's number of beds by pay classification for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateNumberOfBedsByService</td>
				<td>
					<ol>
						<li>$medicine</li>
						<li>$obstetrics</li>
						<li>$gynecology</li>
						<li>$pediatrics</li>
						<li>$pedia_surgery</li>
						<li>$adult_surgery</li>
					<ol>
				</td>
				<td>
					<p>
						Updates the hospital's number of beds by service classification for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	
</section>