<?php
$appRJ->response['result'].= "<div class='usersList-line caption'>";
$appRJ->response['result'].= "<div class='usersList-line-name'>usersName</div>";
$appRJ->response['result'].= "<div class='usersList-line-del'>delUser</div>";
$appRJ->response['result'].= "</div>";
$bdUsers=json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php"));
foreach ($bdUsers as $usr=>$pw){
    $appRJ->response['result'].= "<div class='usersList-line'>";
    $appRJ->response['result'].= "<div class='usersList-line-name'>".$usr."</div>";
    $appRJ->response['result'].= "<div class='usersList-line-del'><img src='/source/img/drop-icon.png' onclick='dropAdminUsr(".'"'.$usr.'"'.")'></div>";
    $appRJ->response['result'].= "</div>";
}