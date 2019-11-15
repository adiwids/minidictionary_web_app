<?php
    session_start();

    if(isset($_SESSION['valid']) && (!empty($_SESSION['valid']) || !is_null($_SESSION['valid'])))
    {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="aplikasi kamus, kamus istilah, biologi, anatomi" />
        <meta name="author" content="Adi Widyawan - tiBandung" />
        <title>Aplikasi Kamus Biologi</title>
        <link rel="shortcut icon" href="http://tibandung.com/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.lightbox-0.5.css" />

        <script type="text/javascript" src="inc/jquery-1.4.4.min.js"></script>
        <!--<script type="text/javascript" src="inc/jquery.lightbox.js"></script>
        <script type="text/javascript" src="inc/jquery.lightbox-0.5.min.js"></script>-->
        <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/dictionary.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="app-login-bar">
                <div id="login-button">
                    <a href="#" class="admin-login" onclick="javascript: window.location = 'dict-admin/login.php';">
                        <img src="images/icons/32x32/Administrator-3-icon.png" class="rounded10" width="32" height="32" alt="" />
                    </a>
                </div>
                <!--<div id="quick-search">
                    <form name="q-search" id="frmQSearch" action="" method="get">
                        <input type="text" name="txtKeySearch" id="txtKeySearch" class="txtSearchInput rounded12" />
                    </form>
                </div>-->
                <div id="app-title-label">
                    <a href="../biodict-tiko/" class="title-label">
                        Kamus Biologi
                    </a>
                </div>
                <div class="logo-box" id="app-logo">
                    <img src="" alt="" width="100%" height="100%" />
                </div>
            </div>
            <div id="app-toolbar" class="bottomrounded12">
                <div id="left-toolbar">
                    <form name="frmMainSearch" id="frmMainSearch" action="" method="get">
                        <div id="frmUpper">
                            <!--<select name="selSearchTerm" id="selSearchTerm" class="select">
                                <option value="01">Istilah tepatnya adalah ...</option>
                                <option value="02">Istilah mengandung kata ...</option>
                                <option value="03">Di awal istilah mengandung kata ...</option>
                                <option value="04">Di akhir istilah menandung kata ...</option>
                            </select>-->
                            <input type="text" name="txtKeyMainSearch" id="txtKeyMainSearch" class="txtInput rounded12" />
                            <!--<input type="button" class="button rounded12" value="Cari arti!" onclick="searchDefinition()" />
                            <input type="button" class="button rounded12" value="Reset" onclick="resetDict()" />-->
                        </div>
                        <div id="frmLower">
                            <!--<div id="word-nav">
                                <a href="#">
                                    <img src="images/icons/32x32/left-icon.png" width="32" height="32" alt=""/>
                                </a>
                                <a href="#">
                                    <img src="images/icons/32x32/right-icon.png" width="32" height="32" alt=""/>
                                </a>
                            </div>-->
                            <input type="button" class="button rounded12" value="Cari arti!" onclick="searchDefinition()" />
                            <input type="button" class="button rounded12" value="Reset" onclick="resetDict()" />
                            <!--<input type="text" name="txtKeyMainSearch" id="txtKeyMainSearch" class="txtInput rounded12" />-->
                        </div>
                    </form>
                </div>
                <div id="mid-toolbar">
                    <table>
                        <tr>
                            <td class="label">Update terakhir</td>
                            <td class="label">:</td>
                            <td id="lblLastUpdDate"><?php echo date("d/M/Y"); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Jumlah kata</td>
                            <td class="label">:</td>
                            <td id="lblJumlahKata">x</td>
                        </tr>
                        <tr>
                            <td class="label">Kontak pengelola</td>
                            <td class="label">:</td>
                            <td id="lblKontak"><a href=""></a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="app-main-body">
                <div id="left-body">
                    <table>
                        <tr class="rowdata">
                            <td></td>
                        </tr>
                        <tr class="rowdata">
                            <td></td>
                        </tr>
                        <tr class="rowdata">
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div id="right-body">
                    <div id="definition">
                        
                    </div>
                </div>
            </div>
            <div id="footer">
                <div id="inner-footer" class="rounded12">
                    <p>
                         <span id="owner"></span> <?php echo date("Y"); ?> - <a href="" id="site-url" target="_blank"></a><!-- || Created by <img src="http://tibandung.com/images/logo_tibandung_small.png" alt="http://tibandung.com" width="22" height="13" />&nbsp;<a href="http://tibandung.com">tiBandung</a>-->
                    </p>
                    <p>
                        
                    </p>
                </div>
            </div>
        </div>
        <div class="float-div" style="display: none;"></div>
        <script type="text/javascript">
            getAppGen();
            getList();
            initDict();
            showCommentBox(100);
        </script>
    </body>
</html>
<?php
    }
    else
    {
        header("location: app_error.html");
    }
?>