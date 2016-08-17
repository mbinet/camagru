

    (function() {
    
    var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 420,
      height = 0;
    
    navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);
    
    navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
    );
    
    video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
    }, false);
    
    function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').translate(width, 0); // sets drawing cursor on top right
    canvas.getContext('2d').scale(-1, 1); // flips image horizontaly
    canvas.getContext('2d').drawImage(video, 0, 0, width, height); 
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
    
    
    
    var xhr = getXMLHttpRequest(); // (sMethod, sUrl, bAsync)
    console.warn(xhr);
    var sVar1 = encodeURIComponent(data);
    
    xhr.open("POST", "actions/data.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("raw=" + sVar1);
    
    
      function callback(res) {
        console.log(res);
        console.warn('Sucer un pote, ça n\'a rien d\'homosexuel.')
        // window.location = "index.php";
      }
      
      xhr.onreadystatechange = function() {
      	if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
      		// alert("OK"); // C'est bon \o/
      		callback(xhr.responseText);
      	}
      };
    }
    
    startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
    }, false);
})();
