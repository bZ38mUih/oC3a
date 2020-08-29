<?php
$h1 ="Добавление файла";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Добавление файла загрузок' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Добавление файла</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/dwlMan-subMenu.php");
$appRJ->response['result'].= "<form class='newFile' method='post'>".
    "<input type='hidden' name='flagField' value='newFile'><div class='input-line'>".
    "<label for='dwlFileName'>Название:</label><input type='text' name='dwlFileName' id='targetName' ";
if($File_rd['result']['dwlFileName']){
    $appRJ->response['result'].= "value='".$File_rd['result']['dwlFileName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($fileErr['dwlFileName'])){
    $appRJ->response['result'].= $fileErr['dwlFileName'];
}
$appRJ->response['result'].= "</div></div><div class='input-line'>".
    "<label for='dwlFileAliace'>Alias:</label><input type='text' name='dwlFileAliace' id='targetAlias' ";
if($File_rd['result']['dwlFileAliace']){
    $appRJ->response['result'].= "value='".$File_rd['result']['dwlFileAliace']."'";
}
$appRJ->response['result'].= ">".
    "<input type='button' onclick='mkAlias()' value='mkFileAlias'><div class='field-err'>";
if(isset($fileErr['dwlFileAliace'])){
    $appRJ->response['result'].= $fileErr['dwlFileAliace'];
}
$appRJ->response['result'].= "</div></div><div class='input-line'><label for='dwlFileDescr'>Описание:</label>".
    "<textarea name='dwlFileDescr'>";
if($File_rd['result']['dwlFileDescr']){
    $appRJ->response['result'].= $File_rd['result']['dwlFileDescr'];
}
$appRJ->response['result'].= "</textarea></div><div class='input-line'><label for='fileVersion'>Версия:</label>".
    "<input type='text' name='fileVersion' ";
if($File_rd['result']['fileVersion']){
    $appRJ->response['result'].= "value='".$File_rd['result']['fileVersion']."'";
}
$appRJ->response['result'].= "></div><div class='input-line'><label for='fileLicence'>Лицензия:</label>".
    "<input type='text' name='fileLicence' ";
if($File_rd['result']['fileLicence']){
    $appRJ->response['result'].= "value='".$File_rd['result']['fileLicence']."'";
}
$appRJ->response['result'].= "></div><div class='input-line'><label for='dwlCat_id'>cat_id:</label>".
    "<select name='dwlCat_id'>";
/*select options-->*/
$categList_text="select dwlCat_id, dwlCatPar_id, catName from dwlCat_dt ORDER BY catName ";
$categList_res=$DB->query($categList_text);
if($categList_res->rowCount() > 0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelect.= "<option value='".$categList_row['dwlCat_id']."' ";
        if($categList_row['dwlCat_id'] == $File_rd['result']['dwlCat_id']){
            $findSelected=true;
            $catSelect.= " selected";
        }
        $catSelect.= ">".$categList_row['catName']."</option>";
    }
    if($findSelected){
        $catSelect="<option value='none' selected>---</option>".$catSelect;
    }else{
        $catSelect="<option value='none' selected>---</option>".$catSelect;
    }
}else{
    $catSelect="<option value='none' selected>---</option>";
}
/*<--select options*/
$appRJ->response['result'].= $catSelect."</select></div>".
    "<div class='input-line'><label for='fileActive_flag'>Показывать:</label>".
    "<input type='checkbox' name='fileActive_flag' ";
if($File_rd['result']['fileActive_flag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div><div class='input-line'><input type='submit' value='addNew'>".
    "</div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";