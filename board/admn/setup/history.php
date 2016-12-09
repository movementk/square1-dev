<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t113 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$searchVal = "page=".$page;
$PageBlock = 10;
$board_list_num = 10;
$board_tit_len = 75;

$mode = $site_prefix."history";

if(!isset($hyear)) $hyear = date("Y",time());



$TotalSQL = " select * from ".$mode." where hyear = '".$hyear."' $sql_common order by idx asc  ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?page=");

if(empty($workType)){
	$workType = "HI";
} else {
	$asql = " select * from ".$mode." where idx= '".$idx."' ";
	$arow = sql_fetch($asql);
	$arow["files"] = get_file($site_prefix."history",$arow["idx"]);
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">연혁 관리</div>
		<form name="info_form" method="post" action="/board/admn/_proc/setup/_banner_proc.php" enctype="MULTIPART/FORM-DATA">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="idx" value="<?=$arow["idx"]?>">
		<input type="hidden" name="URI" value="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="mode" value="<?=$mode?>">
		<table class="write_table">
			<colgroup>
				<col style="width:120px;"></col>
				<col></col>
				<col style="width:120px;"></col>
				<col></col>
			</colgroup>
			<tbody>
			<tr>
				<th><label>연/월</label></th>
				<td>
					<input type="text" class="input wd70" name="hyear" exp title="등급명" value="<?=$arow["hyear"]?>">&nbsp;
					<select name="hmonth" class="input">
						<option value="">선택</option>
						<option value="01" <?=$arow["hmonth"]==1?"selected":""?>>1월</option>
						<option value="02" <?=$arow["hmonth"]==2?"selected":""?>>2월</option>
						<option value="03" <?=$arow["hmonth"]==3?"selected":""?>>3월</option>
						<option value="04" <?=$arow["hmonth"]==4?"selected":""?>>4월</option>
						<option value="05" <?=$arow["hmonth"]==5?"selected":""?>>5월</option>
						<option value="06" <?=$arow["hmonth"]==6?"selected":""?>>6월</option>
						<option value="07" <?=$arow["hmonth"]==7?"selected":""?>>7월</option>
						<option value="08" <?=$arow["hmonth"]==8?"selected":""?>>8월</option>
						<option value="09" <?=$arow["hmonth"]==9?"selected":""?>>9월</option>
						<option value="10" <?=$arow["hmonth"]==10?"selected":""?>>10월</option>
						<option value="11" <?=$arow["hmonth"]==11?"selected":""?>>11월</option>
						<option value="12" <?=$arow["hmonth"]==12?"selected":""?>>12월</option>
					</select>&nbsp;
					<input type="checkbox" name="is_main" value="1"> 대표이미지
				</td>
				<th><label>내용</label></th>
				<td><input type="text" class="input wd600" name="htext" exp title="설명" value="<?=$arow["htext"]?>"></td>
			</tr>
			<tr>
				<th><label>첨부파일</label></th>
				<td colspan="3">
					<input type='file' class='input wd460' name='bf_file[]' title=''>
					<?
					if($arow["files"][0]["file_source"]){
						echo "<img src='/board/upload/bbbhistory/".$arow["files"][0]["file_source"]."' width='200' />";
					}
					?>
				</td>
			</tr>
			</tbody>
		</table>
		<span id="span_id_ck" style="color:red;font-weight:bold;padding-left:10px;">※ 첨부파일 사이즈는 381 x 200 입니다.</span>

		<div class="btn_group">
			<button type="button" class="btn_a_b" onclick="form_ck();"><?=$workType=="HI"?"등 록":"수 정"?></button>
		</div>
		</form>
		<?
		for($i=date("Y",time());$i >= 2002;$i--){
			if($hyear == $i) echo "<b>";
			echo "<a href='".$_SERVER['PHP_SELF']."?hyear=".$i."'>[".$i."]</a></b>&nbsp;&nbsp;";
		}
		?>
		<table class="list_table mt15">
			<colgroup>
				<col width="5%">
				<col width="10%">
				<col width="">
				<col width="15%">
				<col width="15%">
			</colgroup>
			<thead>
			<tr>
				<th>No</th>
				<th>연/월</th>
				<th>내용</th>
				<th>첨부파일</th>
				<th>관리</th>
			</tr>
			</thead>
			<?
			$num = $TotalCount - ($page-1)*$board_list_num;
			for ($i=0; $row=sql_fetch_array($result); $i++){
				$row["files"] = get_file($site_prefix."history",$row["idx"]);
			?>
			<tr>
				<td><?=$i+1;?></td>
				<td><?=$row["hyear"]?> / <?=$row["hmonth"]?></td>
				<td><?=$row["htext"]?></td>
				<td>
					<?
					if($row["files"][0]["file_source"]){
						echo "<img src='/board/upload/bbbhistory/".$row["files"][0]["file_source"]."' width='200' />";
					}
					?>
				</td>
				<td>
					<div class="floatL pt5" style="width:100%;"><button type="button" class="mbtn_a_n" onclick="admin_modify('HM','<?=$row["idx"]?>');">수 정</button></div>
					<div class="floatL pt5 pb5" style="width:100%;"><button type="button" class="mbtn_a_b" onclick="admin_modify('HD','<?=$row["idx"]?>');">삭 제</button></div>
				</td>
			</tr>
			<?
				$num--;
			}

			if ($i == 0) {
				echo "<tr><td colspan=20 height=100 bgcolor='#ffffff' align=center><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
			}
			?>
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
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script>
function admin_modify(type,val){
	var f = document.info_form;
	if(type == "HD"){
		if(!confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 삭제하시겠습니까?")){
			return;
		}
		f.idx.value = val;
		f.workType.value = type;
		f.submit();
	} else {
		location.href = "<?=$_SERVER['PHP_SELF']?>?workType="+type+"&idx="+val;
	}
}

function form_ck(){
	var f = document.info_form;
	if(FormCheck(f) == true){
		f.submit();
	} else {
		return;
	}
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>