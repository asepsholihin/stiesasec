<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$name   = $_POST['name'];
$email  = $_POST['email'];
$company= $_POST['company'];
$phone  = $_POST['phone'];
$message= $_POST['message'];

$mail = new PHPMailer;

$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "EMAIL";  //Mikmiwu email
$mail->Password = "PASSWORD";
$mail->setFrom(''.$email.'', ''.$name.'');
$mail->addAddress('EMAIL', 'NAME'); //Mikmiwu email
$mail->Subject = 'Mikmiuw Requesting Clients';
$mail->Body    = '
Message From <br><br>
<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>'.$name.'</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>'.$email.'</td>
    </tr>
    <tr>
        <td>Company</td>
        <td>:</td>
        <td>'.$company.'</td>
    </tr>
    <tr>
        <td>Phone</td>
        <td>:</td>
        <td>'.$phone.'</td>
    </tr>
    <tr>
        <td>Message</td>
        <td>:</td>
        <td>'.$message.'</td>
    </tr>
</table>
';

if(empty($name)) {
    echo json_encode(['error'=>true, 'msg' => 'Tell us your name']);
} else if(empty($email)) {
    echo json_encode(['error'=>true, 'msg' => 'Tell us your email']);
} else if(empty($phone)) {
    echo json_encode(['error'=>true, 'msg' => 'Tell us your phone']);
} else if(empty($message)) {
    echo json_encode(['error'=>true, 'msg' => 'Tell us about your project']);
} else {
    if (!$mail->send()) {
        echo json_encode(['error'=>true, 'msg' => 'Something wrong.']);
    } else {
        echo json_encode(['error'=>false, 'msg' => 'Email has been sended, please sit back and wait until confirmation from us']);
    }
}
