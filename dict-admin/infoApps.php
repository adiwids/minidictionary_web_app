<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Informasi Aplikasi</title>
        <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/infoapps.css" /> -->
        <style type="text/css">
            #content-wrapper
            {
                width: 100%;
                height: 100%;
            }
            #infoapps-header
            {
                height: 45px;
                background: #FFFFFF url('<?php getenv("DOCUMENT_ROOT"); ?>/biodict-tiko/images/bg_infoapps-header.png') top right no-repeat;
            }
            #infoapps-header h1
            {
                margin: 22px 0 0 25px;
                float: left;
                font: bold 24px "Lucida Grande";
                color: #000000;
            }
            #content
            {
                margin: 50px 20px 0 25px;
            }
            #content h2
            {
                font: bold 18px "Lucida Grande";
                color: #000000;
            }
            #content p
            {
                font: normal 14px "Sans";
                color: #808080;
            }
        </style>
    </head>
    <body>
        <div id="content-wrap">
            <div id="infoapps-header">
                <h1>
                    Selamat datang!
                </h1>
            </div>
            <div id="content">
                <h2>Overview</h2>
                <?php
                    require getenv("DOCUMENT_ROOT").'/biodict-tiko/inc/connection.php';

                    $query = ' select ac.app_name,ac.app_owner, au.email from app_config ac ';
                    $query .= ' inner join app_users au on au.id_user=ac.id_user ';
                    $query .= ' where substring(ac.id_user,1,6) = \'ADMTBD\' limit 0,1 ';
                    $result = mysql_query($query);

                    $rec = array();
                    if(mysql_num_rows($result) > 0)
                    {
                        $rec = mysql_fetch_array($result);
                    }
                ?>
                <p>
                    Aplikasi <b><?php echo $rec['app_name']; ?></b> merupakan aplikasi yang diharapkan dapat membantu mempermudah pencarian
                    istilah ilmu biologi yang dibutuhkan. Selain dalam pencarian, aplikasi ini pun memberikan fasilitas
                    untuk memperbaharui istilah-istilah ilmu Biologi karena dilengkapi dengan fasilitas
                    <a href="http://kamusbiologi.tiko-smd.com" target="_blank">administrasi</a>.
                </p>
                <table style="margin-top: 100px;">
                    <tr>
                        <td>Belong to</td>
                        <td>:</td>
                        <td id="owner"><?php echo $rec['app_owner']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td id="owner-email"><?php echo $rec['email']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
