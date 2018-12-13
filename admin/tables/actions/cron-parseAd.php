<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");

//$pageCont = file_get_contents("https://www.avito.ru/ivanovo/telefony");
//file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/avito-test.html", $pageCont);
if($pageCont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/temp/avito-test.html")){
    $adCount=0;
    $parseRes=null;
    while(strlen($pageCont)>100){
        $parseRD=new recordDefault("parseAdList_dt", "ad_id");
        $parseRD->result['adType']="avito-notebooks";
        $adCount++;
        $prodDescr=null;
        $prodSaler=null;
        if(!$posItem = strpos($pageCont, "item item_table ")){
            break;
        }
        $pageCont=substr($pageCont, $posItem, strlen($pageCont));
        if(!$posRef1=strpos($pageCont, "class=\"title")){
            break;
        }
        $pageCont=substr($pageCont, $posRef1+17, strlen($pageCont));
        if(!$posRef2=strpos($pageCont, "href=\"")){
            break;
        }
        $pageCont=substr($pageCont, $posRef2+7, strlen($pageCont));
        if(!$posRef3=strpos($pageCont, "\"")){
            break;
        }
        $parseRD->result['prodRef']=urlencode(substr($pageCont, 0 , $posRef3));
        if(!accessorialClass::checkDouble("parseAdList_dt", "prodRef", $parseRD->result['prodRef'])){
            break;
        }
        if(!$posProdName1=strpos($pageCont, "<span itemprop=\"name\">")){
            break;
        }
        $pageCont=substr($pageCont, $posProdName1+22, strlen($pageCont));
        if(!$posProdName2=strpos($pageCont, "</span>")){
            break;
        }
        $parseRD->result['prodName']=substr($pageCont, 0, $posProdName2);
        $pageCont=substr($pageCont, $posProdName2+7, strlen($pageCont));
        if(!$posPrice1=strpos($pageCont, "<span class=\"price\" itemprop=\"price\" content=\"")){
            break;
        }
        $pageCont=substr($pageCont, $posPrice1+46, strlen($pageCont));
        if(!$posPrice2=strpos($pageCont, "\">")){
            break;
        }
        $parseRD->result['prodName']=substr($pageCont, 0, $posPrice2);
        $pageCont=substr($pageCont, $posPrice2+2, strlen($pageCont));
        if(!$posComp1=strpos($pageCont, "<div class=\"data\">")){
            break;
        }
        $pageCont=substr($pageCont, $posComp1+18, strlen($pageCont));
        if(!$posComp2=strpos($pageCont, "<p>")){
            break;
        }
        if(!$prodComp=substr($pageCont, 0, $posComp2)){
            $parseRD->result['prodComp']=null;
        }elseif(urlencode($parseRD->result['prodComp'])=="%0A++++++++++++++++++++%3C%2Fp%3E%0A++++++++"){
            $parseRD->result['prodComp']=null;
        }else{
            $parseRD->result['prodComp']=$prodComp;
        }


        $descrCont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/temp/parse-ad/".urlencode($parseRD->result['prodRef']).".html");
        //$descrCont = file_get_contents("https://avito.ru/".$parseRD->result['prodRef']);
        //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/parse-ad/".urlencode($parseRD->result['prodRef']).".html", $descrCont);
        if(!$posSaler1=strpos($descrCont, "seller-info-prop js-seller-info-prop_seller-name")){
            break;
        }
        $dC=substr($descrCont, $posSaler1, strlen($descrCont));
        if(!$posSaler2=strpos($dC, "<div>")){
            break;
        }
        $dC=substr($dC, $posSaler2+5, strlen($descrCont));
        if(!$posSaler3=strpos($dC, "</div>")){
            break;
        }
        if(!$prodSaler=substr($dC, 0, $posSaler3)){
            echo "no-saler<br>";
            break;
        }
        if(!$posDescr1=strpos($descrCont, "class=\"item-description\"")){
            break;
        }
        $descrCont=substr($descrCont, $posDescr1+25, strlen($descrCont));
        if(!$posDescr2=strpos($descrCont, "</div>")){
            break;
        }
        $prodDescr=substr($descrCont, 0, $posDescr2);
        $parseRes.="<div class='line ad'>".
            "<div class='ad_id'><a href='https://avito.ru/".$parseRD->result['prodRef']."' target='_blank'>".$adCount."</a></div>".
            "<div class='prodName'>".$parseRD->result['prodName']."</div><div class='prodComp'>";
        if($parseRD->result['prodComp']){
            $parseRes.=$parseRD->result['prodComp'];
        }else{
            $parseRes.=" - ";
        }
        $parseRes.="</div>".
            "<div class='prodSaler'>".$prodSaler."</div><div class='prodPrice'>".$parseRD->result['prodName']."</div>".
            "<div class='prodDescr'>".$prodDescr."</div>".
            "</div></div>";
        if($adCount>10){
            break;
        }
    }
    echo $parseRes;
}
exit;