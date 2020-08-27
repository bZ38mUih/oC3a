<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 09.04.2018
 * Time: 19:00
 */

class accessorialClass //extends recordDefault
{
    public static function mkAlias($toTranslit)
    {
        $str = null;
        if (isset($toTranslit) and $toTranslit != null) {
            $converter = array(
                'а' => 'a', 'б' => 'b', 'в' => 'v',
                'г' => 'g', 'д' => 'd', 'е' => 'e',
                'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
                'и' => 'i', 'й' => 'y', 'к' => 'k',
                'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r',
                'с' => 's', 'т' => 't', 'у' => 'u',

                'ф' => 'f', 'х' => 'h', 'ц' => 'c',
                'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
                'ь' => '', 'ы' => 'y', 'ъ' => '',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                'А' => 'A', 'Б' => 'B', 'В' => 'V',
                'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
                'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
                'И' => 'I', 'Й' => 'Y', 'К' => 'K',
                'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                'О' => 'O', 'П' => 'P', 'Р' => 'R',
                'С' => 'S', 'Т' => 'T', 'У' => 'U',
                'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
                'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
                'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',

                ' ' => '-'
            );
            $str = strtr($toTranslit, $converter);
            $str = strtolower($str);
            $str = preg_replace("/[^a-zA-Z0-9-]/", '', $str);
            $str = trim($str, "-");
            $str = preg_replace('/-{2,}/', '-', $str);
        }
        return $str;
    }

    function checkDouble($tgTbl, $fldAlias, $alias)
    {
        $DB=new DB();
        $checkDouble_qry="select COUNT(".$fldAlias.") as dblAlias from ".$tgTbl." where ".$fldAlias." = '".$alias."'";
        $checkDouble_res=$DB->doQuery($checkDouble_qry);
        $checkDouble_row=$DB->doFetchRow($checkDouble_res);
        if($checkDouble_row['dblAlias']==0){
            return true;
        }
        return false;
    }
}