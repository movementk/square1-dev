<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t104 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."popup";

$PageBlock = 10;
$board_list_num = 10;

$sql_common = "";

if($start_date){
	$sql_common .= " and start_date >= '".$start_date."' ";
}

if($end_date){
	$sql_common .= " and end_date <= '".$end_date."' ";
}

if($uname){
	$sql_common .= " and uname like '%".$uname."%' ";
}

if($Title){
	$sql_common .= " and Title like '%".$Title."%' ";
}


$TotalSQL = " select * from ".$mode." where 1=1 $sql_common order by Idx desc ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?start_date=".$start_date."&end_date=".$end_date."&uname=".$uname."&Title=".$Title."&page=");
?>
<script src="/board/config/js/jquery.blockUI.js" type="text/javascript" language="javascript"></script>
<div id="container">
	<div class="content_view">
		<div class="con_title">팝업관리</div>
		<form name="search_form" method="get" >
		<table class="write_table">
			<colgroup>
				<col style="width:120px;"></col>
				<col></col>
			</colgroup>
			<tbody>
			<tr>
				<th><label>운영기간</label></th>
				<td><input type="text" class="input wd120 datepick" name="start_date" title="운영기간" value="<?=$start_date?>"> ~ <input type="text" class="input wd120 datepick" name="end_date" title="운영기간" value="<?=$end_date?>"></td>
			</tr>
			<tr>
				<th><label>작성자</label></th>
				<td><input type="text" class="input wd120" name="uname" title="작성자" value="<?=$uname?>"></td>
			</tr>
			<tr>
				<th>제목</th>
				<td><input type="text" class="input wd460" name="Title" exp title="제목" value="<?=$Title?>"></td>
			</tr>
			</tbody>
		</table>

		<div class="btn_group">
			<? if($sql_common){ ?>
			<button type="button" class="btn_a_n" onclick="location.href = '<?=$_SERVER['PHP_SELF']?>';">초기화</button>&nbsp;
			<? } ?>
			<button type="button" class="btn_a_b" onclick="search_start();">검 색</button>
		</div>
		</form>
		<table class="list_table mt15">
			<colgroup>
				<col width="5%">
				<col width="">
				<col width="20%">
				<col width="10%">
				<col width="10%">
				<col width="20%">
			</colgroup>
			<thead>
			<tr>
				<th>No.</th>
				<th>제목</th>
				<th>기간</th>
				<th>작성자</th>
				<th>등록일</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<?
			$num = $TotalCount - ($page-1)*$board_list_num;
			while($row = sql_fetch_array($result)){
				if($row[tar] == "_blank") $tar = "새창";
				else $tar = "현재창";

				if($row[use_ck] == "N") $use_ck = "hide";
				else $use_ck = "show";
			?>
			<tr>
				<td><?=$num?></td>
				<td class="textL"><?=$row["Title"]?> [<?=$use_ck?>]</td>
				<td><?=date("Y년 m월 d일 H시",strtotime($row["start_date"]))?> ~ <?=date("Y년 m월 d일 H시",strtotime($row["end_date"]))?></td>
				<td><?=$row["uname"]?></td>
				<td><?=substr($row["RegDate"],0,10)?></td>
				<td>
					<button type="button" class="mbtn_a_b" onclick="popup_method('C','<?=$row["Idx"]?>');">복 사</button>&nbsp;
					<button type="button" class="mbtn_a_b" onclick="popup_method('M','<?=$row["Idx"]?>');">수 정</button>&nbsp;
					<button type="button" class="mbtn_a_a" onclick="popup_method('D','<?=$row["Idx"]?>');">삭 제</button>&nbsp;
					<button type="button" class="mbtn_a_c" onclick="popup_method('V','<?=$row["Idx"]?>');">미리보기</button>
				</td>
			</tr>
			<?
				$num--;
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
		<div class="mt5 mr10 btn_group"><button type="button" class="btn_a_b" onclick="popup_method('I','');">등 록</button></div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<form name="popup_form" method="post" action="/board/admn/_proc/setup/_popup_proc.php">
<input type="hidden" name="URI" value="<?=$_SERVER['REQUEST_URI']?>">
<input type="hidden" name="workType" value="">
<input type="hidden" name="idx" value="">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="copy_idx" value="">
</form>
<div id="pop_view" style="position:absolute;top:100px;left:50%;display:none;z-index:9999999999999999;border:3px solid #c9c9c9;"></div>
<script>
function popup_method(str,idx){
	var f = document.popup_form;
	if(str == "V"){
		jQuery.ajax({
			url: "ajax_pop.php",
			type: 'POST',
			data: "idx="+idx,

			error: function(xhr,textStatus,errorThrown){
				alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
			},
			beforeSend: function() {
				$.blockUI({"message":""});
			},
			success: function(data){
				$("#pop_view").html(data);
			},
			complete: function(){
			//	alert($("#pop_img").attr("width"));
				$("#pop_view").css({"margin-left":"-"+parseInt($("#pop_img").width()/2)+"px"}).show();
			}
		});
	} else {
		if(str == "M" || str == "I" || str == "C") f.action = "/board/admn/setup/popup_write.php";
		if(str == "D"){
			if(!confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 삭제하시겠습니까?")) return;
		}
		f.workType.value = str;
		f.idx.value = idx;
		f.submit();
	}
}

function pop_close(){
	$("#pop_view").hide().html("");
	$.unblockUI();
}

function search_start(){
	document.search_form.submit();
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>