<!DOCTYPE html>
<html>
<head>
    <title>Start</title>
    <link href="logo/QMS-logo.png" rel="icon">
    <link rel="manifest" href="manifest.json">
    <style>
        body, html {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #000000ff;
            overflow: hidden;
        }

        #background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
        }

        #startButton {
    position: fixed;
    bottom: 15%;
    left: 50%;
    transform: translateX(-50%);
    padding: 50px 100px;
    background-color: #ffff00;
    color: black;
    border: 2px solid black;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-size: 40px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

#startButton:hover {
    background-color: #ffffff;
    cursor: pointer;
}

#leftButton {
    position: fixed;
    bottom: 15%;
    left: 10%;
    padding: 3vw 6vw;
    background-color: #e3ff37;
    color: black;
    border: 2px solid black;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-size: 3vw;
    font-weight: bold;
    transition: background-color 0.3s ease;
    min-width: 150px;
    max-width: 30%;
}

#leftButton:hover {
    background-color: #ffffff;
    cursor: pointer;
}

#rightButton {
    position: fixed;
    bottom: 15%;
    right: 10%;
    padding: 3vw 6vw;
    background-color: #e3ff37;
    color: black;
    border: 2px solid black;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-size: 3vw;
    font-weight: bold;
    transition: background-color 0.3s ease;
    min-width: 150px;
    max-width: 30%;
}

#rightButton:hover {
    background-color: #ffffff;
    cursor: pointer;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    #leftButton, #rightButton {
        position: static;
        display: block;
        margin: 10px auto;
        width: fit-content;
        padding: 20px 40px;
        font-size: 24px;
    }
    #leftButton {
        bottom: auto;
    }
    #rightButton {
        bottom: auto;
    }


        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
<div class="video-player">
  <?php
  $videoFolder = 'Home_bg_Video/';
  $videoExtensions = ['mp4', 'webm', 'ogv']; // add more extensions if needed
  $videos = [];

  // Scan the directory for video files
  foreach (scandir($videoFolder) as $file) {
    $FileInfo = pathinfo($file);
    if (in_array($FileInfo['extension'], $videoExtensions)) {
      $videos[] = $FileInfo['basename'];
    }
  }

  // Generate the video playlist
  if (!empty($videos)) {
    $currentVideo = array_shift($videos); // play the first video
    echo '<video id="videoPlayer" autoplay muted style="width: 100vw; height: 100vh; object-fit: fill; position: fixed; top: 0; left: 0; z-index: -1;">';
    echo '<source src="'. $videoFolder. $currentVideo. '" type="video/'. pathinfo($currentVideo, PATHINFO_EXTENSION). '">';
    echo 'Your browser does not support the video tag.';
    echo '</video>';

    // Add a script to cycle through the videos
    echo '<script>';
    echo 'var videos = ['. implode(',', array_map(function($video) {
      return "'" . $video . "'";
    }, array_merge([$currentVideo], $videos))). '];';
    echo 'var videoPlayer = document.getElementById("videoPlayer");';
    echo 'var videoIndex = 0;';
    echo 'videoPlayer.addEventListener("ended", function() {'; 
    echo '  videoIndex = (videoIndex + 1) % videos.length;';
    echo '  videoPlayer.src = "'. $videoFolder. '" + videos[videoIndex];';
    echo '  videoPlayer.load();';
    echo '  videoPlayer.play();';
    echo '});';
    echo '</script>';
} else {
    echo 'No videos found in the directory.';
}
  ?>
</div>
        <a href="QueueCheck/index.php"><button type="submit" id="leftButton">Check Queue</button></a>
       <a href="Kiosk/index.html"><button type="submit" id="rightButton">Create Queue</button></a>

  <script>
  // Register service worker
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('service-worker.js')
        .then(registration => {
          console.log('Service Worker registered successfully:', registration);
        })
        .catch(error => {
          console.log('Service Worker registration failed:', error);
        });
    });
  }
  </script>
</body>
</html>
