<?php
$appRJ->response['result'].= "<div class='usersList-line caption'><div class='usersList-line-name'>usersName</div>".
    "<div class='usersList-line-del'>delUser</div></div>";
$bdUsers=json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/source/_conf/admin/adminUsers.php"));
foreach ($bdUsers as $usr=>$pw){
    $appRJ->response['result'].= "<div class='usersList-line'><div class='usersList-line-name'>".$usr."</div>".
        "<div class='usersList-line-del'><img src='/source/img/drop-icon.png' onclick='dropAdminUsr(".'"'.$usr.'"'.")'>".
        "</div></div>";
}