<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t104 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";
$mode = $site_prefix."popup";
$searchVal = "page=".$page;

$workType = "I";

$sdate = date("Y-m-d",time());
$edate = date("Y-m-d",time());

$file_script = "";
$file_length = -1;

if($idx){
	$sql = " select * from ".$mode." where Idx = '".$idx."' ";
	$row = sql_fetch($sql);

	$sdate = date("Y-m-d",strtotime($row["start_date"]));
	$edate = date("Y-m-d",strtotime($row["end_date"]));
	$stime = date("H:i:s",strtotime($row["start_date"]));
	$etime = date("H:i:s",strtotime($row["end_date"]));

	$row["files"] = get_file($mode,$idx);
	for ($i=0; $i<$row["files"]["count"]; $i++){
		$frow = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$idx' and file_no = '$i' ");
		if ($frow[file_source])
		{
			$file_script .= "add_file(\"<input type='checkbox' name='bf_file_del[$i]' value='1'><a href='{$row[files][$i][href]}'>{$row[files][$i][file_name]}</a> 파일 삭제";
			if ($is_file_content)
				//$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='{$row[bf_content]}' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
				// 첨부파일설명에서 ' 또는 " 입력되면 오류나는 부분 수정
				$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
			$file_script .= "\");\n";
		}
		else
			$file_script .= "add_file('');\n";
	}
	$file_length = $row["files"][count] - 1;

	if($_POST["workType"] == "C"){
		$workType = "I";
		unset($row["files"]);
		$file_script = "";
		$file_length = -1;
	} else {
		$workType = "M";
	}
}

