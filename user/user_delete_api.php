<?php
$fields_string="";
$fields = array(
    'store_id' => 'dkn',
    'store_password' => 'ddd',
    'id' => rand(10,19)*1,
);
foreach($fields as $key=>$value){
	$fields_string .= $key.'='.$value.'&'; 
}
$fields_string = rtrim($fields_string, '&');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/api/delete.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
$result = curl_exec($ch);
curl_close($ch);
$result=json_decode($result,true);
echo "<pre>";
print_r($result);
echo "</pre>";
?>