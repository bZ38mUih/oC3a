<?php
$h1 ="Редактирование альбома";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование альбома'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление галереей</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subContentMenu.php");
$appRJ->response['result'].= "<form class='editImg'><div class='img-frame'>";
$delImgBtn_text=null;
if($Alb_rd['result']['albumImg']){
    $appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$_GET['alb_id']."/preview/".$Alb_rd['result']['albumImg']."' ";
    if($Alb_rd['result']['transAlbImg']){
        $appRJ->response['result'].="style='transform: rotate(".$Alb_rd['result']['transAlbImg']."deg)' ";
    }
    $appRJ->response['result'].=">";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'><div class='delImg-line'>".
    "<span onclick='delImg(".$_GET['alb_id'].", ".'"'."delAlbImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".$_GET['alb_id'].", ".'"'."alb_id".'"'.
    ")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='results'></div></div></form>".
    "<form method='post'>";
if(isset($albErr['common']) and $albErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($albErr['common']) and $albErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editAlbum'>".
    "<div class='input-line'><label for='album_id'>album_id:</label>".
    "<input type='text' name='album_id' value='".$Alb_rd['result']['album_id']."' disabled></div>".
    "<div class='input-line'><label for='albumName'>Название:</label>".
    "<input type='text' name='albumName' id='targetName' ";
if($Alb_rd['result']['albumName']){
    $appRJ->response['result'].= "value='".$Alb_rd['result']['albumName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($albErr['albumName'])){
    $appRJ->response['result'].= $albErr['albumName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='albumAlias'>Alias:</label>".
    "<input type='text' name='albumAlias' id='targetAlias' ";
if($Alb_rd['result']['albumAlias']){
    $appRJ->response['result'].= "value='".$Alb_rd['result']['albumAlias']."'";
}
$appRJ->response['result'].= ">".
    "<input type='button' onclick='mkAlias()' value='mkAlbAlias'><div class='field-err'>";
if(isset($albErr['albumAlias'])){
    $appRJ->response['result'].= $albErr['albumAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='metaDescr'>Мета:</label><textarea name='metaDescr' rows='3' >";
if($Alb_rd['result']['metaDescr']){
    $appRJ->response['result'].= $Alb_rd['result']['metaDescr'];
}
$appRJ->response['result'].= "</textarea></div>".
    "<div class='input-line'><label for='glCat_id'>glCat_id:</label><select name='glCat_id'>";
/*select options-->*/
$categList_text="select glCat_id, catName from galleryMenu_dt".
    " ORDER BY catName ";
$categList_res = $DB->query($categList_text);
if($categList_res->rowCount() >0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelectOptions.= "<option value='".$categList_row['glCat_id']."' ";
        if($categList_row['glCat_id'] == $Alb_rd['result']['glCat_id']){
            $findSelected=true;
            $catSelectOptions.= " selected";
        }
        $catSelectOptions.= ">".$categList_row['catName']."</option>";
    }
    if($findSelected){
        $catSelectOptions="<option value='none'>---</option>".$catSelectOptions;
    }else{
        $catSelectOptions="<option value='none' selected>---</option>".$catSelectOptions;
    }
}else{
    $catSelectOptions="<option value='none' selected>---</option>";
}
/*<--select options*/
$appRJ->response['result'].= $catSelectOptions."</select></div>".
    "<div class='input-line'><label for='dateOfCr'>dateOfCr:</label>".
    "<input type='date' name='dateOfCr' value='".substr($Alb_rd['result']['dateOfCr'], 0, 10)."'>".
    "<div class='field-err'>";
if(isset($albErr['dateOfCr'])){
    $appRJ->response['result'].= $albErr['dateOfCr'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>refreshDate:</label>".
    "<input type='date' name='refreshDate' value='".substr($Alb_rd['result']['refreshDate'], 0, 10)."'>".
    "<div class='field-err'>";
if(isset($albErr['refreshDate'])){
    $appRJ->response['result'].= $albErr['refreshDate'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='transAlbImg'>transAlbImg:</label>".
    "<input type='number' name='transAlbImg' min='-180' max='180' value='".$Alb_rd['result']['transAlbImg']."'></div>".
    "<div class='input-line'><label for='activeFlag'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Alb_rd['result']['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label for='robIndex'>Индексировать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='robIndex' ";
if($Alb_rd['result']['robIndex']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";