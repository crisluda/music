<?php
    include("includes/config.php");
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>



    <div id="mainContainer">
        <div id="topContainer">
            <div id="navBarContainer">
                <div id="navBarContainer">
                    <nav class="navBar">
                        <a class="logo" href="index.php"><img src="assets/images/icons/next.png" alt="" srcset=""></a>
                    </nav>
                </div>
            </div>
        </div>
        <div id="nowPlayingBarContainer">
            <div id="nowPlayingBar">
                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img class="albumartwork" src="assets/images/icons/highlander.jpg" alt="" srcset="">
                        </span>
                        <div class="trackinfo">
                            <span class="trackName">
                                <span>Princes of the Universe</span>
                            </span>
                            <span class="artistName">
                                <span>queen</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="nowPlayingCenter">
                    <div class="content playerControls">
                        <div class="buttons">
                            <button class="controlButton shuffle " title="shuffle button">
                                <img src="assets/images/icons/shuffle.png" alt="shuffle" srcset="">
                            </button>
                            <button class="controlButton previous " title="previous button">
                                <img src="assets/images/icons/previous.png" alt="previous" srcset="">
                            </button>
                            <button class="controlButton play " title="play button">
                                <img src="assets/images/icons/play.png" alt="shuffle" srcset="">
                            </button>
                            <button class="controlButton pause" title="pause button">
                                <img src="assets/images/icons/pause.png" alt="Pause" srcset="">
                            </button>
                            <button class="controlButton next " title="next button">
                                <img src="assets/images/icons/next.png" alt="next" srcset="">
                            </button>
                            <button class="controlButton repeat " title="repeat button">
                                <img src="assets/images/icons/repeat.png" alt="repeat" srcset="">
                            </button>

                        </div>
                        <div class="playbackBar">
                            <span class="proggressTime current">0.00</span>
                            <div class="progressBar">
                                <div class="progressBarBg">
                                    <div class="progress"></div>
                                </div>
                            </div>
                            <span class="proggressTime remaining">0.00</span>

                        </div>

                    </div>
                </div>
                <div id="nowPlayingRight">
                    <div class="volumeBar">
                        <button class="controlButton volume" title="volume button">
                            <img src="assets/images/icons/volume.png" alt="volume" srcset="">
                        </button>
                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>

</html>