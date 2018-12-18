<?php
$likeRes['err']=null;
$likeRes['likePlus']=0;
$likeRes['likeMinus']=0;

if($_SESSION['user_id']){
    if($_GET['artCm_id'] and $_GET['artCm_id']!=null){
        $youLike_qry="select * from artCmLike_dt WHERE artCm_id=".$_GET['artCm_id']." and user_id=".$_SESSION['user_id'];
        $youLike_res=$DB->doQuery($youLike_qry);
        $youLikeVal=false;
        if($_GET['likeVal']=='likePlus'){
            $youLikeVal=true;
        }
        $setLike_qry=null;
        if(mysql_num_rows($youLike_res)===1){
            $youLike_row=$DB->doFetchRow($youLike_res);
            if($youLikeVal != $youLike_row['likeStatus']){
                $setLike_qry="update artCmLike_dt set likeStatus=";
                if($youLikeVal){
                    $setLike_qry.="TRUE ";
                }else{
                    $setLike_qry.="FALSE";
                }
                $setLike_qry.=", ".
                    "likeDate='".date_format($appRJ->date['curDate'], "Y-m-d H:i:s")."' where artCm_id=".$_GET['artCm_id'].
                    " and user_id=".$_SESSION['user_id'];
                if($DB->doQuery($setLike_qry)){
                    if($youLikeVal){
                        $setCmLike_qry="update artComments_dt set likePlus=likePlus+1, likeMinus=likeMinus-1 ".
                            "WHERE artCm_id=".$_GET['artCm_id'];
                    }else{
                        $setCmLike_qry="update artComments_dt set likePlus=likePlus-1, likeMinus=likeMinus+1 ".
                            "WHERE artCm_id=".$_GET['artCm_id'];
                    }
                    $DB->doQuery($setCmLike_qry);
                }
            }
        }else{
            $newLike_qry="insert into artCmLike_dt (artCm_id, likeStatus, user_id, likeDate) ".
                "VALUES (".$_GET['artCm_id'].", ";
            if($youLikeVal){
                $newLike_qry.="TRUE ";
            }else{
                $newLike_qry.="FALSE";
            }
            $newLike_qry.=", ".$_SESSION['user_id'].", ".
                "'".date_format($appRJ->date['curDate'], "Y-m-d H:m:s")."')";
            $DB->doQuery($newLike_qry);
            if($youLikeVal){
                $setCmLike_qry="update artComments_dt set likePlus=likePlus+1 ".
                    "WHERE artCm_id=".$_GET['artCm_id'];
            }else{
                $setCmLike_qry="update artComments_dt set likeMinus=likeMinus+1 ".
                    "WHERE artCm_id=".$_GET['artCm_id'];
            }
            $DB->doQuery($setCmLike_qry);
        }
    }
}