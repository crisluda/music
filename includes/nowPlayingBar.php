<?php
$songQuery= mysqli_query($con,"SELECT id FROM songs ORDER BY RAND() LIMIT 10");
$resultArray = array();
while ($row = mysqli_fetch_array($songQuery)){
    array_push($resultArray,$row['id']); 
}
$jsonArray=json_encode($resultArray);
?>

<script>

$(document).ready( function() {
    var newPlaylist=<?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0],newPlaylist,false);
    updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function (e) {
        e.preventDefault();
    });

    $(".playbackBar .progressBar").mousedown(function(){
        mousedown=true;
    });
    $(".playbackBar .progressBar").mousemove(function(e){
        if(mousedown){
            timeFormOffSet(e,this);
        }
    });
    $(".playbackBar .progressBar").mouseup(function(e){
        timeFormOffSet(e,this);
    });


    /////////////////////////////////////
    $(".volumeBar .progressBar").mousedown(function(){
        mousedown=true;
    });
    $(".volumeBar .progressBar").mousemove(function(e){
        if(mousedown==true){
            var percentage=e.offsetX / $(this).width();
        if(percentage>=0 && percentage<=1){
            audioElement.audio.volume = percentage;
        }
        }
    });
    $(".volumeBar .progressBar").mouseup(function(e){
        var percentage=e.offsetX / $(this).width();
        if(percentage>=0 && percentage<=1){
            audioElement.audio.volume = percentage;
        }
       
    });

    $(document).mouseup(function(){
        mousedown=false;
    });


}); 
function timeFormOffSet(mouse, progressBar) {
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds= audioElement.duration * (percentage / 100);
    audioElement.setTime(seconds);
}
function prevSong() {
	if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
		audioElement.setTime(0);
	}
	else {
		currentIndex = currentIndex - 1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
}
 function nextSong() {
    if(repeat == true) {
		audioElement.setTime(0);
		playSong();
		return;
	}
     if(currentIndex == currentPlaylist.length - 1){
        currentIndex=0;
     }else{
         currentIndex++;
     }
     var trackToPlay= shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
     setTrack(trackToPlay,currentPlaylist, true)
 }

 function setRepeat() {
	repeat = !repeat;
	var imageName = repeat ? "repeat-one.png" : "repeat.png";
	$(".controlButton.repeat img").attr("src", "assets/images/icons/" + imageName);
}
function setMute() {
	audioElement.audio.muted = !audioElement.audio.muted;
	var imageName = audioElement.audio.muted ? "mute.png" : "volume.png";
	$(".controlButton.volume img").attr("src", "assets/images/icons/" + imageName);
}
function setShuffle() {
	shuffle=!shuffle
	var imageName = shuffle ? "shuffle-all.png" : "shuffle.png";
    $(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);
    if(shuffle){
        shuffleArray(shufflePlaylist);
        currentIndex= shufflePlaylist.indexOf(audioElement.currentlyPlaying.id); 
    }else{
        currentIndex= currentPlaylist.indexOf(audioElement.currentlyPlaying.id); 
    }
}
function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

function setTrack(trackId,newPlayList,play) {
    if(newPlayList != currentPlaylist){
        currentPlaylist=newPlayList;
        shufflePlaylist=currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }
    if(shuffle){
        currentIndex= shufflePlaylist.indexOf(trackId); 
    }else{
        currentIndex= currentPlaylist.indexOf(trackId);
    }
    
    pauseSong()
    $.post("includes/handlers/ajax/getSongJson.php",{songId:trackId},function (data) {
        
        var track= JSON.parse(data);
        $(".trackName span").text(track.title);

        $.post("includes/handlers/ajax/getArtistJson.php",{artistId:track.artist},function (data) {
            var artist=JSON.parse(data);
            $(".artistName span").text(artist.name);

            // console.log(artist.name);
        });
        $.post("includes/handlers/ajax/getAlbumJson.php",{albumId:track.album},function (data) {
        var album= JSON.parse(data);
        $(".albumLink img").attr("src",album.artworkPath);
        // console.log(album.artworkPath)
        })
        audioElement.setTrack(track);
        playSong();
    });
    // audioElement.setTrack("assets/music/bensound-cute.mp3");
    if(play){
        audioElement.play();
    }
}
function playSong() {
    if(audioElement.audio.currentTime == 0){
        $.post("includes/handlers/ajax/updatePlays.php",{songId: audioElement.currentlyPlaying.id });
    } 
    $(".controlButton.play").hide();
    $(".controlButton.pause").show ();
    audioElement.play()
}
function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide ();
    audioElement.pause()
}
</script>

<div id="nowPlayingBarContainer">
            <div id="nowPlayingBar">
                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img class="albumartwork" src="assets/images/icons/highlander.jpg" alt="" srcset="">
                        </span>
                        <div class="trackinfo">
                            <span class="trackName">
                                <span></span>
                            </span>
                            <span class="artistName">
                                <span></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="nowPlayingCenter">
                    <div class="content playerControls">
                        <div class="buttons">
                            <button class="controlButton shuffle " title="shuffle button"onclick="setShuffle()">
                                <img src="assets/images/icons/shuffle.png" alt="shuffle" srcset="">
                            </button>
                            <button class="controlButton previous " title="previous button">
                                <img src="assets/images/icons/previous.png" alt="previous" srcset="" onclick="prevSong()">
                            </button>
                            <button class="controlButton play " title="play button" onclick="playSong()">
                                <img src="assets/images/icons/play.png" alt="shuffle" srcset="">
                            </button>
                            <button class="controlButton pause" title="pause button" style="display: none;" onclick="pauseSong()" >
                                <img src="assets/images/icons/pause.png" alt="Pause" srcset="">
                            </button>
                            <button class="controlButton next " title="next button"onclick="nextSong()">
                                <img src="assets/images/icons/next.png" alt="next" srcset="">
                            </button>
                            <button class="controlButton repeat " title="repeat button" onclick="setRepeat()">
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
                        <button class="controlButton volume" title="volume button" onclick="setMute()">
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


        