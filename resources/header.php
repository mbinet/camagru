<style>
.left_panel {
    height: 100%;
    max-height: 100%;
    width: 240px;
    background-color: #2B3A42;
    /*margin-left: 0;*/
    /*float: left;*/
    position: absolute;
}

.header
{
    height: 70px;
    width: 100%;
    line-height: 70px;
    margin-left: 240px;
    background-color: #3F5765;
    box-shadow: 0 4px 2px -2px gray;
    position: absolute;
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

@media all and (max-width: 1024px)
{
    .left_panel
    {
        width: 200px;
    }
}
</style>
<div class="header">
    <div class="camagru orange">
        <a href="<?php echo getenv('root')?>" style="text-decoration:none;">
            <img src="<?php echo getenv('root') ?>/img/favicon/favicon-96x96.png" style="vertical-align: middle" width="50"></img>
            Camagru
        </a>
    </div>
</div>
<div class="left_panel">
    <div class="menu">
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