<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t111 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$searchVal = "page=".$page;
$PageBlock = 10;
$board_list_num = 200;
$board_tit_len = 75;

$mode = $site_prefix."job_category";

$TotalSQL = " select * from ".$mode." where 1=1 $sql_common order by idx asc  ";
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
	$workType = "JI";
} else {
	$asql = " select * from ".$mode." where idx= '".$idx."' ";
	$arow = sql_fetch($asql);
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">회원직업관리</div>
		<form name="info_form" method="post" action="/board/admn/_proc/setup/_admin_proc.php">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="idx" value="<?=$arow["idx"]?>">
		<input type="hidden" name="URI" value="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="dupe_ck" value="N">
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
				<th><label>직업명</label></th>
				<td><input type="text" class="input" name="job_name" exp title="등급명" value="<?=$arow["job_name"]?>" onchange="dupe_reset()">&nbsp;<button type="button" class="btn_a_n" onclick="job_dupe_ck();">중복확인</button><span id="span_id_ck" style="color:red;font-weight:bold;padding-left:10px;">※ 한글 2글자 또는 영문 4글자이상 입력하시기 바랍니다.</span></td>
				<th><label>설명</label></th>
				<td><input type="text" class="input wd600" name="job_text" exp title="설명" value="<?=$arow["job_text"]?>"></td>
			</tr>
			</tbody>
		</table>

		<div class="btn_group">
			<button type="button" class="btn_a_b" onclick="form_ck();"><?=$workType=="JI"?"등 록":"수 정"?></button>
		</div>
		</form>

		<span id="span_id_ck" style="color:red;font-weight:bold;padding-left:10px;">※ 직업명 삭제시 기존 회원정보는 업데이트되지 않습니다.</span>
		<table class="list_table mt15">
			<colgroup>
				<col width="5%">
				<col width="10%">
				<col width="10%">
				<col width="">
				<col width="15%">
				<col width="15%">
			</colgroup>
			<thead>
			<tr>
				<th>No</th>
				<th>직업명</th>
				<th>회원수</th>
				<th>설명</th>
				<th>등록일</th>
				<th>관리</th>
			</tr>
			</thead>
			<?
			$num = $TotalCount - ($page-1)*$board_list_num;
			for ($i=0; $row=sql_fetch_array($result); $i++){
				$msql = " select count(*) as cnt from ".$memberdb." where UserLevel = '".$row["idx"]."' ";
				$mrow = sql_fetch($msql);
			?>
			<tr>
				<td><?=$i+1;?></td>
				<td><?=$row["job_name"]?></td>
				<td><?=number_format($mrow["cnt"])?></td>
				<td><?=$row["job_text"]?></td>
				<td><?=date("Y-m-d",$row["wr_datetime"])?></td>
				<td>
					<div class="floatL pt5" style="width:100%;"><button type="button" class="mbtn_a_n" onclick="admin_modify('JM','<?=$row["idx"]?>');">수 정</button></div>
					<div class="floatL pt5 pb5" style="width:100%;"><button type="button" class="mbtn_a_b" onclick="admin_modify('JD','<?=$row["idx"]?>');">삭 제</button></div>
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
	if(type == "JD"){
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
function job_dupe_ck(){
	var id_dupe_ck = "N";
	var id_dupe_str = "";
	jQuery.ajax({
		url: "/board/admn/setup/ajax_dupe_check.php",
		type : "POST",
		data: "workType=JOB&str_limit=4&mode=<?=$mode?>&val="+$("input[name='job_name']").val()+"&old_name=<?=$arow['job_name']?>",

		error: function(xhr,textStatus,errorThrown){
			alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
		},
		beforeSend: function() {
		},
		success: function(data){
			switch(data){
				case "100":
					id_dupe_ck = "Y";
					id_dupe_str = "※ 사용 가능한 직업 입니다.";
					break;
				case "200":
					id_dupe_ck = "N";
					id_dupe_str = "※ 한글 2글자 또는 영문 4글자이상 입력하시기 바랍니다.";
					break;
				case "201":
					id_dupe_ck = "N";
					id_dupe_str = "※ 이미 존재하는 직업 입니다.";
					break;
				default:
					id_dupe_ck = "N";
					id_dupe_str = data;
					break;
			}
		},
		complete: function(){
			if(id_dupe_ck == "Y") $("#span_id_ck").css({"color":"blue"});
			else $("#span_id_ck").css({"color":"red"});

			$("input[name='dupe_ck']").val(id_dupe_ck);

			$("#span_id_ck").html(id_dupe_str);
		}
	});
}
function form_ck(){
	var f = document.info_form;
	if($("input[name='dupe_ck']").val() == "N"){
		alert("직업명 중복확인을 해주시기 바랍니다.");
		return;
	}
	if(FormCheck(f) == true){
		f.submit();
	} else {
		return;
	}
}

function dupe_reset(){
	$("input[name='dupe_ck']").val("N");
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>