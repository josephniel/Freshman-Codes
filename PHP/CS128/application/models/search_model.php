<?php

class Search_model extends CI_Model{
	
	private $database = 'protein';

	/**
	* getUIDs - function that retrieves the whole XML file for search and parses the XML for its UIDs
	* Parameters:
	*	$retStart - start of search return count
	*	$retMax - maximum number of search result return
	*	$sortType - the sort display for the search result
	* 	$searchQuery - the search query
	* Returns:
	*	$array - an array containing the UIDs of the particular range of search result and the total count of searches
	*/
	public function getUIDs($retStart, $retMax, $sortType, $searchQuery){	
		
		$uids = array();
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?'.
				'db='.$this->database.
				'&term='.urlencode($searchQuery).
				'&retstart='.$retStart.
				'&retmax='.$retMax.
				'&sort='.$sortType;
	
		if (@simplexml_load_file($url)){
			$xml = simplexml_load_file($url);
		
			$totalCount = $xml->Count[0];
			$UIDs = $xml->IdList[0];
				
			$counter = 0;
			if(sizeof($UIDs) != 0){
				while($counter != sizeof($UIDs)){
					$uids[$counter] = $UIDs->Id[$counter];
					$counter++;
				}
				$array[0] = $totalCount;
				$array[1] = $uids;
				return $array;
			}
		}
		return false;
	}
	
	/**
	* getSummary - function that retrieves the summary of a particular UID
	* Parameters:
	*	$UID - the unique identifier of the search result whose summary is to be fetched
	*	$count - number of items to retrieve
	* Returns:
	*	$summary - an array containing the summary of basic information about the search result
	*/
	public function getSummary($UID, $count){
		
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?'.
				'db='.$this->database .
				'&id='.$UID;

		if(@simplexml_load_file($url)){
			$xml = simplexml_load_file($url);
			
			$summary = array();
			
			$counter = 0;
			while($counter != $count){
				$summary[$counter]['title'] = (string) $xml->DocSum[$counter]->Item[1];
				$summary[$counter]['accessionId'] = (string) $xml->DocSum[$counter]->Item[0];
				$summary[$counter]['gi'] = (string) $xml->DocSum[$counter]->Item[3];
				$counter++;
			}
			return $summary;
		} 
		return false;
	}
	
	/**
	* getFile - function that retrieves a single file of a particular format and stores the content in a variable as String
	* Parameters:
	*	$UIDs - a single UID or a string representation of an array of UIDs with comma as separator
	*	$type - the type of file to retrieve
	* Returns:
	*	$flatFile - String representation of the content of the flat file 
	*/
	public function getFile($UIDs, $type){
		
		set_time_limit(0); // disables the time limit for retrieval of external entity
		
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?'.
				'&db='.$this->database.
				'&id='.$UIDs.
				'&retmode='.$type;
		
		if($type == 'text') $url .= '&rettype=gb';
		
		$file_content = file_get_contents($url);
		if($file_content !== false) return $file_content;
		return false;
	}

	/**
	* collateUIDs - function that collates all the UIDs of results selected from all "active" pages, 
	* 				wherein an "active" page has at least one result selected 
	* Parameters:
	*	none
	* Returns:
	*	$UIDs - all selected UIDs
	*/
	public function collateUIDs() {
		
		$activePages = $this->session->userdata('activePages');
		
		if(count($activePages) !== 0) {
			$UIDs = array();
			foreach ($activePages as $activePage)
				foreach ($this->session->userdata('page'.$activePage.'UIDs') as $UID)
					$UIDs[] = $UID;
			return $UIDs;	
		}
		return false;
	}

	/**
	* resetUIDs - 	function that unsets the session variable of the previously selected UIDs from
	*				previous searches.
	* Parameters:
	* 	none
	* Returns:
	*	none
	*/
	public function resetUIDs(){
		
		$this->session->unset_userdata('searchQuery');
		
		if($this->session->userdata('activePages')){
			foreach($this->session->userdata('activePages') as $activePage)
				$this->session->unset_userdata('page'.$activePage.'UIDs');
			$this->session->unset_userdata('activePages');
		}
		
	}
	
}