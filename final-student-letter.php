<?php include("includes/dbconfig.php"); ?>
<?php
$student = NULL;
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $query1 = "SELECT * FROM finalstudent WHERE id = :id";
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
        <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="icon" type="image/x-icon" href="assets/images/hostel.png">
    </head>

    <body>
        <a href="students.php" style="background-color:#000; font-size:30px; color:#fff">Back</a>
        <table style="margin:0px 300px" id="mainblock">
            <tr>
                <th style="display:inline-block; width:100%">
                <div style="width:20%; float:left;">
                    <img src="assets/images/msbte.gif" style="width:120px"/>
                </div>
                <div style="width:70%; float:left;">
                    <center><h1>शासकीय तंत्रनिकेतन, आर्वी</h1></center>
                    <center><h3>वसतीगृह विभाग</h3></center>
                </div>
                <hr style="height:10px; width:100%; background-color:#000">
                </th>
            </tr>
            <tr>
                <th>

                </th>
            </tr>
            <tr>
                <th style="display:inline-block; width:100%"><br>
                    <div style="width:70%; float:left;">
                        <table>
                            <tr>
                                <th align="left">
                                    1. विध्यार्थी / विद्यार्थिनीचे पूर्ण नाव : <?=$student['fullname']?><br><br>
                                </th>
                            </tr>
                            <tr>
                                <th align="left">
                                    2. जातीची वर्गवारी : <?=$student['caste']?><br><br>
                                </th>
                            </tr>
                            <tr>
                                <th align="left">3. इतर राखीव वर्गवारी - अपंग व  इतर : <?=$student['disability']?> <br><br>
                            </th>
                            </tr>
                            <tr>
                                <th align="left">
                                    4. संस्थेत कोणत्या वर्षाला व शाखेला प्रवेश घ्यावयाचा आहे : <?=$student['year']?> <?=$student['branch']?><br><br>
                                </th>
                            </tr>
                            <tr>
                                <th align="left">
                                    5.
                                </th>
                            </tr>
                        </table>
                    </div>
                    <?php if (!empty($student['passport'])): ?>
                        <div style="width:20%; float:left;">
                            <div style="border:1px solid #000">
                                <img src="<?=$student['passport']?>" alt="Image of the student" width="100px" height="150px">
                            </div>
                        </div>
                    <?php endif; ?>     
                </th>
            </tr>
            <tr>
                <th>
                    <table border="1">
                        <tr>
                            <td>अ.क.</td>
                            <td>प्रथम वर्षातील विदयार्थ्यांकरीता एसएससी ठक्केवारी</td>
                            <td>बेट द्वितीय वर्षातील विदयार्थ्यांकरीता एचाएससी आयटीआय व इतर टक्केवारी</td>
                            <td>द्वितीय वर्षातील विदयार्थ्यांकरीता प्रथम वर्षातील टक्केवारी</td>
                            <td>तृतिय वर्षातील विदयार्थ्यांकरीला द्वितीय वर्षात्तील टक्केवारी</td>
                        </tr>
                        <tr>
                            <td>
                                <br><br>
                            </td>
                            <td>
                                <br>
                                <?php if ($student['year'] == '1st'): ?>
                                    <?=$student['percent']?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <br><br>
                            </td>
                            <td>
                                <br>
                                <?php if ($student['year'] == '2nd'): ?>
                                    <?=$student['percent']?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <br>
                                <?php if ($student['year'] == '3rd'): ?>
                                    <?=$student['percent']?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <br>
                </th>
            </tr>
            <tr>
                <th>
                    <table>
                        <tr><th align="left">6. कायमचा पत्ता : <?=$student['address']?><br><br></th></tr>
                        <tr><th align="left">7. पालकाचे व विध्यार्थाचे भ्रमण ध्वनी क्रमांक : <?=$student['phone']?></th></tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th align="left"> 
                    <br><br>
                    प्रति,<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;प्राचार्य / वसतीगृह प्रमुख <br> <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;शासकीय तंत्रनिकेतन, आर्वी <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;मला वसतीगृहात प्रवेश देऊन उपकृत करावे, वरील माहिती खोटी आढळल्यास तसेच वसतिगृहाच्या नियमांचे माझ्याकडून उल्लंघन झाल्यास मी कार्यवाहीस पात्र राहील. <br><br><br>
                </th>
            </tr>
            <tr>
                <td>
                    <table style="width:100%">
                        <th align="left"> 
                            स्थळ: आर्वी<br><br>
                            दिनांक: <?php echo date("d/m/Y"); ?><br><br>
                        </th>
                        <th align="right"><br>
                            <?php if (!empty($student['sign'])): ?>
                                <div style="width:20%;">
                                    <div style="border:1px solid #000">
                                        <img src="<?=$student['sign']?>" alt="Sign of the student" width="100px" height="100px">
                                    </div>
                                </div>
                            <?php endif; ?><br>आपला विध्यार्थी / विद्यार्थिनी&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br><br>
                        </th>
                    </table>
                </td>
            </tr>
        </table>
        <br><br><br>
        <center><button onclick="printContent('mainblock')" class="btn btn-sm btn-warning">Print</button></center>
        <br><br>
        <table style="margin:0px 300px" id="subblock">
            <tr>
                <td>
                    <center><h1>हमीपत्र</h1></center>
                </td>
            </tr>
            <tr>
                <td align="left" style="line-height:50px"><br><br>
                    मी <?=$student['fullname']?> वर्ष <?=$student['year']?> शाखा <?=$student['branch']?> आपल्या  संस्थेत शिकत आहे. मी सध्या मुलांच्या वसतीगृहात प्रवेश घेत आहे. मी खालील प्रमाणे लिहून देतो की, मुलांच्या वसतीगृहात राहत असतांना माझ्या कडून वसतीगृहातील कोणत्याही शासन मालमत्तेचा अपव्यय, गैरवर्तणूक होणार नाही याची हमी देतो. तसेच मी साय. १०.०० वाजे नंतर परवानगी शिवाय वसतीगृहात अनुपस्थित राहणार नाही याची हमी देतो तसेच मी संस्थेतील अधिकारी / कर्मचारी व सुरक्षा रक्षक यांच्याशी सौजन्याने वागेन जर वरील बाबींचा माझ्या कडून उल्लंघन झाल्यास मी शिक्षेस पात्र राहील तसेच माझ्या वसतिगृहात प्रवेश रद्द केल्यास माझी काहीही हरकत राहणार नाही. 
                    <br><br><br>
                </td>
            </tr>

            <tr>
                <td style="display:inline-block; width:100%"><br>
                    <div style="width:60%; float:left;">
                        दिनांक: <?php echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                    </div>
                    <div style="width:20%; float:left;">
                        आपला विश्वासू <br><br><br><br><br>
                        सही :
                        <?php if (!empty($student['sign'])): ?>
                            <div style="width:20%;">
                                <div style="border:1px solid #000">
                                    <img src="<?=$student['sign']?>" alt="Sign of the student" width="100px" height="100px">
                                </div>
                            </div>
                        <?php endif; ?><br><br><br>
                        नाव : <?=$student['fullname']?><br><br>
                        शाखा व वर्ष : <?=$student['year']?> <?=$student['branch']?><br><br><br><br><br><br>
                    </div>
                </td>
            </tr>
        </table>
        <center><button onclick="printContent('subblock')" class="btn btn-sm btn-warning">Print</button></center>
    </body>
    <script>
        function printContent(div) {
            var contentToPrint = document.getElementById(div).innerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
        
    </script>
</html>