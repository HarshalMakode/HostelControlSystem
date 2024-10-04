<header>
    <style>
        @media (max-width: 700px) {
            .GP-logo {
                display: none;
            }
        }
    </style>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <a href="index.php"><img src="assets/images/msbte.gif" alt="#"
                                        style="margin-top: -16px; height: 100px;" /></a>
                            </div>
                            <div class="collage_name">
                                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="heading">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="BigFont2" height="32">Government Polytechnic Arvi </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="heading">Approved by AICTE, Recognised by DTE &amp; Affiliated to
                                                MSBTE </td>
                                        </tr>
                                        <tr>
                                            <td class="smallBlack"><strong>e-mail :
                                                    principal.gparvi@dtemaharashtra.gov.in<br>
                                                    office.gparvi@dtemaharashtra.gov.in</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <?php
                            
                            if(isset($_SESSION['user'])){ 
                                if($_SESSION['user'] == "student"){
                                    ?>
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item"><a class="nav-link" href="myprofile.php">My Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" href="myhelp.php">Help & Support</a></li>
                                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                                    </ul>
                                    <?php
                                }else if($_SESSION['user'] == "faculty"){
                                    ?>
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item"><a class="nav-link" href="students.php">Students</a></li>
                                        <li class="nav-item"><a class="nav-link" href="final-students.php">List</a></li>
                                        <li class="nav-item"><a class="nav-link" href="mysupport.php">Help & support</a></li>
                                        <li class="nav-item"><a class="nav-link" href="news.php">News & Updates</a></li>
                                        <li class="nav-item"><a class="nav-link" href="faculty-gallery.php">Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                                    </ul>
                                    <?php
                                }else{
                                    ?>
                                    <ul class="navbar-nav mr-auto">
                                        
                                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                                    </ul>
                                    <?php
                                }
                            }else{
                                ?>
                                <ul class="navbar-nav mr-auto">
                                    <div class="GP-logo">
                                        <a href="index.php"><img src="assets/images/gparvilogo.jpg" alt="#"
                                                style="height: 100px;margin-right:50px;margin-top:-30px;" />
                                        </a>
                                    </div>
                                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                                </ul>
                                <?php
                            }
                            ?>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>