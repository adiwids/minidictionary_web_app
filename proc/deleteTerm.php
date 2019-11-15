<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
require 'uploader.php';
require 'generator.php';
date_default_timezone_set("Asia/Jakarta");

extract($_POST);
$id = mysql_real_escape_string($w);

$query = ' select * from words where id_word=\''.$id.'\'';
$result = mysql_query($query);

$lastupdate = date("Y-m-d h:i:s");
$author = $_SESSION['username'];
if(mysql_num_rows($result) > 0)
{
    $query = ' update words set';
    $query .= ' deleted=1';
    $query .= ' where id_word=\''.$id.'\'';
    if(!isset($_SESSION['admin']) || empty($_SESSION['admin']))
    {
        $query .= ' and author=\''.$author.'\'';
    }
    $result = mysql_query($query);
    if(mysql_affected_rows() != -1)
    {
        $success = true;
        $msg = "Istilah berhasil dihapus.";
    }
    else
    {
        $success = false;
        $msg = "Istilah gagal dihapus.";
    }
}
else
{
    $success = false;
    $msg = "Istilah tidak tersedia.";
}

$response = array(
    "success"=>$success,
    "message"=>$msg
);

echo json_encode($response);
?>
