<?php 
    include("includes/dbconfig.php"); 
?>
<?php
    $name = $_SESSION['name'] ?? '';
    $email = $_SESSION['email'] ?? '';

    if(isset($_POST['proceed'])) {
        $mess = $_POST['mess'];
        $amount = $_POST['amount'];

        $sid = 0;
        if(isset($_SESSION['user'])){
            $sid = $_SESSION['user_id'];
        }

        // Update the amount in the database
        $query = "UPDATE students SET amount = amount + :amount WHERE id = :sid";
        $query_run = $conn->prepare($query);
        $data = [
            ':amount' => $amount,
            ':sid' => $sid
        ];
        $query_execute = $query_run->execute($data);

        if($query_execute) {
            header("Location: myprofile.php");
            $_SESSION['status'] = 11;
        } else {
            header("Location: myprofile.php");
            $_SESSION['status'] = 22;
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
                        <div class="title">
                            <h2>Payment</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="both">
            <div class="about">
                <div class="container-fluid">
                    <div class="row">
                        <form class="book_now" method="POST" action="">
                            <div class="col-md-12">
                                <span style="display:inline;">Name : </span>
                                <input class="online_book" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <span style="display:inline;">Email :</span>
                                <input class="online_book" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <span style="display:inline;">Apply for mess :</span>
                                <label> <input type="radio" name="mess" id="yes" checked disabled value="yes"> Yes </label>
                            </div>
                            <div class="col-md-12">
                                <span style="display:inline;">Total amount:</span>
                                <input class="online_book" type="text" id="totalAmount" name="amount" value="1500" readonly>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="book_btn" name="proceed">Proceed</button>
                            </div>
                        </form>
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
   
    </body>
</html>