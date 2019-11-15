<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define("UPLOAD_PATH","../images/uploads/");
define("IMAGE_PATH",getenv("DOCUMENT_ROOT")."/biodict-tiko/images/uploads/");
function uploadFile($id,$file,$tmpfile)
{
    $valid_ext = array("jpeg","jpg","png","bmp","gif");
    $file_ext = substr($file,strpos($file,".") + 1,strlen($file) - (strpos($file,".") + 1));
    if(is_numeric(array_search($file_ext, $valid_ext)))
    {
        if(@filesize($file) <= getMaxUploadSize())
        {
            if(is_dir(UPLOAD_PATH))
            {
                $upload_path = UPLOAD_PATH.$id.'_'.$file;
                $img_path = IMAGE_PATH.$id.'_'.$file;
                if(move_uploaded_file($tmpfile, $upload_path))
                {
                    $m_savepath = savePath($id,$img_path);
                    if($m_savepath['success'])
                    {
                        $success = true;
                        $msg = 'URL gambar berhasil disimpan.';
                    }
                    else
                    {
                        $success = false;
                        $msg = 'URL gambar gagal disimpan.';
                    }
                }
                else
                {
                    $success = false;
                    $msg = 'Gambar gagal di-upload.';
                }
            }
            else
            {
                $success = false;
                $msg = 'Space upload tidak tersedia.';
            }
        }
        else
        {
            $success = false;
            $msg = 'Ukuran gambar melebihi batas.';
        }
    }
    else
    {
        $f = '';
        foreach($valid_ext as $v)
        {
            if($f != '')
            {
                $f .= ', ';
            }
            $f .= '*.'.$v;
        }
        $success = false;
        $msg = 'Tipe file yang diperbolehkan hanya '.$f;
    }

    $response = array(
        "success"=>$success,
        "message"=>$msg
    );

    return json_encode($response);
}
function getMaxUploadSize()
{
   $MAX_UPLOAD_SIZE = 100*(10^3); // 100KB default
   $query = ' select max_upload_size from app_config ';
   $result = mysql_query($query);
   if(mysql_num_rows($result) > 0)
   {
       $rec = mysql_fetch_array($result);
       $MAX_UPLOAD_SIZE = intVal($rec['max_upload_size']);
   }

   return $MAX_UPLOAD_SIZE;
}
function savePath($id,$path)
{
    $query = ' select * from words where id_word=\''.$id.'\' ';
    $result = mysql_query($query);
    if(mysql_num_rows($result) > 0)
    {
        $query = ' update words set image=\''.$path.'\' where id_word=\''.$id.'\'';
        $result = mysql_query($query);
        if(mysql_affected_rows() > 0)
        {
            $response = array(
                "success"=>true,
                "message"=>error_get_last()
            );
        }
        else
        {
            $response = array(
                "success"=>false,
                "message"=>error_get_last()
            );
        }
    }
    else
    {
        $response = array(
            "success"=>false,
            "message"=>error_get_last()
        );
    }

    return $response;
}
function uploadLogo($id,$file,$tmpfile)
{
    $valid_ext = array("jpeg","jpg","png","bmp","gif");
    $file_ext = substr($file,strpos($file,".") + 1,strlen($file) - (strpos($file,".") + 1));
    if(is_numeric(array_search($file_ext, $valid_ext)))
    {
        if(@filesize($file) <= getMaxUploadSize())
        {
            if(is_dir(UPLOAD_PATH))
            {
                $upload_path = UPLOAD_PATH.$id.'_'.$file;
                $img_path = IMAGE_PATH.$id.'_'.$file;
                if(move_uploaded_file($tmpfile, $upload_path))
                {
                    $m_savepath = savePathLogo($id,$img_path);
                    if($m_savepath['success'])
                    {
                        $success = true;
                        $msg = 'URL gambar berhasil disimpan.';
                    }
                    else
                    {
                        $success = false;
                        $msg = 'URL gambar gagal disimpan.';
                    }
                }
                else
                {
                    $success = false;
                    $msg = 'Gambar gagal di-upload.';
                }
            }
            else
            {
                $success = false;
                $msg = 'Space upload tidak tersedia.';
            }
        }
        else
        {
            $success = false;
            $msg = 'Ukuran gambar melebihi batas.';
        }
    }
    else
    {
        $f = '';
        foreach($valid_ext as $v)
        {
            if($f != '')
            {
                $f .= ', ';
            }
            $f .= '*.'.$v;
        }
        $success = false;
        $msg = 'Tipe file yang diperbolehkan hanya '.$f;
    }

    $response = array(
        "success"=>$success,
        "message"=>$msg
    );

    return json_encode($response);
}
function savePathLogo($id,$path)
{
    $query = ' select * from app_config where id_user=\''.$id.'\' ';
    $result = mysql_query($query);
    if(mysql_num_rows($result) > 0)
    {
        $query = ' update app_config set app_logo=\''.$path.'\' where id_user=\''.$id.'\'';
        $result = mysql_query($query);
        if(mysql_affected_rows() > 0)
        {
            $response = array(
                "success"=>true,
                "message"=>error_get_last()
            );
        }
        else
        {
            $response = array(
                "success"=>false,
                "message"=>error_get_last()
            );
        }
    }
    else
    {
        $response = array(
            "success"=>false,
            "message"=>error_get_last()
        );
    }

    return $response;
}
?>
