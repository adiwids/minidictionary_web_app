/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function initAppcPanel()
{
    goTo('appsinfo');
    getAppsConfig();
    $jq(".left-sidebar").click(
        function()
        {
            $jq(".left-sidebar").each(
                function()
                {
                    if($jq(this).hasClass("current"))
                    {
                        $jq(this).removeClass("current");
                    }
                }
            );
            $jq(this).addClass("current");
            goTo($jq(this).find("span").attr("id"));
        }
    );
}
function goTo(url)
{
    url = escape(url);
    var page = $jq.ajax(
        {
            url: '../index.php?act=' + url,
            async: false
        }
    ).responseText;

    $jq('#main-panel').load(page);
}
function logout()
{
    var doAct = $jq.ajax(
        {
            url: "index.php?act=logout",
            async: false
        }
    ).responseText;

    if(doAct != "")
    {
        $jq.ajax(
            {
                url: doAct,
                type: 'post',
                dataType: 'json',
                success: function(o)
                {
                    if(o.success)
                    {
                        alert(o.message);
                        window.location = o.redirect;
                    }
                    else
                    {
                        showNotification('exclamation', true, o.message);
                    }
                },
                error: function()
                {
                    showNotification('error', true, "Tidak dapat terhubung dengan server.");
                }
            }
        );
    }
    else
    {
        showNotification('error', true, "Tidak dapat terhubung dengan server.");
    }

    return false;
}
function getAppsConfig()
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=infoapps',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        $jq.ajax(
            {
                url: doAct,
                type: 'get',
                dataType: 'json',
                success: function(o)
                {
                    if(parseInt(o.total_rec) > 0)
                    {

                        $jq('span#owner').html(o.data.pemilik);
                        $jq('a#site-url').attr("href",o.data.site);
                        $jq('a#site-url').text(o.data.site);
                        if(o.data.logo !== null)
                        {
                            var logo = (o.data.logo).split("/");
                            var logo_src = logo[logo.length - 1];
                            $jq('#adm-logo img').attr("src","../images/uploads/" + logo_src);
                            $jq('#adm-logo img').attr("alt","../images/uploads/" + logo_src);
                        }
                        if(parseInt(o.data.showlogo) == 1)
                        {
                            $jq('div#adm-logo').css("display","block");
                        }
                        else
                        {
                            $jq('div#adm-logo').css("display","none");
                        }
                    }

                },
                error: function()
                {

                }
            }
        );
    }
}