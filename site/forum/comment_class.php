<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DorianGray
 * Date: 14.03.17
 * Time: 15:52
 * To change this template use File | Settings | File Templates.
 */

class comment extends recordDefault
{
    public function initValues()
    {
        $this->result['comment_id']['val'] = null;
        $this->result['comment_id']['err'] = null;
        $this->result['comment_parId']['val'] = null;
        $this->result['comment_parId']['err'] = null;
        $this->result['subject_id']['val'] = null;
        $this->result['subject_id']['err'] = null;
        $this->result['dateOfCr']['val'] = null;
        $this->result['dateOfCr']['err'] = null;
        $this->result['user_id']['val'] = null;
        $this->result['user_id']['err'] = null;
        $this->result['commContent']['val'] = null;
        $this->result['commContent']['err'] = null;
        $this->result['active']['val'] = true;
        $this->result['active']['err'] = null;
        $this->table='comments_dt';
        $this->field_id='comment_id';
    }
}