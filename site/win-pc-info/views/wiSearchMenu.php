<?php
$appRJ->response['result'].="<div class='wiSearchMenu ta-right'><input type='text' name='tpSearch' value='%'>".
    "<input type='button' value='search' onclick='wiSearch(".'"'.$appRJ->server['reqUri_expl'][2].'"'.")'>".
    "</div>";