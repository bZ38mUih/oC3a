<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DorianGray
 * Date: 10.03.17
 * Time: 14:52
 * To change this template use File | Settings | File Templates.
 */
class subject extends recordDefault
{
    public function initValues()
    {
        $this->result['subject_id']['val'] = null;
        $this->result['subject_id']['err'] = null;
        $this->result['user_id']['val'] = null;
        $this->result['user_id']['err'] = null;
        $this->result['caption']['val'] = null;
        $this->result['caption']['err'] = null;
        $this->result['cap_alias']['val'] = null;
        $this->result['cap_alias']['err'] = null;
        $this->result['subjectDescr']['val'] = null;
        $this->result['subjectDescr']['err'] = null;
        $this->result['metaDescr']['val'] = null;
        $this->result['metaDescr']['err'] = null;
        $this->result['userGroup']['val'] = null;
        $this->result['userGroup']['err'] = null;
        $this->result['groupOrders']['val'] = null;
        $this->result['groupOrders']['err'] = null;
        $this->result['allowLikes']['val'] = null;
        $this->result['allowLikes']['err'] = null;
        $this->result['dateOfCr']['val'] = null;
        $this->result['dateOfCr']['err'] = null;
        $this->result['subjMenu_id']['val'] = null;
        $this->result['subjMenu_id']['err'] = null;
        $this->table='subjects_dt';
        $this->field_id='subject_id';
    }

    public function mkCaptionAlias(){
        if (isset($this->result['caption']['val']) and $this->result['caption']['val']!=null){
            $converter = array(
                'а' => 'a',   'б' => 'b',   'в' => 'v',
                'г' => 'g',   'д' => 'd',   'е' => 'e',
                'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
                'и' => 'i',   'й' => 'y',   'к' => 'k',
                'л' => 'l',   'м' => 'm',   'н' => 'n',
                'о' => 'o',   'п' => 'p',   'р' => 'r',
                'с' => 's',   'т' => 't',   'у' => 'u',

                'ф' => 'f',   'х' => 'h',   'ц' => 'c',
                'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
                'ь' => '',    'ы' => 'y',   'ъ' => '',
                'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

                'А' => 'A',   'Б' => 'B',   'В' => 'V',
                'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
                'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
                'И' => 'I',   'Й' => 'Y',   'К' => 'K',
                'Л' => 'L',   'М' => 'M',   'Н' => 'N',
                'О' => 'O',   'П' => 'P',   'Р' => 'R',
                'С' => 'S',   'Т' => 'T',   'У' => 'U',
                'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
                'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
                'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
                'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

                ' ' => '-'
            );

            $str = strtr($this->result['caption']['val'], $converter);
            $str = strtolower($str);
            $str = preg_replace("/[^a-zA-Z0-9-]/", '', $str);
            $str = trim($str, "-");
            $str = preg_replace('/-{2,}/', '-', $str);

            $this->result['cap_alias']['val']= $str;
            return true;
        }else{
            $this->result['cap_alias']['err']="<span class='alerts attention'>недопустимый cap_alias, metaDescr</span>";
            return false;
        }
    }

    function copyByAlias(){
        $query_text="select * from subjects_dt where cap_alias='".$this->result['cap_alias']['val']."'";
        $DB = new DB();
        $query_res=$DB->doQuery($query_text);
        if (mysql_num_rows($query_res)==1){
            $query_row=$DB->doFetchRow($query_res);
            foreach ($this->result as $key => $value) {
                $this->result[$key]['val']=$query_row[$key];
            }
            return true;
        }
        return false;
    }

    function getIdByAlias(){
        $query_text="select * from subjects_dt where cap_alias='".$this->result['cap_alias']['val']."'";
        $DB = new DB();
        $query_res=$DB->doQuery($query_text);
        if (mysql_num_rows($query_res)==1){
            $query_row=$DB->doFetchRow($query_res);
            return $query_row['subject_id'];
        }
        return false;
    }
}