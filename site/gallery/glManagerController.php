<?php
if($_POST){
    if(isset($_POST['flagField']) and $_POST['flagField']=='newCat'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/gallery/actions/glMan-newCat.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='newAlbum'){
        require_once($_SERVER['DOCUMENT_ROOT']."/site/gallery/actions/glMan-newAlbum.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='editCat') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-editCat_post.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='editAlbum') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-editAlbum.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='editAlbumAccess') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-editAlbumAccess.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='delAlbAttach'
        and isset($_POST['photo_id']) and $_POST['photo_id']!=null) {
        $appRJ->response['format']='ajax';
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-delPhotoAttach.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='delAlbVideoAttach'
        and isset($_POST['video_id']) and $_POST['video_id']!=null) {
        $appRJ->response['format']='ajax';
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-delVideoAttach.php");
    }
    elseif(isset($_POST['flagField']) and $_POST['flagField']=='updateAlbAttach'
        and isset($_POST['photo_id']) and $_POST['photo_id']!=null) {
        $appRJ->response['format']='ajax';
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-updatePhotoAttach.php");
    }elseif(isset($_POST['flagField']) and $_POST['flagField']=='updateVideoAttach'
        and isset($_POST['video_id']) and $_POST['video_id']!=null) {
        $appRJ->response['format']='ajax';
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-updateVideoAttach.php");
    }
    elseif (isset($_POST['cat_id']) and $_POST['cat_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-editCatImg.php");
    }
    elseif (isset($_POST['alb_id']) and $_POST['alb_id']!==null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-editAlbumImg.php");
    }
    elseif (isset($_POST['fieldName']) and $_POST['fieldName']=='alb_id' and isset($_POST['fieldId']) and
        $_POST['fieldId']!=null){
        $appRJ->response['format']='ajax';
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-addPhotos.php");
    }elseif (isset($_POST['fieldName']) and $_POST['fieldName']=='video' and isset($_POST['fieldId']) and
        $_POST['fieldId']!=null and isset($_POST['videoName']) and $_POST['videoName']!=null){
        $appRJ->response['format']='ajax';
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-addVideo.php");
    }
    else{

    }
}
elseif (isset($_GET['delAlbImg']) and $_GET['delAlbImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-delAlbImg.php");
}
elseif (isset($_GET['delCatImg']) and $_GET['delCatImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-delCatImg.php");
}
elseif (isset($_GET['mkAlias'])){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/source/accessorial_class.php");
    $appRJ->response['result'].= accessorialClass::mkAlias($_GET['mkAlias']);
}
elseif (isset($_GET['uploadAlbums'])){
    $appRJ->response['format']='ajax';
    if($_GET['uploadAlbums']!=null){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/actions/glMan-uploadAlbums.php");
    }else{
        $appRJ->response['result'].= "folder не задано";
    }
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newcat"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/gallery/views/glMan-newCat.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editcat"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-editCat_get.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="albums"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-albums.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="newalbum"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-newAlbum.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="upload"){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-uploadAlbums.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="editalbum"){
    $albErr=null;
    if(isset($_GET['alb_id']) and $_GET['alb_id']!=null){
        $Alb_rd = new recordDefault("galleryAlb_dt", "album_id");
        $Alb_rd->result['album_id']=$_GET['alb_id'];
        if($Alb_rd->copyOne()){
            if(!$appRJ->server['reqUri_expl'][4]){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-editAlbum.php");
            }
            elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'photo'){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-photoAttachments.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'video'){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-videoAttachments.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'access'){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-editAlbumAccess.php");
            }elseif (isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] == 'remove'){
                if (isset($_GET['delLikes']) and $_GET['delLikes']=='yyy'){
                    $appRJ->response['format']='ajax';
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-rmPhotoLikes.php");
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-delAlb-form.php");
                }elseif (isset($_GET['delPhotos']) and $_GET['delPhotos']=='yyy'){
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-rmPhotos.php");
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-delAlb-form.php");
                }elseif (isset($_GET["delAlbum"]) and $_GET["delAlbum"]=='yyy'){
                    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-rmAlbum.php");
                    if(!$rmRes){
                        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-delAlb-form.php");
                    }else{
                        $Alb_rd->removeOne();
                        $appRJ->response['result'].="<span class='results success'>Удаление успешно</span>";
                    }
                }
                else{
                    require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-removeAlb.php");
                }
            }
        }else{
            $appRJ->errors['request']['description']='неправильные параметры запроса alb_id';
        }
    }else{
        $appRJ->errors['request']['description']='неправильные параметры запроса alb_id NULL';
    }
}
else{
    require_once ($_SERVER['DOCUMENT_ROOT']."/site/gallery/views/glMan-defView.php");
}