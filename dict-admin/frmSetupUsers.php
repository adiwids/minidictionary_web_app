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
        <title>Form Set Up User</title>
        <script type="text/javascript" src="js/users.js"></script>
    </head>
    <body>
        <div id="saving" style="display: none;"><span><br />Saving</span></div>
        <div id="notification" class="bottomrounded12" style="display: none;">
            <img src="" alt="icon" width="32" height="32" />
            <p></p>
        </div>
        <div class="frmEntry">
            <form name="frmSetUser" id="frmSetUser" action="#" method="post">
                <fieldset>
                    <legend>Info User</legend>
                    <table>
                        <tr>
                            <td class="label" width="120">ID</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput ro" name="txtIDUser" id="txtIDUser" readonly="readonly" style="width: 100%;display: block;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120">Username*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput" name="txtUserName" id="txtUserName" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120">Password*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="password" class="txtInput" name="txtPass0" id="txtPass0" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120"></td>
                            <td class="label"></td>
                            <td>
                                <input type="password" class="txtInput" name="txtPass1" id="txtPass1" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120">Email*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput" name="txtUserEmail" id="txtUserEmail" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120"></td>
                            <td class="label"></td>
                            <td>
                                <input type="checkbox" class="checkbox" id="chkUsrActive" name="chkUsrActive" value="" />Aktif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">
                                <input type="button" class="button" value="Baru" onclick="addUser()" />
                                <input type="button" class="button" value="Simpan" onclick="saveUserInfo()" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="frmEntry">
            <form name="frmSearchUsr" id="frmSearchUsr" action="#" method="get">
                <fieldset>
                    <legend>Cari user : </legend>
                    <table>
                        <tr>
                            <td>
                                Username : 
                                <input type="text" class="txtInput" name="txtKeySearchUser" id="txtKeySearchUser" style="width: 75%;" />
                                <input type="button" class="button" value="Cari!" onclick="" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="grdList">

        </div>
        <script type="text/javascript">
            initFrmUser();
        </script>
    </body>
</html>