<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 29.03.2017
 * Time: 11:05
 */

class Forum
{
    public function initValues()
    {
        $this->upLoadPath="/data/forum/attachments/";
        $this->subjectHeader=null;
        $this->subjectPhotos=null;
        $this->subjectStatistic=null;
        $this->pagination=null;
        $this->comments=null;
        $this->content=null;
        $this->subjMenu=null;
        $this->subjMenu_qty=0;

        $this->commsOnPage=10;
        $this->curPage=1;
        /*set orders here*/
        /*
         * 0 - forbidden
         * 1 - able view topic
         * 2 - able write comments
         *
         */
        if($_SESSION['usrVld']==true){
            $this->orders=2;
        }else{
            $this->orders=1;
        }
    }

    public function printSubjectHeader($subject)
    {
        $this->meta=$subject->result['metaDescr']['val'];
        $this->title=$subject->result['caption']['val'];

        $this->subjectHeader=null;
        $this->subjectHeader = "<input type='hidden' id='subject_id' value='".$subject->result['subject_id']['val']."'>";
        $this->subjectHeader.= "<h2>".$subject->result['caption']['val']."</h2>";
        $this->subjectHeader.= "<p>";
        $DB=new DB();
        $attachments_text="select * from subjectAttachments_dt WHERE subject_id='".$subject->result['subject_id']['val'].
            "' order by sort DESC, ref";
        $attachments_res=$DB->doQuery($attachments_text);
        if(@mysql_num_rows($attachments_res)>0){
            $attachments_row=$DB->doFetchRow($attachments_res);
            $this->subjectHeader.= "<a class='fancybox-thumbs main' data-fancybox-group='thumb' href='".$this->upLoadPath.$subject->result['subject_id']['val']."/".$attachments_row['ref']
                ."'><img src='".$this->upLoadPath.$subject->result['subject_id']['val']."/preview/".$attachments_row['ref']
                ."' alt='".$attachments_row['ref']."'></a>";
        }
        $this->subjectHeader.= $subject->result['subjectDescr']['val']."</p>";
    }

    public function printSubjectPhotos($subject)
    {
        $this->subjectPhotos=null;
        $DB=new DB();
        $attachments_text="select * from subjectAttachments_dt WHERE subject_id='".$subject->result['subject_id']['val'].
            "' order by sort DESC, ref";
        $attachments_res=$DB->doQuery($attachments_text);
        $photos_qty=@mysql_num_rows($attachments_res);
        $this->subjectPhotos.= "<span class='photo_qty'>Всего: ".$photos_qty." фото</span>";

        if ($photos_qty>1){
            $this->subjectPhotos.= "<span class='moveRight' onclick='movePhotoScroll_right()' style='display: none;'><img src='/modules/forum/img/right.png'></span>";
            $this->subjectPhotos.= "<div class='photoLine'>";
            if($photos_qty>1){
                $DB->doFetchRow($attachments_res);
                while($attachments_row=$DB->doFetchRow($attachments_res)){

                    $this->subjectPhotos.= "<a class='fancybox-thumbs list' data-fancybox-group='thumb' href='".$this->upLoadPath.$subject->result['subject_id']['val']."/".$attachments_row['ref']
                        ."' title='".$attachments_row['ref']."'><img src='".$this->upLoadPath.$subject->result['subject_id']['val']."/preview/".$attachments_row['ref']
                        ."' alt='".$attachments_row['ref']."'></a>";

                }
                $this->subjectPhotos.= "</div>";
                $this->subjectPhotos.= "<span class='moveLeft' onclick='movePhotoScroll_left()' ";
                if ($photos_qty<5){
                    $this->subjectPhotos.= "style='display: none;' ";
                }
                $this->subjectPhotos.= "><img src='/modules/forum/img/left.png'></span>";
            }else{
                //$appRJ->response['result'].= "<span class='photo_qty'>"."there is no photos"."</span>";
            }
        }
    }

