<?php 

session_start(); 
$phone=$_POST['phone']; 
$otp=rand(0000,9999); 
$_SESSION['OTP']=$otp; 





$API="4cf33e18ede11b79827bc78b7f2075ae";
$PHONE="$phone";
$OTP=$otp;
$URL="https://sms.renflair.in/V1.php?API=$API&PHONE=$PHONE&OTP=$OTP";
$curl=curl_init($URL);
curl_setopt($curl,CURLOPT_URL,$URL);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$resp=curl_exec($curl);
curl_close($curl);
$data=json_decode($resp);

if ($otp == $_SESSION['OTP']) {
    echo "OTP Verified Successfully!";
    // You can now redirect to dashboard or set session login
    // unset($_SESSION['OTP']); // optional: clear OTP
} else {
    echo "Invalid OTP. Please try again.";
}



?>