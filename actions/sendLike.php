<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");

$id_user = $_POST["id_user"];
$id_photo = $_POST["id_photo"];

// Checking if this user already likes this photo.
$query = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE id_user=' . $id_user . ' AND id_photo=' . $id_photo . '');
$query->execute();
$res = $query->fetch();
// if he likes the photo, we delete the like
if ($res[likes] >= 1) {
    $query = $pdo->prepare('DELETE FROM `likes` WHERE id_user= ' . $id_user . ' AND id_photo=' . $id_photo . '');
    $query->execute();
}
// if he doesn't like it, we add the like
else {
    $query = $pdo->prepare('INSERT INTO `likes` VALUES (' . $id_user . ', ' . $id_photo . ')');
    $query->execute();
}

header('Location: /pages/photo.php/?id=' . $id_photo);

?>