    public function printSubjectStatistic($subject)
    {
        $this->subjectStatistic=null;
        $queryComms_text="select count(comment_id) as comm_qty from comments_dt where subject_id='".
            $subject->result['subject_id']['val']."' and comment_parId is null";
        $DB = new DB();
        $queryComms_res=$DB->doQuery($queryComms_text);
        $queryComms_row=$DB->doFetchRow($queryComms_res);
        $this->subjectStatistic.= "<div class='statisticLine'><span class='statCaption'>Комментов: </span><span class='statQty'>".
            $queryComms_row['comm_qty']."</span></span></div>";
        $queryAnsw_text="select count(comment_id) as answ_qty from comments_dt where subject_id='".
            $subject->result['subject_id']['val']."' and comment_parId is not null";
        $queryAnsw_res=$DB->doQuery($queryAnsw_text);
        $queryAnsw_row=$DB->doFetchRow($queryAnsw_res);
        $this->subjectStatistic.= "<div class='statisticLine'><span class='statCaption'>Ответов: </span><span class='statQty'>".
            $queryAnsw_row['answ_qty']."</span></div>";
        $queryTotal_text="select count(comment_id) as total_qty from comments_dt where subject_id='".
            $subject->result['subject_id']['val']."'";
        $queryTotal_res=$DB->doQuery($queryTotal_text);
        $queryTotal_row=$DB->doFetchRow($queryTotal_res);
        $this->subjectStatistic.= "<div class='statisticLine'><span class='statCaption'>Всего: </span><span class='statQty'>".$queryTotal_row['total_qty']."</span></div>";
    }

    public function printPagination($subject_id=1)//, //$group=null)
    {
        $this->pagination=null;
        //$subject_id=1;
        $this->pagination.= "Стр.: ";
        $query_text = "select comment_id from comments_dt where comment_parId is null and subject_id='".$subject_id."'";
        $DB = new DB();
        $query_res = $DB->doQuery($query_text);
        $qty = @mysql_num_rows($query_res);
        if ($qty>0){
            if (is_int($qty/$this->commsOnPage)){
                $pages = $qty/$this->commsOnPage;
            }else{
                $pages = round($qty/$this->commsOnPage, PHP_ROUND_HALF_DOWN)+1;
            }
            for ($i=1; $i<=$pages; $i++){
                if ($i == $this->curPage){
                    $this->pagination.= "<a href='#pagination' class='active' onclick='showPage(".$i.")'>".$i."</a>";
                }else{
                    $this->pagination.= "<a href='#pagination' onclick='showPage(".$i.")'>".$i."</a>";
                }
                if ($i+1<=$pages){
                    $this->pagination.= ", ";
                }
            }
        }else{
            $this->pagination.= "-";
        }
    }

