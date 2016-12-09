<?
$admin_limit = 99;
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t101 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."admin";

$PageBlock = 10;
$board_list_num = 10;

$sql_common = "";

if($aid){
	$sql_common .= " and admin_id like '%".$aid."%' ";
}

if($aname){
	$sql_common .= " and admin_name like '%".$aname."%' ";
}

if($ahp){
	$sql_common .= " and admin_hp like '%".$ahp."%' ";
}

$TotalSQL = " select * from ".$mode." where 1=1 $sql_common order by admin_idx desc ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?aid=".$aid."&aname=".$aname."&ahp=".$ahp."&page=");
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">관리자 설정</div>

		<form name="search_form" method="get" >
		<table class="write_table">
			<colgroup>
				<col style="width:120px;"></col>
				<col></col>
				<col style="width:120px;"></col>
				<col></col>
				<col style="width:120px;"></col>
				<col></col>
			</colgroup>
			<tbody>
			<tr>
				<th><label>아이디</label></th>
				<td><input type="text" class="input wd120" name="aid" title="아이디" value="<?=$aid?>"></td>
				<th><label>이름</label></th>
				<td><input type="text" class="input wd120" name="aname" title="이름" value="<?=$aname?>"></td>
				<th>휴대폰</th>
				<td><input type="text" class="input wd120" name="ahp" title="휴대폰" value="<?=$ahp?>"></td>
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
		
		<form name="admin_list" method="post" action="/board/admn/_proc/setup/_admin_proc.php">
		<input type="hidden" name="URI" value="<?=$_SERVER['REQUEST_URI']?>">
		<input type="hidden" name="workType" value="">
		<input type="hidden" name="admin_idx" value="">
		<input type="hidden" name="page" value="<?=$page?>">
		<table class="list_table mt15">
			<colgroup>
				<col width="5%">
				<col width="15%">
				<col width="15%">
				<col width="15%">
				<col width="">
				<col width="15%">
				<col width="10%">
			</colgroup>
			<thead>
			<tr>
				<th>No</th>
				<th>ID</th>
				<th>관리자명</th>
				<th>등급</th>
				<th>이메일</th>
				<th>휴대폰</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<?
			$sql = " select * from ".$site_prefix."admin where 1=1 order by admin_idx desc ";
			$result = sql_query($sql);
			$acnt = @mysql_num_rows($result);
			for($i=0;$row = sql_fetch_array($result);$i++){
				switch($row["admin_level"]){
					case "99":
						$admin_level = "최고관리자";
						break;
					case "80":
						$admin_level = "봉사자관리자";
						break;
					case "70":
						$admin_level = "게시판관리자";
						break;
				}
			?>
			<tr>
				<td><?=$acnt--;?></td>
				<td><?=$row["admin_id"]?></td>
				<td><?=$row["admin_name"]?></td>
				<td><?=$admin_level?></td>
				<td><?=$row["admin_email"]?></td>
				<td><?=$row["admin_hp"]?></td>
				<td>
					<? if($admin["admin_level"] >= $row["admin_level"]){ ?>
					<div class="floatL pt5" style="width:100%;"><button type="button" class="mbtn_a_b" onclick="admin_modify('AM','<?=$row["admin_idx"]?>');">수 정</button></div>
					<div class="floatL pt5 pb5" style="width:100%;"><button type="button" class="mbtn_a_a" onclick="admin_modify('AD','<?=$row["admin_idx"]?>');">삭 제</button></div>
					<? } ?>
				</td>
			</tr>
			<? } ?>
			</tbody>
		</table>
		</form>
		<div class="mt5 mr10 btn_group"><button type="button" class="btn_a_b" onclick="admin_modify('AI','');">등 록</button></div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script>
function admin_modify(str,idx){
	var f = document.admin_list;
	if(str == "AM" || str == "AI") f.action = "/board/admn/setup/modify_write.php";
	if(str == "AD"){
		if(!confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 삭제하시겠습니까?")) return;
	}
	f.workType.value = str;
	f.admin_idx.value = idx;
	f.submit();
}

function search_start(){
	document.search_form.submit();
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>