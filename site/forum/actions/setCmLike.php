<?php
$likeRes['err']=null;
$likeRes['likePlus']=0;
$likeRes['likeMinus']=0;

if($_SESSION['user_id']){
    if($_GET['fc_id'] and $_GET['fc_id']!=null){
        $youLike_qry="select * from forumCmLike_dt WHERE fc_id=".$_GET['fc_id']." and user_id=".$_SESSION['user_id'];
        $youLike_res=$DB->query($youLike_qry);
        $youLikeVal=false;
        if($_GET['likeVal']=='likePlus'){
            $youLikeVal=true;
        }
        $setLike_qry=null;
        if($youLike_res->rowCount() === 1){
            $youLike_row = $youLike_res->fetch(PDO::FETCH_ASSOC);
            if($youLikeVal != $youLike_row['likeStatus']){
                $setLike_qry="update forumCmLike_dt set likeStatus=";
                if($youLikeVal){
                    $setLike_qry.="TRUE ";
                }else{
                    $setLike_qry.="FALSE";
                }
                $setLike_qry.=", ".
                    "likeDate='".date_format($appRJ->date['curDate'], "Y-m-d H:i:s")."' where fc_id=".$_GET['fc_id'].
                    " and user_id=".$_SESSION['user_id'];
                if($DB->query($setLike_qry)){
                    if($youLikeVal){
                        $setCmLike_qry="update forumComments_dt set likePlus=likePlus+1, likeMinus=likeMinus-1 ".
                            "WHERE fc_id=".$_GET['fc_id'];
                    }else{
                        $setCmLike_qry="update forumComments_dt set likePlus=likePlus-1, likeMinus=likeMinus+1 ".
                            "WHERE fc_id=".$_GET['fc_id'];
                    }
                    $DB->query($setCmLike_qry);
                }
            }
        }else{
            $newLike_qry="insert into forumCmLike_dt (fc_id, likeStatus, user_id, likeDate) ".
                "VALUES (".$_GET['fc_id'].", ";
            if($youLikeVal){
                $newLike_qry.="TRUE ";
            }else{
                $newLike_qry.="FALSE";
            }
            $newLike_qry.=", ".$_SESSION['user_id'].", ".
                "'".date_format($appRJ->date['curDate'], "Y-m-d H:i:s")."')";
            $DB->query($newLike_qry);
            if($youLikeVal){
                $setCmLike_qry="update forumComments_dt set likePlus=likePlus+1 ".
                    "WHERE fc_id=".$_GET['fc_id'];
            }else{
                $setCmLike_qry="update forumComments_dt set likeMinus=likeMinus+1 ".
                    "WHERE fc_id=".$_GET['fc_id'];
            }
            $DB->query($setCmLike_qry);
        }
    }
}