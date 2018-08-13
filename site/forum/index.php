<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/source/attachments/application_top.php");
$App->redirectModules();
$App->options['default']=true;
$App->options['main']=true;
$App->options['fancyBox']=true;
$App->options['tynymce']=true;
$App->options['loading']=true;
$App->options['goTop']=true;
$App->options['signIn']=true;
$App->options['cookie']=true;
$App->seo=false;

require_once($_SERVER["DOCUMENT_ROOT"]."/modules/forum/subjectMenu_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modules/forum/subject_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modules/forum/subjectAttachment_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modules/forum/comment_class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modules/forum/forum_class.php");

$subject_id=6;
$curPage=1;
$commsOnPage=10;

$subjectMenu=new subjectMenu();
$subjectMenu->initValues();
$subject = new subject();
$subject->initValues();
$subjectAttachments = new subjectAttachment();
$subjectAttachments->initValues();
$comment = new comment();
$comment->initValues();

$Forum=new Forum();
$Forum->initValues();

if(isset($_GET['cap_alias']) and $_GET['cap_alias']=='capAlias'){
    define(USE_ALIAS, true);
}else{
    define(USE_ALIAS, false);
}

/*---------------------------------*/
$mainMenu='articles';
$leftMenu = null;
$appRJ->server['reqUri']=parse_url($_SERVER['REQUEST_URI']);
$appRJ->server['reqUri_expl']=explode("/",$_SERVER['REQUEST_URI']);
if(isset($_POST['subject_id']) and $_POST['subject_id']!=null){
    $subject_id=htmlspecialchars($_POST['subject_id']);
}
elseif(isset($_GET['subject_id']) and $_GET['subject_id']!=null){
    $subject_id=htmlspecialchars($_GET['subject_id']);
}
elseif(isset($_GET['cap_alias']) and $_GET['cap_alias']!=null and USE_ALIAS==true){
    $subject->result['cap_alias']['val']=htmlspecialchars($_GET['cap_alias']);
    $subject_id=$subject->getIdByAlias();
}
elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    if (USE_ALIAS===true){
        $subject->result['cap_alias']['val']=$appRJ->server['reqUri_expl'][2];
        $subject_id=$subject->getIdByAlias();
    }else{
        $subject_id=substr($appRJ->server['reqUri_expl'][2], 5, strlen($appRJ->server['reqUri_expl'][2])-5);
    }
}

$comment->result['subject_id']['val']=$subject_id;
$subject->result['subject_id']['val']=$subject_id;
$subject->copyOne();

function printSubjMenu($subjMenu_id=null, $subject_id=null)
{
    $result['subj_qty']=0;
    $result['content']=null;
    $result['content'].= "<ul>";
    $result['content'].= "<ul class='menuSubj'>";
    if($subjMenu_id==null){
        $queryMenu_text="select * from subjectsMenu_dt where subjMenu_parId is null";
        $querySubj_text="select * from subjects_dt where subjMenu_id is null";
    }else{
        $queryMenu_text="select * from subjectsMenu_dt where subjMenu_parId='".$subjMenu_id."'";
        $querySubj_text="select * from subjects_dt where subjMenu_id='".$subjMenu_id."'";
    }
    $DB = new DB();
    $querySubj_res=$DB->doQuery($querySubj_text);
    $result['subj_qty']=mysql_num_rows($querySubj_res);
    if($result['subj_qty']>0){
        while ($querySubj_row=$DB->doFetchRow($querySubj_res)){
            $classActive=null;
            if($querySubj_row['subject_id'] == $subject_id){
                $classActive = "active";
            }
            if (USE_ALIAS === true){
                $result['content'].= "<li><a href='".$querySubj_row['cap_alias'].
                    "' class='subject ".$classActive."' onclick='openSubject(".$querySubj_row['subject_id'].", ".
                    '"'.$querySubj_row['cap_alias'].'"'.")'>".$querySubj_row['caption']."</a></li>";
            }else{
                $result['content'].= "<li><a href='subj_".$querySubj_row['subject_id'].
                    "' class='subject ".$classActive."' onclick='openSubject(".$querySubj_row['subject_id'].", null)'>".
                    $querySubj_row['caption']."</a></li>";
            }
        }
    }
    $result['content'].= "</ul>";
    $queryMenu_res=$DB->doQuery($queryMenu_text);
    if(@mysql_num_rows($queryMenu_res)>0){
        while ($queryMenu_row=$DB->doFetchRow($queryMenu_res)){
            $response=printSubjMenu($queryMenu_row['subjMenu_id'], $subject_id);
            $result['content'].= "<li><a href='#' class='menu'>(".$response['subj_qty'].") ".$queryMenu_row['caption']."</a>";
            $result['content'].=$response['content'];
            $result['content'].= "</li>";
        }
    }
    $result['content'].= "</ul>";
    return $result;
}

if (isset($_GET['openSubject']) and $_GET['openSubject']=='yes'){

    $Forum->printSubjectHeader($subject);
    $Forum->printSubjectPhotos($subject);
    $Forum->printSubjectStatistic($subject);
    $Forum->printPagination($subject->result['subject_id']['val']);
    $Forum->printComments(null, $comment, false, 1, 10, false);
    $Forum->printSubjectContent();
    $appRJ->response['format']='json';
    $appRJ->response['result'].= $Forum;
    exit;
}
elseif(isset($_POST['addComment']) and $_POST['addComment']=='xxx'){
    foreach($comment->result as $key=>$value){
        if(isset($_POST[$key])){
            $comment->result[$key]['val']=$_POST[$key];
        }
    }
    if($comment->result['commContent']['val']==null){
        $comment->result['commContent']['err']="контент не задан";
    }
    if($comment->result['subject_id']['val']==null){
        $comment->result['subject_id']['err']="не задан subject_id";
    }
    if($comment->result['dateOfCr']['val']==null){
        $appRJ->date['curDate']=date_create();
        $comment->result['dateOfCr']['val']=date_format($appRJ->date['curDate'],"Y-m-d H:i:s");
    }
    $comment->result['active']['val'] = true;
    $comment->result['user_id']['val']=$_SESSION['usrId'];
    if($comment->checkFields()==true){
        if($comment->putOne()===true){
            $comment->initValues();
            $comment->result['subject_id']['val']=$subject_id;
        };
    }
    $Forum->printSubjectStatistic($subject);
    $Forum->printPagination($subject->result['subject_id']['val']);
    $Forum->printComments(null, $comment, true, $curPage, $commsOnPage, $adminOrders);
    $appRJ->response['format']='json';
    $appRJ->response['result']= $Forum;
    exit;
}
elseif (isset($_GET['pagination']) and $_GET['pagination']='update'){
    if(isset($_GET['subject_id']) and $_GET['subject_id']!=null){
        $subject_id=htmlspecialchars($_GET['subject_id']);
    }
    if(isset($_GET['curPage']) and $_GET['curPage']!=null){
        $curPage=htmlspecialchars($_GET['curPage']);
    }
    $comment->result['subject_id']['val']=$subject_id;

    $Forum->printComments(null, $comment, true, $curPage, $commsOnPage, $adminOrders);
    $appRJ->response['result'].= $Forum->comments;;
    exit;
}

elseif(isset($_GET['printSubjMenu']) and $_GET['printSubjMenu']=='printMenu'){
    if(isset($_GET['subjMenu_id']) and $_GET['subjMenu_id']!=null){
        $Forum->viewSubjMenu(null, $subject_id);
        $appRJ->response['result'].= $Forum->subjMenu;
    }
    exit;
}

require_once($_SERVER["DOCUMENT_ROOT"]."/modules/forum/views/main.php");