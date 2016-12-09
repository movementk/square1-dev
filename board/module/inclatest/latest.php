<?
if(count($latest_list) > 0){
	for($i=0;$i<count($latest_list);$i++){
		$latest_list[$i][href] = "/".$latest_loc."?board_code=board_view&workType=".$board."&board_idx=".$latest_list[$i][BoardIdx];
	?>
	<li><a href="<?=$latest_list[$i][href]?>" class="list"><?=$latest_list[$i][subject]?></a></li>
	<?
	}

} else { ?>
	<li>게시물이 없습니다.</li>
<? } ?>