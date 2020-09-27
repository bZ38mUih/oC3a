<?php
if($_POST['artCm_pid']){
    $refBlock['err']=null;
    if($_SESSION['user_id']){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/blog/actions/postNewComment.php");
    }else{
        $appRJ->errors['access']['description']="комментирование запрещено неавторизированным пользователям";
    }
}elseif ($_GET['likeVal']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/actions/setArtCmLike.php");
    $appRJ->response['format']='ajax';
    $slCm_qry="select * from artComments_dt WHERE artCm_id=".$_GET['artCm_id'];
    $slCm_res=$DB->query($slCm_qry);
    $slCm_row = $slCm_res->fetch(PDO::FETCH_ASSOC);
    $tmpCm=null;
    include ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artCmLikes.php");
    $appRJ->response['result']=$tmpCm;
}else{
    $curPage = 1;

    $blog_cat = null;
    $q_where = null;
    $listCount = 4;

    if(intval($_GET['curPage'])){
        $curPage = $_GET['curPage'];
    }
    if(intval($_POST['blog_page'])){
        $curPage = $_POST['blog_page'];
    }
    if(intval($_GET['listCount'])){
        $listCount = $_GET['listCount'];
    }
    if(intval($_POST['listCount'])){
        $listCount = $_POST['listCount'];
    }
    $req_cat = null;
    if ($_POST['changeCat'] == 'dev' or $_POST['changeCat'] == 'pc' or $_POST['changeCat'] == 'null'){
        $req_cat = $_POST['changeCat'];
    }elseif(($appRJ->server['reqUri_expl'][2] == 'dev' or $appRJ->server['reqUri_expl'][2] == 'pc' or !$appRJ->server['reqUri_expl'][2])){
        $req_cat = $appRJ->server['reqUri_expl'][2];
    }
    if($req_cat == 'dev' or $req_cat == 'pc' or $req_cat == 'null' or !$req_cat){
        if($req_cat and $req_cat != 'null'){
            $blog_cat = "/".$req_cat;
            $q_where = " and artCat_dt.catAlias = '".$req_cat." '";
        }else{
            $req_cat = null;
            $q_where = " and artCat_dt.catAlias in ('pc', 'dev') ";
        }
        if(isset($_POST['changeCat'])){
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/actions/createView.php");
            $appRJ->response['result'].= "<div class = 'art-list-wrap'>".$art_page.
                "</div>"."<div class='pagination'>".$btn_pre.$page_list.$btn_nex."</div>".$pl_text;
            $appRJ->response['format'] = 'ajax';
        }else{
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/actions/createMenu.php");
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/actions/createView.php");
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/blog/views/defaultView.php");
        }
    }else{
        $appRJ->errors['404']['description'] = 'категория в блоге не определена';
    }
}