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
        <title>Form Entry Istilah</title>
        <!-- <script type="text/javascript" src="lib/si.files.js"></script> -->
        <script type="text/javascript" src="js/term.js"></script>
    </head>
    <body>
        <!--<div id="wrapper">-->
            <div class="info-panel">
                <fieldset>
                    <legend>Informasi Istilah</legend>
                    <?php
                        require '../inc/connection.php';

                        $query = ' select distinct w.id_word,w.author ';
                        $query .= ' from words w inner join app_users au on au.username=w.author ';
                        $query .= ' where deleted<>1 ';
                        $query .= ' order by w.author';
                        $result = mysql_query($query);
                        $nTerm = 0;
                        $nAuthor = 0;
                        if(mysql_num_rows($result))
                        {
                            while($rs = mysql_fetch_array($result))
                            {
                                $recWord[] = $rs['id_word'];
                                $recAuth[] = $rs['author'];
                            }
                            $nTerm = mysql_num_rows($result);
                            $nAuthor = count(array_unique($recAuth));
                        }
                    ?>
                    <table>
                        <tr>
                            <td class="label" width="150">Istilah tersedia</td>
                            <td class="label" width="5">:</td>
                            <td class="info-value" id="nTerm"><?php echo $nTerm; ?></td>
                        </tr>
                        <tr>
                            <td class="label" width="150">Penulis Aktif</td>
                            <td class="label" width="5">:</td>
                            <td class="info-value" id="nAuthor"><?php echo $nAuthor; ?></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <div class="frmEntry">
                <?php
                    $rec = null;
                    if(isset($_GET['wid']))
                    {
                        if(!empty($_GET['wid']) || !is_null($_GET['wid']))
                        {
                            $query = ' select * from words ';
                            $query .= ' where id_word=\''.$_GET['wid'].'\'';
                            $result = mysql_query($query);
                            $rec = mysql_fetch_array($result);

                            $image = explode("/",$rec['image']);
                            $img_src = $image[sizeof($image) - 1];
                            if(empty($img_src))
                            {
                                $img_src = 'bg_noimage.png';
                            }
                        }
                    }
                ?>
                <form name="frmEntryTerm" id="frmEntryTerm" enctype="multipart/form-data"  action="../proc/saveTerm.php" method="post" onsubmit="return validateEntryTerm()">
                    <div class="form-toolbar">
                        <ul>
                            <li>
                                <!--<a href="#" class="btn add" onclick="addTerm()">
                                    <span>Baru</span>
                                </a>-->
                                <input type="button" value="Baru" class="button add" onclick="addTerm()" />
                            </li>
                            <li>
                                <!--<a href="#" class="btn save" onclick="saveTerm()">
                                    <span>Simpan</span>
                                </a>-->
                                <input type="submit" value="Simpan" class="button save" />
                            </li>
                            <li>
                                <!--<a href="#" class="btn delete" onclick="delTerm($jq('#txtIDTerm').val())">
                                    <span>Hapus</span>
                                </a>-->
                                <input type="button" value="Hapus" class="button delete" onclick="delTerm($jq('#txtIDTerm').val())" />
                            </li>
                        </ul>
                    </div>
                    <fieldset>
                        <legend>Entry Istilah</legend>
                        <table>
                            <tr>
                                <td colspan="3" align="left">
                                    <img src="../images/uploads/<?php echo $img_src; ?>" width="120" height="150" alt="<?php echo $rec['image']; ?>" id="term-img" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="120">Gambar</td>
                                <td class="label">:</td>
                                <td>
                                    <label class="cabinet">
                                        <input type="file" class="fGambar" name="fGambar" id="fGambar" style="width: 50%;" />
                                    </label>
                                    <span class="entry-clue">Filesize max. 100KB</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="120">ID</td>
                                <td class="label">:</td>
                                <td>
                                    <input type="text" class="txtInput ro" name="txtIDTerm" id="txtIDTerm" readonly="readonly" style="width: 60%;" value="<?php echo $rec['id_word']; ?>"/>
                                    <span class="entry-clue"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="120">Istilah*</td>
                                <td class="label">:</td>
                                <td>
                                    <input type="text" class="txtInput" name="txtTerm" id="txtTerm" style="width: 100%;" value="<?php echo $rec['word']; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="120">Asal kata</td>
                                <td class="label">:</td>
                                <td>
                                    <input type="text" class="txtInput" name="txtWordOri" id="txtWordOri" style="width: 70%;" value="<?php echo $rec['word_origin']; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="label" width="120">Referensi</td>
                                <td class="label">:</td>
                                <td>
                                    <input type="text" class="txtInput" name="txtRef" id="txtRef" style="width: 100%;" value="<?php echo $rec['references']; ?>" />
                                    <span class="entry-clue"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="wysiwyg">
                                    <label for="txtaDef" class="cLabel">Definisi*</label><br />
                                    <textarea class="txtaTinymce" id="txtaDef" name="txtaDef"><?php echo $rec['definition']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="wysiwyg">
                                    <label for="txtaSupp" class="cLabel">Tambahan</label><br />
                                    <textarea class="txtaTinymce" id="txtaSupp" name="txtaSupp"><?php echo $rec['suplement']; ?></textarea>
                                </td>
                            </tr>
                            
                        </table>
                    </fieldset>
                </form>
            </div>
        <div class="grid-data">
            
        </div>
        <!-- </div> -->
        <script type="text/javascript">
            initWYSIWYGDefinisi();
            initWYSIWYGTambahan();
        </script>
    </body>
</html>
