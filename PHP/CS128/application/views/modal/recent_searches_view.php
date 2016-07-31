<?php 
if($this->input->cookie('hist1')){ ?>
	<ol class='no-margin-bottom'>
	<?php
	for($x = $this->input->cookie('count'); $x > 0; $x--){ ?>
		<li class='medium-margin-bottom'>
			<a href="<?php echo base_url('searchResults/?searchQuery='.$this->input->cookie('hist'.$x).'&page=1') ?>" class="recentSearch">
				<?php echo $this->input->cookie('hist'.$x) ?>
			</a>
		</li>
	<?php } ?>
	</ol>
<?php } ?>