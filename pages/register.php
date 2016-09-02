<?php
////////////// 
// REGISTER //
//////////////

include('../resources/head.php');
if (!isset($_POST['name']))
{

	?>
	
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('root') ?>/css/login.css">
	
	<div class="login_wrap">
		<div class="login">
			<?php
			if ($_GET['err'] == "short")
				echo "Check your password. It needs at least 6 char & a digit.";
			if ($_GET['err'] == "diff")
				echo "Check your passwords. They seem to be different.";
			if ($_GET['err'] == 1) // name given and displayed in the text field
				echo "Login already exist.";
			?>
			<form action="register.php" method="post" >
				<input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name'] ?>" required autofocus/>
				<input type="text" name="mail" placeholder="Mail" value="<?php echo $_GET['mail'] ?>" required/>
				<input type="password" name="passwd1" placeholder="Passwd" required/>
				<input type="password" name="passwd2" placeholder="Passwd" required/>
				<input type="submit" value="Submit"/>
			</form>
		</div>
	</div>
	<?php
}
else
{
	// name
	if ((name_exists_db($_POST['name'], $pdo)) == 0)
	{
		// passwd
		if (passwd_check_regi($_POST['passwd1'], $_POST['passwd2'], $id_user) == 1)
			regi_ok($_POST['name'], $_POST['passwd1'], $_POST['mail'], $pdo);
	}
	else
	{
		regi_error("0");
	}
}

/////////////////
/// FUNCTIONS ///
/////////////////

function passwd_check_regi($passwd1, $passwd2, $id_user)
{
	if ($passwd1 == $passwd2)
	{
		if (strlen($passwd1) >= 6 && (preg_match('/\d/', $passwd1) != 0)) // min 6 char & a digit
		{
			return (1);
		}
		else
		{
			regi_error("short");
		}
	}
	else
	{
		regi_error("diff");
	}
}

// calls back the same page and indicates the type of error.
function regi_error($param)
{
	if ($param == "0")
		header('Location: register.php?err=1');
	else
		header('Location: register.php?err=' . $param);
}

function regi_ok($name, $passwd, $mail, $pdo)
{
	$passwd = hash("sha256", $passwd);
	$query = $pdo->prepare('INSERT INTO users (`name`, `passwd`, `mail`) VALUES ("' . $name. '", "' . $passwd . '", "' . $mail . '")');
	$query->execute();
	send_mail($name, $mail);
	
	// $_SESSION['id'] = $id;
	// $_SESSION['login'] = $login;
	header('Location: /index.php');
}

function send_mail($name, $mail) {
	$to = $mail;
	$from = "noreply@cama.gru";
	$subject = "Welcome to Camagru";
	$message = "Hi, " . $name . ". We are very pleased to welcome you to Camagru";
	$headers = 'From: noreply@cama.gru' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
	if (!(mail($to, $subject, $message, $headers))) {
		echo "Mail failed to send";
	}
}
