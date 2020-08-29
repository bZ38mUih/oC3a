<?php
$selectCat_query = "select * from forumMenu_dt";
$selectCat_res=$DB->query($selectCat_query);
$catCount=0;
if(mysql_num_rows($selectCat_res)>0){
    $catCount=mysql_num_rows($selectCat_res);
}
$appRJ->response['result'].= "<div class='manFrame'>".
    "<div class='manTopPanel'><div class='itemsCount'>Всего: <span>".$catCount."</span> записей</div>".
    "<div class='newItem'><a href='/forum/forummanager/newCat'><img src='/source/img/create-icon.png'>".
    "Создать категорию</a></div></div>";
if($catCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>".
        "<div class='item-line-id'>cat_id</div>".
        "<div class='item-line-par_id'>catPar_id</div>".
        "<div class='item-line-img'>catImg</div>".
        "<div class='item-line-name'>catName</div>".
        "<div class='item-line-alias'>catAlias</div>".
        "<div class='item-line-descr'>catDescr</div>".
        "<div class='item-line-flag'>actFlag</div></div>";
    while ($selectCat_row = $selectCat_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].= "<div class='item-line'>".
            "<div class='item-line-id'>".
            "<a href='/forum/forummanager/editCat/?fm_id=".$selectCat_row['fm_id']."'>".
            $selectCat_row['fm_id']."</a></div>".
            "<div class='item-line-par_id'>";
        if($selectCat_row['fm_pid']){
            $appRJ->response['result'].= "<a href='/forum/forummanager/editCat/?fm_id=".$selectCat_row['fm_pid']."'>".$selectCat_row['fm_pid']."</a>";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-img'>";
        if($selectCat_row['mImg']){
            $appRJ->response['result'].= "<img src='".F_CAT_IMG.$selectCat_row['fm_id']."/preview/".$selectCat_row['mImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name'>". $selectCat_row['mName']."</div>".
            "<div class='item-line-alias'>".$selectCat_row['mAlias']."</div>".
            "<div class='item-line-descr'>";
        if($selectCat_row['mDescr']){
            $appRJ->response['result'].= mb_substr($selectCat_row['mDescr'],0, 20, 'UTF-8')." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($selectCat_row['mActive']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no categ there<br>";
}
$appRJ->response['result'].= "</div>";