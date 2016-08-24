<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");
echo "coucou";
$id = $_GET[id];
$query = $pdo->prepare('DELETE FROM photos WHERE id=' . $id);
$query->execute();

$file = "../img/photos/" . $id . ".png";
echo $file;
if (unlink($file)) {
    echo "ok";
}
else {
    echo "non";
}
header('Location: /pages/galery.php');
?>