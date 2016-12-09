<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t200 = "top_mon";
$t201 = "navi_mon";
$left = "l2";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$workType = "BC";
if(!empty($Idx)){
	$blist = get_board_setting($Idx);
	$brow = $blist[0];
	if(sizeof($brow["Idx"])) $workType = "BM";
}
if(!$is_mk){
	$blist = get_board_setting("");
	move_to("/board/admn/board/board.php?bidx=".$blist[0]["Idx"]);
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">게시판 설정</div>
		<form name="board_form" action="/board/admn/_proc/board/_board_proc.php" method="post">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="URI" value="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="Idx" value="<?=$Idx?>">
		<table class="write_table mt15">
			<tr>
				<th width="100">게시판코드</th>
				<td width="290"><input type="text" class="input exp" name="BoardName" style="width:150px" title="게시판코드" value="<?=$brow["BoardName"]?>">&nbsp;사용여부 <input type="checkbox" name="Flag" value="1" <?=$brow["Flag"]?"checked":""?>></td>
				<th width="100">게시판이름</th>
				<td width="290"><input type="text" class="input exp" name="BoardTitle" style="width:250px" title="게시판이름" value="<?=$brow["BoardTitle"]?>"></td>
			</tr>
			<tr>
				<th>읽기권한</th>
				<td>
					<select name="ViewAuthority">
						<option value=''>사용안함</option>
						<?=get_auth_list($brow["ViewAuthority"])?>
					</select>
				</td>
				<th>쓰기권한</th>
				<td>
					<select name="WriteAuthority">
						<option value=''>사용안함</option>
						<?=get_auth_list($brow["WriteAuthority"])?>
					</select>
				</td>
			</tr>
			<tr>
				<th>답글권한</th>
				<td>
					<select name="RepleAuthority">
						<option value=''>사용안함</option>
						<?=get_auth_list($brow["RepleAuthority"])?>
					</select>
					&nbsp;사용여부 <input type="checkbox" name="RepleFlag" value="1" <?=$brow["RepleFlag"]?"checked":""?>>
				</td>
				<th>덧글권한</th>
				<td>
					<select name="CommentAuthority">
						<option value=''>사용안함</option>
						<?=get_auth_list($brow["CommentAuthority"])?>
					</select>
					&nbsp;사용여부 <input type="checkbox" name="CommentFlag" value="1" <?=$brow["CommentFlag"]?"checked":""?>>
				</td>
			</tr>
			<tr>
				<th>첨부파일개수</th>
				<td><input type="text" class="input" name="FileCnt" style="width:50px" title="첨부파일개수" value="<?=$brow["FileCnt"]?$brow["FileCnt"]:"1"?>"></td>
				<th>카테고리</th>
				<td><input type="text" class="input" name="Category" style="width:250px" title="카테고리" value="<?=$brow["Category"]?>"></td>
			</tr>
			<tr>
				<th>에디터게시판</th>
				<td><input type="checkbox" name="HtmlFlag" value="1" <?=$brow["HtmlFlag"]?"checked":""?>></td>
				<th>비밀글</th>
				<td><input type="checkbox" name="Secret" value="1" <?=$brow["Secret"]?"checked":""?>></td>
			</tr>
			<tr>
				<th>관리자메인 노출</th>
				<td colspan="3"><input type="checkbox" name="LinkFlag" value="1" <?=$brow["LinkFlag"]?"checked":""?>></td>
			</tr>
		</table>
		<div class="mt5 mb40 center"><button type="button" class="btn_a_b" onclick="board_ck();"><?=$workType=="BC"?"등 록":"수 정"?></button></div>
		</form>
		<table class="list_table mt15">
			<colgroup>
				<col width="3%">
				<col width="12%">
				<col width="15%">
				<col width="8%">
				<col width="8%">
				<col width="8%">
				<col width="8%">
				<col width="8%">
				<col width="25%">
				<col width="5%">
			</colgroup>
			<thead>
			<tr>
				<th>No</th>
				<th>게시판코드</th>
				<th>게시판명</th>
				<th>읽기권한</th>
				<th>쓰기권한</th>
				<th>답글권한</th>
				<th>덧글권한</th>
				<th>내용</th>
				<th>카테고리</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<?
			$blist = get_board_setting("");
			$num = sizeof($blist);
			for($i=0;$i<sizeof($blist);$i++){
				$va = "";
				$wa = "";
				$ra = "";
				$ca = "";
				$ed = "";
				for($j=0;$j<sizeof($auth_array_tit);$j++){
					if($blist[$i]["ViewAuthority"] == $auth_array_val[$j]) $va = $auth_array_tit[$j];
					if($blist[$i]["WriteAuthority"] == $auth_array_val[$j]) $wa = $auth_array_tit[$j];
					if($blist[$i]["RepleAuthority"] == $auth_array_val[$j]) $ra = $auth_array_tit[$j];
					if($blist[$i]["CommentAuthority"] == $auth_array_val[$j]) $ca = $auth_array_tit[$j];
					if($blist[$i]["HtmlFlag"]) $ed = $auth_array_tit[$j];
				}

				if(empty($va)) $va = "사용안함";
				if(empty($wa)) $wa = "사용안함";
				if(empty($ra)) $ra = "사용안함";
				if(empty($ca)) $ca = "사용안함";
				if(empty($ed)) $ed = "일반"; else $ed = "에디터";
			?>
			<tr>
				<td><?=$num?></td>
				<td><?=$blist[$i]["BoardName"]?></td>
				<td><?=$blist[$i]["BoardTitle"]?></td>
				<td><?=$va?></td>
				<td><?=$wa?></td>
				<td><?=$ra?></td>
				<td><?=$ca?></td>
				<td><?=$ed?></td>
				<td><?=cut_string($blist[$i]["Category"],30)?></td>
				<td>
					<div class="floatL pt5" style="width:100%;"><button type="button" class="mbtn_a_n" onclick="board_modify('<?=$blist[$i]["Idx"]?>');">수 정</button></div>
					<div class="floatL pt5 pb5" style="width:100%;"><button type="button" class="mbtn_a_b" onclick="board_del('<?=$blist[$i]["Idx"]?>');">삭 제</button></div>
				</td>
			</tr>
			<?
				$num--;
			}
			?>
			</tbody>
		</table>
		<div class="cboth"></div>
	</div>
	<div class="mt100">&nbsp;</div>
</div>
<script language="javascript">
function FormCheck(f){
	var expCk = true;
	$("form[name='"+f+"']").find(".exp").each(function(){
		if(expCk){
			if($.trim($(this).val()) == ""){
				alert($(this).attr("title")+"은(는) 필수입력입니다.");
				expCk = false;
			}
		}
	});

	if(expCk){
		return true;
	} else {
		return false;
	}
}

function board_ck(){
	var f = document.board_form;
	if(FormCheck(f) == true){
		f.submit();
	} else {
		return;
	}
}
function board_modify(idx){
	location.href = "<?=$_SERVER['PHP_SELF']?>?Idx="+idx;
}
function board_del(idx){
	if(!confirm("게시판을 삭제하시겠습니까?")) return;
	var f = document.board_form;
	f.workType.value = "BD";
	f.Idx.value = idx;
	f.submit();
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>