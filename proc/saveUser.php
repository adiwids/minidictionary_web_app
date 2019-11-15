<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
require 'generator.php';
extract($_POST);

if(empty($txtIDUser))
{
    $id = getUserAutoNumber();
}
else
{
    $id = mysql_real_escape_string($txtIDUser);
}
$query = ' select * from app_users au';
$query .= ' where au.id_user=\''.$id.'\'';
$result = mysql_query($query);
$isActive = 0;
if(isset($chkUsrActive) && ($chkUsrActive == true || $chkUsrActive == 'on' || $chkUsrActive == '1'))
{
    $isActive = 1;
}
$added = date("Y-m-d h:i:s");
if(mysql_num_rows($result) > 0)
{
    $query = ' update app_users set';
    $query .= ' username=\''.$txtUserName.'\'';
    $query .= ', password=\''.md5($txtPass0).'\'';
    $query .= ', email=\''.$txtUserEmail.'\'';
    $query .= ', active='.$isActive;
    $query .= ' where id_user=\''.$id.'\'';
    $result = mysql_query($query);
    if(mysql_affected_rows() > 0)
    {
        $success = true;
        $msg = "Info user berhasil di-update.";
    }
}
else
{
    $query = ' insert into app_users(id_user,username,password,email,active,added) ';
    $query .= ' values(\''.$id.'\',\''.$txtUserName.'\',\''.md5($txtPass0).'\',\''.$txtUserEmail.'\','.$isActive.',\''.$added.'\')';
    $result = mysql_query($query);
    if(mysql_affected_rows() > 0)
    {
        $success = true;
        $msg = "Info user berhasil disimpan.";
    }
}
$response = array(
    "success"=>$success,
    "message"=>$msg,
    "redirect"=>"main.php"
);

echo json_encode($response);
?>
