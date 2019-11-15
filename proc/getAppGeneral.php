<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require '../inc/connection.php';

$query = '
    select ac.app_name as nama_aplikasi,ac.app_owner as pemilik,au.email as kontak,ac.app_url as site,
    ac.app_logo as logo,ac.logo_vis as showlogo,ac.btn_admin_vis as showbtn
    from app_config ac
    inner join app_users au on au.id_user=ac.id_user
    where substring(ac.id_user,1,6)=\'ADMTBD\' and au.active=1
    limit 0,1
';
$result = mysql_query($query);
if(mysql_num_rows($result) != 0)
{
    $rec = mysql_fetch_array($result);
    echo json_encode($rec);
}
?>
