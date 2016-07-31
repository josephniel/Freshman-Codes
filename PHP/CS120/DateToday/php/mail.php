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

	// Start Session to get preference
	session_start();
	$preference = $_SESSION['welcomeForm']['preference'];
	
	// Load the XML file
	$xml = simplexml_load_file("xml_".$preference.".xml");
	
	require './PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                      
		$mail->SMTPAuth = true;  
		$mail->SMTPSecure = 'ssl';		
		$mail->Host = 'smtp.mail.yahoo.com';  				  
		$mail->Port = 465;
		
		$mail->Username = 'datetoday_noreply@yahoo.com';       
		$mail->Password = 'CS120project';                                                   

	$mail->From = 'datetoday_noreply@yahoo.com';
	$mail->FromName = 'Date Today';
	$mail->addAddress($_SESSION['welcomeForm']['email'], $_SESSION['welcomeForm']['name']); 

	$mail->WordWrap = 50;                                 
	$mail->isHTML(true);                                  

	$mail->Subject = 'Date Purchase Details';
	
require_once("./tcpdf/tcpdf.php");

$pdf = new TCPDF($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false);
$pdf->SetFont('times', 'BI', 14);
$pdf->AddPage();

$pdf->SetMargins(20, 10, 20);

//print_r($_SESSION);

$html = " <h1>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Date Today Official Receipt</h1> ";

//print_r($_SESSION);
			
$html .= "<h2>Good day ";
if($_SESSION['welcomeForm']['sex'] == "male"){
	$html .= "Mr. ";
}else{
	$html .= "Ms. ";
}
$html .= $_SESSION['welcomeForm']['name'].  "!</h2>";
//$html .= "<center>ahahaha</center>";
$html .= "<h4>&nbsp;&nbsp;&nbsp;&nbsp;Dater's details: </h4>";
	
$html .= "<div width='100%' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Age: ".$_SESSION['welcomeForm']['age'] ." yrs old <br />".
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: ".$_SESSION['welcomeForm']['email']."<br />".
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sex: ".$_SESSION['welcomeForm']['sex']."<br />".
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preference: ".$_SESSION['welcomeForm']['preference']."<br />";
//"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Payment: P" .$_SESSION['welcomeForm']['price']."</div>";

$html .= "<h4>&nbsp;&nbsp;&nbsp;&nbsp;Your dates: </h4>";

$html .= '<table>';

foreach($_SESSION['dates'] as $date){
	if($date != null || $date != ""){
		$number = (int)substr($date, 4,1) -1;
		
		$html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;';
		if($_SESSION['welcomeForm']['preference'] == "female"){
		if($number == 0){
			$html .= '<img src="../images/dates/user1/p1-0.jpg" width="100px" height="100px" />';
		}elseif($number == 1){
			$html .= '<img src="../images/dates/user2/p2-0.jpg" width="100px" height="100px" />';
		}elseif($number == 2){
			$html .= '<img src="../images/dates/user3/p3-0.jpg" width="100px" height="100px" />';
		}elseif($number == 3){
			$html .= '<img src="../images/dates/user4/p4-0.jpg" width="100px" height="100px" />';
		}elseif($number == 4){
			$html .= '<img src="../images/dates/user5/p5-0.jpg" width="100px" height="100px" />';
		}
		}else{
		if($number == 0){
			$html .= '<img src="../images/dates/user6/p6-0.jpg" width="100px" height="100px" />';
		}elseif($number == 1){
			$html .= '<img src="../images/dates/user7/p7-0.jpg" width="100px" height="100px" />';
		}elseif($number == 2){
			$html .= '<img src="../images/dates/user8/p8-0.jpg" width="100px" height="100px" />';
		}elseif($number == 3){
			$html .= '<img src="../images/dates/user9/p9-0.jpg" width="100px" height="100px" />';
		}elseif($number == 4){
			$html .= '<img src="../images/dates/user10/p10-0.jpg" width="100px" height="100px" />';
		}
		}
		$html .= '</td><td colspan="2">';
		$html .= 'Date: &nbsp;'. $xml->dateDetails[$number]->name . "<br />";
		$html .= 'Schedule: <br />';
		foreach($xml->dateDetails[$number]->scheds->sched as $z){
			foreach($_SESSION['schedules'] as $y){
				if($z == $y){
					$html .= "&nbsp;&nbsp;&nbsp;&nbsp;".$z . "<br />";
				}
			}
		}
		$html .= '</td></tr>';
	}
}
$html .= '</table>';
$html .= "<h3>&nbsp;&nbsp;&nbsp;&nbsp;Total payment for your dates: " .$_SESSION['welcomeForm']['price'] . "</h3><br /> <br /> < br /> <br /> < br /> ";
$html .= '_______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________________<br />';
$html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dater's Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receiver's Signature";
$html .= '<br /> <h6>&nbsp; &nbsp;&nbsp;&nbsp;***This serves as your official receipt. Kindly print it for future references.</h6>';
// input name, age, sex, preference, schedules, total price;

$pdf->writeHTML($html,$ln = true,$fill = false,$reseth = false,$cell = false,$align = '');

$pdf->AddPage();
//echo $html;
//starting new html
$html = " <h1>&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Process of Payment</h1> ";

$html .= "<h3> Step 1: Print your Official Receipt and sign it</h3>";
			
$html .= "<h3> Step 2: Choose your payment method</h3>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a. Credit Card</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. Cash</p>
		";
		
$html .= "<h3> Step 3: Go your nearest MotroBank Branch</h3>
		<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. If you chose Credit Card, please go to the 'Online payment' section with the following requirements: a valid ID, your printed Date Today Official Receipt 
		and your Credit Card. Present your Official Date Today Receipt to the teller and your valid ID. </p>
		<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. If you chose Cash, please bring your total payment, the official receipt and a valid ID. And please go to the 
			'Offline payment' and present your receipt and valid ID.</p>";

$html .= "<h3> Step 4: Keep the receipt</h3>
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Give the credit card or cash to the teller. The teller will tell you where the date will happen. Make the teller sign the official receipt and keep it.</p>";

$html .= "<h3> Step 5: Date</h3>
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Before going on a date, bring your valid ID and official receipt. When you meet your date, 
			please present your ID and receipt for validation and the assurance of the safety of our dates. After that, keep your receipt and valid ID and enjoy your Date!</p>";
			
$pdf->writeHTML($html,$ln = true,$fill = false,$reseth = false,$cell = false,$align = '');

$doc = $pdf -> Output('date_today_voucher.pdf','S');

	$mail->AddStringAttachment($doc, 'date_today_voucher.pdf'); 
	$mail->Body = 'Attached is your date purchase details. Please settle your payment on or before the date itself.
		<br /><br />
		Thank you for choosing Date Today! 
		<br /><br />
		<strong>Date Today Team:</strong> <br />
		&nbsp;&nbsp;&nbsp;  Ruahden Dang-awan <br />
		&nbsp;&nbsp;&nbsp;  Joseph Niel Tuazon';
	$mail->AltBody = 'Attached is your date purchase details.';

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	}

	header("Location: ./confirm");
	exit;