<?php
include('resources/head.php');
include('resources/header.php');
// include('js/oXHR.js');

// echo phpinfo();
echo $_SESSION['id'];
if (!$_SESSION['login'])
{
	header('Location: pages/login.php');
}

?>

<link rel="stylesheet" type="text/css" href="<?php echo getenv('root') ?>/css/login.css">

<div class="wrap">
  <div>
    <img src="img/filters/windows.png" class="fdp"></img>
    <video id="video"></video>
  </div>
    <button id="startbutton">Prendre une photo</button>
    <canvas id="canvas"></canvas>
    <img src="https://placekitten.com/g/420/315" id="photo" alt="photo">
    <div class="filtersDiv">
    	<select name="" id="filterSelector" onchange="filterChange()">
			<!--<option type="radio" class="filterOption" id="filter5" value="no">#nofilter</option>-->
			<option type="radio" class="filterOption" id="filter1" value="lotus">lotus</option>
			<option type="radio" class="filterOption" id="filter2" value="dolphin">dolphin</option>
			<option type="radio" class="filterOption" id="filter3" value="heart">heart</option>
			<option type="radio" class="filterOption" id="filter4" value="windows">windows</option>
			<option type="radio" class="filterOption" id="filter5" value="swag">swag</option>
		</select>
	</div>
</div>
<div class="login">
  COUCOU LES AMIS
</div>

<script src="<?php echo getenv('root') ?>/js/photo.js" type="text/javascript"></script>
<script type="text/javascript">
	
	
	function filterChange() {
		var e = document.getElementById("filterSelector");
		var filter = e.options[e.selectedIndex].value;
		console.log(filter);
	}
</script>