if ($file_length < 0){
	$file_script .= "add_file('');\n";
	$file_length = 0;
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">팝업관리</div>
		<form name="popup_form" method="post" action="/board/admn/_proc/setup/_popup_proc.php" enctype="MULTIPART/FORM-DATA">
		<input type="hidden" name="URI" value="/board/admn/setup/popup.php?page=<?=$page?>">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="idx" value="<?=$row["Idx"]?>">
		<input type="hidden" name="page" value="<?=$page?>">
		<input type="hidden" name="uid" value="<?=$admin["admin_id"]?>">
		<input type="hidden" name="uname" value="<?=$admin["admin_name"]?>">
		<table class="write_table mt15">
			<colgroup>
				<col width="15%">
				<col width="85%">
			</colgroup>
			<tbody>
			<tr>
				<th>제목 </th>
				<td><input type="text" class="input wd320 exp" name="Title" value="<?=$row["Title"]?>" title="제목" ></td>
			</tr>
			<tr>
				<th>링크주소 </th>
				<td>
					<input type="text" class="input" name="linkURL" value="<?=$row["linkURL"]?>" style="width:80%" >
					<select name="tar" align="absmiddle">
						<option value='_self'>현재창</option>
						<option value='_blank' <?=$row["tar"]=="_blank"?"selected":""?>>새창</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>이미지</th>
				<td>
					<table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
					<script type="text/javascript">
					var flen = 0;
					function add_file(delete_code)
					{
						var upload_count = <?=(int)$BoardDateRow[FileCnt]?>;
						if (upload_count && flen >= upload_count)
						{
							alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
							return;
						}

						var objTbl;
						var objRow;
						var objCell;
						if (document.getElementById)
							objTbl = document.getElementById("variableFiles");
						else
							objTbl = document.all["variableFiles"];

						objRow = objTbl.insertRow(objTbl.rows.length);
						objCell = objRow.insertCell(0);
						objCell.className = "bd0";

						objCell.innerHTML = "<input type='file' class='input' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
						if (delete_code)
							objCell.innerHTML += delete_code;
						else
						{
							<? if ($is_file_content) { ?>
							objCell.innerHTML += "<br><input type='text' class='input' size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
							<? } ?>
							;
						}

						flen++;
					}

					<?=$file_script; //수정시에 필요한 스크립트?>

					function del_file()
					{
						// file_length 이하로는 필드가 삭제되지 않아야 합니다.
						var file_length = <?=(int)$file_length?>;
						var objTbl = document.getElementById("variableFiles");
						if (objTbl.rows.length - 1 > file_length)
						{
							objTbl.deleteRow(objTbl.rows.length - 1);
							flen--;
						}
					}
					</script>
				</td>
			</tr>
			<tr>
				<th>팝업기간 </th>
				<td>
					<input type="text" class="input wd100 datepick exp" name="start_date" value="<?=$sdate?>" title="시작일" readonly >&nbsp;
					<select name="start_time" class="input" id="stime">
						<option value=''>선택</option>
						<option value='00:00:00'>00시</option>
						<option value='01:00:00'>01시</option>
						<option value='02:00:00'>02시</option>
						<option value='03:00:00'>03시</option>
						<option value='04:00:00'>04시</option>
						<option value='05:00:00'>05시</option>
						<option value='06:00:00'>06시</option>
						<option value='07:00:00'>07시</option>
						<option value='08:00:00'>08시</option>
						<option value='09:00:00'>09시</option>
						<option value='10:00:00'>10시</option>
						<option value='11:00:00'>11시</option>
						<option value='12:00:00'>12시</option>
						<option value='13:00:00'>13시</option>
						<option value='14:00:00'>14시</option>
						<option value='15:00:00'>15시</option>
						<option value='16:00:00'>16시</option>
						<option value='17:00:00'>17시</option>
						<option value='18:00:00'>18시</option>
						<option value='19:00:00'>19시</option>
						<option value='20:00:00'>20시</option>
						<option value='21:00:00'>21시</option>
						<option value='22:00:00'>22시</option>
						<option value='23:00:00'>23시</option>
						<option value='24:00:00'>24시</option>
					</select>&nbsp;
					~&nbsp;<input type="text" class="input wd100 datepick exp" name="end_date" value="<?=$edate?>" title="종료일" readonly >&nbsp;
					<select name="end_time" class="input" id="etime">
						<option value=''>선택</option>
						<option value='00:00:00'>00시</option>
						<option value='01:00:00'>01시</option>
						<option value='02:00:00'>02시</option>
						<option value='03:00:00'>03시</option>
						<option value='04:00:00'>04시</option>
						<option value='05:00:00'>05시</option>
						<option value='06:00:00'>06시</option>
						<option value='07:00:00'>07시</option>
						<option value='08:00:00'>08시</option>
						<option value='09:00:00'>09시</option>
						<option value='10:00:00'>10시</option>
						<option value='11:00:00'>11시</option>
						<option value='12:00:00'>12시</option>
						<option value='13:00:00'>13시</option>
						<option value='14:00:00'>14시</option>
						<option value='15:00:00'>15시</option>
						<option value='16:00:00'>16시</option>
						<option value='17:00:00'>17시</option>
						<option value='18:00:00'>18시</option>
						<option value='19:00:00'>19시</option>
						<option value='20:00:00'>20시</option>
						<option value='21:00:00'>21시</option>
						<option value='22:00:00'>22시</option>
						<option value='23:00:00'>23시</option>
						<option value='24:00:00'>24시</option>
					</select>&nbsp;
				</td>
			</tr>
			<!--tr>
				<th>팝업위치 </th>
				<td>
					상단 <input type="text" class="input wd50" name="ptop" value="<?=number_format($row["ptop"])?>" exp num title="상단">픽셀&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;좌측 <input type="text" class="input wd50" name="pleft" value="<?=number_format($row["pleft"])?>" exp num title="좌측"> 픽셀
				</td>
			</tr-->
			<tr>
				<th>사용여부</th>
				<td>
					<select name="use_ck">
						<option value='N'>사용안함</option>
						<option value='Y' <?=$row["use_ck"]=="Y"?"selected":""?>>사용함</option>
					</select>
				</td>
			</tr>
			</tbody>
		</table>
		</form>

		<div class="mt5 btn_group">
			<button type="button" class="btn_a_n" onclick="board_check();"><?=$workType=="I"?"등 록":"수 정"?></button>&nbsp;
			<button type="button" class="btn_a_b" onclick="location.href='/board/admn/setup/popup.php?<?=$searchVal?>';">취 소</button>
		</div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
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

function board_check(){
	var f = document.popup_form;

	if(FormCheck("popup_form") == true){
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
	$("#stime").val('<?=$stime?>');
	$("#etime").val('<?=$etime?>');
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>