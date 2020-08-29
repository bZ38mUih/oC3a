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
        //if()
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-addPhotos.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-photoAttachForm.php");
    }elseif (isset($_POST['fieldName']) and $_POST['fieldName']=='video' and isset($_POST['fieldId']) and
        $_POST['fieldId']!=null and isset($_POST['videoName']) and $_POST['videoName']!=null){
        $appRJ->response['format']='ajax';
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/glMan-addVideo.php");
    }
    elseif($_POST['reAssignCateg'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']= null;
        $glCat_rd = array("table" => "galleryMenu_dt", "field_id" => "glCat_id");
        $glCat_rd['result']['glCat_id'] = $_POST['glCat_id'];
        $glPhoto = array("table" => "galleryPhotos_dt", "field_id" => "photo_id");
        $glPhoto['result']['photo_id'] = $_POST['photo_id'];
        if($glCat_rd = $DB->copyOne($glCat_rd)){
            if($glPhoto = $DB->copyOne($glPhoto)){
                $albumsInCateg_qry = "select * from galleryAlb_dt where glCat_id = ".$glCat_rd['result']['glCat_id'].
                    " order by albumName";
                $albumsInCateg_res = $DB->query($albumsInCateg_qry);
                while($albumsInCateg_row = $albumsInCateg_res->fetch(PDO::FETCH_ASSOC)){
                    if($albumsInCateg_row['album_id'] != $glPhoto['result']['album_id']){
                        $ajaxRes['data'] .= "<option value='".$albumsInCateg_row['album_id']."'>".
                            $albumsInCateg_row['albumName']."</option>";
                    }
                }
            }else{
                $ajaxRes['err']=1;
                $ajaxRes['data'] = "problem reAssignCateg - 2";
            }
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data'] = "problem reAssignCateg - 1";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
        //if()
        //echo "<pre>";
        //print_r($_POST);
    }elseif($_POST['reAssignPhoto']=='y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']= null;

        $glAlb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");

        $glAlb_rd['result']['album_id'] = $_POST['album_id'];
        $glPhoto = array("table" => "galleryPhotos_dt", "field_id" => "photo_id");
        $glPhoto['result']['photo_id'] = $_POST['photo_id'];

        if($glAlb_rd = $DB->copyOne($glAlb_rd)){
            if($glPhoto = $DB->copyOne($glPhoto)){
                if(rename($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto['result']['album_id']."/photoAttach/".$glPhoto['result']['photoLink'],
                    $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glAlb_rd['result']['album_id']."/photoAttach/".$glPhoto['result']['photoLink'])){
                    if(rename($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto['result']['album_id']."/photoAttach/preview/".$glPhoto['result']['photoLink'],
                        $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glAlb_rd['result']['album_id']."/photoAttach/preview/".$glPhoto['result']['photoLink'])){
                        $glPhoto['result']['album_id'] = $glAlb_rd['result']['album_id'];
                        if($DB->updateOne($glPhoto)){
                            //http://oc3a.local/gallery/glManager/editAlbum/photo?alb_id=264
                            $ajaxRes['data'] = "перемещено: <a href='/gallery/glManager/editAlbum/photo?alb_id=".
                                $glAlb_rd['result']['album_id']."'>Смотреть</a>";
                        }else{
                            $ajaxRes['err']=1;
                            $ajaxRes['data'] = "problem reAssignPhoto - update record";
                        }
                    }else{
                        $ajaxRes['err']=1;
                        $ajaxRes['data'] = "problem reAssignPhoto - copy preview";
                    }
                }else{
                    $ajaxRes['err']=1;
                    $ajaxRes['data'] = "problem reAssignPhoto - copy img ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto['result']['album_id'].
                        "/photoAttach/".$glPhoto['result']['photoLink']."   xxx   ".
                        $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glAlb_rd['result']['album_id']."/photoAttach/".$glPhoto['result']['photoLink'];
                }
            }else{
                $ajaxRes['err']=1;
                $ajaxRes['data'] = "problem reAssignPhoto - 2";
            }
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data'] = "problem reAssignPhoto - 1 - id=".$glAlb_rd['result']['album_id'];
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
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
        $Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");
        $Alb_rd['result']['album_id']=$_GET['alb_id'];
        if($Alb_rd = $DB->copyOne($Alb_rd)){
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
                        $DB->removeOne($Alb_rd);
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