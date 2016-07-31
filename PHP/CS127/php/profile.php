<?php 

	include_once('./includes/sessionStarter.php');
	include_once('./includes/_connect.php');
	
	$sql = 
		"SELECT password, sex, birthDate, emailAddress, contactNum, profileImage 
		FROM usertable 
		WHERE username='" . $username . "'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	
	$newUsername = $pw = $email = $contactnumber = $filename = "";
	$email = $row['emailAddress'];
	$contactnumber = $row['contactNum'];
	
	$isValidated = true;
	$usernameexists = false;
	
	$html = "";
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if(isset($_POST['username'])) {
		$newUsername = mysqli_real_escape_string($connect, test_input($_POST['username']));
		$find = "SELECT username, password, emailAddress, contactNum FROM usertable";
		$result = mysqli_query($connect, $find);
		while($row2 = mysqli_fetch_array($result)){
			if($row2['username'] == $newUsername){
				$usernameexists = true;
				break;
			}
		}
		if($newUsername == "") {
			$html = "<div class='red notice'>Please enter a username.</div>";
			$isValidated = false;
		}
		else if($usernameexists) {
			if($newUsername == $username)
				$html = "<div class='red notice'>This is your old username.</div>";
			else
				$html = "<div class='red notice'>Username already exists.</div>";
			$isValidated = false;
		}
		else if(strlen($newUsername) < 6) {
			$html = "<div class='red notice'>Username must be at least 6 characters.</div>";
			$isValidated = false;
		}
		if($isValidated) {
			$sql = "UPDATE usertable SET username='$newUsername' WHERE username='$username'";
			$html = "<div class='green notice'>Username has been updated.</div>";
			$_SESSION['username'] = $newUsername;
			$username = $_SESSION['username'];
			if(!mysqli_query($connect,$sql)) {
				die('Error: ' . mysqli_error($connect));
			}
		}
	}
	
	if(isset($_POST['oldPassword']) && isset($_POST['newPassword1']) && isset($_POST['newPassword2'])) {
		$oldpw = $_POST['oldPassword'];
		$oldPassword = mysqli_real_escape_string($connect, test_input(md5($oldpw)));
		$newpw1 = $_POST['newPassword1'];
		$newPassword1 = mysqli_real_escape_string($connect, test_input(md5($newpw1)));
		$newpw2 = $_POST['newPassword2'];
		$newPassword2 = mysqli_real_escape_string($connect, test_input(md5($newpw2)));
					
		if($oldpw == "" || $newpw1 == "" || $newpw2 == "") {
			$html = "<div class='red notice'>Please input passwords.</div>";
			$isValidated = false;
		}
		else if($oldPassword == $row['password']) {
			if($newpw1 == $newpw2) {
				if($newpw1 == $oldpw) {
					$html = "<div class='red notice'>This is your old password.</div>";
					$isValidated = false;
				}
				else if(strlen($newpw1) < 6) {
					$html = "<div class='red notice'>Password must be at least 6 characters.</div>";
					$isValidated = false;
				}
				else if($newpw1 == $username) {
					$html = "<div class='red notice'>Password and username should not be the same.</div>";
					$isValidated = false;
				}
			}
			else {
				$html = "<div class='red notice'>New passwords are not the same. Please retype your new password.</div>";
				$isValidated = false;
			}
		}
		else {
			$html = "<div class='red notice'>This is not your old password.</div>";
			$isValidated = false;
		}
		if($isValidated) {
			$sql = "UPDATE usertable SET password='$newPassword1' WHERE username='$username'";
			$html = "<div class='green notice'>Password has been updated.</div>";
			if(!mysqli_query($connect,$sql)) {
				die('Error: ' . mysqli_error($connect));
			}
		}
	}
	
	if(isset($_POST['email'])) {
		$email = mysqli_real_escape_string($connect, test_input($_POST['email']));
		if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && $email != "") {
			$html = "<div class='red notice'>Invalid email format</div>";
			$isValidated = false;
		}
		else if($email == "") {
			$html = "<div class='red notice'>Please enter your email address.</div>";
			$isValidated = false;
		}
		if($email == $row['emailAddress']) {
			$html = "<div class='red notice'>This is your old email address.</div>";
			$isValidated = false;
		}
		if($isValidated) {
			$sql = "UPDATE usertable SET emailAddress='$email' WHERE username='$username'";
			$html = "<div class='green notice'>Email address has been updated.</div>";
			$email = $_POST['email'];
			if(!mysqli_query($connect,$sql)) {
				die('Error: ' . mysqli_error($connect));
			}
		}
	}
	
	if(isset($_POST['contactnumber'])) {
		$contactnumber = mysqli_real_escape_string($connect, test_input($_POST['contactnumber']));
		if($contactnumber == "") {
			$html = "<div class='red notice'>Please enter your contact number.</div>";
			$isValidated = false;
		}
		if($contactnumber == $row['contactNum']) {
			$html = "<div class='red notice'>This is your old contact number.</div>";
			$isValidated = false;
		}
		if($isValidated) {
			$sql = "UPDATE usertable SET contactNum='$contactnumber' WHERE username='$username'";
			$html = "<div class='green notice'>Contact number has been updated.</div>";
			$contactnumber = $_POST['contactnumber'];
			if(!mysqli_query($connect,$sql)) {
				die('Error: ' . mysqli_error($connect));
			}
		}
	}
	
	if(isset($_FILES["profileImage"]["name"])){
		$target_dir = "../images/profileImages/";
		$temp = explode(".",$_FILES["profileImage"]["name"]);
			
		if (end($temp) == "") {
			$filename = "user-placeholder.png";
			$filepath = $target_dir . $filename;
			$html = "<div class='orange notice'>No file selected. Default image uploaded.</div>";
					
			$setImage = "UPDATE usertable SET profileImage='" . $filename . "' WHERE username='$username'";
			mysqli_query($connect, $setImage);
		}	
		else {
			$filename = $username . '.' . end($temp);
			$filepath = $target_dir . $filename;
			if(getimagesize($_FILES["profileImage"]["tmp_name"]) != '') {
				$info = getimagesize($_FILES["profileImage"]["tmp_name"]);
			}
			if ($_FILES['profileImage']['error'] !== UPLOAD_ERR_OK){
			   $html .= "<div class='red notice'>Upload failed with error code " . $_FILES['profileImage']['error'] . "</div>";
			}
			if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)){
			   $html .= "<div class='red notice'>Image is not a gif/png/jpg</div>";
			} else {
				move_uploaded_file($_FILES["profileImage"]["tmp_name"], $filepath);
				$html = "<div class='green notice'>The file " . $filename . " has been uploaded</div>";
								
				$setImage = "UPDATE usertable SET profileImage='" . $filename . "' WHERE username='$username'";
				mysqli_query($connect,$setImage);
				
				header("Cache-Control: no-cache, must-revalidate"); 	// HTTP/1.1
				header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 	// Date in the past 
			}
		}
	}	
	
	$sql = 
		"SELECT password, sex, birthDate, emailAddress, contactNum, profileImage 
		FROM usertable 
		WHERE username='" . $username . "'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	
	
