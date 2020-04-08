<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/marijuanaClub/mc_conf.php");
if (!isset($_SESSION['groups']['1']) or $_SESSION['groups']['1']<10) {
    $appRJ->errors['404']['description']="Такой страницы не существует";
    $appRJ->throwErr();
}elseif($appRJ->server['reqUri_expl'][2] =="gbLightsModels"){
    if($appRJ->server['reqUri_expl'][3] =="create"){
        if($_POST['lightModelCreate'] == 'y') {
            $ajaxRes['err'] = 0;
            $ajaxRes['data'] = null;

            $gbLightModel = new recordDefault("mcGbLightsModels_dt", "model_id");
            $gbLightModel->result['modelName'] = $_POST['modelName'];
            $gbLightModel->result['power'] = $_POST['power'];
            $gbLightModel->result['colorT'] = $_POST['colorT'];
            $gbLightModel->result['settle'] = $_POST['settle'];
            $gbLightModel->result['lightType'] = $_POST['lightType'];
            $gbLightModel->result['lightNote'] = $_POST['lightNote'];
            if($_POST['activeFlag']=='true'){
                $gbLightModel->result['activeFlag'] = true;
            }else{
                $gbLightModel->result['activeFlag'] = false;
            }

            if ($gbLightModel->result['modelName']) {
                if ($gbLightModel->putOne()) {
                    $ajaxRes['data'] = "inserts - ok";
                } else {
                    $ajaxRes['err'] = 1;
                    $ajaxRes['data'] = "ошибки вставки модели";
                }
            } else {
                $ajaxRes['err'] = 1;
                $ajaxRes['data'] = "не введены: модель";
            }

            $appRJ->response['format'] = "json";
            $appRJ->response['result'] = $ajaxRes;
        }else{
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/gbLM-create-v.php");
        }
    }elseif($appRJ->server['reqUri_expl'][3] =="edit"){
        if($_POST['lightModelEdit'] == 'y') {
            $ajaxRes['err'] = 0;
            $ajaxRes['data'] = null;

            $gbLightModel = new recordDefault("mcGbLightsModels_dt", "model_id");

            $gbLightModel->result['model_id'] = $_POST['model_id'];
            $gbLightModel->result['modelName'] = $_POST['modelName'];
            $gbLightModel->result['power'] = $_POST['power'];
            $gbLightModel->result['colorT'] = $_POST['colorT'];
            $gbLightModel->result['settle'] = $_POST['settle'];
            $gbLightModel->result['lightType'] = $_POST['lightType'];
            $gbLightModel->result['lightNote'] = $_POST['lightNote'];
            if($_POST['activeFlag']=='true'){
                $gbLightModel->result['activeFlag'] = true;
            }else{
                $gbLightModel->result['activeFlag'] = false;
            }

            if ($gbLightModel->result['modelName']) {
                if ($gbLightModel->updateOne()) {
                    $ajaxRes['data'] = "updates - ok";
                } else {

                    $ajaxRes['err'] = 1;
                    $ajaxRes['data'] = "model lam update err";

                }
            } else {
                $ajaxRes['err'] = 1;
                $ajaxRes['data'] = "model not entered";
            }

            $appRJ->response['format'] = "json";
            $appRJ->response['result'] = $ajaxRes;
        }else{
            $gbLightModel = new recordDefault("mcGbLightsModels_dt", "model_id");
            if($_GET['model_id']){
                $gbLightModel->result['model_id'] = $_GET['model_id'];
                if($gbLightModel->copyOne()){
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/gbLM-edit-v.php");
                }else{
                    $appRJ->errors['404']['description'] = 'неправильный параметр model_id';
                }
            }else{
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/gbLM-edit-v.php");
            }

        }
    }else{

        $lightsList_qry = "select * from mcGbLightsModels_dt order by modelName";
        $lightsList_res=$DB->doQuery($lightsList_qry);
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/gbLM-list-v.php");
    }

}elseif($appRJ->server['reqUri_expl'][2] =="gbLamps"){
    if($appRJ->server['reqUri_expl'][3] =="create"){

        if($_POST['lightCreate'] == 'y') {
            $ajaxRes['err'] = 0;
            $ajaxRes['data'] = null;

            $gbLight = new recordDefault("mcGbLights_dt", "light_id");
            $gbLight->result['model_id'] = $_POST['model_id'];
            $gbLight->result['lightName'] = $_POST['lightName'];
            $gbLight->result['dateEntered'] = $_POST['dateEntered'];
            $gbLight->result['lightStatus'] = $_POST['lightStatus'];

            if($gbLight->result['lightName']){
                $findByName_qry = "select lightName from mcGbLights_dt WHERE lightName = '".$gbLight->result['lightName']."'";
                $findByName_res = $DB->doQuery($findByName_qry);
                if(mysql_num_rows($findByName_res) == 0){
                    if ($gbLight->putOne()) {
                        $ajaxRes['data'] = "inserts - ok";
                    } else {
                        $ajaxRes['err'] = 1;
                        $ajaxRes['data'] = "insert in mcGbLights_dt err";
                    }
                }else{
                    $ajaxRes['err'] = 1;
                    $ajaxRes['data'] = "lightName repetition";
                }
            }else{
                $ajaxRes['err'] = 1;
                $ajaxRes['data'] = "lightName not set";
            }
            $appRJ->response['format'] = "json";
            $appRJ->response['result'] = $ajaxRes;
        }else{
        $lightsList_qry = "select * from mcGbLightsModels_dt order by modelName";
        $lightsList_res=$DB->doQuery($lightsList_qry);
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/gbL-create-v.php");
        }
    }elseif($appRJ->server['reqUri_expl'][3] =="edit") {
        if ($_POST['lightModelEdit'] == 'y') {
            $ajaxRes['err'] = 0;
            $ajaxRes['data'] = null;

            $gbLightModel = new recordDefault("mcGbLightsModels_dt", "model_id");

            $gbLightModel->result['model_id'] = $_POST['model_id'];
            $gbLightModel->result['modelName'] = $_POST['modelName'];
            $gbLightModel->result['power'] = $_POST['power'];
            $gbLightModel->result['colorT'] = $_POST['colorT'];
            $gbLightModel->result['settle'] = $_POST['settle'];
            $gbLightModel->result['lightType'] = $_POST['lightType'];
            $gbLightModel->result['lightNote'] = $_POST['lightNote'];
            if ($_POST['activeFlag'] == 'true') {
                $gbLightModel->result['activeFlag'] = true;
            } else {
                $gbLightModel->result['activeFlag'] = false;
            }

            if ($gbLightModel->result['modelName']) {
                if ($gbLightModel->updateOne()) {
                    $ajaxRes['data'] = "updates - ok";
                } else {

                    $ajaxRes['err'] = 1;
                    $ajaxRes['data'] = "model lam update err";

                }
            } else {
                $ajaxRes['err'] = 1;
                $ajaxRes['data'] = "model not entered";
            }

            $appRJ->response['format'] = "json";
            $appRJ->response['result'] = $ajaxRes;
        }
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/gbL-list-v.php");
    }
}
else {
    if($_GET['modeGbEditEntry'] == 'y'){

        $ajaxRes['err']=0;
        $ajaxRes['data']=null;

        $gbSchedule = new recordDefault("mcGbSchedule_dt", "sch_id");
        $gbSchedule->result['sch_id'] = $_GET['sch_id'];
        if($gbSchedule->copyOne()){
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/marijuanaClub/views/modeGbEdit.php");
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data']="неправильный sch_id (modeGbEditEntry)";
            //$appRJ->throwErr();
        }

        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_GET['modeGbRemove'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']=0;
        $gbSchedule = new recordDefault("mcGbSchedule_dt", "sch_id");
        $gbSchedule->result['sch_id'] = $_GET['sch_id'];
        if($gbSchedule->removeOne()){
            $dateFrom = date_format($appRJ->date['curDate'], 'Y-m-d');
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbMode.php");
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbMode.php");
            $ajaxRes['data'] = $showGbMode;
        }else{
            $ajaxRes['err'] = 1;
            $ajaxRes['data'] = date_format($appRJ->date['curDate'], "H:i:s")." - удаление неудачно";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
        //if(isset)
    }elseif($_GET['modeGbShowDefault'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']=0;
        $dateFrom = date_format($appRJ->date['curDate'], 'Y-m-d');
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbMode.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbMode.php");
        $ajaxRes['data'] = $showGbMode;
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
        //echo "yyy";
    }elseif($_GET['modeGbEdit'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']=0;

        $gbSchedule = new recordDefault("mcGbSchedule_dt", "sch_id");
        $gbSchedule->result['sch_id'] = $_GET['sch_id'];
        $gbSchedule->result['modeDate'] = $_GET['modeDate'];
        $gbSchedule->result['modeTime'] = $_GET['modeTime'];
        $gbSchedule->result['time1'] = $_GET['time1'];
        $gbSchedule->result['time2'] = $_GET['time2'];
        if($_GET['invertTime']=='true'){
            $gbSchedule->result['invertTime'] = true;
        }else{
            $gbSchedule->result['invertTime'] = false;
        }
        if($gbSchedule->updateOne()){
            $ajaxRes['data'] = date_format($appRJ->date['curDate'], "H:i:s")." - обновлено успешно";
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data'] = "Ошибка обновления данных";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_POST['noteGbEdit'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']=null;


        $gbNote = new recordDefault("mcGbNotes_dt", "note_id");
        $gbNote->result['note_id'] = $_POST['note_id'];
        $gbNote->result['temper'] = $_POST['temper'];
        $gbNote->result['humid'] = $_POST['humid'];
        $gbNote->result['content'] = $_POST['noteContent'];
        $gbNote->result['noteTime'] = $_POST['noteTime'];
        $gbNote->result['noteDate'] = $_POST['noteDate'];
        $gbNote->result['electricity'] = $_POST['electricity'];
        if($gbNote->result['temper'] or $gbNote->result['humid'] or $gbNote->result['content']
            or $gbNote->result['electricity']){
            if($gbNote->updateOne()){
                //$ajaxRes['data']=$gbNote->result['note_id'];
                $ajaxRes['data']=date_format($appRJ->date['curDate'], "H:i:s")." - обновление заметки успешно";
            }else{
                $ajaxRes['err']=1;
                $ajaxRes['data']="ошибки обновления заметки";
            }
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data']="не введены никакие данные";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }


    elseif($_GET['modeGbCreate'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']=0;
        $gbSchedule = new recordDefault("mcGbSchedule_dt", "sch_id");
        $gbSchedule->result['modeDate'] = $_GET['modeDate'];
        $gbSchedule->result['modeTime'] = $_GET['modeTime'];
        $gbSchedule->result['time1'] = $_GET['time1'];
        $gbSchedule->result['time2'] = $_GET['time2'];
        if($_GET['invertTime']=='true'){
            $gbSchedule->result['invertTime'] = true;
        }else{
            $gbSchedule->result['invertTime'] = false;
        }

        $dateRepetitions_qry = "select * from mcGbSchedule_dt where modeDate = '".$_GET['modeDate']."'";
        $dateRepetitions_res = $DB->doQuery($dateRepetitions_qry);
        if(mysql_num_rows($dateRepetitions_res) == 0){
            if($gbSchedule->putOne()){
                    $dateFrom = $gbSchedule->result['modeDate'];
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbMode.php");
                    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbMode.php");
                    $ajaxRes['data'] = $showGbMode;
            }else{
                $ajaxRes['err']=1;
                $ajaxRes['data']=date_format($appRJ->date['curDate'], "H:i:s")." - создание режима неудачно";
            }
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data']=date_format($appRJ->date['curDate'], "H:i:s")." - режим на эту дату уже задан";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_GET['modeGbCreateEntry'] == 'y'){

        $ajaxRes['err']=0;
        $ajaxRes['data']=null;

        $gbSchedule = new recordDefault("mcGbSchedule_dt", "sch_id");
        $gbSchedule->result['modeDate'] = date_format($appRJ->date['curDate'], "Y-m-d");
        $gbSchedule->result['modeTime'] = date_format($appRJ->date['curDate'], "H:i");
        $gbSchedule->result['time1'] = "08:00:00";
        $gbSchedule->result['time2'] = "20:00:00";
        $gbSchedule->result['invertTime'] = true;

        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/marijuanaClub/views/gbCreateMode.php");

        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;

    }elseif($_GET['showModeBy_id'] == 'y'){
        $ajaxRes['err'] = 0;
        $ajaxRes['data'] = 0;
        if(isset($_GET['sch_id']) and $_GET['sch_id'] != null){


            $tmpCurGbMode = new recordDefault("mcGbSchedule_dt", "sch_id");
            $tmpCurGbMode->result['sch_id'] = $_GET['sch_id'];


            if($tmpCurGbMode->copyOne()){

                $dateFrom = $tmpCurGbMode->result['modeDate'];

                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbMode.php");
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbMode.php");
                $ajaxRes['data'] = $showGbMode;

            }else{
                $dateFrom = date_format($appRJ->date['curDate'], 'Y-m-d');
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbMode.php");
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbMode.php");

                $ajaxRes['data'] = $showGbMode;
            }


        }else{

        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_GET['noteGbEditEntry']){
        $ajaxRes['err'] = 0;
        $ajaxRes['data'] = null;

        $gbNote = new recordDefault("mcGbNotes_dt", "note_id");
        $gbNote->result['note_id'] = $_GET['note_id'];
        if($gbNote->copyOne()){
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/marijuanaClub/views/noteGbEdit.php");
        }else{
            $ajaxRes['err']=1;
            $ajaxRes['data']="неправильный sch_id (modeGbEditEntry)";
            //$appRJ->throwErr();
        }

        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_GET['noteGbRemove'] == 'y'){
        $ajaxRes['err']=0;
        $ajaxRes['data']=$_GET['note_id'];

        $gbNote = new recordDefault("mcGbNotes_dt", "note_id");
        $gbNote->result['note_id'] = $_GET['note_id'];
        if($gbNote->removeOne()){

            $dateFrom = date_format($appRJ->date['curDate'], 'Y-m-d');
            $tmpCurGbNote_qry = "select * from mcGbNotes_dt WHERE noteDate <= '".$dateFrom."' order by noteDate DESC, noteTime DESC";
            $tmpCurGbNote_res = $DB->doQuery($tmpCurGbNote_qry);
            $tmpCurGbNote_row = $DB->doFetchRow($tmpCurGbNote_res);
            $note_id = $tmpCurGbNote_row['note_id'];

            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbNote.php");
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbNote.php");
            $ajaxRes['data'] = $showGbNote;

        }else{
            $ajaxRes['err'] = 1;
            $ajaxRes['data'] = date_format($appRJ->date['curDate'], "H:i:s")." - удаление неудачно";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }



    elseif($_GET['showNoteBy_id'] == 'y'){
        $ajaxRes['err'] = 0;
        $ajaxRes['data'] = 0;
        if(isset($_GET['note_id']) and $_GET['note_id'] != null){
            $note_id = $_GET['note_id'];
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbNote.php");
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbNote.php");
            $ajaxRes['data'] = $showGbNote;
        }else{

        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_POST['noteGbCreate'] == 'y') {
        $ajaxRes['err'] = 0;
        $ajaxRes['data'] = 0;

        $gbNote = new recordDefault("mcGbNotes_dt", "note_id");
        $gbNote->result['temper'] = $_POST['temper'];
        $gbNote->result['humid'] = $_POST['humid'];
        $gbNote->result['content'] = $_POST['content'];
        $gbNote->result['noteTime'] = $_POST['noteTime'];
        $gbNote->result['noteDate'] = $_POST['noteDate'];
        $gbNote->result['electricity'] = $_POST['electricity'];
        if ($gbNote->result['temper'] or $gbNote->result['humid'] or $gbNote->result['content'] or $gbNote->result['electricity']) {
            if ($gbNote->putOne()) {
                //$ajaxRes['data'] = $gbNote->result['note_id'];
                $note_id = $gbNote->result['note_id'];
                //  $dateFrom = $tmpCurGbNote->result['noteDate'];

                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbNote.php");
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbNote.php");
                $ajaxRes['data'] = $showGbNote;
            } else {
                $ajaxRes['err'] = 1;
                $ajaxRes['data'] = "ошибки вставки заметки";
            }
        } else {




            $ajaxRes['err'] = 1;
            $ajaxRes['data'] = "не введены никакие данные";
        }
        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;
    }elseif($_GET['noteGbCreateEntry'] == 'y'){

        $ajaxRes['err']=0;
        $ajaxRes['data']=null;

        $gbNote = new recordDefault("mcGbNotes_dt", "note_id");
        $gbNote->result['temper'] = null;
        $gbNote->result['humid'] = null;
        $gbNote->result['content'] = null;
        $gbNote->result['noteTime'] = date_format($appRJ->date['curDate'], "H:i");
        $gbNote->result['noteDate'] = date_format($appRJ->date['curDate'], "Y-m-d");

        $dateFrom = date_format($appRJ->date['curDate'], 'Y-m-d');
        $tmpCurGbNote_qry = "select * from mcGbNotes_dt WHERE noteDate <= '".$dateFrom."' order by noteDate DESC, noteTime DESC";
        $tmpCurGbNote_res = $DB->doQuery($tmpCurGbNote_qry);
        $tmpCurGbNote_row = $DB->doFetchRow($tmpCurGbNote_res);
        $note_id = $tmpCurGbNote_row['note_id'];

        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/marijuanaClub/views/gbCreateNote.php");

        $appRJ->response['format'] = "json";
        $appRJ->response['result'] = $ajaxRes;

    }

    else{
        $dateFrom = date_format($appRJ->date['curDate'], 'Y-m-d');
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbMode.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbMode.php");

        $tmpCurGbNote_qry = "select * from mcGbNotes_dt WHERE noteDate <= '".$dateFrom."' order by noteDate DESC, noteTime DESC";
        $tmpCurGbNote_res = $DB->doQuery($tmpCurGbNote_qry);
        $tmpCurGbNote_row = $DB->doFetchRow($tmpCurGbNote_res);
        $note_id = $tmpCurGbNote_row['note_id'];
        //$curGbNote_qry = "select * from mcGbNotes_dt order by noteDate DESC, noteTime DESC LIMIT 2";
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/actions/showGbNote.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/showGbNote.php");


        $lightsList_qry = "select * from mcGbLightsModels_dt order by modelName where activeFlag is true";
        $lightsList_res=$DB->doQuery($lightsList_qry);
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/marijuanaClub/views/defaultView.php");
    }


}