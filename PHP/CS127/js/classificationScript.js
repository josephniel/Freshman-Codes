$(function() {
	$('#classification').on('change',function(){
		$selected = $(this).val();
		
		if($selected != "0") {
			$('#subclassification').html(new Option("Select One","0"));
		} else{
			$('#subclassification').html(new Option("No Entry","0"));
		}
		
		if($selected == "A") {
			$('#hiddenClassification').val('Gastrointestinal & Hepatobiliary System');
			$('#subclassification').append(new Option("Antacids, Antireflux Agents & Antiulcerants", "a"));
			$('#subclassification').append(new Option("GIT Regulators, Antiflatulents & Anti-Inflammatories", "b"));
			$('#subclassification').append(new Option("Antispasmodic", "c"));
			$('#subclassification').append(new Option("Antidiarrheals", "d"));
			$('#subclassification').append(new Option("Laxatives, Purgatives", "e"));
			$('#subclassification').append(new Option("Digestives", "f"));
			$('#subclassification').append(new Option("Cholagogues, Cholelitholytics & Hepatic Protectors", "g"));
			$('#subclassification').append(new Option("Anorectal Preparations", "h"));
			$('#subclassification').append(new Option("Antiemetics", "i"));
			$('#subclassification').append(new Option("Other Gastrointestinal Drugs", "j"));
		} else if($selected == "B") {
			$('#hiddenClassification').val('Cardiovascular & Hematopoietic System');
			$('#subclassification').append(new Option("Cardiac Drugs", "a"));
			$('#subclassification').append(new Option("Anti-Anginal Drugs", "b"));
			$('#subclassification').append(new Option("ACE Inhibitors/Direct Renin Inhibitors", "c"));
			$('#subclassification').append(new Option("Beta-Blockers", "d"));
			$('#subclassification').append(new Option("Calcium Antagonists", "e"));
			$('#subclassification').append(new Option("Angiotensin II Antagonists", "f"));
			$('#subclassification').append(new Option("Other Antihypertensives", "g"));
			$('#subclassification').append(new Option("Diuretics", "h"));
			$('#subclassification').append(new Option("Antidiuretics", "i"));
			$('#subclassification').append(new Option("Peripheral Vasodilators & Cerebral Activators", "j"));
			$('#subclassification').append(new Option("Vasoconstrictors", "k"));
			$('#subclassification').append(new Option("Dyslipidaemic Agents", "l"));
			$('#subclassification').append(new Option("Haemostatics", "m"));
			$('#subclassification').append(new Option("Anticoagulants, Antiplatelets & Fibrinolytics (Thrombolytics)", "n"));
			$('#subclassification').append(new Option("Phlebitis & Varicose Preparations", "p"));
			$('#subclassification').append(new Option("Haemorrheologicals", "q"));
			$('#subclassification').append(new Option("Haematopoietic Agents", "r"));
			$('#subclassification').append(new Option("Other Cardiovascular Drugs", "s"));
		} else if($selected == "C") {
			$('#hiddenClassification').val('Respiratory System');
			$('#subclassification').append(new Option("Respiratory Stimulants", "a"));
			$('#subclassification').append(new Option("Antiasthmatic & COPD Preparations", "b"));
			$('#subclassification').append(new Option("Cough & Cold Preparations", "c"));
			$('#subclassification').append(new Option("Nasal Decongestants & Other Nasal Preparations", "d"));
			$('#subclassification').append(new Option("Other Drugs Acting on the Respiratory System", "e"));
		} else if($selected == "D") {
			$('#hiddenClassification').val('Central Nervous System');
			$('#subclassification').append(new Option("Anxiolytics", "a"));
			$('#subclassification').append(new Option("Hypnotics & Sedatives", "b"));
			$('#subclassification').append(new Option("Antidepressants", "c"));
			$('#subclassification').append(new Option("Antipsychotics", "d"));
			$('#subclassification').append(new Option("Anticonvulsants", "e"));
			$('#subclassification').append(new Option("Other CNS Drugs & Agents for ADHD", "f"));
			$('#subclassification').append(new Option("Neurodegenerative Disease Drugs", "g"));
			$('#subclassification').append(new Option("Antiparkinsonian Drugs", "h"));
			$('#subclassification').append(new Option("Antivertigo Drugs", "i"));
			$('#subclassification').append(new Option("Analgesics (Opioid)", "j"));
			$('#subclassification').append(new Option("Analgesics (Non-Opioid) & Antipyretics", "k"));
			$('#subclassification').append(new Option("Nonsteroidal Anti-Inflammatory Drugs (NSAIDs)", "l"));
			$('#subclassification').append(new Option("Drugs for Neuropathic Pain", "m"));
			$('#subclassification').append(new Option("Antimigraine Preparations", "n"));
			$('#subclassification').append(new Option("Nootropics & Neurotonics/Neurotrophics", "p"));
		} else if($selected == "E") {
			$('#hiddenClassification').val('Musculo-Skeletal System');
			$('#subclassification').append(new Option("Disease-Modifying Anti-Rheumatic Drugs (DMARDs)", "a"));
			$('#subclassification').append(new Option("Hyperuricemia & Gout Preparations", "b"));
			$('#subclassification').append(new Option("Muscle Relaxants", "c"));
			$('#subclassification').append(new Option("Anti-Inflammatory Enzymes", "d"));
			$('#subclassification').append(new Option("Neuromuscular Disorder Drugs", "e"));
			$('#subclassification').append(new Option("Other Drugs Acting on Musculo-Skeletal System", "f"));
		} else if($selected == "F") {
			$('#hiddenClassification').val('Hormones');
			$('#subclassification').append(new Option("Androgens & Related Synthetic Drugs", "a"));
			$('#subclassification').append(new Option("Oestrogens, Progesterones & Related Synthetic Drugs", "b"));
			$('#subclassification').append(new Option("Combined Sex Hormones", "c"));
			$('#subclassification').append(new Option("Corticosteroid Hormones", "d"));
			$('#subclassification').append(new Option("Trophic Hormones & Related Synthetic Drugs", "e"));
			$('#subclassification').append(new Option("Anabolic Agents", "f"));
			$('#subclassification').append(new Option("Other Drugs Affecting Hormonal Regulation", "g"));
		} else if($selected == "G") {
			$('#hiddenClassification').val('Contraceptive Agents');
			$('#subclassification').append(new Option("Oral Contraceptives", "a"));
			$('#subclassification').append(new Option("Depot Contraceptives", "b"));
			$('#subclassification').append(new Option("Other Contraceptives", "c"));
		} else if($selected == "H") {
			$('#hiddenClassification').val('Anti-Infectives (Systemic)');
			$('#subclassification').append(new Option("Aminoglycosides", "a"));
			$('#subclassification').append(new Option("Cephalosporins", "b"));
			$('#subclassification').append(new Option("Penicillins", "c"));
			$('#subclassification').append(new Option("Other Beta-Lactams", "d"));
			$('#subclassification').append(new Option("Chloramphenicols", "e"));
			$('#subclassification').append(new Option("Macrolides", "f"));
			$('#subclassification').append(new Option("Quinolones", "g"));
			$('#subclassification').append(new Option("Tetracyclines", "h"));
			$('#subclassification').append(new Option("Sulphonamides", "i"));
			$('#subclassification').append(new Option("Antibacterial Combinations", "j"));
			$('#subclassification').append(new Option("Other Antibiotics", "k"));
			$('#subclassification').append(new Option("Anti-TB Agents", "l"));
			$('#subclassification').append(new Option("Antileprotics", "m"));
			$('#subclassification').append(new Option("Antifungals", "n"));
			$('#subclassification').append(new Option("Antivirals", "p"));
			$('#subclassification').append(new Option("Anthelmintics", "q"));
			$('#subclassification').append(new Option("Antimalarials", "r"));
			$('#subclassification').append(new Option("Antiamoebics", "s"));
			$('#subclassification').append(new Option("Other Antiprotozoal Agents", "t"));
		} else if($selected == "I") {
			$('#hiddenClassification').val('Oncology');
			$('#subclassification').append(new Option("Cytotoxic Chemotherapy", "a"));
			$('#subclassification').append(new Option("Cancer Hormone Therapy", "b"));
			$('#subclassification').append(new Option("Cancer Immunotherapy", "c"));
			$('#subclassification').append(new Option("Targeted Cancer Therapy", "d"));
			$('#subclassification').append(new Option("Supportive Care Therapy", "e"));
		} else if($selected == "J") {
			$('#hiddenClassification').val('Genito-Urinary System');
			$('#subclassification').append(new Option("Preparations for Vaginal Conditions", "a"));
			$('#subclassification').append(new Option("Urinary Antiseptics", "b"));
			$('#subclassification').append(new Option("Drugs Acting on the Uterus", "c"));
			$('#subclassification').append(new Option("Drugs for Erectile Dysfunction and Ejaculatory Disorders", "d"));
			$('#subclassification').append(new Option("Drugs for Bladder & Prostate Disorders", "e"));
			$('#subclassification').append(new Option("Other Drugs Acting on the Genito-Urinary System", "f"));
		} else if($selected == "K") {
			$('#hiddenClassification').val('Endocrine & Metabolic System');
			$('#subclassification').append(new Option("Insulin Preparations", "a"));
			$('#subclassification').append(new Option("Antidiabetic Agents", "b"));
			$('#subclassification').append(new Option("Thyroid Hormones", "c"));
			$('#subclassification').append(new Option("Antithyroid Agents", "d"));
			$('#subclassification').append(new Option("Anti-Obesity Agents", "e"));
			$('#subclassification').append(new Option("Agents Affecting Bone Metabolism", "f"));
			$('#subclassification').append(new Option("Other Agents Affecting Metabolism", "g"));
		} else if($selected == "L") {
			$('#hiddenClassification').val('Vitamins & Minerals');
			$('#subclassification').append(new Option("Vitamins A, D & E", "a"));
			$('#subclassification').append(new Option("Vitamin B-Complex / with C", "b"));
			$('#subclassification').append(new Option("Vitamin C", "c"));
			$('#subclassification').append(new Option("Calcium/with Vitamins", "d"));
			$('#subclassification').append(new Option("Vitamins &/or Minerals", "e"));
			$('#subclassification').append(new Option("Vitamins & Minerals (Geriatric)", "f"));
			$('#subclassification').append(new Option("Vitamins & Minerals (Paediatric)", "g"));
			$('#subclassification').append(new Option("Vitamins & Minerals (Pre & Post Natal) / Antianemics", "h"));
		} else if($selected == "M") {
			$('#hiddenClassification').val('Nutrition');
			$('#subclassification').append(new Option("Infant Nutritional Products", "a"));
			$('#subclassification').append(new Option("Enteral/Nutritional Products", "b"));
			$('#subclassification').append(new Option("Parenteral Nutritional Products", "c"));
			$('#subclassification').append(new Option("Electrolytes", "d"));
			$('#subclassification').append(new Option("Appetite Enhancers", "e"));
			$('#subclassification').append(new Option("Supplements & Adjuvant Therapy", "f"));
		} else if($selected == "N") {
			$('#hiddenClassification').val('Eye');
			$('#subclassification').append(new Option("Eye Anti-Infectives & Antiseptics", "a"));
			$('#subclassification').append(new Option("Eye Antiseptics with Corticosteroids", "b"));
			$('#subclassification').append(new Option("Eye Corticosteroids", "c"));
			$('#subclassification').append(new Option("Mydriatic Drugs", "d"));
			$('#subclassification').append(new Option("Miotic Drugs", "e"));
			$('#subclassification').append(new Option("Antiglaucoma Preparations", "f"));
			$('#subclassification').append(new Option("Ophthalmic Decongestants, Anesthetics, Anti-Inflammatories", "g"));
			$('#subclassification').append(new Option("Ophthalmic Lubricants", "h"));
			$('#subclassification').append(new Option("Other Eye Preparations", "i"));
		} else if($selected == "O") {
			$('#hiddenClassification').val('Ear & Mouth / Throat');
			$('#subclassification').append(new Option("Ear Anti-Infectives & Antiseptics", "a"));
			$('#subclassification').append(new Option("Ear Antiseptics with Corticosteroids", "b"));
			$('#subclassification').append(new Option("Ear Corticosteroids", "c"));
			$('#subclassification').append(new Option("Other Ear Preparations", "d"));
			$('#subclassification').append(new Option("Mouth/Throat Preparations", "e"));
		} else if($selected == "P") {
			$('#hiddenClassification').val('Dermatologicals');
			$('#subclassification').append(new Option("Topical Antibiotics", "a"));
			$('#subclassification').append(new Option("Topical Antifungals & Antiparasites", "b"));
			$('#subclassification').append(new Option("Topical Antivirals", "c"));
			$('#subclassification').append(new Option("Topical Anti-Infectives with Corticosteroids", "d"));
			$('#subclassification').append(new Option("Topical Corticosteroids", "e"));
			$('#subclassification').append(new Option("Acne Treatment Preparations", "f"));
			$('#subclassification').append(new Option("Topical Antihistamines/Antipruritics", "g"));
			$('#subclassification').append(new Option("Psoriasis, Seborrhea & Ichthyosis Preparations", "h"));
			$('#subclassification').append(new Option("Keratolytics", "i"));
			$('#subclassification').append(new Option("Emollients & Skin Protectives", "j"));
			$('#subclassification').append(new Option("Skin Antiseptics & Disinfectants", "k"));
			$('#subclassification').append(new Option("Medicated Surgical Dressings", "l"));
			$('#subclassification').append(new Option("Other Dermatologicals", "m"));
		} else if($selected == "Q") {
			$('#hiddenClassification').val('Anaesthetics - Local & General');
			$('#subclassification').append(new Option("Anaesthetics - Local & General", "a"));
		} else if($selected == "R") {
			$('#hiddenClassification').val('Allergy & Immune System');
			$('#subclassification').append(new Option("Antihistamines & Antiallergics", "a"));
			$('#subclassification').append(new Option("Vaccines, Antisera & Immunologicals", "b"));
			$('#subclassification').append(new Option("Immunosuppressants", "c"));
		} else if($selected == "S") {
			$('#hiddenClassification').val('Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence');
			$('#subclassification').append(new Option("Antidotes, Detoxifying Agents & Drugs Used in Substance Dependence", "a"));
		} else if($selected == "T") {
			$('#hiddenClassification').val('Intravenous & Other Sterile Solutions');
			$('#subclassification').append(new Option("Intravenous & Other Sterile Solutions", "a"));
		} else if($selected == "U") {
			$('#hiddenClassification').val('Miscellaneous');
			$('#subclassification').append(new Option("Miscellaneous", "a"));
		}else if($selected == "V") {
			$('#hiddenClassification').val('');
			$('#subclassification').append(new Option("Gastrointestinal & Hepatobiliary System", "a"));
			$('#subclassification').append(new Option("Musculo-Skeletal System", "b"));
			$('#subclassification').append(new Option("Genito-Urinary System", "c"));
			$('#subclassification').append(new Option("Circulatory System", "d"));
			$('#subclassification').append(new Option("Respiratory System", "e"));
			$('#subclassification').append(new Option("Surgical", "f"));
			$('#subclassification').append(new Option("Suture", "g"));
			$('#subclassification').append(new Option("Others", "h"));
		}	
	});
});

$('#subclassification').on('change',function(){
	$subclass = $(this).find('option:selected').html();
	$('#hiddenSubClassification').val($subclass);
});