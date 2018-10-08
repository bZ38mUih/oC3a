<?php
$editUsrGrLog['log']=null;
$editUsrGrLog['result']=null;
if(isset($_GET['user_id']) and $_GET['user_id']!=null){
    $slUsr_count = 0;
    $slUsr_qry = "select * from users_dt INNER JOIN accounts_dt ON users_dt.user_id = accounts_dt.user_id".
        " WHERE accMain_flag is TRUE and users_dt.user_id=".$_GET['user_id'];
    $slUsr_res=$DB->doQuery($slUsr_qry);
    $slUsr_count = mysql_num_rows($slUsr_res);
    if($slUsr_count == 1) {
        $slUsr_row = $DB->doFetchRow($slUsr_res);
    }else{
        $editUsrGrLog['log'].= "неправильные параметры запроса user_id 2";
        $editUsrGrLog['result']=false;
    }
}else{
    $editUsrGrLog['log'].= "неправильные параметры запроса user_id 1";
    $editUsrGrLog['result']=false;
}