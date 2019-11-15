<?php
session_start();
if(file_exists('js/app.js'))
{
    $_SESSION['valid'] = md5('2011-04-30');
    if(!isset($_GET['act']) || empty($_GET['act']))
    {
        header("location: dictionary.php");
    }
    else
    {
        require 'bootstrap.php';
        echo doAct($_GET['act']);
    }
}
else
{
    header("location: app_error.html");
}
?>