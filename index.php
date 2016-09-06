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
	<div class="second_panel">
		<canvas id="canvas"></canvas>
		<!--<img src="https://placekitten.com/g/420/315" id="photo" alt="photo">-->
		<form action="/actions/upload_image.php" method="post" enctype="multipart/form-data">
			
			<fieldset><legend>Pick a filter</legend>
				<p class="filtersDiv">
					<select name="filterSelector" id="filterSelector" onchange="filterChange()">
						<option type="radio" class="filterOption" id="filter5" value="no">#nofilter</option>
						<option type="radio" class="filterOption" id="filter1" value="lotus">lotus</option>
						<option type="radio" class="filterOption" id="filter2" value="dolphin">dolphin</option>
						<option type="radio" class="filterOption" id="filter3" value="heart">heart</option>
						<option type="radio" class="filterOption" id="filter4" value="windows">windows</option>
						<option type="radio" class="filterOption" id="filter5" value="swag">swag</option>
					</select>
				</p>
			</fieldset>
			
			<fieldset><legend>Upload image</legend>
				<p>
					<input type="file" name="fileToUpload" id="fileToUpload" accept="image/gif, image/jpeg, image/png" required>
					</br>
					<input type="submit" value="Use this image" name="submit">
		</form>
				</p>
			</fieldset>
			
			<fieldset><legend>Or</legend>
				<p>
					<button id="startbutton">Take a picture</button>
				</p>
			</fieldset>
	</div>
	
	<div class="side">
		<?php
		$query = $pdo->prepare('SELECT * FROM photos ORDER BY id DESC');
		$query->execute();
		$photos = $query->fetchAll();
		?>
		<!--<div class="wrap">-->
		   <?php
		      foreach ($photos as $data)
		      {
		         $img = $data[url];
		         $id = $data[id];?>
		      <a href="pages/photo.php/?id=<?php echo $id ?>">
		         <img class="photo" src="<?php echo $img?>">
		      </a>
		   <?php }
		   ?>
		<!--</div>-->
	</div>
	
</div>
<!--<div class="login">-->
<!--  COUCOU LES AMIS-->
<!--</div>-->

<script src="<?php echo getenv('root') ?>/js/photo.js" type="text/javascript"></script>
<!--<script src="<?php //echo getenv('root') ?>/js/photo_upload.js" type="text/javascript"></script>-->
<script type="text/javascript">
	
	
	function filterChange() {
		var e = document.getElementById("filterSelector");
		var filter = e.options[e.selectedIndex].value;
		console.log(filter);
	}
</script>