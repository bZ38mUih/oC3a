<?php
$h1 ="Статьи";
$curPage = 1;
$itLnP=10;
if(isset($_GET['page']) and $_GET['page']!=null){
    $curPage = $_GET['page'];
}
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Управление статьями и справочником' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>artMan</title>".
    "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");
$cntArt_qry = "select COUNT(art_id) as cntArts from art_dt";
$cntArt_res = $DB->doQuery($cntArt_qry);
$cntArt_row = $DB->doFetchRow($cntArt_res);
$slArt_qry = "select art_dt.art_id, art_dt.artCat_id, art_dt.artName, art_dt.artAlias, art_dt.artMeta, ".
    "art_dt.artImg, art_dt.activeFlag, artCat_dt.catName from art_dt ".
    "LEFT JOIN artCat_dt ON art_dt.artCat_id=artCat_dt.artCat_id order by pubDate DESC limit ".strval(($curPage-1)*$itLnP).
    ", ".$itLnP;
$slArt_res=$DB->doQuery($slArt_qry);
$itmCnt=0;
if(mysql_num_rows($slArt_res)>0){
    $itmCnt=mysql_num_rows($slArt_res);
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'>".
    "<div class='itemsCount'>Всего: <span>".$cntArt_row['cntArts']."</span> записей";
if($cntArt_row['cntArts']/$itLnP>1){
    $appRJ->response['result'].= ", стр. ";
    $curPp=1;
    while($itLnP*($curPp-1) < $cntArt_row['cntArts']){
        $appRJ->response['result'].="<a href='?page=".$curPp."'";
        if($curPp==$curPage){
            $appRJ->response['result'].=" class='active'";
        }
        $appRJ->response['result'].=">".strval($curPp)."</a>";
        $curPp++;
    }
}
$appRJ->response['result'].= "</div><div class='newItem'><a href='/artMan/newArt/'>".
    "<img src='/source/img/create-icon.png'>Создать статью</a></div></div>";
if($itmCnt>0){
    $appRJ->response['result'].= "<div class='item-line caption'><div class='item-line-id'>art_id</div>".
        "<div class='item-line-img'>artImg</div>".
        "<div class='item-line-name'>artName</div>".
        "<div class='item-line-alias'>artAlias</div>".
        "<div class='item-line-fCateg'>categ</div>".
        "<div class='item-line-flag'>activeFlag</div>".
        "<div class='item-line-id'>preview</div></div>";
    while ($slArt_row=$DB->doFetchRow($slArt_res)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-id'>".
            "<a href='/artMan/editArt/?art_id=".$slArt_row['art_id']."'>".$slArt_row['art_id']."</a></div>".
            "<div class='item-line-img'>";
        if($slArt_row['artImg']){
            $appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH.$slArt_row['art_id']."/preview/".$slArt_row['artImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name'>".$slArt_row['artName']."</div>".
            "<div class='item-line-alias'>".$slArt_row['artAlias']."</div>".
            "<div class='item-line-fCateg'>".$slArt_row['catName']."</div>".
            "<div class='item-line-flag'><input type='checkbox' ";
        if($slArt_row['activeFlag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div>".
            "<div class='item-line-id'><a href='/artMan/preview/?art_id=".$slArt_row['art_id']."'>".
            $slArt_row['art_id']."</a></div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no arts there<br>";
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";