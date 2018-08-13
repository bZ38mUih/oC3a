<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DorianGray
 * Date: 10.03.17
 * Time: 15:46
 * To change this template use File | Settings | File Templates.
 */

$subjForm_user_id = $_SESSION['usrId'];
if(isset($subject->result['subject_id']['val']) and $subject->result['subject_id']['val']!=null){
    $appRJ->response['result'].= "<h2>Редактирование темы</h2>";
    $subjForm_user_id = $subject->result['user_id']['val'];
}else{
    $appRJ->response['result'].= "<h2>Создание темы</h2>";
}
$appRJ->response['result'].= "<form class='subj_form'>";
$appRJ->response['result'].= "<input type='hidden' name='subject_form' value='smoke'>";
$appRJ->response['result'].= "<input type='hidden' name='subject_id' value='".$subject->result['subject_id']['val']."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='subj_id_'>subjectID: </label>";
$appRJ->response['result'].= "<input type='text' name='subj_id_' value='".$subject->result['subject_id']['val']."' disabled>";
$appRJ->response['result'].= "</div>";
//$appRJ->response['result'].= "<input type='hidden' name='subjMenu_id' value='".$subject->result['subjMenu_id']['val']."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='subjMenu_id'>menuID: </label>";
$appRJ->response['result'].= "<input type='text' name='subjMenu_id' value='".$subject->result['subjMenu_id']['val']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<input type='hidden' name='user_id' value='".$subjForm_user_id."'>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='user_id_disp'>user_id: </label>";
$appRJ->response['result'].= "<input type='number' name='user_id_disp' value='".$subjForm_user_id."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='caption'>Название: </label>";
$appRJ->response['result'].= "<input type='text' name='caption' value='".$subject->result['caption']['val']."'/>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='cap_alias'>Элиас: </label>";
$appRJ->response['result'].= "<input type='text' name='cap_alias' value='".$subject->result['cap_alias']['val']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='subjectDescr'>Описание: </label>";
$appRJ->response['result'].= "<textarea name='subjectDescr'>".$subject->result['subjectDescr']['val']."</textarea>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='metaDescr'>Мета: </label>";
$appRJ->response['result'].= "<input type='text' name='metaDescr' value='".$subject->result['metaDescr']['val']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='groupOrders'>Права: </label>";
$appRJ->response['result'].= "<select name='groupOrders'>";
$appRJ->response['result'].= "<option value='default' selected>default</option>";
$appRJ->response['result'].= "<option value='admin' selected>admin</option>";
$appRJ->response['result'].= "</select>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldLine'>";
$appRJ->response['result'].= "<label for='allowLikes'>Лайки: </label>";
$appRJ->response['result'].= "<input type='checkbox' name='allowLikes' checked>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='fieldsLine'>";
$appRJ->response['result'].= "<label for='dateOfCr'>Дата: </label>";
$appRJ->response['result'].= "<input type='datetime' name='dateOfCr' value='".$subject->result['dateOfCr']['val']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='errorrs'>";
foreach ($subject->result as $key=>$value){
    if($subject->result[$key]['err']!=null){
        $appRJ->response['result'].= $subject->result[$key]['err'];
    }
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<input type='button' value='Сохранить' onclick='saveForm(".'"'."subj_form".'"'.")'>";
$appRJ->response['result'].= "</form>";
?>