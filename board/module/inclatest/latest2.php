<?
if(count($latest_list) > 0){
	for($i=0;$i<count($latest_list);$i++){
		$latest_list[$i][href] = "/".$latest_loc."?board_code=board_view&workType=".$board."&board_idx=".$latest_list[$i][BoardIdx];
?>
		<dl>
			<dt><a href="<?=$latest_list[$i][href]?>"><?=$latest_list[$i][subject]?></a></dt>
			<dd><?=substr($latest_list[$i][RegDate],0,10)?></dd>
		</dl>
<?
	}
} else { 
	echo "<dl><dt>게시물이 없습니다.</dt><dd></dd></dl>";
}
?>