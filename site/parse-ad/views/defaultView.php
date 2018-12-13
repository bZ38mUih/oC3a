<?php
//$pageCont = file_get_contents("https://www.avito.ru/ivanovo/telefony");
//file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/avito-test.html", $pageCont);
$pageCont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/temp/avito-test.html");

$adCount=0;
$parseRes=null;

while(strlen($pageCont)>100){
    $adCount++;
    $prodRef=null;
    $prodName=null;
    $prodPrice=null;
    $prodComp=null;
    $prodDescr=null;
    $prodSaler=null;
    $posItem = strpos($pageCont, "item item_table ");
    if(!$posItem){
        break;
    }
    $pageCont=substr($pageCont, $posItem, strlen($pageCont));
    $posRef1=strpos($pageCont, "<div class=\"title");
    $pageCont=substr($pageCont, $posRef1+17, strlen($pageCont));
    $posRef2=strpos($pageCont, "href=\"");
    $pageCont=substr($pageCont, $posRef2+7, strlen($pageCont));
    $posRef3=strpos($pageCont, "\"");
    $prodRef=substr($pageCont, 0 , $posRef3);
    $posProdName1=strpos($pageCont, "<span itemprop=\"name\">");
    $posProdName1=strpos($pageCont, "<span itemprop=\"name\">");
    $pageCont=substr($pageCont, $posProdName1+22, strlen($pageCont));
    $posProdName2=strpos($pageCont, "</span>");
    $prodName=substr($pageCont, 0, $posProdName2);
    $pageCont=substr($pageCont, $posProdName2+7, strlen($pageCont));
    $posPrice1=strpos($pageCont, "<span class=\"price\" itemprop=\"price\" content=\"");
    $pageCont=substr($pageCont, $posPrice1+46, strlen($pageCont));
    $posPrice2=strpos($pageCont, "\">");
    $prodPrice=substr($pageCont, 0, $posPrice2);
    $pageCont=substr($pageCont, $posPrice2+2, strlen($pageCont));
    $posComp1=strpos($pageCont, "<div class=\"data\">");
    $pageCont=substr($pageCont, $posComp1+18, strlen($pageCont));
    $posComp2=strpos($pageCont, "<p>");
    $prodComp=substr($pageCont, 0, $posComp2);
    $descrCont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/temp/parse-ad/".urlencode($prodRef).".html");
    //$descrCont = file_get_contents("https://avito.ru/".$prodRef);
    //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/parse-ad/".urlencode($prodRef).".html", $descrCont);
    $posSaler1=strpos($descrCont, "seller-info-prop js-seller-info-prop_seller-name");
    $dC=substr($descrCont, $posSaler1, strlen($descrCont));
    $posSaler2=strpos($dC, "<div>");
    $dC=substr($dC, $posSaler2+5, strlen($descrCont));
    $posSaler3=strpos($dC, "</div>");
    $prodSaler=substr($dC, 0, $posSaler3);
    $posDescr1=strpos($descrCont, "class=\"item-description\"");
    $descrCont=substr($descrCont, $posDescr1+25, strlen($descrCont));
    $posDescr2=strpos($descrCont, "</div>");
    $prodDescr=substr($descrCont, 0, $posDescr2);
    $parseRes.="<div class='line ad'>".
        "<div class='ad_id'><a href='https://avito.ru/".$prodRef."' target='_blank'>".$adCount."</a></div>".
        "<div class='prodName'>".$prodName."</div><div class='prodComp'>";
    if($prodComp){
        $parseRes.=$prodComp;
    }else{
        $parseRes.=" - ";
    }
    $parseRes.="</div>".
        "<div class='prodSaler'>".$prodSaler."</div><div class='prodPrice'>".$prodPrice."</div>".
        "<div class='prodDescr'>".$prodDescr."</div>".
        "</div></div>";
    if($adCount>10){
        break;
    }
}



$h1 ="Парсинг объявлений";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Систематизированная информация о компьютерных технологиях'/>".
    "<title>Справочник</title>".
    "<link rel='SHORTCUT ICON' href='/site/handbook/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/js/list-view.js'></script>".
    //"<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/parse-ad/css/parse-ad.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
"<div class='line ad caption'><div class='ad_id'>ad_id</div><div class='prodName'>prodName</div>".
    "<div class='prodComp'>prodComp</div><div class='prodSaler'>prodSaler</div>".
    "<div class='prodPrice'>prodPrice</div>".
    "</div>";

$appRJ->response['result'].= $parseRes."</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";