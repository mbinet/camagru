<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db_name = "c9";
// $port = "3306";
// Create connection
// $conn = mysqli_connect($servername, $username, $password, $db_name, $port);
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check if db is created
$exists = false;
$result = mysqli_query($conn, "SHOW DATABASES");
while ($row = mysqli_fetch_array($result)) {
	if ($row['Database'] == $db_name) {
		$exists = true;
	}
}
// Create database
if ($exists == false) {
	$sql = "CREATE DATABASE " . $db_name;
	mysqli_query($conn, $sql);
}
// Connexion to db
if (!($conn = mysqli_connect($servername, $username, $password, $db_name)))
	echo mysqli_connect_error();
else {
	if (mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `orders` (`id` int(11) NOT NULL AUTO_INCREMENT, `string` text NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;")) {
		echo "Table orders crée.";
	}
	else {
		echo "eroor connarasjdnbkahjsblka";
	}
	if (mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `products` ( `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text, `infos` varchar(1024) DEFAULT NULL, `price` int(10) DEFAULT NULL, `jus` tinyint(1) DEFAULT NULL, `soda` tinyint(1) DEFAULT NULL, `photo` text, `alcool` tinyint(1) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;")) {
		echo "Table products crée.";
	}
	else {
		echo "eroor connarasjdnbkahjsblka";
	}
	if (mysqli_query($conn, "INSERT INTO `products` (`id`, `name`, `infos`, `price`, `jus`, `soda`, `photo`, `alcool`) VALUES (3, 'Fanta', 'osef', 2, 1, 1, 'ressources/fanta.png', 0), (4, 'Ice tea', NULL, 2, 1, 0, 'ressources/icetea.png', 0), (5, 'Fanta lemon', NULL, 0, 1, 1, 'ressources/fantalemon.png', 0), (6, 'Vodka', NULL, 5, 0, 0, 'ressources/vodka.png', 1), (7, 'Jack Daniels', NULL, 7, 0, 0, 'ressources/jack.png', 1), (9, 'Heineken', NULL, 3, 0, 0, 'ressources/heineken.png', 1), (10, 'Coca zero', NULL, 0, 0, 1, 'ressources/cocazero.png', 0), (11, 'Oasis', NULL, 2, 1, 1, 'ressources/oasis.png', 0), (12, 'Jus d''orange', NULL, 0, 1, 0, 'ressources/orange.png', 0), (28, 'Jus de pomme', NULL, 2, 1, 0, 'ressources/pomme.png', 0), (29, 'Desperados', NULL, 6, 0, 0, 'ressources/desperados.png', 1), (30, 'Coca cola', NULL, 2, 0, 1, 'ressources/coca.png', 0);")) {
		echo "Produits iseeres.";
	}
	else {
		echo "eroor connarasjdnbkahjsblka";
	}
	if (mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `users` (`id` int(10) NOT NULL AUTO_INCREMENT,`login` text NOT NULL,`password` varchar(150) NOT NULL,`admin` tinyint(1) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;")) {
		echo "Table users crée.";
	}
	else {
		echo "eroor connarasjdnbkahjsblka";
	}
	if (mysqli_query($conn, "INSERT INTO `users` (`id`, `login`, `password`, `admin`) VALUES(4, 'coucou', '1411077a0c1d53da29065d332c1fe59ac653dac2ee2b38a8d07fc54aa3f5f285b875071c39f06b369994d2b9b80891eb022294d6555c9d58b58f9c4fb7a776b4', NULL),(9, 'maxime', 'f91c98162afdec4e45cc93d62ccc8560c931f55f2ce9ba609f077fc679b6c5d58988f0229b9644cfd0ff25f9362a4c15cda5996a5f7b1d87028c8fad00904bfc', 1);")) {
		echo "Utilisateurs ajoutes.";
	}
	else {
		echo "eroor connarasjdnbkahjsblka";
	}
	$affich = false;
}