    public function printComments($comment_parId = null, //refPar_id
                                  $comment = null,
                                  $answers = true, //toDo remove this
                                  $curPage = 1,
                                  $commsOnPage = 10,
                                  $adminOrders = false
    )
    {
        $temp_newComment=false;

        $query_text = "select comments_dt.comment_id, comments_dt.comment_parId, comments_dt.dateOfCr, ".
            "comments_dt.user_id, comments_dt.commContent, ".
            "people_dt.user_id, people_dt.login, people_dt.alias, people_dt.netWork, people_dt.avatar ".
            "from comments_dt ".
            "INNER JOIN people_dt ON comments_dt.user_id = people_dt.user_id";
        if ($comment_parId == null){
            $limit = " limit ".($curPage-1)*$commsOnPage.", ".$curPage*$commsOnPage;
                "INNER JOIN people_dt ON comments_dt.user_id = people_dt.user_id".
                $query_text.=" WHERE comments_dt.subject_id='".$comment->result['subject_id']['val'].
                    "' and comment_parId is NULL order by dateOfCr DESC".$limit;
        }else{

            $query_text.=" WHERE comments_dt.subject_id='".$comment->result['subject_id']['val'].
                "' and comment_parId = '".$comment_parId."' order by dateOfCr DESC";
        }

        $DB = new DB();
        if($DB->doQuery($query_text)!=true){
            //$this->comments.= "problem here<br>";
            //$this->comments.= $query_text."<br>";
        }
        $query_res = $DB->doQuery($query_text);
        if (@mysql_num_rows($query_res) >0){
            while ($query_row = $DB->doFetchRow($query_res)){
                $this->comments.= "<ul>";
                $this->comments.= "<li>";
                $this->comments.= "<div class='info'>";
                if(isset($query_row['avatar']) or $query_row['avatar']!=null){
                    if($query_row['netWork']=='site') {
                        $this->comments.= "<img src='/data/user/" . $query_row['user_id'] . "/avatar.jpg'/>";
                    }else{
                        $this->comments.= "<img src='".$query_row['avatar']."'"."' alt='".$query_row['alias']."_photo'/>";
                    }
                }else{
                    if($query_row['netWork']=='site'){
                        $this->comments.= "<img src='/source/img/social_logos/default.gif"."' alt='avatar default'/>";
                    }elseif($query_row['netWork']=='vk'){
                        $this->comments.= "<img src='/source/img/social_logos/vk.png"."' alt='vkontakte'/>";
                    }elseif($query_row['netWork']=='ok'){
                        $this->comments.= "<img src='/source/img/social_logos/ok.png"."' alt='vkontakte'/>";
                    }
                }
                $this->comments.= "<a class='usrName' href='/statistic/?user_id=".$query_row['user_id']."'>" .
                    $query_row['alias'] ."</a>";


                /*if($query_row['netWork']=='site'){
                    if(isset($query_row['avatar']) and $query_row['avatar']!=null){
                        $this->comments.= "<img src='/data/user/".$query_row['user_id']."/avatar.jpg'/>";
                    }else{
                        $this->comments.= "<img src='/source/img/social_logos/default.gif"."' alt='avatar default'/>";
                    }
                    $this->comments.= "<a class='usrName' href='/personalPage/".$query_row['user_id']."'>" .
                        $query_row['alias'] ."</a>";
                }elseif($query_row['netWork']=='vk'){
                    if(isset($query_row['avatar']) and $query_row['avatar']!=null){
                        $this->comments.= "<img src='".$query_row['avatar']."'"."' alt='vkontakte'/>";
                    }else{
                        $this->comments.= "<img src='/source/img/social_logos/vk.png"."' alt='vkontakte'>";
                    }
                    $this->comments.= "<a class='usrName' href='http://vk.com/id".$query_row['login']."'  target='_blank'>" .
                        $query_row['alias'] ."</a>";
                }*/
                $this->comments.= "</div>";
                $this->comments.= "<div class='content_border_top'></div>";
                $this->comments.= "<div class='content'>";
                $this->comments.= $query_row["commContent"];
                $this->comments.= "<span class='date'>".$query_row["dateOfCr"]."</span>";
                $this->comments.= "</div>";
                if ($this->orders>=2){
                    $this->comments.= "<a href='#answId_".$query_row["comment_id"]."' class='answer' onclick='answer(".$query_row["comment_id"].")' id='answId_".$query_row["comment_id"]."'>ответить</a>";
                }else{
                    $this->comments.= "<a href='#' class='answer' onclick='answer(".$query_row["comment_id"].")' id='answId_".$query_row["comment_id"]."'></a>";
                }
                if ($query_row["comment_id"] == $comment->result["comment_parId"]["val"]){
                    $this->comments.=$this->view_formComment($comment);
                    $temp_newComment=true;
                }
                $this->comments.=$this->printComments ($query_row["comment_id"], $comment, $answers, $curPage, $commsOnPage, $adminOrders);
                $this->comments.= "</li>";
                $this->comments.= "</ul>";
            }

            if (($comment->result["comment_parId"]["val"] == null and $comment_parId == null)){
            //if ($comment->result["comment_parId"]["val"] == null and $comment_parId == null){
                $this->comments.= "<div class = 'newComment'>";
                $this->comments.= "<a href='#answId_' class='answer' onclick='answer()' id='answId_' style='display: none'>Написать</a>";
                $this->comments.=$this->view_formComment($comment);
                $this->comments.="</div>";
            }elseif($temp_newComment===true){
                $this->comments.= "<a href='#answId_' class='answer' onclick='answer()' id='answId_'>Написать</a>";
            }
        }else {
            if ($comment_parId == null) {
                $this->comments.= "Вы можете быть первым, кто напишет коммент.";
                $this->comments.=$this->view_formComment($comment);
            }
        }
    }

    public function printSubjectContent()
    {
        $this->content=null;
        $this->content.= "<div class='subjectHeader_frame'>";
        $this->content.=  $this->subjectHeader;
        $this->content.=  "</div>";
        $this->content.=  "<div class='subjectPhoto_frame'>";
        $this->content.=  $this->subjectPhotos;
        $this->content.=  "</div>";
        $this->content.=  "<div class='subjectStatistic_frame'>";
        $this->content.=  $this->subjectStatistic;
        $this->content.=  "</div>";
        $this->content.=  "<div class='subjectPagination_frame' id='pagination'>";
        $this->content.=  $this->pagination;
        $this->content.=  "</div>";
        $this->content.=  "<div class='subjectComments_frame'>";
        $this->content.= $this->comments;
        $this->content.=  "</div>";
    }

