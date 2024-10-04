<?php include("includes/dbconfig.php"); ?>

<?php

$query1 = "SELECT * FROM gallery order by id desc";
$statement1 = $conn->prepare($query1);
$statement1->execute();
$statement1->setFetchMode(PDO::FETCH_OBJ);
$gallery = $statement1->fetchAll();

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
        @media (max-width:500px) {
            #myModal {
                width: 100%;
                height: 50px;
            }
        }
    </style>
</head>

<body class="main-layout inner_page" style="overflow-x: hidden;">
    <div class="loader_bg">
        <div class="loader"><img src="assets/images/loading.gif" alt="#" /></div>
    </div>
    <?php include("includes/header.php"); ?>
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Gallery</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery">
        <div class="container">

            <div class="row">
                <!-- <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image1.jpg"
                                onclick="openModal('assets/images/large-image1.jpg')" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image2.jpg"
                                onclick="openModal('assets/images/large-image2.jpg')" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image3.jpg"
                                onclick="openModal('assets/images/large-image3.jpg')" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image4.jpg"
                                onclick="openModal('assets/images/large-image4.jpg')" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image5.jpg"
                                onclick="openModal('assets/images/large-image5.jpg')" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image6.jpg"
                                onclick="openModal('assets/images/large-image6.jpg')" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="assets/images/image7.jpg"
                                onclick="openModal('assets/images/large-image7.jpg')" alt="#" /></figure>
                    </div>
                </div>
                 -->
                <?php
                    if($gallery) {
                        foreach($gallery as $row) {
                ?>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="uploads/<?=$row->filename?>" onclick="openModal('uploads/<?=$row->filename?>')" alt="#" /></figure>
                    </div>
                </div>
                <?php  } }?>
            </div>
            <div id="myModal" class="modal">
                <span onclick="closeModal()" class="close" style="margin-top:210px;">&times;</span>
                <img class="modal-content" id="modalImage" style="width:1185px; height:464px; margin:212px 0 0 154px ;">
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
        function openModal(imageSource) {
            var modal = document.getElementById("myModal");
            var modalImage = document.getElementById("modalImage");

            modal.style.display = "flex";
            modalImage.src = imageSource;
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
</body>

</html>