<?php
$pathToConn = "/home/p264533/public_html/rightjoint.ru/source/_conf/db_conn.php";
$ntfLog['txt']=null;

require_once("/home/p264533/public_html/rightjoint.ru/source/DB_class.php");

$DB = new DB($pathToConn);
$DB->connectDb();

$ntf_cnt=0;
$ntf_qry="select * from ntf_dt WHERE activeFlag is TRUE ORDER by ntfDate DESC";

if($ntf_res = $DB->query($ntf_qry)){
    if($ntf_res->rowCount() > 0){
        $ntf_cnt = $ntf_res->rowCount();
    }
}

if($ntf_cnt>0) {

    $ntfLog['txt'].="<h2>".$ntf_cnt." notifications to send</h2>";

    while ($ntf_row = $ntf_res->fetch(PDO::FETCH_ASSOC)) {

        $ntfLog['txt'].="<p>";

        $slUsr_cnt = 0;

        $ntfLog['txt'].="<p style='font-weight: bold; font-size: 1.2em'>ntf_id=".$ntf_row['ntf_id']." / notifications ".$ntf_row['ntfDescr']."</p>";

        if ($ntf_row['ntfType'] == 'auth') {

            $slUsr_qry = "select user_id, eMail from accounts_dt WHERE accMain_flag is TRUE";

            if ($slUsr_res = $DB->query($slUsr_qry)) {
                if ($slUsr_res->rowCount() > 0) {
                    $slUsr_cnt = $slUsr_res->rowCount();
                }
            }

            $ntfLog['txt'].="<p>";

            if ($slUsr_cnt > 0) {

                $ntfLog['txt'].="<strong>".$slUsr_cnt."- users to send:</strong><br>";

                while ($slUsr_row = $slUsr_res->fetch(PDO::FETCH_ASSOC)) {

                    $ntfList_rd = array("table" => "ntfList_dt", "field_id" => "ntfList_id");
                    $ntfList_rd['result']['ntf_id'] = $ntf_row['ntf_id'];
                    $ntfList_rd['result']['user_id'] = $slUsr_row['user_id'];
                    $DB->putOne($ntfList_rd);
                    $ntfList_rd['result']['ntfList_id'] = $DB->lastInsertId();

                    if ($slUsr_row['eMail']) {

                        $ntfLog['txt'].=$slUsr_row['user_id']." - ".$slUsr_row['eMail']."<br>";

                        $linkToRead = " ссылка для прочтения: http://rightjoint.ru/personal-page/notification/read/?ntfList_id=" . $ntfList_rd['result']['ntfList_id'];
                        mail($slUsr_row['eMail'], $ntf_row['ntfSubj'], $ntf_row['ntfDescr'] . $linkToRead, 'From: RightJoint');
                    }else{

                        $ntfLog['txt'].=$slUsr_row['user_id']." - no email<br>";
                    }

                }
            }else{

                $ntfLog['txt'].="-no users to send";
            }

            $ntfLog['txt'].="</p>";

        }
        elseif ($ntf_row['ntfType'] == 'personal') {

            $ntfLog['txt'].="<p>";

            $ntfList_rd = array("table" => "ntfList_dt", "field_id" => "ntfList_id");
            $ntfList_rd['result']['ntf_id'] = $ntf_row['ntf_id'];
            $ntfList_rd['result']['user_id'] = $ntf_row['ntfSubscr'];
            $DB->putOne($ntfList_rd);
            $ntfList_rd['result']['ntfList_id'] = $DB->lastInsertId();

            $slUsr_qry = "select eMail from accounts_dt WHERE user_id = " . $ntfList_rd['result']['user_id'] . " and " .
                "accMain_flag is TRUE and eMail is not NULL";

            if ($slUsr_res = $DB->query($slUsr_qry)) {
                if ($slUsr_res->rowCount() > 0) {
                    $slUsr_cnt = $slUsr_res->rowCount();
                }
            }

            $ntfLog['txt'].="<strong>personal for user_id=".$ntfList_rd['result']['user_id']."</strong><br>";


            if ($slUsr_cnt == 1) {

                $linkToRead = " ссылка для прочтения: http://rightjoint.ru/personal-page/notification/read/?ntfList_id=" . $ntfList_rd['result']['ntfList_id'];
                $slUsr_row = $slUsr_res->fetch(PDO::FETCH_ASSOC);
                mail($slUsr_row['eMail'], $ntf_row['ntfSubj'], $ntf_row['ntfDescr'] . $linkToRead, 'From: RightJoint');

                $ntfLog['txt'].=$slUsr_row['user_id']." - ".$slUsr_row['eMail']."<br>";

            }else{
                $ntfLog['txt'].=$slUsr_row['user_id']." - no email<br>";
            }

            $ntfLog['txt'].="</p>";

        }
        else {

            $slUsr_qry = "select accounts_dt.user_id, accounts_dt.eMail from accounts_dt " .
                "INNER JOIN usersToGroups_dt ON accounts_dt.user_id = usersToGroups_dt.user_id WHERE accounts_dt.accMain_flag is TRUE " .
                "and usersToGroups_dt.group_id=" . $ntf_row['ntfSubscr'];

            if ($slUsr_res = $DB->query($slUsr_qry)) {
                if ($slUsr_res->rowCount() > 0) {
                    $slUsr_cnt = $slUsr_res->rowCount();
                }
            }

            $ntfLog['txt'].="<p>";

            if ($slUsr_cnt > 0) {

                $ntfLog['txt'].="<strong>".$slUsr_cnt."- users to send</strong><br>";

                while ($slUsr_row = $slUsr_res->fetch(PDO::FETCH_ASSOC)) {

                    $ntfList_rd = array("table" => "ntfList_dt", "field_id" => "ntfList_id");
                    $ntfList_rd['result']['ntf_id'] = $ntf_row['ntf_id'];
                    $ntfList_rd['result']['user_id'] = $slUsr_row['user_id'];

                    $DB->putOne($ntfList_rd);
                    $ntfList_rd['result']['ntfList_id'] = $DB->lastInsertId();

                    if ($slUsr_row['eMail']) {

                        $ntfLog['txt'].=$slUsr_row['user_id']." - ".$slUsr_row['eMail']."<br>";

                        $linkToRead=" ссылка для прочтения: ".
                            "http://rightjoint.ru/personal-page/notification/read/?ntfList_id=" . $ntfList_rd['result']['ntfList_id'];
                        mail($slUsr_row['eMail'], $ntf_row['ntfSubj'], $ntf_row['ntfDescr'].$linkToRead, 'From: RightJoint');

                    } else
                    {
                        $ntfLog['txt'].=$slUsr_row['user_id']." - no email<br>";
                    }
                }
            }else{
                $ntfLog['txt'].="-no users to send<br>";
            }
        }

        $ntfLog['txt'].="</p>";
        $ntfLog['txt'].="<hr>";
    }
    $updateNtf_qry="update ntf_dt set activeFlag = false WHERE activeFlag is TRUE";
    $DB->query($updateNtf_qry);
}else{
    $ntfLog['txt'].="<h2>no notifications to send</h2>";
}



