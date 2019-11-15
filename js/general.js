/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$jq = jQuery.noConflict();
$jq_lb = jQuery.noConflict();
function detectBug()
{
    if(window.console && window.console.firebug != "")
        {
            alert("Disable Firebug, it may be slowing down this site.");
        }
}
function showNotification(type, visible, note)
{
    if(type != '')
    {
        /*var prevClass = $jq("#notification").attr("class");
        if(prevClass != '')
        {
            $jq("#notification").removeClass(prevClass.toString());
        }*/
        $jq("#notification").addClass(type.toString());
        $jq("#notification img").attr("src",getNotifIcon(type));
    }

    if(visible)
    {
        $jq("#notification").fadeIn(300);
        setTimeout(
            "showNotification(false, '')",3000
        );
    }
    else
    {
        $jq("#notification").fadeOut(500);
    }
    $jq("#notification p").html(note);
}
function getNotifIcon(type)
{
    var icon = $jq.ajax(
        {
            url: "index.php?act=notificon&type=" + type,
            async: false
        }
    ).responseText;

    return icon;
}
function toggleSaving()
{
    if($jq("#saving").css("display") == 'none')
    {
        $jq("#saving").fadeIn(300);//css("visibility","visible");
    }
    else
    {
        $jq("#saving").fadeOut(300);//css("visibility","hidden");
    }
}