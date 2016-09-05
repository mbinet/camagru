(function() {
var recover_button  = document.querySelector('#recover_button');

function recover() {
	var xhr = getXMLHttpRequest();
	var sVar1 = document.getElementById("name").value;
	
	xhr.open("POST", "/actions/data.php", true); // (sMethod, sUrl, bAsync)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("name=" + sVar1);
	
	function callback(res) {
// 		console.log(res); // LOGGING FUCKK ASDJNAKS CURRENT PAGE
		console.log("pute txt");
		// omg = document.getElementById("wrong_password");
		// console.log(omg);
		// omg.innerHTML = "We've sent you a new passord, check your emails.";
// 			window.location = "index.php";
	}
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
		    // console.warn("c'est bon \\o/");
		    // console.warn(xhr.responseText);
			callback(xhr.responseText);
		}
	};
}

recover_button.addEventListener('click', function(ev){
	recover();
    ev.preventDefault();
}, false);
})();
