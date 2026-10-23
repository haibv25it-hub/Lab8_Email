<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Phuong thuc khong hop le!');
}

$email = filter_input(
    INPUT_POST,
    'email',
    FILTER_VALIDATE_EMAIL
);

$tieude = trim($_POST['tieude'] ?? '');
$content = trim($_POST['content'] ?? '');

if (!$email || $tieude === '' || $content === '') {
    exit('Vui long nhap day du thong tin hop le!');
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Thay bang thong tin Gmail cua ban
    $nguoigui = 'haibv.25it@vku.udn.vn';
    $matkhau = 'blij phwn raqr yiha';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($nguoigui, 'Bùi Viết Hải');

    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = $tieude;

    $noidungthu = '
        <div style="padding:20px;border:1px solid #ddd;">
            <h3>Xin chao!</h3>
            <p>' .
            nl2br(
                htmlspecialchars(
                    $content,
                    ENT_QUOTES,
                    'UTF-8'
                )
            ) .
            '</p>
        </div>
    ';

    $mail->Body = $noidungthu;

    if (
        isset($_FILES['file']) &&
        $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception(
                'Tep tai len khong thanh cong!'
            );
        }

        if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
            throw new Exception(
                'Tep dinh kem vuot qua 5 MB!'
            );
        }

        $mail->addAttachment(
            $_FILES['file']['tmp_name'],
            basename($_FILES['file']['name'])
        );
    }

    $mail->send();

    echo '<h2>Gui email thanh cong!</h2>';

    echo '<p>Email da gui den: ' .
        htmlspecialchars(
            $email,
            ENT_QUOTES,
            'UTF-8'
        ) .
        '</p>';

    echo '<a href="index.php">Quay lai</a>';

} catch (Exception $e) {

    echo '<h2>Gui email that bai!</h2>';

    echo '<p>' .
        htmlspecialchars(
            $mail->ErrorInfo ?: $e->getMessage(),
            ENT_QUOTES,
            'UTF-8'
        ) .
        '</p>';

    echo '<a href="index.php">Quay lai</a>';
}
?>