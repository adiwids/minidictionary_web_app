<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require '../inc/connection.php';

$w = '';
if((isset($_GET['txtKeyMainSearch']) && !empty($_GET['txtKeyMainSearch'])))// && (isset($_GET['selSearchTerm']) && !empty($_GET['selSearchTerm'])))
{
    $criteria = '';
    $w = mysql_real_escape_string($_GET['txtKeyMainSearch']);
    $criteria .= ' like \'%'.$w.'%\' ';
    /*switch($_GET['selSearchTerm'])
    {
        case '01':
            $criteria .= ' = \''.$w.'\' ';break;
        case '02':
            $criteria .= ' like \'%'.$w.'%\' ';break;
        case '03':
            $criteria .= ' like \''.$w.'%\' ';break;
        case '04':
            $criteria .= ' like \'%'.$w.'\' ';break;
        default:
            $criteria .= ' = \''.$w.'\' ';break;
    }*/
}

$query = ' select * from words ';
if(!empty($criteria))
{
    $query .= ' where word'.$criteria;
    $query .= ' and ';
}
else
{
    $query .= ' where ';
}
$query .= ' deleted<>1 ';
$query .= ' order by word asc';
$result = mysql_query($query);
$resp = '<table>';
if(mysql_num_rows($result) > 0)
{
    while($rec = mysql_fetch_array($result))
    {
        $resp .= '<tr class="rowdata" id="'.$rec['id_word'].'" onclick="getDefinition(\''.$rec['id_word'].'\')">';
        $resp .= '<td><i>'.strtolower($rec['word']).'</i></td>';
        $resp .= '</tr>';
    }
}
else
{
    $resp .= '<tr class="rowdata">';
    $resp .= '<td>-</td>';
    $resp .= '</tr>';
}
$resp .= '</table>';

$response = array(
    "total_word"=>mysql_num_rows($result),
    "data"=>$resp/*,
    "query"=>$query*/
);

echo json_encode($response);
?>
