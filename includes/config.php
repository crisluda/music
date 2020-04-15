<?php
ob_start();
session_start();
$timezone=date_default_timezone_set("Africa/Accra");
$con=mysqli_connect("sql9.freemysqlhosting.net","sql9333608","Rg2eGM55p5","sql9333608");
if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}




?>
