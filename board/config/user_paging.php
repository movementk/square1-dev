<?
if($pagebt1){
	echo "<a href='".$_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&board_idx=".$BoardViewRow["BoardIdx"]."&page=1&start_page=0&category=".$category."'><img src='".$pagebt1."' align='absmiddle' /></a>&nbsp;";
}

if($page > $PageBlock ){
	$prev_page = $start_for-$PageBlock;
	$prev_start_page = $start_page-1;
	echo "<a href='".$_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&board_idx=".$BoardViewRow["BoardIdx"]."&page=".$prev_page."&start_page=".$prev_start_page."'><img src='".$pagebt2."' align='absmiddle' /></a>&nbsp;";
}

for($i=$start_for;$i<=$last_for;$i++){
	if($i > $TotalPage) continue;

	if($page == $i) $thispage = "<font color='#ec7ea5'><strong>";
	else $thispage = "";
	
	echo "<a href='".$_SERVER['PHP_SELF']."?".$searchVal."&board_code=".$board_code."&board_idx=".$BoardViewRow['BoardIdx']."&page=".$i."&start_page=".$start_page."'>".$i."</strong></font></a>&nbsp;";
}

if(!$Count || $page == ""){
	echo "<strong>1</strong>";
}

if($start_for+$PageBlock <= $TotalPage){
	$next_page = $start_for+$PageBlock;
	$next_start_page = $start_page+1;
	echo "<a href='".$_SERVER['PHP_SELF']."?".$searchVal."&board_code=".$board_code."&board_idx=".$BoardViewRow['BoardIdx']."&page=".$next_page."&start_page=".$next_start_page."'><img src='".$pagebt3."' align='absmiddle' /></a>";
}

if($pagebt1){
	echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?".$searchVal."&board_code=".$board_code."&board_idx=".$BoardViewRow['BoardIdx']."&page=".$TotalPage."&start_page=".$last_page."&category=".$category."'><img src='".$pagebt4."'  align='absmiddle'/></a>";
}
?>