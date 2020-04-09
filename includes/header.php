<?php
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php"); 

    // session_destroy();
if(isset($_SESSION["userLoginedIn"])){
    $userLoginedIn=$_SESSION["userLoginedIn"];
}else{
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
    <title>Document</title>
</head>
 
<body>



    <div id="mainContainer">
        <div id="topContainer">
            <?php
            include("includes/navBarContainer.php");
            ?>
            <div id="mainViewContainer">
                <div id="mainContent">