<div id='modalContainer' class='transition'>
	<div id='modalInnerContainer'>

		<div id='detailsModal' class='modal'>
		
			<div id='detailsModalHeader' class='modalHeader'>
				<h3 id='modalTitle'></h3>
				<a class="closeModal">&#215;</a>
			</div>
			<img src='<?php echo base_url('assets/images/page-loader.gif')?>' class='loader' />
			<div class='fileContainer' url-link='<?php echo base_url('permalink') ?>/'></div>
			
		</div>
			
		<div id='advancedSearchModal' class='modal'>
			<div class='modalHeader'>
				<h3 id='modalTitle'>Advanced Search</h3>
				<a class="closeModal">&#215;</a>
			</div>
			<?php $this->view('modal/advanced_search_view') ?>
		</div>
		
		<div id='searchSettingsModal' class='modal'>
			<div class='modalHeader'>
				<h3 id='modalTitle'>Search Settings</h3>
				<a class="closeModal">&#215;</a>
			</div>
			<?php $this->view('modal/search_settings_view') ?>
		</div>
		
		<div id='recentSearchesModal' class='modal'>
			<div class='modalHeader'>
				<h3 id='modalTitle'>Recent Searches</h3>
				<a class="closeModal">&#215;</a>
			</div>
			<div class='innerModal'>
				<?php $this->view('modal/recent_searches_view') ?>
			</div>
		</div>
		
		<div id='aboutModal' class='modal'>
			<div class='modalHeader'>
				<h3 id='modalTitle'>About the Project</h3>
				<a class="closeModal">&#215;</a>
			</div>
			<div class='innerModal'>
				<?php $this->view('modal/about_view') ?>
			</div>
		</div>
		
		<div id='faqModal' class='modal'>
			<div class='modalHeader'>
				<h3 id='modalTitle'>Frequently Asked Questions</h3>
				<a class="closeModal">&#215;</a>
			</div>
			<div class='innerModal'>
				<?php $this->view('modal/faq_view') ?>
			</div>
		</div>
			
		<div id='collectionsModal' class='modal'>
			<div class='modalHeader'>
				<h3 id='modalTitle'>Collections</h3>
				<a class="closeModal">&#215;</a>
			</div>
			<?php $this->view('modal/collections_view') ?>
		</div>
			
	</div>
</div>