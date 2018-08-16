<?php
$albPage = 1;
$albLnP=10;
$h1 ="Альбомы";
if(isset($_GET['page']) and $_GET['page']!=null){
    $albPage = $_GET['page'];
}
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Список альбомов галереи' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление галереей</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/forum/css/fMan.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/gallery/views/glMan-subMenu.php");
$cntSubj=0;
$cntSubj_query="select count(album_id) as cntSubj from galleryAlb_dt LEFT JOIN galleryMenu_dt ON ".
    "galleryAlb_dt.glCat_id=galleryMenu_dt.glCat_id";
$cntSubj_res=$DB->doQuery($cntSubj_query);
$cntSubj_row=$DB->doFetchRow($cntSubj_res);
if($cntSubj_row['cntSubj']>0){
    $cntSubj=$cntSubj_row['cntSubj'];
}
$selectSubj_query = "select * from galleryAlb_dt LEFT JOIN galleryMenu_dt ON ".
    "galleryAlb_dt.glCat_id=galleryMenu_dt.glCat_id order by galleryAlb_dt.album_id DESC limit ".strval(($albPage-1)*$albLnP).
    ", ".$albLnP;
$selectSubj_res=$DB->doQuery($selectSubj_query);
$subjCount=0;
if(mysql_num_rows($selectSubj_res)>0){
    $subjCount=mysql_num_rows($selectSubj_res);
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'><div class='itemsCount'>".
    "Всего: <span>".$cntSubj."</span> записей";
if($cntSubj/$albLnP>1){
    $appRJ->response['result'].= ", стр. ";
    $curPp=1;
    while($albLnP*($curPp-1) < $cntSubj){
        $appRJ->response['result'].="<a href='?page=".$curPp."'";
        if($curPp==$albPage){
            $appRJ->response['result'].=" class='active'";
        }
        $appRJ->response['result'].=">";
        $appRJ->response['result'].=strval($curPp);
        $appRJ->response['result'].= "</a>";
        $curPp++;
    }
}
$appRJ->response['result'].= "</div><div class='newItem'>".
    "<a href='/gallery/glManager/newAlbum/'><img src='/source/img/create-icon.png'>Создать альбом</a></div></div>";
if($subjCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>".
        "<div class='item-line-id'>album_id</div>".
        "<div class='item-line-img'>albumImg</div>".
        "<div class='item-line-name2'>albumName</div>".
        "<div class='item-line-alias2'>albumAlias</div>".
        "<div class='item-line-flag'>active</div>".
        "<div class='item-line-id'>usr_id</div></div>";
    while ($selectSubj_row=$DB->doFetchRow($selectSubj_res)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-id'>".
            "<a href='/gallery/glManager/editAlbum/?alb_id=".$selectSubj_row['album_id']."'>".
            $selectSubj_row['album_id']."</a></div>".
            "<div class='item-line-img'>";
        if($selectSubj_row['albumImg']){
            $appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$selectSubj_row['album_id']."/preview/".
                $selectSubj_row['albumImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name2'>".$selectSubj_row['albumName']."</div>".
            "<div class='item-line-alias2'>".$selectSubj_row['albumAlias']."</div>".
            "<div class='item-line-flag'><input type='checkbox' ";
        if($selectSubj_row['activeFlag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div>".
            "<div class='item-line-id'>".
            "<a href='/personal-page/ppManager/editUser/?user_id=".$selectSubj_row['user_id']."'>".
            $selectSubj_row['user_id']."</a></div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no albums there<br>";
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";