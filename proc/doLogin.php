<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../inc/connection.php';

extract($_POST);
$query = ' select id_user,username,password,CURDATE() as tgl_login from app_users ';
$query .= ' where username=\''.mysql_real_escape_string($txtUser).'\' and active=1';
$result = mysql_query($query);

if(mysql_num_rows($result) > 0)
{
    $rec = mysql_fetch_array($result);
    if(md5($txtPass) == $rec['password'])
    {
        $sessid = md5($rec['id_user'].'-'.$rec['tgl_login']);
        $_SESSION['logged'] = $sessid;
        $_SESSION['username'] = $rec['username'];
        if(substr($rec['id_user'],0,6) == 'ADMTBD')
        {
            $_SESSION['admin'] = md5($rec['id_user'].$_SERVER['REMOTE_ADDR']);
        }
        setcookie("userlog", $rec['username'], time() + 3 * 60);

        $response = array(
            "success"=>true,
            "message"=>"Selamat datang!",
            "redirect"=>"main.php"
        );
    }
    else
    {
        $response = array(
            "success"=>false,
            "message"=>"Password tidak sesuai."
        );
    }
}
else
{
    $response = array(
            "success"=>false,
            "message"=>"User tidak dikenal."
        );
}

echo json_encode($response);
?>
