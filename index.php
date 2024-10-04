<?php include("includes/dbconfig.php"); ?>
<?php
if(isset($_POST['studentform']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students where email='$email' and password='$password'";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_OBJ);
    // print_r($result);
    if($result){
        $_SESSION['user'] = "student";
        $_SESSION['user_id'] = $result->id;
        $_SESSION['status'] = 1;
        header("Location: myprofile.php");
        exit;
    }else
    {
        $_SESSION['status'] = 0;
    }
}
if(isset($_POST['facultyform']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM faculty where email='$email' and password='$password'";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_OBJ);
    if($result){
        $_SESSION['user'] = "faculty";
        $_SESSION['user_id'] = $result->id;
        $_SESSION['status'] = 1;
        header("Location: students.php");
        exit;
    }else
    {
        $_SESSION['status'] = 0;
    }
}

$query1 = "SELECT * FROM news order by id desc";
$statement1 = $conn->prepare($query1);
$statement1->execute();
$statement1->setFetchMode(PDO::FETCH_OBJ);
$newsresult = $statement1->fetchAll();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="icon" type="image/x-icon" href="assets/images/hostel.png">
    <style>

        label {
            font-size:20px;
        }

        .book_now span {
            font-size: 20px;
        }

        #facultyForm {
            display: none;
        }

        .first-slide {
            width: 100%; 
            height: 600px;
        }

        @media (max-width: 760px) {
            .GP-logo {
                display: none;
            }

            .first-slide {
                height: 1050px;
            }

            #signin,
            #news {
                box-sizing: border-box;
                min-width: 320px;
            }

            .banner_main {
                overflow-x: auto;
                height: 500px;
            }

            .carousel-inner {
                overflow: hidden;
                height: 1050px;
            }

            .booking_online {

            }
        }

        @media only screen and (max-width: 600px) {
            body {
                overflow-x: hidden;
            }
        }

        @media (max-width : 500px) {
            #banner {
                display: block;
                width: 100%;
            }
        }

        @media (max-width : 500px) {
            #homeimg {
                display: block;
                width: 100%;
                height: 802px;
            }
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
                        <h2>Hostel Control System</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="banner_main">
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" id="banner1" src="assets/images/image2.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="first-slide" id="banner2" src="assets/images/image1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="first-slide" id="banner2" src="assets/images/image3.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="first-slide" id="banner2" src="assets/images/image4.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="first-slide" id="banner2" src="assets/images/image5.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="first-slide" id="banner2" src="assets/images/image6.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="first-slide" id="banner2" src="assets/images/image7.jpg" alt="First slide">
                </div>
                <div class="booking_online">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    if(isset($_SESSION['status']))
                                    {
                                        if($_SESSION['status'] == 1){
                                            ?>
                                            <label class="alert alert-success" style="width:100%">Login <?php if(isset($_SESSION['user'])){ echo $_SESSION['user']; } ?> successfully!</label>
                                            <?php
                                        }else if($_SESSION['status'] == 2){
                                            ?>
                                            <label class="alert alert-warning" style="width:100%"><?php if(isset($_SESSION['user'])){ echo $_SESSION['user']; } ?> email id already exist!</label>
                                            <?php
                                        }else if($_SESSION['status'] == 0){
                                            ?>
                                            <label class="alert alert-danger" style="width:100%">Email Id / Password invalid!</label>
                                            <?php
                                        }else{
                                            
                                        }
                                        
                                        $_SESSION['status'] = "";
                                    }
                                ?>
                            </div>
                            <div class="col-md-5">
                                <div class="book_room" id="news" style="margin-bottom: 20px;">
                                    <h1>News & Update</h1>
                                    <marquee id="newsMarquee" class="marque" behavior="scroll" direction="up" scrollamount="5" style="overflow: hidden; height: 330px;">
                                    <?php
                                        if($newsresult) {
                                            foreach($newsresult as $row)
                                        {
                                    ?>
                                    <h2><?=$row->title?></h2>
                                    <img src="assets/images/new.gif" width="30px">
                                    <h3><?=$row->description?></h3>
                                    <a href="<?=$row->pdf_file?>" target="_blank">Download PDF</a>
                                    <br><br>
                                    <?php  } }?>
                                    </marquee>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="book_room" id="signin">
                                    <h1>Sign In</h1>
                                    <label> <input type="radio" name="registrationType" id="studentRadio" checked> Student </label> 
                                    <label> <input type="radio" name="registrationType" id="facultyRadio"> Faculty </label>
                                    <form class="book_now" id="studentForm" action="" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span>Email :</span> 
                                                <input class="online_book" placeholder="abc@gmail.com" type="email" required name="email">
                                            </div>
                                            <br>
                                            <div class="col-md-12">
                                                <span>Password : </span>
                                                <input class="online_book" placeholder="********" type="password" required name="password" style="margin-bottom: 0px;">
                                                <div class="col-md-12" style="font-size:15px;">
                                                    <a href="forgetpassword.php" style="color: blue;">Forget Password? </a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="book_btn" name="studentform">Sign In</button>
                                            </div>
                                            <div class="col-md-12" style="text-align:center;font-size:20px;">
                                                <a href="registration.php" style="color: black;">Don't have account? Register here </a>
                                            </div>
                                        </div>
                                    </form>
                                    <form class="book_now" id="facultyForm" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span>Email :</span> 
                                                <input class="online_book" placeholder="abc@gmail.com" type="email" name="email">
                                            </div>
                                            <br>
                                            <div class="col-md-12">
                                                <span>Password : </span> 
                                                <input class="online_book" placeholder="********" type="password" name="password">
                                            </div>
                                            <div class="col-md-12">
                                                <button class="book_btn" name="facultyform">Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/footer.php"); ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        document.getElementById('facultyRadio').addEventListener('change', function () {
            document.getElementById('studentForm').style.display = 'none';
            document.getElementById('facultyForm').style.display = 'block';
        });

        document.getElementById('studentRadio').addEventListener('change', function () {
            document.getElementById('studentForm').style.display = 'block';
            document.getElementById('facultyForm').style.display = 'none';
        });

        $(document).ready(function () {
            $('#carouselExample').carousel({
                interval: 2000 
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var newsMarquee = document.getElementById('newsMarquee');

            // Function to pause the marquee
            function pauseMarquee() {
            newsMarquee.stop();
            }

            // Function to resume the marquee
            function resumeMarquee() {
            newsMarquee.start();
            }

            // Add event listeners for mouseover and mouseout
            document.getElementById('news').addEventListener('mouseover', pauseMarquee);
            document.getElementById('news').addEventListener('mouseout', resumeMarquee);
        });
    </script>

</body>

</html>