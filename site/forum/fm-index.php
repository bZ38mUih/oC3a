<?php



//require_once ($_SERVER["DOCUMENT_ROOT"]."/source/recordDefault_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/subjectMenu_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/subject_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/site/forum/subjectAttachment_class.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/source/imageLib_class.php");

define(FORUM_ATTACHMENTS_DIR, "/data/forum/attachments/");

$subjectMenu=new subjectMenu();
$subjectMenu->initValues();
$subject = new subject();
$subject->initValues();
$subjectAttachments = new subjectAttachment();
$subjectAttachments->initValues();

$imageLib = new imageLib();

function printSubjMenu($subjMenu_id=null)
{
    $appRJ->response['result'].= "<ul>";
    $appRJ->response['result'].= "<li><a href='#' onclick='menuEdit(null, ";
    if($subjMenu_id!=null){
        $appRJ->response['result'].= $subjMenu_id;
    }else{
        $appRJ->response['result'].= 'null';
    }
    $appRJ->response['result'].= ")'>новый элемент меню</a></li>";
    $appRJ->response['result'].= "<ul class='menuSubj'>";
    $appRJ->response['result'].= "<li><a href='#' onclick='subjectEdit(";
    if ($subjMenu_id==null or $subjMenu_id=='null'){
        $appRJ->response['result'].= 'null, ';
    }else{
        $appRJ->response['result'].= $subjMenu_id.", ";
    }
    $appRJ->response['result'].= "null)'>новая тема</a></li>";
    if($subjMenu_id==null){
        $queryMenu_text="select * from subjectsMenu_dt where subjMenu_parId is null";
        $querySubj_text="select * from subjects_dt where subjMenu_id is null";
    }else{
        $queryMenu_text="select * from subjectsMenu_dt where subjMenu_parId='".$subjMenu_id."'";
        $querySubj_text="select * from subjects_dt where subjMenu_id='".$subjMenu_id."'";
    }
    $DB = new DB();
    $querySubj_res=$DB->doQuery($querySubj_text);
    if(@mysql_num_rows($querySubj_res)>0){
        while ($querySubj_row=$DB->doFetchRow($querySubj_res)){
            $appRJ->response['result'].= "<li><a href='#' onclick='subjectEdit(";
            if ($subjMenu_id==null or $subjMenu_id=='null'){
                $appRJ->response['result'].= 'null, ';
            }else{
                $appRJ->response['result'].= $subjMenu_id.", ";
            }
            $appRJ->response['result'].= $querySubj_row['subject_id'].")'>".$querySubj_row['caption']."</a></li>";
        }
    }elseif($subjMenu_id==null){
        $appRJ->response['result'].= "<span class='alerts attention'>there is no records in subjects_dt</span>";
    }
    $appRJ->response['result'].= "</ul>";
    $queryMenu_res=$DB->doQuery($queryMenu_text);
    if(@mysql_num_rows($queryMenu_res)>0){
        while ($queryMenu_row=$DB->doFetchRow($queryMenu_res)){
            $appRJ->response['result'].= "<li><a href='#' onclick='menuEdit(".$queryMenu_row['subjMenu_id'].", ";
            if($queryMenu_row['subjMenu_parId']!=null){
                $appRJ->response['result'].= $queryMenu_row['subjMenu_parId'];
            }else{
                $appRJ->response['result'].= 'null';
            }
            $appRJ->response['result'].= ")'>(".$queryMenu_row['subjMenu_id'].") ".$queryMenu_row['caption']."</a>";
            printSubjMenu($queryMenu_row['subjMenu_id']);
            $appRJ->response['result'].= "</li>";
        }
    }elseif($subjMenu_id==null){
        $appRJ->response['result'].= "<span class='alerts attention'>there is no records in subjectsMenu_dt</span>";
    }
    $appRJ->response['result'].= "</ul>";
}

