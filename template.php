<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">
        #top-row
        {
            width: 100%;
        }
        #top-left
        {
            float: left;
            width: 70%;
            height: 150px;
            font: normal 12px "Sans";
            color: #000000;
        }
        #top-left h3
        {
            font: bold 24px "Sans";
            color: #518F0F;
            margin: 10px 0 5px 10px;
        }
        div#word_ori,
        div#word_ref
        {
            font-style: italic;
            text-transform: lowercase;
            padding: 2px 0 0 3px;
        }
        #mid-row h3,
        #bottom-row h3
        {
            font: bold 18px "Sans";
            color: #518F0F;
        }
        #definisi,
        #tambahan
        {
            margin-left: 10px;
            line-height: 14px;
            font-size: 14px;
        }
        </style>
    </head>
    <body>
        <div id="top-row">
	<div id="top-left">
            <h3></h3><br />
            <b>Kata asal :</b>
            <div id="word_ori"></div><br />
            <b>Referensi :</b>
            <div id="word_ref"></div>
	</div>
	<div id="top-right">
            <img src="" alt="" width="120" height="150" id="image"/>
	</div>
        </div><br />
        <div id="mid-row">
        <h3>Definisi</h3>
        <div id="definisi"></div>
        </div>
        <div id="bottom-row">
        <h3>Tambahan</h3>
        <div id="tambahan"></div>
        </div>
    </body>
</html>
