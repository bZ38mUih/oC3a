<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/source/accessorial_class.php");
if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$_GET['uploadAlbums'])){
    $appRJ->response['result'].="folder ".$_SERVER['DOCUMENT_ROOT']."/".$_GET['uploadAlbums']." exist<hr>";
    require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
    $fld_cnt=0;
    $fileTot_cnt=0;
    $cover_cnt=0;
    foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/".$_GET['uploadAlbums'] . "/*/") as $curFld) {
        $curFld_name=basename($curFld);
        $appRJ->response['result'].="albName: <b style='font-size: 1.2em'> ".$curFld_name."</b><br>";
        if(accessorialClass::checkDouble("galleryAlb_dt", "albumAlias", $curFld_name)){
            $fld_cnt++;
            $appRJ->response['result'].=" no double <br>";

            $Alb_rd = new recordDefault("galleryAlb_dt", "album_id");
            $Alb_rd->result['albumAlias']=accessorialClass::mkAlias($curFld_name);
            $Alb_rd->result['albumName']=$Alb_rd->result['albumAlias'];
            $Alb_rd->result['activeFlag']=false;
            $Alb_rd->result['dateOfCr'].= date_format($appRJ->date['curDate'], 'Y-m-d');
            $Alb_rd->result['user_id'].= $_SESSION['user_id'];

            if($Alb_rd->putOne()){
                if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'])."/photoAttach") {
                    mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'], 0777, true);
                }
                if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/preview")) {
                    mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/preview", 0777, true);
                }
                $albPhoto_cnt=0;
                foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/".$_GET['uploadAlbums'] . "/".$curFld_name."/*jpg") as $photoFile){
                    $albPhoto_cnt++;
                    $path_parts = pathinfo(basename($photoFile));
                    if(basename($photoFile)=='cover.jpg'){
                        $Alb_rd->result['albumImg']=uniqid().".".$path_parts['extension'];
                        if (copy($photoFile, $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.
                            $Alb_rd->result['album_id']."/".$Alb_rd->result['albumImg'])) {
                            if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview")) {
                                mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview", 0777, true);
                            }
                            /*create preview-->*/
                            $imageLib=new imageLib();
                            $imageLib->createPreview(
                                $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/".$Alb_rd->result['albumImg'],
                                $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview/".$Alb_rd->result['albumImg'], 300, 300);
                            /*<--create preview*/
                            if($Alb_rd->updateOne()){
                                $appRJ->response['result'].=basename($photoFile). " -> ".$Alb_rd->result['albumImg']." - обложка успешно<br>";
                            }
                        }
                    }else{
                        $glPhoto = new recordDefault("galleryPhotos_dt", "photo_id");

                        $glPhoto->result['photoLink']=uniqid().".".$path_parts['extension'];
                        $glPhoto->result['user_id']=$_SESSION['user_id'];
                        $glPhoto->result['uploadDate']=date_format($appRJ->date['curDate'], 'Y-m-d');
                        $glPhoto->result['album_id']=$Alb_rd->result['album_id'];

                        if(copy($photoFile, $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/".$glPhoto->result['photoLink']))
                            /*create preview-->*/
                            $imageLib=new imageLib();
                        $imageLib->createPreview(
                            $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/".$glPhoto->result['photoLink'],
                            $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/preview/".$glPhoto->result['photoLink'], 300, 300);

                        /*<--create preview*/
                        if($glPhoto->putOne()){
                            $appRJ->response['result'].=basename($photoFile). " -> ".$glPhoto->result['photoLink']." - успешно<br>";
                        }else{
                            $appRJ->response['result'].=basename($photoFile). " -> ".$glPhoto->result['photoLink']." - неудачно<br>";
                        }
                    }
                }
                $appRJ->response['result'].="<b>Выгружено:</b> ".$albPhoto_cnt." файл.<br><hr>";
                $fileTot_cnt+=$albPhoto_cnt;
            }else{
                $appRJ->response['result'].=" cant put album <br>";
            }
        }else{
            $appRJ->response['result'].=" is double <br>";
        }
        $appRJ->response['result'].="<hr>";
    }
    $appRJ->response['result'].="<strong>Выгружено:</strong><br> ".$fld_cnt." альб.<br>";
    $appRJ->response['result'].= $fileTot_cnt." фот.<br>";
}else{
    $appRJ->response['result'].="folder ".$_SERVER['DOCUMENT_ROOT']."/".$_GET['uploadAlbums']." not exist";
}