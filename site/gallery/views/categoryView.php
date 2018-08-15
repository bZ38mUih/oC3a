<?php

$selectAlbums_txt = "select galleryMenu_dt.catName, galleryMenu_dt.catAlias, galleryMenu_dt.glCat_id,".
    "galleryMenu_dt.catImg, galleryMenu_dt.catActive, galleryMenu_dt.catDescr, ".
    "galleryAlb_dt.album_id, galleryAlb_dt.albumName, ".
    "galleryAlb_dt.albumAlias, galleryAlb_dt.albumImg, galleryAlb_dt.dateOfCr, ".
    "galleryAlb_dt.metaDescr, galleryAlb_dt.readRule, COUNT(galleryPhotos_dt.photo_id) as phQty from galleryMenu_dt ".
    "INNER JOIN galleryAlb_dt ON galleryMenu_dt.glCat_id = galleryAlb_dt.glCat_id ".
    "INNER JOIN galleryPhotos_dt ON galleryAlb_dt.album_id = galleryPhotos_dt.album_id ".
    "WHERE galleryAlb_dt.activeFlag is TRUE ".
    "AND galleryMenu_dt.catActive is TRUE ".
    "AND galleryPhotos_dt.activeFlag is TRUE ".
    "AND galleryAlb_dt.readRule <> 'off' ".
    "AND galleryAlb_dt.readRule <> '' ".
    "GROUP BY galleryAlb_dt.album_id ".
    "ORDER BY galleryAlb_dt.dateOfCr DESC, galleryAlb_dt.album_id DESC";

$selectAlbums_res=$DB->doQuery($selectAlbums_txt);
$selectAlbums_count = mysql_num_rows($selectAlbums_res);

$catId=false;
$catAccess=false;
$cntCat=0;

