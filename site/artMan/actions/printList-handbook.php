<?php
function printList($artCatPar_id=null, $DB, $ref)
{
    $tmpRes['text']=null;
    $tmpRes['cntCat']=null;
    $tmpRes['cntItm']=null;
    if($artCatPar_id ==null){
        $selectCat_query = "select * from artCat_dt WHERE artCatPar_id is null and activeFlag is TRUE";
        $slArt_qry="select * from art_dt WHERE artCat_id is null and activeFlag is TRUE";
    }else{
        $selectCat_query = "select * from artCat_dt WHERE artCatPar_id = ".$artCatPar_id." and activeFlag is TRUE";
        $slArt_qry="select * from art_dt WHERE artCat_id = ".$artCatPar_id." and activeFlag is TRUE";
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
                $tmpItm.="<li class='itm-line'><a href='/".$ref."/".$slArt_row['artAlias']."'>".
                    "<div class='itm-line-img'>";
                if($slArt_row['artImg']){
                    $tmpItm.= "<img src='".ARTS_IMG_PAPH.$slArt_row['art_id']."/preview/".$slArt_row['artImg']."'>";
                }else{
                    $tmpItm.= "<img src='/data/default-img.png'>";
                }
                $tmpItm.= "</div><div class='itm-line-txt'><div class='itm-line-name'>".$slArt_row['artName'].
                    "</div><div class='itm-line-descr'>";
                if($slArt_row['artMeta']){
                    $tmpItm.= mb_substr($slArt_row['artMeta'],0, 50, 'UTF-8')." ...";;
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
                //$tmpCat.="<li class='cat-line'><a href='/".$ref."/".$selectCat_row['catAlias']."'>".
                $tmpCat.="<li class='cat-line'><a href='javascript: Void(0)'>".
                    "<div class='cat-line-img'>";
                if($selectCat_row['catImg']){
                    $tmpCat.= "<img src='".ART_CATEG_IMG_PAPH.$selectCat_row['artCat_id']."/preview/".$selectCat_row['catImg']."'>";
                }else{
                    $tmpCat.= "<img src='/data/default-img.png'>";
                }
                $tmpCat.= "</div><div class='cat-line-txt'><div class='cat-line-name'>".$selectCat_row['catName'].
                    "</div><div class='cat-line-descr'>";
                if($selectCat_row['catDescr']){
                    $tmpCat.= $selectCat_row['catDescr'];
                }else{
                    $tmpCat.= "-";
                }
                $tmpCat.= "</div></div></a>";
                $tmpRes['text'].=$tmpCat;
                $responce=printList($selectCat_row['artCat_id'], $DB, $ref);
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
