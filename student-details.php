<?php include("includes/dbconfig.php"); ?>
<?php
$student = NULL;
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $query1 = "SELECT * FROM students WHERE id = :id";
    $statement1 = $conn->prepare($query1);
    $statement1->bindParam(':id', $id, PDO::PARAM_INT);
    $statement1->execute();
    $student = $statement1->fetch(PDO::FETCH_ASSOC);
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

        .form-group input,
        textarea {
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
                        <h2>Student Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="registration-form">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><br>
                                    <label for="passport">Passport Photo:</label><br>
                                    <img src="<?=$student['passport']?>" alt="Image of the student" width="100px" style="margin-bottom: 10px">
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="fullname">Full Name:</label>
                                    <input type="text" id="fullname" name="fullname" value="<?=$student['fullname']?>" readonly>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="mbno">Mobile No:</label>
                                    <input type="number" id="mbno" name="phone" value="<?=$student['phone']?>" readonly>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="dob">Date of Birth:</label>
                                    <input type="date" id="dob" name="dob" value="<?=$student['dob']?>" readonly>
                                </div>
                                <div class="col-md-6"><br>
                                    <label>Gender:</label><br>
                                    <label><input type="radio" name="gender" <?php if($student['gender'] == "male"){ echo "checked"; } ?> value="male" disabled> Male</label>
                                    <label><input type="radio" name="gender" <?php if($student['gender'] == "female"){ echo "checked"; } ?> value="female" disabled> Female</label>
                                </div>
                                <div class="col-md-6"><br>
                                    <label>Physically challenged:</label><br>
                                    <label><input type="radio" name="disability" value="Yes" <?php if($student['disability'] == "Yes"){ echo "checked"; } ?> disabled required>Yes</label>
                                    <label><input type="radio" name="disability" value="No" <?php if($student['disability'] == "No"){ echo "checked"; } ?> disabled required>No</label>
                                </div>
                                <div class="col-md-6"><br>
                                    <label>Caste:</label><br>
                                    
                                    <select id="caste" name="caste" readonly disabled>
                                        <option value="<?=$student['caste']?>"><?=$student['caste']?></option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="percent">Percentage:</label>
                                    <input type="text" id="percent" name="percent" value="<?=$student['percent']?>" readonly>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="branch">Branch:</label>
                                    <select id="branch" name="branch" class="" readonly disabled>
                                        <option value="<?=$student['branch']?>"><?=$student['branch']?></option>
                                        <option value="CE">CE</option>
                                        <option value="ME">ME</option>
                                        <option value="EE">EE</option>
                                        <option value="EXTC">EXTC</option>
                                    </select>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="year">Year:</label>
                                    <input type="text" id="year" name="year" value="<?=$student['year']?>" readonly>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="address">Permanent address:</label>
                                    <textarea id="address" name="address" rows="4" readonly><?=$student['address']?></textarea>
                                </div>
                                <div class="col-md-6"><br>
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" value="<?=$student['email']?>" name="email" readonly>
                                </div>
                                <div class="col-md-6"><br>
                                    <span style="display:inline;">Apply for mess :</span><br>
                                    <label> <input type="radio" name="mess" id="yes" disabled <?php if($student['mess'] == 'yes'){ ?> checked <?php } ?>  value="yes"> Yes </label> 
                                    <label> <input type="radio" name="mess" id="no" disabled <?php if($student['mess'] == 'no'){ ?> checked <?php } ?> value="no"> No </label>
                                </div>
                                <div class="col-md-6"><br>
                                    <span style="display:inline;">Total amount:</span>
                                    <input class="online_book" type="text" id="totalAmount" name="amount" value="<?=$student['amount']?>" readonly>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- end about -->

    <!-- footer -->
    <?php include("includes/footer.php"); ?>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>