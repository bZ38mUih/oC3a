<?php
$h1='LampsList';
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Модели ламп. Характеристики и описания ламп' />".
    "<meta name='robots' content='noindex'>".
    "<title>MarijuanaClub - LampsList</title>".
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
$appRJ->response['result'].= "<script src='/site/marijuanaClub/js/gbLights.js'></script>";
if($signInActiveSite){
    $appRJ->response['result'].= "<script type='text/javascript' src='/site/signIn/js/site.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/marijuanaClub/css/growBox.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'] .= "<div class='mc-wrap gbLights'>" .
    "<div class='timeMode'><div class='mc-container'>";
$appRJ->response['result'] .="<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn mcBtnEdit'>".
    "<a href='/marijuanaClub' class='create-btn'><img src='/site/marijuanaClub/img/logo.png'> - Resume</a>".
    "</div>".
    "<div class='mode-controls-btn mcBtnEdit'>".
    //"<a href='javaScrip: void(0)' onclick = 'modeGbEditEntry(".$gbSchedule->result['sch_id'].")' class='edit-btn'><img src='/source/img/edit-icon.png'> - Edit</a>".
    "</div>".
    "<div class='mode-controls-btn mcBtnCreate'>".
    "<a href='/marijuanaClub/gbLamps/create' class='create-btn'><img src='/source/img/create-icon.png'> - Create</a>".
    "</div>";
$appRJ->response['result'] .= "</div></div></div>";
//$showGbMode.= "</div>


"</div>";
if(mysql_num_rows($lightsList_res) > 0) {

    while($lightsList_row = $DB->doFetchRow($lightsList_res)){
        $appRJ->response['result'] .= "<div class='mc-wrap gbLights'>" .
            "<div class='timeMode'><div class='mc-container'>" .
            "<h6>".$lightsList_row['modelName']."</h6>" .
            "<label class='lbCheckBox'><input type='checkbox' ";
        if ($lightsList_row['activeFlag']) {
            $appRJ->response['result'] .= "checked";
        }
        $appRJ->response['result'] .= " disabled>Показывать</label>" .
            "<div class='actLog'></div>" .
            "<div class='mode-controls'>" .
            //"<span class='mcGbLights-Model'><input type='text' id='modelName' value='" . $lightsList_row['modelName'] . "'></span>" .
            "<span class='mcGbLights-Power'><input type='number' value='" . $lightsList_row['power'] . "' disabled></span>" .
            "<span class='mcGbLights-ColorT'><input type='number' value='" . $lightsList_row['colorT'] . "' disabled></span>" .
            "<span class='mcGbLights-settle'><input type='text' value='" . $lightsList_row['settle'] . "' disabled></span>" .
            "<span class='mcGbLights-lightType'><select disabled>";

        for ($i = 0; $i < count($lightTypes); $i++) {
            if ($lightTypes[$i] == $lightsList_row['lightType']){
                $appRJ->response['result'] .= "<option selected>".$lightTypes[$i]."</option>";
            }else{
                $appRJ->response['result'] .= "<option>".$lightTypes[$i]."</option>";
            }
            //echo $i;
        }



        $appRJ->response['result'] .= "</select></span>" .
            "<div class='note-content-wrap'><textarea rows='3' disabled>" . $lightsList_row['lightNote'] . "</textarea></div>" .

            //"<div class='mode-controls'>".
            "<div class='mode-controls-btn-wrap'>".
            "<div class='mode-controls-btn mcBtnDelete'>".
            "<a href='javaScrip: void(0)' onclick = 'modeGbRemove(".$gbSchedule->result['sch_id'].")' class='create-btn'><img src='/source/img/drop-icon.png'> - Delete</a>".
            "</div>".
            "<div class='mode-controls-btn mcBtnEdit'>".
            "<a href='/marijuanaClub/gbLightsModels/edit?model_id=".$lightsList_row['model_id']."' class='edit-btn'><img src='/source/img/edit-icon.png'> - Edit</a>".
            "</div>".
            "<div class='mode-controls-btn mcBtnCreate'>".
            //"<a href='javaScript: void(0)' onclick='event.preventDefault(); modeGbCreateEntry()' class='create-btn'><img src='/source/img/create-icon.png'> - Create</a>".
            "</div>".
            //$showGbMode.= "</div>


            "</div>" .

            //"</div></div>" .
            "</div></div>";
    }

}
/*
$appRJ->response['result'].="<div class='lightsList'>";
if(mysql_num_rows($lightsList_res) > 0){
    $appRJ->response['result'].= "<div class='gbLight'>".
        "<span class='lightModel'>modelName</span>".
        "<span class='power'>power</span>".
        "<span class='colorT'>colorT</span>".
        "<span class='settle'>settle</span>".
        "<span class='lightType'>lightType</span>".
        "<span class='lightNote'>lightNote</span>".
        "<span class='activeFlag'>activeFlag</span>".
        "</div>";
}else{

}
*/
//$appRJ->response['result'].= "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
$appRJ->response['result'].= "</body></html>";