<?php
include("../resources/head.php");
header("Content-Type: text/plain"); // Utilisation d'un header pour spécifier le type de contenu de la page. Ici, il s'agit juste de texte brut (text/plain). 

$raw = (isset($_POST["raw"])) ? $_POST["raw"] : NULL;

if ($raw) {
	pr($pdo);
	save_first_photo($raw);
	$filter = '../img/filters/windows.png';
	$new_image = merge_images("../img/photos/first_photo.png", $filter);
	save_new_image($new_image, $pdo);
	echo "OK";
} else {
	echo "FAIL";
}

function save_first_photo($raw) {
    list($type, $raw) = explode(';', $raw); // $type takes 'data:image/png'
    list(, $raw)      = explode(',', $raw); // base64
    $raw = str_replace(' ', '+', $raw); // We need this to get base64, because the AJAX request send spaces instead of plus.
    $raw = base64_decode($raw);
    file_put_contents('../img/photos/first_photo.png', $raw);
}

function save_picture($url, $pdo) {
 $query = $pdo->prepare("INSERT INTO `photos` (`url`, `id_user`)
			VALUES ('".$url."', 3)");
	$query->execute();
  echo 'ok';
}

function merge_images($img1_url, $img2_url) {
    if (($img1 = imagecreatefrompng("$img1_url")) == FALSE) {
        echo 'Error while opening first picture';
    }
    if (($img2 = imagecreatefrompng("$img2_url")) == FALSE) {
        echo 'Error while opening second picture';
    }
    $img1_x = imagesx($img2); 
    $img1_y = imagesy($img2);
    
    if (imagecopy($img1, $img2, 0, 0, 0, 0, $img1_x, $img1_y) != TRUE) {
        echo 'Error while merging images';
    }
    return $img1;
}

function save_new_image($image_object, $pdo) {
	$filename = get_file_name($pdo);
	if (imagesavealpha($image_object, TRUE) != TRUE) {
		echo 'Error while saving Alpha channel.';
	}
	if (imagepng($image_object, '../img/photos/'.$filename.'.png') != TRUE) {
		echo 'Error while saving new image.';
	}
	$path = '/img/photos/'.$filename.'.png';
	save_picture($path, $pdo);
}

function get_file_name($pdo) {
    $statement = $pdo->prepare("SELECT MAX(id) FROM photos");
    $statement->execute();
    $row = $statement->fetch();
    echo $row[0] + 1; // Do not delete this, it's used for redirection.
    return $row[0] + 1;
}


// echo getenv('host');

?>