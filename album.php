<?php
    include("includes/header.php");

    if(isset($_GET['id'])){
        $albumId= $_GET['id'];
    }else{
        header("Location:index.php");
    }
    $album= new Album($con,$albumId);
    
    $artist= $album->getArtist();
    ?>

<di class="entityIfo">
    <div class="leftSection">
        <img src="<?php echo $album->getartworkPath(); ?>">
    </div>
    <div class="rightsection">
        <h2> <?php echo $album->getTitle();?> </h2>
        <p>By <?php echo $artist->getName();?></p>
        <p><?php echo $album->getNumberOfSongs();?> Songs</p>
    </div>
</di>
<div class="trackLIstContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $album->getSongIds();
                $i=1;
            foreach ($songIdArray as $songId){
                    $albumSong = new Song($con,$songId);
                    $albumSong->getTitle();
                    $albumArtist=$albumSong->getArtist();
                    echo "<li class='trackListRow'>
                    <div class='trackCount'>
                        <img class='play' src='assets/images/icons/play.png' onclick='setTrack(" . $albumSong->getId() . ",tempPlaylist,true)'>
                        <span class='trackNumber'>$i</span>
                    </div>
                     <div class='trackInfo'>
                          <span class='trackName'>
                              " . $albumSong->getTitle() . "</span>
                          <span class='artistName'>
                              " . $albumArtist->getName() . "</span>
                     </div>
                     <div class='trackOptions'>
                        <img src='assets/images/icons/more.png' alt='' class='optionButton'>
                     </div>
                     <div class='trackDuration'>
                         <span class='duration'>" . $albumSong->getDuration() . "</span>
                     </div>
                    </li>";
                    $i++;
            };

            ?>
                <script>
    var tempSongId='<?php echo json_encode($songIdArray); ?>';
    tempPlaylist= JSON.parse(tempSongId)
    </script>

    </ul>
</div>


<?php
    include("includes/footer.php");
?>