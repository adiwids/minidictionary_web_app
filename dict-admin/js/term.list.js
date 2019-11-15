/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function initTermList()
{
    getTermList();
    $jq('#txtKeySearchTL').keyup(
        function()
        {
            getTermList();
        }
    );
}
function getTermList()
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=gettlist',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        var params = '';
        if($jq('#txtKeySearchTL').val() != '')
        {
            params = 'w=' + $jq('#txtKeySearchTL').val();
        }
        $jq.ajax(
            {
                url: doAct,
                type: 'get',
                dataType: 'json',
                data: params,
                success: function(o)
                {
                    $jq('.grdList').html(o.data);
                },
                error: function()
                {

                }
            }
        );
    }
}
function editTerm(wid)
{
    var page = $jq.ajax(
        {
            url: '../index.php?act=term',
            async: false
        }
    ).responseText;
        
    $jq(".left-sidebar").each(
        function()
        {
            if($jq(this).hasClass("current"))
            {
                $jq(this).removeClass("current");
            }
        }
    );
    $jq('#main-panel').load(page + '?wid=' + wid);
}