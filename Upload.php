<?php
function uploadimg()
{
    $img_name = $_FILES['img']['name'];
    $tmp_img_name = $_FILES['img']['tmp_name'];
    move_uploaded_file($tmp_img_name, $_SERVER['DOCUMENT_ROOT'] . "\img\\" . $img_name);
}