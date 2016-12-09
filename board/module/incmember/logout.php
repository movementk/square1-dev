<?
ob_start();
include $_SERVER[DOCUMENT_ROOT].$loc."/board/config/use_db.php";
include $_SERVER[DOCUMENT_ROOT].$loc."/board/config/common_top.php";

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

err_move('안전하게 로그아웃 되었습니다.',$loc."/index.php");
//echo "<script>location.href='/index.php';</script>";
include $_SERVER[DOCUMENT_ROOT].$loc."/board/config/common_bottom.php";
?>