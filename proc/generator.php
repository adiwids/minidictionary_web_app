<?php
//session_start();
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getWordAutoNumber($word)
{
    if(!empty($word))
    {
        $prefix = getWordIDPrefix($word);
        $padPrefix = sprintf("%05s",$prefix['letter']);
        $criteria = ' where substring(id_word,1,5)=\''.$padPrefix.'\' ';
    }
    $query = ' select id_word from words ';
    if(!empty($criteria))
    {
        $query .= $criteria;
    }
    $query .= 'order by id_word desc limit 0,1 ';
    $result = mysql_query($query);
    if(mysql_num_rows($result) != 0)
    {
        $rec = mysql_fetch_array($result);
        $num = substr($rec['id_word'],5,strlen($rec['id_word']) - 5);
        $num = intVal($num);

        $newID = $padPrefix.sprintf("%010s", $num + 1);
    }
    else
    {
        $newID = $padPrefix.sprintf("%010s", 1);
    }

    return $newID;
}
function getWordIDPrefix($word)
{
    $letter = '';
    $tmpWord = strtolower($word);
    $arrWord = explode(" ", $tmpWord);
    foreach($arrWord as $word)
    {
        $letter .= substr($word,0,1);
    }

    $retVal = array(
        "letter"=>strtoupper($letter),
        "length"=>strlen($letter)
    );

    return $retVal;
}
function getUserAutoNumber()
{
    $padPrefix = 'USR';
    $query = ' select id_user from app_users ';
    $query .= ' where substring(id_user,1,3)=\'USR\' ';
    $query .= ' order by id_user desc limit 0,1 ';
    $result = mysql_query($query);
    if(mysql_num_rows($result) != 0)
    {
        $rec = mysql_fetch_array($result);
        $num = substr($rec['id_user'],3,strlen($rec['id_user']) - 3);
        $num = intVal($num);

        $newID = $padPrefix.sprintf("%07s", $num + 1);
    }
    else
    {
        $newID = $padPrefix.sprintf("%07s", 1);
    }

    return $newID;
}
function generateCaptchaImage()
{
    $constants = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,";
    $rand_cod = substr(str_shuffle($constants),0,5);
    $image = imagecreatefromjpeg("../images/c.jpg");
    $textColor = imagecolorallocate ($image, 0, 0, 0); //black
    imagestring ($image, 5, 5, 8, $random, $textColor);
    $_SESSION['img_capctha'] = md5($rand_cod);
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);
}
?>
