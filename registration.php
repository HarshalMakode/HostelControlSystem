<?php 
    include("includes/dbconfig.php"); 
?>
<?php
    if(isset($_POST['fullname'])) {
        // Check if file sizes exceed the limit
        if ($_FILES['passport']['size'] > 5 * 1024 * 1024 || $_FILES['marksheet']['size'] > 5 * 1024 * 1024 || $_FILES['sign']['size'] > 5 * 1024 * 1024) {
            $_SESSION['status'] = 5; // Set status for file size exceeded
        } else {
            // Check if file formats are allowed
            $passportFileType = strtolower(pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION));
            $marksheetFileType = strtolower(pathinfo($_FILES['marksheet']['name'], PATHINFO_EXTENSION));
            $signFileType = strtolower(pathinfo($_FILES['sign']['name'], PATHINFO_EXTENSION));
            $allowedFormats = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // Allowed file formats
            if (!in_array($passportFileType, $allowedFormats) || !in_array($marksheetFileType, $allowedFormats) || !in_array($signFileType, $allowedFormats)) {
                $_SESSION['status'] = 6; // Set status for invalid file format
            } else {
                // Proceed with form submission
                $fullname = $_POST['fullname'];

                // Upload passport photo
                $passportname = $_FILES['passport']['name'];
                $passporttemp = $_FILES['passport']['tmp_name'];
                $folder = "Image/".$passportname;
                move_uploaded_file($passporttemp,$folder);

                // Upload marksheet
                $marksheetname = $_FILES['marksheet']['name'];
                $marksheettemp = $_FILES['marksheet']['tmp_name'];
                $folder1 = "Marksheet/".$marksheetname;
                move_uploaded_file($marksheettemp,$folder1);

                $signname = $_FILES['sign']['name'];
                $signtemp = $_FILES['sign']['tmp_name'];
                $folder2 = "Signature/".$signname;
                move_uploaded_file($signtemp,$folder2);

                // Retrieve other form data
                $phone = $_POST['phone'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $disability = $_POST['disability'];
                $caste = $_POST['caste'];
                $percent = $_POST['percent'];
                $branch = $_POST['branch'];
                $year = $_POST['year'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                // Check if passwords match
                if ($password !== $confirmPassword) {
                    $_SESSION['status'] = 3;
                } else {
                    // Check if email already exists
                    $query = "SELECT * FROM students where email='$email'";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $resultexist = $statement->fetchAll();
                    
                    if($resultexist){
                        $_SESSION['status'] = 2; // Set status for existing email
                    } else {
                        // Validate OTP
                        if (isset($_POST['otp'])) {
                            $enteredOtp = $_POST['otp'];
                            if ($enteredOtp == $_SESSION['registration_otp']) {
                                unset($_SESSION['registration_otp']);
                                // Insert student data into the database
                                $logindate = date('Y-m-d');
                                $query = "INSERT INTO students (passport, sign, fullname, phone, dob, gender, disability, caste, percent, marksheet, branch, year, address, email, password, status,logindate) VALUES (:folder, :folder2, :fullname, :phone, :dob, :gender, :disability, :caste, :percent, :folder1, :branch, :year, :address, :email, :password,:status,:logindate)";
                                $query_run = $conn->prepare($query);
                                $data = [
                                    ':folder' => $folder,
                                    ':folder2' => $folder2,
                                    ':fullname' => $fullname,
                                    ':phone' => $phone,
                                    ':dob' => $dob,
                                    ':gender' => $gender,
                                    ':disability' => $disability,
                                    ':caste' => $caste,
                                    ':percent' => $percent,
                                    ':folder1' => $folder1,
                                    ':branch' => $branch,
                                    ':year' => $year,
                                    ':address' => $address,
                                    ':email' => $email,
                                    ':password' => $password,
                                    ':status' => 0,
                                    ':logindate' => $logindate
                                ];
                                $query_execute = $query_run->execute($data);

                                if($query_execute) {
                                    $_SESSION['status'] = 1; // Set status for successful registration
                                }
                                else {
                                    $_SESSION['status'] = 0; // Set status for database error
                                }
                            } else {
                                $_SESSION['status'] = 4; // Set status for incorrect OTP
                            }
                        }
                    }
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
                .GP-logo {
                    display: none;
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
                            <h2>Registration</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <?php
                        if (isset($_SESSION['status'])) {
                            switch ($_SESSION['status']) {
                                case 1:
                                    echo '<label class="alert alert-success" style="width:100%">New student inserted successfully!</label>';
                                    break;
                                case 2:
                                    echo '<label class="alert alert-warning" style="width:100%">Student email ID already exists!</label>';
                                    break;
                                case 3:
                                    echo '<label class="alert alert-warning" style="width:100%">Password and Confirm Password do not match!</label>';
                                    break;
                                case 4:
                                    echo '<label class="alert alert-danger" style="width:100%">OTP incorrect</label>';
                                    break;
                                case 5:
                                    echo '<label class="alert alert-danger" style="width:100%">File size exceeded!</label>';
                                    break;
                                case 6:
                                    echo '<label class="alert alert-danger" style="width:100%">Invalid file format!</label>';
                                    break;
                                case 0:
                                    echo '<label class="alert alert-danger" style="width:100%">Form not submitted</label>';
                                    break;
                                default:
                                    break;
                            }
                            $_SESSION['status'] = ""; // Reset status after displaying
                        }
                        ?>

                    </div>
                    <div class="col-md-7">
                        <div class="registration-form">
                            <h2>Student Registration Form</h2>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6"><br>
                                        <label for="passport">Passport Photo:</label>
                                        <br><p style="color:red">Image size less than 5mb</p>
                                        <input type="file" id="passport" name="passport" required accept="image/*">
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="sign">Signature:</label>
                                        <br><p style="color:red">Image size less than 5mb</p>
                                        <input type="file" id="sign" name="sign" required accept="image/*">
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="fullname">Full Name:</label>
                                        <input type="text" id="fullname" name="fullname" pattern="[A-Za-z\s]+" required>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="mbno">Mobile No:</label>
                                        <input type="tel" id="mbno" name="phone" pattern="[0-9]{10}" minlength="10" maxlength="10" oninput="validateMobileNumber(this)" required>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" id="dob" name="dob" max="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label>Gender:</label><br>
                                        <label><input type="radio" name="gender" value="male" required> Male</label>
                                        <label><input type="radio" name="gender" value="female" required> Female</label>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label>Physically challenged:</label><br>
                                        <label><input type="radio" name="disability" value="Yes" required>Yes</label>
                                        <label><input type="radio" name="disability" value="No" required>No</label>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label>Caste:</label><br>
                                        <select id="caste" name="caste" required>
                                            <option value="Genral">Genral</option>
                                            <option value="OBC">OBC</option>
                                            <option value="EWS">EWS</option>
                                            <option value="SC">SC</option>
                                            <option value="ST">ST</option>
                                            <option value="NT">NT</option>
                                            <option value="VJNT">VJNT</option>
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="percent">Percentage:</label>
                                        <input type="text" id="percent" name="percent" oninput="validateMobileNumber(this)" pattern="[0-9]{2}" minlength="2" maxlength="2" required>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="marksheet">Marksheet:</label>
                                        <br><p style="color:red">pdf size less than 5mb</p>
                                        <input type="file" id="marksheet" name="marksheet" required accept=".pdf">
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="branch">Branch:</label>
                                        <select id="branch" name="branch" class="" required>
                                            <option value="CH">CH</option>
                                            <option value="CE">CE</option>
                                            <option value="CO">CO</option>
                                            <option value="EE">EE</option>
                                            <option value="ET">ET</option>
                                            <option value="ME">ME</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="year">Year:</label>
                                        <select id="year" name="year" required>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="address">Permanent address:</label>
                                        <textarea id="address" name="address" rows="4" required></textarea>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" required style="margin-bottom: 10px;">
                                        <input type="text" id="otp" name="otp" required style="margin-bottom: 10px;" placeholder='Enter your otp' oninput="validateMobileNumber(this)" pattern="[0-9]{6}" minlength="6" maxlength="6">
                                        <button type="button" id="sendOtpBtn" name="send">Send OTP</button>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" oninput="checkPasswordStrength(this.value)" minlength="8" maxlength="8" required>
                                        <div id="password-strength"></div>
                                        <label for="password"><input type="checkbox" id="showPassword" onchange="togglePassword()"> Show Password</label>
                                    </div>

                                    <div class="col-md-6"><br>
                                        <label for="confirmPassword">Confirm Password:</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" required minlength="8" maxlength="8">
                                    </div>
                                
                                </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="about_img">
                            <figure>
                                <img src="assets/images/image1.jpg" alt="#" id="imgg" />
                            </figure>
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
        <script>
            function validateMobileNumber(input) {
                input.value = input.value.replace(/\D/g, '');
            }
            document.getElementById('sendOtpBtn').addEventListener('click', function (event) {
                event.preventDefault(); 

                var email = document.getElementById('email').value;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_otp.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            alert('OTP Sent Successfully');
                        } else {
                            alert('Error: Unable to send OTP');
                        }
                    }
                };

                xhr.send('email=' + encodeURIComponent(email));
            });
            function togglePassword() {
                var passwordInput = document.getElementById('password');
                var confirmPasswordInput = document.getElementById('confirmPassword');
                var passwordIcon = document.getElementById('password-icon');
                var showPasswordCheckbox = document.getElementById('showPassword');

                if (showPasswordCheckbox.checked) {
                    passwordInput.type = 'text';
                    confirmPasswordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                    confirmPasswordInput.type = 'password';
                }
            }

        </script>

    </body>
</html>