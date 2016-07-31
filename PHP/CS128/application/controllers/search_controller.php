<?php

class Search_controller extends CI_Controller {

	private $retMax, 
			$sortType, 
			$cookie_expiry;

	public function __construct(){
		parent::__construct();
		 
		// This block of code sets the session data for retMax and sortType to its default 
		// when session variables are not found in the current session. 
			if($this->session->userdata('retMax')) $this->retMax = $this->session->userdata('retMax');
			else $this->retMax = 10;
			if($this->session->userdata('sortType')) $this->sortType = $this->session->userdata('sortType');
			else $this->sortType = 'none';

			$this->cookie_expiry = (86500 * 30); // 30 days
	}	

	
	public function search(){	
		
		$this->session->unset_userdata('searchQuery');
		
		// The data to be passed to the view files
		$data['title'] = 'Search Page - GenBank Search Implementation';
		
		// Loads the view files
		$this->load->view('main/header', $data);
		$this->load->view('main/container');
		$this->load->view('main/footer');
			
		// Resets the UIDs stored in the session
		$this->search_model->resetUIDs();
		
		// Redirects the page to the search result once searchQuery is present
		if ($this->input->post('searchQuery')) 
			redirect('../searchResults/?searchQuery='.$this->input->post('searchQuery').'&page=1');
	}
	
	
	public function searchResults(){		
		
		// Retrieves and stores the data from the get method
		$searchQuery = $this->input->get('searchQuery');
		$currentPageNumber = $this->input->get('page');
		
		// Sets the session data for the current search query
		$this->session->set_userdata('searchQuery', $searchQuery);
		 
		// This block of code stores the recent search query in a cookie 
		// to be retrieved and put in the recent search panel of the system
			
			if(!$this->input->cookie('count')){
				$cookie = array(
					'name'   => 'count',
					'value'  => '1',
					'expire' => $this->cookie_expiry,
					'path'   => '/'
				);
				$this->input->set_cookie($cookie);
				
				$cookie = array(
					'name'   => 'hist1',
					'value'  => $searchQuery,
					'expire' => $this->cookie_expiry,
					'path'   => '/'
				);
				$this->input->set_cookie($cookie);
			} 
			else{			
				$toCount = true;	
				for($x = 1; $x <= $this->input->cookie('count'); $x++){
					if($this->input->cookie('hist'.$x) == $this->input->get('searchQuery')){
						$toCount = false;
					}
				}
				if($toCount){
						$cookie = array(
							'name' => 'count',
							'value' => $this->input->cookie('count') + 1,
							'expire' => $this->cookie_expiry,
							'path'   => '/'
						);
						$this->input->set_cookie($cookie);
						
						$cookie = array(
							'name' => 'hist'.($this->input->cookie('count') + 1),
							'value' => $searchQuery,
							'expire' => $this->cookie_expiry,
							'path'   => '/'
						);
						$this->input->set_cookie($cookie);
				}
			}
		
		/*
		* This block of code retrieves the UID of a particular range
		* indicated by retStart and retMax where 
		* retStart is the starting index and
		* retMax is the number of results to retrieve
		* 
		* $array returns 2 values:
		* 	$array[0] returns the total count of the whole search query
		* 	$array[1] returns an array of UIDs 
		*/
			$retStart = ($currentPageNumber - 1) * $this->retMax;
			$array = $this->search_model->getUIDs(
							$retStart, 
							$this->retMax, 
							$this->sortType, 
							$searchQuery);
		
		// ** Explain this line of code
		if ($this->session->userdata('page'.$currentPageNumber.'UIDs')) {
			$data['checked'] = $this->session->userdata('page'.$currentPageNumber.'UIDs');
		}
	
		// This block of code generates the content for each search entry
		// within a specific range indicated on the block of codes above
			$totalCount = $array[0];
			$UIDs = $array[1];
			
			$data['summary'] = false;
			if ( count($UIDs) !== 0 ) {
				$UIDArray = '';
				foreach($UIDs as $UID) $UIDArray .= $UID . ',';

				$remainingResults = $totalCount - (($currentPageNumber-1) * $this->retMax);
				if($remainingResults >= $this->retMax) $summary = $this->search_model->getSummary($UIDArray, $this->retMax);
				else $summary = $this->search_model->getSummary($UIDArray, $remainingResults);
				
				$data['summary'] = $summary;	
			} 
		
		// Prepares the data to be passed to the view
			$data['title'] = 'Search Results | ' . $searchQuery;
			$data['currentPageNumber'] = $currentPageNumber;
			$data['searchQuery'] = $searchQuery;
			$data['retMax'] = $this->retMax;
			$data['sortType'] = $this->sortType;
			$data['totalCount'] = $totalCount;
		
		// Initializes the view files to be used.
			$this->load->view('main/header', $data);
			$this->load->view('main/container');
			$this->load->view('main/footer');
	}
	
	
	public function permalink($UID = ''){
		
		// The data to be passed to the view files
		$data['UID'] = $UID;
		
		if(!file_exists("assets/generated/gb/".$UID.".gb")){
			$data['gbFile'] = $this->search_model->getFile($UID, 'text');
		} else{
			$file = fopen("assets/generated/gb/".$UID.".gb", 'r');
			$data['gbFile'] = fread($file, filesize("assets/generated/gb/".$UID.".gb"));
			fclose($file);
		}
		
		if(!file_exists("assets/generated/json/".$UID.".json")){
			$data['jsonFile'] = json_encode(simplexml_load_string($this->search_model->getFile($UID, 'XML')), JSON_PRETTY_PRINT);
		} else{
			$file = fopen("assets/generated/json/".$UID.".json", 'r');
			$data['jsonFile'] = fread($file, filesize("assets/generated/json/".$UID.".json"));
			fclose($file);
		}
		
		// Loads the view files
		$this->load->view('modal/permalink_view', $data);
	}

