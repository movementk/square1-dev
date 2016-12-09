<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t400 = "top_mon";
$t401 = "navi_mon";
$left = "l4";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."member";
$searchVal = "sfl=".$sfl."&stx=".$stx."&page=".$page;
$PageBlock = 10;
$board_list_num = 10;
$board_tit_len = 75;

$prev_part_href = '';
$next_part_href = '';

if($sfl && $stx){
	$sql_common .= " and ".$sfl." like '%".$stx."%' ";

	$max_spt = get_max($site_prefix."member","idx");

	if(!$spt) $spt = $max_spt;

	$prev_spt = $spt + 5000;
	if($prev_spt <= $max_spt)
		$prev_part_href = $_SERVER['PHP_SELF']."?bidx=".$bidx."&sfl=".$sfl."&stx=".urlencode($stx)."&spt=".$prev_spt;
	$next_spt = $spt - 5000;
	if($next_spt > 0)
		$next_part_href = $_SERVER['PHP_SELF']."?bidx=".$bidx."&sfl=".$sfl."&stx=".urlencode($stx)."&spt=".$next_spt;

	$sql_common .= " and (idx between '".intval($spt-5000)."' and '".$spt."' ) ";
}

if(empty($sql_order)) $sql_order = " idx desc ";

$TotalSQL = " select * from ".$mode." where 1=1 $sql_common order by $sql_order ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?bidx=".$bidx."&board_code=".$board_code."&page=","&spt=".$spt);
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">회원관리</div>
		<table class="list_table mt15">
			<colgroup>
				<col width="20%">
				<col width="20%">
				<col width="20%">
				<col width="30%">
				<col width="10%">
			</colgroup>
			<thead>
			<tr>
				<th>아이디</th>
				<th>이름</th>
				<th>휴대전화</th>
				<th>이메일</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<?
			$num = $TotalCount - ($page-1)*$board_list_num;
			for($i=0;$row = sql_fetch_array($result);$i++){
				$file = get_file($mode,$row["idx"]);
				switch($row["UseFlag"]){
					case "Y":
						$UseFlag = "<span style='font-weight:bold;'>승인</span>";
						break;
					case "N":
						$UseFlag = "<span style='color:#0016e6;font-weight:bold;'>미승인</span>";
						break;
				}
			?>
			<tr>
				<td><a href="/board/admn/member/mem_view.php?mtype=<?=$row["memberType"]?>&idx=<?=$row["idx"]?>"><?=$row["UserID"]?></a></td>
				<td><?=$row["UserName"]?></td>
				<td><?=$row["Mobile"]?></td>
				<td><?=$row["Email"]?></td>
				<td>
					<!--input type="image" src="/board/admn/images/btn/modify_btn.gif"-->
					<img src="/board/admn/images/btn/del_btn.gif" onclick="mem_del('<?=$row["idx"]?>');" style="cursor:pointer;">
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
					if($prev_part_href) echo "<li class='page_f'><a href='".$prev_part_href."' class='page_a' style='width:60px;'>이전검색</a></li>";
					if($Count>0){
					//	$write_pages = str_replace("처음", "<img src='/board/admn/images/common/start_btn.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
					//	$write_pages = str_replace("이전", "<img src='/board/admn/images/common/prev_btn.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
					//	$write_pages = str_replace("다음", "<img src='/board/admn/images/common/next_btn.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
					//	$write_pages = str_replace("맨끝", "<img src='/board/admn/images/common/end_btn.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
						//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
						$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
						echo $write_pages;
					}
					if($next_part_href) echo "<li class='page_f'><a href='".$next_part_href."' class='page_a' style='width:60px;'>다음검색</a></li>";
					?>
				</ul>
			</div>
		</div>
		<div class="mt5 mr10 btn_group"><button type="button" class="btn_a_n" style="display:none;" onclick="excel_down();">엑셀다운</button>&nbsp;<button type="button" class="btn_a_b" onclick="board_write();">등 록</button></div>
		<form name="search_form" method="get">
		<input type="hidden" name="bidx" value="<?=$bidx?>">
		<div class="search center">
			<select class="middle" name="sfl" align="absmiddle">
				<option value="UserID" <?=$sfl=="UserID"?"selected":""?>>아이디</option>
				<option value="UserName" <?=$sfl=="UserName"?"selected":""?>>이름</option>
			</select>
			<input type="text" id="stx" name="stx" value="<?=$stx?>" class="wd250 input">
			<button type="button" class="btn_a_b" onclick="searchGo();">검 색</button>
		</div>
		</form>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<form name="mem_form" method="post" action="/board/admn/_proc/member/_member_proc.php">
<input type="hidden" name="workType" value="D">
<input type="hidden" name="URI" value="<?=$_SERVER['REQUEST_URI']?>">
<input type="hidden" name="idx" value="">
</form>
<script>
function searchGo(){
	document.search_form.submit();
}
function excel_down(){
	location.href = "mem_excel.php";
}
function mem_del(idx){
	if(!confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 삭제하시겠습니까?")) return;
	var f = document.mem_form;
	f.idx.value = idx;
	if(FormCheck(f) == true){
		f.submit();
	}
}
function board_write(){
	location.href = "/board/admn/member/mem_view.php?<?=$searchVal?>";
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>