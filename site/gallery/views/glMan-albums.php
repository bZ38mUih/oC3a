<?php
$albPage = 1;
$albLnP=10;
$h1 ="Альбомы";

if(isset($_GET['page']) and $_GET['page']!=null){
    $albPage = $_GET['page'];
}

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Список альбомов галереи' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Управление галереей</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/fMan.css' type='text/css' media='screen, projection'/>";


//$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/fm.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/modules/landing/css/main.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<script type='text/javascript' src='/site'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");


$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";


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
//echo $selectSubj_query;
$selectSubj_res=$DB->doQuery($selectSubj_query);
$subjCount=0;
if(mysql_num_rows($selectSubj_res)>0){
    $subjCount=mysql_num_rows($selectSubj_res);
}
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";

$appRJ->response['result'].= "Всего: <span>".$cntSubj."</span> записей";

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

//$appRJ->response['result'].= " ";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='/gallery/glManager/newAlbum/'><img src='/source/img/create-icon.png'>Создать альбом</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($subjCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "album_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "albumImg";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-name2'>";
    $appRJ->response['result'].= "albumName";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias2'>";
    $appRJ->response['result'].= "albumAlias";
    $appRJ->response['result'].= "</div>";
    /*
    $appRJ->response['result'].= "<div class='item-line-fVersion'>";
    $appRJ->response['result'].= "fileVers";
    $appRJ->response['result'].= "</div>";
    */
    /*
    $appRJ->response['result'].= "<div class='item-line-descr'>";
    $appRJ->response['result'].= "author";
    $appRJ->response['result'].= "</div>";
*/
    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "active";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "usr_id";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "</div>";
    while ($selectSubj_row=$DB->doFetchRow($selectSubj_res)){
        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/gallery/glManager/editAlbum/?alb_id=".$selectSubj_row['album_id']."'>".
            $selectSubj_row['album_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($selectSubj_row['albumImg']){
            $appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$selectSubj_row['album_id']."/preview/".
                $selectSubj_row['albumImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-name2'>";
        $appRJ->response['result'].= $selectSubj_row['albumName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-alias2'>";
        $appRJ->response['result'].= $selectSubj_row['albumAlias'];
        $appRJ->response['result'].= "</div>";
        /*
        $appRJ->response['result'].= "<div class='item-line-fVersion'>";
        if($selectFile_row['fileVersion']){
            $appRJ->response['result'].= $selectFile_row['fileVersion'];
        }else{
            $appRJ->response['result'].= "-";
        }
        */
        //$appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($selectSubj_row['activeFlag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/personal-page/ppManager/editUser/?user_id=".$selectSubj_row['user_id']."'>".
            $selectSubj_row['user_id']."</a>";
        $appRJ->response['result'].= "</div>";
        /*$appRJ->response['result'].= "<div class='item-line-fCateg'>";
        $appRJ->response['result'].= $selectSubj_row['catName'];
        $appRJ->response['result'].= "</div>";*/
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no albums there<br>";
}
$appRJ->response['result'].= "</div>";


//$appRJ->response['result'].= "content here";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";