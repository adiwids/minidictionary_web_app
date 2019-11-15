/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function initfrmLogin()
{
    showNotification('',false,'');
    $jq("#txtUser").focus();
}
function login()
{
    if(validateLogin())
    {
        toggleLoading();
        var doAct = $jq.ajax(
            {
                url: "index.php?act=login",
                async: false
            }
        ).responseText;

        if(doAct != "")
        {
            var params = $jq("#frmSignin").serialize();
            $jq.ajax(
                {
                    url: doAct,
                    data: params,
                    type: 'post',
                    dataType: 'json',
                    success: function(o)
                    {
                        toggleLoading();
                        //alert(o.message);
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
    }

    return false;
}

function validateLogin()
{
    var valid = '';

    if($jq("#txtUser").val() == '')
    {
        showNotification('exclamation', true, "Username tidak boleh kosong.");
        $jq("#txtUser").focus();

        valid += 'x';
        return false;
    }

    if($jq("#txtPass").val() == '')
    {
        showNotification('exclamation', true, "Password tidak boleh kosong.");
        $jq("#txtPass").focus();

       valid += 'x';
       return false;
    }

    if(valid == '')
    {
        return true;
    }
}

function toggleLoading()
{
    if($jq("#loading").css("display") == 'none')
    {
        $jq("#loading").fadeIn(300);//css("visibility","visible");
    }
    else
    {
        $jq("#loading").fadeOut(300);//css("visibility","hidden");
    }
}
