<?php
/*
$selectAlbums_txt = "select galleryMenu_dt.catName, galleryMenu_dt.catAlias, galleryMenu_dt.glCat_id,".
    "galleryMenu_dt.catImg, galleryMenu_dt.catActive, galleryMenu_dt.catDescr, ".
    "galleryAlb_dt.album_id, galleryAlb_dt.albumName, galleryAlb_dt.transAlbImg, ".
    "galleryAlb_dt.albumAlias, galleryAlb_dt.albumImg, galleryAlb_dt.dateOfCr, ".
    "galleryAlb_dt.metaDescr, galleryAlb_dt.readRule, COUNT(galleryPhotos_dt.photo_id) as phQty from galleryMenu_dt ".
    "INNER JOIN galleryAlb_dt ON galleryMenu_dt.glCat_id = galleryAlb_dt.glCat_id ".
    "INNER JOIN galleryPhotos_dt ON galleryAlb_dt.album_id = galleryPhotos_dt.album_id ".
    "WHERE galleryAlb_dt.activeFlag is TRUE ".
    "AND galleryMenu_dt.catActive is TRUE ".
    "AND galleryPhotos_dt.activeFlag is TRUE ".
    "AND galleryAlb_dt.readRule <> 'off' ".
    "AND galleryAlb_dt.readRule <> '' ".
    //"AND galleryAlb_dt.albumAlias = '".$appRJ->server['reqUri_expl'][2]."' ".
    "GROUP BY galleryAlb_dt.album_id ".
    "ORDER BY galleryAlb_dt.dateOfCr DESC, galleryAlb_dt.album_id DESC";
*/
$selectAlbums_txt = "select galleryMenu_dt.catName, galleryMenu_dt.catAlias, galleryMenu_dt.glCat_id,".
    "galleryMenu_dt.catImg, galleryMenu_dt.catActive, galleryMenu_dt.catDescr, ".
    "galleryAlb_dt.album_id, galleryAlb_dt.albumName, galleryAlb_dt.transAlbImg, galleryAlb_dt.robIndex, ".
    "galleryAlb_dt.albumAlias, galleryAlb_dt.albumImg, galleryAlb_dt.dateOfCr, galleryAlb_dt.refreshDate, ".
    "galleryAlb_dt.metaDescr, galleryAlb_dt.readRule, galleryAlb_dt.writeRule, COUNT(galleryPhotos_dt.photo_id) as phQty from galleryMenu_dt ".
    "INNER JOIN galleryAlb_dt ON galleryMenu_dt.glCat_id = galleryAlb_dt.glCat_id ".
    "INNER JOIN galleryPhotos_dt ON galleryAlb_dt.album_id = galleryPhotos_dt.album_id ".
    "WHERE galleryAlb_dt.activeFlag is TRUE ".
    "AND galleryMenu_dt.catActive is TRUE ".
    "AND galleryPhotos_dt.activeFlag is TRUE ".
    "AND galleryAlb_dt.readRule <> 'off' ".
    "AND galleryAlb_dt.readRule <> '' ".
    //"AND galleryAlb_dt.albumAlias = '".$appRJ->server['reqUri_expl'][2]."' ".
    "GROUP BY galleryAlb_dt.album_id ".
    "ORDER BY galleryAlb_dt.dateOfCr DESC, galleryAlb_dt.album_id DESC";

$selectAlbums_res=$DB->doQuery($selectAlbums_txt);
$selectAlbums_count = mysql_num_rows($selectAlbums_res);
$selectAlbums_res=$DB->doQuery($selectAlbums_txt);
$selectAlbums_count = mysql_num_rows($selectAlbums_res);

$foundAlb=false;

$wrAccRes = false;
$allowWrComm=false;

