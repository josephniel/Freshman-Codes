MODAL = {
	
	closeModal : function () {
		/* SPECIAL CONDITION FOR ADVANCED SEARCH */
			$inputCounter = 1;
			$( "#additionalInputs" ).html( "" );
			$( "#mainAdd" ).show();
		
		/* SPECIAL CONTION FOR COLLECTIONS */
			COLLECTION.resetValidation();
			
		$selector = [
			"#modalContainer",
			"#detailsModal",
			"#advancedSearchModal",
			"#searchSettingsModal",
			"#recentSearchesModal",
			"#aboutModal",
			"#faqModal",
			"#collectionsModal"
		];
		$selector = $selector.join();
		$( $selector ).hide();
		
		$( "body" ).css( "overflow" , "auto" );
		$( ".loader" ).show();
	}, 
	closeModalOuterClick : function () {
		$(document).mouseup( function( e ) {
			if( !$( ".modal" ).is( e.target ) && $( ".modal" ).has( e.target ).length === 0 && 
					(
						$( "#modalInnerContainer" ).is( e.target ) || 
						$( "#modalInnerContainer .show-for-large-up" ).is( e.target ) ||
						$( "#modalInnerContainer .hide-for-large-up" ).is( e.target )
					) ){
				MODAL.closeModal();
			}
		});
	},
	preventMouseWheel : function () {
		$( "body" ).on({ "mousewheel" : function( e ) {
				e.preventDefault();
				e.stopPropagation();
			}
		});
	}
	
}

LOADER = {
	
	closeLoader : function () {
		/* SPECIAL CONDITION FOR SEARCH BAR IN SEARCH PANEL */
			$( "#searchBar" ).removeAttr( "readonly" );
		
		$( "body" ).css( "overflow" , "auto" );
		$( "#loader" ).hide();
	}
	
}
	
ADVANCEDSEARCH = {
	
	resize : function () {
		if ( $( window ).width() <= 640 ) {
			$( "#advancedSearchInnerModal" )
				.attr( "class", "" )
				.css( "padding", "20px 10px" );
		} else {
			$( "#advancedSearchInnerModal" )
				.attr( "class", "innerModal" )
				.attr( "style", "" );
		}
	},
	createOptions : function () {
		$html = "<option value='All Fields'>All Fields</option>" +	
					"<option value='Accession'>Accession</option>" +
					"<option value='Assembly'>Assembly</option>" +
					"<option value='Author'>Author</option>" +
					"<option value='BioProject'>BioProject</option>" +
					"<option value='Breed'>Breed</option>" +
					"<option value='Cultivar'>Cultivar</option>" +
					"<option value='Division'>Division</option>" +
					"<option value='EC/RN Number'>EC/RN Number</option>" +
					"<option value='Feature Key'>Feature Key</option>" +
					"<option value='Filter'>Filter</option>" +
					"<option value='Gene Name'>Gene Name</option>" +
					"<option value='Isolate'>Isolate</option>" +
					"<option value='Issue'>Issue</option>" +
					"<option value='Journal'>Journal</option>" +
					"<option value='Keyword'>Keyword</option>" +
					"<option value='Modification Date'>Modification Date</option>" +
					"<option value='Molecular Weight'>Molecular Weight</option>" +
					"<option value='Organism'>Organism</option>" +
					"<option value='Page Number'>Page Number</option>" +
					"<option value='Primary Accession'>Primary Accession</option>" +
					"<option value='Primary Organism'>Primary Organism</option>" +
					"<option value='Properties'>Properties</option>" +
					"<option value='Protein Name'>Protein Name</option>" +
					"<option value='Publication Date'>Publication Date</option>" +
					"<option value='SeqID String'>SeqID String</option>" +
					"<option value='Sequence Length'>Sequence Length</option>" +
					"<option value='Strain'>Strain</option>" +
					"<option value='Substance Name'>Substance Name</option>" +
					"<option value='Text Word'>Text Word</option>" +
					"<option value='Title'>Title</option>" +
					"<option value='Volume'>Volume</option>";
		return $html;
	},
	createBooleanOptions : function () {
		$html = "<option value='AND'>AND</option>" +
					"<option value='OR'>OR</option>" +
					"<option value='NOT'>NOT</option>";
		return $html;
	},
	addAdditionalInput : function ( counter ) {
		$html = "<div id='row" + counter + "' class='row'>" +
					"<div class='large-2 small-5 columns'>" +
					"<select name='bool" + counter + "' id='row" + counter + "bool'>" +
					ADVANCEDSEARCH.createBooleanOptions() +
					"</select>" +
					"</div>" +
					"<div class='large-3 small-7 columns'>" +
					"<select name='category" + counter + "' id='row" + counter + "select' class='advancedSearchSelect'>" +
					ADVANCEDSEARCH.createOptions() +
					"</select>" +
					"</div>" +
					"<div class='large-5 columns' id='row" + counter + "input'>" +
					"<input type='text' name='query" + counter + "' placeholder='Input Search Query' required=''/>" +
					"<small class='error'>This field is required.</small>" +
					"</div>" +
					"<div class='large-1 small-6 columns'>" +
					"<input type='button' value='-' id='row" + counter + "' class='button advancedSearchButton removeEntry'/>" +
					"</div>" +
					"<div class='large-1 small-6 columns'>" +
					"<input type='button' value='+' id='row" + counter + "add' class='button advancedSearchButton addEntry'/>" +
					"</div>" +
					"<hr class='hide-for-large-up'>" +
					"</div>";
					
		$("#additionalInputs").append($html);
	}
	
}

PERMALINK = {
	
	toggleEntry : function ( entry ) {
		if ( document.getElementById( entry.value ).checked == "checked" || 
				document.getElementById( entry.value ).checked == true ) {
			document.getElementById( entry.value ).checked = false;
		} else {
			document.getElementById( entry.value ).checked = true;
			document.getElementById( entry.value ).checked = "checked";
		}
		MODAL.closeModal();
	},
	setButtonDisplay : function ( button ) {
		gi = button.value;
		if ( document.getElementById(gi).checked == "checked" || 
				document.getElementById(gi).checked == true) {
			button.innerHTML = "Remove Entry";
		} else {
			button.innerHTML = "Add Entry";
		}
	}
	
}

COLLECTION = {
	
	validateForm : function ( checkboxesName, format ) {
		
		var form = document.getElementById( "collectionItems" );
		var checkboxes = document.getElementsByName( checkboxesName );
		var selected = false;  
		
		if( format == "blastp" ){
			$( "#collectionItems" ).attr( "target", "_blank" );
		} else {
			$( "#collectionItems" ).attr( "target", "" );
		}
		
		for ( var i = 0; i < checkboxes.length; i++ ) {
			if( checkboxes[i].checked ) {
				selected = true;
				document.getElementsByName( "format" )[0].value = format;
				form.submit();
			}
		}

		if ( !selected ){
			$( "#collectionItems .error" ).show();
		}
	},
	resetValidation : function (){
		$( "#collectionItems .error" ).hide();
	}
	
}