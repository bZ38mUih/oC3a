<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 04.01.2018
 * Time: 17:40
 */

echo "<!DOCTYPE html>";
echo "<html lang='en-Us'>";
echo "<head>";
echo "<meta name='description' content='Возникла ошибка' http-equiv='Content-Type' charset='charset=utf-8'>";
echo "<title>Не найдено</title>";
echo "<link rel='SHORTCUT ICON' href='/source/alerts/img/favicon.jpg' type='image/png'>";
echo "<link rel='stylesheet' href='/source/alerts/css/default.css' type='text/css' media='screen, projection'/>";;
echo "</head>";
echo "<body>";
echo "<div class='descriptionFrame' style='background-image: url(".'"/source/alerts/img/404-not-found.jpg"'.")';>";
echo "<h1>Не найдено</h1>";
if (isset($this->errors['404']['description']) and $this->errors['404']['description']!=null){
    echo "<p>".$this->errors['404']['description']."</p>";
}
echo "</div>";
echo "</body>";
echo "</html>";