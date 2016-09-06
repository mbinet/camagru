<?php
include("../resources/head.php");

// Checking #nofilter option
if (($filter = $_POST['filterSelector']) == "no") {
	echo "You need to select a filter";
	$error = true;
}
echo "HI : ";
echo $filter;
echo " :ok";

$ext = array('jpg','gif','png','jpeg');
$upload_dir = '../img';
$link = "img/filter".$_FILES[fileToUpload][name];
if(in_array(strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION)),$ext))
{
	// getting file extension
	$my_ext = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
	// getting file name
	$name = $_FILES[fileToUpload][name];
	// saving file to folder
	move_uploaded_file($_FILES[fileToUpload][tmp_name], "$upload_dir/$name");
}




$filter_txt = (isset($_POST["filterSelector"])) ? $_POST["filterSelector"] : NULL;
$filter = get_filter($filter_txt);
echo $filter;
if ($error != true)
{
	$img1 = create_from_what("../img/" . $name, $my_ext);
	// $new_image = merge_images("../img/" . $name . "", $filter);
	$new_image = merge_images($img1, $filter);
	save_final_image($new_image, $pdo);
}

function get_filter($fil) {
	if ($fil == "swag") {
		return ("../img/filters/boner.gif");
	}
	else {
		return ("../img/filters/" . $fil . ".png");
	}
}

function create_from_what($img, $ext) {
	if ($ext == "jpeg" || $ext == "jpg") {
		$res = imagecreatefromjpeg($img);
	}
	else if ($ext == "gif") {
		$res = imagecreatefromgif($img);
	}
	else if ($ext == "png") {
		$res = imagecreatefrompng($img);
	}
	return $res;
}

function merge_images($img1, $img2_url) {
	// $img1 = imagecreatefromjpeg("$img1_url");
	if (pathinfo($img2_url ,PATHINFO_EXTENSION) == "png") {
		$img2 = imagecreatefrompng("$img2_url");
	}
	else if (pathinfo($img2_url ,PATHINFO_EXTENSION) == "gif") {
		$img2 = imagecreatefromgif("$img2_url");
	}
	$img1_x = imagesx($img2); 
	$img1_y = imagesy($img2);
	if (imagecopy($img1, $img2, 0, 0, 0, 0, $img1_x, $img1_y) != TRUE)
	{
		echo 'Error while merging images';
	}
	return $img1;
}

function save_final_image($image_object, $pdo) {
	$filename = generate_file_name($pdo);
	if (imagesavealpha($image_object, TRUE) != TRUE)
	{
		echo 'Error while saving Alpha channel.';
	}
	pr("<br/><br/><br/>" . $filename);
	
	$save = "../img/photos/". $filename .".png";
	chmod("../img/photos/", 0777);
	// imagepng($my_img, $save, 0, NULL);
	
// 	if (imagepng($image_object, '../img/photos/'.$filename.'.png') != TRUE)
	if (imagepng($image_object, $save) != TRUE)
	{
		echo 'Error while saving new image.';
	}
	$path = '/img/photos/'.$filename.'.png';
	final_image_to_db($path, $pdo);
}

function generate_file_name($pdo) {
	$query = $pdo->prepare("INSERT INTO `photos` (`url`, `id_user`)
							VALUES ('in progress', 3)"); // insert a false line in order to get the right id (as its AI).
	$query->execute();
	$statement = $pdo->prepare("SELECT MAX(id) FROM photos");
	$statement->execute();
	$row = $statement->fetch();
	// echo $row[0] + 1; // Do not delete this, it's used for redirection.
	return $row[0];
}

function final_image_to_db($url, $pdo) {
	echo $_SESSION['id'];
	$query = $pdo->prepare("UPDATE `photos` SET `url` = '" . $url . "', `id_user` = " . $_SESSION['id'] . " WHERE `url` = 'in progress'");
	$query->execute();
}

header('Location: /index.php');

?>