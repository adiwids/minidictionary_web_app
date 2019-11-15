<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
extract($_GET);
$query = "select * from words where word='".$term."'";
$result = mysql_query($result);

return mysql_num_rows($result);
?>
