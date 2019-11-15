<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
extract($_POST);

$query = ' select * from app_config ac inner join app_users au on au.id_user=ac.id_user ';
$query .= ' where au.id_user=\''.$uid.'\'';
$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
{
    $query = ' update app_config set';
    $query .= ' max_upload_size='.$sz;
    $query .= ' where id_user=\''.$uid.'\'';
    $result = mysql_query($query);
    if(mysql_affected_rows() > 0)
    {
        $success = true;
        $msg = "Info ukuran max upload berhasil disimpan.";
    }
}
else
{
    $success = false;
    $msg = "Info ukuran max upload gagal disimpan.";
}
$response = array(
    "success"=>$success,
    "message"=>$msg,
    "redirect"=>"main.php"
);

echo json_encode($response);
?>
