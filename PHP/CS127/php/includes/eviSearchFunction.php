<div class='epSearchFunction searchFunction'>
	
	<form method='post' class='eviSearchSubmit'>
		<p><span>Search:</span><input type='text' name="query" id="query" placeholder='Input search query here' class='searchBar'></p>
		<p><div class='fixedWidth orange'>Search by</div>
			<select id='searchCategory' name="searchCategory" class='searchCategory floatLeft'>
				<option value='vendorId'>Vendor ID</option>
				<option value='vendorName' selected>Vendor Name</option>
			</select>
			<div class='fixedWidth orange mediumMarginLeft'>Sort by</div>
			<select id='sortCategory' name="sortCategory" class="searchCategory floatLeft">
				<option value='vendorIdaz' selected>Vendor ID (A-Z)</option>
				<option value='vendorNameaz'>Vendor Name (A-Z)</option> 
			</select>
			<input type='submit' value='Search' class="searchButton green mediumMarginLeft">
		</p>
	</form>
	
	<div class='tableFormat'>
		<div class='row tableHeaderRow move'>
			<div class='column1 column tableHeader'>Vendor ID</div>
			<div class='column2 column tableHeader'>Vendor Name</div>
			<div class='column3 column tableHeader'>Contact Number</div>
		</div>
		<div class='horizontalScroll searchResults'>
			
		</div>
		
	</div>
</div>