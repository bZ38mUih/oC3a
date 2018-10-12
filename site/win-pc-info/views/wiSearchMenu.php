<?php
$appRJ->response['result'].="<div class='wiSearchMenu ta-right'><input type='text' value='%'>".
    "<input type='button' value='search' onclick='wdSearch(".'"'.$appRJ->server['reqUri_expl'][2].'"'.")'>".
    "</div>";