<?php
    include 'inc/top-cache.php';
    include 'inc/config.php';

    if(!isset($_COOKIE['user_ip'])){

        $cookie_name = 'user_ip';
        $cookie_id = $_SERVER['REMOTE_ADDR'];

        setcookie($cookie_name, $cookie_id, time() + (1800), "/");
        $musiq_title_slug = $_GET['title'];
        
        $query_musiqID = "SELECT musiq_id, musiq_title_slug FROM musiq WHERE musiq_title_slug = '$musiq_title_slug'";
        $result_set = mysqli_query($conn, $query_musiqID);
        $row = mysqli_fetch_assoc($result_set);

        if(!empty($row)){

            $musiq_id = $row['musiq_id'];

            $update_musiq = "UPDATE musiq SET musiq_views = musiq_views + 1 WHERE musiq_id = '$musiq_id'";
            mysqli_query($conn, $update_musiq);
            echo mysqli_error($conn);
        }
    }

    $musiq_title_slug = $_GET['title'];
        
    $query_musiqID = "SELECT musiq_id, musiq_title_slug FROM musiq WHERE musiq_title_slug = '$musiq_title_slug'";
    $result_set = mysqli_query($conn, $query_musiqID);
    $row3 = mysqli_fetch_assoc($result_set);
    $musiq_id = $row3['musiq_id'];
    
    $query_musiq2 = "SELECT * FROM musiq, artists WHERE musiq.artist_id = artists.artist_id AND musiq.musiq_id = '$musiq_id'";
    $result_set = mysqli_query($conn, $query_musiq2);
    $row2 = mysqli_fetch_assoc($result_set);

    if($row2['active_yn']){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
        <meta property="og:url" content="https://www.sweetsound.co.za/musiq/<?php echo $row2['artist_name_slug'].'/'.$row2['musiq_title_slug'] ?>">
  	    <meta property="og:image:secure" content="https://www.sweetsound.co.za/musiq/images/musiq_images/<?php echo $row2['musiq_coverart'] ?>">
  	    <meta name="description" content="Stream and Download <?php echo $row2['artist_name'].' - '.$row2['musiq_title'].' ['.$row2['musiq_type']?> from your preferred platform. Download MP3 file straight from Sweet Sound Musiq website.">
  	    <meta property="og:title" content="<?php echo $row2['artist_name'].' - '.$row2['musiq_title'] ?>">
    	<meta property="og:type" content="website">
  	    <title><?php echo $row2['artist_name'].' - '.$row2['musiq_title'] ?></title>
        <!-- Favicon -->
        <link rel="icon" href="../img/core-img/favicon.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css" href="../css/link-style.css">
        <link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
    </head>
    <body style="background-image: linear-gradient(rgba(22, 22, 22, 0.5), rgba(22, 22, 22, 0.5)), url('../images/musiq_images/<?php echo $row2['musiq_coverart'] ?>')">
        <?php
        if(!empty($musiq_id)){

            $query_musiq = "SELECT * FROM ((artists INNER JOIN  musiq ON artists.artist_id = musiq.artist_id) INNER JOIN musiq_links ON musiq.musiq_id = musiq_links.musiq_id) WHERE musiq.musiq_id = '$musiq_id'";
            $result_set = mysqli_query($conn, $query_musiq);
            $row=mysqli_fetch_assoc($result_set);
        ?>
            <div class="container">
                <div class="preview-img">
                    <div>
                        <img src="../images/musiq_images/<?php echo $row['musiq_coverart'] ?>">
                    </div>
                    <div class="details">
                        <h2><?php echo $row['musiq_title'] ?></h2>
                        <h1><?php echo $row2['artist_name']?></h1>
                    </div>
                    <div class="details" id="stats">
                        <!-- <h2>/<?php //echo $row2['musiq_plays']?> <i class="fa fa-play"></i> </h2> -->
                        <h2><?php echo $row2['musiq_downloads']?> <i class="fa fa-download"></i> </h2>
                        <h2><?php echo $row2['musiq_likes']?> <i class="fa fa-heart"></i> </h2>
                        <h2><?php echo $row2['musiq_views']?> <i class="fa fa-eye"></i> </h2>
                    </div>
                </div>
                <div class="link-options">
                    <a>
                        <div class="link-option-row-audio">
                            <button type="submit" name="submit-plays" class="sml-btn" id="playButton"><i id="playButtonIcon" class="fa fa-circle-play"></i> </button>
                            <div id="waveform" class="waveform"></div>
                        </div>
                        <div class="controls">
                            <div class="volume">
                                <i id="volumeIcon" class="fa fa-volume-high"></i>
                                <input id="volumeSlider" class="volume-slider" type="range" name="volume-slider" min="0" max="100" value="50"/> 
                            </div>
                            <div class="timecode">
                                <span id="currentTime">00:00</span>
                                <span style="color:white;">/</span>
                                <span id="totalDuration">00:00</span>
                            </div>
                        </div>
                    </a>
                    <div class="link-options-header">
                        <div class="sml-links">
                            <form id="like_form" action="../stats_process.php" method="post" target="noLoad">
                                <input type="hidden" name="musiq_id" value="<?php echo $row['musiq_id'] ?>" >
                                <input type="hidden" name="like" value="like" >
                                <input type="submit" name="submit-like" id="submit-like" value="submit-like" hidden />
                            </form>
                            <form id="download_form" action="../stats_process.php" method="post"  target="noLoad">
                                <input type="hidden" name="musiq_id" value="<?php echo $row['musiq_id'] ?>" >
                                <input type="hidden" name="download" value="download" >
                                <input type="submit" name="submit" id="submit-form" value="submit" hidden />
                            </form>
                            <iframe name="noLoad2" style="display: none;"></iframe>
                            <form id="play_form" action="../stats_process.php" method="post"  target="noLoad2">
                                <input type="hidden" name="musiq_id" value="<?php echo $row['musiq_id'] ?>" >
                                <input type="hidden" name="play" value="play" >
                                <input type="submit" name="submit-play" id="submit-play" value="submit-play" hidden />
                            </form>
                            <button class="sml-btn" id="likeButton" name="like"><i class="fa fa-heart"></i> </button>
                            <button class="sml-btn" id="downloadButton" name="download"><i class="fa fa-download"></i> </button>
                            <input type="text" id="submit-copy" value="https://www.sweetsound.co.za/musiq/<?php echo $row['artist_name_slug'] ?>/<?php echo $row['musiq_title_slug'] ?>" hidden />
                            <button class="sml-btn" onclick="submitCopy()"><i class="fa fa-share"></i> </button>
                        </div>
                    </div>
                    <script>
                        const download = document.querySelector("#downloadButton");
                        const like = document.querySelector("#likeButton");
                        const submitForm = document.querySelector("#submit-form");
                        const submitLike = document.querySelector("#submit-like");

                        var musiq_file = "<?php echo $row['musiq_file'] ?>";
            
                        download.addEventListener("click", () => {
            
                            let element = document.createElement("a");
                            element.href = "../songs/singles/"+musiq_file;
                            element.download = "./"+musiq_file;
                
                            document.documentElement.appendChild(element);
                            element.click();
                            document.documentElement.removeChild(element);
                
                            submitForm.click();
                        });
                        like.addEventListener("click", () => {
                            submitLike.click();
                        });
                    </script>
                    <?php if(!empty($row['link_sweetsoundmusiq'])){?>
                        <!-- <a href="javscript:;" class="link-option" id="downloadButton">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/sweetsound-musiq.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-download"></i>
                                    Download
                                </div>
                            </div>
                        </a> -->
                    <?php }?>
                    <?php if(!empty($row['link_genius_lyrics'])){ ?>

                        <a href="<?php echo $row['link_genius_lyrics'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/genius.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-file"></i>
                                    Lyrics
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_spotify'])){ ?>

                        <a href="<?php echo $row['link_spotify'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/spotify.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_youtube'])){ ?>

                        <a href="<?php echo $row['link_youtube'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/youtube.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-video-camera"></i>
                                    Watch
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_audiomack'])){ ?>

                        <a href="<?php echo $row['link_audiomack'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/audiomack.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_youtubemusic'])){ ?>

                        <a href="<?php echo $row['link_youtubemusic'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/youtube-music.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                        <?php }?>
                    <?php if(!empty($row['link_applemusic'])){ ?>

                        <a href="<?php echo $row['link_applemusic'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/apple-music.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_deezer'])){ ?>

                        <a href="<?php echo $row['link_deezer'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/deezer.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_soundcloud'])){ ?>

                        <a href="<?php echo $row['link_soundcloud'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/soundcloud.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_amazonmusic'])){ ?>

                        <a href="<?php echo $row['link_amazonmusic'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/amazon-music.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-play"></i>
                                    Play
                                </div>
                            </div>
                        </a>
                    <?php }?>
                    <?php if(!empty($row['link_itunes'])){ ?>

                        <a href="<?php echo $row['link_itunes'] ?>" class="link-option">
                            <div class="link-option-row">
                                <div class="link-option-title">
                                    <span>
                                        <img class="link-option-img" src="../img/icons/itunes.png">
                                    </span>
                                </div>
                                <div class="link-option-action">
                                    <i class="fa fa-shopping-cart"></i>
                                    Buy
                                </div>
                            </div>
                        </a>
                    <?php }?>
                </div>
            </div>
            <script type="text/javascript"> var audio = "<?php echo $row['musiq_file'] ?>";</script>
        <?php
        }
        ?>
        <footer>
            <div class="footer">
                <p class="copywrite-text">
                    Copyright &copy; <script>document.write(new Date().getFullYear());</script>
                    <a href="https://www.sweetsound.co.za/musiq/" target="_blank"> Sweet Sound Musiq</a><br>
                    Powered By
                    <a href="https://www.sweetsound.co.za/tech/" target="_blank"> Sweet Sound Tech</a>
                </p>
            </div>
        </footer>
        <script src="https://unpkg.com/wavesurfer.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
<?php
    include 'inc/bottom-cache.php';
    }
    else{
        $newDate = date("d.m.Y", strtotime($row2['musiq_release_date']));
        $date = strftime("%A",strtotime($newDate));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <base href="localhost/projects/sweet-sound-family/musiq/"> -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta property="og:url" content="https://www.sweetsound.co.za/musiq/<?php echo $row2['artist_name_slug'].'/'.$row2['musiq_title_slug'] ?>">
        <meta property="og:image:secure" content="https://www.sweetsound.co.za/musiq/images/musiq_images/<?php echo $row2['musiq_coverart'] ?>">
        <meta name="description" content="Pre-save <?php echo $row2['artist_name'].' - '.$row2['musiq_title'].' ['.$row2['musiq_type'].'] To be released on '.$date.' '.$newDate?> And Be The First To Get It.">
        <meta property="og:title" content="<?php echo $row2['artist_name'].' - '.$row2['musiq_title'] ?>">
        <meta property="og:type" content="website">
        <title>Pre-Save | <?php echo $row2['artist_name'].' - '.$row2['musiq_title'] ?></title>
        <!-- Favicon -->
        <link rel="icon" href="../img/core-img/favicon.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="../css/link-style.css">
        <link href="../css/fontawesome/css/all.css" rel="stylesheet" type="text/css">
    </head>
    <body style="background-image: linear-gradient(rgba(22, 22, 22, 0.5), rgba(22, 22, 22, 0.5)), url('../images/musiq_images/<?php echo $row2['musiq_coverart'] ?>')">
    <?php
    if(!empty($musiq_id)){

        $query_musiq = "SELECT * FROM ((artists INNER JOIN  musiq ON artists.artist_id = musiq.artist_id) INNER JOIN musiq_links ON musiq.musiq_id = musiq_links.musiq_id) WHERE musiq.musiq_id = '$musiq_id'";
        $result_set = mysqli_query($conn, $query_musiq);
        $row = mysqli_fetch_assoc($result_set);

        $newDate = date("d.m.Y", strtotime($row['musiq_release_date']));
        $date = strftime("%A",strtotime($newDate));
    ?>
        <div class="container">
            <div class="preview-img">
                <div>
                    <img src="../images/musiq_images/<?php echo $row['musiq_coverart'] ?>">
                </div>
                <div class="details">
                    <h2><?php echo $row['artist_name'] ?></h2>
                    <h1><?php echo $row['musiq_title']?></h1>
                </div>
                <div class="details" id="stats">
                    <h2>Dropping On <?php echo $date.', '.$row['musiq_release_date'] ?></h2>
                </div>
            </div>
            <div class="link-options">
                <div class="link-options-header">
                    <div class="link-options-triangle-back"></div>
                    <div class="link-options-triangle"></div>
                </div>
                <a href="<?php echo $row['pre_save_spotify'] ?>" class="link-option" target="_blank">
                    <div class="link-option-row">
                        <div class="link-option-title">
                            <span>
                                <img class="link-option-img" src="../img/icons/spotify.png">
                            </span>
                        </div>
                        <div class="link-option-action">
                            <i class="fa fa-link"></i>
                            Pre-Save
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <script type="text/javascript"> var audio = "<?php echo $row['musiq_file'] ?>";</script>
    <?php
    }
    ?>
      <footer>
          <div class="footer">
              <p class="copywrite-text">
                  Copyright &copy; <script>document.write(new Date().getFullYear());</script>
                  <a href="https://www.sweetsound.co.za/musiq/" target="_blank"> Sweet Sound Musiq</a><br>
                  Powered By
                  <a href="https://www.sweetsound.co.za/tech/" target="_blank"> Sweet Sound Tech</a>
              </p>
          </div>
      </footer>
        <script src="https://unpkg.com/wavesurfer.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
<?php
    }
    include 'inc/bottom-cache.php';
?>
