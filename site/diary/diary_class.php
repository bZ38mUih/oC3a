<?php
/**
 * Created by PhpStorm.
 * User: AVP
 * Date: 30.11.2016
 * Time: 8:35
 */
class Diary
{
    public $result;

    public function initValues()
    {
        $this->result['diary_id']['val'] = null;
        $this->result['diary_id']['err'] = null;
        $this->result['note_id']['val'] = null;
        $this->result['note_id']['err'] = null;
        $this->result['diaryType']['val'] = null;
        $this->result['diaryType']['err'] = null;
        $this->result['noteDate']['val'] = null;
        $this->result['noteDate']['err'] = null;
        $this->result['curDate']['val'] = null;
        $this->result['curDate']['err'] = null;
        $this->result['curTime']['val'] = null;
        $this->result['curTime']['err'] = null;
        $this->result['content']['val'] = null;
        $this->result['content']['err'] = null;
    }

    public function setLikeDb()
    {
        /*$query_text = "select diaryNotes_dt.diary_id, diaryNotes_dt.diaryType, diaryNotes_dt.noteDate, ".
            "diaryNotesContent_dt.curDate, diaryNotesContent_dt.curTime, diaryNotesContent_dt.content, diaryNotesContent_dt.note_id ".
            "from diaryNotes_dt INNER JOIN diaryNotesContent_dt on diaryNotes_dt.diary_id".
            " = diaryNotesContent_dt.diary_id where diaryNotes_dt.note_id = '".$this->result['note_id']['val']."'";*/
        $query_text = "SELECT
diaryNotes_dt.diary_id,
diaryNotes_dt.diaryType,
diaryNotes_dt.noteDate,
diaryNotesContent_dt.note_id,
diaryNotesContent_dt.curDate,
diaryNotesContent_dt.curTime,
diaryNotesContent_dt.content
FROM
diaryNotes_dt
INNER JOIN diaryNotesContent_dt ON diaryNotes_dt.diary_id = diaryNotesContent_dt.diary_id
WHERE
diaryNotesContent_dt.note_id = ".$this->result['note_id']['val'];
        $DB = new DB();
        $query_row = $DB->doFetchRow($DB->doQuery($query_text));

        if ($DB->err!=null){
            print_r($DB->err);
        }

        $this->result['diary_id']['val'] = $query_row["diary_id"];
        $this->result['note_id']['val'] = $query_row["note_id"];
        $this->result['diaryType']['val'] = $query_row["diaryType"];
        $this->result['noteDate']['val'] = $query_row["noteDate"];
        $this->result['curDate']['val'] = $query_row["curDate"];
        $this->result['curTime']['val'] = $query_row["curTime"];
        $this->result['content']['val'] = $query_row["content"];
    }

    function checkFields()
    {
        foreach ($this->result as $field=>$cellVal){
            if ($this->result[$field]['err'] !== null){
                return false;
            }
        }
        return true;
    }

    function insertCurValues()
    {
        $DB = new DB();
        if ($this->result['diary_id']['val'] == null){
            $query_text="insert into diaryNotes_dt (diaryType, noteDate) VALUES ".
                "('".$this->result["diaryType"]["val"]."', '".$this->result['noteDate']['val']."')";
            if ($DB->doQuery($query_text) == true){
                $this->result['diary_id']['val'] = mysql_insert_id();
            }else{
                return false;
            }
        }
        $query_text = "insert into diaryNotesContent_dt (diary_id, curDate, curTime, content) VALUES ".
            "('".$this->result['diary_id']['val']."', ";
        if ($this->result['curDate']['val']!=null){
            $query_text.="'".$this->result['curDate']['val']."', ";
        }else{
            $query_text.="null, ";
        }
        if ($this->result['curTime']['val']!=null){
            $query_text.="'".$this->result['curTime']['val']."', ";
        }else{
            $query_text.="null, ";
        }
        $query_text.="'".$this->result['content']['val']."')";
        if ($DB->doQuery($query_text) == true){
            $this->result['note_id']['val'] = mysql_insert_id();
            return true;
        }else{
            return false;
        }
    }

    function updateCurValues()
    {
        $DB = new DB();
        $query_text = "update diaryNotes_dt set diaryType='".$this->result["diaryType"]["val"]."', noteDate='".
            $this->result['noteDate']['val']."' where diary_id='".$this->result['diary_id']['val']."'";
        if ($DB->doQuery($query_text) == true){
            $query_text = "update diaryNotesContent_dt set curDate=";

            if ($this->result['curDate']['val']!=null){
                $query_text.="'".$this->result['curDate']['val']."', ";
            }else{
                $query_text.="null, ";
            }
            if ($this->result['curTime']['val']!=null){
                $query_text.="curTime='".$this->result['curTime']['val']."', ";
            }else{
                $query_text.="curTime=null, ";
            }

            $query_text .= "content='".$this->result['content']['val']."' where note_id='".
                $this->result['note_id']['val']."'";
            if ($DB->doQuery($query_text) == true){
                return true;
            }else{
                //echo $query_text;
                return false;
            }
        }else{
            return false;
        }
    }

    /*function echoDate($value)
    {
        if (($value == null) or ($value=='')){
            return 'null';
        }else{
            return "'".$value."'";
        }
    }

    function echoBool($value)
    {
        if (($value == true) or ($value == 'true') or ($value == 1) or ($value == '1')){
            return 'true';
        }else{
            return 'false';
        }
    }*/
}
?>