<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';

$query = ' select * from app_users ';
$query .= ' where id_user=\''.$_GET['uid'].'\' ';
$result = mysql_query($query);
if(mysql_num_rows($result) != 0)
{
    $rec = mysql_fetch_array($result);
    echo json_encode($rec);
}
?>
