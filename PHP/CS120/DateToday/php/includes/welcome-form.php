<?php
/*
Date Today
The Internet's Most Notorious Dating Site

Authors: 

Joseph Niel Tuazon
	Website: http://josephnieltuazon.tumblr.com
	Email: josephnieltuazon@yahoo.com
Ruahden Dang-awan
	Email: 
*/

?>

<?php
// define variables and set to empty values
$nameClass = $ageClass = $emailClass = $sexClass = $preferenceClass = 'noError';
$name = $age = $email = $sex = $preference = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$valid = true;

	if (empty($_POST['name'])){
		$nameClass = 'error';
		$valid = false;
	}
	else{
		$name = test_input($_POST['name']);
		$nameClass = 'noError';
	}
	if (empty($_POST['age'])){
		$ageClass = 'error';
		$valid = false;
	}
	else{
		$age = test_input($_POST['age']);
		if($age >= 18 && $age < 100){
			$ageClass = 'noError';
		}
		else{
			$ageClass = 'error';
			$valid = false;
		}
	}
	if (empty($_POST['email'])){
		$emailClass = 'error';
		$valid = false;
	}
	else{
		$email = test_input($_POST['email']);
		$emailregex = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';
		if(preg_match($emailregex, $email)){
			$emailClass = 'noError';
		}
		else{
			$emailClass = 'error';
			$valid = false;
		}
	}
	
	if($valid){
		session_start();
		$_SESSION = array();
		$_SESSION['welcomeForm'] = array();
		$_SESSION['welcomeForm']['name'] = $_POST['name'];
		$_SESSION['welcomeForm']['age'] = $_POST['age'];
		$_SESSION['welcomeForm']['email'] = $_POST['email'];
		$_SESSION['welcomeForm']['sex'] = $_POST['sex'];
		$_SESSION['welcomeForm']['preference'] = $_POST['preference'];
		header('Location: ./dateList');
		exit;
	}
   
}

function test_input($data){
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>

<form name='form' method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>

	<h3>Sign up</h3>

	<div class='row'>
		<div class='columns'>
			<label>Name <small class='required'>required</small></label>
			<input name='name' type='text' placeholder='Input your name here' value='<?php echo $name ?>' />
			<small class='<?php echo $nameClass; ?>'>Input a valid name</small>
		</div>
	</div>
	<div class='row'>
		<div class='medium-3 columns'>
			<label>Age <small class='required'>required</small></label>
			<input name='age' type='text' placeholder='+18' value='<?php echo $age ?>' />
			<small class='<?php echo $ageClass; ?>'>+18 only!</small>
		</div>
		<div class='medium-9 columns'>
			<label>E-mail <small class='required'>required</small></label>
			<input name='email' type='email' placeholder='Input a valid email address' value='<?php echo $email ?>' />
			<small class='<?php echo $emailClass; ?>'>Input a valid email address</small>
		</div>
	</div>
	<div class='row'>
		<div class='small-6 columns'>
			<label>Sex <small class='required'>required</small></label>
			<select id='sex' name='sex'>
				<option value='male' selected='selected'>Male</option>
				<option value='female'>Female</option>
			</select>
		</div>
		<div class='small-6 columns'>
			<label>Preference <small class='required'>required</small></label>
			<select id='preference' name='preference'>
				<option value='male'>Male</option>
				<option value='female' selected='selected'>Female</option>
			</select>
		</div>
	</div>
	<div class='row'>
		<div class='medium-4 medium-offset-8 columns'>
			<input type='submit' value='Next' class='button small expand' />
		</div>
	</div>
	
</form>
<div class='row'>
	<div class='columns' style='text-align:right;color:#f5f3f0'>
		Already have an account? <a id='login-button'>Log-in instead.</a>
	</div>
</div>