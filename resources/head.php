<?php
session_start();
include('functions.php');
include(getenv('DOCUMENT_ROOT') . '/config/database.php');

$root = getenv('DOCUMENT_ROOT');

$file = basename($_SERVER['PHP_SELF']);

if (!$_SESSION['login'] && $file != "galery.php" && $file != "login.php" && $file != "register.php" && $file != "recover.php" && $file != "setup.php")
{
	header('Location: /pages/login.php');
}

?>
<html>
<head>
<meta charset="UTF-8">
<title>Camagru</title>

<!-- FAVICON -->
<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
<link rel="manifest" href="img/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!-- STYlESHEETS-->
<link rel="stylesheet" type="text/css" href="<?php echo getenv('ROOT') ?>/style.css">

<!-- JAVASCRIPT -->

<script src="<?php echo getenv('ROOT') ?>/js/oXHR.js" type="text/javascript"></script>

</head>
<body>
