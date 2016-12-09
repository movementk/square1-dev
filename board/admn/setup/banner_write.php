<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t105 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";
$mode = $site_prefix."banner";
$searchVal = "page=".$page;

$workType = "I";

$searchVal = "bloc=".urlencode($bloc)."&sfl=".$sfl."&stx=".$stx."&page=".$page;

if($idx){
	$workType = "M";
	$sql = " select * from ".$mode." where idx = '".$idx."' ";
	$row = sql_fetch($sql);

	$row["files"] = get_file($mode,$idx);
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">배너관리</div>
		<form name="banner_form" method="post" action="/board/admn/_proc/setup/_banner_proc.php" enctype="MULTIPART/FORM-DATA">
		<input type="hidden" name="URI" value="/board/admn/setup/banner.php?page=<?=$page?>&bloc=">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="idx" value="<?=$row["idx"]?>">
		<input type="hidden" name="page" value="<?=$page?>">
		<table class="write_table mt15">
			<colgroup>
				<col width="15%">
				<col width="85%">
			</colgroup>	
			<tr>
				<th>배너위치 </th>
				<td>
					<select name="bloc" id="bloc" onchange="bloc_ck(this.value);">
						<option value='M1'>메인-배너1</option>
						<option value='M2'>메인-배너2</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>노출순서 </th>
				<td><input type="text" class="input wd100" name="border" value="<?=$row["border"]?>" exp num title="노출순서" ></td>
			</tr>
			<tr>
				<th>링크주소 </th>
				<td>
					<input type="text" class="input" name="blink" value="<?=$row["blink"]?>" style="width:80%" >
					<select name="btarget" align="absmiddle">
						<option value='_self'>현재창</option>
						<option value='_blank' <?=$row["btarget"]=="_blank"?"selected":""?>>새창</option>
					</select>
				</td>
			</tr>
			<? for($i=0;$i<3;$i++){ ?>
			<tr>
				<th>이미지<?=$i+1?></th>
				<td>
					<input type="file" class="input" name="bf_file[]" style="width:40%" >
					<? if($row["files"][$i]["file_source"]){ ?>
					<input type='checkbox' name='bf_file_del[<?=$i?>]' value='1'><a href='<?=$row["files"][$i]["href"]?>'><?=$row["files"][$i]["file_name"]?></a> 파일 삭제
					<? } ?>
				</td>
			</tr>
			<? } ?>
			<tr class="M bsize">
				<td colspan="2"><span style="color:#e00000;font-weight:bold;">※ 이미지사이즈는 (너비 3000 이하, 높이 598) 입니다.</span></td>
			</tr>
			<tr class="M1 bsize">
				<td colspan="2"><span style="color:#e00000;font-weight:bold;">※ 이미지1 사이즈는 (너비 600, 높이 600), 이미지2 사이즈는 (너비 724, 높이 724), 이미지3 사이즈는 (너비 300, 높이 300) 입니다.</span></td>
			</tr>
			<tr class="M2 bsize">
				<td colspan="2"><span style="color:#e00000;font-weight:bold;">※ 이미지1 사이즈는 (너비 600, 높이 300), 이미지2 사이즈는 (너비 724, 높이 386), 이미지3 사이즈는 (너비 300, 높이 149) 입니다.</span></td>
			</tr>
			<tr>
				<th>사용여부</th>
				<td>
					<select name="bstatus">
						<option value='N'>사용안함</option>
						<option value='Y' <?=$row["bstatus"]=="Y"?"selected":""?>>사용함</option>
					</select>
				</td>
			</tr>
		</table>
		</form>

		<div class="mt5 btn_group">
			<button type="button" class="btn_a_n" onclick="board_check();"><?=$workType=="I"?"등 록":"수 정"?></button>&nbsp;
			<button type="button" class="btn_a_b" onclick="location.href='/board/admn/setup/banner.php?<?=$searchVal?>';">취 소</button>
		</div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script language="javascript">
$(".bsize").hide();
function bloc_ck(val){
	$(".bsize").hide();
	$("."+val).show();
}

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

function board_check(){
	var f = document.banner_form;

	if(FormCheck("banner_form") == true){
		f.submit();
	} else {
		return;
	}
}

function nextFocus(sFormName,sNow,sNext){
	var sForm = 'document.'+ sFormName +'.'
	var oNow = eval(sForm + sNow);

	if (typeof oNow == 'object')
	{
		if ( oNow.value.length == oNow.maxLength)
		{
			var oNext = eval(sForm + sNext);

			if ((typeof oNext) == 'object')
				oNext.focus();
		}
	}
}

window.onload = function(){
	bloc_ck($("#bloc").val());
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>