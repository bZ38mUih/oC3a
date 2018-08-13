<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 13.03.2017
 * Time: 17:58
 */
class subjectAttachment extends recordDefault
{
    public function initValues()
    {
        $this->result['attachment_id']['val'] = null;
        $this->result['attachment_id']['err'] = null;
        $this->result['subject_id']['val'] = null;
        $this->result['subject_id']['err'] = null;
        $this->result['ref']['val'] = null;
        $this->result['ref']['err'] = null;
        $this->result['sort']['val'] = null;
        $this->result['sort']['err'] = null;
        $this->table='subjectAttachments_dt';
        $this->field_id='attachment_id';
        $this->log=null;
    }

    public function findByName()
    {
        $DB=new DB();
        $findByName_text="select * from subjectAttachments_dt WHERE subject_id='".$this->result['subject_id']['val']."' and ".
            "ref='".$this->result['ref']['val']."'";
        $findByName_res=$DB->doQuery($findByName_text);
        if(mysql_num_rows($findByName_res)==1){
            return true;
        }else{
            return false;
        }
    }
}


?>