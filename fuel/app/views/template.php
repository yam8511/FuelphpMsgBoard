<?php
/**
 * Created by PhpStorm.
 * User: zoular_li
 * Date: 2016/8/9
 * Time: 上午 09:38
 *
 * 由Controller_template控制總樣版
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/FuelphpMsgBoard/public/assets/img/404.png" />
    <title>Msgboard with FuelPHP</title>

    <?= Asset::css('w3.css') ?>
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-green.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
        .w3-myfont {
            font-family: "Comic Sans MS", cursive, sans-serif;
        }
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Comic Sans MS", cursive, sans-serif}
        .w3-sidenav a,.w3-sidenav h4 {font-weight:bold}

        .hint{
            color:red;
        }
    </style>
</head>
<body>
<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse  w3-animate-lef w3-pale-green" style="z-index:800;width:300px;"
     id="mySidenav"><br>
    <div class="w3-container">
        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-theme" title="close
        menu">
            <i class="fa fa-remove"></i>
        </a>
        <?= Asset::img('404.png',['class'=>'w3-round','width'=>'45%']) ?>
        <br><br>
        <h4 class="w3-padding-0"><b><?= isset($user) ? $user->name : 'Guest' ?></b></h4>
        <p class="w3-text-grey">Template by W3.CSS</p>
    </div>
    <?php $root = '/' ?>
    <a href=<?= $root ?> class="w3-padding w3-text-teal"><i class="fa fa-home w3-xlarge"></i> 留言板</a>
    <?php if($login) { ?>
        <a href="<?= $root ?>belong" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-book w3-xlarge"></i> 我的留言</a>
        <a href="<?= $root ?>logout" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-sign-out  w3-xlarge"></i> 登出</a>
    <?php }else{ ?>
        <a href="<?= $root ?>register" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-user-plus w3-xlarge"></i> 註冊</a>
        <a href="<?= $root ?>login" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-sign-in  w3-xlarge"></i> 登入</a>
    <?php } ?>

</nav>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity w3-hover-theme" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

    <!-- Header -->
    <header class="w3-container w3-theme w3-padding-32 w3-top" style="z-index:600;">
        <a href="#"><?= Asset::img('404.png',['class'=>'w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity','width'=>'65px']) ?></a>
        <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
        <h1><b>Message Board with FuelPHP</b></h1>
    </header>

    <header class="w3-container w3-theme w3-padding-32" style="z-index:600;">
        <a href="#"><?=Asset::img('404.png',['class'=>'w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity','width'=>'65px']) ?></a>
        <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
        <h1><b>Message Board with FuelPHP</b></h1>
    </header>


    <?php
    /**
     * 成功執行後，alert訊息提醒
     */
    if(Session::get_flash('success')){ ?>
        <div class="w3-round w3-pale-green">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h3><i class="fa fa-check-square-o"></i><?= Session::get_flash('success') ?></h3>
        </div>
    <?php } ?>

    <?php
    /**
     * 發生failed時，alert訊息提醒
     */
    if(Session::get_flash('failed')): ?>
        <div class="w3-round w3-pale-red">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h3><i class="fa fa-frown-o"></i><?= Session::get_flash('failed') ?></h3>
        </div>
    <?php endif; ?>

    <?php
    /**
     * 發生warning時，alert訊息提醒
     */
    if(Session::get_flash('warning')): ?>
        <div class="w3-round w3-pale-yellow">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h3><i class="fa fa-child"></i><?= Session::get_flash('warning') ?></h3>
            <a class="w3-btn w3-btn-floating  w3-pink" title="加入我們" onclick="document.getElementById('modal_register').style.display='block'"><i class="fa fa-user-plus "></i></a>
        </div>
    <?php endif; ?>

    <div class="w3-container w3-padding">
        <h1><?= $title ?></h1>
        <hr>
        <!-- Content -->
        <?= $content ?>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-4 w3-theme" >
        <div class="w3-row-padding">
                <h3>FOOTER</h3>
                <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
        </div>
    </footer>

    <!-- End page content -->
</div>

<script>
    // Script to open and close sidenav
    function w3_open() {
        document.getElementById("mySidenav").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidenav").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?= Asset::js('mouse.js') ?>
<?= Asset::js('textarea.js') ?>
</body>
</html>