    private function view_formComment($comment)
    {
        $formComment_text=null;

        if ($this->orders<2) {
            $formComment_text.= "<br><a href='/signIn' class='signInWindow' onclick='signMe()'>Авторизируйтесь</a>  чтобы написать коммент";
        }else{
            $formComment_text.= "<form class='formComment'>";
            $formComment_text.= "<div class='formRefResult'>";
            $formComment_text.= "<span class='field_err'>".$comment->result["comment_parId"]['err']."</span>";
            $formComment_text.= "</div>";
            if (isset($comment->result["comment_parId"]['val']) and $comment->result["comment_parId"]['val']!= null and
                $comment->result["comment_parId"]['val']!=''){
                $formComment_text.= "<span class='caption'>Ответить</span>";
            } else{
                $formComment_text.= "<span class='caption'>Добавить коммент</span>";
            }
            $formComment_text.= "<input type='hidden' name='addComment' value='xxx'>";
            $formComment_text.= "<input type='hidden' name='comment_parId' value='".$comment->result["comment_parId"]['val']."'>";
            $formComment_text.= "<span class='field_err'>".$comment->result["comment_parId"]['err']."</span>";
            $formComment_text.= "<textarea name='commContent' rows='5' id='content' class='form-control'>".$comment->result["commContent"]['val']."</textarea>";
            $formComment_text.= "<span class='field_err'>".$comment->result["commContent"]['err']."</span>";
            $formComment_text.= "<input type='button' value='Написать' onclick='newComment()'>";
            $formComment_text.= "</form>";

        }
        return $formComment_text;
    }

    function userPart($subject_id=6)
    {
        if($_SESSION['usrVld']===true){
            $query_text="select count(comment_id) as qty from comments_dt where subject_id='".$subject_id.
                "' and user_id='".$_SESSION['usrId']."'";
            $DB=new DB();
            $query_res=$DB->doQuery($query_text);
            $query_row=$DB->doFetchRow($query_res);
            return($query_row['qty']);
        }else{
            return false;
        }
    }

    private function printSubjMenu($subjMenu_id=null, $subject_id=null)
    {
        $result['subj_qty']=0;
        $result['content']=null;
        $result['content'].= "<ul>";
        $result['content'].= "<ul class='menuSubj'>";
        if($subjMenu_id==null){
            $queryMenu_text="select * from subjectsMenu_dt where subjMenu_parId is null";
            $querySubj_text="select * from subjects_dt where subjMenu_id is null";
        }else{
            $queryMenu_text="select * from subjectsMenu_dt where subjMenu_parId='".$subjMenu_id."'";
            $querySubj_text="select * from subjects_dt where subjMenu_id='".$subjMenu_id."'";
        }
        $DB = new DB();
        $querySubj_res=$DB->doQuery($querySubj_text);
        $result['subj_qty']=@mysql_num_rows($querySubj_res);
        if($result['subj_qty']>0){
            while ($querySubj_row=$DB->doFetchRow($querySubj_res)){
                $classActive=null;
                if($querySubj_row['subject_id'] == $subject_id){
                    $classActive = "active";
                }
                if (USE_ALIAS === true){
                    $result['content'].= "<li><a href='".$querySubj_row['cap_alias'].
                        "' class='subject ".$classActive."' onclick='openSubject(".$querySubj_row['subject_id'].", ".
                        '"'.$querySubj_row['cap_alias'].'"'.")'>".$querySubj_row['caption']."</a></li>";
                }else{
                    $result['content'].= "<li><a href='subj_".$querySubj_row['subject_id'].
                        "' class='subject ".$classActive."' onclick='openSubject(".$querySubj_row['subject_id'].", null)'>".
                        $querySubj_row['caption']."</a></li>";
                }
            }
        }
        $result['content'].= "</ul>";
        $queryMenu_res=$DB->doQuery($queryMenu_text);
        if(@mysql_num_rows($queryMenu_res)>0){
            while ($queryMenu_row=$DB->doFetchRow($queryMenu_res)){
                $response=$this->printSubjMenu($queryMenu_row['subjMenu_id'], $subject_id);
                $result['content'].= "<li><a href='#' class='menu'>(".$response['subj_qty'].") ".$queryMenu_row['caption']."</a>";
                $result['content'].=$response['content'];
                $result['content'].= "</li>";
            }
        }
        $result['content'].= "</ul>";
        return $result;
    }

    public function viewSubjMenu($subjMenu_id=null, $subject_id=null)
    {
        $subjMenu = $this->printSubjMenu($subjMenu_id, $subject_id);
        $this->subjMenu=$subjMenu['content'];
        $this->subjMenu_qty=$subjMenu['subj_qty'];
    }
}