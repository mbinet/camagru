<?php
include("../resources/head.php");

$raw = (isset($_POST["raw"])) ? $_POST["raw"] : NULL;
$filter_txt = (isset($_POST["filter"])) ? $_POST["filter"] : NULL;

if ($raw)
{
	save_first_photo($raw);
// 	$filter = '../img/filters/windows.png';
	$filter = get_filter($filter_txt);
	echo $filter;
	$new_image = merge_images("../img/photos/first_photo.png", $filter);
	save_final_image($new_image, $pdo);
	echo "OK";
	echo $filter;
}
else
{
	echo "FAIL";
}

function get_filter($fil) {
    if ($fil == "swag") {
        return ("../img/filters/boner.gif");
    }
    else {
        return ("../img/filters/" . $fil . ".png");
    }
}

function save_first_photo($raw) {
    list($type, $raw) = explode(';', $raw); // $type takes 'data:image/png'
    list(, $raw)      = explode(',', $raw); // base64
    $raw = str_replace(' ', '+', $raw); // We need this to get base64, because the AJAX request send spaces instead of plus.
    $raw = base64_decode($raw);
    file_put_contents('../img/photos/first_photo.png', $raw);
}


function merge_images($img1_url, $img2_url) {
    $img1 = imagecreatefrompng("$img1_url");
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
    chmod("../img/photos/", 0755);
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

?>