<?php
$orderBy=null;

foreach ($tables->tables as $table => $value) {
    if ($tables->tables[$table]['exist']===true) {
        $query_text = "select * from ".$table." ".$orderBy;
        $query_res = $DB->query($query_text);
        if ($query_res->rowCount() == 0){
            $tables->result['log'].= $table."-->> nothing to upload<br>";
        }else{
            $queryToInsert = null;
            $queryToInsert_temp = "(";
            $queryToInsert .= "insert into ".$table." (\r";
            $query_row = $query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($query_row as $key => $value) {
                if ($value == null) {
                    $queryToInsert_temp .= "null, ";
                } else {
                    $queryToInsert_temp .= "'" . $value . "', ";
                }
                $queryToInsert .= $key . ", ";
            }
            $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . ")\r values \r";
            $queryToInsert_temp = substr($queryToInsert_temp, 0, strlen($queryToInsert_temp) - 2) . "), \r";
            $queryToInsert .= $queryToInsert_temp;
            while ($query_row = $query_res->fetch(PDO::FETCH_ASSOC)) {
                $queryToInsert .= "(";
                foreach ($query_row as $key => $value) {
                    if ($value == null) {
                        $queryToInsert .= "null, ";
                    } else {
                        $queryToInsert .= "'" . $value . "', ";
                    }
                }
                $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . "), \r";
            }
            $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 3);
            $appRJ->date['curDate'] = @date_create();
            if(isset($_GET['prefixTag']) and $_GET['prefixTag']!=null){
                $file=htmlspecialchars($_GET['prefixTag'])."_".$table;
            }else{
                $file =$table;
            }

            if($_GET['dateTag']=='true'){
                $file .="_".date_format($appRJ->date['curDate'], 'Ymd_His');
            }
            $file.=".php";
            if(!file_put_contents($_SERVER["DOCUMENT_ROOT"]."/".DB_UPLOADS.$file, $queryToInsert)){
                $tables->result['err']= $table."-->> невозможно создать файл<br>";
            }else{
                $tables->result['log'].= $table."-->> success<br>";
            }
        }
    }
}