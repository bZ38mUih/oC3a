<?php
function printFMenuList($artCatPar_id=null, $DB)
{
    $tmpRes['text']=null;
    $tmpRes['cntCat']=null;
    $tmpRes['cntItm']=null;
    if($artCatPar_id ==null){
        $selectCat_query = "select * from forumMenu_dt WHERE fm_pid is null and mActive is TRUE";
        $slArt_qry="select * from forumSubj_dt WHERE fm_id is null and activeFlag is TRUE";
    }else{
        $selectCat_query = "select * from forumMenu_dt WHERE fm_pid = ".$artCatPar_id." and mActive is TRUE";
        $slArt_qry="select * from forumSubj_dt WHERE fm_id = ".$artCatPar_id." and activeFlag is TRUE";
    }
    $slArt_res=$DB->query($slArt_qry);
    $artCount=0;
    if(mysql_num_rows($slArt_res)>0){
        $artCount=mysql_num_rows($slArt_res);
    }
    $selectCat_res=$DB->query($selectCat_query);
    $catCount=0;
    if(mysql_num_rows($selectCat_res)>0){
        $catCount=mysql_num_rows($selectCat_res);
    }
    if($catCount>0 or $artCount>0){
        $tmpRes['text'].= "<ul>";
        if($artCount>0){
            while ($slArt_row = $slArt_res->fetch(PDO::FETCH_ASSOC)){
                $tmpItm=null;
                $tmpItm.="<li class='itm-line'><a href='/forum/".$slArt_row['sAlias']."'>".
                    "<div class='itm-line-img'>";
                if($slArt_row['sImg']){
                    $tmpItm.= "<img src='".F_SUBJ_IMG.$slArt_row['fs_id']."/preview/".$slArt_row['sImg']."'>";
                }else{
                    $tmpItm.= "<img src='/data/default-img.png'>";
                }
                $tmpItm.= "</div><div class='itm-line-txt'><div class='itm-line-name'>".$slArt_row['sName'].
                    "</div><div class='itm-line-descr'>";
                if($slArt_row['metaDescr']){
                    $tmpItm.= mb_substr($slArt_row['metaDescr'],0, 50, 'UTF-8')." ...";;
                }else{
                    $tmpItm.= "-";
                }
                $tmpItm.= "</div></div></a></li>";
                $tmpRes['text'].=$tmpItm;
                $tmpRes['cntItm']=$artCount;
            }
        }
        if($catCount>0){
            while ($selectCat_row = $selectCat_res->fetch(PDO::FETCH_ASSOC)){
                $tmpCat=null;
                $tmpCat.="<li class='cat-line'><a href='javascript: Void(0)'>".
                    "<div class='cat-line-img'>";
                if($selectCat_row['mImg']){
                    $tmpCat.= "<img src='".F_CAT_IMG.$selectCat_row['fm_id']."/preview/".$selectCat_row['mImg']."'>";
                }else{
                    $tmpCat.= "<img src='/data/default-img.png'>";
                }
                $tmpCat.= "</div><div class='cat-line-txt'><div class='cat-line-name'>".$selectCat_row['mName'].
                    "</div><div class='cat-line-descr'>";
                if($selectCat_row['mDescr']){
                    $tmpCat.= $selectCat_row['mDescr'];
                }else{
                    $tmpCat.= "-";
                }
                $tmpCat.= "</div></div></a>";
                $tmpRes['text'].=$tmpCat;
                $responce=printFMenuList($selectCat_row['fm_id'], $DB);
                $tmpRes['cntCat']=$catCount+$responce['cntCat'];
                $tmpRes['cntItm']+=$responce['cntItm'];

                if(isset($responce['cntItm']) or isset($responce['cntCat'])){
                    $tmpRes['text'].="<div class='cat-stat'>";
                    if($responce['cntItm']){
                        $tmpRes['text'].= "<span class='flVal'>".$responce['cntItm']."</span> файл.";
                    }
                    if($responce['cntCat']){
                        $tmpRes['text'].= "<span class='flVal'>".$responce['cntCat']."</span> кат.";
                    }
                    $tmpRes['text'].="<span class='slide-stat'>[-]</span></div>";
                }
                $tmpRes['text'].=$responce['text'];
                $tmpRes['text'].="</li>";
            }
        }
        $tmpRes['text'].="</ul>";
    }
    return $tmpRes;
}