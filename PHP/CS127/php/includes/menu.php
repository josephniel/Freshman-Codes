<?php 
	if($usertype == 'Assistant Pharmacist'){ ?>
	
		<div class='menu'>
			<a <?php if(
				$urlString != 'dispenseOutPatient.php' || 
				$urlString != 'dispenseInPatient.php' ||
				$urlString != 'dispenseInPatientBedInformation.php' ||
				$urlString != 'dispenseInPatientIssueProduct.php'){ ?> href='dispenseOutPatient.php'  <?php  } ?> class='blue options <?php if($urlString == 'dispenseOutPatient.php'|| $urlString == 'dispenseInPatient.php' || $urlString == 'dispenseInPatientBedInformation.php' || $urlString == 'dispenseInPatientIssueProduct.php'){echo 'currentTab';} ?>'>
				Dispense Product
			</a>
			<a <?php if($urlString != 'receiveDeliveries.php' || $urlString != 'modifyDeliveries.php'){ ?> href='receiveDeliveries.php' <?php  } ?> class='blue extra options <?php if($urlString == 'receiveDeliveries.php' || $urlString == 'modifyDeliveries.php'){echo 'currentTab';}?>'>
				Receive / Edit Deliveries
			</a>
			<a <?php if(
			$urlString != 'reportInventory.php' || 
			$urlString != 'reportMaterials.php' || 
			$urlString != 'reportSummaryIssuance.php' ||
			$urlString != 'reportDeliveries.php'){ ?> href='reportSummaryIssuance.php' <?php  } ?> class='blue options <?php if(
			$urlString == 'reportInventory.php' || 
			$urlString == 'reportMaterials.php' || 
			$urlString == 'reportSummaryIssuance.php' ||
			$urlString == 'reportDeliveries.php'){echo 'currentTab';}?>'>
				Reports
			</a>
		</div>
	
	<?php } else if($usertype == 'Pharmacist') { ?>
	
		<div class='menu additionalMenu'>
			<a <?php  if(
			$urlString != 'activityAssistantPharmacist.php' || 
			$urlString != 'activityAssistantPharmacistActivities.php' || 
			$urlString != 'activityAssistantPharmacistTimeLog.php'){ ?> href='activityAssistantPharmacist.php' <?php } ?> class='blue options <?php  if($urlString == 'activityAssistantPharmacist.php' || $urlString == 'activityAssistantPharmacistActivities.php' || $urlString == 'activityAssistantPharmacistTimeLog.php'){ ?>currentTab<?php } ?>'>
				Activity Log
			</a>
			<a <?php if(
				$urlString != 'dispenseOutPatient.php' || 
				$urlString != 'dispenseInPatient.php' ||
				$urlString != 'dispenseInPatientBedInformation.php' ||
				$urlString != 'dispenseInPatientIssueProduct.php'){ ?> href='dispenseOutPatient.php'  <?php  } ?> class='blue extra options <?php if(
				$urlString == 'dispenseOutPatient.php'|| 
				$urlString == 'dispenseInPatient.php' || 
				$urlString == 'dispenseInPatientBedInformation.php' ||
				$urlString == 'dispenseInPatientIssueProduct.php'){echo 'currentTab';} ?>'>
				Dispense Product
			</a>
			<a <?php if(
				$urlString != 'addProduct.php' || 
				$urlString != 'editProduct.php' ||
				$urlString != 'editVendorInfo.php' ||
				$urlString != 'editVendorProduct.php'){?> href='addProduct.php'  <?php } ?> class='blue options <?php if(
				$urlString == 'addProduct.php' || 
				$urlString == 'editProduct.php' ||
				$urlString == 'editVendorInfo.php' ||
				$urlString == 'editVendorProduct.php'){echo 'currentTab';}?>'>
				Add / Edit Products
			</a>
			<a <?php if($urlString != 'orderProducts.php'){ ?> href='orderProducts.php'  <?php  } ?> class='blue options <?php if($urlString == 'orderProducts.php'){echo 'currentTab';}?>'>
				Order Product
			</a>
			<a <?php if($urlString != 'receiveDeliveries.php' || $urlString != 'modifyDeliveries.php'){ ?> href='receiveDeliveries.php' <?php  } ?> class='blue extra options <?php if($urlString == 'receiveDeliveries.php' || $urlString == 'modifyDeliveries.php'){echo 'currentTab';}?>'>
				Receive / Edit Deliveries
			</a>
			<a <?php if(
			$urlString != 'reportInventory.php' || 
			$urlString != 'reportMaterials.php' || 
			$urlString != 'reportSummaryIssuance.php' ||
			$urlString != 'reportDeliveries.php'){ ?> href='reportSummaryIssuance.php' <?php  } ?> class='blue options <?php if(
			$urlString == 'reportInventory.php' || 
			$urlString == 'reportMaterials.php' || 
			$urlString == 'reportSummaryIssuance.php' ||
			$urlString == 'reportDeliveries.php'){echo 'currentTab';}?>'>
				Reports
			</a>
		</div>
	
	<?php  } else { ?>
	
		<div class='menu additionalMenu'>
			<a <?php  if(
			$urlString != 'adminApproveUsers.php' || 
			$urlString != 'adminDisableUsers.php' || 
			$urlString != 'adminPromoteUsers.php' || 
			$urlString != 'activityAssistantPharmacist.php' || 
			$urlString != 'activityAssistantPharmacistActivities.php' || 
			$urlString != 'activityAssistantPharmacistTimeLog.php' || 
			$urlString != 'activityPharmacist.php' || 
			$urlString != 'activityPharmacistActivities.php' || 
			$urlString != 'activityPharmacistTimeLog.php'){ ?> href='activityPharmacist.php' <?php } ?> class='blue options <?php  if(
			$urlString == 'adminApproveUsers.php' || 
			$urlString == 'adminDisableUsers.php' || 
			$urlString == 'adminPromoteUsers.php' || 
			$urlString == 'activityAssistantPharmacist.php' || 
			$urlString == 'activityAssistantPharmacistActivities.php' || 
			$urlString == 'activityAssistantPharmacistTimeLog.php' || 
			$urlString == 'activityPharmacist.php' || 
			$urlString == 'activityPharmacistActivities.php' || 
			$urlString == 'activityPharmacistTimeLog.php' ){ ?>currentTab<?php } ?>'>
				Administrator Panel
			</a>
			<a <?php if(
				$urlString != 'dispenseOutPatient.php' || 
				$urlString != 'dispenseInPatient.php' ||
				$urlString != 'dispenseInPatientBedInformation.php' ||
				$urlString != 'dispenseInPatientIssueProduct.php'){ ?> href='dispenseOutPatient.php'  <?php  } ?> class='blue extra options <?php if(
				$urlString == 'dispenseOutPatient.php'|| 
				$urlString == 'dispenseInPatient.php' || 
				$urlString == 'dispenseInPatientBedInformation.php' || 
				$urlString == 'dispenseInPatientIssueProduct.php'){echo 'currentTab';} ?>'>
				Dispense Product
			</a>
			<a <?php if(
				$urlString != 'addProduct.php' || 
				$urlString != 'editProduct.php' ||
				$urlString != 'editVendorInfo.php' ||
				$urlString != 'editVendorProduct.php'){?> href='addProduct.php'  <?php } ?> class='blue options <?php if(
				$urlString == 'addProduct.php' || 
				$urlString == 'editProduct.php' ||
				$urlString == 'editVendorInfo.php' ||
				$urlString == 'editVendorProduct.php'){echo 'currentTab';}?>'>
				Add / Edit Products
			</a>
			<a <?php if($urlString != 'orderProducts.php'){ ?> href='orderProducts.php'  <?php  } ?> class='blue options <?php if($urlString == 'orderProducts.php'){echo 'currentTab';}?>'>
				Order Product
			</a>
			<a <?php if($urlString != 'receiveDeliveries.php' || $urlString != 'modifyDeliveries.php'){ ?> href='receiveDeliveries.php' <?php  } ?> class='blue extra options <?php if($urlString == 'receiveDeliveries.php' || $urlString == 'modifyDeliveries.php'){echo 'currentTab';}?>'>
				Receive / Edit Deliveries
			</a>
			<a <?php if(
				$urlString != 'reportInventory.php' || 
				$urlString != 'reportMaterials.php' || 
				$urlString != 'reportSummaryIssuance.php' ||
				$urlString != 'reportDeliveries.php'){ ?> href='reportSummaryIssuance.php' <?php  } ?> class='blue options <?php if(
				$urlString == 'reportInventory.php' || 
				$urlString == 'reportMaterials.php' || 
				$urlString == 'reportSummaryIssuance.php' ||
				$urlString == 'reportDeliveries.php'){echo 'currentTab';}?>'>
				Reports
			</a>
		</div>
	
	<?php } ?>