<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $nguoigui = 'haibv.25it@vku.udn.vn';
    $matkhau = 'blij phwn raqr yiha';
    $tennguoigui = 'Bùi Viết Hải';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->CharSet = 'UTF-8';
    $mail->setFrom($nguoigui, $tennguoigui);

    $to = 'haiviet3478@gmail.com';
    $to_name = 'Viết Hải';

    $mail->addAddress($to, $to_name);

    $mail->isHTML(true);
    $mail->Subject = 'Gui thu tu PHP';

    $mail->Body = '
        <h2>Chao ban!</h2>
        <p>Day la email duoc gui tu PHP.</p>
        <p>Chuc ban mot ngay tot lanh!</p>
    ';

    $mail->send();

    echo 'Da gui email thanh cong!';

} catch (Exception $e) {
    echo 'Khong gui duoc email: ' . $mail->ErrorInfo;
}
?>