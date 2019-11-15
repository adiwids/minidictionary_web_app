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
        <title>Form Komentar</title>
        <link rel="shortcut icon" href="http://tibandung.com/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />

        <script type="text/javascript" src="inc/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="dict-admin/lib/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/comment.js"></script>
    </head>
    <body>
        <div class="layer-modal">
            <div class="frmEntry">
                <form name="frmEntryComment" id="frmEntryComment" class="rounded10" action="#" method="post">
                    <a href="#" id="close-float-div" onclick="closeComment()"><span>Tutup</span></a><br />
                    <fieldset>
                        <legend>Komentar Anda</legend>
                        <table>
                            <tr>
                                <td class="labelComment">Nama</td>
                                <td class="labelComment">:</td>
                                <td>
                                    <input type="text" class="txtInput" name="txtNameComment" id="txtNameComment" style="width: 99%;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="labelComment">Email</td>
                                <td class="labelComment">:</td>
                                <td>
                                    <input type="text" class="txtInput" name="txtEmailComment" id="txtEmailComment" style="width: 99%;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="labelComment">Website</td>
                                <td class="labelComment">:</td>
                                <td>
                                    <input type="text" class="txtInput" name="txtWebURLComment" id="txtWebURLComment" style="width: 99%;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="labelComment">Ketik ulang Code berikut :</td>
                                <td class="labelComment">:</td>
                                <td>
                                    <!--<label class="cLabelComment">Ketik ulang Code berikut :</label><br />-->
                                    <img src="proc/captcha.php" width="60" height="30" alt="" style="float: left;margin-top: 5px;" />
                                    <input type="text" class="txtInput" name="txtCodeComment" id="txtCodeURLComment" maxlength="5" style="width: 20%;margin: 6px 0 0 5px;" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="wysiwyg">
                                    <label class="cLabelComment">Komentar</label><br />
                                    <textarea class="txtaTinymce" id="txtaKomentar"></textarea>
                                </td>
                            </tr>
                        </table>
                    </fieldset><br />
                    <input type="button" class="button" value="Submit" />
                    <input type="button" class="button" value="Reset" />
                </form>
            </div>
        </div>
    </body>
</html>
<?php
    }
    else
    {
        header("location: app_error.html");
    }
?>