<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($str){
	global $con;
	$str=mysqli_real_escape_string($con,$str);
	return $str;
}

function redirect($link){
	?>
	<script>
	window.location.href='<?php echo $link?>';
	</script>
	<?php
	die();
}

function random_string($length){
	$str=str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz");
	$str=substr($str,0,$length);
	return strtoupper($str);
}

function send_email($email,$html,$subject){
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="YOUR_USERNAME@gmail.com";
	$mail->Password="PASSWORD";
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject=$subject;
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		//echo "done";
	}else{
		//echo "Error occur";
	}
}


function send_sms($to,$message){
	   $token = "3de1dfe01a56c8afcb4c9f8335a703d1";
	   $code = rand(111111,999999);
	   $to = $mobile;
	   $message = "Dear $name,Your Alokcchota Membership Account OTP Is:$code.'Long Live The Dream,Let The Youth Win.'ALOKCCHOTA";
	   $url = "http://api.greenweb.com.bd/api.php";
	   $data = array(
		  'to' => "$to",
		  'message' => "$message",
		  'token' => "$token"
	   );
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $url);
	   curl_setopt($ch, CURLOPT_ENCODING, '');
	   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   $smsresult = curl_exec($ch);
	   $result = mb_substr($smsresult, 0, 2);
	   if ($result == 'Ok') {
		  "Otp code is successfully sent to your mobile, you may have to wait upto 5 min to receive your code";
			$_SESSION["otp"] = $code;
			$_SESSION['EMAIL']=$email;
			//other operation	
		} else {
		  $msg="Failed to send Otp. Please try again after sometime";
	   }
}

function isAdmin(){
	if(!isset($_SESSION['ADMIN_LOGIN'])){
	?>
		<script>
		window.location.href='./login.php';
		</script>
		<?php
	}
}
function isTEACHER(){
	if(!isset($_SESSION['TEACHER_LOGIN'])){
	?>
		<script>
		window.location.href='./login.php';
		</script>
		<?php
	}
}
function getcoursestudent($id){
	global $con;
	$sql="SELECT count(DISTINCT user_id) as student FROM enroll WHERE enroll.course_id='$id'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['student'];
	}
} 
function gettotalstudent(){
	global $con;
	$sql="SELECT count(DISTINCT id) as student FROM students";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['student'];
	}
} 
function gettotalteacher(){
	global $con;
	$sql="SELECT count(DISTINCT id) as teacher FROM teachers";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['teacher'];
	}
}
function getmycourse($id){
	global $con;
	$sql="SELECT count(DISTINCT id) as course FROM enorll where user_id='$id'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['course'];
	}
} 
?>
