<?php
$cardErr=null;
$Card_rd = new recordDefault("srvCards_dt", "card_id");
if(isset($_POST['cardName']) and $_POST['cardName']!=null){
    $Card_rd->result['cardName']=htmlspecialchars($_POST['cardName']);
}else{
    $cardErr['cardName']='недопустимое название';
}
if(isset($_POST['cardAlias']) and $_POST['cardAlias']!=null){
    $Card_rd->result['cardAlias']=htmlspecialchars($_POST['cardAlias']);
}else{
    $cardErr['cardAlias']='недопустимый alias';
}
if(isset($_POST['shortDescr'])){
    $Card_rd->result['shortDescr']=htmlspecialchars($_POST['shortDescr']);
}else{
    $Card_rd->result['shortDescr']=null;
}
if(isset($_POST['srvCat_id'])){

    if($_POST['srvCat_id'] == 'none'){
        $Card_rd->result['srvCat_id']=null;
    }else{
        $Card_rd->result['srvCat_id']=$_POST['srvCat_id'];
    }
}
if(isset($_POST['cardPrice']) and $_POST['cardPrice']>=1000){
    $Card_rd->result['cardPrice']=htmlspecialchars($_POST['cardPrice']);
}else{
    $cardErr['cardPrice']='недопустимая цена';
}
if(isset($_POST['cardCurr']) and $_POST['cardCurr']<1000 and $_POST['cardCurr']>1){
    $Card_rd->result['cardCurr']=htmlspecialchars($_POST['cardCurr']);
}else{
    $cardErr['cardCurr']='недопустимая валюта';
}
if(isset($_POST['cardActive']) and $_POST['cardActive']=='on'){
    $Card_rd->result['cardActive']=true;
}else{
    $Card_rd->result['cardActive']=false;
}
$Card_rd->result['sortDate'].= date_format($appRJ->date['curDate'], 'Y-m-d');
if(isset($cardErr)){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/services/views/srvMan-newService.php");
}else{
    if($Card_rd->putOne()){
        $page = "Location: /services/srvMan/editCard/?card_id=".$Card_rd->result['card_id'];
        header($page);
    }else{
        $appRJ->response['result'].= "444-zhopa<br>";
    }
}