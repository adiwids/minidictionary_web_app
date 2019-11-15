/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function initFrmUser()
{
    getGridUsers();
    $jq('#txtKeySearchUser').keyup(
        function()
        {
            getGridUsers();
        }
    );
    $jq('#chkUsrActive').change(
        function()
        {
            $jq('#chkUsrActive').val($jq('#chkUsrActive').is(':checked'));
            $jq('#chkUsrActive').attr("value",true);
        }
    );
}
function getGridUsers()
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=ulist',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        var param = '';
        if($jq('#txtKeySearchUser').val() != '')
        {
            param += 'u=' + $jq('#txtKeySearchUser').val();
        }
        $jq.ajax(
            {
                url: doAct,
                type: 'get',
                dataType: 'json',
                data: param,
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
function addUser()
{
    $jq('#txtIDUser').val('');
    $jq('#txtUserName').val('');
    $jq('#txtPass0').val('');
    $jq('#txtPass1').val('');
    $jq('#txtUserEmail').val('');
    $jq('#chkUsrActive').attr("checked",true);
    $jq('#chkUsrActive').val(true);
}
function editUser(uid)
{
    var doAct = $jq.ajax(
        {
            url: 'index.php?act=uinfo',
            async: false
        }
    ).responseText;

    if(doAct != '')
    {
        var param = '';
        if(uid != '')
        {
            param += 'uid=' + uid;
        }
        $jq.ajax(
            {
                url: doAct,
                type: 'get',
                dataType: 'json',
                data: param,
                success: function(o)
                {
                    $jq('#txtIDUser').val(o.id_user);
                    $jq('#txtUserName').val(o.username);
                    $jq('#txtPass0').val(o.password);
                    $jq('#txtPass1').val(o.password);
                    $jq('#txtUserEmail').val(o.email);
                    if(parseInt(o.active) == 1)
                    {
                        $jq('#chkUsrActive').attr("checked",true);
                        $jq('#chkUsrActive').val(true);
                    }
                    else
                    {
                        if($jq('#chkUsrActive').attr("checked") == true)
                        {
                            $jq('#chkUsrActive').removeAttr("checked");
                            $jq('#chkUsrActive').val(false);
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
function saveUserInfo()
{
    if(validateUserInfo())
    {
        toggleSaving();
        var doAct = $jq.ajax(
            {
                url: "index.php?act=saveusr",
                async: false
            }
        ).responseText;

        if(doAct != "")
        {
            /*if($jq('#chkUsrActive').is(':checked'))
            {
                $jq('#chkUsrActive').val(true);
            }
            else
            {
                $jq('#chkUsrActive').val(false);
            }*/
            var params = $jq("#frmSetUser").serialize();
            $jq.ajax(
                {
                    url: doAct,
                    data: params,
                    type: 'post',
                    dataType: 'json',
                    success: function(o)
                    {
                        toggleSaving();
                        //alert(o.message);
                        if(o.success)
                        {
                            showNotification('info', true, o.message);
                            setTimeout(
                                function()
                                {
                                    addUser();
                                    getGridUsers();
                                },3000
                            );
                        }
                        else
                        {
                            showNotification('error', true, o.message);
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

function validateUserInfo()
{
    var valid = '';

    if($jq("#txtUserName").val() == '')
    {
        showNotification('exclamation', true, "Username tidak boleh kosong.");
        $jq("#txtUserName").focus();

        valid += 'x';
        return false;
    }
    if($jq("#txtPass0").val() == '')
    {
        showNotification('exclamation', true, "Password tidak boleh kosong.");
        $jq("#txtPass0").focus();

        valid += 'x';
        return false;
    }
    else
    {
        if($jq("#txtPass1").val() != $jq("#txtPass0").val())
        {
            showNotification('exclamation', true, "Konfirmasi password tidak sama.");
            $jq("#txtPass1").focus();

            valid += 'x';
            return false;
        }
    }
    if($jq("#txtUserEmail").val() == '')
    {
        showNotification('exclamation', true, "Email user tidak boleh kosong.");
        $jq("#txtUserEmail").focus();

        valid += 'x';
        return false;
    }
    else
    {
        if(!validateEmail($jq('#txtUserEmail').val()))
        {
            showNotification('exclamation', true, "Format email salah.");
            $jq("#txtUserEmail").focus();

            valid += 'x';
            return false;
        }
    }


    if(valid == '')
    {
        return true;
    }
}
function validateEmail(email)
{
    var regexEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(regexEmail.test(email) == false)
    {
        return false;
    }
    else
    {
        return true;
    }
}