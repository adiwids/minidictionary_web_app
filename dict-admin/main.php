<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: login.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>cPanel | Dictionary</title>
        <link rel="shortcut icon" href="http://tibandung.com/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/admin-style.css" />
        <script type="text/javascript" src="../inc/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="lib/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="../js/general.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div class="most-top-toolbar">
                <ul>
                    <li>
                        <a href="#">
                            <span></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="panel">
                <div id="left-panel">
                    <div class="logo-box" id="adm-logo">
                        <img src="" alt="" width="180" height="60" />
                    </div>
                    <ul>
                        <li class="left-sidebar current">
                            <span id="appsinfo">Informasi Aplikasi</span>
                        </li>
                        <?php
                            if(isset($_SESSION['admin']) && !empty($_SESSION['admin']))
                            {
                        ?>
                        <li class="left-sidebar">
                            <span id="setapps">Set Up Aplikasi</span>
                        </li>
                        <?php } ?>
                        <li class="left-sidebar">
                            <span id="termlist">Daftar Istilah</span>
                        </li>
                        <li class="left-sidebar">
                            <span id="term">Entry Istilah</span>
                        </li>
                        <?php
                            if(isset($_SESSION['admin']) && !empty($_SESSION['admin']))
                            {
                        ?>
                        <li class="left-sidebar">
                            <span id="setusrs">Kelola User</span>
                        </li>
                        <?php } ?>
                    </ul>
                    <!--<p style="font: normal 11px 'Sans';color: #808080;text-align: left; margin-left: 45px;">
                        Visit <a href="http://tibandung.com" target="_blank">tibandung.com</a> for your website solutions!
                    </p>-->
                </div>
                <div id="right-panel">
                    <div id="right-top">
                        <h1>
                            Control Panel
                        </h1>
                        <div id="rtop-right">
                            Anda login sebagai <span id="spnUsername"><?php echo $_SESSION['username']; ?></span>
                            <input type="button" class="button rounded10" value="Log Out" onclick="logout()" />
                        </div>
                    </div>
                    <div id="right-bottom">
                        <div id="main-panel">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div id="notification" class="bottomrounded12" style="display: none;">
                <img src="" alt="icon" width="32" height="32" />
                <p></p>
            </div>
        </div>
        <div id="footer">
            <p>
                <span id="owner"></span> <?php echo date("Y"); ?> - <a href="" id="site-url" target="_blank"></a><!-- || Created by <img src="http://tibandung.com/images/logo_tibandung_small.png" alt="http://tibandung.com" width="22" height="13" />&nbsp;<a href="http://tibandung.com">tiBandung</a>-->
            </p>
        </div>
        <script type="text/javascript">
            initAppcPanel();
        </script>
    </body>
</html>
