<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
date_default_timezone_set("Asia/Jakarta");

$query = ' select * from app_users ';
if(isset($_GET['u']) && !empty($_GET['u']))
{
    $query .= ' where username like \'%'.mysql_real_escape_string($_GET['u']).'%\' ';
}
$query .= ' order by username asc ';
$result = mysql_query($query);
$resp = '<table>';
$resp .= '<tr class="header">';
$resp .= '<td width="60%">Username</td>';
$resp .= '<td width="25%">Email</td>';
$resp .= '<td width="15%">Aktif</td>';
$resp .= '</tr>';
if(mysql_num_rows($result) > 0)
{
    $i = 0;
    while($rec = mysql_fetch_array($result))
    {
        if($i % 2 == 0)
        {
            $resp .= '<tr class="rowdata light" id="'.$rec['id_user'].'" onclick="editUser(\''.$rec['id_user'].'\')">';
        }
        else
        {
            $resp .= '<tr class="rowdata dark" id="'.$rec['id_user'].'" onclick="editUser(\''.$rec['id_user'].'\')">';
        }
        $resp .= '<td><i>'.strtolower($rec['username']).'</i></td>';
        $resp .= '<td>'.$rec['email'].'</td>';
        $isActive = 'No';
        if($rec['active'] == 1)
        {
            $isActive = 'Yes';
        }
        $resp .= '<td>'.$isActive.'</td>';
        $resp .= '</tr>';
    }
}
else
{
    $resp .= '<tr class="rowdata">';
    $resp .= '<td>-</td>';
    $resp .= '<td>-</td>';
    $resp .= '<td>-</td>';
    $resp .= '</tr>';
}
$resp .= '</table>';

$response = array(
    "total_rec"=>mysql_num_rows($result),
    "data"=>$resp
);

echo json_encode($response);
?>
