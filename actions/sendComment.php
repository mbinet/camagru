<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");

$id_user = $_POST["id_user"];
$id_photo = $_POST["id_photo"];
$comment = $_POST["comment"];


$query = $pdo->prepare('INSERT INTO `comments` (`id_user`, `id_photo`, `comment`) VALUES (' . $id_user . ', ' . $id_photo . ', "' . $comment . '")');
pr($query);
$query->execute();


// header('Location: /pages/photo.php/?id=' . $id_photo);

?>