<?php
$albPage = 1;
$albLnP=10;
$h1 ="Темы форума";
if(isset($_GET['page']) and $_GET['page']!=null){
    $albPage = $_GET['page'];
    setcookie('gallery-man-alb-cupP', $albPage, time() + 3600, "/");
}elseif($_COOKIE['gallery-man-alb-cupP'] and $_COOKIE['gallery-man-alb-cupP']!=null){
    $albPage = $_COOKIE['gallery-man-alb-cupP'];
}
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Темы форума'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Темы форума</title>".
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
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-subMenu.php");
$cntSubj=0;
$cntSubj_query="select count(fs_id) as cntSubj from forumSubj_dt LEFT JOIN forumMenu_dt ON ".
    "forumMenu_dt.fm_id=forumSubj_dt.fm_id";
$cntSubj_res=$DB->doQuery($cntSubj_query);
$cntSubj_row=$DB->doFetchRow($cntSubj_res);
if($cntSubj_row['cntSubj']>0){
    $cntSubj=$cntSubj_row['cntSubj'];
}
$selectSubj_query = "select * from forumSubj_dt LEFT JOIN forumMenu_dt ON ".
    "forumMenu_dt.fm_id=forumSubj_dt.fm_id order by forumSubj_dt.dateOfCr DESC limit ".strval(($albPage-1)*$albLnP).
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
    "<a href='/forum/forummanager/newSubject/'><img src='/source/img/create-icon.png'>Создать тему</a></div></div>";
if($subjCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>".
        "<div class='item-line-id'>fs_id</div>".
        "<div class='item-line-img'>sImg</div>".
        "<div class='item-line-name2'>sName</div>".
        "<div class='item-line-alias2'>sAlias</div>".
        "<div class='item-line-flag'>active</div>".
        "<div class='item-line-id'>usr_id</div></div>";
    while ($selectSubj_row=$DB->doFetchRow($selectSubj_res)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-id'>".
            "<a href='/forum/forummanager/editSubject/?fs_id=".$selectSubj_row['fs_id']."'>".
            $selectSubj_row['fs_id']."</a></div>".
            "<div class='item-line-img'>";
        if($selectSubj_row['sImg']){
            $appRJ->response['result'].= "<img src='".F_SUBJ_IMG.$selectSubj_row['fs_id']."/preview/".
                $selectSubj_row['sImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name2'>".$selectSubj_row['sName']."</div>".
            "<div class='item-line-alias2'>".$selectSubj_row['sAlias']."</div>".
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