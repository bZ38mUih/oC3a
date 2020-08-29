<?php
$h1 ="Категории меню";

$App['views']['social-block']=false;

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Управление статьями и справочником' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>artMan</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>";

/*toDo common style-->*/
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>";
/*<--common style*/

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artMan-subMenu.php");

$selectCat_query = "select * from artCat_dt ORDER BY artCat_id";
$selectCat_res=$DB->query($selectCat_query);
$catCount = $selectCat_res->rowCount();
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$catCount."</span> записей";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='newCat/'><img src='/source/img/create-icon.png'>Доб. арт. меню</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($catCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "cat_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-par_id'>";
    $appRJ->response['result'].= "catPar_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "catImg";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-name'>";
    $appRJ->response['result'].= "catName";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= "catAlias";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-descr'>";
    $appRJ->response['result'].= "catDescr";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "actFlag";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    while ($selectCat_row = $selectCat_res->fetch(PDO::FETCH_ASSOC)){

        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='editCat/?cat_id=".$selectCat_row['artCat_id']."'>".$selectCat_row['artCat_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-par_id'>";
        if($selectCat_row['artCatPar_id']){
            $appRJ->response['result'].= "<a href='editCat/?cat_id=".$selectCat_row['artCatPar_id']."'>".$selectCat_row['artCatPar_id']."</a>";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($selectCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".ART_CATEG_IMG_PAPH.$selectCat_row['artCat_id']."/preview/".$selectCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-name'>";
        $appRJ->response['result'].= $selectCat_row['catName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-alias'>";
        $appRJ->response['result'].= $selectCat_row['catAlias'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-descr'>";
        if($selectCat_row['catDescr']){
            $appRJ->response['result'].= mb_substr($selectCat_row['catDescr'],0, 20, 'UTF-8')." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($selectCat_row['activeFlag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no categs menu there<br>";
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";