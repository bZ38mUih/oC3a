<?php
$tables->result['log'].= "<div class='table-line caption'><div class='table-cell tblName'>Table</div>".
    "<div class='table-cell tblLst'>Lst</div>".
    "<div class='table-cell tblExt'>Ext</div>".
    "<div class='table-cell tblAct'>action</div><div class='table-cell tblDwlTag'>target table</div></div>";
foreach ($tables->tables as $table=>$tName) {
    $tables->result['log'].= "<div class='table-line'>";
    $tableCells=null;
    include($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/views/tablesCells.php");
    $tables->result['log'].=$tableCells;
    $tables->result['log'].="</div>";
}