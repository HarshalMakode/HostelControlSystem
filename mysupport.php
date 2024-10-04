<?php include("includes/dbconfig.php"); ?>
<?php
if(isset($_POST['replyid']))
{
    $replyid = $_POST['replyid'];
    $reply = $_POST['reply'];

    $query = "update support set reply=:reply where id=:replyid";
    $query_run = $conn->prepare($query);
    $data = [
        ':replyid' => $replyid,
        ':reply' => $reply
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

$query1 = "SELECT * FROM support order by id desc";
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
                            <label class="alert alert-success" style="width:100%">Reply submitted succefully!</label>
                            <?php
                        }else if($_SESSION['status'] == 1){
                            ?>
                            <label class="alert alert-warning" style="width:100%">Form not submitted</label>
                            <?php
                        }else if($_SESSION['status'] == 11){
                            ?>
                            <label class="alert alert-warning" style="width:100%">Help Deleted Successfully!</label>
                            <?php
                        }
                        
                        $_SESSION['status'] = "";
                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <tr><th>Student name</th><th>Message</th><th>Reply</th><th>Action</th></tr>
                    <?php
                    if($supports)
                    {
                        foreach($supports as $row)
                        {
                            $id = $row->student_id;
                            $query1 = "SELECT * FROM students WHERE id = :id";
                            $statement1 = $conn->prepare($query1);
                            $statement1->bindParam(':id', $id, PDO::PARAM_INT);
                            $statement1->execute();
                            $student = $statement1->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr><th><?=$student['fullname']?></th><th><?=$row->message?></th>
                    <th>
                        <form action="" method="POST" style="width:100%" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" value="<?=$row->id?>" name="replyid"/>
                            <textarea rows="2" name="reply" style="width:100%" disable><?=$row->reply?></textarea>
                            <input type="submit" name="submit" value="Submit" class="btn btn-sm btn-success" />
                        </form>
                    </th>
                    <th>
                        <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" value="<?=$row->id?>" name="deleteid"/>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </th></tr>
                    <?php  } }?>
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