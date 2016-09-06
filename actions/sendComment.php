<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");

$id_user = $_POST["id_user"];
$id_photo = $_POST["id_photo"];
$comment = $_POST["comment"];


$query = $pdo->prepare('INSERT INTO `comments` (`id_user`, `id_photo`, `comment`) VALUES (' . $id_user . ', ' . $id_photo . ', "' . $comment . '")');
pr($query);
$query->execute();


$name = get_name_from_id_photo($id_photo, $pdo);
$mail = get_mail_from_name_user($name, $pdo);

function send_mail_comment($name, $mail) {
	$to = $mail;
	$from = "noreply@cama.gru";
	$subject = "New comment - Camagru";
	$message = "Hi, " . $name . ". You've got a new comment.";
	$headers = 'From: noreply@cama.gru' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
	if (!(mail($to, $subject, $message, $headers))) {
		echo "Mail failed to send";
	}
}

// header('Location: /pages/photo.php/?id=' . $id_photo);

?>