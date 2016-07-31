<?php
	if(
		!file_exists("assets/generated/gb/".$UID.".gb") 
		&& !file_exists("assets/generated/json/".$UID.".json") 
		&& strlen($jsonFile) != 0 
		&& strlen($gbFile) != 0
	){
		$file = fopen("assets/generated/json/".$UID.".json", "w");
		fwrite($file, $jsonFile);
		fclose($file);
			
		$file = fopen("assets/generated/gb/".$UID.".gb", "w");
		fwrite($file, $gbFile);
		fclose($file);
	}
?>

<div class='show-for-large-up'>

	<div id='filesViewer' class='transition'>
	
		<pre class='gb-file-view transition'><?php echo $gbFile ?></pre>
		<pre class='json-file-view transition'><?php echo $jsonFile ?></pre>
		
	</div>
		
	<div class='row modalFooter'>
		
		<div class='large-3 columns no-padding-right'>
			<button id='toggler' class='full-width' value='<?php echo $UID ?>' onclick="PERMALINK.toggleEntry(this)"></button>
		</div>
		
		<div class='large-3 large-offset-3 columns no-padding-right'>
			<button class='full-width' id='viewJSON'>View JSON File</button>
		</div>
			
		<div id='downloadJSON' class='large-3 columns no-padding-right'>
			<a href='<?php echo base_url('search_controller/jsonDownload/'.$UID) ?>'>	
				<button class='full-width'>Download JSON</button>
			</a>
		</div>
			
		<div id='downloadGB' class='large-3 columns no-padding-right'>
			<a href='<?php echo base_url('search_controller/gbDownload/'.$UID) ?>'>	
				<button class='full-width'>Download GB</button>
			</a>
		</div>
		
	</div>
	
</div>

<div class='hide-for-large-up'>

	<div class='large-padding large-margin'>
	
		Preview of file is only available on large screen resolutions. 
		<br><br>
		Download and view it on your device instead.
		
	</div>

	<div class='row modalFooter' style='padding-top: 0;'>
		
		<div class='medium-6 columns large-margin-top'>
			<a href='<?php echo base_url('search_controller/jsonDownload/'.$UID) ?>'>	
				<button class='full-width'>Download JSON</button>
			</a>
		</div>
		
		<div class='medium-6 columns large-margin-top'>
			<a href='<?php echo base_url('search_controller/gbDownload/'.$UID) ?>'>	
				<button class='full-width'>Download GB</button>
			</a>
		</div>
		
	</div>

</div>

<script>PERMALINK.setButtonDisplay(document.getElementById("toggler"))</script>