<?php 
    include("includes/dbconfig.php"); 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $otp = mt_rand(100000, 999999);
            $_SESSION['registration_otp'] = $otp;
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = '
                <div>
                    <p><b>Hello!</b></p>
                    <p>You are receiving this email because we received an OTP request for your account.</p>
                    <br>
                    <p>OTP: ' . $otp . '</p>
                    <br>
                    <p>If you did not request an OTP, no further action is required.</p>
                </div>
                ';
                            
                $email = $email; 
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;                 
                $mail->SMTPSecure = "ssl";      
                $mail->Username = "harshalmakode26@gmail.com";   
                $mail->Password = "jzlelkupjirgavgw";
                $mail->Port = 465; 
                $mail->setFrom("harshalmakode26@gmail.com");
                $mail->FromName = "Hostel Control System";
                $mail->addAddress($email);
                $mail->Subject = "OTP verification";
                $mail->isHTML(true);
                $mail->Body =$message;
                if($mail->send()) {
                    $_SESSION['status'] = 1;
                }
            } else {
                echo 'Invalid email address';
            }
        }
    }
?>