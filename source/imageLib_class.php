<?php
/**
 * Created by PhpStorm.
 * User: AVP
 * Date: 03.01.2016
 * Time: 17:21
 *
 * version 1.1.0
 */

class imageLib
{

    public function createPreview($tagetImg, $result, $height=100, $width=100)
    {
        //$rgb = 0xffffff; //цвет заливки несоответствия
        //$rgb = 1; //цвет заливки несоответствия
        $size = getimagesize($tagetImg);//узнаем размеры картинки (дает нам масив size)
        $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1)); //определяем тип файла
        $icfunc = "imagecreatefrom" . $format;   //определение функции соответственно типу файла
        if (!function_exists($icfunc)) return false;  //если нет такой функции прекращаем работу скрипта
        $x_ratio = $width / $size[0]; //пропорция ширины будущего превью 0.145348
        $y_ratio = $height / $size[1]; //пропорция высоты будущего превью 0.1937
        $ratio = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio); //соотношения ширины к высоте
        $new_width = $use_x_ratio ? $width : floor($size[0] * $ratio); //ширина превью
        $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio); //высота превью
        $new_left = $use_x_ratio ? 0 : floor(($width - $new_width) / 2); //расхождение с заданными параметрами по ширине
        $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2); //расхождение с заданными параметрами по высоте
        $img = imagecreatetruecolor($width, $height); //создаем вспомогательное изображение пропорциональное превью
        //imagefill($img, 0, 0, $rgb); //заливаем его…
        $color = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $color); //заливаем его…
        imagesavealpha($img, true);
        $photo = $icfunc($tagetImg); //достаем наш исходник
        imagecopyresampled($img, $photo, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]); //копируем на него нашу превью с учетом расхождений
        //header('Content-Type: image/jpeg');
        header('Content-Type: image/png');
        //imagejpeg($img, $result);
        imagepng($img, $result);

        //$appRJ->response['result'].= "new_left=".$new_left."<br>new_top=".$new_top."<br>new_width=".$new_height.
        //    "<br>new_height=".$new_height."<br>size0=".$size[0]."<br>size1=".$size[1];
    }
}