<div class='evpSearchFunction searchFunction'>
	
	<form method='post' class='evpSearchSubmit'>
		<p><span>Search:</span><input type='text' name="query" id="query" placeholder='Input search query here' class='searchBar'></p>
		<p><div class='fixedWidth orange'>Search by</div>
			<select id='searchCategory' name="searchCategory" class='searchCategory floatLeft'>
				<option value='vendorId'>Vendor ID</option>
				<option value='vendorName' selected>Vendor Name</option>
				<option value='productId'>Product ID</option>
				<option value='genericName'>Generic Name</option>
				<option value='brandName'>Brand Name</option>
			</select>
			<div class='fixedWidth orange mediumMarginLeft'>Sort by</div>
			<select id='sortCategory' name="sortCategory" class="searchCategory floatLeft">
				<option value='vendorNameaz' selected>Vendor Name (A-Z)</option> 
				<option value='genericNameaz'>Generic Name (A-Z)</option> 
				<option value='brandNameaz'>Brand Name (A-Z)</option> 
			</select>
			<input type='submit' value='Search' class="searchButton green mediumMarginLeft">
		</p>
	</form>
	
	<div class='tableFormat'>
		<div class='row tableHeaderRow move'>
			<div class='column1 column tableHeader'>Vendor Name</div>
			<div class='column2 column tableHeader'>Generic Name</div>
			<div class='column3 column tableHeader'>Brand Name</div>
		</div>
		<div class='horizontalScroll searchResults'>
			
		</div>
		
	</div>
</div>