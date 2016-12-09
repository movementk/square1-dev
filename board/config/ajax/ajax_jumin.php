<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";

$jumin1 = $_REQUEST[jumin1];
$jumin2 = $_REQUEST[jumin2];

$sql = " select count(*) as cnt from ".$site_prefix."app0 where Jumin1 = '".$jumin1."' and Jumin2 = '".sql_password($jumin2)."' ";
$row = sql_fetch($sql);

if($row[cnt] > 0){
	echo "<span style='color:#e00000;font-weight:bold;'>이미 등록된 번호 입니다.</span><input type='hidden' name='juminchk' value='No'>";
} else {
	echo "<span style='color:#3530ff;font-weight:bold;'>등록 가능합니다.</span><input type='hidden' name='juminchk' value='Yes'>";
}

?>