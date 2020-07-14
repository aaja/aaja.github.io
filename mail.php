<?php
session_start();
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');

$SMTPSERVER='';
$SMTPPORT='';
$SMTPUSER='';
$SMTPPASSWORD='';
$ADMINEMAIL='';
$ADMINNAME='';
$SUBJECT ='';
$EMAILFAILERROR='';

$from = $_POST['email'];
$fullName= $_POST['from'];
$message= $_POST['message'];

echo smtpmailer($from,$fullName,$message);  

function smtpmailer($from, $from_name, $body) {
	$mail = new PHPMailer();
//	$mail->SMTPDebug = 1;
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.163.com';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->CharSet = 'UTF-8';
	$mail->FromName = '发件人昵称';
	$mail->Username = 'crystalaalx@163.com';
	$mail->Password = 'TPPWOAYUFRCGFOAI';
	$mail->SetFrom($from, $from_name);
	$mail->isHTML(true);
	$mail->addAddress('jiujun0520@163.com');
	$mail->Subject = '来自www.sujiujun.com的邮件';
	$mail->Body = '<h1> $body </h1>';
//	$mail->addAttachment('./example.pdf');
	$status = $mail->send();
	echo $status;
//	global $SMTPSERVER,$SMTPPORT,$SMTPUSER,$SMTPPASSWORD,$ADMINEMAIL,$ADMINNAME;
//	global $SUBJECT,$EMAILFAILERROR,$EMAILSUCCESSMSG;
//	global $error;
//	readMailSettings();
//	$to = $ADMINEMAIL;
//	$mail = new PHPMailer();  // create a new object
//	$mail->IsSMTP(); // enable SMTP
//	$mail->IsMail();//enable email through php mail();
//    $mail->IsHTML(true);
//	$mail->SetFrom($from, $from_name);
//    $mail->Subject = $SUBJECT;
//	$mail->Body = $body;
//	$mail->AddAddress($to);
//
//	if(!$mail->Send())
//    {
//        echo "MAIL_ERROR ". $EMAILFAILERROR;
//        return false;
//    }
//	else
//    {
//        echo "{";
//        echo "\"MAIL_SUCCESS\":\"" .$EMAILSUCCESSMSG . "\",\n";
//        echo "\"result\": \"true\"\n";
//        echo "}";
//    }
}
function readMailSettings()
{
	global $SMTPSERVER,$SMTPPORT,$SMTPUSER,$SMTPPASSWORD,$ADMINEMAIL,$ADMINNAME,$SUBJECT,$EMAILFAILERROR,$EMAILSUCCESSMSG;
	
	$file  = fopen('mail.config','r');
	while(!feof($file))
	{
		$setting = explode(':',fgets($file));
		switch($setting[0])
		{
			case 'SMTPSERVER':
				$SMPTSERVER = $setting[1];
				break;
			case 'SMTPPORT':
				$SMTPPORT = $setting[1];
				break;
			case 'SMTPUSER':
				$SMPTUSER = $setting[1];
				break;
			case 'SMTPPASSWORD':
				$SMTPPASSWORD  = $setting[1];
				break;
			case 'ADMINEMAIL':
				$ADMINEMAIL = $setting[1];			
				break;
			case 'ADMINNAME':
				$ADMINNAME = $setting[1];
				break;	
            case 'SUBJECT':
                $SUBJECT = $setting[1];
                break;
            case 'EMAILFAILERROR':
                $EMAILFAILERROR =  $setting[1];
                break;
            case 'EMAILSUCCESSMSG':
                $EMAILSUCCESSMSG = $setting[1];
                break;
               
		}	
	}
}
?>
