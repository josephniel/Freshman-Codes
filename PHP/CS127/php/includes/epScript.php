<script>
$(function() {

	function removeModal() {
		$('body').css('overflow','auto');
		$('.modal').hide();
	}

	/*AJAX for classification*/
	$('#updateClassification').on('change',function(){
		$classification = $('#updateClassification').val();
		$updatedProductId = $('#updateProductId').val();
		
		$updatedProductId = $classification + $updatedProductId.substr($updatedProductId.indexOf('-'));
		$('#updateProductId').val($updatedProductId);
	});	
	
	/*AJAX for subclassification*/
	$('#updateSubClassification').on('change',function(){
		$subclassification = $('#updateSubClassification').val();
		$updatedProductId = $('#updateProductId').val();
		$updatedProductId = $updatedProductId.substr(0,1) + $subclassification + $updatedProductId.substr($updatedProductId.indexOf('-'));
		$('#updateProductId').val($updatedProductId);
	});	
	
	/*AJAX for generic name*/
	$('#updateGenericName').on('input',function(){
		$updateGenericName = $('#updateGenericName').val();
		$updateGenericName = $updateGenericName.toUpperCase();
		$('#updateGenericName').val($updateGenericName);
	});	
	/*AJAX for brand name*/
	$('#updateBrandName').on('input',function(){
		$updatedBrandName = $('#updateBrandName').val();
		$updatedBrandName = $updatedBrandName.toUpperCase();
		$('#updateBrandName').val($updatedBrandName);
		$updatedProductId = $('#updateProductId').val();
		$updatedProductIdNum = $updatedProductId.substr($updatedProductId.length-1,1);
		if($updatedBrandName.length <3){
			$updatedProductId = $updatedProductId.substr(0,$updatedProductId.indexOf('-')+1) + $updatedBrandName;
			$noOfAsterisk = 3 - $updatedBrandName.length;
			$asterisk = '';
			while($noOfAsterisk>0){
				$asterisk += '*';
				$noOfAsterisk--;
			}
			$updatedProductId += $asterisk + + $updatedProductIdNum;
		}else{
			$updatedProductId = $updatedProductId.substr(0,$updatedProductId.indexOf('-')+1) + $updatedBrandName.substr(0,3) 
			+ $updatedProductIdNum	;
		}
		$('#updateProductId').val($updatedProductId);
	});	

	/*FOR EDIT PRODUCT SUBMIT*/
	$('.updateSubmit').on('click',function(){
		$valid = true;
		$error = '';
		
		$updateBrandName = $('#updateBrandName').val();
		$updateBrandName = $updateBrandName.trim();
		$('#updateBrandName').val($updateBrandName);
		if($('#updateBrandName').val() == ''){
			$valid=false;
			$error += 'Please input Brand Name. ';
		}
		
		$updateGenericName = $('#updateGenericName').val();
		$updateGenericName = $updateGenericName.trim();
		$('#updateGenericName').val($updateGenericName);
		if($('#updateGenericName').val() == ''){
			$valid=false;
			$error += 'Please input Generic Name. ';
		}
		
		$updateDosage = $('#updateDosage').val();
		$updateDosage = $updateDosage.trim();
		$('#updateDosage').val($updateDosage);
		if($('#updateDosage').val() == ''){
			$valid=false;
			$error += 'Please input Dosage. ';
		}
		if($('#updateSellPrice').val() == '' || $('#updateSellPriceDecimal').val() == ''){
			$valid=false;
			$error += 'Please input Selling Price. ';
		}
		if($('#updateSubClassification').val() == '0'){
			$valid=false;
			$error += 'Please input Sub Classification. ';
		}
		if($valid){
			$subclass = $('#updateSubClassification').find('option:selected').html();
			$('#hiddenUpdateSubClassification').val($subclass);
			$('.updateForm').submit();
		}else{
			alert($error);
		}	
	});	
	
	/* FOR EDIT PRODUCT */
		$('.epSearchFunction').on('click', '.editProducts', function(){
			
			/* PRODUCT INFO */
				$productId = $(this).attr('productId');
					$('#updateProductId').val($productId);
					$('#PREVupdateProductId').val($productId);
				$genericName = $(this).attr('genericName');
					$('#updateGenericName').val($genericName);
					$('#PREVupdateGenericName').val($genericName);
				$brandName = $(this).attr('brandName');
					$('#updateBrandName').val($brandName);
					$('#PREVupdateBrandName').val($brandName);
				$type = $(this).attr('type');
					if($type != ''){
						$('#updateType').val($type);
						$('#PREVupdateType').val($type);
					}
				$dosage = $(this).attr('dosage');
					$('#updateDosage').val($dosage);
					$('#PREVupdateDosage').val($dosage);
				$sellPrice = $(this).attr('sellPrice'); 
					$sellPriceWhole = $sellPrice.substr(0, $sellPrice.indexOf('.'));
					$sellPriceDecimal = $sellPrice.substr($sellPrice.indexOf('.') + 1);
					$('#updateSellPrice').val($sellPriceWhole);
					$('#updateSellPriceDecimal').val($sellPriceDecimal);
					$('#PREVupdateSellPrice').val($sellPrice);
				$image = $(this).attr('image');
				$imgPath = '../images/productImages/' + $image;
					$('.productImage').attr('src',$imgPath);
				$classification = $(this).attr('classification');
					$mainclassification = $classification.substr(0,$classification.indexOf(':'));
					$subclassification = $classification.substr($classification.indexOf(':')+2); 
					// +2 because of space.
					$valueOfMC = $('#updateClassification option:contains('+$mainclassification+')').val();
					$('#updateClassification').val($valueOfMC);
					$('#PREVupdateClassification').val($mainclassification);
				$selected = $valueOfMC;
					
		if($selected != "0") {
			$('#updateSubClassification').html(new Option("Select One","0"));
		} else{
			$('#updateSubClassification').html(new Option("No Entry","0"));
		}
		
		if($selected == "A") {
			$('#hiddenUpdateClassification').val('Gastrointestinal & Hepatobiliary System');
			$('#updateSubClassification').append(new Option("Antacids, Antireflux Agents & Antiulcerants", "a"));
			$('#updateSubClassification').append(new Option("GIT Regulators, Antiflatulents & Anti-Inflammatories", "b"));
			$('#updateSubClassification').append(new Option("Antispasmodic", "c"));
			$('#updateSubClassification').append(new Option("Antidiarrheals", "d"));
			$('#updateSubClassification').append(new Option("Laxatives, Purgatives", "e"));
			$('#updateSubClassification').append(new Option("Digestives", "f"));
			$('#updateSubClassification').append(new Option("Cholagogues, Cholelitholytics & Hepatic Protectors", "g"));
			$('#updateSubClassification').append(new Option("Anorectal Preparations", "h"));
			$('#updateSubClassification').append(new Option("Antiemetics", "i"));
			$('#updateSubClassification').append(new Option("Other Gastrointestinal Drugs", "j"));
		} else if($selected == "B") {
			$('#hiddenUpdateClassification').val('Cardiovascular & Hematopoietic System');
			$('#updateSubClassification').append(new Option("Cardiac Drugs", "a"));
			$('#updateSubClassification').append(new Option("Anti-Anginal Drugs", "b"));
			$('#updateSubClassification').append(new Option("ACE Inhibitors/Direct Renin Inhibitors", "c"));
			$('#updateSubClassification').append(new Option("Beta-Blockers", "d"));
			$('#updateSubClassification').append(new Option("Calcium Antagonists", "e"));
			$('#updateSubClassification').append(new Option("Angiotensin II Antagonists", "f"));
			$('#updateSubClassification').append(new Option("Other Antihypertensives", "g"));
			$('#updateSubClassification').append(new Option("Diuretics", "h"));
			$('#updateSubClassification').append(new Option("Antidiuretics", "i"));
			$('#updateSubClassification').append(new Option("Peripheral Vasodilators & Cerebral Activators", "j"));
			$('#updateSubClassification').append(new Option("Vasoconstrictors", "k"));
			$('#updateSubClassification').append(new Option("Dyslipidaemic Agents", "l"));
			$('#updateSubClassification').append(new Option("Haemostatics", "m"));
			$('#updateSubClassification').append(new Option("Anticoagulants, Antiplatelets & Fibrinolytics (Thrombolytics)", "n"));
			$('#updateSubClassification').append(new Option("Phlebitis & Varicose Preparations", "p"));
			$('#updateSubClassification').append(new Option("Haemorrheologicals", "q"));
			$('#updateSubClassification').append(new Option("Haematopoietic Agents", "r"));
			$('#updateSubClassification').append(new Option("Other Cardiovascular Drugs", "s"));
		} else if($selected == "C") {
			$('#hiddenUpdateClassification').val('Respiratory System');
			$('#updateSubClassification').append(new Option("Respiratory Stimulants", "a"));
			$('#updateSubClassification').append(new Option("Antiasthmatic & COPD Preparations", "b"));
			$('#updateSubClassification').append(new Option("Cough & Cold Preparations", "c"));
			$('#updateSubClassification').append(new Option("Nasal Decongestants & Other Nasal Preparations", "d"));
			$('#updateSubClassification').append(new Option("Other Drugs Acting on the Respiratory System", "e"));
		} else if($selected == "D") {
			$('#hiddenUpdateClassification').val('Central Nervous System');
			$('#updateSubClassification').append(new Option("Anxiolytics", "a"));
			$('#updateSubClassification').append(new Option("Hypnotics & Sedatives", "b"));
			$('#updateSubClassification').append(new Option("Antidepressants", "c"));
			$('#updateSubClassification').append(new Option("Antipsychotics", "d"));
			$('#updateSubClassification').append(new Option("Anticonvulsants", "e"));
			$('#updateSubClassification').append(new Option("Other CNS Drugs & Agents for ADHD", "f"));
			$('#updateSubClassification').append(new Option("Neurodegenerative Disease Drugs", "g"));
			$('#updateSubClassification').append(new Option("Antiparkinsonian Drugs", "h"));
			$('#updateSubClassification').append(new Option("Antivertigo Drugs", "i"));
			$('#updateSubClassification').append(new Option("Analgesics (Opioid)", "j"));
			$('#updateSubClassification').append(new Option("Analgesics (Non-Opioid) & Antipyretics", "k"));
			$('#updateSubClassification').append(new Option("Nonsteroidal Anti-Inflammatory Drugs (NSAIDs)", "l"));
			$('#updateSubClassification').append(new Option("Drugs for Neuropathic Pain", "m"));
			$('#updateSubClassification').append(new Option("Antimigraine Preparations", "n"));
			$('#updateSubClassification').append(new Option("Nootropics & Neurotonics/Neurotrophics", "p"));
		} else if($selected == "E") {
			$('#hiddenUpdateClassification').val('Musculo-Skeletal System');
			$('#updateSubClassification').append(new Option("Disease-Modifying Anti-Rheumatic Drugs (DMARDs)", "a"));
			$('#updateSubClassification').append(new Option("Hyperuricemia & Gout Preparations", "b"));
			$('#updateSubClassification').append(new Option("Muscle Relaxants", "c"));
			$('#updateSubClassification').append(new Option("Anti-Inflammatory Enzymes", "d"));
			$('#updateSubClassification').append(new Option("Neuromuscular Disorder Drugs", "e"));
			$('#updateSubClassification').append(new Option("Other Drugs Acting on Musculo-Skeletal System", "f"));
		} else if($selected == "F") {
			$('#hiddenUpdateClassification').val('Hormones');
			$('#updateSubClassification').append(new Option("Androgens & Related Synthetic Drugs", "a"));
			$('#updateSubClassification').append(new Option("Oestrogens, Progesterones & Related Synthetic Drugs", "b"));
			$('#updateSubClassification').append(new Option("Combined Sex Hormones", "c"));
			$('#updateSubClassification').append(new Option("Corticosteroid Hormones", "d"));
			$('#updateSubClassification').append(new Option("Trophic Hormones & Related Synthetic Drugs", "e"));
			$('#updateSubClassification').append(new Option("Anabolic Agents", "f"));
			$('#updateSubClassification').append(new Option("Other Drugs Affecting Hormonal Regulation", "g"));
		} else if($selected == "G") {
			$('#hiddenUpdateClassification').val('Contraceptive Agents');
			$('#updateSubClassification').append(new Option("Oral Contraceptives", "a"));
			$('#updateSubClassification').append(new Option("Depot Contraceptives", "b"));
			$('#updateSubClassification').append(new Option("Other Contraceptives", "c"));
		} else if($selected == "H") {
			$('#hiddenUpdateClassification').val('Anti-Infectives (Systemic)');
			$('#updateSubClassification').append(new Option("Aminoglycosides", "a"));
			$('#updateSubClassification').append(new Option("Cephalosporins", "b"));
			$('#updateSubClassification').append(new Option("Penicillins", "c"));
			$('#updateSubClassification').append(new Option("Other Beta-Lactams", "d"));
			$('#updateSubClassification').append(new Option("Chloramphenicols", "e"));
			$('#updateSubClassification').append(new Option("Macrolides", "f"));
			$('#updateSubClassification').append(new Option("Quinolones", "g"));
			$('#updateSubClassification').append(new Option("Tetracyclines", "h"));
			$('#updateSubClassification').append(new Option("Sulphonamides", "i"));
			$('#updateSubClassification').append(new Option("Antibacterial Combinations", "j"));
			$('#updateSubClassification').append(new Option("Other Antibiotics", "k"));
			$('#updateSubClassification').append(new Option("Anti-TB Agents", "l"));
			$('#updateSubClassification').append(new Option("Antileprotics", "m"));
			$('#updateSubClassification').append(new Option("Antifungals", "n"));
			$('#updateSubClassification').append(new Option("Antivirals", "p"));
			$('#updateSubClassification').append(new Option("Anthelmintics", "q"));
			$('#updateSubClassification').append(new Option("Antimalarials", "r"));
			$('#updateSubClassification').append(new Option("Antiamoebics", "s"));
			$('#updateSubClassification').append(new Option("Other Antiprotozoal Agents", "t"));
		} else if($selected == "I") {
			$('#hiddenUpdateClassification').val('Oncology');
			$('#updateSubClassification').append(new Option("Cytotoxic Chemotherapy", "a"));
			$('#updateSubClassification').append(new Option("Cancer Hormone Therapy", "b"));
			$('#updateSubClassification').append(new Option("Cancer Immunotherapy", "c"));
			$('#updateSubClassification').append(new Option("Targeted Cancer Therapy", "d"));
			$('#updateSubClassification').append(new Option("Supportive Care Therapy", "e"));
		} else if($selected == "J") {
			$('#hiddenUpdateClassification').val('Genito-Urinary System');
			$('#updateSubClassification').append(new Option("Preparations for Vaginal Conditions", "a"));
			$('#updateSubClassification').append(new Option("Urinary Antiseptics", "b"));
			$('#updateSubClassification').append(new Option("Drugs Acting on the Uterus", "c"));
			$('#updateSubClassification').append(new Option("Drugs for Erectile Dysfunction and Ejaculatory Disorders", "d"));
			$('#updateSubClassification').append(new Option("Drugs for Bladder & Prostate Disorders", "e"));
			$('#updateSubClassification').append(new Option("Other Drugs Acting on the Genito-Urinary System", "f"));
		} else if($selected == "K") {
			$('#hiddenUpdateClassification').val('Endocrine & Metabolic System');
			$('#updateSubClassification').append(new Option("Insulin Preparations", "a"));
			$('#updateSubClassification').append(new Option("Antidiabetic Agents", "b"));
			$('#updateSubClassification').append(new Option("Thyroid Hormones", "c"));
			$('#updateSubClassification').append(new Option("Antithyroid Agents", "d"));
			$('#updateSubClassification').append(new Option("Anti-Obesity Agents", "e"));
			$('#updateSubClassification').append(new Option("Agents Affecting Bone Metabolism", "f"));
			$('#updateSubClassification').append(new Option("Other Agents Affecting Metabolism", "g"));
		} else if($selected == "L") {
			$('#hiddenUpdateClassification').val('Vitamins & Minerals');
			$('#updateSubClassification').append(new Option("Vitamins A, D & E", "a"));
			$('#updateSubClassification').append(new Option("Vitamin B-Complex / with C", "b"));
			$('#updateSubClassification').append(new Option("Vitamin C", "c"));
			$('#updateSubClassification').append(new Option("Calcium/with Vitamins", "d"));
			$('#updateSubClassification').append(new Option("Vitamins &/or Minerals", "e"));
			$('#updateSubClassification').append(new Option("Vitamins & Minerals (Geriatric)", "f"));
			$('#updateSubClassification').append(new Option("Vitamins & Minerals (Paediatric)", "g"));
			$('#updateSubClassification').append(new Option("Vitamins & Minerals (Pre & Post Natal) / Antianemics", "h"));
		} else if($selected == "M") {
			$('#hiddenUpdateClassification').val('Nutrition');
			$('#updateSubClassification').append(new Option("Infant Nutritional Products", "a"));
			$('#updateSubClassification').append(new Option("Enteral/Nutritional Products", "b"));
			$('#updateSubClassification').append(new Option("Parenteral Nutritional Products", "c"));
			$('#updateSubClassification').append(new Option("Electrolytes", "d"));
			$('#updateSubClassification').append(new Option("Appetite Enhancers", "e"));
			$('#updateSubClassification').append(new Option("Supplements & Adjuvant Therapy", "f"));
		} else if($selected == "N") {
			$('#hiddenUpdateClassification').val('Eye');
			$('#updateSubClassification').append(new Option("Eye Anti-Infectives & Antiseptics", "a"));
			$('#updateSubClassification').append(new Option("Eye Antiseptics with Corticosteroids", "b"));
			$('#updateSubClassification').append(new Option("Eye Corticosteroids", "c"));
			$('#updateSubClassification').append(new Option("Mydriatic Drugs", "d"));
			$('#updateSubClassification').append(new Option("Miotic Drugs", "e"));
			$('#updateSubClassification').append(new Option("Antiglaucoma Preparations", "f"));
			$('#updateSubClassification').append(new Option("Ophthalmic Decongestants, Anesthetics, Anti-Inflammatories", "g"));
			$('#updateSubClassification').append(new Option("Ophthalmic Lubricants", "h"));
			$('#updateSubClassification').append(new Option("Other Eye Preparations", "i"));
		} else if($selected == "O") {
			$('#hiddenUpdateClassification').val('Ear & Mouth / Throat');
			$('#updateSubClassification').append(new Option("Ear Anti-Infectives & Antiseptics", "a"));
			$('#updateSubClassification').append(new Option("Ear Antiseptics with Corticosteroids", "b"));
			$('#updateSubClassification').append(new Option("Ear Corticosteroids", "c"));
			$('#updateSubClassification').append(new Option("Other Ear Preparations", "d"));
			$('#updateSubClassification').append(new Option("Mouth/Throat Preparations", "e"));
		} else if($selected == "P") {
			$('#hiddenUpdateClassification').val('Dermatologicals');
			$('#updateSubClassification').append(new Option("Topical Antibiotics", "a"));
			$('#updateSubClassification').append(new Option("Topical Antifungals & Antiparasites", "b"));
			$('#updateSubClassification').append(new Option("Topical Antivirals", "c"));
			$('#updateSubClassification').append(new Option("Topical Anti-Infectives with Corticosteroids", "d"));
			$('#updateSubClassification').append(new Option("Topical Corticosteroids", "e"));
			$('#updateSubClassification').append(new Option("Acne Treatment Preparations", "f"));
			$('#updateSubClassification').append(new Option("Topical Antihistamines/Antipruritics", "g"));
			$('#updateSubClassification').append(new Option("Psoriasis, Seborrhea & Ichthyosis Preparations", "h"));
			$('#updateSubClassification').append(new Option("Keratolytics", "i"));
			$('#updateSubClassification').append(new Option("Emollients & Skin Protectives", "j"));
			$('#updateSubClassification').append(new Option("Skin Antiseptics & Disinfectants", "k"));
			$('#updateSubClassification').append(new Option("Medicated Surgical Dressings", "l"));
			$('#updateSubClassification').append(new Option("Other Dermatologicals", "m"));
		} else if($selected == "Q") {
			$('#hiddenUpdateClassification').val('Anaesthetics - Local & General');
			$('#updateSubClassification').append(new Option("Anaesthetics - Local & General", "a"));
		} else if($selected == "R") {
			$('#hiddenUpdateClassification').val('Allergy & Immune System');
			$('#updateSubClassification').append(new Option("Antihistamines & Antiallergics", "a"));
			$('#updateSubClassification').append(new Option("Vaccines, Antisera & Immunologicals", "b"));
			$('#updateSubClassification').append(new Option("Immunosuppressants", "c"));
		} else if($selected == "S") {
			$('#hiddenUpdateClassification').val('Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence');
			$('#updateSubClassification').append(new Option("Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence", "a"));
		} else if($selected == "T") {
			$('#hiddenUpdateClassification').val('Intravenous & Other Sterile Solutions');
			$('#updateSubClassification').append(new Option("Intravenous & Other Sterile Solutions", "a"));
		} else if($selected == "U") {
			$('#hiddenUpdateClassification').val('Miscellaneous');
			$('#updateSubClassification').append(new Option("Miscellaneous", "a"));
		}else if($selected == "V") {
			$('#hiddenUpdateClassification').val('Supplies');
			$('#updateSubClassification').append(new Option("Gastrointestinal & Hepatobiliary System", "a"));
			$('#updateSubClassification').append(new Option("Musculo-Skeletal System", "b"));
			$('#updateSubClassification').append(new Option("Genito-Urinary System", "c"));
			$('#updateSubClassification').append(new Option("Circulatory System", "d"));
			$('#updateSubClassification').append(new Option("Respiratory System", "e"));
			$('#updateSubClassification').append(new Option("Surgical", "f"));
			$('#updateSubClassification').append(new Option("Suture", "g"));
			$('#updateSubClassification').append(new Option("Others", "h"));
		}	
	
			$valueOfSC = $('#updateSubClassification option:contains('+$subclassification+')').val();
			$('#updateSubClassification').val($valueOfSC);
			$('#PREVupdateSubClassification').val($subclassification);
	
			$('body').css('overflow','hidden');
			$('.modal').show();
		
		});
		
	$('#updateClassification').on('change',function(){
		$selected = $(this).val();		
		
		if($selected != "0") {
			$('#updateSubClassification').html(new Option("Select One","0"));
		} else{
			$('#updateSubClassification').html(new Option("No Entry","0"));
		}
		
		if($selected == "A") {
			$('#hiddenUpdateClassification').val('Gastrointestinal & Hepatobiliary System');
			$('#updateSubClassification').append(new Option("Antacids, Antireflux Agents & Antiulcerants", "a"));
			$('#updateSubClassification').append(new Option("GIT Regulators, Antiflatulents & Anti-Inflammatories", "b"));
			$('#updateSubClassification').append(new Option("Antispasmodic", "c"));
			$('#updateSubClassification').append(new Option("Antidiarrheals", "d"));
			$('#updateSubClassification').append(new Option("Laxatives, Purgatives", "e"));
			$('#updateSubClassification').append(new Option("Digestives", "f"));
			$('#updateSubClassification').append(new Option("Cholagogues, Cholelitholytics & Hepatic Protectors", "g"));
			$('#updateSubClassification').append(new Option("Anorectal Preparations", "h"));
			$('#updateSubClassification').append(new Option("Antiemetics", "i"));
			$('#updateSubClassification').append(new Option("Other Gastrointestinal Drugs", "j"));
		} else if($selected == "B") {
			$('#hiddenUpdateClassification').val('Cardiovascular & Hematopoietic System');
			$('#updateSubClassification').append(new Option("Cardiac Drugs", "a"));
			$('#updateSubClassification').append(new Option("Anti-Anginal Drugs", "b"));
			$('#updateSubClassification').append(new Option("ACE Inhibitors/Direct Renin Inhibitors", "c"));
			$('#updateSubClassification').append(new Option("Beta-Blockers", "d"));
			$('#updateSubClassification').append(new Option("Calcium Antagonists", "e"));
			$('#updateSubClassification').append(new Option("Angiotensin II Antagonists", "f"));
			$('#updateSubClassification').append(new Option("Other Antihypertensives", "g"));
			$('#updateSubClassification').append(new Option("Diuretics", "h"));
			$('#updateSubClassification').append(new Option("Antidiuretics", "i"));
			$('#updateSubClassification').append(new Option("Peripheral Vasodilators & Cerebral Activators", "j"));
			$('#updateSubClassification').append(new Option("Vasoconstrictors", "k"));
			$('#updateSubClassification').append(new Option("Dyslipidaemic Agents", "l"));
			$('#updateSubClassification').append(new Option("Haemostatics", "m"));
			$('#updateSubClassification').append(new Option("Anticoagulants, Antiplatelets & Fibrinolytics (Thrombolytics)", "n"));
			$('#updateSubClassification').append(new Option("Phlebitis & Varicose Preparations", "p"));
			$('#updateSubClassification').append(new Option("Haemorrheologicals", "q"));
			$('#updateSubClassification').append(new Option("Haematopoietic Agents", "r"));
			$('#updateSubClassification').append(new Option("Other Cardiovascular Drugs", "s"));
		} else if($selected == "C") {
			$('#hiddenUpdateClassification').val('Respiratory System');
			$('#updateSubClassification').append(new Option("Respiratory Stimulants", "a"));
			$('#updateSubClassification').append(new Option("Antiasthmatic & COPD Preparations", "b"));
			$('#updateSubClassification').append(new Option("Cough & Cold Preparations", "c"));
			$('#updateSubClassification').append(new Option("Nasal Decongestants & Other Nasal Preparations", "d"));
			$('#updateSubClassification').append(new Option("Other Drugs Acting on the Respiratory System", "e"));
		} else if($selected == "D") {
			$('#hiddenUpdateClassification').val('Central Nervous System');
			$('#updateSubClassification').append(new Option("Anxiolytics", "a"));
			$('#updateSubClassification').append(new Option("Hypnotics & Sedatives", "b"));
			$('#updateSubClassification').append(new Option("Antidepressants", "c"));
			$('#updateSubClassification').append(new Option("Antipsychotics", "d"));
			$('#updateSubClassification').append(new Option("Anticonvulsants", "e"));
			$('#updateSubClassification').append(new Option("Other CNS Drugs & Agents for ADHD", "f"));
			$('#updateSubClassification').append(new Option("Neurodegenerative Disease Drugs", "g"));
			$('#updateSubClassification').append(new Option("Antiparkinsonian Drugs", "h"));
			$('#updateSubClassification').append(new Option("Antivertigo Drugs", "i"));
			$('#updateSubClassification').append(new Option("Analgesics (Opioid)", "j"));
			$('#updateSubClassification').append(new Option("Analgesics (Non-Opioid) & Antipyretics", "k"));
			$('#updateSubClassification').append(new Option("Nonsteroidal Anti-Inflammatory Drugs (NSAIDs)", "l"));
			$('#updateSubClassification').append(new Option("Drugs for Neuropathic Pain", "m"));
			$('#updateSubClassification').append(new Option("Antimigraine Preparations", "n"));
			$('#updateSubClassification').append(new Option("Nootropics & Neurotonics/Neurotrophics", "p"));
		} else if($selected == "E") {
			$('#hiddenUpdateClassification').val('Musculo-Skeletal System');
			$('#updateSubClassification').append(new Option("Disease-Modifying Anti-Rheumatic Drugs (DMARDs)", "a"));
			$('#updateSubClassification').append(new Option("Hyperuricemia & Gout Preparations", "b"));
			$('#updateSubClassification').append(new Option("Muscle Relaxants", "c"));
			$('#updateSubClassification').append(new Option("Anti-Inflammatory Enzymes", "d"));
			$('#updateSubClassification').append(new Option("Neuromuscular Disorder Drugs", "e"));
			$('#updateSubClassification').append(new Option("Other Drugs Acting on Musculo-Skeletal System", "f"));
		} else if($selected == "F") {
			$('#hiddenUpdateClassification').val('Hormones');
			$('#updateSubClassification').append(new Option("Androgens & Related Synthetic Drugs", "a"));
			$('#updateSubClassification').append(new Option("Oestrogens, Progesterones & Related Synthetic Drugs", "b"));
			$('#updateSubClassification').append(new Option("Combined Sex Hormones", "c"));
			$('#updateSubClassification').append(new Option("Corticosteroid Hormones", "d"));
			$('#updateSubClassification').append(new Option("Trophic Hormones & Related Synthetic Drugs", "e"));
			$('#updateSubClassification').append(new Option("Anabolic Agents", "f"));
			$('#updateSubClassification').append(new Option("Other Drugs Affecting Hormonal Regulation", "g"));
		} else if($selected == "G") {
			$('#hiddenUpdateClassification').val('Contraceptive Agents');
			$('#updateSubClassification').append(new Option("Oral Contraceptives", "a"));
			$('#updateSubClassification').append(new Option("Depot Contraceptives", "b"));
			$('#updateSubClassification').append(new Option("Other Contraceptives", "c"));
		} else if($selected == "H") {
			$('#hiddenUpdateClassification').val('Anti-Infectives (Systemic)');
			$('#updateSubClassification').append(new Option("Aminoglycosides", "a"));
			$('#updateSubClassification').append(new Option("Cephalosporins", "b"));
			$('#updateSubClassification').append(new Option("Penicillins", "c"));
			$('#updateSubClassification').append(new Option("Other Beta-Lactams", "d"));
			$('#updateSubClassification').append(new Option("Chloramphenicols", "e"));
			$('#updateSubClassification').append(new Option("Macrolides", "f"));
			$('#updateSubClassification').append(new Option("Quinolones", "g"));
			$('#updateSubClassification').append(new Option("Tetracyclines", "h"));
			$('#updateSubClassification').append(new Option("Sulphonamides", "i"));
			$('#updateSubClassification').append(new Option("Antibacterial Combinations", "j"));
			$('#updateSubClassification').append(new Option("Other Antibiotics", "k"));
			$('#updateSubClassification').append(new Option("Anti-TB Agents", "l"));
			$('#updateSubClassification').append(new Option("Antileprotics", "m"));
			$('#updateSubClassification').append(new Option("Antifungals", "n"));
			$('#updateSubClassification').append(new Option("Antivirals", "p"));
			$('#updateSubClassification').append(new Option("Anthelmintics", "q"));
			$('#updateSubClassification').append(new Option("Antimalarials", "r"));
			$('#updateSubClassification').append(new Option("Antiamoebics", "s"));
			$('#updateSubClassification').append(new Option("Other Antiprotozoal Agents", "t"));
		} else if($selected == "I") {
			$('#hiddenUpdateClassification').val('Oncology');
			$('#updateSubClassification').append(new Option("Cytotoxic Chemotherapy", "a"));
			$('#updateSubClassification').append(new Option("Cancer Hormone Therapy", "b"));
			$('#updateSubClassification').append(new Option("Cancer Immunotherapy", "c"));
			$('#updateSubClassification').append(new Option("Targeted Cancer Therapy", "d"));
			$('#updateSubClassification').append(new Option("Supportive Care Therapy", "e"));
		} else if($selected == "J") {
			$('#hiddenUpdateClassification').val('Genito-Urinary System');
			$('#updateSubClassification').append(new Option("Preparations for Vaginal Conditions", "a"));
			$('#updateSubClassification').append(new Option("Urinary Antiseptics", "b"));
			$('#updateSubClassification').append(new Option("Drugs Acting on the Uterus", "c"));
			$('#updateSubClassification').append(new Option("Drugs for Erectile Dysfunction and Ejaculatory Disorders", "d"));
			$('#updateSubClassification').append(new Option("Drugs for Bladder & Prostate Disorders", "e"));
			$('#updateSubClassification').append(new Option("Other Drugs Acting on the Genito-Urinary System", "f"));
		} else if($selected == "K") {
			$('#hiddenUpdateClassification').val('Endocrine & Metabolic System');
			$('#updateSubClassification').append(new Option("Insulin Preparations", "a"));
			$('#updateSubClassification').append(new Option("Antidiabetic Agents", "b"));
			$('#updateSubClassification').append(new Option("Thyroid Hormones", "c"));
			$('#updateSubClassification').append(new Option("Antithyroid Agents", "d"));
			$('#updateSubClassification').append(new Option("Anti-Obesity Agents", "e"));
			$('#updateSubClassification').append(new Option("Agents Affecting Bone Metabolism", "f"));
			$('#updateSubClassification').append(new Option("Other Agents Affecting Metabolism", "g"));
		} else if($selected == "L") {
			$('#hiddenUpdateClassification').val('Vitamins & Minerals');
			$('#updateSubClassification').append(new Option("Vitamins A, D & E", "a"));
			$('#updateSubClassification').append(new Option("Vitamin B-Complex / with C", "b"));
			$('#updateSubClassification').append(new Option("Vitamin C", "c"));
			$('#updateSubClassification').append(new Option("Calcium/with Vitamins", "d"));
			$('#updateSubClassification').append(new Option("Vitamins &/or Minerals", "e"));
			$('#updateSubClassification').append(new Option("Vitamins & Minerals (Geriatric)", "f"));
			$('#updateSubClassification').append(new Option("Vitamins & Minerals (Paediatric)", "g"));
			$('#updateSubClassification').append(new Option("Vitamins & Minerals (Pre & Post Natal) / Antianemics", "h"));
		} else if($selected == "M") {
			$('#hiddenUpdateClassification').val('Nutrition');
			$('#updateSubClassification').append(new Option("Infant Nutritional Products", "a"));
			$('#updateSubClassification').append(new Option("Enteral/Nutritional Products", "b"));
			$('#updateSubClassification').append(new Option("Parenteral Nutritional Products", "c"));
			$('#updateSubClassification').append(new Option("Electrolytes", "d"));
			$('#updateSubClassification').append(new Option("Appetite Enhancers", "e"));
			$('#updateSubClassification').append(new Option("Supplements & Adjuvant Therapy", "f"));
		} else if($selected == "N") {
			$('#hiddenUpdateClassification').val('Eye');
			$('#updateSubClassification').append(new Option("Eye Anti-Infectives & Antiseptics", "a"));
			$('#updateSubClassification').append(new Option("Eye Antiseptics with Corticosteroids", "b"));
			$('#updateSubClassification').append(new Option("Eye Corticosteroids", "c"));
			$('#updateSubClassification').append(new Option("Mydriatic Drugs", "d"));
			$('#updateSubClassification').append(new Option("Miotic Drugs", "e"));
			$('#updateSubClassification').append(new Option("Antiglaucoma Preparations", "f"));
			$('#updateSubClassification').append(new Option("Ophthalmic Decongestants, Anesthetics, Anti-Inflammatories", "g"));
			$('#updateSubClassification').append(new Option("Ophthalmic Lubricants", "h"));
			$('#updateSubClassification').append(new Option("Other Eye Preparations", "i"));
		} else if($selected == "O") {
			$('#hiddenUpdateClassification').val('Ear & Mouth / Throat');
			$('#updateSubClassification').append(new Option("Ear Anti-Infectives & Antiseptics", "a"));
			$('#updateSubClassification').append(new Option("Ear Antiseptics with Corticosteroids", "b"));
			$('#updateSubClassification').append(new Option("Ear Corticosteroids", "c"));
			$('#updateSubClassification').append(new Option("Other Ear Preparations", "d"));
			$('#updateSubClassification').append(new Option("Mouth/Throat Preparations", "e"));
		} else if($selected == "P") {
			$('#hiddenUpdateClassification').val('Dermatologicals');
			$('#updateSubClassification').append(new Option("Topical Antibiotics", "a"));
			$('#updateSubClassification').append(new Option("Topical Antifungals & Antiparasites", "b"));
			$('#updateSubClassification').append(new Option("Topical Antivirals", "c"));
			$('#updateSubClassification').append(new Option("Topical Anti-Infectives with Corticosteroids", "d"));
			$('#updateSubClassification').append(new Option("Topical Corticosteroids", "e"));
			$('#updateSubClassification').append(new Option("Acne Treatment Preparations", "f"));
			$('#updateSubClassification').append(new Option("Topical Antihistamines/Antipruritics", "g"));
			$('#updateSubClassification').append(new Option("Psoriasis, Seborrhea & Ichthyosis Preparations", "h"));
			$('#updateSubClassification').append(new Option("Keratolytics", "i"));
			$('#updateSubClassification').append(new Option("Emollients & Skin Protectives", "j"));
			$('#updateSubClassification').append(new Option("Skin Antiseptics & Disinfectants", "k"));
			$('#updateSubClassification').append(new Option("Medicated Surgical Dressings", "l"));
			$('#updateSubClassification').append(new Option("Other Dermatologicals", "m"));
		} else if($selected == "Q") {
			$('#hiddenUpdateClassification').val('Anaesthetics - Local & General');
			$('#updateSubClassification').append(new Option("Anaesthetics - Local & General", "a"));
		} else if($selected == "R") {
			$('#hiddenUpdateClassification').val('Allergy & Immune System');
			$('#updateSubClassification').append(new Option("Antihistamines & Antiallergics", "a"));
			$('#updateSubClassification').append(new Option("Vaccines, Antisera & Immunologicals", "b"));
			$('#updateSubClassification').append(new Option("Immunosuppressants", "c"));
		} else if($selected == "S") {
			$('#hiddenUpdateClassification').val('Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence');
			$('#updateSubClassification').append(new Option("Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence", "a"));
		} else if($selected == "T") {
			$('#hiddenUpdateClassification').val('Intravenous & Other Sterile Solutions');
			$('#updateSubClassification').append(new Option("Intravenous & Other Sterile Solutions", "a"));
		} else if($selected == "U") {
			$('#hiddenUpdateClassification').val('Miscellaneous');
			$('#updateSubClassification').append(new Option("Miscellaneous", "a"));
		}else if($selected == "V") {
			$('#hiddenUpdateClassification').val('Supplies');
			$('#updateSubClassification').append(new Option("Gastrointestinal & Hepatobiliary System", "a"));
			$('#updateSubClassification').append(new Option("Musculo-Skeletal System", "b"));
			$('#updateSubClassification').append(new Option("Genito-Urinary System", "c"));
			$('#updateSubClassification').append(new Option("Circulatory System", "d"));
			$('#updateSubClassification').append(new Option("Respiratory System", "e"));
			$('#updateSubClassification').append(new Option("Surgical", "f"));
			$('#updateSubClassification').append(new Option("Suture", "g"));
			$('#updateSubClassification').append(new Option("Others", "h"));
		}	
	});
	
	$('#updateSubClassification').on('change',function(){
	$subclass = $(this).find('option:selected').html();
	$('#hiddenUpdateSubClassification').val($subclass);
	});

});
</script>