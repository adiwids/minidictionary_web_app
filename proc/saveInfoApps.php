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
$query .= ' where au.id_user=\''.$txtIDUser.'\'';
$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
{
    $query = ' update app_config set';
    $query .= ' app_name=\''.$txtAppName.'\'';
    $query .= ', app_owner=\''.$txtAppOwner.'\'';
    $query .= ', app_url=\''.$txtAppURL.'\'';
    $query .= ' where id_user=\''.$txtIDUser.'\'';
    $result = mysql_query($query);
    if(mysql_affected_rows() > 0)
    {
        $success = true;
        $msg = "Info aplikasi berhasil disimpan.";
    }
}
else
{
    $success = false;
    $msg = "Info aplikasi gagal disimpan.";
}
$response = array(
    "success"=>$success,
    "message"=>$msg,
    "redirect"=>"main.php"
);

echo json_encode($response);
?>
