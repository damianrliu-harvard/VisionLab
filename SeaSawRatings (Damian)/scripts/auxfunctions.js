//auxiliaryfunctions.js

function Replay() {
  $('#replay').hide();
  var media = document.getElementById("video");
  media.currentTime = 0;
  media.play();
  $('#video').one('ended', function() {
    $('#replay').show();
  });
}

function permute(maxvalue) {
  return _.shuffle(_.range(maxvalue))
}

function randperm(maxValue){
    // first generate number sequence
    var permArray = new Array(maxValue);
    for(var i = 0; i < maxValue; i++){
        permArray[i] = i;
    }
    // draw out of the number sequence
    for (var i = (maxValue - 1); i >= 0; --i){
        var randPos = Math.floor(i * Math.random());
        var tmpStore = permArray[i];
        permArray[i] = permArray[randPos];
        permArray[randPos] = tmpStore;
    }
    for (var i = 0; i < maxValue; i++){
        permArray[i] = permArray[i] + 1;
       }

    return permArray;
}

function getResponseTime() {
  return (timeStamps.Answer.getTime() - timeStamps.Prompt.getTime()) / 1000;
}

function getExperimentDuration() {
  return (timeStamps.EndTime.getTime() - timeStamps.StartTime.getTime()) / 1000;
}
