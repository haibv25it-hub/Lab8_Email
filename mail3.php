<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

$recipients = [
    'email1@gmail.com',
    'email2@gmail.com',
    'haiviet3478@gmail.com'
];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $nguoigui = 'haibv.25it@vku.udn.vn';
    $matkhau = 'blij phwn raqr yiha';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($nguoigui, 'Bùi Viết Hải');

    $mail->isHTML(true);
    $mail->Subject = 'Thong bao tu PHP';

    $mail->Body = '
        <h2>Xin chao!</h2>
        <p>Day la email duoc gui tu chuong trinh PHP.</p>
    ';

    $success = 0;
    $failed = 0;

    foreach ($recipients as $email) {

        try {
            $mail->clearAddresses();
            $mail->addAddress($email);
            $mail->send();

            echo 'Gui thanh cong den: ' .
                htmlspecialchars(
                    $email,
                    ENT_QUOTES,
                    'UTF-8'
                ) .
                '<br>';

            $success++;

        } catch (Exception $e) {

            echo 'Gui that bai den: ' .
                htmlspecialchars(
                    $email,
                    ENT_QUOTES,
                    'UTF-8'
                ) .
                '<br>';

            $failed++;
        }
    }

    echo '<hr>';
    echo 'Tong so email gui thanh cong: ' . $success;
    echo '<br>';
    echo 'Tong so email gui that bai: ' . $failed;

} catch (Exception $e) {

    echo 'Loi cau hinh SMTP: ' .
        htmlspecialchars(
            $mail->ErrorInfo,
            ENT_QUOTES,
            'UTF-8'
        );
}
?>