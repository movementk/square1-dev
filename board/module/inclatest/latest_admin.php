<?
if(count($latest_list) > 0){
	for($i=0;$i<count($latest_list);$i++){
		$latest_list[$i][href] = "/".$latest_loc."&idx=".$latest_list[$i][BoardIdx];
	?>
	<li class="subject">· <a href="<?=$latest_list[$i][href]?>"><?=$latest_list[$i][subject]?></a></li>
	<li class="date"><?=substr($latest_list[$i][RegDate],0,10)?></li>
	<?
	}

} else { ?>
	<li class="subject">게시물이 없습니다.</li>
<? } ?>