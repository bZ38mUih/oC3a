<?php
/**
 * Created by PhpStorm.
 * User: AVP
 * Date: 30.09.2016
 * Time: 16:58
 */

class requiredFields //extends recordDefault
{
    public function findDoubleLogin($login, $netWork)
    {
        $DB = new DB();
        $DB->readSettings();
        $DB->connect_db();
        $query_text = "select * from accounts_dt where accLogin='".$login."' and netWork='".$netWork."'";
        $query_res = $DB->doQuery($query_text);
        if(mysql_num_rows($query_res)===1)
        {
            return false;
        }
        return true;
    }

    function checkLogin($login)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $login) == 0){
            return false;
        }
            return true;
    }

    function mkSalt()
    {
        $salt=null;
        $letters = array("3","$","p","*","r","t",")","=","Z","^","7","S","n","j","6","8","P","5","I","b","?","W","m");
        for($i=0;$i < 10;$i++)
        {
            $salt .= $letters[rand(0,sizeof($letters)-1)];
        }
        return($salt);
    }

    function checkPassword($pass)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $pass) == 0){
            return false;
        }else{
            return true;
        }
    }

    function checkEmail($eMail)
    {
        if (filter_var($eMail, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
}