<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
require 'uploader.php';
date_default_timezone_set("Asia/Jakarta");

extract($_POST);

$query = ' select * from app_config where id_user=\''.$txtIDUser2.'\' ';
$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
{   
    if(isset($chkLogoVis) && $chkLogoVis == 'on')
    {
        $showlogo = 1;
    }
    else
    {
        $showlogo = 0;
    }
    if(isset($chkAdmBtnVis) && $chkAdmBtnVis == 'on')
    {
        $showbtn = 1;
    }
    else
    {
        $showbtn = 0;
    }
    $query = ' update app_config set logo_vis='.$showlogo.', btn_admin_vis='.$showbtn.' where id_user=\''.$txtIDUser2.'\' ';
    $result = mysql_query($query);
    
    if(!is_null($_FILES['fLogo']) || !empty($_FILES['fLogo']))
    {
        $m_upload = uploadLogo($txtIDUser2,$_FILES['fLogo']['name'],$_FILES['fLogo']['tmp_name']);
        if($m_upload['success'])
        {
            $response = array(
                "success"=>true,
                "message"=>"Setting aplikasi berhasil disimpan.",
                "redirect"=>"../dict-admin/main.php"
            );
        }
        else
        {
            $response = array(
                "success"=>false,
                "message"=>"Setting aplikasi gagal disimpan.",
                "redirect"=>"../dict-admin/main.php"
            );
        }
    }
}

//echo json_encode($response);
$redirect = "window.location = '".$response['redirect']."';";
echo "<script type='text/javascript'>
    alert('".$response['message']."');
    ".$redirect."
    </script>";
//print_r(error_get_last());
?>
