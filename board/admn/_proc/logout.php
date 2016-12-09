<?
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
setcookie("admin_idx2", "",0, "/");
setcookie("admin_id2", "",0, "/");
setcookie("admin_email2", "",0, "/");
setcookie("admin_name2", "",0, "/");
setcookie("admin_level2", "",0, "/");
setcookie("MemberIdx","", 0, '/');
setcookie("MemberID","", 0, '/');
setcookie("MemberName","", 0, '/');
setcookie("MemberEmail","", 0, '/');
setcookie("MemberLevel","", 0, '/');

header("location:/index.php");
?>