if($selectAlbums_count>0){
    $selectAlbums_res=$DB->doQuery($selectAlbums_txt);
    $selectAlbums_count = mysql_num_rows($selectAlbums_res);
    if($selectAlbums_count>0){
        $cntAlb=0;
        $albums_print=null;
        $cat_print = null;

        $catArr=null;

        while($selectAlbums_row=$DB->doFetchRow($selectAlbums_res)){
            $alb_view=null;

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

            if($selectAlbums_row['catAlias']==$appRJ->server['reqUri_expl'][3]){
                $catId=true;
            }

            if($rdAccRes){
                $cntAlb++;

                if($selectAlbums_row['catAlias']==$appRJ->server['reqUri_expl'][3]){

                    $alb_view.="<a href='/gallery/".$selectAlbums_row['albumAlias']."' class='alb-block'>";
                    $alb_view.="<div class='alb-img'>";

                    if(file_exists($_SERVER['DOCUMENT_ROOT'].GL_ALBUM_IMG_PAPH.$selectAlbums_row['album_id']."/preview/".
                        $selectAlbums_row['albumImg'])){
                        $alb_view.="<img src='".GL_ALBUM_IMG_PAPH.$selectAlbums_row['album_id']."/preview/".$selectAlbums_row['albumImg']."'>";
                    }else{
                        $alb_view.="<img src='/data/default-img.png'>";
                    }

                    $alb_view.="</div>";
                    $alb_view.= "<div class='alb-txt'>";
                    $alb_view.= "<div class='alb-name'>";
                    $alb_view.= $selectAlbums_row['albumName'];
                    $alb_view.= "</div>";
                    $alb_view.= "<div class='alb-descr'>";
                    if($selectAlbums_row['metaDescr']){
                        $alb_view.= $selectAlbums_row['metaDescr'];
                    }else{
                        $alb_view.="Описание не задано";
                    }
                    $alb_view.= "</div>";
                    $alb_view.="<div class='alb-count'>";
                    $alb_view.="<span class='flName'>В альбоме: </span>".
                        "<span class=flVal>".$selectAlbums_row['phQty']."</span><span class='flName'>фото</span>";
                    $alb_view.="</div>";
                    $alb_view.="<div class='alb-publDt'>";
                    $alb_view.="<span class='flName'>Опубликовано: </span>" .
                        "<span class=flVal>".$selectAlbums_row['dateOfCr']."</span>";
                    $alb_view.="</div>";

                    $alb_view.="</div>";
                    $alb_view.="</a>";
                    $albums_print.=$alb_view;
                }

                if(isset($catArr[$selectAlbums_row['glCat_id']]['photoCount'])){
                    if($selectAlbums_row['catAlias']==$appRJ->server['reqUri_expl'][3]){
                        $catArr[$selectAlbums_row['glCat_id']]['photoCount']+=$selectAlbums_row['phQty'];
                        $catArr[$selectAlbums_row['glCat_id']]['albCount']++;
                    }
                }else{
                    $catArr[$selectAlbums_row['glCat_id']]['catName'] = $selectAlbums_row['catName'];
                    $catArr[$selectAlbums_row['glCat_id']]['catDescr'] = $selectAlbums_row['catDescr'];
                    $catArr[$selectAlbums_row['glCat_id']]['catAlias'] = $selectAlbums_row['catAlias'];
                    $catArr[$selectAlbums_row['glCat_id']]['catImg'] = $selectAlbums_row['catImg'];
                    $catArr[$selectAlbums_row['glCat_id']]['photoCount'] = $selectAlbums_row['phQty'];
                    $catArr[$selectAlbums_row['glCat_id']]['albCount'] = 1;
                    if($selectAlbums_row['catAlias']==$appRJ->server['reqUri_expl'][3]) {
                        $catAccess=true;
                        $catArr[$selectAlbums_row['glCat_id']]['printFlag'] = true;
                    }else{
                        $catArr[$selectAlbums_row['glCat_id']]['printFlag'] = false;
                    }
                    $cntCat++;
                }
            }
        }
    }else{
        $appRJ->response['result'].= "there is no new albums here";
    }
}
if($catId){
    if(!$catAccess){
        $appRJ->errors['access']['description']="доступ к категории запрещен";
        $appRJ->throwErr();
    }
}else{
    $appRJ->errors['404']['description']="категории не существует";
    $appRJ->throwErr();
}



$h1 ="Просмотр категории";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='";
foreach($catArr as $key=>$value){
    if($catArr[$key]['printFlag']==true) {
        $appRJ->response['result'] .= $value['catDescr'];
    }
}
$appRJ->response['result'].= "' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Галерея</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/gallery/css/mainView.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='cat-frame'>";
foreach($catArr as $key=>$value){
    if($catArr[$key]['printFlag']==true) {
        $appRJ->response['result'].= "<a href='/gallery/category/" . $value['catAlias'] . "' class='cat-line'>".
            "<div class='cat-img'>";
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . GL_CATEG_IMG_PAPH . $key . "/preview/" . $value['catImg'])) {
            $appRJ->response['result'].= "<img src='" . GL_CATEG_IMG_PAPH . $key .
                "/preview/" . $value['catImg'] . "'  id='shareImg'>";
        } else {
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div><div class='cat-descr'>"."<span class='flName'>&laquo;".
            "</span><span class=flVal>" . $value['catName'] . "</span><span class='flName'>&raquo;</span>".
            "<span class=flVal>" . $value['albCount'] . "</span><span class='flName'>альбом</span>".
            "<span class=flVal>" . $value['photoCount'] . "</span><span class='flName'>фот</span>".
            "<span class='descrTxt'>" . $value['catDescr'] . "</span></div>";
    }
}
$appRJ->response['result'].= "</div><div class='alb-frame'>".$albums_print."</div>".
    "<div class='nav-frame'><div class='toCategory'>".
    "<a href='/gallery/category/'>Все категории (".$cntCat.")</a></div>".
    "<div class='toAlbums'><a href='/gallery/albums/'>Все альбомы (".$cntAlb.")</a></div></div>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";