<?php
if(!isset($_GET['act']) || empty($_GET['act']))
{
    header("location: main.php");
}
else
{
    require '../bootstrap.php';
    doAct($_GET['act']);
}
?>