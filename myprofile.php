<?php 
    include("includes/dbconfig.php"); 
?>
<?php    
    if(isset($_SESSION['user'])){
            $id = $_SESSION['user_id'];
            
            $current_date = date('Y-m-d H:i:s');

            $query1 = "SELECT * FROM students WHERE id = :id";
            $statement1 = $conn->prepare($query1);
            $statement1->bindParam(':id', $id, PDO::PARAM_INT);
            $statement1->execute();
            $student = $statement1->fetch(PDO::FETCH_ASSOC);
            // print_r($student);
            if(isset($_POST['fee'])) {
                $query = "UPDATE students SET logindate = :current_date WHERE id = :id";
                $statement = $conn->prepare($query);
                $statement->bindParam(':current_date', $current_date, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();

                $_SESSION['name'] = $student['fullname'];
                $_SESSION['email'] = $student['email'];
                if($student['mess']=='yes'){
                    header("Location: messfee.php");
                } else {
                    header("Location: fee.php");
                }    
                exit;
            }

            $lastPaymentDate = strtotime($student['logindate']); 
            $currentDate = strtotime(date('Y-m-d H:i:s'));
            $oneMonthAgo = strtotime('-30 seconds', $currentDate);
            
            if ($lastPaymentDate <= $oneMonthAgo || empty($student['amount'])) {
                // It's been a month since the last payment, set a session variable to show the alert
                $showPayFeeButton = true;
            } else {
                $showPayFeeButton = false;
            }

            $query1 = "SELECT * FROM news order by id desc";
            $statement1 = $conn->prepare($query1);
            $statement1->execute();
            $statement1->setFetchMode(PDO::FETCH_OBJ);
            $newsresult = $statement1->fetchAll();

            $_SESSION['name'] = $student['fullname'];
            $_SESSION['email'] = $student['email'];
            $_SESSION['user'] = "student";
            $_SESSION['user_id'] = $id;
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
        <link rel="stylesheet" href="assets/css/style.css?v=1">
        <link rel="stylesheet" href="assets/css/responsive.css?v=1">
        <link rel="icon" type="image/x-icon" href="assets/images/hostel.png">
        <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

        <style>
            .registration-form {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .registration-form h2 {
                text-align: center;
            }

            .both {
                display:flex;
                align-items: center;
                justify-content: center;
            }

            .form-group input, textarea {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .form-group button {
                background-color: #000;
                color: #fff;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                width: 100%;
            }

            .form-group button:hover {
                background-color: #fe0000;
            }

            .book_room {
                width:500px;
            }

            @media (max-width: 1527px) {
                .registration-form {
                    width: 500px;
                }
            }

            @media (max-width: 1300px) {
                .registration-form {
                    width: 400px;
                }
            }

            @media (max-width: 1060px) {
                .registration-form {
                    width: 300px;
                }
            }

            @media (max-width: 700px) {
                .registration-form {
                    width: 500px;
                }
                .both {
                    flex-direction: column;
                }
            }

            @media (max-width: 500px) {
                #register {
                    display: block;
                    width: 100%;
                    height: 27px;
                    margin-top: -67px;
                    margin-left: -61px;
                    padding-top: 0px;
                }

                .registration-form {
                    width: 300px;
                }

                .book_room {
                    width:100%;
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
                        <div class="title" style="display:flex; justify-content: center;">
                            <h2>My Profile</h2>
                            <a href="tracking.php" style="padding: 50px" name="track"><img src="assets/images/camera.png" width="50px" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            if(isset($_SESSION['status'])) {
                if($_SESSION['status'] == 11){
                    ?>
                        <label class="alert alert-success" style="width:100%">Fees updated successfully!</label>
                    <?php
                }if($_SESSION['status'] == 22){
                    ?>
                        <label class="alert alert-warning" style="width:100%">Something went wrong!</label>
                    <?php
                }if($_SESSION['status'] == 33){
                    ?>
                        <label class="alert alert-warning" style="width:100%">Entry / Exit Successfully!</label>
                    <?php
                }else{
                                    
                }                                
                $_SESSION['status'] = "";
            }
        ?>

        <div class="both">                        
            <div class="col-md-5">
                <div class="book_room" id="news" style="margin-bottom: 20px; margin-top: 20px;">
                    <h1>News & Update</h1>
                    <marquee id="newsMarquee" class="marque" behavior="scroll" direction="up" scrollamount="5" style="overflow: hidden; height: 330px;">
                        <?php
                            if($newsresult){
                                foreach($newsresult as $row){
                                    ?>
                                        <h2><?=$row->title?></h2>
                                        <img src="assets/images/new.gif">
                                        <p><?=$row->description?></p>
                                        <a href="<?=$row->pdf_file?>" target="_blank">Download PDF</a>
                                        <br><br>
                                    <?php  
                                } 
                            }
                        ?>                                                    
                    </marquee>
                </div>
            </div>

            <div class="about">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <tr><th>Full name</th><td><?=$student['fullname']?></td></tr>
                                    <tr><th>Phone</th><td><?=$student['phone']?></td></tr>
                                    <tr><th>DOB</th><td><?=$student['dob']?></td></tr>
                                    <tr><th>Gender</th><td><?=$student['gender']?></td></tr>
                                    <tr><th>Caste</th><td><?=$student['caste']?></td></tr>
                                    <tr><th>Percentage</th><td><?=$student['percent']?></td></tr>
                                    <tr><th>Branch</th><td><?=$student['branch']?></td></tr>
                                    <tr><th>Year</th><td><?=$student['year']?></td></tr>
                                    <tr><th>Address</th><td><?=$student['address']?></td></tr>
                                    <tr><th>Email</th><td><?=$student['email']?></td></tr>
                                    <tr><th>Applied Mess</th><td><?=$student['mess']?></td></tr>
                                    <tr><th>Amount</th><td><?=$student['amount']?></td></tr>
                                </tr>
                            </table>
                            <?php if($showPayFeeButton): ?>
                                <form id="fee" method="post">
                                    <div class="form-group">
                                        <button type="submit" name="fee" id="payFeeButton">Pay fee</button>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include("includes/footer.php"); ?>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery-3.0.0.min.js"></script>
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var newsMarquee = document.getElementById('newsMarquee');

                function pauseMarquee() {
                newsMarquee.stop();
                }

                function resumeMarquee() {
                newsMarquee.start();
                }

                document.getElementById('news').addEventListener('mouseover', pauseMarquee);
                document.getElementById('news').addEventListener('mouseout', resumeMarquee);
            });

            document.addEventListener("DOMContentLoaded", function () {
                <?php if($showPayFeeButton): ?>
                    alert("Pay fee for mess");
                <?php endif; ?>
            });

        </script>
    </body>
</html>