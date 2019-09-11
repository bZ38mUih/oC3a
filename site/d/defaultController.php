<?php

if (!isset($_SESSION['groups']['1']) or $_SESSION['groups']['1']<10) {
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
    $appRJ->throwErr();
}

$pageErr=null;

$diary_rd=new recordDefault("diaryNotes_dt", "diary_id");
$note_rd=new recordDefault("diaryNotesContent_dt", "note_id");

$dType['1']="daily";
$dType['2']="quarterly";
$dType['3']="yearly";
$dType['4']="conception";
$dType['5']="people";

function dec_enc($action, $string, $noteDate) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $DB=new DB();
    $getKeys_qry="select * from diaryWords_dt WHERE expiredDate>='".$noteDate."' order by expiredDate limit 1";
    $getKeys_res=$DB->doQuery($getKeys_qry);
    $getKeys_row=$DB->doFetchRow($getKeys_res);
    $secret_key=$getKeys_row['sK'];
    $secret_iv=$getKeys_row['sIv'];
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

if($appRJ->server['reqUri_expl'][2] == "daily" or $appRJ->server['reqUri_expl'][2] == "quarterly" or
    $appRJ->server['reqUri_expl'][2] == "yearly" or $appRJ->server['reqUri_expl'][2] == "conception"
    or $appRJ->server['reqUri_expl'][2] == "people"){
    if(isset($_GET['delNote']) and $_GET['delNote']!=null){
        $appRJ->response['format']='ajax';
        $note_rd->result['note_id']=$_GET['delNote'];
        if($note_rd->copyOne()){
            $note_rd->removeOne();
            $appRJ->response['result']=true;
        }else{
            $appRJ->response['result']="copyOne unknown err note_id";
        }
    }elseif($_GET['delDiary'] and $_GET['delDiary']!=null){
        $appRJ->response['format']='ajax';
        $diary_rd->result['diary_id']=$_GET['delDiary'];
        if($diary_rd->copyOne()){
            $delNotes_qry="delete from diaryNotesContent_dt where diary_id=".$diary_rd->result['diary_id'];
            if($DB->doQuery($delNotes_qry)){
                $diary_rd->removeOne();
                $appRJ->response['result']=true;
            }else{
                $appRJ->response['result']="delNotes unknown err";
            }
        }else{
            $appRJ->response['result']="copyOne unknown err diary_id";
        }

    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/lastNote.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/lastNote.php");
    }
}elseif($appRJ->server['reqUri_expl'][2] == "editNote"){

    $note_rd->result['note_id']=$appRJ->server['reqUri_expl'][3];
    if(!$note_rd->copyOne()) {
        $appRJ->errors['request']['description']="copyOne note_id error";
        $appRJ->throwErr();
    }
    $diary_rd->result['diary_id']=$note_rd->result['diary_id'];
    if(!$diary_rd->copyOne()){
        $appRJ->errors['request']['description']="copyOne diary_id error";
        $appRJ->throwErr();
    }

    if(isset($_POST) and $_POST != null){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkNoteFields.php");
        if($pageErr==null){
            if(!$note_rd->updateOne()){
                $pageErr.="updateOne note)_rd unknown err";
            }
        }
    }
    $h1="Edit note"."#".$note_rd->result['note_id'];;
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editNote.php");
}elseif($appRJ->server['reqUri_expl'][2] == "newNote"){
    $diary_rd->result['diary_id']=$appRJ->server['reqUri_expl'][3];
    if(!$diary_rd->copyOne()) {
        $appRJ->errors['request']['description']="copyOne diary_id error";
        $appRJ->throwErr();
    }
    if(isset($_POST) and $_POST != null) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkNoteFields.php");
        $note_rd->result['diary_id']=$diary_rd->result['diary_id'];
        if ($pageErr == null) {
            if ($note_rd->putOne()) {
                header("Location: "."/d/editNote/".$note_rd->result['note_id']);
            }else{
                $pageErr .= "putOne unknown err";
            }
        }
    }else{
        $note_rd->result["curDate"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $note_rd->result["curTime"] = date_format($appRJ->date['curDate'], 'H:i');
    }
    $h1="New note"."#".$note_rd->result['note_id'];
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editNote.php");
}elseif($appRJ->server['reqUri_expl'][2] == "editDiary"){
    $diary_rd->result['diary_id']=$appRJ->server['reqUri_expl'][3];
    if(!$diary_rd->copyOne()) {
        $appRJ->errors['request']['description']="copyOne diary_id error";
        $appRJ->throwErr();
    }
    if(isset($_POST) and $_POST != null) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkDiaryFields.php");
        if($diary_rd->result['noteDate']<>$_POST['noteDate']){
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkDoubleDiary.php");
        }
        if($pageErr==null){
            if(!$diary_rd->updateOne()){
                $pageErr.="updateOne diary_rd unknown err<br>";
            }
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/editDiaryNotes.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editDiary.php");
    }else{
        $note_rd->result["curDate"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $note_rd->result["curTime"] = date_format($appRJ->date['curDate'], 'H:i');
    }
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/editDiaryNotes.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editDiary.php");


}elseif($appRJ->server['reqUri_expl'][2] == "newDiary"){

    if(isset($_POST) and $_POST!=null){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkNoteFields.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkDiaryFields.php");
        if($pageErr===null){
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkDoubleDiary.php");
        }
        if($pageErr==null){
            if($diary_rd->putOne()){
                $note_rd->result['diary_id']=$diary_rd->result['diary_id'];
                if($note_rd->putOne()){
                    header("Location: "."/d/".$diary_rd->result['diaryType']."/lastNote/".$diary_rd->result['diary_id']);
                }else{
                    $pageErr.="putOne note_rd unknown err<br>";
                }
            }else{
                $pageErr.="putOne diary_rd unknown err<br>";
            }
        }
    }else{
        $note_rd->result["curDate"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $note_rd->result["curTime"] = date_format($appRJ->date['curDate'], 'H:i');
        $diary_rd->result["noteDate"]=$note_rd->result["curDate"];
        if(isset($_GET['diaryType']) and $_GET['diaryType']!=null){
            $diary_rd->result['diaryType']=$_GET['diaryType'];
        }
    }
    $h1=$diary_rd->result['diaryType']."-newDiary";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/newDiary.php");
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/default.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/defaultView.php");
}
?>
