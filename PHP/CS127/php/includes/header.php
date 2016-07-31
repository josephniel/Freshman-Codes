<?php 

	include_once('./includes/_connect.php');
	
	$sql = "SELECT COUNT(*) FROM dynamicproducttable WHERE isLowOnQuantity = 1";
	$notif = mysqli_fetch_array(mysqli_query($connect, $sql));
	$sql = "SELECT COUNT(*) FROM dynamicproducttable WHERE isExpiring = 1";
	$notif1 = mysqli_fetch_array(mysqli_query($connect, $sql));
	
	if(isset($_FILES["profileImage"]["name"])){
		$profileImage = $filename;
	}
?>

<div class='header'>
	
	<div class='userPortrait'></div>
	
	<div class='userInfo'>
		<span class='username'><?php echo $fullname ?></span><br />
		<span class='userType'><?php echo $usertype ?></span>
	</div>
	
	<div class='userMenuOptions'>
		<a id='logout' href='./includes/logoutProcess.php'>
			<div class='logout'>Logout</div>
		</a>
		<a href='profile.php'>
			<div class='editProfile <?php if($urlString == 'profile.php'){ ?>current<?php } ?>'>Profile</div>
		</a>
		<a href='notifications.php'>
			<div class='notificationHeader <?php if($urlString == 'notifications.php'){ ?>current<?php } ?>'>Notification <span class='number'><?php echo $notif[0] + $notif1[0]; ?></span></div>
		</a>
		
		
	</div>
	
</div>