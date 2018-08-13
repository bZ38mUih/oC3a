<?php
echo "<!DOCTYPE html>";
echo "<html lang='en-Us'>";
echo "<head>";
echo "<meta name='description' content='Возникла ошибка' http-equiv='Content-Type' charset='charset=utf-8'>";
echo "<title>Неизвестная ошибка</title>";
echo "<link rel='SHORTCUT ICON' href='/source/alerts/img/favicon.jpg' type='image/png'>";
echo "<link rel='stylesheet' href='/source/alerts/css/default.css' type='text/css' media='screen, projection'/>";;
echo "</head>";
echo "<body>";

echo "<div class='descriptionFrame' style='background-image: url(".'"/source/alerts/img/XXX-unknownError.jpg"'.")'>";
echo "<h1>Неизвестная ошибка</h1>";
if (isset($this->errors['XXX']['description']) and $this->errors['XXX']['description']!=null){
    echo "<p>".$this->errors['XXX']['description']."</p>";
}
echo "</div>";
echo "</body>";
echo "</html>";