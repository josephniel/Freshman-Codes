<?php 
	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');

	$html = "";
	
	if(isset($_POST['submit'])) { 
		$i = 0;
		$result = mysqli_query($connect,"SELECT * FROM usertable");
		while($row = mysqli_fetch_array($result)) {
			if($row['approved'] == 1 && $_SESSION['username'] != $row['username']) {
				$sql = 
					"UPDATE usertable 
					SET userType='" . $_POST['promotedUser'][$i] . "' 
					WHERE username='" . $row['username'] . "'";
				mysqli_query($connect, $sql);
				$html = "<div class='green notice centerNotice marginTop marginBottom'>Selected user(s)'s user type have been successfully changed.</div>";
				$i++;
			}
		}
	}
?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
	
	<div class='modal'>
			<div class='innerModal'>
				
				<div class='removeModal'>X</div>
				
				<h1>Detailed Information</h1>
				<div class='puProfileImage'></div>
				<p>
					<b class='blue'>Username</b><span class='puUsername'></span>
				</p>
				<p>
					<b class='blue'>Full Name</b><span class='puFullname'></span>
				</p>
				<p>
					<b class='blue'>User Type</b><span class='puUserType'></span>
				</p>
				<p>
					<b class='blue'>Sex</b><span class='puSex'></span>
				</p>
				<p>
					<b class='blue'>Birthday</b><span class='puBirthday'></span>
				</p>
				<p>
					<b class='blue'>Email Address</b><span class='puEmail'></span>
				</p>
				<p>
					<b class='blue'>Contact Number</b><span class='puContact'></span>
				</p>
			</div>
		</div>
		
		<div class='content'>
			
			<?php include_once('./includes/submenu.php'); ?>
			<form action='' method='post'>
				<h4> Promote Account </h4>
				
				<?php echo $html; ?>
				
				<div class='pendingUsers'>
					<div class='row tableHeaderRow'>
						<div class='column-1 column'>View <br> Profile</div>
						<div class='column0 column'>Username</div>
						<div class='column1 column'>Full Name</div>
						<div class='column2 column'>Change User Type</div>
					</div>
					
					<?php 
					$query = 0;
					$result = mysqli_query($connect,"SELECT * FROM usertable");
					while($row = mysqli_fetch_array($result)) {
						if($row['approved'] == 1 && $_SESSION['username'] != $row['username']) {
							$query++;
							$birthed = "";
							$birth = explode("-", $row['birthDate']);
								switch($birth[0]){
									case '01': $birthed .=  'January ';
												break;
									case '02': $birthed .=  'February ';
												break;
									case '03': $birthed .=  'March ';
												break;
									case '04': $birthed .=  'April ';
												break;
									case '05': $birthed .=  'May ';
												break;
									case '06': $birthed .=  'June ';
												break;
									case '07': $birthed .=  'July ';
												break;
									case '08': $birthed .=  'August ';
												break;
									case '09': $birthed .=  'September ';
												break;
									case '10': $birthed .=  'October ';
												break;
									case '11': $birthed .=  'November ';
												break;
									case '12': $birthed .=  'December ';
												break;
									default: break;
								}
								$day = str_split($birth[1]);
								if($day[0]==0){
									$birthed .=  $day[1];
								}else $birthed .= $day[0].$day[1];
								$birthed .= ", " . $birth[2];
					?>
						<div 
						id='<?php echo $row['username'] ?>' 
						fullName='<?php echo $row['lastName'] . ", " . $row['firstName'] . " " . $row['middleName']; ?>' 
						userType='<?php echo $row['userType'];?>' 
						sex='<?php echo $row['sex'];?>' 
						birthday='<?php echo $birthed ?>' 
						emailAddress='<?php echo $row['emailAddress'];?>' 
						contactNumber='<?php echo $row['contactNum'];?>' 
						profilePicture='<?php echo $row['profileImage'];?>'
						class='row pendingUsersRow'>
							<div class='column-1 column clickable'> <img src='../images/view.png' class='viewButton'> </div>
							<div class='column0 column'>
								<?php echo $row['username'] ?>
							</div>
							<div class='column1 column'> 
								<?php echo $row['lastName'] ?>, <?php echo $row['firstName'] ?> <?php echo $row['middleName'] ?> 
							</div>
							<div class='column2 column'> 
								<select name='promotedUser[]'>
									<?php if($row['userType'] == 'Administrator') { ?>
										<option selected value='Administrator'>Administrator</option>
									<?php } else { ?>
										<option value='Administrator'>Administrator</option>
									<?php } if($row['userType'] == 'Pharmacist') { ?>
										<option selected value='Pharmacist'>Pharmacist</option>
									<?php } else { ?>
										<option value='Pharmacist'>Pharmacist</option>
									<?php } if($row['userType'] == 'Assistant Pharmacist') { ?>
										<option selected value='Assistant Pharmacist'>Assistant Pharmacist</option>
									<?php } else { ?>
										<option value='Assistant Pharmacist'>Assistant Pharmacist</option>
									<?php }?>
								</select>
							</div>	
						</div>
					<?php
						}
					}
					?>
				
				</div>
				
				<input type='submit' name='submit' id='submit' onClick='submit' class='orange button' />
				
			</form>
					
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
</html>