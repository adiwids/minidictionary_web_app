/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function initFrmInfoApps()
{
    getAppsConfig();
    $jq('#txtMaxUploadSz').keyup(
        function()
        {
            if(isNaN($jq(this).val()))
            {
                $jq(this).val('');
            }
            else
            {
                if(parseInt($jq(this).val()) > 2000000)
                {
                    $jq(this).val(2000000);
                }
            }
        }
    );
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
                        $jq('#txtAppName').val(o.data.nama_aplikasi);
                        $jq('#txtIDUser').val(o.data.pengguna);
                        $jq('#txtIDUser2').val(o.data.pengguna);
                        $jq('#txtAppOwner').val(o.data.pemilik);
                        $jq('#txtAppURL').val(o.data.site);
                        $jq('#txtMaxUploadSz').val(o.data.max_upload_size);
                        if(o.data.logo !== null)
                        {
                            var logo = (o.data.logo).split("/");
                            var logo_src = logo[logo.length - 1];
                            $jq('#app-logo-img').attr("src","../images/uploads/" + logo_src);
                            $jq('#app-logo-img').attr("alt","../images/uploads/" + logo_src);
                        }
                        if(parseInt(o.data.showlogo) == 1)
                        {
                            $jq('#chkLogoVis').attr("checked",true);
                            $jq('#chkLogoVis').val('1');
                        }
                        else
                        {
                            if($jq('#chkLogoVis').attr("checked") == true)
                            {
                                $jq('#chkLogoVis').removeAttr("checked");
                                $jq('#chkLogoVis').val('0');
                            }
                        }
                        if(parseInt(o.data.showbtn) == 1)
                        {
                            $jq('#chkAdmBtnVis').attr("checked",true);
                            $jq('#chkAdmBtnVis').val('1');
                        }
                        else
                        {
                            if($jq('#chkAdmBtnVis').attr("checked") == true)
                            {
                                $jq('#chkAdmBtnVis').removeAttr("checked");
                                $jq('#chkAdmBtnVis').val('0');
                            }
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
function saveAppInfoConfig()
{
    if(validateInfoApps())
    {
        toggleSaving();
        var doAct = $jq.ajax(
            {
                url: "index.php?act=saveinfo",
                async: false
            }
        ).responseText;

        if(doAct != "")
        {
            var params = $jq("#frmAppInfo").serialize();
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
                                    window.location = o.redirect;
                                },5000
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

function validateInfoApps()
{
    var valid = '';

    if($jq("#txtAppName").val() == '')
    {
        showNotification('exclamation', true, "Nama aplikasi tidak boleh kosong.");
        $jq("#txtAppName").focus();

        valid += 'x';
        return false;
    }
    if($jq("#txtAppOwner").val() == '')
    {
        showNotification('exclamation', true, "Nama pemilik aplikasi tidak boleh kosong.");
        $jq("#txtAppOwner").focus();

        valid += 'x';
        return false;
    }
    if($jq("#txtAppURL").val() == '')
    {
        showNotification('exclamation', true, "URL website aplikasi tidak boleh kosong.");
        $jq("#txtAppURL").focus();

        valid += 'x';
        return false;
    }
    else
    {
        if(($jq("#txtAppURL").val()).indexOf("http://"))
        {
            $jq("#txtAppURL").val("http://" + $jq("#txtAppURL").val());
        }
    }


    if(valid == '')
    {
        return true;
    }
}
function saveMaxUploadConfig()
{
    if(validateMaxUploadSz())
    {
        toggleSaving();
        var doAct = $jq.ajax(
            {
                url: "index.php?act=saveupsz",
                async: false
            }
        ).responseText;

        if(doAct != "")
        {
            var params = 'uid=' + $jq('#txtIDUser').val() + '&sz=' + $jq('#txtMaxUploadSz').val();
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
                                    window.location = o.redirect;
                                },5000
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
function validateMaxUploadSz()
{
    var valid = '';

    if($jq("#txtMaxUploadSz").val() == '')
    {
        showNotification('exclamation', true, "Ukuran file tidak boleh kosong.");
        $jq("#txtMaxUploadSz").focus();

        valid += 'x';
        return false;
    }
    else
    {
        if(isNaN($jq("#txtMaxUploadSz").val()))
        {
            showNotification('exclamation', true, "Ukuran file hanya boleh dalam angka.");
            $jq("#txtMaxUploadSz").focus();

            valid += 'x';
            return false;
        }
    }

    if(valid == '')
    {
        return true;
    }
}