<?php
$h1 ="Категории услуг";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Категории услуг' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление услугами</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>".
    /*toDo common style dwlMan.css*/
    "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
$selectCat_query = "select * from srvCat_dt";
$selectCat_res=$DB->doQuery($selectCat_query);
$catCount=0;
if(mysql_num_rows($selectCat_res)>0){
    $catCount=mysql_num_rows($selectCat_res);
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'>".
    "<div class='itemsCount'>Всего: <span>".$catCount."</span> записей</div>".
    "<div class='newItem'><a href='/services/srvMan/cats/newCat'><img src='/source/img/create-icon.png'>Создать категорию</a>".
    "</div></div>";
if($catCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>".
        "<div class='item-line-id'>cat_id</div>".
        "<div class='item-line-par_id'>catPar_id</div>".
        "<div class='item-line-img'>catImg</div>".
        "<div class='item-line-name'>catName</div>".
        "<div class='item-line-alias'>catAlias</div>".
        "<div class='item-line-descr'>catDescr</div>".
        "<div class='item-line-flag'>actFlag</div>".
        "</div>";
    while ($selectCat_row=$DB->doFetchRow($selectCat_res)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-id'>".
            "<a href='/services/srvMan/cats/editCat/?cat_id=".$selectCat_row['srvCat_id']."'>".$selectCat_row['srvCat_id']."</a></div>".
            "<div class='item-line-par_id'>";
        if($selectCat_row['srvCatPar_id']){
            $appRJ->response['result'].= "<a href='/services/srvMan/cats/editCat/?cat_id=".$selectCat_row['srvCatPar_id']."'>".
                $selectCat_row['srvCatPar_id']."</a>";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-img'>";
        if($selectCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".SRV_CAT_IMG_PAPH.$selectCat_row['srvCat_id']."/preview/".$selectCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name'>".$selectCat_row['catName']."</div>".
            "<div class='item-line-alias'>".$selectCat_row['catAlias']."</div>".
            "<div class='item-line-descr'>";
        if($selectCat_row['catDescr']){
            $appRJ->response['result'].= mb_substr($selectCat_row['catDescr'],0, 20, 'UTF-8')." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-flag'><input type='checkbox' ";
        if($selectCat_row['catActive']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no categ there<br>";
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";