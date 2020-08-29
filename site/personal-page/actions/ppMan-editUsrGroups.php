<?php

foreach ($_POST as $key=>$value){
    if(substr($key, 0, 5)=='grId_'){
        $grId=substr($key, 5, strlen($key)-5);
        if($grId!=null and $value != null){
            $groupRD = array("table" => "usersGroups_dt", "field_id" => "group_id");
            $groupRD['result']['group_id']=$grId;
            if($groupRD = $DB->copyOne($groupRD)){
                if($value=="OFF"){
                    $delUserGr_text="delete from usersToGroups_dt where user_id=".$_GET['user_id'].
                        " and group_id=".$grId;
                    if($DB->query($delUserGr_text)===true){
                        $editUsrGrLog['log'].= $groupRD['result']['groupAlias']." - > OFF<br>";
                    }else{
                        $editUsrGrLog['log'].= $groupRD['result']['groupAlias']." - > WARNING: deleted fail<br>";
                    }
                }else{
                    $selUserGr_text="select * from usersToGroups_dt where user_id=".$_GET['user_id'].
                        " and group_id=".$grId;
                    $selUserGr_res = $DB->query($selUserGr_text);
                    if($selUserGr_res->rowCount() == 1){
                        $updateUserGr_text="update usersToGroups_dt set rules=".$value." where user_id=".$_GET['user_id'].
                            " and group_id=".$grId;
                        if($DB->query($updateUserGr_text)===true){
                            $editUsrGrLog['log'].= $groupRD['result']['groupAlias']." - > updated success<br>";
                        }else{
                            $editUsrGrLog['log'].= $groupRD['result']['groupAlias']." - > updated fail<br>";
                        }
                    }else{
                        $addUsrGr_text="insert into usersToGroups_dt (group_id, user_id, rules) values ".
                            "(".$grId.", ".$_GET['user_id'].", ".$value.")";
                        if($DB->query($addUsrGr_text)===true){
                            $editUsrGrLog['log'].= $groupRD['result']['groupAlias']." - > inserts success<br>";
                        }else{
                            $editUsrGrLog['log'].= $groupRD['result']['groupAlias']." - > inserts fail<br>".$addUsrGr_text;
                        }
                    }
                }
            }else{
                $editUsrGrLog['log'].= "не найдена группа - > group_id = ".$grId."<br>";
            }
        }
    }else{
        //$editUsrGrLog['log'].= "неправильный параметр group_id - > ".$key."<br>";
    }
}
$editUsrGrLog['result']=true;

require_once ($_SERVER['DOCUMENT_ROOT']."/site/personal-page/views/ppMan-usersGroups.php");