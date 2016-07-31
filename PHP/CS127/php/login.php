<?php 

	session_start(); 

		/* REMOVES SESSION SO THAT USER WOULD BE LOGGED OUT */
		session_unset(); 
		session_destroy();

		include_once('./includes/_connect.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$sql = 
			"SELECT username, password, firstName, middleName, lastName, username, userType, profileImage, approved
			FROM usertable 
			WHERE username = '" . $username . "'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		 
		if($row['username'] == $username && $row['password'] == $password) {
			if($row['approved'] == 1){
				session_start();
				
				$_SESSION['fullname'] = $row['firstName'] . " " .  $row['middleName'] . " " . $row['lastName'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['usertype'] = $row['userType'];
				$_SESSION['profileImage'] = $row['profileImage'];
				
				mysqli_close($connect);
				header('Location: ./home.php');
			}
			elseif($row['approved'] == 0){
				echo "<script>alert('Wait for Administrator confirmation.');</script>";
			}
		}
		else {
			echo "<script>alert('Log-in failed.');</script>";
		}
	}

?>

<html>
	<?php include_once('./includes/head.php') ?>
	<body class='loginPage'>
		
		<form method='post' id="login" name="login-form">	
				<div class='companyLogo'>
					<img src='../images/logo.png' >
				</div>
				<input name='username' type='text' placeholder='Username' class='inputBar'>
				<input name='password' type='password' placeholder='Password' class='inputBar'> 
				<input type='submit' value='Login' class='submitButton green'>
		</form>
		
		<a href='signup.php'>
			<button class='signUpButton blue'>Sign Up</button>
		</a>
		
	</body>
</html>