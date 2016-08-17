<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");
include($root . "/resources/header.php");

// Gets every photos
$query = $pdo->prepare('SELECT * FROM photos ORDER BY id DESC');
$query->execute();
$photos = $query->fetchAll();
?>
<div class="wrap">
   <?php
      foreach ($photos as $data)
      {
         $img = $data[url];
         $id = $data[id];?>
      <a href="photo.php/?id=<?php echo $id ?>">
         <img class="photo" src="<?php echo $img?>">
      </a>
   <?php }
   ?>
</div>