<?php
$appRJ->response['result'].= "<a href='https://connect.ok.ru/oauth/authorize?client_id=1250591744&scope=VALUABLE_ACCESS".
    "&response_type=code&redirect_uri=https://rightjoint.ru/signIn/&layout=w&state=ok' ".
    "title='Вход через Одноклассники' class='sb_auth ta-left'>".
    "<img src='/site/signIn/img/ok.png' alt='ok-кнопка'>Одноклассники</a>".
    "<a href='https://www.facebook.com/dialog/oauth?client_id=647119598812596&".
    "redirect_uri=https://rightjoint.ru/signIn/&response_type=code' ".
    "title='Вход через Фэйсбук' class='sb_auth ta-left'>".
    "<img src='/site/signIn/img/fb.png' alt='fb-кнопка'>Фэйсбук</a>".
    "<a href='https://oauth.vk.com/authorize?client_id=5869266".
    "&display=page&redirect_uri=https://rightjoint.ru/signIn/&scope=friends&response_type=code&v=5.62' ".
    "title='Вход через ВКонтакте' class='sb_auth ta-left'>".
    "<img src='/site/signIn/img/vk.png' alt='vk-кнопка'>ВКонтакте</a>".
    "<div class='pageErr'>".$validErr."</div>";