	public function updateUIDs() {
		
		// Retrieves and stores the data from the post method
		$currentPage = $this->input->post('current_page');
		$accessionIDs = $this->input->post('AccessionIDs');

		/*
		* This block of code deals with the batch processing of selected search results.
		* Selected search results would be put into the session to be used for other functions
		* at a later time.
		* 	
		* Note: Batch processing means that selected search results would only be added to the 
		* 		session for the list of UIDs to be used once this function is called by
		*		either the next button, the previous button, or the submit button.
		*/
			if($accessionIDs){
				$this->session->set_userdata('page'.$currentPage.'UIDs', $this->input->post('AccessionIDs'));
			
				if(!$this->session->userdata('activePages')) {
					$this->session->set_userdata('activePages', array($currentPage));
				} 
				else if(!in_array($currentPage, $this->session->userdata('activePages'))) {
					$activePages = $this->session->userdata('activePages');
					$activePages[] = $currentPage;
					$this->session->set_userdata('activePages', $activePages);
				}
			}
			else{
				$array = $this->session->userdata('activePages');
				$key = array_search($currentPage, $array);
				if($key !== false){
					unset($array[$key]);
					$this->session->set_userdata('activePages', $array);
					$this->session->unset_userdata('page'.$currentPage.'UIDs');
				}
			}
		
		// This block of code redirects the user to its right destination in the system.
		switch($this->input->post('submit')) {
			case "Next":
				redirect('../searchResults/?searchQuery='.$this->input->post('search_query').'&page='.($currentPage + 1));
				break;
			case "Previous":
				redirect('../searchResults/?searchQuery='.$this->input->post('search_query').'&page='.($currentPage - 1));
				break;
			case "Add to Collections":
				redirect('../addToCollections/'.$currentPage);
				break;
			default:
				break;
		}
	}
	
	
	public function handleAdvancedSearch(){
		
		/*
		* This block of code concatenates the additional input search queries 
		* added by the user in the advanced search panel.
		*
		* Returns:
		*	$searchString -  the concatinated search string
		*
		* Note: The implementation of the advanced search is derived from 
		*		the implementation of the advanced search in the ncbi website  
		*/
		if (!empty($_POST)) {
			if (isset($_POST['maxNumberOfQueries'])) {
				$searchString = ""; $prevCategory = ""; $temp = "";
				$maxNumberOfQueries = $_POST['maxNumberOfQueries'];
				foreach($_POST as $key => $value) {
						
					$keyWord = substr($key, 0, strlen($key) - 1);
						
					if($keyWord == "searchQuer") {
						$prevCategory = "All Fields";
						$searchString .= $value;
					}
					else if ($keyWord == "category") {		
						$prevCategory = $value;
					}
					else if ($keyWord == "query") {
						if ($prevCategory == "All Fields") {
							$temp = $value;
						}
						else if ($prevCategory != "Modification Date" || $prevCategory != "Publication Date") {
							$temp = "$value&#91;$prevCategory]";
						}
						$searchString .= $temp;
					}
					else if (strpos($keyWord,'date') !== false) {
						if ((substr($key, strlen($key) - 1)) == 1) {
							$temp = "($value&#91;$prevCategory]  : ";
						}
						else {
							if (trim($value) == "") {
								$value = 3000;
							}
							$temp .= "$value&#91;$prevCategory])";
							$searchString .= $temp;
						}
					}
					else if ($keyWord == "bool") {
						$searchString = "($searchString) $value ";
					}
				}
				$searchString = str_replace("&#91;", "[", $searchString);
			}
		}
		
		// Redirects the page after concatinating the given search queries
		redirect('../searchResults/?searchQuery='.$searchString.'&page=1');
	}
	
	
	public function handleSearchSettings(){
		
		// Retrieves and stores the data from the post method
		$retMax = $this->input->post('displayCount');
		$sortType = $this->input->post('displaySort');
		
		/*
		* Sets the session variables to be accessed at the constructor to be used by
		* the function getUIDs() in search_model
		*
		* Note: sortType and retMax are used in determining how the search results should be displayed
		*	$sortType - the way the search results are sorted
		*	$retMax - the maximum number of results to show at a particular page
		*/
		$this->session->set_userdata('sortType', $sortType); 
		$this->session->set_userdata('retMax', $retMax);
		
		// Redirects the page to the first page of the search results
		redirect('../searchResults/?searchQuery='.$this->session->userdata('searchQuery').'&page=1');
	}
	
	
	public function jsonDownload($UID = ''){
		
		/*
		* This block of code sends a header request to the browser for download.
		* The downloaded file that comes with the a unique identifier and a .json extension, 
		* is a file containing the JSON format of the flat files of the selected search results
		*/
			header("Content-disposition: attachment; filename=".$UID.".json");
			header("Content-type: text/plain");
			readfile("./assets/generated/json/".$UID.".json");
	}
	
