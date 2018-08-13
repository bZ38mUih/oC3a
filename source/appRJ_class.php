<?php
class appRJ
{
    public $errors;
    public $server;
    public $date;
    public $ntf;
    public $response;
    public $mct;


    function initValues()
    {
        $this->date['curDate'] = @date_create();

        $this->mct['start_time'] = microtime(true);
        //$end_time = microtime(true);
        //$tables->result['log'].= 'lead time: '.($end_time-$start_time);

        $this->errors=null;

        $this->server['reqUri']=parse_url($_SERVER['REQUEST_URI']);
        $this->server['reqUri_expl']=explode("/",$this->server['reqUri']['path']);

        $this->server['redirUri']=parse_url($_SERVER['HTTP_REFERER']);
        $this->server['redirUri_expl']=explode("/",$this->server['redirUri']['path']);

        $this->response['format']='html';
        $this->response['result']=null;
    }

    function throwErr()
    {
        require_once($_SERVER["DOCUMENT_ROOT"]."/source/alerts/alertsController.php");
    }

    function mct()
    {
        $this->mct['end_time'] = microtime(true);
        $this->response['result'].="<script>$('body').after('<span style=".'"'.
            " color: silver; position: relative; bottom: 1.2em; left: 0,5em; ".
            " display: block; height:0; width:0; font-size:0.7em;".'"'.">".
            strval($this->mct['end_time']-$this->mct['start_time'])."</span>')</script>";
    }
}