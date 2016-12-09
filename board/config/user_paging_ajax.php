<?
if($pagebt1){
	echo "<a href='javascript:;' onclick='".$funcname."(\"".$cidx."\",\"1\",\"0\",\"".$bidx."\");'><img src='".$pagebt1."' align='absmiddle' /></a>&nbsp;";
}

if($page > $PageBlock ){
	$prev_page = $start_for-$PageBlock;
	$prev_start_page = $start_page-1;
	echo "<a href='javascript:;' onclick='".$funcname."(\"".$cidx."\",\"".$prev_page."\",\"".$prev_start_page."\",\"".$bidx."\");'><img src='".$pagebt2."' align='absmiddle' /></a>&nbsp;";
}

for($i=$start_for;$i<=$last_for;$i++){
	if($i > $TotalPage) continue;
	if($page == $i) $thispage = "color:#ec7ea5;font-weight:bold;";
	else $thispage = "";
	echo "<a href='javascript:;' onclick='".$funcname."(\"".$cidx."\",\"".$i."\",\"".$start_page."\",\"".$bidx."\");' style='".$thispage."'>".$i."</strong></font></a>&nbsp;";
}

if(!$Count || $page == ""){
	echo "<strong>1</strong>";
}

if($start_for+$PageBlock <= $TotalPage){
	$next_page = $start_for+$PageBlock;
	$next_start_page = $start_page+1;
	echo "<a href='javascript:;' onclick='".$funcname."(\"".$cidx."\",\"".$next_page."\",\"".$next_start_page."\",\"".$bidx."\");'><img src='".$pagebt3."' align='absmiddle' /></a>";
}

if($pagebt1){
	echo "&nbsp;<a href='javascript:;' onclick='".$funcname."(\"".$cidx."\",\"".$TotalPage."\",\"".$last_page."\",\"".$bidx."\");'><img src='".$pagebt4."'  align='absmiddle'/></a>";
}
?>