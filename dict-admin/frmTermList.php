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
        <title>Daftar Istilah</title>
        <script type="text/javascript" src="js/term.list.js"></script>
    </head>
    <body>
        <div class="frmEntry">
            <form name="frmSearchTL" id="frmSearchTL" action="#" method="get">
                <fieldset>
                    <legend>Cari istilah : </legend>
                    <table>
                        <tr>
                            <td>
                                <input type="text" class="txtInput" name="txtKeySearchTL" id="txtKeySearchTL" style="width: 85%;" />
                                <input type="button" class="button" value="Cari!" onclick="getTermList()" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="grdList">
            
        </div>
        <script type="text/javascript">
            initTermList();
        </script>
    </body>
</html>
