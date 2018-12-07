<?php

if (!isset($_SESSION['groups']['1']) or $_SESSION['groups']['1']<10) {
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
    $appRJ->throwErr();
}else{

}
function dec_enc($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //$secret_key = 'This is my secret key';
    $secret_key = 'life is fuck 2019';
    //$secret_iv = 'This is my secret iv';
    $secret_iv = 'Ganja Man';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
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
/**
 * Created by PhpStorm.
 * User: AVP
 * Date: 27.11.2016
 * Time: 17:31
 */
//session_start();

//$curDate = new datetime;
$mkDiary=null;
function printDiarySubMenu($diaryType='daily', $curDate)
{
    //$appRJ->date['curDate'] = new datetime;
    $resp=null;
    $resp.= "<a href='#' onclick='mkDiary(".'"'.$diaryType.'"'.", null, null, null)'>mkReport</a>";
    if ($diaryType == "yearly" or $diaryType == "conception"){
        $resp.= "from: <input type='date' id='from' value='2013-12-31'>";
    }else{
        $resp.= "from: <input type='date' id='from' value='".date("Y-m-d", strtotime(date_format($curDate, "Y-m-d")." - 1 month"))."'>";
    }


    $resp.= "till: <input type='date' id='till' value='".date_format($curDate, "Y-m-d")."'>";
    $resp.= "<input type='button' value='apply' onclick='applyFilter(".'"'.$diaryType.'"'.")'>";
    return $resp;
}

function printNote($diary=null, $printForm_flag=true,$activeStyle=null)
{
    $mkDiary=null;
    $prNtRes=null;
    $DB = new DB();
    $query_text = "select diaryNotes_dt.diary_id, diaryNotes_dt.diaryType, diaryNotes_dt.noteDate, ".
        "diaryNotesContent_dt.curDate, diaryNotesContent_dt.curTime, diaryNotesContent_dt.content, diaryNotesContent_dt.note_id ".
        "from diaryNotes_dt INNER JOIN diaryNotesContent_dt on diaryNotes_dt.diary_id".
        " = diaryNotesContent_dt.diary_id where diaryNotes_dt.diary_id = '".$diary->result["diary_id"]["val"]."' order by curDate desc, curTime desc";
    $query_res = $DB->doQuery($query_text);
    if (mysql_num_rows($query_res)>0){
        $number = 0;

        while ($query_row = $DB->doFetchRow($query_res)){
            $number++;
            if ($number == 1){
                //echo "diary_id=".$query_row["diary_id"]."<br>";
                $prNtRes.= "<label class='diaryType $activeStyle' onclick='slideNotes(this)'>".$query_row["diaryType"]."</label>";
                $prNtRes.= "from: <label class='noteDate'>".date("Y-m-d", strtotime($query_row["noteDate"]))."</label><span class='delDiary' ".
                    "onclick='delDiary(".$diary->result["diary_id"]["val"].", this)'>delDiary</span>";
            }
            if ($activeStyle == 'active'){
                $prNtRes.= "<div class='note' style='display: inherit;'>";
            }else{
                $prNtRes.= "<div class='note'>";
            }
            if (isset($diary->result["note_id"]["val"]) and  $diary->result["note_id"]["val"]!=null and
                $diary->result["note_id"]["val"] == $query_row["note_id"] and $printForm_flag==true){
                    require_once($_SERVER['DOCUMENT_ROOT']."/site/diary/views/mkDiary.php");
                $prNtRes.=$mkDiary;
            }else{
//echo "note_id=".$query_row["note_id"]."<br>";
                $prNtRes.= "Дата: <label class='curDate'>".$query_row["curDate"]."</label>";
                $prNtRes.= "Время: <label class='curTime'>".$query_row["curTime"]."</label>";
                $prNtRes.= "<div class='dCont'>".dec_enc("decrypt", $query_row["content"])."</div>";
                //if ($query_row["diaryType"] == 'daily'){
                    $prNtRes.= "<a href='#'  id='".$query_row["diary_id"]."' onclick='mkDiary(".'"'.$query_row["diaryType"].'"'.", ".
                        $query_row["diary_id"].", null, this)'>добавить</a>";
                //}
                $prNtRes.= "<a href='#'  id='".$query_row["diary_id"]."' onclick='mkDiary(".'"'.$query_row["diaryType"].'"'.", ".
                    $query_row["diary_id"].", ".$query_row["note_id"].", this)'>редактировать</a>";
            }
            $prNtRes.= "</div>";
        }
        if ((!isset($diary->result["note_id"]["val"]) or  $diary->result["note_id"]["val"]== null) and $printForm_flag==true){
            //echo "<div class='note'>";
            if ($activeStyle == 'active'){
                $prNtRes.= "<div class='note' style='display: inherit;'>";
            }else{
                $prNtRes.= "<div class='note'>";
            }
            require_once($_SERVER['DOCUMENT_ROOT']."/site/diary/views/mkDiary.php");
            $prNtRes.=$mkDiary;
            $prNtRes.= "</div>";
        }else{
            //echo 'zzz-1';
            //print_r($diary);
        }
    }else{

        $prNtRes.= "<div class='note'>";
        require_once($_SERVER['DOCUMENT_ROOT']."/site/diary/views/mkDiary.php");
        $prNtRes.=$mkDiary;
        $prNtRes.= "</div>";
        //echo "xer";
    }
    return $prNtRes;
    //echo "</div>";
}

if(@!include_once($_SERVER['DOCUMENT_ROOT'].'/site/diary/diary_class.php')){
    echo "<span class='results_fail'>diary_class.php NOT FOUND</span>";
    exit;
}

$diary = new Diary();
$diary->initValues();

if (isset($_GET["subMenu"]) and $_GET["subMenu"] != null){
    $appRJ->response['format']='ajax';
    if ($_GET["subMenu"] == "daily"){
        $appRJ->response['result'].=printDiarySubMenu("daily", $appRJ->date['curDate']);
    }elseif($_GET["subMenu"] == "quarterly"){
        $appRJ->response['result'].=printDiarySubMenu("quarterly", $appRJ->date['curDate']);
    }elseif($_GET["subMenu"] == "yearly"){
        $appRJ->response['result'].=printDiarySubMenu("yearly", $appRJ->date['curDate']);
    }elseif($_GET["subMenu"] == "conception"){
        $appRJ->response['result'].=printDiarySubMenu("conception", $appRJ->date['curDate']);
    }
    else{
        //echo "неправильные параметры запроса subMenu";
    }

    //exit;
}elseif(isset($_GET['diary']) and $_GET["diary"] == "mkDiary"){
    //$appRJ->response['result'].="xyi";
    $appRJ->response['format']='ajax';

    $diary->result['diaryType']['val'] = htmlspecialchars($_GET["diaryType"]);
    if (!isset($_GET["diary_id"]) or ($_GET["diary_id"]) == 'null'){
        $diary->result['diary_id']['val'] = null;
    }else{
        $diary->result['diary_id']['val'] = htmlspecialchars($_GET["diary_id"]);
    }
    if (!isset($_GET["note_id"]) or ($_GET["note_id"]) == 'null'){
        $diary->result['note_id']['val'] = null;
    }else{
        $diary->result['note_id']['val'] = htmlspecialchars($_GET["note_id"]);
    }
    if ($diary->result['diary_id']['val'] == null){
        $diary->result["note_id"]["val"] = null;
        $diary->result["noteDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $diary->result["curDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
        $diary->result["curTime"]["val"] = date_format($appRJ->date['curDate'], 'H:i');
        require_once($_SERVER['DOCUMENT_ROOT']."/site/diary/views/mkDiary.php");
        $appRJ->response['result'].=$mkDiary;
    }else{
        if ($diary->result["note_id"]["val"] != null){
            $diary->setLikeDb();
            $appRJ->response['result'].=printNote($diary, true, "active");

        }else{
            //$appRJ->response['result'].="xyi";

            $diary->result["curDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
            $diary->result["curTime"]["val"] = date_format($appRJ->date['curDate'], 'H:i');
            $query_text="select * from diaryNotes_dt WHERE diary_id='".$diary->result["diary_id"]["val"]."' order by noteDate desc";
            $query_row=$DB->doFetchRow($DB->doQuery($query_text));
            $diary->result["noteDate"]["val"]=$query_row["noteDate"];
            $appRJ->response['result'].=printNote($diary, true, "active");

        }
    }
    //exit;
}elseif(isset($_GET["diaryType"]) and ($_GET["diaryType"]!=null) and
    isset($_GET['dailyFrom']) and $_GET['dailyFrom']!=null and isset($_GET['dailyTill'])
and $_GET['dailyTill']!=null){

    $appRJ->response['format']='ajax';
    $query_text = "select * from diaryNotes_dt WHERE diaryType='".$_GET["diaryType"]."' and noteDate<='".$_GET['dailyTill'].
        "' and noteDate>='".$_GET['dailyFrom']."' order by noteDate desc";
    $query_res = $DB->doQuery($query_text);

    if (mysql_num_rows($query_res)>0){

        $num = 0;
        $appRJ->response['result'].= "найдено: ".mysql_num_rows($query_res);
        while($query_row=$DB->doFetchRow($query_res)){
            $num++;
            foreach($query_row as $key=>$value){
                $diary->result[$key]["val"] = $value;
            }
            $diary->result["curDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
            $diary->result["curTime"]["val"] = date_format($appRJ->date['curDate'], 'H:i');
            $appRJ->response['result'].= "<div class='diaryNote'>";
            if ($num===1){
                $appRJ->response['result'].=printNote($diary, false, "active");
            }else{
                $appRJ->response['result'].=printNote($diary, false);
            }
            //$appRJ->response['result'].=$prNtRes;
            $appRJ->response['result'].= "</div>";
        }
    }else{
        $appRJ->response['result'].= "there is no notes";
    }

    //exit;
}elseif(isset($_GET["diary"]) and $_GET["diary"]=='delDiary' and isset($_GET["diary_id"]) and $_GET["diary_id"]!=null){
    $query_text = "delete from diaryNotesContent_dt WHERE diary_id = '".htmlspecialchars($_GET["diary_id"])."'";
    if ($DB->doQuery($query_text) == true){
        $query_text = "delete from diaryNotes_dt WHERE diary_id = '".htmlspecialchars($_GET["diary_id"])."'";
        if ($DB->doQuery($query_text) == true){
            echo "удаление->успешно";
        }else{
            print_r($DB->err);
        }
    }else{
        print_r($DB->err);
    }
    exit;
}

elseif (isset($_POST) and $_POST != null){
    if (isset($_POST["diaryType"]) and $_POST["diaryType"] != null){
        $diary->result['diaryType']['val'] = htmlspecialchars($_POST["diaryType"]);
    }else{
        $diary->result['diaryType']['err'] = "тип заметки не задан";
    }
    if (isset($_POST["diary_id"])){
        $diary->result['diary_id']['val'] = htmlspecialchars($_POST["diary_id"]);
    }else{
        $diary->result['diary_id']['err'] = 'diary_id не задан';
    }
    if (isset($_POST["note_id"])){
        $diary->result['note_id']['val'] = htmlspecialchars($_POST["note_id"]);
    }else{
        $diary->result['note_id']['err'] = 'note_id не задан';
    }
    if (isset($_POST["noteDate"]) and $_POST["noteDate"] != null){
        $diary->result['noteDate']['val'] = htmlspecialchars($_POST["noteDate"]);
    }else{
        $diary->result['noteDate']['err'] = "дата заметки не задана";
    }
    if (isset($_POST["curDate"]) and $_POST["curDate"] != null){
        $diary->result["curDate"]["val"] = htmlspecialchars($_POST["curDate"]);
    }else{
        //$diary->result['curDate']['err'] = "текущая дата не задана";
        $diary->result['curDate']['val'] = null;
    }
    if (isset($_POST["curTime"]) and $_POST["curTime"] != null){
        $diary->result["curTime"]["val"] = htmlspecialchars($_POST["curTime"]);
    }else{
        //$diary->result['curTime']['err'] = "текущее время не задано";
        $diary->result['curTime']['val'] = null;
    }
    if (isset($_POST["content"]) and $_POST["content"] != null){
        $diary->result["content"]["val"] = dec_enc("encrypt", $_POST["content"]);
    }else{
        $diary->result['content']['err'] = "контент не задан";
    }

    if ($diary->checkFields() == true){
        if ($diary->result['diary_id']['val'] == null){
            $diary->result["note_id"]["val"] = null;
            if ($diary->insertCurValues() == true){
                $diary->result["curDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
                $diary->result["curTime"]["val"] = date_format($appRJ->date['curDate'], 'H:i');
                $diary->result["content"]["val"] = null;
                $appRJ->response['result'].=printNote($diary, false, "active");
            }else{
                $appRJ->response['result'].=printNote($diary, true, "active");
            }

        }else{
            //echo "xxx-2";
            if ($diary->result["note_id"]["val"] != null){
                if ($diary->updateCurValues() == true){
                    $diary->result["curDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
                    $diary->result["curTime"]["val"] = date_format($appRJ->date['curDate'], 'H:i');
                    $diary->result["content"]["val"] = null;
                    $diary->result["note_id"]["val"] = null;
                    $appRJ->response['result'].=printNote($diary, false, "active");
                }else{
                    $appRJ->response['result'].=printNote($diary, true, "active");
                }
            }else{
                if($diary->insertCurValues() == true){
                    $diary->result["curDate"]["val"] = date_format($appRJ->date['curDate'], 'Y-m-d');
                    $diary->result["curTime"]["val"] = date_format($appRJ->date['curDate'], 'H:i');
                    $diary->result["content"]["val"] = null;
                    $diary->result["note_id"]["val"] = null;
                    $appRJ->response['result'].=printNote($diary, false, "active");
                }else{
                    $appRJ->response['result'].=printNote($diary, true, "active");
                }
            }
        }
    }else{
        $appRJ->response['result'].=printNote($diary, true, "active");
    }
    //exit;
}else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/diary/views/main.php");
}


?>
