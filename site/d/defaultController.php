<?php
if(isset($_GET['syncMe']) and $_GET['syncMe']=='y'){
    $D_res=null;
    $dNt_qry="select * from diaryNotes_dt WHERE noteDate<='".$_GET['dateTo']."' and noteDate>='".$_GET['dateFrom']."'";
    $dNt_res=$DB->doQuery($dNt_qry);
    $dNt_out=array();
    while($dNt_row=$DB->doFetchRow($dNt_res)){
        array_push($dNt_out, $dNt_row);
    }
    $dNtCont_qry="select * from diaryNotesContent_dt ".
        "INNER JOIN diaryNotes_dt ON diaryNotesContent_dt.diary_id = diaryNotes_dt.diary_id ".
        "WHERE diaryNotesContent_dt.curDate<='".$_GET['dateTo']."' and diaryNotesContent_dt.curDate>='".$_GET['dateFrom']."'";
    $dNtCont_res=$DB->doQuery($dNtCont_qry);
    $dNtCont_out=array();
    while($dNtCont_row=$DB->doFetchRow($dNtCont_res)){
        array_push($dNtCont_out, $dNtCont_row);
    }

    $D_res['notes']=$dNt_out;
    $D_res['content']=$dNtCont_out;
    print_r(json_encode($D_res));
    exit;
}elseif (!isset($_SESSION['groups']['1']) or $_SESSION['groups']['1']<10) {
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
elseif($appRJ->server['reqUri_expl'][2] == "sync"){
    $sync_server = "https://rightjoint.ru/d/sync";
    //$sync_server = "http://oc3a.local/d/sync";
    $syncResult=null;
    if(isset($_GET['syncD']) and $_GET['syncD']=='syncMe'){
        $appRJ->response['format']='ajax';
        //print_r($_GET);
        if($syncResult=file_get_contents($sync_server."?syncMe=y&dateTo=".$_GET['dateTo']."&dateFrom=".$_GET['dateFrom'])){
            //print_r()
            $dNt_out = json_decode($syncResult, true);
            //print_r($dNt_out['notes']);

            foreach($dNt_out['notes'] as $k=>$v){
                //echo ;
                $dNtRep_qry="select * from diaryNotes_dt WHERE noteDate='".$v['noteDate']."' and diaryType='".$v['diaryType']."'";
                $dNtRep_res=$DB->doQuery($dNtRep_qry);
                echo mysql_num_rows($dNtRep_res)." - ".$v['noteDate'];
                $diary_rd->result['diaryType']=$v['diaryType'];
                $diary_rd->result['noteDate']=$v['noteDate'];
                $diary_rd->result['diaryHeader']=$v['diaryHeader'];
                if(mysql_num_rows($dNtRep_res)==0){
                    echo " - ".$v['diaryType']." - putOne here";

                    //$diary_rd->putOne();

                }else{
                    $dNtRep_row=$DB->doFetchRow($dNtRep_res);
                    if($dNtRep_row['diaryHeader']!=$v['diaryHeader'] and $dNtRep_row['diaryHeader']==null){
                        $diary_rd->result['diary_id']=$v['diary_id'];
                        echo " - ".$v['diaryType']." - update header ";

                        //$diary_rd->updateOne();

                    }else{
                        echo " - ".$v['diaryType']." - no needs";
                    }
                    echo "<br>";
                }
            }
            echo "<hr>";
            foreach($dNt_out['content'] as $k=>$v){
                //echo ;
                $dNtContRep_qry="select * from diaryNotesContent_dt ".
                    "WHERE curDate='".$v['curDate']."' and curTime='".$v['curTime']."'";
                $dNtContRep_res=$DB->doQuery($dNtContRep_qry);
                echo mysql_num_rows($dNtContRep_res)." - ".$v['curDate']." - ".$v['curTime']." noteDate=".$v['noteDate'];
                if(mysql_num_rows($dNtContRep_res)==0){
                    echo " - need to Insert";
                    $diaryId_qry="select diary_id from diaryNotes_dt ".
                        "WHERE noteDate='".$v['noteDate']."' and diaryType='".$v['diaryType']."'";
                    //$diary_rd->result['diary_id']=
                    $diaryId_res=$DB->doQuery($diaryId_qry);
                    if(mysql_num_rows($diaryId_res) == 1){
                        $diaryId_row=$DB->doFetchRow($diaryId_res);
                        $note_rd->result['diary_id']=$diaryId_row['diary_id'];
                        $note_rd->result['curDate']=$v['curDate'];
                        $note_rd->result['curTime']=$v['curTime'];
                        $note_rd->result['content']=$v['content'];

                        //$note_rd->putOne();

                        echo " - putOne here";
                    }else{
                        echo " - not possible to insert";
                    }
                }else{
                    echo " - no need";
                }
                echo "<hr>";
            }

        }else{
            echo "<div class='pageErr'>not possible to load data from server</div>";
        }
    }
    else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/sync.php");
    }
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/actions/default.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/defaultView.php");
}
?>
