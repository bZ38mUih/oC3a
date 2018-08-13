<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DorianGray
 * Date: 10.03.17
 * Time: 15:42
 * To change this template use File | Settings | File Templates.
 */
$subjMenuForm_user_id=$_SESSION['usrId'];
if(isset($subjectMenu->result['subjMenu_id']['val']) and $subjectMenu->result['subjMenu_id']['val']!=null){
    $appRJ->response['result'].= "<h2>Редактирование элемента меню</h2>";
    $subjMenuForm_user_id=$subjectMenu->result['user_id']['val'];
}else{
    $appRJ->response['result'].= "<h2>Создание элемента меню</h2>";
}
$appRJ->response['result'].= "<form class='subjMenu_form'>";
$appRJ->response['result'].= "<input type='hidden' name='subjectMenu' value='itWork'>";
$appRJ->response['result'].= "<input type='hidden' name='subjMenu_id' value='".$subjectMenu->result['subjMenu_id']['val']."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='subjectMenu_id'>ID: </label>";
$appRJ->response['result'].= "<input type='text' name='subjectMenu_id' value='".$subjectMenu->result['subjMenu_id']['val']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<input type='hidden' name='subjMenu_parId' value='".$subjectMenu->result['subjMenu_parId']['val']."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='subjectMenu_parId'>parID: </label>";
$appRJ->response['result'].= "<input type='text' name='subjectMenu_parId' value='".$subjectMenu->result['subjMenu_parId']['val']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<input type='hidden' name='user_id' value='".$subjMenuForm_user_id."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='user_id_disp'>user_id: </label>";
$appRJ->response['result'].= "<input type='number' name='user_id_disp' value='".$subjMenuForm_user_id."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='dateOfCr'>Дата: </label>";
$appRJ->response['result'].= "<input type='datetime' name='dateOfCr' value='".$subjectMenu->result['dateOfCr']['val']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='caption'>Название: </label>";
$appRJ->response['result'].= "<input type='text' name='caption' value='".$subjectMenu->result['caption']['val']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='errorrs'>";
foreach ($subjectMenu->result as $key=>$value){
    if($subjectMenu->result[$key]['err']!=null){
        $appRJ->response['result'].= $subjectMenu->result[$key]['err'];
    }
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<input type='button' value='Сохранить' onclick='saveForm(".'"'."subjMenu_form".'"'.")'>";
$appRJ->response['result'].= "</form>";
?>