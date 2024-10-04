<?php include("includes/dbconfig.php"); ?>
<?php
if(isset($_POST['password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        $_SESSION['status'] = 3;
    } else {
        if($_GET['secret']){
            $email = base64_decode($_GET['secret']);

            $query = "UPDATE students SET password = :password where email = :email";
            $query_run = $conn->prepare($query);
            $query_run->bindParam(':password', $password);
            $query_run->bindParam(':email', $email);
            $query_run->execute();

            if ($query_run->rowCount() > 0) {
                $_SESSION['status'] = 2;
            } else {
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
                height: 800px;
            }
            
        </style>    
    </head>

    <body class="main-layout" style="overflow-x: hidden;">

        <div class="loader_bg">
            <div class="loader">
                <img src="assets/images/loading.gif" alt="#" />
            </div>
        </div>

        <div class="back_re">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2>Reset Password</h2>
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
                            if($_SESSION['status'] == 3){                        
                                ?>
                                <label class="alert alert-warning" style="width:100%">Password and Confirm Password do not match!</label>
                                <?php 
                            } elseif($_SESSION['status'] == 2) {
                                ?>
                                <label class="alert alert-success" style="width:100%">Password updated successfully!</label>
                                <?php
                            } elseif($_SESSION['status'] == 1) {
                                ?>
                                <label class="alert alert-danger" style="width:100%">Failed to update password!</label>
                                <?php
                            }
                        }
                    ?>
                </div>
                    <div class="book_room">
                        <form class="book_now" action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Reset Password :</span> 
                                    <input class="online_book" type="password" required name="password" id="password" oninput="checkPasswordStrength(this.value)">
                                    <div id="password-strength"></div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <span>Confirm Password :</span> 
                                    <input class="online_book" type="password" required name="confirmPassword" id="confirmPassword">
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

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery-3.0.0.min.js"></script>
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/js/custom.js"></script>

        <style>
            #password-strength {
                font-weight: bold;
                margin-top: 5px;
            }

            .weak {
                color: red;
            }

            .fair {
                color: black;
            }

            .moderate {
                color: orange;
            }

            .strong {
                color: blue;
            }

            .very-strong {
                color: green;
            }
        </style>

        <script>
            document.getElementById('password').addEventListener('input', function () {
                checkPasswordStrength(this.value);
            });

            function checkPasswordStrength(password) {
                let strength = 0;

                if (password.length >= 8) {
                    strength += 1;
                }

                if (/\d/.test(password)) {
                    strength += 1;
                }

                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) {
                    strength += 1;
                }

                if (/[\W_]/.test(password)) {
                    strength += 1;
                }

                let strengthIndicator = document.getElementById('password-strength');
                switch (strength) {
                    case 0:
                        strengthIndicator.innerHTML = 'Password Strength: Weak';
                        strengthIndicator.className = 'weak';
                        break;
                    case 1:
                        strengthIndicator.innerHTML = 'Password Strength: Fair';
                        strengthIndicator.className = 'fair';
                        break;
                    case 2:
                        strengthIndicator.innerHTML = 'Password Strength: Moderate';
                        strengthIndicator.className = 'moderate';
                        break;
                    case 3:
                        strengthIndicator.innerHTML = 'Password Strength: Strong';
                        strengthIndicator.className = 'strong';
                        break;
                    case 4:
                        strengthIndicator.innerHTML = 'Password Strength: Very Strong';
                        strengthIndicator.className = 'very-strong';
                        break;
                    default:
                        strengthIndicator.innerHTML = '';
                }
            }
        </script>

        
    </body>

</html>