/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getList()
{
     var doAct = $jq.ajax(
        {
            url: 'index.php?act=list',
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
                    $jq('div#left-body').html(o.data);
                },
                error: function()
                {

                }
            }
        );
    }
}
function searchDefinition()
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=def',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        var w = $jq('#txtKeyMainSearch').val();
        var sst = '01';//$jq('#selSearchTerm').val();
        var param = '';
        if(w != '' || w !== null || w !== undefined)
        {
            param += 'w=' + w + '&obj=btn&sst=' + sst + '&sessid=' + Math.random();
        }
        $jq('div#definition').load("template.php");
        $jq.ajax(
            {
                url: doAct,
                type: 'get',
                dataType: 'json',
                data: param,
                success: function(o)
                {
                    $jq('#txtKeyMainSearch').val((o.data.word).toLowerCase());
                    if(parseInt(o.total_words) > 0)
                    {
                        $jq('div#top-row h3').text(o.data.word);
                        $jq('div#word_ori').text(o.data.word_origin);
                        $jq('div#word_ref').text(o.data.references);
                        var image = (o.data.image).split("/");
                        var img_src = image[image.length - 1];
                        $jq('div#top-right img').attr("src","images/uploads/" + img_src);
                        $jq('div#definisi').html(o.data.definition);
                        $jq('div#tambahan').html(o.data.suplement);
                    }
                    else
                    {
                        $jq('#definition').html('');
                        $jq('#definition').html(o.data);
                    }
                },
                error: function()
                {

                }
            }
        );
    }
}
function getDefinition(wid)
{
    clearWLCurrent();
    $jq('.rowdata').each(
        function()
        {
            if($jq(this).attr("id") == wid)
            {
                $jq(this).addClass("current");
            }
        }
    );
    
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=def',
            async: false
        }
    ).responseText;

    if(doAct != '')
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
                type: 'get',
                dataType: 'json',
                data: param,
                success: function(o)
                {
                    if(parseInt(o.total_words) > 0)
                    {
                        $jq('#txtKeyMainSearch').val((o.data.word).toLowerCase());
                        $jq('div#top-row h3').text(o.data.word);
                        $jq('div#word_ori').text(o.data.word_origin);
                        $jq('div#word_ref').text(o.data.references);
                        var image = (o.data.image).split("/");
                        var img_src = image[image.length - 1];
                        $jq('div#top-right img').attr("src","images/uploads/" + img_src);
                        $jq('div#definisi').html(o.data.definition);
                        $jq('div#tambahan').html(o.data.suplement);
                    }
                    else
                    {
                        $jq('#definition').html(o.data);
                    }
                },
                error: function()
                {

                }
            }
        );
    }
}
function RefreshList()
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=list',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        var params = $jq('form#frmMainSearch').serialize();
        $jq.ajax(
            {
                url: doAct,
                type: 'get',
                dataType: 'json',
                data: params,
                success: function(o)
                {
                    $jq('div#left-body').html(o.data);
                },
                error: function()
                {

                }
            }
        );
    }
}
function initDict()
{
    var page = $jq.ajax(
        {
            url: 'index.php?act=appsinfo',
            async: false
        }
    ).responseText;
    $jq('#definition').load('dict-admin/' + page);
    
    $jq('#txtKeyMainSearch').keyup(
        function()
        {
            //RefreshList();
        }
    );
    $jq('#txtKeyMainSearch').keypress(
        function(e)
        {
            if(e.keyCode == 13)
            {
                RefreshList();
                searchDefinition();
                return false;
            }
        }
    );
    $jq('#selSearchTerm').click(
        function()
        {
            RefreshList();
        }
    );
        showCommentBox(100);
}
function clearWLCurrent()
{
    $jq('.rowdata').each(
        function()
        {
            if($jq(this).hasClass("current"))
            {
                $jq(this).removeClass("current");
            }
        }
    );
}
function resetDict()
{
    $jq('#txtKeyMainSearch').val('');
    RefreshList();

    $jq('#selSearchTerm option').each(
        function()
        {
            if($jq(this).attr("selected") == 'selected')
            {
                $jq(this).removeAttr("selected");
            }
            if($jq(this).val() == '01')
            {
                $jq(this).attr("selected","selected");
            }
        }
    );
    initDict();
}