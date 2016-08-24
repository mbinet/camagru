<?php
include(getenv('DOCUMENT_ROOT') . "/resources/head.php");
include($root . "/resources/header.php");

// Gets the photo from url param id
$id_photo= $_GET['id'];

// Gets photo from db
$query = $pdo->prepare('SELECT * FROM photos WHERE id=' . $id_photo);
$query->execute();
$photo = $query->fetch();

// Assignements
$img = $photo[url];
$id_photo= $photo[id];
$id_user = $photo[id_user];
?>
<link rel="stylesheet" type="text/css" href="<?php echo getenv('root') ?>/css/photo.css">
<input type="hidden" id="id_photo_hidden" value="<?php echo $id_photo; ?>"/>
<input type="hidden" id="id_user_hidden" value="<?php echo $_SESSION[id]; ?>"/>


<div class="wrap" style="border: 1px solid black">
	
	<img class="photo" src="<?php echo $img ?>" style="vertical-align: top;">
	
	<div class="sidebar" id="sidebar">
		
		<div class="infos border">
			<b><?php echo get_name_from_id_photo($id_photo, $pdo); ?></b>
			<br />
			<span class="nb_likes" id="nb_likes" onclick="myScript()">
				<?php
					echo get_likes($id_photo, $pdo);
				?>
				like this
			</span>
		</div>
		
		<div class="comments">
			<?php
			$coms = get_comments($id_photo, $pdo);
			foreach ($coms as $com) {
				?>
				<b>
				<?php
				echo get_name_from_id_user($com[id_user], $pdo);
				?>
				</b>
				<?php
				echo $com[comment] . "<br />";
			}
			?>
		</div>
		
		<div class="like" id="like">
			<?php
			// If user already likes the photo
			if (does_like($_SESSION[id], $id_photo, $pdo)) {
				?>
				<span class="red" onclick="sendLike('<?php echo $_SESSION[id]; ?>', '<?php echo $id_photo; ?>')">
					like
				</span>
				<?php
			}
			// If he doesn't
			else {
				?>
				<span class="like" onclick="sendLike('<?php echo $_SESSION[id]; ?>', '<?php echo $id_photo; ?>')">
					like
				</span>
				<?php
			}
			?>
		</div>
		
		<div class="comment">
			<input type="text" placeholder="Add a comment..." class="input_comment" id="input_comment" autofocus/>
		</div>
		<?php if ($id_user == $_SESSION[id])
		{?>
			<div class="delete">
				<a href="/actions/delete.php/?id=<?php echo $id_photo ?>">delete</a>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php

function does_like($id_user, $id_photo, $pdo) {
	$query = $pdo->prepare('SELECT * FROM likes WHERE id_user=' . $id_user . ' AND id_photo=' . $id_photo);
// 	pr($query);
	$query->execute();
	$res = $query->fetch();
	if ($res[id_user]) {
		$ret = 1;
	}
	else {
		$ret = 0;
	}
	return ($ret);
}

function get_likes($id_photo, $pdo) {
	$query = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE id_photo=' . $id_photo);
	$query->execute();
	$res = $query->fetch();
	return $res[likes];
}

function get_comments($id_photo, $pdo) {
	$query = $pdo->prepare('SELECT * FROM comments WHERE id_photo=' . $id_photo . ' ORDER BY date DESC');
	$query->execute();
	$res = $query->fetchAll();
	return $res;
}

?>

<script type="text/javascript">

	var id_user_session = document.getElementById("id_user_hidden").value;
	var id_photo = document.getElementById("id_photo_hidden").value;
	
	function sendLike(id_user, id_photo, pdo) {
		var xhr = getXMLHttpRequest();
		
		xhr.open("POST", "/actions/sendLike.php", true); // (sMethod, sUrl, bAsync)
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // indicates that the data (POST) will be in the send element
		xhr.send("id_user=" + id_user + "&id_photo=" + id_photo);
	
		function callback(res) {
			console.log(res);
			console.warn('Sucer un pote, ça n\'a rien d\'homosexuel.')
			// window.location = "index.php";
		}
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				// alert("OK"); // C'est bon \o/
				callback(xhr.responseText);
			}
		};
		window.location = "/pages/photo.php/?id=" + id_photo;
	}
	
	
	
	// Functions about new comment
	
		// waits for user to press enter key
		var input_comment = document.getElementById("input_comment");
		input_comment.addEventListener("keydown", function (e) {
			if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
				validate();
			}
		});
		
		function validate() {
			var comment = input_comment.value;
			var xhr = getXMLHttpRequest();
			
			xhr.open("POST", "/actions/sendComment.php", true); // (sMethod, sUrl, bAsync)
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // indicates that the data (POST) will be in the send element
			xhr.send("id_user=" + id_user_session + "&id_photo=" + id_photo + "&comment=" + comment);
		
			function callback(res) {
				console.log(res);
				console.warn('Sucer un pote, ça n\'a rien d\'homosexuel.')
				// window.location = "index.php";
			}
			
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					// alert("OK"); // C'est bon \o/
					callback(xhr.responseText);
				}
			};
			
			// reset input value
			document.getElementById("input_comment").value = "";
			window.location = "/pages/photo.php/?id=" + id_photo;
		}
	
</script>