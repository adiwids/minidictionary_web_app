<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
date_default_timezone_set("Asia/Jakarta");

$query = ' select * from words ';
if(isset($_GET['w']) && !empty($_GET['w']))
{
    $query .= ' where word like \'%'.$_GET['w'].'%\' and ';
}
else
{
    $query .= ' where';
}
if(isset($_SESSION['admin']) && !empty($_SESSION['admin']))
{
    $query .= ' deleted<>1 ';
    
}else
{
    $query .= ' deleted<>1 and author=\''.$_SESSION['username'].'\'';
}
$query .= ' order by word asc ';
$result = mysql_query($query);
$resp = '<table>';
$resp .= '<tr class="header">';
$resp .= '<td width="60%">Istilah</td>';
$resp .= '<td width="25%">Kata asal</td>';
$resp .= '<td width="15%">Penulis</td>';
$resp .= '</tr>';
if(mysql_num_rows($result) > 0)
{
    $i = 0;
    while($rec = mysql_fetch_array($result))
    {
        if($i % 2 == 0)
        {
            $resp .= '<tr class="rowdata light" id="'.$rec['id_word'].'" onclick="editTerm(\''.$rec['id_word'].'\')">';
        }
        else
        {
            $resp .= '<tr class="rowdata dark" id="'.$rec['id_word'].'" onclick="editTerm(\''.$rec['id_word'].'\')">';
        }
        $resp .= '<td><i>'.strtolower($rec['word']).'</i></td>';
        $resp .= '<td>'.$rec['word_origin'].'</td>';
        $resp .= '<td>'.$rec['author'].'</td>';
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
