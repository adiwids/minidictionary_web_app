<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
session_destroy();
$response = array(
    "success"=>true,
    "message"=>"Anda telah keluar dari Control Panel.",
    "redirect"=>"../"
);

echo json_encode($response);
?>
