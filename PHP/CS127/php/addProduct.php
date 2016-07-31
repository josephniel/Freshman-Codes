<html>
	
	<?php include_once('./includes/addProductValidation.php') ?>
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='addNewProduct content'>
			
			<?php include_once('./includes/submenu.php'); ?>
		
			<h4>Add New Product</h4>
		
			<form method='post' enctype='multipart/form-data'>
			
				<p>
					<b class='blue'>Product ID</b>
					<input name='inputProductId' id='updateProductId' type='text' value='<?php echo $inputProductId ?>' class='disabled' readonly>
				</p>
				<?php
					if($isPosted){
						if($sameProduct){
							echo '<div class="red notice">Product already exists</div>';
						}
					}
				?>
				
				<p>
					<b class='blue'>Generic Name</b>
					<input name='genericname' id='updateGenericName' type='text' placeholder='Input generic name' value='<?php echo $genericName ?>' class='grayBorder'>
				</p>
					<?php 
						if($isPosted){
							if($genericName == ""){ ?> 
							<div class='red notice'>Please input a generic name</div>
						<?php } ?>
					
						
					
					<?php } ?>
				
				<p>
					<b class='blue'>Brand Name</b> 
					<input name="brandname" id='updateBrandName' type='text' placeholder='Input brand name' value='<?php echo $brandName ?>' class='grayBorder'>
				</p>
					<?php 
						if($isPosted){
							if($brandName == ""){ ?> 
							<div class='red notice'>Please input a brand name</div>
					<?php } } ?>
				
				<p>
					<b class='blue'>Dose</b> 
					<input name="dose" type='text' placeholder='Input dosage' value='<?php echo $dosage ?>' class='grayBorder'>
				</p>
					<?php 
						if($isPosted){
							if($dosage == ""){ ?> 
							<div class='red notice'>Please input a dosage</div>
					<?php } } ?>
					
				<p>
					<b class='blue'>Type/Form</b> 
					<select name="form" class='grayBorder'>
						<option value="" disable selected> Select One </option>
						<?php							 
							$value = mysqli_query($connect, "SELECT DISTINCT type FROM `producttable` ORDER BY type");		
							while($row = mysqli_fetch_array($value)) {
								$medicineType = $row['type'];
								if($medicineType != NULL || $medicineType != ""){ 
									if ($type == $medicineType)
										echo "<option selected value='$medicineType'>" . ucfirst($medicineType) . "</option>";
									else
										echo "<option value='$medicineType'>" . ucfirst($medicineType) . "</option>";
								}
							}				
						?>
						<option value="supplies"> Supplies </option>
					</select>
				</p>
					<?php 
						if($isPosted){
							if($type == ""){ ?> 
							<div class='red notice'>Please select product type/form</div>
					<?php } } ?>
			
				<p>
					<b class='blue'>Product Image</b> <input type='file' name='productImage'>
				</p>
			
			
				<p>
					<b class='blue'>MIMS Classification</b>
					<select name="class" id="classification" class='grayBorder'>
						<option value="*" <?php if($class == ''){ ?> selected <?php } ?>>Select One </option> 
						<option value="A" <?php if($class == 'A'){ ?> selected <?php } ?>> 
							Gastrointestinal & Hepatobiliary System 
						</option>
 						<option value="B" <?php if($class == 'B'){ ?> selected <?php } ?>> 
							Cardiovascular & Hematopoietic System 
						</option>
						<option value="C" <?php if($class == 'C'){ ?> selected <?php } ?>> 
							Respiratory System 
						</option>
						<option value="D" <?php if($class == 'D'){ ?> selected <?php } ?>>
							Central Nervous System 
						</option>
						<option value="E" <?php if($class == 'E'){ ?> selected <?php } ?>> 
							Musculo-Skeletal System 
						</option>
						<option value="F" <?php if($class == 'F'){ ?> selected <?php } ?>> 
							Hormones 
						</option>
						<option value="G" <?php if($class == 'G'){ ?> selected <?php } ?>> 
							Contraceptive Agents 
						</option>
						<option value="H" <?php if($class == 'H'){ ?> selected <?php } ?>> 
							Anti-Infectives (Systemic) 
						</option>
						<option value="I" <?php if($class == 'I'){ ?> selected <?php } ?>> 
							Oncology 
						</option>
						<option value="J" <?php if($class == 'J'){ ?> selected <?php } ?>> 
							Genito-Urinary System 
						</option>
						<option value="K" <?php if($class == 'K'){ ?> selected <?php } ?>> 
							Endocrine & Metabolic System 
						</option>
						<option value="L" <?php if($class == 'L'){ ?> selected <?php } ?>> 
							Vitamins & Minerals 
						</option>
						<option value="M" <?php if($class == 'M'){ ?> selected <?php } ?>> 
							Nutrition 
						</option>
						<option value="N" <?php if($class == 'N'){ ?> selected <?php } ?>> 
							Eye 
						</option>
						<option value="O" <?php if($class == 'O'){ ?> selected <?php } ?>> 
							Ear & Mouth / Throat 
						</option>
						<option value="P" <?php if($class == 'P'){ ?> selected <?php } ?>> 
							Dermatologicals 
						</option>
						<option value="Q" <?php if($class == 'Q'){ ?> selected <?php } ?>> 
							Anaesthetics - Local & General
						</option>
						<option value="R" <?php if($class == 'R'){ ?> selected <?php } ?>> 
							Allergy & Immune System
						</option>
						<option value="S" <?php if($class == 'S'){ ?> selected <?php } ?>> 
							Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence
						</option>
						<option value="T" <?php if($class == 'T'){ ?> selected <?php } ?>> 
							Intravenous & Other Sterile Solutions 
						</option>
						<option value="U" <?php if($class == 'U'){ ?> selected <?php } ?>> 
							Miscellaneous 
						</option>
						<option value="V" <?php if($class == 'V'){ ?> selected <?php } ?>> 
							Supplies 
						</option>
					</select>
										
					<input type='hidden' name='hiddenClassification' id='hiddenClassification' value='<?php echo $classification; ?>'>
										
				</p>
					<?php 
						if($isPosted){
							if($class == ""){ ?> 
							<div class='red notice'>Please select product classification</div>
					<?php } } ?>
				
				
				<p>
					<b class='blue'>MIMS Sub-Classification</b>
						
						<?php if($subclass == "" && $class == ""){ ?> 
							<select class='subclassification grayBorder' style='display:block'>
								<option value="">No Entry</option>
							</select>
						<?php } ?>
						
						<select class='subclassification' id='aSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Antacids, Antireflux Agents & Antiulcerants
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								GIT Regulators, Antiflatulents & Anti-Inflammatories
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Antispasmodic
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Antidiarrheals
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Laxatives, Purgatives
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Digestives
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Cholagogues, Cholelitholytics & Hepatic Protectors
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Anorectal Preparations
							</option>
							<option value='i' <?php if($subclass == 'i'){ ?> selected <?php } ?>>
								Antiemetics
							</option>
							<option value='j' <?php if($subclass == 'j'){ ?> selected <?php } ?>>
								Other Gastrointestinal Drugs
							</option>
						</select>
						
						<select class='subclassification' id='bSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Cardiac Drugs
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Anti-Anginal Drugs
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								ACE Inhibitors/Direct Renin Inhibitors
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Beta-Blockers
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Calcium Antagonists
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Angiotensin II Antagonists
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Other Antihypertensives
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Diuretics
							</option>
							<option value='i' <?php if($subclass == 'i'){ ?> selected <?php } ?>>
								Antidiuretics
							</option>
							<option value='j' <?php if($subclass == 'j'){ ?> selected <?php } ?>>
								Peripheral Vasodilators & Cerebral Activators
							</option>
							<option value='k' <?php if($subclass == 'k'){ ?> selected <?php } ?>>
								Vasoconstrictors
							</option>
							<option value='l' <?php if($subclass == 'l'){ ?> selected <?php } ?>>
								Dyslipidaemic Agents
							</option>
							<option value='m' <?php if($subclass == 'm'){ ?> selected <?php } ?>>
								Haemostatics
							</option>
							<option value='n' <?php if($subclass == 'n'){ ?> selected <?php } ?>>
								Anticoagulants, Antiplatelets & Fibrinolytics (Thrombolytics)
							</option>
							<option value='p' <?php if($subclass == 'p'){ ?> selected <?php } ?>>
								Phlebitis & Varicose Preparations
							</option>
							<option value='q' <?php if($subclass == 'q'){ ?> selected <?php } ?>>
								Haemorrheologicals
							</option>
							<option value='r' <?php if($subclass == 'r'){ ?> selected <?php } ?>>
								Haematopoietic Agents
							</option>
							<option value='s' <?php if($subclass == 's'){ ?> selected <?php } ?>>
								Other Cardiovascular Drugs
							</option>
						</select>
						
						<select class='subclassification' id='cSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Respiratory Stimulants
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Antiasthmatic & COPD Preparations
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Cough & Cold Preparations
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Nasal Decongestants & Other Nasal Preparations
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Other Drugs Acting on the Respiratory System
							</option>
						</select>
						
						<select class='subclassification' id='dSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Anxiolytics
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Hypnotics & Sedatives
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Antidepressants
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Antipsychotics
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Anticonvulsants
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Other CNS Drugs & Agents for ADHD
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Neurodegenerative Disease Drugs
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Antiparkinsonian Drugs
							</option>
							<option value='i' <?php if($subclass == 'i'){ ?> selected <?php } ?>>
								Antivertigo Drugs
							</option>
							<option value='j' <?php if($subclass == 'j'){ ?> selected <?php } ?>>
								Analgesics (Opioid)
							</option>
							<option value='k' <?php if($subclass == 'k'){ ?> selected <?php } ?>>
								Analgesics (Non-Opioid) & Antipyretics
							</option>
							<option value='l' <?php if($subclass == 'l'){ ?> selected <?php } ?>>
								Nonsteroidal Anti-Inflammatory Drugs (NSAIDs)
							</option>
							<option value='m' <?php if($subclass == 'm'){ ?> selected <?php } ?>>
								Drugs for Neuropathic Pain
							</option>
							<option value='n' <?php if($subclass == 'n'){ ?> selected <?php } ?>>
								Antimigraine Preparations
							</option>
							<option value='p' <?php if($subclass == 'p'){ ?> selected <?php } ?>>
								Nootropics & Neurotonics/Neurotrophics
							</option>
						</select>
						
						<select class='subclassification' id='eSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Disease-Modifying Anti-Rheumatic Drugs (DMARDs)
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Hyperuricemia & Gout Preparations
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Muscle Relaxants
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Anti-Inflammatory Enzymes
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Neuromuscular Disorder Drugs
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Other Drugs Acting on Musculo-Skeletal System
							</option>
						</select>
						
						<select class='subclassification' id='fSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Androgens & Related Synthetic Drugs
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Oestrogens, Progesterones & Related Synthetic Drugs
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Combined Sex Hormones
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Corticosteroid Hormones
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Trophic Hormones & Related Synthetic Drugs
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Anabolic Agents
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Other Drugs Affecting Hormonal Regulation
							</option>
						</select>
						
						<select class='subclassification' id='gSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Oral Contraceptives
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Depot Contraceptives
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Other Contraceptives
							</option>
						</select>
						
						<select class='subclassification' id='hSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Aminoglycosides
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Cephalosporins
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Penicillins
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Other Beta-Lactams
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Chloramphenicols
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Macrolides
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Quinolones
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Tetracyclines
							</option>
							<option value='i' <?php if($subclass == 'i'){ ?> selected <?php } ?>>
								Sulphonamides
							</option>
							<option value='j' <?php if($subclass == 'j'){ ?> selected <?php } ?>>
								Antibacterial Combinations
							</option>
							<option value='k' <?php if($subclass == 'k'){ ?> selected <?php } ?>>
								Other Antibiotics
							</option>
							<option value='l' <?php if($subclass == 'l'){ ?> selected <?php } ?>>
								Anti-TB Agents
							</option>
							<option value='m' <?php if($subclass == 'm'){ ?> selected <?php } ?>>
								Antileprotics
							</option>
							<option value='n' <?php if($subclass == 'n'){ ?> selected <?php } ?>>
								Antifungals
							</option>
							<option value='p' <?php if($subclass == 'p'){ ?> selected <?php } ?>>
								Antivirals
							</option>
							<option value='q' <?php if($subclass == 'q'){ ?> selected <?php } ?>>
								Anthelmintics
							</option>
							<option value='r' <?php if($subclass == 'r'){ ?> selected <?php } ?>>
								Antimalarials
							</option>
							<option value='s' <?php if($subclass == 's'){ ?> selected <?php } ?>>
								Antiamoebics
							</option>
							<option value='t' <?php if($subclass == 't'){ ?> selected <?php } ?>>
								Other Antiprotozoal Agents
							</option>
						</select>
						
						<select class='subclassification' id='iSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Cytotoxic Chemotherapy
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Cancer Hormone Therapy
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Cancer Immunotherapy
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Targeted Cancer Therapy
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Supportive Care Therapy
							</option>
						</select>
						
						<select class='subclassification' id='jSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Preparations for Vaginal Conditions
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Urinary Antiseptics
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Drugs Acting on the Uterus
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Drugs for Erectile Dysfunction and Ejaculatory Disorders
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Drugs for Bladder & Prostate Disorders
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Other Drugs Acting on the Genito-Urinary System
							</option>
						</select>
						
						<select class='subclassification' id='kSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Insulin Preparations
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Antidiabetic Agents
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Thyroid Hormones
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Antithyroid Agents
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Anti-Obesity Agents
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Agents Affecting Bone Metabolism
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Other Agents Affecting Metabolism
							</option>
						</select>
						
						<select class='subclassification' id='lSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Vitamins A, D & E
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Vitamin B-Complex / with C
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Vitamin C
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Calcium/with Vitamins
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Vitamins &/or Minerals
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Vitamins & Minerals (Geriatric)
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Vitamins & Minerals (Paediatric)
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Vitamins & Minerals (Pre & Post Natal) / Antianemics
							</option>
						</select>
						
						<select class='subclassification' id='mSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Infant Nutritional Products
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Enteral/Nutritional Products
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Parenteral Nutritional Products
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Electrolytes
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Appetite Enhancers
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Supplements & Adjuvant Therapy
							</option>
						</select>
						
						<select class='subclassification' id='nSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Eye Anti-Infectives & Antiseptics
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Eye Antiseptics with Corticosteroids
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Eye Corticosteroids
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Mydriatic Drugs
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Miotic Drugs
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Antiglaucoma Preparations
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Ophthalmic Decongestants, Anesthetics, Anti-Inflammatories
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Ophthalmic Lubricants
							</option>
							<option value='i' <?php if($subclass == 'i'){ ?> selected <?php } ?>>
								Other Eye Preparations
							</option>
						</select>
						
						<select class='subclassification' id='oSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Ear Anti-Infectives & Antiseptics
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Ear Antiseptics with Corticosteroids
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Ear Corticosteroids
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Other Ear Preparations
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Mouth/Throat Preparations
							</option>
						</select>
						
						<select class='subclassification' id='pSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Topical Antibiotics
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Topical Antifungals & Antiparasites
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Topical Antivirals
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Topical Anti-Infectives with Corticosteroids
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Topical Corticosteroids
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Acne Treatment Preparation
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Topical Antihistamines/Antipruritics
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Psoriasis, Seborrhea & Ichthyosis Preparations
							</option>
							<option value='i' <?php if($subclass == 'i'){ ?> selected <?php } ?>>
								Keratolytics
							</option>
							<option value='j' <?php if($subclass == 'j'){ ?> selected <?php } ?>>
								Emollients & Skin Protectives
							</option>
							<option value='k' <?php if($subclass == 'k'){ ?> selected <?php } ?>>
								Skin Antiseptics & Disinfectants
							</option>
							<option value='l' <?php if($subclass == 'l'){ ?> selected <?php } ?>>
								Medicated Surgical Dressings
							</option>
							<option value='m' <?php if($subclass == 'm'){ ?> selected <?php } ?>>
								Other Dermatologicals
							</option>
						</select>
						
						<select class='subclassification' id='qSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Anaesthetics - Local & General
							</option>
						</select>
						
						<select class='subclassification' id='rSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Antihistamines & Antiallergics
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Vaccines, Antisera & Immunologicals
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Immunosuppressants
							</option>
						</select>
						
						<select class='subclassification' id='sSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence
							</option>
						</select>
						
						<select class='subclassification' id='tSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Intravenous & Other Sterile Solutions
							</option>
						</select>
						
						<select class='subclassification' id='uSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Miscellaneous
							</option>
						</select>
						
						<select class='subclassification' id='vSubclass' class='grayBorder'>
							<option value='*'> Select One </option>
							<option value='a' <?php if($subclass == 'a'){ ?> selected <?php } ?>>
								Gastrointestinal & Hepatobiliary System
							</option>
							<option value='b' <?php if($subclass == 'b'){ ?> selected <?php } ?>>
								Musculo-Skeletal System
							</option>
							<option value='c' <?php if($subclass == 'c'){ ?> selected <?php } ?>>
								Genito-Urinary System
							</option>
							<option value='d' <?php if($subclass == 'd'){ ?> selected <?php } ?>>
								Circulatory System
							</option>
							<option value='e' <?php if($subclass == 'e'){ ?> selected <?php } ?>>
								Respiratory System
							</option>
							<option value='f' <?php if($subclass == 'f'){ ?> selected <?php } ?>>
								Surgical
							</option>
							<option value='g' <?php if($subclass == 'g'){ ?> selected <?php } ?>>
								Suture
							</option>
							<option value='h' <?php if($subclass == 'h'){ ?> selected <?php } ?>>
								Others
							</option>
						</select>

					<input type='hidden' name='hiddenSubClassification' id='hiddenSubClassification' 
						value='<?php echo $subclassification; ?>'>
					<input type='hidden' name='subclass' id='hiddenSubclass' value='<?php echo $subclass; ?>'>
				</p>
					<?php 
						if($isPosted){
							if($subclass == ""){ ?> 
							<div class='red notice'>Please select product sub-classification</div>
					<?php } } ?>
			
				<p>
					<b class='orange'>Vendor Name</b>
					<select name="vendorname" id='vendors' class='grayBorder'>
						<option value=""> Select One </option>
						<option value="addNewVendor" <?php if($vendorName == 'addNewVendor'){ ?> selected <?php } ?>> ** ADD NEW VENDOR ** </option>
						<?php						 
						$value = mysqli_query($connect, "SELECT vendorName FROM `vendorinfotable` ORDER BY vendorName");		
						while($row = mysqli_fetch_array($value)) {
							$vendor = $row['vendorName'];
							if ($vendorName == $vendor)
								echo "<option selected value='$vendor'>" . ucwords(strtolower($vendor)) . "</option>";
							else
								echo "<option value='$vendor'>" . ucwords(strtolower($vendor)) . "</option>";
						}
						?>
					</select>
					
					<input name="newVendorName" id='newVendorName' type='text' class='hidden' placeholder='Input vendor name here' value='<?php echo $new_vendorName ?>'>
					
				</p>
					<?php 
						if($isPosted){
							if($vendorName == ""){ ?> 
							<div class='red notice'>Please choose a vendor or create a new one</div>
					<?php } } ?>
					<?php 
						if($isPosted){
							if($sameVendor){ ?> 
							<div class='red notice'>Vendor already exists.</div>
					<?php } } ?>
				
				<p id="newVendorContact" class='hidden'>
					<b class='orange'>Contact Number</b> 
					<input name="newVendorContact" id='newVendorContactValue' type='textbox' placeholder='Input contact number' value='<?php echo $contactNo ?>'>
				</p>
					
				<p>
					<b class='green'>Vendor Price per Unit</b> 
					<span class='inputInclude gray'>Php</span> 
					<input name="vendorprice" type='number' min='1' placeholder='0' value='<?php echo $vendorPrice ?>' class='priceBox grayBorder'>
					<span class='inputInclude gray bold'>.</span> 
					<input type='number' min=0 max=99 placeholder='00' name='cents' value='<?php echo $origCents ?>' class='centavoBox grayBorder'>
					</select>
				</p>
					<?php 
						if($isPosted){
							if($vendorPrice == ""){ ?> 
							<div class='red notice'>Please enter complete vendor price</div>
					<?php } } ?>
				
				<p>
					<b class='green'>Delivery Time</b> 
					<input name="deliverytime" type='number' min=1 placeholder='7' value='<?php echo $deliveryTime ?>' class='grayBorder'> <span class='inputInclude gray'>day/s</span>
				</p>
					<?php 
						if($isPosted){
							if($deliveryTime == ""){ ?> 
							<div class='red notice'>Please enter average product delivery time</div>
					<?php } } ?>
				<p>
					<b class='green'>Number of Unit per Small Box</b> 
					<input name="unitpersmall" type='number' min=1 placeholder='Minimum of 1' value='<?php echo $unitPerSmall ?>' class='grayBorder'> 
				</p>
					<?php 
						if($isPosted){
							if($unitPerSmall == ""){ ?> 
							<div class='red notice'>Please enter number of unit per small box</div>
					<?php } } ?>
				
				<p>
					<b class='green'>Number of Small Box per Big Box</b> 
					<input name="smallperbig" type='number' min=1 placeholder='Minimum of 1' value='<?php echo $smallPerBig ?>' class='grayBorder'>
				</p>
					<?php 
						if($isPosted){
							if($smallPerBig == ""){ ?> 
							<div class='red notice'>Please enter number of small box per big box</div>
					<?php } } ?>
				
				<p>
					<b class='blue'>Selling Price per Unit</b> <span class='inputInclude gray'>Php</span> 
					<input name="sellingprice" type='number' min='1' placeholder='0' value='<?php echo $sellingPrice ?>' class='priceBox grayBorder'> 
					<span class='inputInclude gray bold'>.</span> 
					<input type='number' min=0 max=99 placeholder='00' name='cent' value='<?php echo $origCent ?>' class='centavoBox grayBorder'>
				</p>
					<?php 
						if($isPosted){
							if($sellingPrice == ""){ ?> 
							<div class='red notice'>Please enter product selling price</div>
					<?php } } ?>
					
				<p>
					<button class='orange button marginTop'>Add New Product</button>
				</p>
			
			</form>
		
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>