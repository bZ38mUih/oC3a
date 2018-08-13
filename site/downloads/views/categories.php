<?php

$selectCat_query = "select * from dwlCat_dt";
$selectCat_res=$DB->doQuery($selectCat_query);
$catCount=0;

if(mysql_num_rows($selectCat_res)>0){
    $catCount=mysql_num_rows($selectCat_res);
}

$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$catCount."</span> записей";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='newCat/'><img src='/source/img/create-icon.png'>Создать категорию</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($catCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "cat_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-par_id'>";
    $appRJ->response['result'].= "catPar_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "catImg";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-name'>";
    $appRJ->response['result'].= "catName";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= "catAlias";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-descr'>";
    $appRJ->response['result'].= "catDescr";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "actFlag";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    while ($selectCat_row=$DB->doFetchRow($selectCat_res)){

        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='editCat/?cat_id=".$selectCat_row['dwlCat_id']."'>".$selectCat_row['dwlCat_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-par_id'>";
        if($selectCat_row['dwlCatPar_id']){
            $appRJ->response['result'].= "<a href='editCat/?cat_id=".$selectCat_row['dwlCatPar_id']."'>".$selectCat_row['dwlCatPar_id']."</a>";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($selectCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id']."/preview/".$selectCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-name'>";
        $appRJ->response['result'].= $selectCat_row['catName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-alias'>";
        $appRJ->response['result'].= $selectCat_row['catAlias'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-descr'>";
        if($selectCat_row['catDescr']){
            $appRJ->response['result'].= mb_substr($selectCat_row['catDescr'],0, 20, 'UTF-8')." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($selectCat_row['catActive_flag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no categ there<br>";
}
$appRJ->response['result'].= "</div>";