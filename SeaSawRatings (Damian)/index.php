 <?php
  chdir('assets/');
  $imagefiles = glob('*{.png}', GLOB_BRACE);
  $imageJSON = json_encode($imagefiles);
?>

<html>

<head>
  <title>ImageRatingsDemo</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://timbrady.org/turk/TimTurkTools.js"></script>
  <script src="scripts/codegenerator.js"></script>
  <script src="scripts/progressbar.js"></script>
  <script src="scripts/preloading.js"></script>
  <script src="scripts/auxfunctions.js"></script>
  <script src="scripts/datafunctions.js"></script>
  <script src="scripts/arraywrangler.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.8.20/themes/base/jquery-ui.css" media="all">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/SeaSawRatings.css?v1.1.1">
</head>

<body>

  <div id="versionControl">
    <script id="experimentInfo">
      var server = 'https://scorsese.wjh.harvard.edu';
      //var experimentName = 'SeaSawBubble';
      var experimentName = 'SeaSawRatings'
      var pageURL = window.location.href;
      var experimenter = 'coco'
      var version = 1.3;
    </script>
  </div>

  <div id="container">

    <div id="interface">
      <div class="well" id="ubarWell">
        <div id="ubarBox">
          <p><strong> We're loading the study materials. It should only take a few seconds. Thanks for your patience! </strong></p>
          <div id="barBox"></div>
        </div>
      </div>

      <div class ="well" id = "instructionsbox">
        <div id="instructions"></div>
        <div id="myCarousel" class="carousel slide" data-interval="false">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              This study involves assessing your personal, subjective reactions to various pieces of art. Please take a moment to read through a few instructions before beginning. <br><br> (You can navigate these instructions with the arrows below.)
            </div>
            <div class="item">
              First, you will see a series of images. You will spend at least five seconds viewing each image. There is no time limit, so feel free to view each image as long as you desire before progressing.
            </div>
            <div class="item">
              After viewing all the images once, you will see them again, this time along with a slider representing your aesthetic response. Simply move the indicator to the location you feel is most fitting, and a button will appear, allowing you to save your response and progress to the next trial.
            </div>
            <div class="item">
              <br><br> When you're ready, click the button below to begin!
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

      <button type="button" class="btn btn-default" onclick="BeginStudy()" id="beginStudy">
        I've read the instructions and am ready to begin!
      </button>

      <img id="imageholder"></img>

      <video id="video"></video>

      <div id="prompt"></div>

      <div id="feedbackVariables">
        <div class="well well-sm" id="feedbackbox">
          <div id="feedback">
            Thank you! Your response has been recorded. Please Press SPACEBAR to Continue.
          </div>
        </div>

        <div id="blockPlusTrial"></div>

      </div>

      <div id="sliderBox" style="display: none">
        <div id="sliderInfo"></div>

        <div id="slider"></div>

        <div id="sliderSteps">
          <span id="sliderStepLeft">|<br>Not at All</span>
          <span id="sliderStepRight">|<br>Very Much So</span>
        </div>
      </div>

      <button type="button" class="btn btn-default" onclick="RunResponse()" id="continueButton">
        Continue
      </button>

      <button type="button" id="saveSlider" class="btn btn-default" onclick="RunResponse()">
        Save & Continue
      </button>

      <div id="dataSubmitInstructions">Click the button below to submit your data and view your completion code.</div>

      <button type="button" class="btn btn-primary" onclick="SubmitData()" id="dataSubmit">Finish  </button>

      <div class="well well-sm" id="completionCodeBox">
        <div class="generatedCode"></div>
      </div>

      <div id="finalInstructions"></div>

    </div>
  </div>

  <div id="assetLoading" class="hidden">
   <script type="text/javascript">

     var totalLoadTime = loading.TotalTime;
     var bar = initProgressBar();
     var practiceAssets;
     var feedbackAssets;
     var trialAssets;
     var assetsList;

     var filters = ["ShipImage", "Seascape"];
     var filter = filters[Math.floor(Math.random() * filters.length)];
     function jsonParser(jsonPackage, filter) {
       //var filteredList = jsonPackage.filter(function (string) {return string.includes(filter)});
       //var filteredList = jsonPackage.filter(json => json.includes("Seascape") || json.includes("ShipImage"))
       var filteredList = jsonPackage.filter(json => json.includes(filter))
        return filteredList.map(function(source) {
          return 'assets/' + source
       });
     };

     assetsList = jsonParser(<?php echo $imageJSON ?>, filter);
     trialAssets = assetsList;

     //trialAssets = assetsList.filter(asset => asset.includes('Practice') === false);

   </script>
  </div>

  <script id="experimentScript">

    var workerID = pageURL.substring(pageURL.indexOf("?")+1, pageURL.length);

    var timeStamps = {
      StartTime: 0,
      EndTime: 0,
      Prompt: 0,
      Answer: 0
    };

    var flowControl = {
      ReadyForResponse: 0,
      InstructionPart: 1,
      ReadyToAdvance: 1,
      ExperimentPart: 1,
    };

    var trialType = {
      0 : "Practice",
      1 : "Experiment",
    }

    var trialCount = -1;
    var galleryCount = 0;
    var numberOfTrials = trialAssets.length;
    // var numberOfTrials = 3;
    var trialCode = permute(numberOfTrials);

    var Data = {
      "workerID": workerID,
      "userAgent": navigator.userAgent,
      "windowWidth": $(window).width(),
      "windowHeight": $(window).height(),
      "screenWidth": screen.width,
      "screenHeight": screen.height,
      "experimentName" : experimentName,
      "version" : version,
      "filter": filter,
      "stimulus": [[]],
      "imageIndex": [[]],
      "trialCount": [[]],
      "response": [[]],
      "responseTime": [[]],
      "completionCode": [],
      "completionTime": [],
    };

    $(window).load(preloadImages(assetsList, StarterScript));

    function StarterScript() {
      timeStamps.StartTime = new Date();
      $('#ubarWell').delay(1200).fadeOut(100);
      $('#instructions').html('Welcome to the Experiment! Press SPACEBAR to continue.');
      $('#instructionsbox').delay(1500).show(0, function() {
        $(document).bind('keyup', 'space', function() {
          RunExperiment();
        });
      });
    };

    $(function SliderInit() {
      $( "#slider" ).slider({
        value: 50, min: 0, max: 100,
        slide: function( event, ui ) {
          $('#saveSlider').show();
        }
      });
    });

    function BeginStudy() {
      flowControl.ExperimentPart++;
      RunExperiment();
    }

    function RunExperiment(){
    	if (flowControl.ExperimentPart == 1){ // Instructions
        clearLoadingData();
        RunInstructions();
      }
    	else if (flowControl.ExperimentPart == 2) { // Part 1
        RunGallery(trialAssets);
      }
      else if (flowControl.ExperimentPart == 3) { // Part 2
        RunTrial(trialAssets);
      }
      else if (flowControl.ExperimentPart == 4) { // End
        if (flowControl.ReadyToAdvance == 0) return;
        flowControl.ReadyToAdvance = 0;
        timeStamps.EndTime = new Date();
        RunConclusion();
      }
    }

    function RunInstructions(){
    	if (flowControl.InstructionPart == 1) {
        $('#instructions').empty();
        $('#myCarousel').bind('slid.bs.carousel', function (e) {
          var index = $(e.target).find(".active").index();
          if (index === ($('.item').length - 1)) {
            $('.carousel-indicators li').css('pointer-events', 'auto');
            $('#beginStudy').show();
          };
        });

      	$('#myCarousel').show();
    	}
    }

    function RunTrial(trialAssets){ // Block 2
      if (flowControl.ReadyToAdvance == 0) return;
      flowControl.ReadyToAdvance = 0;
      trialCount++;

      currentImage = trialAssets[trialCode[trialCount]];
      $("#imageholder").attr('src', currentImage);
      Data.stimulus[trialCount] = currentImage;
      currentImageWidth = $('#imageholder').width();
      $('#imageholder').css('margin-left', -$('#imageholder').width() / 2);
      $('#beginStudy').hide();
      $('#blockPlusTrial').hide();
      $('#continueButton').hide();
      $('#feedbackbox').hide();
      $('#instructionsbox').hide();
      $('#slider').slider("value", 50);
      $('#imageholder').show();
      setTimeout(function() {
        $('#prompt').html("How beautiful do you find this image?");
        $('#prompt').show();
        $('#sliderBox').show();
        timeStamps.Prompt = new Date();
        flowControl.ReadyForResponse = 1;
      }, 500);

      console.log("Trials to Go: " + (numberOfTrials - 1 - trialCount))
      $('#blockPlusTrial').html("Trials to Go: " + (numberOfTrials - 1 - trialCount))
      Data.imageIndex[trialCount] = currentImage.substring(currentImage.indexOf('.') - 3, currentImage.indexOf('.'))
    }

    function RunGallery(trialAssets){ // Block 1
      if (flowControl.ReadyToAdvance == 0) return;
      flowControl.ReadyToAdvance = 0;
      galleryCount++;

      currentImage = trialAssets[trialCode[galleryCount-1]];
      $("#imageholder").attr('src', currentImage);
      // Data.stimulus[galleryCount] = currentImage;
      currentImageWidth = $('#imageholder').width();
      $('#imageholder').css('margin-left', -$('#imageholder').width() / 2);
      $('#beginStudy').hide();
      $('#blockPlusTrial').hide();
      $('#feedbackbox').hide();
      $('#instructionsbox').hide();
      $('#continueButton').hide();
      // $('#slider').slider("value", 50); // No slider in the first block
      $('#imageholder').show();
      setTimeout(function() {
        // $('#prompt').html("How beautiful do you find this image?");
        // $('#prompt').show();
        // $('#sliderBox').show();
        timeStamps.Prompt = new Date();
        flowControl.ReadyForResponse = 1;
        $('#continueButton').show();
      }, 5000); // 5 second minimum look time

      console.log("Gallery images to go: " + (numberOfTrials - galleryCount))
      $('#blockPlusTrial').html("Images viewed: " + galleryCount + " Images to go: " + (numberOfTrials - galleryCount))
      $('#feedbackbox').html("Press SPACEBAR to continue.")
      if (galleryCount == numberOfTrials) console.log("Gallery done!");
      if (galleryCount == numberOfTrials) flowControl.ExperimentPart++;
      if (galleryCount == numberOfTrials) $('#blockPlusTrial').html("You've viewed all the images! Now, you'll evaluate them.");

      // console.log("Trials to Go: " + (numberOfTrials - 1 - trialCount))
      // $('#blockPlusTrial').html("Trials to Go: " + (numberOfTrials - 1 - trialCount))
      // Data.imageIndex[trialCount] = currentImage.substring(currentImage.indexOf('.') - 3, currentImage.indexOf('.'))
    }

    // function RunContinue() {
    //   if (flowControl.ReadyForResponse == 0) return;
    //   // Data.response[galleryCount] = $( "#slider" ).slider( "value" );
    //   // Data.trialCount[galleryCount] = galleryCount + 1;
    //   $('#continueButton').hide();
    //   $('#prompt').hide();
    //   $('#imageholder').hide();
    //   $('#sliderBox').hide();
    //   $('#saveSlider').hide();
    //   $('#feedbackbox').show();
    //   $('#blockPlusTrial').show();
    //   timeStamps.Answer = new Date();
    //   flowControl.ReadyToAdvance = 1;
    //   // Data.responseTime[galleryCount] = getResponseTime();
    //   console.log(galleryCount, numberOfTrials);
    //   if (galleryCount == numberOfTrials) flowControl.ExperimentPart++;
    //   if (galleryCount == numberOfTrials) console.log("YESSSSS")
    // }

    function RunResponse() {
      if (flowControl.ReadyForResponse == 0) return;
      Data.response[trialCount] = $( "#slider" ).slider( "value" );
      Data.trialCount[trialCount] = trialCount + 1;
      $('#continueButton').hide();
      $('#prompt').hide();
      $('#imageholder').hide();
      $('#sliderBox').hide();
      $('#saveSlider').hide();
      $('#feedbackbox').show();
      $('#blockPlusTrial').show();
      timeStamps.Answer = new Date();
      flowControl.ReadyToAdvance = 1;
      Data.responseTime[trialCount] = getResponseTime();
      if (trialCount == numberOfTrials - 1) flowControl.ExperimentPart++;
    }

    function RunConclusion() {
      completionCode = codeGenerator();
      $('#instructions').empty();
      $('#instructions').html('Thank you for your participation.');
      $('.generatedCode').html(completionCode);
      $('#sliderBox').hide();
      $('#saveSlider').hide();
      $('#feedbackbox').hide();
      $('#continueButton').hide();
      $('#blockPlusTrial').hide();
      $('#myCarousel').hide();
      $('#instructionsbox').show();
      $('#dataSubmit').show();
      $('#dataSubmitInstructions').show();
      Data.completionCode = completionCode;
    }

    function SubmitData() {
      flowControl.ReadyToAdvance = 1;
      $('#dataSubmitInstructions').hide();
      $('#dataSubmit').hide();
      $('#completionCodeBox').show();
      $('#finalInstructions').show();
      $('#finalInstructions').html("Copy and paste this code into the Mechanical Turk Interface, where designated. <br> When you've succesfully copied your code, you may close this window at any time.")
      timeStamps.EndTime = new Date();
      Data.completionTime = getExperimentDuration();
      SaveData(Data);
    }


  </script>

</body>

</html>
