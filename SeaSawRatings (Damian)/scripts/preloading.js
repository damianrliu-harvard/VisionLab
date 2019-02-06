//preloading.js

var loading = {
  StartDate: new Date(),
  PercentComplete: 0,
  TimeElapsed: 0,
  TotalTime: 0,
  Count: 0,
}

var images = new Array();

function loadCounter() {
  loading.Count++; //Increase the counter for every loaded asset.
  loading.PercentComplete = (loading.Count/assetsList.length);
  console.log(loading.Count + '/' + assetsList.length + " Assets Loaded")
  loading.timeElapsed = ((new Date).getTime() - loading.StartDate.getTime()) / 1000
  animateLoadingBar(loading.PercentComplete);
  if (loading.PercentComplete == 1) {
    loading.TotalTime = loading.timeElapsed;
  };
};

function clearLoadingData() {
  loading.StartDate = new Date(),
  loading.PercentComplete = 0;
  loading.TimeElapsed = 0;
  loading.TotalTime = 0;
  loading.Count = 0;
  bar.animate(0);
}

function animateLoadingBar (percentLoaded) {
  if (percentLoaded <= 1) {
    bar.animate(percentLoaded)
  }
};

function preloadImages(imageList, callback) {
  loadedimages = imageList.map(function(image) {
    return preloadImage(image);
  });

  Promise.all(loadedimages).then(function() {
    console.log("Image preloading complete.")
    if (callback) callback();
  });
}

function preloadImage(imagePath) {
  return new Promise(function(resolve, reject) {
    var i = images.length;
    images[i] = new Image();
    images[i].src = imagePath;
    images[i].onload = function() {
      console.log("Currently Loading: " + imagePath);
      loadCounter();
      resolve();
    };
  });
}

function preloadVideos(videoList, callback) {
  var loadedvideos = videoList.map(function(video) {
    return preloadVideo(video, videoList.length);
  });

  Promise.all(loadedvideos).then(function() {
    console.log("Video preloading complete.")
    if (callback) callback();
  });
}

function preloadVideo(video, videoCount) {
  return new Promise(function(resolve, reject) {
    var req = new XMLHttpRequest();
    req.open('GET', video, true);
    req.responseType = 'blob'

    req.onload = function() {
      if (this.status === 200) {
        loadCounter(); //Update loading...
        var videoBlob = this.response;
        var blobject = URL.createObjectURL(videoBlob);
        console.log("Video Loaded: " + video);
        animateLoadingBar(loading.PercentComplete);
        resolve(blobject);
      } else {
        reject(this.response)
      }
    }
    req.onerror = function(e) {
      reject(this.response);
    }
    req.send();
  }
)};