?>

<html>
	
	<?php include_once('./includes/bodyUpper.php') ?>
		<div class='content'>
			<div class='editProfilePage'>
				<h2>Profile Details</h2>

				<form method='post'>
					<b class='withInput gray'>Username</b> <?php echo $username ?><br />
					<input name='username' type='text' size='40' placeholder='Username' />
					<input type='submit' value='Change' class='orange' />
					
				</form>
				<?php if(isset($_POST['username'])) echo $html; ?>
					
				<p><b class='blue'>Full Name</b> <?php echo $fullname ?></p>

				<form method='post'>
					<b class='withInput1 gray'>Password</b> <input name='oldPassword' type=
					'password' size='50' placeholder='Old Password' class='noMargin' /><br />
					<input name='newPassword1' type='password' size='50' placeholder=
					'New Password' /><br />
					<input name='newPassword2' type='password' size='50' placeholder=
					'Re-type New Password' /> <input type='submit' value='Change' class='orange' />
				</form>
				<?php if(isset($_POST['oldPassword']) && isset($_POST['newPassword1']) && isset($_POST['newPassword2'])) echo $html; ?>
				
				<p><b class='blue'>Usertype</b> <?php echo $usertype ?></p>

				<p><b class='blue'>Sex</b> <?php echo $row['sex'] ?></p>

				<p><b class='blue'>Birthdate</b>
				
					<?php 
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
				
						echo $birthed;
					?>
				</p>

				<form method='post'>
					<b class='withInput gray'>Email Address</b> <?php echo $row['emailAddress'] ?><br />
					<input name='email' type='text' size='50' placeholder='Email Address' class='noMargin' />
					<input type='submit' value='Change' class='orange' />
				</form>
				<?php if(isset($_POST['email'])) echo $html; ?>
				
				<form method='post'>
					<b class='withInput gray'>Contact Number</b> <?php echo $row['contactNum'] ?><br />
					<input name='contactnumber' type='text' size='40' placeholder='Contact Number' class='noMargin' />
					<input type='submit' value='Change' class='orange' />
				</form>
				<?php if(isset($_POST['contactnumber'])) echo $html; ?>
				
				<form method='post' class='fileUpload' enctype="multipart/form-data">
					<b class='withInput gray' style='height: 214px; line-height: 214px;'>Profile
					Image</b>

					<div class='pProfileImage'></div><input type='file' name="profileImage" /><br />
					<input type='submit' value='Change' class='orange' />
				</form>
				<?php if(isset($_FILES["profileImage"]["name"])) echo $html; ?>
				<div class='marginTop'>
					<p style='font-size: 14px;'>Note: Please upload only .jpg and .png files to avoid discrepancies.</p>
				</div>
			</div>
		</div>
	<?php include_once('./includes/bodyLower.php') ?>
	
	<?php 
		echo 
		"<script> 
			$('.pProfileImage').css('background-image','url(../images/profileImages/". $row['profileImage'] .")'); 
		</script>";
	?>
</html>