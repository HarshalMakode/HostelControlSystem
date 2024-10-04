<?php include("includes/dbconfig.php"); ?>
<?php
    if(isset($_POST['studentform']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM finalstudent where email='$email' and password='$password'";
        
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
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

    if(isset($_POST['deleteid']))
    {
        $deleteid = $_POST['deleteid'];
        $query = "delete from finalstudent where id=:id";
        $query_run = $conn->prepare($query);
        $data = [
            ':id' => $deleteid
        ];
        $query_execute = $query_run->execute($data);

        if($query_execute)
        {
            $_SESSION['status'] = 11;
        }
        else
        {
            $_SESSION['status'] = 0;
        }
    }

    $query1 = "SELECT * FROM finalstudent order by id desc";
    $statement1 = $conn->prepare($query1);
    $statement1->execute();
    $statement1->setFetchMode(PDO::FETCH_OBJ);
    $students = $statement1->fetchAll();
    if(isset($_POST["Import"])) {
        if(isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["size"] > 0) {
            $file = $_FILES["file"]["tmp_name"];
            $handle = fopen($file, "r");
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $sql = "INSERT INTO finalstudent (passport, sign, fullname, phone, dob, gender, disability, caste, percent, marksheet, branch, year, address, email, password, status, mess, amount, logindate) VALUES (:folder, :folder2, :fullname, :phone, :dob, :gender, :disability, :caste, :percent, :folder1, :branch, :year, :address, :email, :password,:status, :mess, :amount, :logindate)";
                $statement = $conn->prepare($sql);
                $statement->bindParam(':folder', $getData[1]);
                $statement->bindParam(':folder2', $getData[2]);
                $statement->bindParam(':fullname', $getData[3]);
                $statement->bindParam(':phone', $getData[4]);
                $dob = date('Y-m-d', strtotime($getData[5]));
                $statement->bindParam(':dob', $dob);
                $statement->bindParam(':gender', $getData[6]);
                $statement->bindParam(':disability', $getData[7]);
                $statement->bindParam(':caste', $getData[8]);
                $statement->bindParam(':percent', $getData[9]);
                $statement->bindParam(':folder1', $getData[10]);
                $statement->bindParam(':branch', $getData[11]);
                $statement->bindParam(':year', $getData[12]);
                $statement->bindParam(':address', $getData[13]);
                $statement->bindParam(':email', $getData[14]);
                $statement->bindParam(':password', $getData[15]);
                $statement->bindParam(':status', $getData[16]);
                $statement->bindParam(':mess', $getData[17]);
                $statement->bindParam(':amount', $getData[18]);
                $statement->bindParam(':logindate', $getData[19]);
                
                $result = $statement->execute();
                if(!$result) {
                    $_SESSION['import_status'] = "Error: Unable to import data.";
                    break;
                }
            }
            fclose($handle);  
            $_SESSION['import_status'] = "CSV File has been successfully Imported.";
            header("Location: final-students.php");
            exit;
        } else {
            echo "Invalid File: Please Upload CSV File.";
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
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="icon" type="image/x-icon" href="assets/images/hostel.png">
    <style>
        #facultyForm {
            display: none;
        }

        #news {
            margin-bottom: 20px;
            overflow-y: auto; 
        }

        #news th.percent-header:hover {
            cursor: pointer;
        }

        #news th.gender-header:hover {
            cursor: pointer;
        }

        .book_room {
            margin-bottom: 20px;
            max-height: 550px; 
            overflow-y: auto; 
        }

        @media (max-width: 760px) {

            #signin,
            #news {
                width: 50%;
                box-sizing: border-box;
                float: left;
                min-width: 320px;
            }

            .banner_main {
                overflow-x: auto;
            }

            .carousel-inner {
                overflow: hidden;
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
                height: 802px;
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
                        <h2>Final Students List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="banner_main">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" id="banner" src="assets/images/image2.jpg" alt="First slide"
                    style="width: 100%; height: 900px;">
                <div class="container"></div>
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
                                }else if($_SESSION['status'] == 11){
                                    ?>
                                    <label class="alert alert-danger" style="width:100%">Student deleted Successfully!</label>
                                    <?php
                                }
                                
                                $_SESSION['status'] = "";
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <form class="form-horizontal" action="" method="post" name="upload_excel" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" style="color: white; font-size: 20px;">Select File</label>
                                    <div class="col-md-4">
                                        <input type="file" name="file" id="file" class="input-large" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="" for="singlebutton" style="color: white; font-size: 20px;">Import data</label>
                                    <div class="col-md-4">
                                        <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>           
                    </div>
                    <div class="book_room" id="news" style="margin-bottom: 20px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Entry/Exit</th>
                                    <th>Passport</th>
                                    <th>Fullname</th>
                                    <th>Phone</th>
                                    <th class="gender-header">Gender</th>
                                    <th>Branch</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="studentTableBody">
                                <?php
                                    if($students) {
                                        foreach($students as $row) {
                                ?>
                                <tr class="student-row <?= strtolower($row->gender) ?>">
                                    <td style="font-size: 20px; font-weight: bold; color: <?= $row->status == 'yes' ? 'green' : 'red' ?>">
                                        <?=$row->status?>
                                    </td>
                                    <td><img src="<?=$row->passport?>" alt="Image of the student" width="100px" style="margin-bottom: 10px"></td>
                                    <td><?=$row->fullname?></td>
                                    <td><?=$row->phone?></td>
                                    <td class="gender-column"><?=$row->gender?></td>
                                    <td class="branch-column"><?=$row->branch?></td>
                                    <td class="year-column"><?=$row->year?></td>
                                    <td>
                                        <form action="" method="post">
                                            <a href="student-letter.php?id=<?=$row->id?>" class="btn btn-sm btn-warning">View Letter</a> 
                                            <a href="final-student-details.php?id=<?=$row->id?>" class="btn btn-sm btn-info">View Details</a> 
                                            <input type="hidden" value="<?=$row->id?>" name="deleteid"/>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php  } }?>
                            </tbody>
                        </table>
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
        $(document).ready(function() {
            // Function to sort the table when clicking on the "Percent" or "Gender" header
            $('#news th.percent-header, #news th.gender-header').click(function() {
                var table = $(this).parents('table').eq(0);
                var rows = table.find('tr:gt(0)').toArray().sort(compareRows($(this).index()));
                this.asc = !this.asc;
                if (!this.asc) {
                    rows = rows.reverse();
                }
                for (var i = 0; i < rows.length; i++) {
                    table.append(rows[i]);
                }
            });

            // Function to compare rows based on the specified column index
            function compareRows(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index);
                    var valB = getCellValue(b, index);
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
                };
            }

            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text();
            }
        });

    </script>

</body>

</html>