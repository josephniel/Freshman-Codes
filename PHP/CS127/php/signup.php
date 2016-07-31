<?php 

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	include_once('./includes/_connect.php');
	
		$username = $password = $password2 = $lastname = $firstname = $middlename = $usertype = $sex = $birthmonth = $birthdate = $birthyear = $email = $contactnumber = "";
	
		$start = true;	
		$isValidated = true;
		$usernameexists = false;	
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
		
		$start = false;
		
		$username = mysqli_real_escape_string($connect, test_input($_POST['username']));
		$password =  mysqli_real_escape_string($connect, md5(test_input($_POST['password'])));
		$password2 =  mysqli_real_escape_string($connect, md5(test_input($_POST['rpw'])));
		$lastname = mysqli_real_escape_string($connect, test_input($_POST['lastname']));
		$firstname = mysqli_real_escape_string($connect, test_input($_POST['firstname']));
		$middlename = mysqli_real_escape_string($connect, test_input($_POST['middlename']));
		$usertype = mysqli_real_escape_string($connect, test_input($_POST['usertype']));
		$sex = mysqli_real_escape_string($connect, test_input($_POST['sex']));
		$birthmonth = mysqli_real_escape_string($connect, test_input($_POST['birthmonth']));
		$birthday = mysqli_real_escape_string($connect, test_input($_POST['birthdate']));
		$birthyear = mysqli_real_escape_string($connect, test_input($_POST['birthyear']));
		$email = mysqli_real_escape_string($connect, test_input($_POST['email']));
		$contactnumber = mysqli_real_escape_string($connect, test_input($_POST['contactnumber']));
		
		if(strlen($birthday) == 1){
			$birthday = "0" . $birthday;
		}
		if(strlen($birthmonth) == 1){
			$birthmonth = "0" . $birthmonth;
		}
		
		$birthdate = $birthmonth . "-" . $birthday . "-" . $birthyear;
		
		if($username == "" || $password == "" || $password2 == "" || $lastname == "" || $firstname == "" || $middlename == "" || $usertype == "" || $sex == "" || $birthmonth == "" || $birthday == "" || $birthyear == "" || $email == "" || $contactnumber == ""){
			$isValidated = false;
		}
		$sql=
			"SELECT count(username) 
			FROM usertable 
			WHERE username = '" . $username . "'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		
		if($row[0] != 0){ 
			$usernameexists = true;
			$isValidated = false;
		}		
		if(
			strlen(test_input($_POST['password'])) < 6 && 
			strlen($username) < 6 && 
			strlen($username) > 20 &&
			strlen($firstname) > 40 &&
			strlen($middlename) > 20 &&
			strlen($lastname) > 20 &&
			strlen($email) > 50 &&
			strlen($contactnumber) > 20
			){ $isValidated = false; }
		if($password != $password2){ $isValidated = false; }
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ $isValidated = false; }
				
		if($isValidated){
			$sql = 
				"INSERT INTO usertable(`username`, `password`, `lastName`, `firstName`, `middleName`, `userType`, `sex`, `birthDate`, `emailAddress`, `contactNum`, `profileImage`, `approved`)
				VALUES ('" . $username . "', '" . $password . "', '" . $lastname . "', '" . $firstname . "', '" . $middlename . "', '" . $usertype . "', '" . $sex . "', '" . $birthdate . "', '" . $email . "','" . $contactnumber . "', 'user-placeholder.png', 0)";
			
			if(!mysqli_query($connect,$sql)) { die('Error: ' . mysqli_error($connect)); }
			
			mysqli_close($connect);
			header('Location: login.php');
		}		
	}
	
	session_start(); 

	/* REMOVES SESSION SO THAT USER WOULD BE LOGGED OUT */
		session_unset(); 
		session_destroy();

?>

