<?php
if(isset($_GET['syncMe']) and $_GET['syncMe']=='y'){
    $D_res=null;
    $dNt_qry="select * from diaryNotes_dt WHERE noteDate<='".$_GET['dateTo']."' and noteDate>='".$_GET['dateFrom']."'";
    $dNt_res=$DB->query($dNt_qry);
    $dNt_out=array();
    while($dNt_row= $dNt_res->fetch(PDO::FETCH_ASSOC)){
        array_push($dNt_out, $dNt_row);
    }
    $dNtCont_qry="select * from diaryNotesContent_dt ".
        "INNER JOIN diaryNotes_dt ON diaryNotesContent_dt.diary_id = diaryNotes_dt.diary_id ".
        "WHERE diaryNotesContent_dt.curDate<='".$_GET['dateTo']."' and diaryNotesContent_dt.curDate>='".$_GET['dateFrom']."'";
    $dNtCont_res=$DB->query($dNtCont_qry);
    $dNtCont_out=array();
    while($dNtCont_row = $dNtCont_res->fetch(PDO::FETCH_ASSOC)){
        array_push($dNtCont_out, $dNtCont_row);
    }

    $D_res['notes']=$dNt_out;
    $D_res['content']=$dNtCont_out;
    print_r(json_encode($D_res));
    exit;
}elseif (!isset($_SESSION['groups']['1']) or $_SESSION['groups']['1']<10) {
    $appRJ->errors['404']['description']="Такой страницы не существует";
    $appRJ->throwErr();
}

$pageErr=null;

$diary_rd= array("table" => "diaryNotes_dt", "field_id" => "diary_id");
$note_rd= array("table" => "diaryNotesContent_dt", "field_id" => "note_id", "result" => array());

$dType['1']="daily";
$dType['2']="quarterly";
$dType['3']="yearly";
$dType['4']="conception";
$dType['5']="ZKH";

function dec_enc($action, $string, $noteDate) {
    $pathToConn = "/source/_conf/db_conn.php";
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $DB=new DB($pathToConn);
    $DB->connectDb();
    $getKeys_qry="select * from diaryWords_dt WHERE expiredDate>='".$noteDate."' order by expiredDate limit 1";
    $getKeys_res=$DB->query($getKeys_qry);
    $getKeys_row=$getKeys_res->fetch(PDO::FETCH_ASSOC);
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

$tmpRes=false;
foreach($dType as $k=>$v){
    if($appRJ->server['reqUri_expl'][2]==$v){
        $tmpRes=true;
        break;
    }
}
if($tmpRes){
    if(isset($_GET['delNote']) and $_GET['delNote']!=null){
        $appRJ->response['format']='ajax';
        $note_rd['result']['note_id']=$_GET['delNote'];
        if($note_rd = $DB->copyOne($note_rd)){
            $DB->removeOne($note_rd);
            $appRJ->response['result']=true;
        }else{
            $appRJ->response['result']="copyOne unknown err note_id";
        }
    }elseif($_GET['delDiary'] and $_GET['delDiary']!=null){
        $appRJ->response['format']='ajax';
        $diary_rd['result']['diary_id']=$_GET['delDiary'];
        if($diary_rd = $DB->copyOne($diary_rd)){
            $delNotes_qry="delete from diaryNotesContent_dt where diary_id=".$diary_rd['result']['diary_id'];
            if($DB->query($delNotes_qry)){
                $DB->removeOne($diary_rd);
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

    $note_rd['result']['note_id']=$appRJ->server['reqUri_expl'][3];
    if(!$note_rd = $DB->copyOne($note_rd)) {
        $appRJ->errors['request']['description']="copyOne note_id error";
        $appRJ->throwErr();
    }
    $diary_rd['result']['diary_id']=$note_rd['result']['diary_id'];
    if(!$diary_rd = $DB->copyOne($diary_rd)){
        $appRJ->errors['request']['description']="copyOne diary_id error";
        $appRJ->throwErr();
    }

    if(isset($_POST) and $_POST != null){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkNoteFields.php");
        if($pageErr==null){
            if(!$DB->updateOne($note_rd)){
                $pageErr.="updateOne note)_rd unknown err";
            }
        }
    }
    $h1="Edit note"."#".$note_rd['result']['note_id'];
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editNote.php");
}elseif($appRJ->server['reqUri_expl'][2] == "newNote"){
    $diary_rd['result']['diary_id']=$appRJ->server['reqUri_expl'][3];
    if(!$diary_rd = $DB->copyOne($diary_rd)) {
        $appRJ->errors['request']['description']="copyOne diary_id error";
        $appRJ->throwErr();
    }
    if(isset($_POST) and $_POST != null) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkNoteFields.php");
        $note_rd['result']['diary_id']=$diary_rd['result']['diary_id'];
        if ($pageErr == null) {
            if ($DB->putOne($note_rd)) {
                header("Location: "."/d/editNote/".$DB->lastInsertId());
            }else{
                $pageErr .= "putOne unknown err";
            }
        }
    }else{
        $note_rd['result']["curDate"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $note_rd['result']["curTime"] = date_format($appRJ->date['curDate'], 'H:i');
    }
    $h1="New note"."#".$note_rd['result']['note_id'];
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editNote.php");
}elseif($appRJ->server['reqUri_expl'][2] == "editDiary"){
    $diary_rd['result']['diary_id']=$appRJ->server['reqUri_expl'][3];
    if(!$diary_rd = $DB->copyOne($diary_rd)) {
        $appRJ->errors['request']['description']="copyOne diary_id error";
        $appRJ->throwErr();
    }
    if(isset($_POST) and $_POST != null) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkDiaryFields.php");
        if($diary_rd['result']['noteDate']<>$_POST['noteDate']){
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/checkDoubleDiary.php");
        }
        if($pageErr==null){
            if(!$DB->updateOne($diary_rd)){
                $pageErr.="updateOne diary_rd unknown err<br>";
            }
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/editDiaryNotes.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/editDiary.php");
    }else{
        $note_rd['result']["curDate"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $note_rd['result']["curTime"] = date_format($appRJ->date['curDate'], 'H:i');
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
            if($DB->putOne($diary_rd)){
                $diary_rd['result']['diary_id'] = $DB->lastInsertId();
                $note_rd['result']['diary_id']= $diary_rd['result']['diary_id'];
                if($DB->putOne($note_rd)){
                    header("Location: "."/d/".$diary_rd['result']['diaryType']."/lastNote/".$diary_rd['result']['diary_id']);
                }else{
                    $pageErr.="putOne note_rd unknown err<br>";
                }
            }else{
                $pageErr.="putOne diary_rd unknown err<br>";
            }
        }
    }else{
        $note_rd['result']["curDate"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $note_rd['result']["curTime"] = date_format($appRJ->date['curDate'], 'H:i');
        $diary_rd['result']["noteDate"]=$note_rd['result']["curDate"];
        if(isset($_GET['diaryType']) and $_GET['diaryType']!=null){
            $diary_rd['result']['diaryType']=$_GET['diaryType'];
        }
    }
    $h1=$diary_rd['result']['diaryType']."-newDiary";;
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/newDiary.php");
}
elseif($appRJ->server['reqUri_expl'][2] == "sync"){
    $sync_server = "https://rightjoint.ru/d/sync";
    //$sync_server = "http://oc3a.local/d/sync";
    $syncResult=null;
    if(isset($_GET['syncD']) and $_GET['syncD']=='syncMe'){
        $appRJ->response['format']='ajax';
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/d/actions/sync.php");
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/sync.php");
    }
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/default.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/defaultView.php");
}
?>