if($selectAlbums_count>0){
    $cntAlb=0;
    $albums_print=null;
    $cat_print = null;

    $catArr=null;
    $cntCat=0;

    $catId=null;
    $albDescr=null;
    $robIndex=null;

    while($selectAlbums_row=$DB->doFetchRow($selectAlbums_res)){
        $alb_view=null;
        //read access-->
        $rdAccRes=false;
        if($selectAlbums_row['readRule']){
            if($selectAlbums_row['readRule']=='all'){
                $rdAccRes=true;
            }elseif($selectAlbums_row['readRule']=='users' and isset($_SESSION['alias'])){
                $rdAccRes=true;
            }elseif(isset($_SESSION['groups'][$selectAlbums_row['readRule']])){
                $rdAccRes=true;
            }
        }
        //<--read access
        if ($selectAlbums_row['albumAlias'] == $appRJ->server['reqUri_expl'][2]) {
            $foundAlb=true;
        }

        if($rdAccRes){
            $cntAlb++;
            if ($selectAlbums_row['albumAlias'] == $appRJ->server['reqUri_expl'][2]) {
                //write access-->
                //$wrAccRes=false;
                if($selectAlbums_row['writeRule'] and $selectAlbums_row['writeRule']!='off'){
                    $allowWrComm=true;
                    if($selectAlbums_row['writeRule']=='users' and isset($_SESSION['alias'])){
                        $wrAccRes=true;
                    }elseif(isset($_SESSION['groups'][$selectAlbums_row['writeRule']])){
                        $wrAccRes=true;
                    }
                }
                //<--write access
                $catId=$selectAlbums_row['glCat_id'];

                $catAlbName=$selectAlbums_row['glCat_id'];
                $alb_view .= "<div class='alb-block'>"."<div class='alb-img'>".
                    "<a href='".GL_ALBUM_IMG_PAPH.$selectAlbums_row['album_id']."/".$selectAlbums_row['albumImg']."'>";
                if(file_exists($_SERVER['DOCUMENT_ROOT'].GL_ALBUM_IMG_PAPH.$selectAlbums_row['album_id']."/preview/".
                    $selectAlbums_row['albumImg'])){
                    $alb_view.="<img src='".GL_ALBUM_IMG_PAPH.$selectAlbums_row['album_id'].
                        "/preview/".$selectAlbums_row['albumImg']."' id='shareImg' ";
                    if($selectAlbums_row['transAlbImg']){
                        $alb_view.="style='transform: rotate(".$selectAlbums_row['transAlbImg']."deg)'";
                    }
                    $alb_view.=">";
                }else{
                    $alb_view.="<img src='/data/default-img.png'>";
                }
                $alb_view .="</a></div><div class='alb-txt'><div class='alb-name'>".$selectAlbums_row['albumName'].
                    "</div><div class='alb-descr'>";
                if ($selectAlbums_row['metaDescr']) {
                    $alb_view .= $selectAlbums_row['metaDescr'];
                    $albDescr=$selectAlbums_row['metaDescr'];
                    $robIndex=$selectAlbums_row['robIndex'];
                } else {
                    $alb_view .= "Описание не задано";
                }
                $alb_view .= "</div><div class='alb-count'><span class='flName'>В альбоме: </span>" .
                    "<span class=flVal>" . $selectAlbums_row['phQty'] . "</span><span class='flName'>фото</span></div>".
                    "<div class='alb-publDt'><span class='flName'>Опубликовано: </span>" .
                    "<span class=flVal>" . $selectAlbums_row['dateOfCr'] . "</span></div>";
                if($selectAlbums_row['refreshDate']){
                    $alb_view .= "<div class='alb-publDt'><span class='flName'>Обновлено: </span>" .
                        "<span class=flVal>" . $selectAlbums_row['refreshDate'] . "</span></div>";
                }
                $alb_view .= "</div></div>";
                $albums_print .= $alb_view;
                $album_id=$selectAlbums_row['album_id'];
                $cntPh = $selectAlbums_row['phQty'];
            }
            if(isset($catArr[$selectAlbums_row['glCat_id']]['photoCount'])){
                $catArr[$selectAlbums_row['glCat_id']]['photoCount'] += $selectAlbums_row['phQty'];
                $catArr[$selectAlbums_row['glCat_id']]['albCount']++;

            }else{
                $cntCat++;
                $catArr[$selectAlbums_row['glCat_id']]['glCat_id']=$selectAlbums_row['glCat_id'];
                $catArr[$selectAlbums_row['glCat_id']]['catName']=$selectAlbums_row['catName'];
                $catArr[$selectAlbums_row['glCat_id']]['catAlias']=$selectAlbums_row['catAlias'];
                $catArr[$selectAlbums_row['glCat_id']]['catImg']=$selectAlbums_row['catImg'];
                $catArr[$selectAlbums_row['glCat_id']]['photoCount']=$selectAlbums_row['phQty'];
                $catArr[$selectAlbums_row['glCat_id']]['albCount']=1;
            }
        }
    }
}else{
    $appRJ->response['result'].= "there is no new albums here";
}

if($foundAlb){
    if(!$catId){
        $appRJ->errors['access']['description']="доступ запрещен";
    }
}else{
    $appRJ->errors['404']['description']="Альбом не найден";
}

if(isset($appRJ->errors)){
    $appRJ->throwErr();
}

$photoPrint_query="select galleryPhotos_dt.photoName, galleryPhotos_dt.photoDescr, galleryPhotos_dt.album_id, ".
    "galleryPhotos_dt.photoLink, galleryPhotos_dt.photo_id, galleryPhotos_dt.transPhoto, COUNT(galleryLike_dt.photo_id) as likeQty, ".
    "galleryLike_dt.user_id from galleryPhotos_dt ".
    "LEFT JOIN galleryLike_dt ON galleryPhotos_dt.photo_id = galleryLike_dt.photo_id ".
    "WHERE galleryPhotos_dt.album_id=".$album_id." AND galleryPhotos_dt.activeFlag IS TRUE ".
    "GROUP BY galleryPhotos_dt.photo_id ".
    "ORDER BY likeQty DESC, galleryPhotos_dt.uploadDate DESC, galleryPhotos_dt.photo_id DESC";
$photoPrint_res=$DB->doQuery($photoPrint_query);