<html>
	<?php include_once('./includes/head.php') ?>
	<body class='signUpPage'>
		
		<a href='./login.php'>
			<img src='../images/logo.png' >
			<h3>MedTrack - Sign Up</h3>
		</a>
		
		<form method='post' class="signUpForm" name="signup-form">
			<div id="sign-form">
				<div class='row'>
					<div class='column1 column blue'>
						<label>Username</label>
					</div>
					<div class='column2 column'>
						<input name="username" type="text" size="40" value="<?php echo $username ?>"/>
					</div>
					<?php
					if($username == "" && !$start){
						echo '<div class="error column red">Please enter a username</div>';
					} else if($usernameexists){
						echo '<div class="error column red">Username already exists</div>';
					} else if(!$start && strlen($username) < 6){
						echo '<div class="error column red">Username must be at least 6 characters</div>';
					} else if(!$start && strlen($username) > 20){
						echo '<div class="error column red">Username must be at most 20 characters</div>';
					}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>First Name</label>
					</div>
					<div class='column2 column'>
						<input name="firstname" type="text" size="40" value="<?php echo $firstname ?>"/>
					</div>
					<?php
					if(!$start && $firstname == ""){
						echo '<div class="error column red">What\'s your first name?</div>';
					} else if(!$start && strlen($firstname) > 40){
						echo '<div class="error column red">First name must be at most 40 characters.</div>';
					} 
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Middle Name</label>
					</div>
					<div class='column2 column'>
						<input name="middlename" type="text" size="40" value="<?php echo $middlename ?>"/>
					</div>
					<?php
					if(!$start && $middlename == ""){
						echo '<div class="error column red">What\'s your middle name?</div>';
					} else if(!$start && strlen($middlename) > 20){
						echo '<div class="error column red">Middle name should be at most 20 characters.</div>';
					} 
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Last Name</label>
					</div>
					<div class='column2 column'>
						<input name="lastname" type="text" size="40" value="<?php echo $lastname ?>"/>
					</div>
					<?php
					if(!$start && $lastname == ""){
						echo '<div class="error column red">What\'s your last name?</div>';
					} else if(!$start && strlen($lastname) > 20){
						echo '<div class="error column red">Last name should be at most 20 characters.</div>';
					}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Sex</label>
					</div>
					<div class='column2 column'>
						<select name='sex' id='sex'>
							<option value=''>Choose One</option>
							<?php
							$sexArr = array("Male","Female");
							foreach($sexArr as $value){
								if($sex == $value){
									echo '<option value="'.$value.'" selected>'.$value.'</option>';
								} else {
									echo '<option value="'.$value.'">'.$value.'</option>';
								}
							}
							?>
						</select>
					</div>
					<?php
					if(!$start && $sex == ""){
						echo '<div class="error column red">Please choose a sex</div>';
					}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Birthdate</label>
					</div>
					<div class='column2 column'>
						<select name='birthmonth' id='month'>
							<option value=''>Month</option>
							<?php
								$monthArr = array();
								for($i=0; $i<12; $i++)
									$monthArr[$i] = $i + 1;
							
								foreach($monthArr as $value){
									if($birthmonth == $value){
										echo '<option value="'.$value.'" selected>'.$value.'</option>';
									} else{
										echo '<option value="'.$value.'">'.$value.'</option>';
									}
								}
							?>
						</select>
						
						<select name='birthdate' id='day'>
							<option value=''>Day</option>
							<?php
								$dayArr = array();
								for($i=0; $i<31; $i++)
									$dayArr[$i] = $i + 1;
							
								foreach($dayArr as $value){
									if($birthday == $value){
										echo '<option value="'.$value.'" selected>'.$value.'</option>';
									} else{
										echo '<option value="'.$value.'">'.$value.'</option>';
									}
								}
							?>
						</select>
						
						<select name='birthyear' id='day'>
							<option value=''>Year</option>
							<?php
								$yearArr = array();
								for($i=2014; $i>=1900; $i--)
									$yearArr[2014-$i] = $i;
							
								foreach($yearArr as $value){
									if($birthyear == $value){
										echo '<option value="'.$value.'" selected>'.$value.'</option>';
									} else{
										echo '<option value="'.$value.'">'.$value.'</option>';
									}
								}
							?>
						</select>
					</div>
					<?php
						if(!$start && ($birthmonth == "" || $birthday == "" || $birthyear == "")){
							echo '<div class="error column red">When\'s your birthday?</div>';
						}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Contact Number</label>
					</div>
					<div class='column2 column'>
						<input name="contactnumber" type="text" size="40" value="<?php echo $contactnumber; ?>"/>
					</div>
					<?php
					if(!$start && $contactnumber == ""){
						echo '<div class="error column red">What\'s your contact number?</div>';
					} else if(!$start && strlen($email) > 20){
							echo '<div class="error column red">Contact Number should be at most 20 characters.</div>';
					}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>E-mail Address</label>
					</div>
					<div class='column2 column'>
						<input name="email" type="text" size="50" value="<?php echo $email; ?>"/>
					</div>
					<?php
						if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && $email != ""){
							echo '<div class="error column red">Invalid email format</div>';
						} else if(!$start && $email == ""){
							echo '<div class="error column red">Please enter your email address</div>';
						} else if(!$start && strlen($email) > 50){
							echo '<div class="error column red">Email Address should be at most 50 characters.</div>';
						}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Password</label>
					</div>
					<div class='column2 column'>
						<input name="password" type="password" size="50"  value=""/>
					</div>
					<?php
						if(!$start && strlen($_POST['password']) < 6){
							echo '<div class="error column red">Password must be at least 6 characters</div>';
						}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Re-type Password</label>
					</div>
					<div class='column2 column'>
						<input name="rpw" type="password" size="50"  value=""/>
					</div>
					<?php
						if(!$start && ($password != $password2)){
							echo '<div class="error column red">Please type the same password you entered above</div>';
						}
					?>
				</div>
				<div class='row'>
					<div class='column1 column blue'>
						<label>Type</label>
					</div>
					<div class='column2 column'>
						<select name='usertype' id='type'>
							<option value=''>Usertype</option>
							<?php
								$userArr = array("Pharmacist","Assistant Pharmacist");
								foreach($userArr as $value){
									if($usertype == $value){
										echo '<option value="'.$value.'" selected>'.$value.'</option>';
									}
									else{
										echo '<option value="'.$value.'">'.$value.'</option>';
									}
								}
							?>
						</select> 
					</div>
					<?php
						if($usertype == "" && !$start){
							echo '<div class="error column red">Please select among the types</div>';
						}
					?>
				</div>
				<input type="submit" value="Submit" class="submit green"/>
			</div>
		</form>
		
		
	</body>
</html>