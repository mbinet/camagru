<?php
include('resources/head.php');
include('resources/header.php');
// include('js/oXHR.js');

// echo phpinfo();

if (!$_SESSION['login'])
{
	header('Location: pages/login.php');
}

?>

<link rel="stylesheet" type="text/css" href="<?php echo getenv('root') ?>/css/login.css">

<div class="wrap">
  <div>
    <img src="img/filters/windows.png" class="fdp"></img>
    <video id="video"></video>
  </div>
    <button id="startbutton">Prendre une photo</button>
    <canvas id="canvas"></canvas>
    <img src="https://placekitten.com/g/420/315" id="photo" alt="photo">
</div>
<div class="login">
  COUCOU LES AMIS
</div>

<script src="<?php echo getenv('root') ?>/js/photo.js" type="text/javascript"></script>
