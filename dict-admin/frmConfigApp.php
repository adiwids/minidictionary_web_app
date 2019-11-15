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
        <title>Form Konfigurasi Aplikasi</title>
        <script type="text/javascript" src="js/config.js"></script>
    </head>
    <body>
        <div id="saving" style="display: none;"><span><br />Saving</span></div>
        <div id="notification" class="bottomrounded12" style="display: none;">
            <img src="" alt="icon" width="32" height="32" />
            <p></p>
        </div>
        <div class="frmEntry">
            <form name="frmAppInfo" id="frmAppInfo" action="#" method="post">
                <fieldset>
                    <legend>Info Aplikasi</legend>
                    <table>
                        <tr>
                            <td class="label" width="120">Nama aplikasi*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput" name="txtAppName" id="txtAppName" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120">Pemilik aplikasi*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput ro" name="txtIDUser" id="txtIDUser" readonly="readonly" style="width: 100%;display: none;" />
                                <input type="text" class="txtInput" name="txtAppOwner" id="txtAppOwner" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label" width="120">URL aplikasi*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput" name="txtAppURL" id="txtAppURL" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">
                                <input type="button" class="button" value="Simpan" onclick="saveAppInfoConfig()" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="frmEntry">
            <form name="frmUploadSz" id="frmUploadSz" action="#" method="post">
                <fieldset>
                    <legend>Ukuran File Upload Maksimum</legend>
                    <table>
                        <tr>
                            <td class="label" width="300">MAX UPLOAD SIZE (max: 2MB)*</td>
                            <td class="label">:</td>
                            <td>
                                <input type="text" class="txtInput" name="txtMaxUploadSz" id="txtMaxUploadSz" maxlength="7" style="width: 80%;text-align: right;" />byte(s)
                            </td>
                            <td style="width: 100px;vertical-align: middle;" align="right">
                                <input type="button" class="button" value="Simpan" onclick="saveMaxUploadConfig()" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="frmEntry">
            <form name="frmLogoConf" id="frmLogoConf" enctype="multipart/form-data" action="../proc/saveLogoConf.php" method="post">
                <fieldset>
                    <legend>Setting Logo Aplikasi</legend>
                    <table>
                        <tr>
                            <td>
                                <input type="text" class="txtInput ro" name="txtIDUser2" id="txtIDUser2" readonly="readonly" style="width: 100%;display: none;" />
                                <img src="" alt="" id="app-logo-img" width="180" height="60" /><br />
                                <label class="cabinet">
                                    <span>Resolusi : 180x60 px, Max. Size: 2MB</span><br />
                                    <input type="file" id="fLogo" name="fLogo" />
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="chkLogoVis" id="chkLogoVis" class="checkbox" />Tampilkan Logo
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="chkAdmBtnVis" id="chkAdmBtnVis" class="checkbox" />Tampilkan Tombol Admin
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" class="button" value="Simpan" />
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <script type="text/javascript">
            initFrmInfoApps();
        </script>
    </body>
</html>
