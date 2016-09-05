<?php
include('../resources/head.php');
// include('../resources/header.php');
// include('js/oXHR.js');

if (!isset($_POST['name']))
{

	?>
	
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('root') ?>/css/login.css">
	
	<div class="login_wrap">
		<div class="login">
			<?php
			if ($_GET['name']) {
				echo "<div id='wrong_password'>Wrong password </br>";
				echo "Do you wish to <a href='/actions/recover.php?name=" . $_GET['name'] . "' id='recover_button'>recover</a> it ?</div>";
			}
			if ($_GET['err'])
				echo "This login doesn't exist. You may want to <a href='register.php'>register</a>";
			?>
			<form action="login.php" method="post" >
				<input type="text" name="name" id="name" placeholder="Name" value="<?php echo $_GET['name'] ?>" required autofocus/>
				<input type="password" name="passwd" placeholder="Passwd" required/>
				<input type="submit" value="Submit"/>
			</form>
			<a href="/pages/galery.php">Check out the photos</a>
		</div>
	</div>
	<?php
}
else
{
	// name
	if (($id_user = name_exists_db($_POST['name'], $pdo)) != 0)
	{
		// passwd
		if (passwd_check_co($_POST['passwd'], $id_user, $pdo) == 1)
			connec_ok($id_user, $_POST['name']);
		else
			connec_error("passwd", $_POST['name']);
	}
	else
	{
		connec_error("passwd", "0");
	}
}


// FUNCTIONS


function passwd_check_co($passwd, $id_user, $pdo)
{
	$query = $pdo->prepare("SELECT passwd FROM users WHERE id=" . $id_user);
	$query->execute();
	$res = $query->fetch();
	if ($res['passwd'] == hash("sha256", $passwd))
		return (1);
	else
		return (0);
}

function connec_error($param, $name)
{
	if ($name == "0") {
		header('Location: login.php?err=empty' . $name);
	}
	else {
		header('Location: login.php?name=' . $name);
	}
}

function connec_ok($id, $login)
{
	$_SESSION['id'] = $id;
	$_SESSION['login'] = $login;
	header('Location: /index.php');
}

?>



<!--<script src="<?php //echo getenv('root') ?>/js/oXHR.js" type="text/javascript"></script>-->
<!--<script type="text/javascript" src="/js/recover.js"></script>-->