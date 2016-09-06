<!-- RECOVER.PHP -->

<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");

$name = $_GET[name];
$new_pass = randomPassword();
$new_pass_db = hash("sha256", $new_pass);
$mail = get_mail_from_name_user($name, $pdo);


$query = $pdo->prepare("UPDATE users SET passwd = '" . $new_pass_db . "' WHERE name= '" . $name . "'");
$query->execute();
send_mail_pass($name, $mail, $new_pass);
echo $new_pass;
echo "We've sent you a new passord, check your emails.";

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function send_mail_pass($name, $mail, $new_pass) {
	$to = $mail;
	$from = "noreply@cama.gru";
	$subject = "Your new passord - Camagru";
	$message = "Hi, " . $name . ". Here is your new password : " . $new_pass . " ";
	$headers = 'From: noreply@cama.gru' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
	if (!(mail($to, $subject, $message, $headers))) {
		echo "Mail failed to send";
	}
}
?>