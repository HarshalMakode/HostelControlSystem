<?php include("includes/dbconfig.php"); ?>
<?php
$student_id = NULL;
if(isset($_SESSION['user'])){
    $student_id = $_SESSION['user_id'];
}

if(isset($_POST['message']))
{
    $message = $_POST['message'];

    $query = "INSERT INTO support (student_id, message) VALUES (:student_id, :message)";
    $query_run = $conn->prepare($query);
    $data = [
        ':student_id' => $student_id,
        ':message' => $message
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

if(isset($_POST['deleteid']))
{
    $deleteid = $_POST['deleteid'];

    $query = "delete from support where id=:id";
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

$query1 = "SELECT * FROM support where student_id=".$student_id." order by id desc";
$statement1 = $conn->prepare($query1);
$statement1->execute();
$statement1->setFetchMode(PDO::FETCH_OBJ);
$supports = $statement1->fetchAll();
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
                        <h2>Help & Support</h2>
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
                            <label class="alert alert-success" style="width:100%">Help Added succefully!</label>
                            <?php
                        }else if($_SESSION['status'] == 1){
                            ?>
                            <label class="alert alert-warning" style="width:100%">Form not submitted</label>
                            <?php
                        }else if($_SESSION['status'] == 11){
                            ?>
                            <label class="alert alert-danger" style="width:100%">Help deleted successfully!</label>
                            <?php
                        }
                        
                        $_SESSION['status'] = "";
                    }
                    ?>
                </div>
                <div class="col-md-5">
                    <h3>Send Help</h3>
                    <form id="request" action="" method="post" class="main_form">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" required type="text" name="message"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="send_btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                <h3>Help List</h3>
                <table class="table">
                        <tr><th>Message</th><th>Reply</th><th>Action</th></tr>
                    <?php
                    if($supports)
                    {
                        foreach($supports as $row)
                        {
                    ?>
                    <tr><th><?=$row->message?></th><th><?=$row->reply?></th>
                    <th>
                        <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" value="<?=$row->id?>" name="deleteid"/>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </th></tr>
                    <?php  
                        } 
                    }?>
                    </table>
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