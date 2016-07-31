<?php
	if(!$retMax) $retMax = 10;
	if(!$sortType) $sortType = 'none';

	echo form_open(base_url('search_controller/handleSearchSettings')); ?>
	
		<div class='row innerModal'>
			
			<div class='large-6 columns'>
			
				<h5>Search Result Display Count</h5>
				
				<hr>
				
				<div class='row'>
				
					<div class='large-4 columns'>
						<input type="radio" name="displayCount" value="5" id="d1" 
						<?php if($retMax == 5){ echo 'checked'; } ?>>
						<label for='d1'>5</label><br>
						
						<input type="radio" name="displayCount" value="50" id="d4" 
						<?php if($retMax == 50){ echo 'checked'; } ?>>
						<label for='d4'>50</label>
					</div>
					
					<div class='large-4 columns'>
						<input type="radio" name="displayCount" value="10" id="d2" 
						<?php if($retMax == 10){ echo 'checked'; } ?>>
						<label for='d2'>10</label><br>
						
						<input type="radio" name="displayCount" value="100" id="d5" 
						<?php if($retMax == 100){ echo 'checked'; } ?>>
						<label for='d5'>100</label>
					</div>
					
					<div class='large-4 columns'>
						<input type="radio" name="displayCount" value="20" id="d3" 
						<?php if($retMax == 20){ echo 'checked'; } ?>>
						<label for='d3'>20</label><br>
						
						<input type="radio" name="displayCount" value="200" id="d6" 
						<?php if($retMax == 200){ echo 'checked'; } ?>>
						<label for='d6'>200</label>
					</div>
					
				</div>
				
			</div>
			
			<div class='large-6 columns'>
			
				<h5>Search Result Display Sort</h5>
				
				<hr>
				
				<div class='row'>
					<div class='large-6 columns'>
						<input type="radio" name="displaySort" value="none" id="s1"  
						<?php if($sortType == "none"){ echo 'checked'; } ?>>
						<label for='s1'>Default order</label><br>
						
						<input type="radio" name="displaySort" value="MDAT" id="s2"  
						<?php if($sortType == "MDAT"){ echo 'checked'; } ?>>
						<label for='s2'>Date Modified</label><br>
						
						<input type="radio" name="displaySort" value="ORGN" id="s3"  
						<?php if($sortType == "ORGN"){ echo 'checked'; } ?>>
						<label for='s3'>Organism Name</label>
					</div>
					<div class='large-6 columns'>
						<input type="radio" name="displaySort" value="ACCN" id="s4" 
						<?php if($sortType == "ACCN"){ echo 'checked'; } ?>>
						<label for='s4'>Accession</label><br>
						
						<input type="radio" name="displaySort" value="PDAT" id="s5"  
						<?php if($sortType == "PDAT"){ echo 'checked'; } ?>>
						<label for='s5'>Date Released</label><br>
						
						<input type="radio" name="displaySort" value="TAXID" id="s6"  
						<?php if($sortType == "TAXID"){ echo 'checked'; } ?>>
						<label for='s6'>Taxonomy ID</label>
					</div>
				</div>
			
			</div>
		
		</div>
		
		<div class='row modalFooter'>
			<div class='large-4 large-offset-8 end'>
				<?php
					$data = array(
						'id'		=> 'changeSearchSettings',
						'class' 	=> 'button full-width no-margin',
						'value'    	=> 'Change Settings'
					);
					echo form_submit($data);
				?>
			</div>
		</div>
			
	<?php echo form_close() ?>
	
