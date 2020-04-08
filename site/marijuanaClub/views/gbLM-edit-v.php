<?php
$h1='edit lamp model';
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='edit lamp model' />".
    "<meta name='robots' content='noindex'>".
    "<title>MarijuanaClub - edit model</title>".
    "<link rel='SHORTCUT ICON' href='/site/marijuanaClub/img/logo.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/signIn/css/defaultForm.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/signIn/js/default.js'></script>";

$appRJ->response['result'].=
    "<link rel='stylesheet' href='/source/js/jQueryUI/jquery-ui.css'>".
    //"<link rel='stylesheet' href='/resources/demos/style.css'>".
    //"<script src='https://code.jquery.com/jquery-1.12.4.js'></script>".
    "<script src='/source/js/jQueryUI/jquery-1.12.4.js'></script>".
    "<script src='/source/js/jQueryUI/jquery-ui.js'></script>";
if($signInActiveSite){
    $appRJ->response['result'].= "<script type='text/javascript' src='/site/signIn/js/site.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "<script src='/site/marijuanaClub/js/gbLights.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/marijuanaClub/css/growBox.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn-frame.php");

$appRJ->response['result'].= "<div class='mc-wrap'><div class='mc-container-wrap gbLights'>".
    "<div class='timeMode'><div class='mc-container'>".
    "<h6>Edit model #<span id='model_id'>".$gbLightModel->result['model_id']."</span></h6>".
    "<label class='lbCheckBox'><input type='checkbox' id='activeFlag' ";
if($gbLightModel->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">Показывать</label>".
    "<div class='actLog'></div>".
    "<div class='mode-controls'>".
    "<span class='mcGbLights-Model'><input type='text' id='modelName' value='".$gbLightModel->result['modelName']."'></span>".
    "<span class='mcGbLights-Power'><input type='number' id='power' value='".$gbLightModel->result['power']."'></span>".
    "<span class='mcGbLights-ColorT'><input type='number' id='colorT' value='".$gbLightModel->result['colorT']."'></span>".
    "<span class='mcGbLights-settle'><input type='text' id='settle' value='".$gbLightModel->result['settle']."'></span>".
    "<span class='mcGbLights-lightType'><select id='lightType'>";
for ($i = 0; $i < count($lightTypes); $i++) {
    if ($lightTypes[$i] == $gbLightModel->result['lightType']){
        $appRJ->response['result'] .= "<option selected>".$lightTypes[$i]."</option>";
    }else{
        $appRJ->response['result'] .= "<option>".$lightTypes[$i]."</option>";
    }
    //echo $i;
}

$appRJ->response['result'] .="</select></span>".
    "<div class='note-content-wrap'><textarea rows='3' id='lightNote'>".$gbLightModel->result['lightNote']."</textarea></div>".
    //"<label>Применить<input type='date' id='note-date' value='".$gbNote->result['noteDate']."'></label>".
    //"<label>с :<input type='time' id='note-time' value='".$gbNote->result['noteTime']."'></label>".
    "<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn mcBtnGoBack'><a href='/marijuanaClub/gbLightsModels'>Отказаться</a></div>".
    "<div class='mode-controls-btn mcBtnEdit'><a href='javaScript: void(0)' onclick = 'lightModelEdit()'>".
    "<img src='/source/img/edit-icon.png'> - Edit</a></div>".
    "<div class='mode-controls-btn toDel'></div>".
    "</div>".
    "</div>".
    "</div></div>".
    "</div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
$appRJ->response['result'].= "</body></html>";