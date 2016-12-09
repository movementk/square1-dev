<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";

echo "<select name='uid' class='input' exp title='대상'>\n";
echo "<option value=''>선택</option>\n";

$sql = " select * from ".$memberdb." where ".$sfl." like '%".$stx."%' order by idx asc ";
echo $sql;
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	echo "<option value='".$row["UserID"]."'>".$row["UserName"]." (".$row["UserID"].")</option>\n";
}

echo "</select>";
?>