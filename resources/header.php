<style>
.left_panel {
	height: 100%;
	max-height: 100%;
	background-color: #2B3A42;
	width: 240px;
	/*margin-left: 0;*/
	/*float: left;*/
	position: absolute;
}

.header
{
	height: 70px;
	line-height: 70px;
	margin-left: 240px;
	background-color: #3F5765;
	box-shadow: 0 4px 2px -2px gray;
}

.camagru
{
	margin: 0;
	margin-left: 40px;
	font-size: 1.4vw;
	color: #EFEFEF;
	letter-spacing: 1px;
}

a
{
	color: white;
}

.logout
{
	float: right;
	padding-right: 20px;
	/*text-align: right;*/
	/*display: inline-block;*/
}

@media all and (max-width: 1024px)
{
	.left_panel
	{
		width: 200px;
	}
}

</style>
<div class="left_panel">
	<div class="menu">
		Bonjour <?php echo $_SESSION['login'] ?>
		<ul>
			<li>
				<a href="<?php echo getenv('root') ?>/">Accueil</a>
			</li>
			<li>
				<a href="<?php echo getenv('root') ?>/pages/galery.php">Galery</a>
			</li>
		</ul>
	</div>
</div>
<div class="header">
	<div class="camagru orange">
		<a href="<?php echo getenv('root')?>" style="text-decoration:none;">
			<img src="<?php echo getenv('root') ?>/img/favicon/favicon-96x96.png" style="vertical-align: middle" width="50"></img>
			Camagru
		</a>
		<div class="logout">
			<a href="/resources/logout.php">logout</a>
		</div>
	</div>
</div>
