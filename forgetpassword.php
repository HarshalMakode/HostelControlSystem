<?php include("includes/dbconfig.php"); 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

?>
<?php 
    
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        if($email != ''){
            $query = "SELECT * FROM students where email='$email'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $resultexist = $statement->fetchAll();
            
            if(!($resultexist)){
                $_SESSION['status'] = 2;
            }
            else {
                $message = '
                <div>
                    <p><b>Hello!</b></p>
                    <p>You are recieving this email because we recieved a password reset request for your account.</p>
                    <br>
                    <p><button class="btn btn-primary"><a href="http://localhost/HostelControlSystem/passwordreset.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
                    <br>
                    <p>If you did not request a password reset, no further action is required.</p>
                </div>';
                
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
                $mail->Subject = "Reset Password";
                $mail->isHTML(true);
                $mail->Body =$message;
                if($mail->send()) {
                    $_SESSION['status'] = 1;
                }
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Hostel Control Management</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css?v=1">
        <link rel="stylesheet" type="text/css" href="assets/css/responsive.css?v=1">
        <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        <link rel="icon" type="image/x-icon" href="assets/images/hostel.png">
        <style>
            .first-slide {
                width: 100%;
                height: 340px;
            }
            
        </style>    
    </head>

    <body class="main-layout" style="overflow-x: hidden;">

        <div class="loader_bg">
            <div class="loader">
                <img src="assets/images/loading.gif" alt="#" />
            </div>
        </div>

        <?php include("includes/header.php"); ?>
        <div class="back_re">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2>Forget Password</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <center>
            <div style="position: relative;">
                <img class="first-slide" id="banner" src="assets/images/image2.jpg" alt="First slide">
                <div class="col-md-5" id="forget" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div class="col-md-12">
                <?php
                        if(isset($_SESSION['status'])) {
                            if($_SESSION['status'] == 1){                        
                                ?>
                                <label class="alert alert-success" id="alert" style="width:100%;">We have e-mailed your password reset link!</label>
                                <?php 
                            } else if($_SESSION['status'] == 2){
                                ?>
                                <label class="alert alert-warning" style="width:100%">Email id not exist!</label>
                                <?php
                            }
                        }
                    ?>
                </div>
                    <div class="book_room">
                        <form class="book_now" action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Email :</span> 
                                    <input class="online_book" placeholder="abc@gmail.com" type="email" required name="email" id="email">
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <button class="book_btn" name="studentform" id="studentform">Reset Password</button>
                                </div>                                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </center>

        <?php include("includes/footer.php"); ?>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery-3.0.0.min.js"></script>
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/js/custom.js"></script>
        
    </body>

</html>