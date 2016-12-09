<?php
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.'/config/securimage/securimage.php';

$secu_img = new securimage();

$secu_img->show(); // alternate use:  $img->show('/path/to/background.jpg');
?>
