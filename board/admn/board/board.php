<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t200 = "top_mon";
$t202 = "navi_mon";
$left = "l2";

switch($bidx){
	case 8:
	case 9:
	case 10:
		$t100 = "top_mon";
		$t200 = "";
		$left = "l1";
		break;
}

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

if($bidx){
	$blist = get_board_setting($bidx);
	$board_setting = $blist[0];
	unset($blist);
}

$mode = $site_prefix."board_".$board_setting["BoardName"];
$BoardName = $board_setting["BoardName"];
$searchVal = "Category=".urlencode($Category)."&sfl=".$sfl."&stx=".$stx."&page=".$page."&bidx=".$bidx."&cat=".$cat;
$PageBlock = 10;
$board_list_num = 10;
$board_tit_len = 75;

if($sfl && $stx){
	$sql_common .= " and ".$sfl." like '%".$stx."%' ";

	$max_spt = get_max($mode,"BoardIdx");

	if(!$spt) $spt = $max_spt;

	$prev_spt = $spt + 5000;
	if($prev_spt <= $max_spt)
		$prev_part_href = $_SERVER['PHP_SELF']."?bidx=".$bidx."&sfl=".$sfl."&stx=".urlencode($stx)."&spt=".$prev_spt;
	$next_spt = $spt - 5000;
	if($next_spt > 0)
		$next_part_href = $_SERVER['PHP_SELF']."?bidx=".$bidx."&sfl=".$sfl."&stx=".urlencode($stx)."&spt=".$next_spt;

	$sql_common .= " and (BoardIdx between '".intval($spt-5000)."' and '".intval($spt)."' ) ";
}

if($Category) $sql_common .= " and Category = '".$Category."' ";

if($cat) $sql_common .= " and bd1 = '".$cat."' ";

if(empty($sql_order)) $sql_order = " Ref desc, ReLevel asc, ReStep asc ";

$TotalSQL = " select * from ".$mode." where Notice != '1' $sql_common order by $sql_order ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?Category=".$Category."&cat=".$cat."&bidx=".$bidx."&board_code=".$board_code."&sfl=".$sfl."&stx=".$stx."&page=","&spt=".$spt);
?>
<div id="container">
	<div class="content_view">
		<div class="con_title"><?=$board_setting["BoardTitle"]?></div>
		<table class="list_table mt15">
			<colgroup>
				<col width="5%">
				<col width="60%">
				<col width="12.5%">
				<col width="12.5%">
				<col width="10%">
			</colgroup>
			<thead>
			<tr>
				<th>No</th>
				<th>제목</th>
				<th>작성자</th>
				<th>작성일</th>
				<th>조회수</th>
			</tr>
			</thead>
			<tbody>
			<?
			$nsql = " select * from ".$mode." where Notice = '1' order by BoardIdx desc ";
			$nresult = sql_query($nsql);
			for($i=0;$nrow = sql_fetch_array($nresult);$i++){
				$Title = cut_string($nrow[Title], $board_tit_len);
			?>
			<tr class='notice'>
				<td>[공지]</td>
				<td class="subject"><a href="/board/admn/board/board_view.php?<?=$searchVal?>&idx=<?=$nrow["BoardIdx"]?>"><?=$Title?></a></td>
				<td><?=$nrow["UserName"]?></td>
				<td><?=substr($nrow["RegDate"],0,10)?></td>
				<td><?=$nrow["ReadNum"]?></td>
			</tr>
			<?
			}
			$num = $TotalCount - ($page-1)*$board_list_num;
			for($i=0;$row = sql_fetch_array($result);$i++){
				$csql = " select count(*) as cnt from ".$site_prefix."board_comment where DBName = '".$mode."' and BoardIdx = '".$row["BoardIdx"]."' ";
				$crow = sql_fetch($csql);
				
				$Title = cut_string(search_font($stx,$row[Title]),$board_tit_len);

				$file = get_file($mode,$row["BoardIdx"]);

				$username = $row["UserName"];
			?>
			<tr>
				<td><?=$num?></td>
				<td class="subject">
					<?
					for($i=1;$i <= $row["ReLevel"];$i++){
						if($i == $row["ReLevel"]){
							echo "&nbsp;[RE]&nbsp;"; 
						} else {
							echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						}
					}

					if($row["Category"]){ echo "<a href='".$_SERVER['PHP_SELF']."?bidx=".$bidx."&Category=".urlencode($row["Category"])."'>[".$row["Category"]."]</a>";}

					echo "&nbsp;<a href='/board/admn/board/board_view.php?".$searchVal."&idx=".$row["BoardIdx"]."'>".$row[Title]."</a>";
					
					if($crow["cnt"]){echo "(".$crow["cnt"].")";} 

					if($row["border"]) echo "&nbsp;&nbsp;<span style='color:#e00000;font-weight:bold;'>[노출순서 : ".$row["border"]."]</span>";

					if($BoardName == "lost")  echo "&nbsp;&nbsp;<span style='color:#e00000;font-weight:bold;'>[".$row["bd1"]." / ".$row["bd2"]." / ".$row["bd3"]." / ".$row["bd10"]."]</span>";
					?>
				</td>
				<td><?=$username?></td>
				<td><?=substr($row["RegDate"],0,10)?></td>
				<td><?=$row["ReadNum"]?></td>
			</tr>
			<?
			$num--;
			}

			if($Count == 0) echo "<tr><td colspan='10' align='center'>게시물이 없습니다.</td></tr>";
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
		<div class="mt5 mr10 btn_group">
			<? if(!empty($Category) || (!empty($sfl) && !empty($stx)) || !empty($cat2) || !empty($ncat)){ ?>
			<div style="position:absolute;left:0px;top:0px;"><button type="button" class="btn_a_b" onclick="board_list_move();">전체목록</button></div>
			<? } ?>
			<? if($BoardName != "account"){ ?>
			<button type="button" class="btn_a_b" onclick="board_write();">등 록</button>
			<? } ?>
		</div>
		<form name="search_form" method="get">
		<input type="hidden" name="bidx" value="<?=$bidx?>">
		<div class="search center">
			<select class="middle" name="sfl" align="absmiddle">
				<option value="Title" <?=$sfl=="Title"?"selected":""?>>제목</option>
				<option value="Content" <?=$sfl=="Content"?"selected":""?>>내용</option>
				<option value="UserName" <?=$sfl=="UserName"?"selected":""?>>작성자</option>
			</select>
			<input type="text" id="stx" name="stx" value="<?=$stx?>" class="wd250 input">
			<button type="button" class="btn_a_b" onclick="this.form.sumbit();">검 색</button>
		</div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script>
function account_cancle(idx){
	if(!confirm("취소된 자료는 되돌릴 수 없습니다. 취소하시겠습니까?")) return;
	location.href = "/board/admn/_proc/board/_board_proc.php?workType=AD&idx="+idx;
}
function board_list_move(){
	location.href = "/board/admn/board/board.php?bidx=<?=$bidx?>";
}
function board_write(){
	location.href = "/board/admn/board/board_write.php?<?=$searchVal?>";
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>