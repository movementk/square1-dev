<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"].$loc."/board/config/use_db.php";

if(preg_match("/[^0-9]/", preg_replace("/\-/i","",$Mobile))) {
	echo "100"; //숫자만 이용가능
	exit;
}

if($uid) $sql_common = " and UserID != '".$uid."' ";

$sql = " select count(*) as cnt from ".$memberdb." where Mobile = '".$Mobile."' $sql_common";
$row = sql_fetch($sql);

if($row["cnt"] > 0){
	echo "200"; //이미 사용중인 번호
} else {
	echo "000"; //사용가능함
}
?>
