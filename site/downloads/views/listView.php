<?php
function printList($dwlCatPar_id=null, $DB)
{
    $tmpRes['text']=null;
    $tmpRes['cntCat']=null;
    $tmpRes['cntFile']=null;
    if($dwlCatPar_id ==null){
        $selectCat_query = "select * from dwlCat_dt WHERE dwlCatPar_id is null and catActive_flag is TRUE";
        $selectFiles_query="select * from dwlFiles_dt WHERE dwlCat_id is null and fileActive_flag is TRUE";
    }else{
        $selectCat_query = "select * from dwlCat_dt WHERE dwlCatPar_id = ".$dwlCatPar_id." and catActive_flag is TRUE";
        $selectFiles_query="select * from dwlFiles_dt WHERE dwlCat_id = ".$dwlCatPar_id." and fileActive_flag is TRUE";
    }
    $selectFiles_res=$DB->doQuery($selectFiles_query);
    $filesCount=0;
    if(mysql_num_rows($selectFiles_res)>0){
        $filesCount=mysql_num_rows($selectFiles_res);
    }
    $selectCat_res=$DB->doQuery($selectCat_query);
    $catCount=0;
    if(mysql_num_rows($selectCat_res)>0){
        $catCount=mysql_num_rows($selectCat_res);
    }
    if($catCount>0 or $filesCount>0){
        $tmpRes['text'].= "<ul>";
        if($filesCount>0){
            while ($selectFiles_row=$DB->doFetchRow($selectFiles_res)){
                $tmpFiles=null;
                $tmpFiles.="<li class='itm-line'><a href='/downloads/file/".$selectFiles_row['dwlFileAliace']."'>".
                    "<div class='itm-line-img'>";
                if($selectFiles_row['fileImg']){
                    $tmpFiles.= "<img src='".DWL_FILES_IMG_PAPH.$selectFiles_row['dwlFile_id']."/preview/".$selectFiles_row['fileImg']."'>";
                }else{
                    $tmpFiles.= "<img src='/data/default-img.png'>";
                }
                $tmpFiles.= "</div><div class='itm-line-txt'><div class='itm-line-name'>".
                    $selectFiles_row['dwlFileName']."</div><div class='itm-line-descr'>";
                if($selectFiles_row['dwlFileDescr']){
                    $tmpFiles.= mb_substr($selectFiles_row['dwlFileDescr'],0, 50, 'UTF-8')." ...";;
                }else{
                    $tmpFiles.= "-";
                }
                $tmpFiles.= "</div></div></a></li>";
                $tmpRes['text'].=$tmpFiles;
                $tmpRes['cntFile']=$filesCount;
            }
        }
        if($catCount>0){
            while ($selectCat_row=$DB->doFetchRow($selectCat_res)){
                $tmpCat=null;
                $tmpCat.="<li class='cat-line'><a href='/downloads/".$selectCat_row['catAlias']."'>".
                    "<div class='cat-line-img'>";
                if($selectCat_row['catImg']){
                    $tmpCat.= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id']."/preview/".$selectCat_row['catImg']."'>";
                }else{
                    $tmpCat.= "<img src='/data/default-img.png'>";
                }
                $tmpCat.= "</div><div class='cat-line-txt'><div class='cat-line-name'>".$selectCat_row['catName'].
                    "</div><div class='cat-line-descr'>";
                if($selectCat_row['catDescr']){
                    $tmpCat.= $selectCat_row['catDescr'];
                }else{
                    $tmpCat.= "-";
                }
                $tmpCat.= "</div></div></a>";
                $tmpRes['text'].=$tmpCat;
                $responce=printList($selectCat_row['dwlCat_id'], $DB);
                $tmpRes['cntCat']=$catCount+$responce['cntCat'];
                $tmpRes['cntFile']+=$responce['cntFile'];
                if(isset($responce['cntFile']) or isset($responce['cntCat'])){
                    $tmpRes['text'].="<div class='cat-stat'>";
                    if($responce['cntFile']){
                        $tmpRes['text'].= "<span class='flVal'>".$responce['cntFile']."</span> файл.";
                    }
                    if($responce['cntCat']){
                        $tmpRes['text'].= "<span class='flVal'>".$responce['cntCat']."</span> кат.";
                    }
                    $tmpRes['text'].="<span class='slide-stat'>[+]</span></div>";
                }
                $tmpRes['text'].=$responce['text']."</li>";
            }
        }
        $tmpRes['text'].="</ul>";
    }
    return $tmpRes;
}
$h1 ="Список загрузок";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Системное, офисное, разработка, популяное ПО. Ссылки на загрузки программ.' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Загрузки - список</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/js/list-view.js'></script>".
    "<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='list-frame'>";
$prtLst= printList(null, $DB);
$appRJ->response['result'].= "<div class='cat-stat main'>";
if(isset($prtLst['cntFile']) or isset($prtLst['cntCat'])){
    $appRJ->response['result'].= "<strong>Всего: </strong>";
    if($prtLst['cntFile']){
        $appRJ->response['result'].= "<span class='flVal'>".$prtLst['cntFile']."</span> файл.";
    }
    if($prtLst['cntCat']){
        $appRJ->response['result'].= "<span class='flVal'>".$prtLst['cntCat']."</span> кат.";
    }
}
$appRJ->response['result'].= "</div>".$prtLst['text']."</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";