<?php
$createBlogMenu_qry = "select count(art_dt.art_id) as cnt, artCat_dt.catAlias from art_dt ".
    "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
    "where art_dt.activeFlag is true and artCat_dt.artCat_id in (1, 3) group by artCat_dt.catAlias";
$createBlogMenu_res = $DB->query($createBlogMenu_qry);

$blogMenuCount = array();
while ($createBlogMenu_row = $createBlogMenu_res->fetch(PDO::FETCH_ASSOC)){
    $blogMenuCount[$createBlogMenu_row['catAlias']] = $createBlogMenu_row['cnt'];
}
$createBlogMenu_txt = "<div class = 'blog-menu'>".
    "<a href='/blog?listCount=".$listCount."' ";
if(!$appRJ->server['reqUri_expl'][2]) {
    $createBlogMenu_txt .= "class='active'";
}
$createBlogMenu_txt .=" title='it-блог на rightjoint.ru' ".
    "onclick='event.preventDefault(); blogMenu(this, "."null".")'".
    "><img src='/site/blog/img/logo.png?listCount=".$listCount."'>Все (".intval($blogMenuCount['dev'] + $blogMenuCount['pc']).")</a>".
    "<a href='/blog/pc' ";
if($appRJ->server['reqUri_expl'][2] == 'pc') {
    $createBlogMenu_txt .= "class='active'";
}
$createBlogMenu_txt .= " title='Ремонт и настройка компьютеров' ".
    "onclick='event.preventDefault(); blogMenu(this, ".'"pc"'.")'".
    "><img src='/site/pc/img/logo.png'>Компьютеры (".intval($blogMenuCount['pc']).")</a>".
    "<a href='/blog/dev?listCount=".$listCount."' ";
if($appRJ->server['reqUri_expl'][2] == 'dev') {
    $createBlogMenu_txt .= "class='active'";
}
$createBlogMenu_txt .= " title='Блог о программировании' ".
    "onclick='event.preventDefault(); blogMenu(this, ".'"dev"'.")'".
    "><img src='/site/dev/img/logo.png'>Программирование (".intval($blogMenuCount['dev']).")</a>".
    "</div>";