<?php
$findArts_qry = "select art_dt.art_id, art_dt.artName, art_dt.artMeta, art_dt.artImg, art_dt.allowCm, artCat_dt.catAlias, ".
    "artCat_dt.catName, artCat_dt.artCat_id, art_dt.artAlias, art_dt.pubDate, art_dt.refreshDate from art_dt ".
    "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
    "where art_dt.activeFlag is true ".$q_where."order by art_dt.pubDate desc";

$findArts_res = $DB->query($findArts_qry);

$length = 2;        //optional: count cells in table row
$pag_length = 2;    //optional:

$art_count = $findArts_res->rowCount();

$art_page = null;

if($findArts_res->rowCount()) {
    $counter = 0;
    $len_cnt = 0;
    while ($findArts_row = $findArts_res->fetch(PDO::FETCH_ASSOC)){
        $ref = null;
        if($findArts_row['artCat_id'] == 1){
            $ref = "pc";
        }else{
            $ref = "dev";
        }
        if(($counter >= ($curPage-1)*$listCount) and ($counter < $curPage*$listCount)  ){
            if($len_cnt == $length){
                $len_cnt = 0;
            }

            if($len_cnt == 0){
                $art_page .= "<div class='alw-".$length."'>";
            }
            $printDate = null;
            if($findArts_row['refreshDate']){
                $printDate = "Обновлено: ".$findArts_row['refreshDate'];
            }else{
                $printDate = "Опубликовано: ".$findArts_row['pubDate'];
            }

            $art_page .= "<div class='art-list'>".
                "<img src='".ARTS_IMG_PAPH.$findArts_row['art_id']."/preview/".$findArts_row['artImg']."' alt='art-img'>".
                "<div class='al-header'><a href='/".$ref."/".$findArts_row['artAlias']."'  title='Читать статью на rightjoint.ru'>".$findArts_row['artName']."</a>".
                "<hr></div><div class='al-refresh'>".$printDate."</div>".
                "<div class='al-meta'>".$findArts_row['artMeta']."</div>".
                "<a class='viewArt' href='/".$ref."/".$findArts_row['artAlias']."' title='Читать статью на rightjoint.ru'>Подробнее</a>".
                "</div>";
            if(($len_cnt + 1) == $length){
                $art_page .= "</div>";
            }
            $len_cnt++;
        }
        $counter++;
    }

}
if($len_cnt != $length){

    for ($i = 1; $i <= ($length-$len_cnt); $i++){
        $art_page .= "<div style='display: table-cell'></div>";
    }

    $art_page .= "</div>";
}

if(round($art_count/$listCount) - $art_count/$listCount < 0){
    $page_count = round($art_count/$listCount) + 1;
}else{
    $page_count =  round($art_count/$listCount);
}

$p_add_num_start = 0;
$p_add_num_end = 0;
if($curPage - $pag_length < 1){
    $p_add_num_start = $pag_length - $curPage +1;
}

$end_p_num = $curPage + $pag_length + $p_add_num_start;
if($end_p_num > $page_count){
    $end_p_num = $page_count;
}

$start_p_num = $curPage - $pag_length + $p_add_num_start;// - $p_add_num_end;
if($end_p_num - $pag_length*2  < $start_p_num){
    $start_p_num = $end_p_num - $pag_length*2;
}
if($start_p_num < 1){
    $start_p_num = 1;
}
$page_list = null;
for ($i = $start_p_num; $i <= $end_p_num; $i++){
    if ($curPage == $i){
        $page_list .= "<a class = 'p_num active'  href = '#'>".$i."</a>";
    }else{
        if($i == 1){
            $page_list .= "<a class = 'p_num'  href = '/blog".$blog_cat."?listCount=".$listCount."' ".
                "onclick='event.preventDefault(); blogPage(null, ".'"'.$req_cat.'"'.", ".$listCount." )'".
                ">".$i."</a>";
        }else{
            $page_list .= "<a class = 'p_num'  href = '/blog".$blog_cat."?curPage=".$i."&listCount=".$listCount."' ".
                "onclick='event.preventDefault(); blogPage(".$i.", ".'"'.$req_cat.'"'.", ".$listCount." )'".
                ">".$i."</a>";
        }
    }
}
$btn_nex = null;
$btn_pre = null;
if($curPage < $page_count){
    $btn_nex = "<a class='p_btn next active' href = '/blog".$blog_cat."?curPage=".($curPage+1)."&listCount=".$listCount."' title='на предыдущую' ".
        " onclick='event.preventDefault(); blogPage(".($curPage+1).", ".'"'.$req_cat.'"'.", ".$listCount." )'".
        ">след.</a>";
}else {
    $btn_nex = "<a class='p_btn next' href = '#' title='на предыдущую'>след.</a>";
}

if ($curPage > 1){
    if($curPage-1 == 1){
        $btn_pre = "<a class='p_btn prev active' href = '/blog".$blog_cat."?listCount=".$listCount."' title='на предыдущую' ".
            "onclick='event.preventDefault(); blogPage(null, ".'"'.$req_cat.'"'.", ".$listCount." )'".
            ">пред.</a>";
    }else{
        $btn_pre = "<a class='p_btn prev active' href = '/blog".$blog_cat."?curPage=".($curPage-1)."&listCount=".$listCount."' title='на предыдущую' ".
            "onclick='event.preventDefault(); blogPage(".($curPage-1).", ".'"'.$req_cat.'"'.", ".$listCount." )'".
            ">пред.</a>";
    }
}else {
    $btn_pre = "<a class='p_btn prev' href = '#' title='на предыдущую'>пред.</a>";
}
$pl_text = "<div class='pl_text'><span>На стр., по: </span>";
$pl_arr = array(1 => false, 2 => false, 3 => false, 4 => false);
foreach ($pl_arr as $p_count => $p_active){
    if($p_count == $listCount){
        $pl_arr[$p_count] = true;
        $pl_text .= "<a class='p_num active' href='#'>".$p_count."</a>";
    }else{
        $pl_text .= "<a class='p_num' href='/blog".$blog_cat."?curPage=".$curPage."&listCount=".$p_count."' ".
            "onclick='event.preventDefault(); chItmQty(this, ".'"'.$req_cat.'"'.", ".$p_count." )'".
            ">".$p_count."</a>";
    }
}
$pl_text .= "</div>";