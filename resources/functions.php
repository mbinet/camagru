<?php
// include('../config/db.php');

// var_dump with swag
function pr($data) {
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}

// Returns its ID if the user exists, 0 otherwise
function name_exists_db($name, $pdo) {
	$query = $pdo->prepare("SELECT id FROM users WHERE name='" . $name . "'");
	$query->execute();
	$res = $query->fetch();
	if ($res['id'])
		return ($res['id']);
	else
		return (0);
}

function get_name_from_id_user($id, $pdo) {
	$query = $pdo->prepare("SELECT name AS name FROM users WHERE id='" . $id . "'");
	$query->execute();
	$res = $query->fetch();
	return ($res[name]);
}

function get_name_from_id_photo($id, $pdo) {
	$query = $pdo->prepare("SELECT users.name AS name FROM users, photos WHERE photos.id='" . $id . "' AND photos.id_user = users.id");
	$query->execute();
	$res = $query->fetch();
	return ($res[name]);
}
?>