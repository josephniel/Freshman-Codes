<section id='general-information' class='row'>	
	<h5 class='text-center'>General Information</h5>
	
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
				<td>updateHospitalName</td>
				<td>
					<ul class='no-bullet'>
						<li>$name</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital name for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalAddress</td>
				<td>
					<ul class='no-bullet'>
						<li>$address</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital address for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalRegion</td>
				<td>
					<ul class='no-bullet'>
						<li>$region</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital region for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalCatchmentPopulation</td>
				<td>
					<ul class='no-bullet'>
						<li>$population</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's catchment population for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalContactNumber</td>
				<td>
					<ul class='no-bullet'>
						<li>$contact_number</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's contact number for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalFaxNumber</td>
				<td>
					<ul class='no-bullet'>
						<li>$fax_number</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's fax number for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalEmail</td>
				<td>
					<ul class='no-bullet'>
						<li>$email</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital's email address for the year's record; If record doesn't exist, it creates the record.
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalLevel</td>
				<td>
					<ul class='no-bullet'>
						<li>$level</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital level for the year's record; If record doesn't exist, it creates the record.
					</p>
					<br>
					<p>
						<ul class='no-bullet'>
							<li><b>Accepted Values</b></li>
							<li class='left-padding'>Level 1 Hospital</li>
							<li class='left-padding'>Level 2 Hospital</li>
							<li class='left-padding'>Level 3 Hospital (Non-Teaching and  Non-Training)</li>
							<li class='left-padding'>Level 4 Hospital (Teaching and Training)</li>
						</ul>
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalType</td>
				<td>
					<ul class='no-bullet'>
						<li>$type</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital type for the year's record; If record doesn't exist, it creates the record.
					</p>
					<br>
					<p>
						<ul class='no-bullet'>
							<li><b>Accepted Values</b></li>
							<li class='left-padding'>General</li>
							<li class='left-padding'>Specific - [Specify]</li>
						</ul>
					</p>
				</td>
			</tr>
			<tr>
				<td>updateHospitalOwnership</td>
				<td>
					<ul class='no-bullet'>
						<li>$ownership</li>
					</ul>
				</td>
				<td>
					<p>
						Updates the hospital ownership for the year's record; If record doesn't exist, it creates the record.
					</p>
					<br>
					<p>
						<ul class='no-bullet'>
							<li><b>Accepted Values</b></li>
							<li class='left-padding'>National - DOH Retained/Renationalized</li>
							<li class='left-padding'>Local</li>
							<li class='left-padding'>Other Government Agency - [Specify]</li>
							<li class='left-padding'>Single Proprietorship/Partnership/Corp.</li>
							<li class='left-padding'>Religious</li>
							<li class='left-padding'>Civic Organization</li>
							<li class='left-padding'>Foundation</li>
						</ul>
					</p>
				</td>
			</tr>
			<tr>
				<td>updateCertification</td>
				<td>
					<ol>
						<li>$name</li>
						<li>$period</li>
					</ol>
				</td>
				<td>
					<p>
						Updates the hospital's certification for the year's record; If record doesn't exist, it creates the record.
					</p>
					<br>
					<p>
						<ul class='no-bullet'>
							<li><b>Accepted Values for Name</b></li>
							<li class='left-padding'>PCAHO</li>
							<li class='left-padding'>Certified ISO - [Specify]</li>
							<li class='left-padding'>Other Certifying Body - [Specify]</li>
						</ul>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	
</section>