<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.$configDir."/admin_check.php";

if($old_id) $sql_common = " and admin_id != '".$old_id."' ";

$sql = " select count(*) as cnt from ".$site_prefix."admin where admin_id = '".$val."' {$sql_common} ";
$row = sql_fetch($sql);

if($row["cnt"] > 0) $str = "201";
else $str = "100";

if(strlen($val) < 4) $str = "200";

echo $str;
?>