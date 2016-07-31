<?php /* $urlString is defined in the menu */ ?>

<div class='submenu'>
	
	<?php if($urlString != 'reportInventory.php' || $urlString != 'reportMaterials.php' || $urlString != 'reportSummaryIssuance.php' || $urlString != 'reportDeliveries.php'){ ?> 
		<h4>Submenu</h4>
	<?php  } ?>
	
	<?php if($urlString == 'activityPharmacist.php' || $urlString == 'activityAssistantPharmacist.php' || $urlString == 'adminApproveUsers.php' || $urlString == 'adminDisableUsers.php' || $urlString == 'adminPromoteUsers.php'){ ?>
	
		<a <?php if($urlString != 'activityPharmacist.php'){ ?> href='activityPharmacist.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'activityPharmacist.php'){echo 'currentTab';} ?>'>Pharmacists' Activity Log</button>
		</a>
		<a <?php if($urlString != 'activityAssistantPharmacist.php'){ ?> href='activityAssistantPharmacist.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'activityAssistantPharmacist.php'){echo 'currentTab';} ?>'>Assistant Pharmacists' Activity Log</button>
		</a>
		<a <?php if($urlString != 'adminApproveUsers.php'){ ?> href='adminApproveUsers.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'adminApproveUsers.php'){echo 'currentTab';} ?>'>Approve Users</button>
		</a>
		<a <?php if($urlString != 'adminDisableUsers.php'){ ?> href='adminDisableUsers.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'adminDisableUsers.php'){echo 'currentTab';} ?>'>Disable Users</button>
		</a>
		<a <?php if($urlString != 'adminPromoteUsers.php'){ ?> href='adminPromoteUsers.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'adminPromoteUsers.php'){echo 'currentTab';} ?>'>Change Type of Users</button>
		</a>
	
	<?php } else if($urlString == 'addProduct.php' || $urlString == 'editProduct.php' || $urlString == 'editVendorInfo.php' || $urlString == 'editVendorProduct.php') { ?> 
	
		<a <?php if($urlString != 'addProduct.php'){ ?> href='addProduct.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'addProduct.php'){echo 'currentTab';} ?>'>Add New Product</button>
		</a>
	
		<a <?php if($urlString != 'editProduct.php'){ ?> href='editProduct.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'editProduct.php'){echo 'currentTab';} ?>'>Edit Product</button>
		</a>	
		
		<a <?php if($urlString != 'editVendorInfo.php'){ ?> href='editVendorInfo.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'editVendorInfo.php'){echo 'currentTab';} ?>'>Edit Vendor</button>
		</a>	
	
		<a <?php if($urlString != 'editVendor.php'){ ?> href='editVendorProduct.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'editVendorProduct.php'){echo 'currentTab';} ?>'>Edit Vendor Product</button>
		</a>
		
	<?php } else if($urlString == 'receiveDeliveries.php' || $urlString == 'modifyDeliveries.php') { ?>
	
		<a <?php if($urlString != 'receiveDeliveries.php'){ ?> href='receiveDeliveries.php' <?php  } ?>>
				<button class='blue <?php if($urlString == 'receiveDeliveries.php'){echo 'currentTab';} ?>'>Receive Deliveries</button>
			</a>
			
		<a <?php if($urlString != 'modifyDeliveries.php'){ ?> href='modifyDeliveries.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'modifyDeliveries.php'){echo 'currentTab';} ?>'>Edit Deliveries</button>
		</a>
	
	<?php } else if($urlString == 'dispenseOutPatient.php' || $urlString == 'dispenseInPatient.php' || $urlString == 'dispenseInPatientBedInformation.php' || $urlString == 'dispenseInPatientIssueProduct.php') { ?>
	
		<a <?php if($urlString != 'dispenseOutPatient.php'){ ?> href='dispenseOutPatient.php' <?php  } ?>>
				<button class='blue <?php if($urlString == 'dispenseOutPatient.php'){echo 'currentTab';} ?>'>Out-patient</button>
			</a>
			
		<a <?php if($urlString != 'dispenseInPatient.php' || $urlString != 'dispenseInPatientBedInformation.php' || $urlString != 'dispenseInPatientIssueProduct.php'){ ?> href='dispenseInPatient.php'  <?php  } ?>>
			<button class='blue <?php if($urlString == 'dispenseInPatient.php' || $urlString == 'dispenseInPatientBedInformation.php' || $urlString == 'dispenseInPatientIssueProduct.php'){echo 'currentTab';} ?>'>In-patient</button>
		</a>
	
	<?php } else { ?> 
	
		<a <?php if($urlString != 'reportSummaryIssuance.php'){ ?> href='reportSummaryIssuance.php' <?php  } ?>>
			<button class='blue <?php if($urlString == 'reportSummaryIssuance.php'){echo 'currentTab';} ?> '>Summary of Issuance Report</button>
		</a>
		
		<a <?php if($urlString != 'reportDeliveries.php'){ ?> href='reportDeliveries.php' <?php  } ?>>
			<button class='blue <?php if($urlString == 'reportDeliveries.php'){echo 'currentTab';} ?> '>Deliveries Report</button>
		</a>
		
		<a <?php if($urlString != 'reportInventory.php'){ ?> href='reportInventory.php' <?php  } ?>>
			<button class='blue <?php if($urlString == 'reportInventory.php'){echo 'currentTab';} ?> '>Inventory Report</button>
		</a>
		
		<a <?php if($urlString != 'reportMaterials.php'){ ?> href='reportMaterials.php' <?php  } ?>>
			<button class='blue <?php if($urlString == 'reportMaterials.php'){echo 'currentTab';} ?> '>Materials Creation Report</button>
		</a>
	
	<?php } ?>
</div>
<hr>