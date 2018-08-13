<?php
$h1 ="Темы форума";

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Список тем форума' http-equiv='Content-Type' charset='charset=utf-8'>";
//$appRJ->response['result'].= "<meta name='yandex-verification' content='02913709ba09b678' />";
$appRJ->response['result'].= "<title>Темы форума</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/forum/img/favicon-fm.png' type='image/png'>";
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


require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/fMan-subMenu.php");

//require_once ($_SERVER["DOCUMENT_ROOT"]."/site/forum/views/categories.php");
//require_once ($_SERVER['DOCUMENT_ROOT']."/site/forum/fm-index.php");
$selectSubj_query = "select * from subjects_dt LEFT JOIN subjectsMenu_dt ON subjects_dt.subjCat_id=subjectsMenu_dt.subjCat_id";
$selectSubj_res=$DB->doQuery($selectSubj_query);
$subjCount=0;
if(mysql_num_rows($selectSubj_res)>0){
    $subjCount=mysql_num_rows($selectSubj_res);
}
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$subjCount."</span> записей";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='/forum/forumManager/newSubject/'><img src='/source/img/create-icon.png'>Создать тему</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($subjCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "subj_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "subjImg";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-name2'>";
    $appRJ->response['result'].= "subjName";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias2'>";
    $appRJ->response['result'].= "subjAlias";
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
        $appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/?subj_id=".$selectSubj_row['subject_id']."'>".
            $selectSubj_row['subject_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($selectSubj_row['subjImg']){
            $appRJ->response['result'].= "<img src='".FORUM_SUBJ_IMG_PAPH.$selectSubj_row['subject_id']."/preview/".
                $selectSubj_row['subjImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-name2'>";
        $appRJ->response['result'].= $selectSubj_row['subjName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-alias2'>";
        $appRJ->response['result'].= $selectSubj_row['subjAlias'];
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
    $appRJ->response['result'].= "there is no files there<br>";
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