$photoPrint_count=mysql_num_rows($photoPrint_res);

if($allowWrComm){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/actions/printComments.php");
}

$albums_print_txt=null;
if($photoPrint_count==$cntPh){
    while($photoPrint_row=$DB->doFetchRow($photoPrint_res))
    {
        $albums_print_txt.="<div class='photo-line' id='photo_".$photoPrint_row['photo_id']."'>".
            "<div class='photo-context'>";
        if($photoPrint_row['photoName']){
            $albums_print_txt.= "<strong>".$photoPrint_row['photoName']."</strong>";
        }
        if($photoPrint_row['photoDescr']){
            $albums_print_txt.= "<span class='photoDescr'>".$photoPrint_row['photoDescr']."</span>";
        }
        $albums_print_txt.="<a href='".GL_ALBUM_IMG_PAPH.$photoPrint_row['album_id']."/photoAttach/".
            $photoPrint_row['photoLink']."' download>"."скачать - ".
            strval(round(filesize ($_SERVER['DOCUMENT_ROOT'].GL_ALBUM_IMG_PAPH.
                        $photoPrint_row['album_id']."/photoAttach/".
                        $photoPrint_row['photoLink'])/100000)/10)." MB"."</a>"."</div>".
            "<div class='photo-img'>"."<a href = '".GL_ALBUM_IMG_PAPH.$photoPrint_row['album_id']."/photoAttach/".
            $photoPrint_row['photoLink']."'>";
        if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$photoPrint_row['album_id']."/photoAttach/preview/".
            $photoPrint_row['photoLink'])){
            $albums_print_txt.="<img src='".GL_ALBUM_IMG_PAPH.$photoPrint_row['album_id']."/photoAttach/preview/".
                $photoPrint_row['photoLink']."' ";
            if($photoPrint_row['transPhoto']){
                $albums_print_txt.="style='transform: rotate(".$photoPrint_row['transPhoto']."deg)'";
            }
            $albums_print_txt.=">";
        }else{
            $albums_print_txt.="<img src='/data/default-img.png'>";
        }
        $albums_print_txt.="</a>"."</div>".
            "<div class='photo-addContent'>";

        if($allowWrComm){
            $photoCommentsTxt=null;

            $albums_print_txt.="<div class='photo-comments'>";
            include ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/photoComments.php");
            $albums_print_txt.=$photoCommentsTxt."</div>";
        }

        $albums_print_txt.="<div class='photo-like'>";
        include ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/photo-like.php");
        $albums_print_txt.=$photoLikeTxt."</div>";

        $albums_print_txt.="</div></div>";
    }
}else{
    $albums_print_txt.="not equal ".$photoPrint_count." / ".$cntPh;
}

$h1 ="Просмотр альбома";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='".$albDescr."'/>";
if(!$robIndex){
    $appRJ->response['result'].= "<meta name='robots' content='noindex'>";
}
$appRJ->response['result'].= "<title>Галерея</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/gallery/css/mainView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/gallery/css/album-style.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/gallery/js/album-view.js'></script>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='alb-frame onAlbum'>".
    $albums_print.
    "</div>".
    "<div class='photo-frame'>".
    $albums_print_txt.
    "</div>";
$catFrame_txt=null;
$catFrame_flag=false;
$catFrame_txt.= "<div class='cat-frame'><span class='cap2'>Еще этой категории:</span>";
foreach($catArr as $key=>$value){
    if($key==$catId){
        $catFrame_txt.= "<a href='/gallery/category/".$value['catAlias']."' class='cat-line'>";

        $catFrame_txt.= "<div class='cat-img'>";
        if(file_exists($_SERVER['DOCUMENT_ROOT'].GL_CATEG_IMG_PAPH.$key."/preview/".$value['catImg'])){
            $catFrame_txt.= "<img src='".GL_CATEG_IMG_PAPH.$key."/preview/".$value['catImg']."'>";
        }else{
            $catFrame_txt.= "<img src='/data/default-img.png'>";
        }
        $catFrame_txt.= "</div>".
            "<div class='cat-descr'>".
            "<span class='flName'>&laquo;</span><span class=flVal>".
            $value['catName']."</span><span class='flName'>&raquo;</span>".
            "<span class=flVal>".$value['albCount']."</span><span class='flName'>альбом</span>".
            "<span class=flVal>".$value['photoCount']."</span><span class='flName'>фот</span>".
            "<span class='descrTxt'>".$value['catDescr']."</span>".
            "</div></a>";
        if($value['albCount']>1){
            $catFrame_flag=true;
        }
    }
}
$catFrame_txt.= "</div>";
if($catFrame_flag){
    $appRJ->response['result'].= $catFrame_txt;
}
$appRJ->response['result'].= "<div class='nav-frame'>".
    "<div class='toCategory'><a href='/gallery/category/'>Все категории (".$cntCat.")</a>".
    "</div><div class='toAlbums'><a href='/gallery/albums/'>Все альбомы (".$cntAlb.")</a>".
    "</div></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";