<?php
$selectCat_query = "select * from dwlCat_dt";
$selectCat_res=$DB->doQuery($selectCat_query);
$catCount=0;
if(mysql_num_rows($selectCat_res)>0){
    $catCount=mysql_num_rows($selectCat_res);
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'>".
    "<div class='itemsCount'>Всего: <span>".$catCount."</span> записей</div>".
    "<div class='newItem'><a href='newCat/'><img src='/source/img/create-icon.png'>Создать категорию</a>".
    "</div></div>";
if($catCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>".
        "<div class='item-line-id'>cat_id</div>".
        "<div class='item-line-par_id'>catPar_id</div>".
        "<div class='item-line-img'>catImg</div>".
        "<div class='item-line-name'>catName</div>".
        "<div class='item-line-alias'>catAlias</div>".
        "<div class='item-line-descr'>catDescr</div>".
        "<div class='item-line-flag'>actFlag</div>".
        "</div>";
    while ($selectCat_row=$DB->doFetchRow($selectCat_res)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-id'>".
            "<a href='editCat/?cat_id=".$selectCat_row['dwlCat_id']."'>".$selectCat_row['dwlCat_id']."</a></div>".
            "<div class='item-line-par_id'>";
        if($selectCat_row['dwlCatPar_id']){
            $appRJ->response['result'].= "<a href='editCat/?cat_id=".$selectCat_row['dwlCatPar_id']."'>".
                $selectCat_row['dwlCatPar_id']."</a>";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-img'>";
        if($selectCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id']."/preview/".$selectCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name'>".$selectCat_row['catName']."</div>".
            "<div class='item-line-alias'>".$selectCat_row['catAlias']."</div>".
            "<div class='item-line-descr'>";
        if($selectCat_row['catDescr']){
            $appRJ->response['result'].= mb_substr($selectCat_row['catDescr'],0, 20, 'UTF-8')." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-flag'><input type='checkbox' ";
        if($selectCat_row['catActive_flag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no categ there<br>";
}
$appRJ->response['result'].= "</div>";