	public function gbDownload($UID = ''){
		
		/*
		* This block of code sends a header request to the browser for download.
		* The downloaded file that comes with the a unique identifier and a .gb extension, 
		* is a file containing the GB format of the flat files of the selected search results
		*/
			header("Content-disposition: attachment; filename=".$UID.".gb");
			header("Content-type: text/plain");
			readfile("./assets/generated/gb/".$UID.".gb");
	}
	
	
	public function addToCollections($currentPage = '1'){
		
		// Selected UIDs are collated
		$UIDs = $this->search_model->collateUIDs();
		$to_fetch = $UIDs;
		
		/*
		* This block of code selects eligible entities for fetching. 
		* This is done to lessen the overhead the fecthing takes for multiple entities
		* in the case that some entities on the current list is already in the cookie
		* and need to be fetched anymore. 
		*/
			if($this->input->cookie('summary_uids')){
				
				unset($to_fetch);
				$to_fetch = array();
				
				$summary_uids = json_decode($this->input->cookie('summary_uids'), true);
				foreach($UIDs as $UID){
					if(!in_array($UID, $summary_uids)){
						$to_fetch[] = $UID;
						$summary_uids[] = $UID;
					}
				}
				$UIDs = $summary_uids;
				
			}
		
		
		/*
		* This block of code updates the summary_uids cookie
		* used in the earlier checking.
		*/
			$cookie = array(
				'name'   => 'summary_uids',
				'value'  => json_encode($UIDs),
				'expire' => $this->cookie_expiry,
				'path'   => '/'
			);
			$this->input->set_cookie($cookie);
		
		/*
		* This block of code fetches the summary for UIDs not present in the 
		* current cookie and merges the result of the fetched summary with
		* the summary of the current cookie
		*/
			$UIDArray = implode(',', $to_fetch);
			$summary = $this->search_model->getSummary($UIDArray, count($to_fetch));

			if($this->input->cookie('summary')){
				$past = json_decode($this->input->cookie('summary'), true);
				$summary = array_merge($past, $summary);
			}
		
		/*
		* This block of code stores the merged array as a cookie
		*/
			$cookie = array(
				'name'   => 'summary',
				'value'  => json_encode($summary),
				'expire' => $this->cookie_expiry,
				'path'   => '/'
			);
			$this->input->set_cookie($cookie);	
		
		// redirects back to the last page where the user left
		redirect('../searchResults/?searchQuery='.$this->session->userdata('searchQuery').'&page='.$currentPage);
	}


	
	public function collectionsDownload() {

		$filetype = $this->input->post('format');
		
		if ($filetype === "blastp") {
			
			$this->useBLASTP();
			
		} else if($filetype !== "delete"){
	
			// sets the format for retrieval 
			if ($filetype === "gb")	$format = "GB";
			else if($filetype === "json") $format = "JSON";
			
			foreach ($this->input->post("motherload") as $UID) {
			
				/* 
				* This block of code checks if file to add to the zip file exists
				* in the system. If it isn't present, it fetches the file and stores
				* it in the system. 
				*/
					if( !file_exists("assets/generated/gb/".$UID.".gb") && 
							!file_exists("assets/generated/json/".$UID.".json") ){
					
						$xml = simplexml_load_string($this->search_model->getFile($UID, "XML"));
						$jsonFile = json_encode($xml, JSON_PRETTY_PRINT);
						$file = fopen("assets/generated/json/".$UID.".json", "w");
						fwrite($file, $jsonFile);
						fclose($file);
					
						$gbFile = $this->search_model->getFile($UID, "text");
						$file = fopen("assets/generated/gb/".$UID.".gb", "w");
						fwrite($file, $gbFile);
						fclose($file);
					
					} 				
			
				/*
				* This block of code reads the files stored in the system to be put
				* in the zip file.
				*/
					$file = fopen("assets/generated/".$filetype."/".$UID.".".$filetype, "r");
					$data = fread($file, filesize("assets/generated/".$filetype."/".$UID.".".$filetype));
					fclose($file);

					$name = "individual_files/".$UID.".".$filetype;
					$this->zip->add_data($name, $data);

			}

			/*
			* This block of code retrieves the file containing
			* the combined files for the selected uids
			*/
			$UIDs = implode(',',$this->input->post("motherload"));
			if($format == 'GB'){
				$data = $this->search_model->getFile($UIDs, "text") or die;
				$name = "collection.".$filetype;
				$this->zip->add_data($name, $data);
			} else {
				$data = json_encode(simplexml_load_string($this->search_model->getFile($UIDs, "XML")), JSON_PRETTY_PRINT);
				$name = "collection.".$filetype;
				$this->zip->add_data($name, $data);
			}
		
			$this->zip->download("collection.".$filetype.".zip");
		
		} else{
			
			/*
			* This block of code removes the selected entities in the cookie
			* by retrieving the cookie for both summary and summary_uids
			* and comparing the uids of the selected entities with the 
			* uids in the summary_uids and the GI in the entity in summary 
			*/
				$uids = json_decode($this->input->cookie('summary_uids'), true);
				$summary = json_decode($this->input->cookie('summary'), true);
			
				foreach ($this->input->post("motherload") as $UID) {
					foreach($uids as $key => $x){
						if($UID == $x){
							unset($uids[$key]);
							$uids = array_values($uids);
							break;
						}
					}
					foreach($summary as $key => $y){
						if($UID == $y['gi']){
							unset($summary[$key]);
							$summary = array_values($summary);
							break;
						}
					}
				}

			/*
			* This block of code updates the 
			* summary and summary_uids cookies
			*/
				$cookie = array(
					'name'   => 'summary_uids',
					'value'  => json_encode($uids),
					'expire' => $this->cookie_expiry,
					'path'   => '/'
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
					'name'   => 'summary',
					'value'  => json_encode($summary),
					'expire' => $this->cookie_expiry,
					'path'   => '/'
				);
				$this->input->set_cookie($cookie);

			// redirects back to homepage
			redirect('../');

		}
	}
	
	public function useBLASTP(){
		
		/*
		* This block of code sends a UIDs to the blastp program by ncbi
		* and redirects the user to the blastp result page.
		*/
		
		$url1 = "http://www.ncbi.nlm.nih.gov/blast/Blast.cgi?QUERY=";
		$url2 = "";
		
		$UIDs = $this->input->post("motherload");
		for ($i = 0; $i < count($UIDs); $i++) {
			$url2 .= $UIDs[$i];
			if($i < count($UIDs) - 1) $url2 .= "%0A";
		}
		
		$url3 = "&PROGRAM=blastp&PAGE_TYPE=BlastSearch&LINK_LOC=blasthome&NEWWIN=yes";	
		
		$url_new = $url1.$url2.$url3;
		
		redirect($url_new,"refresh");
	}
			
}