/*
if(isset($_POST['subjectMenu'])and $_POST['subjectMenu']=='itWork')
{
    foreach($subjectMenu->result as $key=>$value){
        if(isset($_POST[$key])){
            $subjectMenu->result[$key]['val']=$_POST[$key];
        }
    }
    if(!isset($subjectMenu->result['user_id']['val']) or $subjectMenu->result['user_id']['val']==null){
        $subjectMenu->result['user_id']['err']="<span class='alerts attention'>недопустимый user_id</span>";
    }
    if(!isset($subjectMenu->result['dateOfCr']['val']) or $subjectMenu->result['dateOfCr']['val']==null){
        $subjectMenu->result['dateOfCr']['err']="<span class='alerts attention'>недопустимый dateOfCr</span>";
    }
    if(!isset($subjectMenu->result['caption']['val']) or $subjectMenu->result['caption']['val']==null){
        $subjectMenu->result['caption']['err']="<span class='alerts attention'>недопустимый caption</span>";
    }
    if($subjectMenu->checkFields()==true){
        if($subjectMenu->result['subjMenu_id']['val']==null){
            $subjectMenu->putOne();

        }else {
            $subjectMenu->updateOne();
        }
    }
    require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subjectMenu_form.php");
    exit;
}
elseif(isset($_POST['subject_form']) and $_POST['subject_form']=='smoke'){
    foreach($subject->result as $key=>$value){
        if(isset($_POST[$key])){
            $subject->result[$key]['val']=$_POST[$key];
        }
    }
    if(!isset($subject->result['user_id']['val']) or $subject->result['user_id']['val']==null){
        $subject->result['user_id']['err']="<span class='alerts attention'>недопустимый user_id</span>";
    }
    if(!isset($subject->result['caption']['val']) or $subject->result['caption']['val']==null){
        $subject->result['caption']['err']="<span class='alerts attention'>недопустимый caption</span>";
    }
    if(!isset($subject->result['cap_alias']['val']) or $subject->result['cap_alias']['val']==null){
        $subject->mkCaptionAlias();
    }
    if(!isset($subject->result['subjectDescr']['val']) or $subject->result['subjectDescr']['val']==null){
        $subject->result['subjectDescr']['err']="<span class='alerts attention'>недопустимый subjectDescr</span>";
    }
    if(!isset($subject->result['metaDescr']['val']) or $subject->result['metaDescr']['val']==null){
        $subject->result['metaDescr']['err']="<span class='alerts attention'>недопустимый metaDescr</span>";
    }
    if(!isset($subject->result['groupOrders']['val']) or $subject->result['groupOrders']['val']==null){
        $subject->result['groupOrders']['err']="<span class='alerts attention'>недопустимый groupOrders</span>";
    }
    if(isset($subject->result['allowLikes']['val']) and $subject->result['allowLikes']['val']=='on'){
        $subject->result['allowLikes']['val']=true;
    }else{
        $subject->result['allowLikes']['val']=false;
    }
    if(!isset($subject->result['dateOfCr']['val']) or $subject->result['dateOfCr']['val']==null){
        $subject->result['dateOfCr']['err']="<span class='alerts attention'>недопустимый dateOfCr</span>";
    }
    if($subject->checkFields()==true){
        if($subject->result['subject_id']['val']==null){
            if($subject->putOne()==true){
                $appRJ->response['result'].= "<div class='subject_fm_frame'>";
                require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subject_form.php");
                $appRJ->response['result'].= "</div>";
                $appRJ->response['result'].= "<div class='subjectAttach_fm_frame'>";
                require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subjectAttachments_form.php");
                $appRJ->response['result'].= "</div>";
            }else{
                $appRJ->response['result'].= "<p>";
                print_r($subject);
                $appRJ->response['result'].= "</p>";
            };
        }else{
            $subject->updateOne();
            require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subject_form.php");
        }
    }else{
        require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subject_form.php");
    }

    exit;
}

if(isset($_GET['dellAttachment']) and $_GET['dellAttachment'] =='dellNow'){
    if(isset($_GET['attachment_id']) and $_GET['attachment_id']!=null) {
        $subjectAttachments->result['attachment_id']['val'] = htmlspecialchars($_GET['attachment_id']);
        $subjectAttachments->copyOne();
        if (isset($subjectAttachments->result['subject_id']['val']) and $subjectAttachments->result['subject_id']['val'] != null) {
            if(unlink($_SERVER['DOCUMENT_ROOT'] . "/data/forum/attachments/" . $subjectAttachments->result['subject_id']['val'] .
                "/" . $subjectAttachments->result['ref']['val'])){
                if(unlink($_SERVER['DOCUMENT_ROOT'] . "/data/forum/attachments/" . $subjectAttachments->result['subject_id']['val'] .
                    "/preview/" . $subjectAttachments->result['ref']['val'])){
                    if($subjectAttachments->removeOne()==true){
                        $appRJ->response['result'].= 'well';
                    }else{
                        $appRJ->response['result'].= "<span class='alerts warning'>remove record fail</span>";
                    }
                }else{
                    $appRJ->response['result'].= "<span class='alerts warning'>unlink preview fail</span>";
                }
            }else{
                $appRJ->response['result'].= "<span class='alerts warning'>unlink attachment fail</span>";
            }
        }else{
            $appRJ->response['result'].= "<span class='alerts warning'>wrong subject_id</span>";
        }
    }else{
        $appRJ->response['result'].= "<span class='alerts warning'>wrong attachment_id</span>";
    }
    exit;
}
elseif(isset($_GET['mkMainAttach']) and $_GET['mkMainAttach']=='yes'){
    $subjectAttachments->result['attachment_id']['val']=$_GET['attachment_id'];
    $subjectAttachments->copyOne();
    $query_text='update subjectAttachments_dt set sort=0 where subject_id='.
        $subjectAttachments->result['subject_id']['val'];
    $DB->doQuery($query_text);
    $query_text='update subjectAttachments_dt set sort=1 where subject_id='.$subjectAttachments->result['subject_id']['val']
        .' and attachment_id='.$subjectAttachments->result['attachment_id']['val'];
    $DB->doQuery($query_text);
    $appRJ->response['result'].= "mkMain well<br>";
    exit;
}
if (isset($_FILES) and $_FILES !=null) {
    $replace=true;
    if(isset($_POST['subject_id']) and $_POST['subject_id']!=null){
        $subjectAttachments->result['subject_id']['val']= htmlspecialchars($_POST['subject_id']);
        $subject->result['subject_id']['val']=htmlspecialchars($_POST['subject_id']);
        if (!file_exists($_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val'])) {
            mkdir($_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val'], 0777, true);
        }
        foreach ($_FILES as $file){
            $subjectAttachments->result['attachment_id']['val']=null;
            if ($file['error'] !== 0){
                $subjectAttachments->log[basename($file['name'])] = 'возникли ошибки. размер фото не должен превышать 1.8 Mb';
            }else{
                $subjectAttachments->result['ref']['val']=basename($file['name']);
                if($subjectAttachments->findByName()==true){
                    if($replace===true){
                        $uploadfile = $_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/".basename($file['name']);
                        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                            $imageLib->createPreview($_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/".basename($file['name']),
                                $_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/preview/".basename($file['name']), 200, 200);
                            $subjectAttachments->log[basename($file['name'])]='заменен';
                        } else {
                            $subjectAttachments->log[basename($file['name'])]= "Возможная атака с помощью файловой загрузки!\n";
                        }
                    }else{
                        $subjectAttachments->log[basename($file['name'])]='не заменен';
                    }
                }else{
                    if (!file_exists($_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/preview")) {
                        mkdir($_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/preview", 0777, true);//)//{
                    }
                    $subjectAttachments->result['sort']['val']='0';
                    $uploadfile = $_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/".basename($file['name']);
                    if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                        $imageLib->createPreview($_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/".basename($file['name']),
                            $_SERVER["DOCUMENT_ROOT"].FORUM_ATTACHMENTS_DIR.$subjectAttachments->result['subject_id']['val']."/preview/".basename($file['name']), 200, 200);
                        $subjectAttachments->log[basename($file['name'])]='добавлен';
                        $subjectAttachments->putOne();
                    } else {
                        $subjectAttachments->log[basename($file['name'])] = "Возможная атака с помощью файловой загрузки!\n";
                    }
                }
            }
        }
    }else{
        $subjectAttachments['err']['subject_id'] = 'возникли ошибки. не задан subject_id';
    }
    require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subjectAttachments_form.php");
    exit;
}

if(isset($_GET['menuEdit']) and $_GET['menuEdit']==true){
    if(isset($_GET['subjMenu_id']) and $_GET['subjMenu_id']!==null and $_GET['subjMenu_id']!=='null'){
        $subjectMenu->result['subjMenu_id']['val']=htmlspecialchars($_GET['subjMenu_id']);
        $subjectMenu->copyOne();
    }else{
        $appRJ->date['curDate']=date_create();
        $subjectMenu->result['dateOfCr']['val']=date_format($appRJ->date['curDate'],"Y-m-d H:i:s");
        if(isset($_GET['subjMenu_parId']) and $_GET['subjMenu_parId']!=null and $_GET['subjMenu_parId']!='null'){
            $subjectMenu->result['subjMenu_parId']['val']=htmlspecialchars($_GET['subjMenu_parId']);
        }
    }
    require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subjectMenu_form.php");
    exit;
}
elseif(isset($_GET['subjectEdit']) and $_GET['subjectEdit']=='true'){
    if(isset($_GET['subject_id']) and $_GET['subject_id']!=null and $_GET['subject_id']!='null'){
        $subject->result['subject_id']['val']=htmlspecialchars($_GET['subject_id']);
        $subject->copyOne();
    }else{
        $appRJ->date['curDate']=date_create();
        $subject->result['dateOfCr']['val']=date_format($appRJ->date['curDate'],"Y-m-d H:i:s");
    }

    if(isset($_GET['subjMenu_id']) and $_GET['subjMenu_id']!=null and $_GET['subjMenu_id']!='null'){
        $subject->result['subjMenu_id']['val']=htmlspecialchars($_GET['subjMenu_id']);
    }
    $appRJ->response['result'].= "<div class='subject_fm_frame'>";
    require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subject_form.php");
    $appRJ->response['result'].= "</div>";
    if(isset($_GET['subject_id']) and $_GET['subject_id']!=null and $_GET['subject_id']!='null'){
        $appRJ->response['result'].= "<div class='subjectAttach_fm_frame'>";
        require_once($_SERVER['DOCUMENT_ROOT']."/modules/forum/forumManager/views/subjectAttachments_form.php");
        $appRJ->response['result'].= "</div>";
    }
    exit;
}
*/
$appRJ->response['result'].= "<div class='leftPanel'>";
printSubjMenu();
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='rightPanel'>";
$appRJ->response['result'].= "<div class='subject_fm_frame'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='subjectAttach_fm_frame'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";