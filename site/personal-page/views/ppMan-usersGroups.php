<?php

$h1 ="Группы пользователя";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Редактрование групп пользователя' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>ЛК-Менеджер</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/personal-page/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";

/*toDo statistic styles*/
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/personal-page/css/statistic.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/personal-page/css/ppMan-usersGroups.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ppMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/views/ppMan-contentMenu.php");

$usersGroups_text = "select * from usersToGroups_dt WHERE user_id=".$_GET['user_id'];

$usersGroups_res = $DB->doQuery($usersGroups_text);
$usersGroups_arr=null;
while ($usersGroups_row=$DB->doFetchRow($usersGroups_res)) {
    $usersGroups_arr[$usersGroups_row['group_id']]=$usersGroups_row['rules'];
}

$groups_text = "select * from usersGroups_dt";
$groups_res=$DB->doQuery($groups_text);

$groupsRules=null;
$groupsRules['admin']=10;
$groupsRules['creator']=5;
$groupsRules['editor']=3;
$groupsRules['commenter']=2;
$groupsRules['searcher']=1;


$tmp = null;


$appRJ->response['result'].= "<form class='userGroups' method='post'>";
$appRJ->response['result'].= "<input type='hidden' name='editUsrGr_flag' value='Yes'>";
while ($groups_row=$DB->doFetchRow($groups_res)){
    $appRJ->response['result'].= "<div class='item-line'>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    if($groups_row['img']){
        $appRJ->response['result'].= "<img src='".PP_USRGR_IMG_PAPH.$groups_row['group_id']."/preview/".$groups_row['img']."'>";
    }else{
        $appRJ->response['result'].= "<img src='/data/default-img.png'>";
    }
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= $groups_row['groupAlias'];
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-rule'>";
    //print_r($_SESSION);

    $appRJ->response['result'].= "<select name='grId_".$groups_row['group_id']."' ";
    $fnd_flag=false;
    if($_GET['user_id']==$_SESSION['user_id']){
        if($groups_row['group_id']==1){
            $appRJ->response['result'].= "disabled>";
            foreach($groupsRules as $key=>$value){
                if($_SESSION['groups'][$groups_row['group_id']]>=$value){
                    $appRJ->response['result'].= "<option value='".$value."'";
                    if($fnd_flag==false){
                        $fnd_flag = true;
                        $appRJ->response['result'].= " selected";
                    }
                    $appRJ->response['result'].= ">".$key."</option>";
                }
            }

        }else{
            $appRJ->response['result'].= ">";
            foreach($groupsRules as $key=>$value){
                $appRJ->response['result'].= "<option value='".$value."'";
                if(isset($_SESSION['groups'][$groups_row['group_id']]) and $_SESSION['groups'][$groups_row['group_id']]>=$value) {
                    if ($fnd_flag == false) {
                        $fnd_flag = true;
                        $appRJ->response['result'].= " selected";
                    }

                }
                $appRJ->response['result'].= ">".$key."</option>";
            }
        }
    }else{
        if(isset($_SESSION['groups'][$groups_row['group_id']])){
            $appRJ->response['result'].= ">";
            //if(isset($usersGroups_arr[$groups_row['group_id']])){
            foreach($groupsRules as $key=>$value){
                if($_SESSION['groups'][$groups_row['group_id']]>$value and
                    (!isset($usersGroups_arr[$groups_row['group_id']]) or
                        $_SESSION['groups'][$groups_row['group_id']]>$usersGroups_arr[$groups_row['group_id']])){
                    $appRJ->response['result'].= "<option value='".$value."' ";

                    if($value==$usersGroups_arr[$groups_row['group_id']]){
                        $appRJ->response['result'].= "selected";
                        $fnd_flag=true;
                    }
                    $appRJ->response['result'].= ">".$key."</option>";
                }
            }
        }else{
            $appRJ->response['result'].= "disabled>";
        }
    }
    $appRJ->response['result'].= "<option value='OFF'";
    if(!$fnd_flag){
        $appRJ->response['result'].= "selected";
    }
    $appRJ->response['result'].= ">OFF</option>";
    $appRJ->response['result'].= "</select>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
}
$appRJ->response['result'].= "<div class='item-line'>";
$appRJ->response['result'].= "<input type='submit' value='saveChanges'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";

if($editUsrGrLog['result']!==null){
    $appRJ->response['result'].= "<div class='results-frame'>";
    //print_r($editUsrGrLog);
    if($editUsrGrLog['result']==true){
        $appRJ->response['result'].= "<div class='results success'>Успешно</div>";
    }else{
        $appRJ->response['result'].= "<div class='results fail'>Неудачно</div>";
    }
    $appRJ->response['result'].= $editUsrGrLog['log'];
    $appRJ->response['result'].= "</div>";
}

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";