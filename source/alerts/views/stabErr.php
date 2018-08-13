<?php
/**
 * Created by PhpStorm.
 * User: Dorian Gray
 * Date: 05.01.2018
 * Time: 14:50
 */
echo "<!DOCTYPE html>";
echo "<html lang='en-Us'>";
echo "<head>";
echo "<meta name='description' content='Возникла ошибка' http-equiv='Content-Type' charset='charset=utf-8'>";
echo "<title>Реконструкция</title>";
echo "<link rel='SHORTCUT ICON' href='/source/alerts/img/favicon.jpg' type='image/png'>";
echo "<link rel='stylesheet' href='/source/alerts/css/default.css' type='text/css' media='screen, projection'/>";;
echo "</head>";
echo "<body>";
echo "<div class='descriptionFrame' style='background-image: url(/source/alerts/img/stabErr.jpg)'>";
echo "<h1>Сайт временно на реконструкции</h1>";
if (isset($this->errors['stab']['description']) and $this->errors['stab']['description']!=null){
    echo "<p>".$this->errors['stab']['description']."</p>";
}
echo "</div>";
echo "</body>";
echo "</html>";