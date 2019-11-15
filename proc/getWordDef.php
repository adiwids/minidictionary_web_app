<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require '../inc/connection.php';

$w = '';
if((isset($_GET['w']) && !empty($_GET['w'])) && (isset($_GET['sessid']) && !empty($_GET['sessid'])))
{
    $w = mysql_real_escape_string($_GET['w']);
    $query = ' select * from words ';
    if(!empty($w))
    {
        if(isset($_GET['obj']) && $_GET['obj'] == 'btn')
        {
            $criteria = '';
            switch($_GET['sst'])
            {
                case '01':
                    $criteria .= ' = \''.$w.'\' ';break;
                case '02':
                    $criteria .= ' like \'%'.$w.'%\' ';break;
                case '03':
                    $criteria .= ' like \''.$w.'%\' ';break;
                case '04':
                    $criteria .= ' like \'%'.$w.'\' ';break;
            }
            $query .= ' where word'.$criteria;
        }else
        {
            $query .= ' where id_word=\''.$w.'\'';
        }
    }
    $result = mysql_query($query);
    
    if(mysql_num_rows($result) > 0)
    {
        $rec = mysql_fetch_array($result);
    }
    else
    {
        $rec = "<h3>Definisi istilah <u>".$_GET['w']."</u> tidak ditemukan.</h3>";
    }
    $response = array(
        "total_words"=>mysql_num_rows($result),
        "data"=>$rec/*,
        "query"=>$query*/
    );
    echo json_encode($response);
}
?>
