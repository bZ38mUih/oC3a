<?php




require_once("/home/p264533/public_html/rightjoint.ru/source/DB_class.php");
require_once ("/home/p264533/public_html/rightjoint.ru/source/accessorial_class.php");
$DB=new DB();
$DB->connSettings=json_decode(@file_get_contents("/home/p264533/public_html/rightjoint.ru".$DB->pathToConn), true);
$DB->connect_db();
require_once ("/home/p264533/public_html/rightjoint.ru/source/recordDefault_class.php");
//$pageCont = file_get_contents("https://www.avito.ru/ivanovo/telefony");
//file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/avito-test.html", $pageCont);
//Array ( [noutbuki] => Array ( [err] => [totalCnt] => 47 [doubleCnt] => 0 [sussCnt] => 37 )
// [planshety_i_elektronnye_knigi] => Array ( [err] => [totalCnt] => 0 [doubleCnt] => 0 [sussCnt] => 0 )
// [telefony] => Array ( [err] => [totalCnt] => 0 [doubleCnt] => 0 [sussCnt] => 0 ) )
$parseRes=null;
$parseLog['noutbuki']['err']=null;
$parseLog['noutbuki']['totalCnt']=0;
$parseLog['noutbuki']['doubleCnt']=0;
$parseLog['noutbuki']['sussCnt']=0;
$parseLog['planshety_i_elektronnye_knigi']['err']=null;
$parseLog['planshety_i_elektronnye_knigi']['totalCnt']=0;
$parseLog['planshety_i_elektronnye_knigi']['doubleCnt']=0;
$parseLog['planshety_i_elektronnye_knigi']['sussCnt']=0;
$parseLog['telefony']['err']=null;
$parseLog['telefony']['totalCnt']=0;
$parseLog['telefony']['doubleCnt']=0;
$parseLog['telefony']['sussCnt']=0;
$CurDate = @date_create();
foreach ($parseLog as $key=>$value){
    //if($pageCont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/temp/avito-test.html")){
    if($pageCont = file_get_contents("https://www.avito.ru/ivanovo/".$key)){
        //$parseLog['telefony']['totalCnt']=0;
        while(strlen($pageCont)>100){
            $parseRD=new recordDefault("parseAdList_dt", "ad_id");
            $parseRD->result['adDate']=date_format($CurDate, "Y-m-d H:m:s");
            $parseRD->result['adType']=$key;
            if(!$posItem = strpos($pageCont, "item item_table ")){
                $parseLog[$key]['err'].="нет posItem<br>";
                break;
            }
            $parseLog[$key]['totalCnt']++;
            $pageCont=substr($pageCont, $posItem, strlen($pageCont));
            if(!$posRef1=strpos($pageCont, "class=\"title")){
                $parseLog[$key]['err'].="нет posRef1<br>";
                break;
            }
            $pageCont=substr($pageCont, $posRef1+17, strlen($pageCont));
            if(!$posRef2=strpos($pageCont, "href=\"")){
                $parseLog[$key]['err'].="нет posRef2<br>";
                break;
            }
            $pageCont=substr($pageCont, $posRef2+7, strlen($pageCont));
            if(!$posRef3=strpos($pageCont, "\"")){
                $parseLog[$key]['err'].="нет posRef3<br>";
                break;
            }
            $parseRD->result['prodRef']=urlencode(substr($pageCont, 0 , $posRef3));
            if(!accessorialClass::checkDouble("parseAdList_dt", "prodRef", $parseRD->result['prodRef'])){
                $parseLog[$key]['doubleCnt']++;
                break;
            }
            if(!$posProdName1=strpos($pageCont, "<span itemprop=\"name\">")){
                $parseLog[$key]['err'].="нет posProdName1<br>";
                break;
            }
            $pageCont=substr($pageCont, $posProdName1+22, strlen($pageCont));
            if(!$posProdName2=strpos($pageCont, "</span>")){
                $parseLog[$key]['err'].="нет posProdName2<br>";
                break;
            }
            $parseRD->result['prodName']=substr($pageCont, 0, $posProdName2);
            $pageCont=substr($pageCont, $posProdName2+7, strlen($pageCont));
            if(!$posPrice1=strpos($pageCont, "<span class=\"price\" itemprop=\"price\" content=\"")){
                $parseLog[$key]['err'].="нет posPrice1<br>";
                break;
            }
            $pageCont=substr($pageCont, $posPrice1+46, strlen($pageCont));
            if(!$posPrice2=strpos($pageCont, "\">")){
                $parseLog[$key]['err'].="нет posPrice2<br>";
                break;
            }
            $parseRD->result['prodPrice']=substr($pageCont, 0, $posPrice2);
            $pageCont=substr($pageCont, $posPrice2+2, strlen($pageCont));
            if(!$posComp1=strpos($pageCont, "<div class=\"data\">")){
                $parseLog[$key]['err'].="нет posComp1<br>";
                break;
            }
            $pageCont=substr($pageCont, $posComp1+18, strlen($pageCont));
            if(!$posComp2=strpos($pageCont, "<p>")){
                $parseLog[$key]['err'].="нет posComp2<br>";
                break;
            }
            if(!$prodComp=substr($pageCont, 0, $posComp2)){
                $parseRD->result['prodComp']=null;
            }elseif(strlen($prodComp)==34){
                $parseRD->result['prodComp']=null;
            }else{
                $parseRD->result['prodComp']=strlen($prodComp)."-".$prodComp;
            }
            //$descrCont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/temp/parse-ad/".$parseRD->result['prodRef'].".html");
            if(!$descrCont = file_get_contents("https://avito.ru/".urldecode($parseRD->result['prodRef']))){
                $parseLog[$key]['err'].="невозможно открыть описание<br>";
                break;
            };
            //file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/parse-ad/".urlencode($parseRD->result['prodRef']).".html", $descrCont);
            if(!$posSaler1=strpos($descrCont, "seller-info-prop js-seller-info-prop_seller-name")){
                $parseLog[$key]['err'].="нет posSaler1<br>";
                break;
            }
            $dC=substr($descrCont, $posSaler1, strlen($descrCont));
            if(!$posSaler2=strpos($dC, "<div>")){
                $parseLog[$key]['err'].="нет posSaler2<br>";
                break;
            }
            $dC=substr($dC, $posSaler2+5, strlen($descrCont));
            if(!$posSaler3=strpos($dC, "</div>")){
                $parseLog[$key]['err'].="нет posSaler3<br>";
                break;
            }
            if(!$parseRD->result['prodSaler']=substr($dC, 0, $posSaler3)){
                $parseLog[$key]['err'].="нет prodSaler<br>";
                break;
            }
            if(!$posDescr1=strpos($descrCont, "class=\"item-description\"")){
                $parseLog[$key]['err'].="нет posDescr1<br>";
                break;
            }
            $descrCont=substr($descrCont, $posDescr1+25, strlen($descrCont));
            if(!$posDescr2=strpos($descrCont, "</div>")){
                $parseLog[$key]['err'].="нет posDescr2<br>";
                break;
            }
            $parseRD->result['prodDescr']=substr($descrCont, 0, $posDescr2);
            /*
            $parseRes.="<div class='line ad'>".
                "<div class='ad_id'><a href='https://avito.ru/".$parseRD->result['prodRef']."' target='_blank'>".$adCount."</a></div>".
                "<div class='prodName'>".$parseRD->result['prodName']."</div><div class='prodComp'>";
            if(!$parseRD->result['prodComp']){
                $parseRes.="-";
            }else{
                $parseRes.=$parseRD->result['prodComp'];
            }
            $parseRes.="</div>".
                "<div class='prodSaler'>".$parseRD->result['prodSaler']."</div><div class='prodPrice'>".$parseRD->result['prodName']."</div>".
                "<div class='prodDescr'>".$parseRD->result['prodDescr']."</div>".
                "</div></div>";
            */
            if($parseLog[$key]['totalCnt']>100){
                $parseLog[$key]['err'].="max totalCnt<br>";
                break;
            }
            if($parseRD->putOne()){
                $parseLog[$key]['sussCnt']++;
            }else{
                $parseLog[$key]['err'].="fail putOne<br>";
            }
        }
    }else{
        $parseLog[$key]['err'].="невозможно открыть страницу<br>";
    }
}
print_r($parseLog);
exit;