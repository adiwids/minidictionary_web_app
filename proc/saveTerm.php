<?php
session_start();
if(!isset($_SESSION['logged']) || empty($_SESSION['logged']) || is_null($_SESSION['logged']))
{
    session_destroy();
    header("location: ../");
}
require '../inc/connection.php';
require 'uploader.php';
require 'generator.php';
date_default_timezone_set("Asia/Jakarta");

extract($_POST);

if(empty($txtIDTerm) && !empty($txtTerm))
{
	$query = "select * from words where word='".$txtTerm."' and deleted <> 1";
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0)
	{
		$response = array(
		    "success"=>false,
		    "message"=>"Istilah ".$txtTerm." sudah ada di database.",
		    "redirect"=>"../dict-admin/main.php"
		);
		
		$redirect = "window.location = '".$response['redirect']."';";
		echo "<script type='text/javascript'>
			alert('".$response['message']."');
			".$redirect."
			</script>";
			
		exit();
	}
}

if(empty($txtIDTerm))
{
    $id = getWordAutoNumber($txtTerm);
}
else
{
    $id = mysql_real_escape_string($txtIDTerm);
}

$query = ' select * from words where id_word=\''.$id.'\'';
$result = mysql_query($query);

$lastupdate = date("Y-m-d h:i:s");
$author = $_SESSION['username'];
if(mysql_num_rows($result) > 0)
{
    $query = ' update words set';
    $query .= ' word=\''.strtolower($txtTerm).'\'';
    $query .= ', word_origin=\''.strtolower($txtWordOri).'\'';
    $query .= ', `references`=\''.strtolower($txtRef).'\'';
    $query .= ', definition=\''.$txtaDef.'\'';
    $query .= ', suplement=\''.$txtaSupp.'\'';
    $query .= ', `last_update`=\''.$lastupdate.'\'';
    $query .= ' where id_word=\''.$id.'\' and author=\''.$author.'\'';
}
else
{
    $query = ' insert into words(id_word,word,word_origin,`references`,definition,suplement,`last_update`,author,image)';
    $query .= ' values(\''.$id.'\',\''.strtolower($txtTerm).'\',\''.strtolower($txtWordOri).'\'';
    $query .= ',\''.strtolower($txtRef).'\',\''.$txtaDef.'\',\''.$txtaSupp.'\',\''.$lastupdate.'\',\''.$author.'\',\'images/uploads/bg_noimage.png\')';
}
$result = mysql_query($query);
if(mysql_affected_rows() != -1)
{
    if(!is_null($_FILES['fGambar']))
    {
        $m_upload = uploadFile($id,$_FILES['fGambar']['name'],$_FILES['fGambar']['tmp_name']);
        if($m_upload['success'])
        {
            $response = array(
                "success"=>true,
                "message"=>"Istilah ".$txtTerm." berhasil disimpan.",
                "redirect"=>"../dict-admin/main.php"
            );
        }
        else
        {
            $response = array(
                "success"=>false,
                "message"=>"Istilah ".$txtTerm." gagal disimpan.",
                "redirect"=>"../dict-admin/main.php"
            );
        }
    }
    else
    {
        $response = array(
            "success"=>true,
            "message"=>"Istilah ".$txtTerm." berhasil disimpan.",
            "redirect"=>"../dict-admin/main.php"
        );
    }
}
else
{
    $response = array(
        "success"=>false,
        "message"=>"Istilah ".$txtTerm." gagal disimpan.",
        "redirect"=>"../dict-admin/main.php"
    );
}

//echo json_encode($response);
$redirect = "window.location = '".$response['redirect']."';";
echo "<script type='text/javascript'>
    alert('".$response['message']."');
    ".$redirect."
    </script>";
?>
