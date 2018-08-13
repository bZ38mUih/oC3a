<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 05.01.2018
 * Time: 14:09
 */

$appRJ->response['result'].= "<a href='https://connect.ok.ru/oauth/authorize?client_id=1250591744&scope=VALUABLE_ACCESS".
    "&response_type=code&redirect_uri=https://rightjoint.ru/signIn/&layout=w&state=ok' title='Одноклассники'
    class='sb_auth'>".
    "<img src='/site/signIn/img/ok.png' alt='Одноклассники'>Одноклассники</a>";
$appRJ->response['result'].= "<a href='https://www.facebook.com/dialog/oauth?client_id=647119598812596&".
    "redirect_uri=https://rightjoint.ru/signIn/&response_type=code' 
    class='sb_auth'>".
    "<img src='/site/signIn/img/fb.png' alt='Facebook'>Фэйсбук</a>";
$appRJ->response['result'].= "<a href='https://oauth.vk.com/authorize?client_id=5869266".
    "&display=page&redirect_uri=https://rightjoint.ru/signIn/&scope=friends&response_type=code&v=5.62' title='ВКонтакте'
    class='sb_auth'>".
    "<img src='/site/signIn/img/vk.png' alt='ВКонтакте'>ВКонтакте</a>";

$appRJ->response['result'].= "<div class='pageErr'>";
$appRJ->response['result'].= $validErr;
$appRJ->response['result'].= "</div>";
