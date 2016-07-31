( function( $ ) {

	/* INITIALIZING VALUES */
		
		$(document).foundation();
		
		$inputCounter = 1;
		
		MODAL.closeModal();
		LOADER.closeLoader();
	
		// FOR STICKY ELEMENTS
		$( "#searchBarContainer" ).sticky({ topSpacing:0 });
		$( "#leftPanel" ).sticky({ topSpacing:0 });		
	
	/* FOR MODAL FUNCTIONALITIES */
	
		ADVANCEDSEARCH.resize();
		$( window ).resize( function() {
			ADVANCEDSEARCH.resize();
		});
		
		$selector = [
				".searchResultTitle",
				"#searchSettings",
				"#advancedSearch",
				"#recentSearchesLink",
				"#aboutLink",
				"#faqLink",
				"#collectionButton"
		];
		$selector = $selector.join();
	
		$( $selector ).on( "click", function() {
		
			$( "body" ).css( "overflow" , "hidden" );
			$( "#modalContainer" ).show();
		
			$id = "#" + $( this ).attr( "modal-link" );
			$( $id ).slideDown( "fast" );
		
			if ( $id == "#detailsModal" ){
			
				$text = $( this ).html();
				$( "#detailsModal .modalHeader #modalTitle" ).text( $text );
		
				$( ".loader" )
					.hide()
					.delay(300)
					.show(0);
						
				$( "#detailsModal .fileContainer" ).html( "" );	
			
				$link = $( "#detailsModal .fileContainer" ).attr( "url-link" ) + 
							$( this ).attr( "id" ); 
							
				$.post( $link, function( data ) {
					$( "#detailsModal .fileContainer" ).html( data );
					$( ".loader" ).hide( 0 );
					
					$( ".fileContainer #filesViewer" ).height( ($( ".gb-file-view" ).height() + 100) );
					$( ".fileContainer .json-file-view" ).height( $( ".gb-file-view" ).height() );
				});
				
			} else if ($id == "#advancedSearchModal"){
				
				$( "#row0select" )
					.html( ADVANCEDSEARCH.createOptions() );
				$( "#row0bool" )
					.html( ADVANCEDSEARCH.createBooleanOptions() );
					
			}
		
			$( ".closeModal" ).on( "click", function() {
				MODAL.closeModal(); 
			});
			
			MODAL.closeModalOuterClick();
		
		});
	
		$( ".fileContainer" ).on( "click", "#viewJSON", function(){
			
			$( "#downloadJSON" ).show();
			$( "#downloadGB" ).hide();
			
			$( "#viewJSON" )
				.html( "View GB File" )
				.attr( "id", "viewGB" );
			
			$( ".gb-file-view" ).css( "left", "-100%" );
			$( ".json-file-view" ).css( "left", "0" );
			
		});
		
		$( ".fileContainer" ).on( "click", "#viewGB", function(){	
			
			$( "#downloadGB" ).show();
			$( "#downloadJSON" ).hide();
		
			$( "#viewGB" )
				.html( "View JSON File" )
				.attr( "id", "viewJSON" );
			
			$( ".json-file-view" ).css( "left", "100%" );
			$( ".gb-file-view" ).css( "left", "0" );
			
		});
	
	
		$selector = [
			"#mainAdd"
			//".hide-for-large-up #mainAdd"
		];
		$selector = $selector.join();
		
		$( $selector ).on( "click", function(){
			
			$inputCounter++;
			ADVANCEDSEARCH.addAdditionalInput( $inputCounter );
			
			$( this ).hide();
			$( "#numberOfQueries" ).val( parseInt( $( "#numberOfQueries" ).val() ) + 1 );
		});
		
		
		$selector = [
			"#row0select"
			//".hide-for-large-up #row0select"
		];
		$selector = $selector.join();
		
		$( $selector ).on( "change", function(){
			
			$queryCount = $( this )
							.attr( "id" )
							.substr( 3 )
							.replace( /\D/g, "" );
			
			$html = "";
			
			if ( $( this ).val() == "Modification Date" || 
					$(this).val() == "Publication Date" ){
				
				$html = "<div class='row'>" +
							"<div class='large-5 columns'>" +
							"<input type='text' class='full-width' name='row" + $queryCount + "date1' placeholder='YYYY/MM/DD' required />" +
							"<small class='error'>This field is required.</small>" +
							"</div>" +
							"<div class='large-1 columns'>" +
							"<span style='line-height:37px;margin: 0 auto'>to</span>" +
							"</div>" +
							"<div class='large-5 columns end'>" +
							"<input type='text' class='full-width' name='row" + $queryCount + "date2' placeholder='present' />" +
							"</div></div>";
					
			} else {
				
				$html = "<input type='text' name='query" + $queryCount + 
							"' placeholder='Input Search Query' required />" +
							"<small class='error'>This field is required.</small>";
							
			}
			
			$inputId = "#row" + $queryCount + "input";
			$( $inputId ).html( $html );
			
			//$inputId = ".hide-for-large-up #row" + $queryCount + "input";
			//$( $inputId ).html( $html );
			
		});
	
			$selector = [
				"#additionalInputs"
				//".hide-for-large-up #additionalInputs"
			];
			$selector = $selector.join();

			$( $selector )
				.on( "click",".addEntry", function(){
				
					$inputCounter++;
					ADVANCEDSEARCH.addAdditionalInput( $inputCounter );
					$( this ).hide();
				
					$( "#maxNumberOfQueries" ).val( $inputCounter );
					//$(".hide-for-large-up #maxNumberOfQueries").val($inputCounter);
				
					$( "#numberOfQueries" ).val( parseInt( $( "#numberOfQueries" ).val() ) + 1 );
					//$(".hide-for-large-up #numberOfQueries").val(parseInt($("#numberOfQueries").val()) + 1);
				
				})
				.on( "click", ".removeEntry", function() {
				
					$elementId = "#" + $( this ).attr( "id" );
					$( "#additionalInputs " + $elementId ).remove();
					
					if ( !$.trim( $( "#additionalInputs" ).html() ).length ) {
						$( "#mainAdd" ).show();
					} else {
						$addButtonId = "#" + $( "#additionalInputs div.row:last-child" ).attr("id") + "add";
						$( $addButtonId ).show();
					}
					
					//if( !$.trim($( ".hide-for-large-up #additionalInputs" ).html()).length ){
					//	$( ".hide-for-large-up #mainAdd" ).show();
					//} else{
					//	$addButtonId = "#" + $( ".hide-for-large-up #additionalInputs div.row:last-child" ).attr("id") + "add";
					//	$( $addButtonId ).show();
					//}
					
					$( "#numberOfQueries" ).val( parseInt($( "#numberOfQueries" ).val()) - 1 );
					
				})
				.on( "change", ".advancedSearchSelect", function(){
				
					$queryCount = $( this ).attr( "id" ).substr( 3 ).replace( /\D/g, "" );
					
					$html = "";
					if( $( this ).val() == "Modification Date" || 
							$( this ).val() == "Publication Date" ){
						
						$html = "<div class='row'>" +
									"<div class='large-5 columns'>" +
									"<input type='text' class='full-width' name='row" + $queryCount + "date1' placeholder='YYYY/MM/DD' required />" +
									"<small class='error'>This field is required.</small>" +
									"</div>" +
									"<div class='large-1 columns'>" +
									"<span style='line-height:37px;margin: 0 auto'>to</span>"  +
									"</div>" +
									"<div class='large-5 columns end'>" +
									"<input type='text' class='full-width' name='row" + $queryCount + "date2' placeholder='present' />" +
									"</div></div>";
									
					} else {
						
						$html = "<input type='text' name='query" + $queryCount + 
									"' placeholder='Input Search Query' required />" +
									"<small class='error'>This field is required.</small>";
									
					}
					
					$inputId = "#row" + $queryCount + "input";
					$( $inputId ).html( $html );
					
					//$inputId = ".hide-for-large-up #row" + $queryCount + "input";
					//$( $inputId ).html( $html );
				
				});
			
		$selector = [
			"#searchSubmitButton",
			"#changeSearchSettings",
			"#submitButton",
			"#nextButton",
			"#prevButton",
			".recentSearch"
		];	
		$selector = $selector.join();
		
		$( $selector ).on( "click", function() {
			
			if ( $(this).attr("id") == "searchSubmitButton" ) {
				if ( $("#searchBar").val() !== "" ) {
					$( "#searchBar" ).attr( "readonly", "readonly" );
					$( "#loader" ).show();
					MODAL.preventMouseWheel();
				}
			} else {
				$( "#loader" ).show();
				MODAL.preventMouseWheel();
			}
			
		});

		$( "#select-all" ).on( "click", function() {
			if ( $( ".collection-select" ).prop( "checked" ) ) {
				$( ".collection-select" ).prop( "checked", false );
				$( this ).html( "Select All" );
			} else {
				$( ".collection-select" ).prop( "checked", true );
				$( this ).html( "Deselect All" );
			}
		});

		$( "#close-collection" ).on( "click", function() {
			MODAL.closeModal();
		});

		$( "#advancedSearchForm" ).on( "valid.fndtn.abide", function() {
			$( "#loader" ).show();
			MODAL.preventMouseWheel();
		});

} )( jQuery );