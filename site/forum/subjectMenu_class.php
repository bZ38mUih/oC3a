<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DorianGray
 * Date: 09.03.17
 * Time: 14:22
 * To change this template use File | Settings | File Templates.
 */
class subjectMenu extends recordDefault
{
    public function initValues()
    {
        $this->result['subjMenu_id']['val'] = null;
        $this->result['subjMenu_id']['err'] = null;
        $this->result['subjMenu_parId']['val'] = null;
        $this->result['subjMenu_parId']['err'] = null;
        $this->result['user_id']['val'] = null;
        $this->result['user_id']['err'] = null;
        $this->result['dateOfCr']['val'] = null;
        $this->result['dateOfCr']['err'] = null;
        $this->result['caption']['val'] = null;
        $this->result['caption']['err'] = null;
        $this->table='subjectsMenu_dt';
        $this->field_id='subjMenu_id';
    }
}
?>