<div class='mdSearchFunction searchFunction'>
	
	<form method='post' class='mdSearchSubmit'>
		<p><span>Search:</span><input type='text' name="query" id="query" placeholder='Input search query here' class='searchBar'></p>
		<p><div class='fixedWidth orange'>Search by</div>
			<select id='searchCategory' name="searchCategory" class='searchCategory floatLeft'>
				<option value='productId' >Product Code</option>
				<option value='genericName' selected>Generic Name</option>
				<option value='brandName'>Brand Name</option>
			</select>
			<input type='hidden' id='fullname' value='<?php echo $fullname ?>'>
			<input type='submit' value='Search' class="searchButton green mediumMarginLeft">
		</p>
	</form>
	
	<h4>Delivery Entries</h4>
	
	<div class='tableFormat'>
		<div class='row tableHeaderRow move'>
			<div class='column0 column tableHeader'>Date Received</div>
			<div class='column1 column tableHeader'>Product Code</div>
			<div class='column2 column tableHeader'>Generic Name</div>
			<div class='column3 column tableHeader'>Brand Name</div>
		</div>
		<div class='horizontalScroll searchResults'>
		
		</div>
		
	</div>
</div>

<form class='submitEditForm' name='submitEditForm' method='POST'>
	<input type='hidden' name='editedEntry' id='editedEntry'>
</form>
