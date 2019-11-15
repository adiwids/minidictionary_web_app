/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function initWYSIWYGDefinisi()
{
    var w = document.getElementById("txtaSupp").offsetWidth;
    $jq('textarea#txtaDef').tinymce
    (
        {
            // Location of TinyMCE script
            script_url : 'lib/tinymce/jscripts/tiny_mce/tiny_mce.js',

            // General options
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,insertdate,inserttime,preview",

            /*
            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
            */
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : false,

            // Example content CSS (should be your site CSS)
            content_css : "css/content.css",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : "lists/template_list.js",
            external_link_list_url : "lists/link_list.js",
            external_image_list_url : "lists/image_list.js",
            media_external_list_url : "lists/media_list.js",

            // Replace values for the template plugin
            template_replace_values : {
                    username : "biodict-user",
                    staffid : "991234"
            },

            width: w,
            height: "300"
        }
    );
}
function initWYSIWYGTambahan()
{
    var w = document.getElementById("txtaSupp").offsetWidth;
    $jq('#txtaSupp').tinymce
    (
        {
            // Location of TinyMCE script
            script_url : 'lib/tinymce/jscripts/tiny_mce/tiny_mce.js',

            // General options
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,insertdate,inserttime,preview",

            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : false,

            // Example content CSS (should be your site CSS)
            content_css : "css/content.css",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : "lists/template_list.js",
            external_link_list_url : "lists/link_list.js",
            external_image_list_url : "lists/image_list.js",
            media_external_list_url : "lists/media_list.js",

            // Replace values for the template plugin
            template_replace_values : {
                    username : "biodict-user",
                    staffid : "991234"
            },

            width: w,
            height: "300"
        }
    );
}
function addTerm()
{
    $jq("#txtIDTerm").val('');
    $jq("#txtTerm").val('');
    $jq("#txtWordOri").val('');
    $jq("#txtRef").val('');
    $jq("#txtaDef").val('');
    $jq("#txtaSupp").val('');

    // CLEAR UPLOAD FIELD
    $jq(".cabinet").html($jq(".cabinet").html());

    $jq("#txtTerm").focus();
}

function validateEntryTerm()
{
    var valid = true;
    if($jq("#txtTerm").val() == '')
    {
        alert('Input istilah tidak boleh kosong.');
        $jq("#txtTerm").focus();

        valid = false;
        return false;
    }
    
    if($jq("#txtaDef").val() == '')
	{
		alert('Input definisi tidak boleh kosong.');
		$jq("#txtaDef").focus();

		valid = false;
		return false;
	}

	if(valid)
	{
		return true;
	}
}

function delTerm(wid)
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=delterm',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        if(confirm('Yakin menghapus istilah ' + $jq('#txtTerm').val() + ' ?') == true)
        {
            var param = '';
            if(wid != '' || wid !== null || wid !== undefined)
            {
                param += 'w=' + wid + '&sessid=' + Math.random();
            }
            $jq('div#definition').load("template.php");
            $jq.ajax(
                {
                    url: doAct,
                    type: 'post',
                    dataType: 'json',
                    data: param,
                    success: function(o)
                    {
                        alert(o.message);
                        if(o.success)
                        {
                            addTerm();
                        }
                    },
                    error: function()
                    {

                    }
                }
            );
        }
    }
}

function termImagePreview()
{
    $jq("#fGambar").change(
        function()
        {
            alert($jq("#fGambar").val());
            $jq('#term-img').attr("src",$jq("#fGambar").val());
        }
    );
}
