<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function doAct($act)
{
    $url = "";
    switch($act)
    {
        case 'def':
            $url = 'proc/getWordDef.php';break;
        case 'appsinfo':
            $url = 'infoApps.php';break;
        case 'term':
            $url = 'frmEntryTerm.php';break;
        case 'termlist':
            $url = 'frmTermList.php';break;
        case 'setapps':
            $url = 'frmConfigApp.php';break;
        case 'setusrs':
            $url = 'frmSetupUsers.php';break;
        case 'login':
            $url = "../proc/doLogin.php";break;
        case 'logout':
            $url = "../proc/doLogout.php";break;
        case 'notificon':
            $url = listNotifIcon($_GET['type']);break;
        case 'app':
            $url = 'proc/getAppGeneral.php';break;
        case 'dict':
            $url = 'proc/getSumDataDict.php';break;
        case 'list':
            $url = 'proc/getWordsData.php';break;
        case 'infoapps':
            $url = '../proc/getInfoApps.php';break;
        case 'saveinfo':
            $url = '../proc/saveInfoApps.php';break;
        case 'saveupsz':
            $url = '../proc/saveUploadSize.php';break;
        case 'saveusr':
            $url = '../proc/saveUser.php';break;
        case 'delterm':
            $url = '../proc/deleteTerm.php';break;
        case 'gettlist':
            $url = '../proc/getTermList.php';break;
        case 'ulist':
            $url = '../proc/getUserList.php';break;
        case 'uinfo':
            $url = '../proc/getUserInfo.php';break;
        default:
            $url = "404.html";break;
    }

    return $url;
}

function listNotifIcon($type)
{
    $icon = '';
    switch($type)
    {
        case 'error':
            $icon = '../images/icons/32x32/error.png';break;
        case 'exclamation':
            $icon = '../images/icons/32x32/exclamation.png';break;
        default:
            $icon = '../images/icons/32x32/info.png';break;
    }

    return $icon;
}
?>
