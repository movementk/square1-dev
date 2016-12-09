<?
include $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";
$mode = $site_prefix."board_store";
if(trim($_POST["stx"]) != ""){
	$sql = " select * from ".$mode." where Title like '%".$_POST["stx"]."%' order by BoardIdx desc ";
	$result = sql_query($sql);
	$cnt = @mysql_num_rows($result);

	if($cnt == 0){
		echo '<p class="nothing">검색결과가 없습니다.</p>';
	} else {
		echo "<ul>";
		for($i=0;$row = sql_fetch_array($result);$i++){
			switch($row["bd4"]){
				case "0":
					$floor = "B1";
					break;
				case "1":
				case "2":
				case "3":
				case "4":
				case "5":
				case "6":
				case "7":
					$floor = $row["bd4"]."F";
					break;
			}
			echo "<li class='global-search-result-li'><a href='/store/floor.php?Category=".$floor."'>".$row["Title"]."</a></li>";
		}
		echo "</ul>";
	}
} else {
	echo '<p class="nothing">검색결과가 없습니다.</p>';
}
?>