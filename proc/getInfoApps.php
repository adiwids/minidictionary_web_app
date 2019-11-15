<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    header("location: ../");
}
require '../inc/connection.php';

$query = '
    select ac.app_name as nama_aplikasi,ac.app_owner as pemilik,ac.app_url as site,
    ac.app_logo as logo,ac.logo_vis as showlogo,ac.btn_admin_vis as showbtn,ac.max_upload_size,ac.id_user as pengguna
    from app_config ac
    inner join app_users au on au.id_user=ac.id_user
    where substring(ac.id_user,1,6)=\'ADMTBD\' and au.active=1
    limit 0,1
';
$result = mysql_query($query);
$rec = null;
if(mysql_num_rows($result) > 0)
{
    $rec = mysql_fetch_array($result);
}

$response = array(
    "total_rec"=>mysql_num_rows($result),
    "data"=>$rec
);

echo json_encode($response);
?>