//datafunctions.js

function SaveData(data, callback) {
  if (callback) callback();
  if (workerID == pageURL || workerID == "NONE") {
    workerID = prompt("It appears you might be testing...",
    "Enter a fabricated testing ID here.")
    Data.workerID = workerID;
  }; //manual entry in case of testing.
  var stringifiedData = JSON.stringify(data);
  DataDownload(stringifiedData, workerID + 'Data', 'plain/text')
  //SendToServer(workerID, data);
}

function SendToServer(identification, curData) {
  var dataToServer = {
    'id': identification, //filename to save the data with
    'experimenter': experimenter, // experimenter folder to save it in
    'experimentName': experimentName + '/v' + version, //directory to save it in
    'curData': JSON.stringify(curData) // data to save
  };

	/* Post the data to the server, using https:// or it will fail if run
	 from within Turk: */
 $.post(server + "/turk/tools/save.php",
   dataToServer,
		// Whether the data gets saved or not, submit the form to Turk:
   function(data) {
     console.log("Data transfer success!")
     // 	document.forms[0].submit();
   }
 ).fail(function(data) {
   console.log("Data transfer failure!")
     // 	document.forms[0].submit();
 });
}

//Data Download Function

function DataDownload(strData, strFileName, strMimeType) {
    var D = document,
        A = arguments,
        a = D.createElement("a"),
        d = A[0],
        n = A[1],
        t = A[2] || "text/plain";

    //build download link:
    a.href = "data:" + strMimeType + "charset=utf-8," + escape(strData);


    if (window.MSBlobBuilder) { // IE10
        var bb = new MSBlobBuilder();
        bb.append(strData);
        return navigator.msSaveBlob(bb, strFileName);
    } /* end if(window.MSBlobBuilder) */



    if ('download' in a) { //FF20, CH19
        a.setAttribute("download", n);
        a.innerHTML = "downloading...";
        D.body.appendChild(a);
        setTimeout(function() {
            var e = D.createEvent("MouseEvents");
            e.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
            a.dispatchEvent(e);
            D.body.removeChild(a);
        }, 66);
        return true;
    }; /* end if('download' in a) */



    //do iframe dataURL download: (older W3)
    var f = D.createElement("iframe");
    D.body.appendChild(f);
    f.src = "data:" + (A[2] ? A[2] : "application/octet-stream") + (window.btoa ? ";base64" : "") + "," + (window.btoa ? window.btoa : escape)(strData);
    setTimeout(function() {
        D.body.removeChild(f);
    }, 333);
    return true;
}

//DataDownload function source:
//https://stackoverflow.com/questions/21012580/is-it-possible-to-write-data-to-file-using-only-javascript
