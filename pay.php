<?php
require_once "./utils/config.php";
require_once "./utils/common.php";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['totalAmount'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['totalAmount'];
    
}
?>
