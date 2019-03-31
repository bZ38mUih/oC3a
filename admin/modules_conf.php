<?php

define("DB_UPLOADS", "/data/db/");

$adminModules['server']['active']=true;
$adminModules['server']['aliasMenu']="Сервер";
$adminModules['server']['altText']="Настройки подключения к серверу и базе данных";

$adminModules['sql']['active']=true;
$adminModules['sql']['aliasMenu']="SQL";
$adminModules['sql']['altText']="SQL-инъекции. Портировать запрос на сервер и в базу данных";

$adminModules['adminUsers']['active']=true;
$adminModules['adminUsers']['aliasMenu']="Пользователи";
$adminModules['adminUsers']['altText']="Список пользователей, добавить или удалить пользователя";

$adminModules['tables']['active']=true;
$adminModules['tables']['aliasMenu']="Таблицы";
$adminModules['tables']['altText']="Операции с таблицами: создание, удаление, очистка, резервные копии";

$adminModules['queryPrint']['active']=true;
$adminModules['queryPrint']['aliasMenu']="Печать запроса";
$adminModules['queryPrint']['altText']="Вывод содержимого запроса Select";