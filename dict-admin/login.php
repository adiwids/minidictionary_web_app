<?php
/*
 * Author: freakyelf
 * Year: 2011
 * Company: tiBandung
 */

    session_start();

    if(isset($_SESSION['signed']) && !empty($_SESSION['signed']))
    {
        header("location: main.php");
    }
    else
    {
        session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dictionary Admin</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/admin-style.css" />
        <script type="text/javascript" src="../inc/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="../js/general.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div class="most-top-toolbar">
               <ul>
                    <li>
                        <a href="#" onclick="window.location = 'http://kamusbiologi.tiko-smd.com';" class="link" id="back-to"><span>&larr;ke Kamus Biologi</span></a>
                    </li>
                </ul>
            </div>
            <div id="signin">
                <form name="frmSignin" id="frmSignin" method="post" action="">
                    <fieldset class="rounded10">
                        <legend>LOG IN</legend>
                        <table>
                            <tr>
                                <td class="label">Username</td>
                                <td class="label">:</td>
                                <td>
                                    <input type="text" name="txtUser" id="txtUser" class="txtInput rounded12" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Password</td>
                                <td class="label">:</td>
                                <td>
                                    <input type="password" name="txtPass" id="txtPass" class="txtInput rounded12" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right">
                                    <input type="button" value="Log In" class="button rounded10" id="btnSignin" onclick="login()" />
                                </td>
                            </tr>
                        </table>
                        <div id="notice">
                            <!--<a href="#" class="link" title="911">Lupa password?</a>-->
                        </div>
                        <div id="loading" style="display: none;">
                            
                        </div>
                    </fieldset>
                </form>
            </div>
            <div id="notification" class="bottomrounded12" style="display: none;">
                <img src="" alt="icon" width="32" height="32" />
                <p></p>
            </div>
        </div>
        <script type="text/javascript">
            initfrmLogin();
        </script>
    </body>
</html>
<?php
    }
?>