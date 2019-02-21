
<?php
session_start();
include("home.php");
$phonenumber=$_POST['phone']; ////STK push sent to phone number given.
$time=date();
echo $time;
error_reporting(1);
$url = 'https://developer.safaricom.co.ke/lipa-na-m-pesa-online/apis/post/stkpush/v1/processrequest';

//https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer LtPcYg3r8RJJGRIZcrPMYwURMsmB')); //Access token expires after one hour unfortunately.


$curl_post_data = array(
  
  'BusinessShortCode' => '174379',
  'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTkwM',
  'Timestamp' => '$time',
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount"' => '1',
  'PartyA' => '$phonenumber',
  'PartyB' => '174379',
  'PhoneNumber' => '$phonenumber', 
  'CallBackURL' => 'https://05135c4e.ngrok.io/hooks/mpesa',
  'AccountReference' => 'TechSavannaInterview',
  'TransactionDesc' => 'TechSavannaInterview'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>