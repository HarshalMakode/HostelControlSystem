<?php include("includes/dbconfig.php"); ?>
<?php
if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
    $query_run = $conn->prepare($query);
    $data = [
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':message' => $message,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['status'] = 1;
    }
    else
    {
        $_SESSION['status'] = 0;
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
    <link rel="stylesheet" href="assets/css/style.css?v=1">
    <link rel="stylesheet" href="assets/css/responsive.css?v=1">
    <link rel="icon" type="image/x-icon" href="assets/images/hostel.png">
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
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
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php
                    if(isset($_SESSION['status']))
                    {
                        if($_SESSION['status'] == 1){
                            ?>
                            <label class="alert alert-success" style="width:100%">Contact form submitted succefully!</label>
                            <?php
                        }else if($_SESSION['status'] == 1){
                            ?>
                            <label class="alert alert-warning" style="width:100%">Form not submitted</label>
                            <?php
                        }else{
                            
                        }
                        
                        $_SESSION['status'] = "";
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    
                    <form id="request" action="" method="post" class="main_form">
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="text" required name="name">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="text" required name="email">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="text" required name="phone">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" required type="text" name="message"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="send_btn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="map_main">
                        <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.043414570878!2d78.27603397525994!3d21.150670480529396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4142122409909%3A0x36a626cf8fd26a02!2sGovernment%20Polytechnic%20%2C%20Arvi!5e0!3m2!1sen!2sin!4v1707637743513!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="jassets/s/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>