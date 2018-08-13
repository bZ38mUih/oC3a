<?php

echo "<!DOCTYPE html>";
echo "<html lang='en-Us'>";
echo "<head>";
echo "<meta name='description' content='Возникла ошибка' http-equiv='Content-Type' charset='charset=utf-8'>";
echo "<title>Подключение</title>";
echo "<link rel='SHORTCUT ICON' href='/source/alerts/img/favicon.jpg' type='image/png'>";
echo "<link rel='stylesheet' href='/source/alerts/css/default.css' type='text/css' media='screen, projection'/>";;
echo "</head>";
echo "<body>";

echo "<div class='descriptionFrame' style='background-image: url(".'"/source/alerts/img/connErr.jpg"'.")'>";
echo "<h1>Подключение</h1>";
if (isset($this->errors['connection']['description']) and $this->errors['connection']['description']!=null){
    echo "<p>".$this->errors['connection']['description']."</p>";
}
echo "</div>";
echo "</body>";
echo "</html>";