<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");
include($root . "/resources/header.php");
?>

<div class="wrap" style="height: 85%; overflow:scroll; padding-top: 50px">
<?php

$nb_photos = get_nb_photos($pdo);
$nb_pages = ceil($nb_photos/15);
$cur_page = isset($_GET[page]) ? $_GET[page] : 1;

$photos = get_photos($cur_page, $pdo);
?>
	<div style="text-align: center">
		<p class="nav_pages">
			<?php get_nav_pages($nb_pages, $cur_page); ?>
		</p>
	</div>
	<?php
	foreach ($photos as $data) {
		$img = $data[url];
		$id = $data[id];?>
		<a href="photo.php/?id=<?php echo $id ?>">
			<img class="photo" src="<?php echo $img?>">
		</a>
	<?php }
	?>
	<div style="text-align: center">
		<p class="nav_pages">
			<?php get_nav_pages($nb_pages, $cur_page); ?>
		</p>
	</div>
</div>
<?php

// FUNCTIONS

function get_nb_photos($pdo) {
	$query = $pdo->prepare('SELECT COUNT(id) AS `res` FROM photos ORDER BY id DESC');
	$query->execute();
	$photos = $query->fetch();
	return ($photos[res]);
}

function get_photos($page, $pdo) {
	$begin = 15 * ($page - 1) ;
	$end = 15 * $page;
	$query = $pdo->prepare('SELECT * FROM photos ORDER BY id DESC LIMIT ' . $begin . ', ' . $end);
	$query->execute();
	$photos = $query->fetchAll();
	return ($photos);
}

function get_nav_pages($nb_pages, $cur_page) {
	for ($i = 1; $i <= $nb_pages; $i++) {
		if ($i != $cur_page) {
			echo "<a href='galery.php?page=" . $i . "'>" . $i . "</a> ";
		}
		else {
			echo $i . " ";
		}
	}
}