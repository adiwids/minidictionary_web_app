<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require '../inc/connection.php';
date_default_timezone_set("Asia/Jakarta");

$query = '
    select count(w.id_word) as sum_word
    from words w
    where deleted<>1
';
$result = mysql_query($query);
$rec = mysql_fetch_array($result);
if(!is_null($rec['sum_word']))
{
    $sum_word = intVal($rec['sum_word']);
}
else
{
    $sum_word = 0;
}

$query = '
    select w.last_update
    from words w
    where deleted<>1
    order by w.last_update desc limit 0,1
';
$result = mysql_query($query);
$rec = mysql_fetch_array($result);
if(!is_null($rec['last_update']))
{
    $lastupdate = date_create($rec['last_update']);
    $lastupdate = date_format($lastupdate, "d/M/Y");
}
else
{
    $lastupdate = date("d/M/Y");
}

$response = array(
    "lastupd"=>$lastupdate,
    "sumwords"=>$sum_word
);
echo json_encode($response);
?>
