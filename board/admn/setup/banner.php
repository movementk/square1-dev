<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t105 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."banner";
$searchVal = "bloc=".urlencode($bloc)."&sfl=".$sfl."&stx=".$stx."&page=".$page;
$PageBlock = 10;
$board_list_num = 10;

if(empty($bloc)) $bloc = "M1";

switch($bloc){
	case "M":
		$t01 = "<b>";
		break;
	case "M1":
		$t02 = "<b>";
		break;
	case "M2":
		$t03 = "<b>";
		break;
	case "M3":
		$t04 = "<b>";
		break;
}

$TotalSQL = " select * from ".$mode." where bloc = '".$bloc."' order by border desc ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?bloc=".$bloc."&page=");
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">배너관리</div>
		<div class="mt20 mb5">
			<img src="/board/admn/images/common/show_con.gif" width="10" height="10"><span class="pr10">사용중</span>
			<img src="/board/admn/images/common/hide_con.gif" width="10" height="10">사용안함<br><br>
			<a href="<?=$_SERVER['PHP_SELF']?>?bloc=M1"><?=$t02?>[메인-배너1]</b></a> | <a href="<?=$_SERVER['PHP_SELF']?>?bloc=M2"><?=$t03?>[메인-배너2]</b></a>
		</div>
		<table class="list_table mt5">
			<colgroup>
				<col width="10%">
				<col width="10%">
				<col width="40%">
				<col width="20%">
				<col width="20%">
			</colgroup>
			<thead>
			<tr>
				<th>상태</th>
				<th>이미지</th>
				<th>링크주소</th>
				<th>노출순서</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<?
			$num = $TotalCount - ($page-1)*$board_list_num;
			while($row = sql_fetch_array($result)){
				if($row[btarget] == "_blank") $btarget = "새창";
				else $btarget = "현재창";

				if($row[bstatus] == "N") $use_ck = "hide";
				else $use_ck = "show";

				$files = get_file($mode,$row["idx"]);

				if(!preg_match("/http\:\/\//i",substr($row["blink"],0,7))) $row["blink"] = "http://".$row["blink"];

			?>
			<tr>
				<td><img src="/board/admn/images/common/<?=$use_ck?>_con.gif"></td>
				<td class="pt5 pb5">
					<?
					if($files[0][file_source]){
						if($files[0][image_type]=="1" || $files[0][image_type]=="2" || $files[0][image_type]=="3" || $files[0][image_type]=="6"){
							echo $img = "<img src='".$files[0]["path"]."/".$files[0][file_source]."' width='100'>";
						}
					}
					?>
				</td>
				<td class="textL"><?=$row["blink"]?></td>
				<td><?=number_format($row["border"])?></td>
				<td>
					<button type="button" class="mbtn_a_n" onclick="banner_method('M','<?=$row["idx"]?>');">수 정</button>&nbsp;
					<button type="button" class="mbtn_a_b" onclick="banner_method('D','<?=$row["idx"]?>');">삭 제</button>
				</td>
			</tr>
			<?
			}
			?>
			</tbody>
		</table>
		<div class="page_group mt10">
			<div class='page_navi_box'>
				<ul>
					<?
					if($Count>0){
					//	$write_pages = str_replace("처음", "<img src='/board/admn/images/common/start_btn.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
					//	$write_pages = str_replace("이전", "<img src='/board/admn/images/common/prev_btn.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
					//	$write_pages = str_replace("다음", "<img src='/board/admn/images/common/next_btn.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
					//	$write_pages = str_replace("맨끝", "<img src='/board/admn/images/common/end_btn.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
						//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
						$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
						echo $write_pages;
					}
					?>
				</ul>
			</div>
		</div>
		<div class="mt5 mr10 btn_group"><button type="button" class="btn_a_b" onclick="banner_method('I','');">등 록</button></div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<form name="banner_form" method="post" action="/board/admn/_proc/setup/_banner_proc.php">
<input type="hidden" name="URI" value="<?=$_SERVER['REQUEST_URI']?>">
<input type="hidden" name="workType" value="">
<input type="hidden" name="idx" value="">
<input type="hidden" name="page" value="<?=$page?>">
</form>
<script>
function banner_method(str,idx){
	var f = document.banner_form;
	if(str == "M" || str == "I") f.action = "/board/admn/setup/banner_write.php";
	if(str == "D"){
		if(!confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 삭제하시겠습니까?")) return;
	}
	f.workType.value = str;
	f.idx.value = idx;
	f.submit();
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>