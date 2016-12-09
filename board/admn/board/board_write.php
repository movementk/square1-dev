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

$BoardName = $board_setting["BoardName"];
$mode = $site_prefix."board_".$BoardName;
$is_html = $board_setting["HtmlFlag"];
$workType = "I";

$file_script = "";
$file_length = -1;

if($idx != ""){
	$workType = "M";
	$sql = "select * from ".$mode." where BoardIdx=".$idx;
	$write = sql_fetch($sql);
	$write["files"] = get_file($mode, $idx);

	if($BoardName == "product"){
		$bd3_array = explode(",",$write["bd3"]);
	}

	for ($i=0; $i<$write["files"]["count"]; $i++)
	{
		$row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$idx' and file_no = '$i' ");
		if ($row[file_source])
		{
			$file_script .= "add_file(\"<input type='checkbox' name='bf_file_del[$i]' value='1'><a href='{$write[files][$i][href]}'>{$write[files][$i][file_name]}</a> 파일 삭제";
			if ($is_file_content)
				//$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='{$row[bf_content]}' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
				// 첨부파일설명에서 ' 또는 " 입력되면 오류나는 부분 수정
				$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
			$file_script .= "\");\n";
		}
		else
			$file_script .= "add_file('');\n";
	}
	$file_length = $write["files"][count] - 1;

	if($mob == "reply"){
		if(!$board_setting["HtmlFlag"]) $br = "\n";
		else $br = "<br>";
		$write['Content'] = "==================================== [원 문] ====================================".$br.$br.$write['Content'].$br.$br.$br.$br."==================================== [답 변] ====================================".$br.$br;
		$write["Title"] = "[답변] ".$write["Title"];
		$file_script = "add_file('');\n";
		$file_length = 0;
		$WriterName = $member["UserName"];
		$write["UserID"] = $member["UserID"];
		$workType = "I";
	}
} else {
	$write["RegDate"] = date("Y-m-d H:i:s",time());
}

if ($file_length < 0){
	$file_script .= "add_file('');\n";
	$file_length = 0;
}

$searchVal = "Category=".urlencode($Category)."&sfl=".$sfl."&stx=".$stx."&page=".$page."&bidx=".$bidx;

$Category = explode("|",$board_setting["Category"]);
$Category_select = "<select name='Category'>";
$Category_select .= "<option value=''>선택</option>";
for($l=0;$l<count($Category);$l++){
	$Categorys[$l] = $Category[$l];
	if($Category[$l]==$write['Category']) {
		$Category_select .= "<option value='".$Category[$l]."'  selected> ".trim($Categorys[$l])."</option>";
	}else{
		$Category_select .= "<option value='".$Category[$l]."'> ".trim($Categorys[$l])."</option>";
	}
}
$Category_select .= "</select>";

$contit = "내용";

if($BoardName == "broadcast" || $BoardName == "moviecenter"){
	$img_size_info = "이미지사이즈는 : 240 x 160 입니다.";
} else if($BoardName == "news" || $BoardName == "press" || $BoardName == "volstory"){
	$img_size_info = "상위노출시 이미지사이즈는 : 290 x 230 입니다. 상위노출을 사용하지 않는경우엔 첫번째 파일을 비워두고 사용하시기 바랍니다.";
} else if($BoardName == "floor"){
	$img_size_info = "첫번째 이미지는 1170 x 1308, 두번째 이미지는 725 x 970, 세번째 이미지는 300 x 679 입니다.";
} else if($BoardName == "brand" || $BoardName == "square1" || $BoardName == "hall"){
	$img_size_info = "이미지사이즈는 : 370 x 247 입니다.";
}

$use_notice = false;

switch($BoardName){
	case "webzine":
	case "broadcast":
	case "news":
	case "story":
	case "qna":
	case "faq":
	case "press":
	case "volstory":
		$use_notice = false;
		break;
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title"><?=$board_setting["BoardTitle"]?></div>
		<form name="write_form" method="post" enctype="MULTIPART/FORM-DATA" action="/board/admn/_proc/board/_board_proc.php">
		<input type="hidden" name="mob" value="<?=$mob?>">
		<? if($mob=="reply"){?>
		<input type="hidden" name="idx" value="">
		<input type="hidden" name="ppw" value="<?=$write["UserPw"]?>">
		<? }else{?>
		<input type="hidden" name="idx" value="<?=$write["BoardIdx"]?>">
		<? }?>
		<input type="hidden" name="Ref" value="<?=$_REQUEST["Ref"]?>">
		<input type="hidden" name="ReStep" value="<?=$_REQUEST["ReStep"]?>">
		<input type="hidden" name="ReLevel" value="<?=$_REQUEST["ReLevel"]?>">
		<input type="hidden" name="URI" value="/board/admn/board/board_view.php?<?=$searchVal?>&idx=">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="bidx" value="<?=$bidx?>">
		<input type="hidden" name="HtmlChk" value="<?=$is_html?"Y":"N"?>">
		<table class="write_table mt15">
			<colgroup>
				<col width="15%">
				<col width="85%">
			</colgroup>
			<? if($BoardName == "news" || $BoardName == "press" || $BoardName == "volstory"){ ?>
			<tr>
				<th>게시판 상위노출 </th>
				<td><input type="checkbox" name="bd1" value="Y" <?=$write["bd1"]=="Y"?"checked":""?>><span style="color:#e00000;font-weight:bold;">※ 체크된 게시물중 노출순서가 낮은순으로 3개까지 노출됩니다.</span></td>
			</tr>
			<tr>
				<th>상위노출순서</th>
				<td><input type="text" class="input" style="width:50px;" name="border" value="<?=$write["border"]?>" ></td>
			</tr>
			<? } ?>
			<? if(($write["UserID"] && ($write["UserID"] != $member["ID"])) || (empty($write["UserID"]) && !empty($write["BoardIdx"]))) { ?>
			<tr>
				<th>작성자 </th>
				<td>
					<input type="hidden" name="UserID" value="<?=$write["UserID"]?>">
					<input type="hidden" name="UserEmail" value="<?=$write["UserEmail"]?>">
					<input type="hidden" name="UserIP" value="<?=$write["UserIP"]?>">
					<input type="text" class="input wd120" name="UserName" value="<?=$write["UserName"]?>">
				</td>
			</tr>
			<? 
			}
			if($board_setting["Secret"]){
			?>
			<tr>
				<th>비밀글</th>
				<td><input type="checkbox" name='Secret' value='1' <?=$write["Secret"]?"checked":""?> /></td>
			</tr>
			<? } ?>
			<tr>
				<th>제목 <?=$BoardName=="store"?"(상점명)":""?> <?=$BoardName=="floor"?"(층이름)":""?></th>
				<td>
					<input type="text" class="input wd320 exp" name="Title" value="<?=$write["Title"]?>" title="제목" >
					<? if($use_notice){ ?>
					<input type="checkbox" name="Notice" value="1" <? if($write["Notice"]==1){echo "checked";}?>> : 공지
					<? } ?>
				</td>
			</tr>
			<?
			if($BoardName == "store"){
				/*
				bd1 = 상점 영문상세
				bd2 = 고유코드
				bd3 = 상점 국가
				bd4 = 상점 위치(층수)
				bd5 = 상점 영문이름
				bd6 = 상점 전화번호
				bd7 = 상점 영업시간
				*/
			?>
			<tr>
				<th>상점명 (영문) </th>
				<td colspan="5">
					<input type="text" class="input wd120" name="bd5" value="<?=$write["bd5"]?>" title="상점명 (영문)" >
				</td>
			</tr>
			<? } ?>
			<? if($board_setting["Category"]){?>
			<tr>
				<th>분류 </th>
				<td><?=$Category_select?></td>
			</tr>
			<? } ?>
			<?
			if($BoardName == "store"){
				/*
				bd1 = 상점 영문상세
				bd2 = 고유코드
				bd3 = 상점 국가
				bd4 = 상점 위치(층수)
				bd5 = 상점 영문이름
				bd6 = 상점 전화번호
				bd7 = 상점 영업시간
				*/
			?>
			<tr>
				<th>상점 국가 </th>
				<td colspan="5">
					<select name="bd3" class="input">
						<option value="">선택</option>
						<option value="한국" <?=$write["bd3"]=="한국"?"selected":""?>>한국</option>
						<option value="중국" <?=$write["bd3"]=="중국"?"selected":""?>>중국</option>
						<option value="이탈리아" <?=$write["bd3"]=="이탈리아"?"selected":""?>>이탈리아</option>
						<option value="일본" <?=$write["bd3"]=="일본"?"selected":""?>>일본</option>
						<option value="미국" <?=$write["bd3"]=="미국"?"selected":""?>>미국</option>
						<option value="태국" <?=$write["bd3"]=="태국"?"selected":""?>>태국</option>
						<option value="호주" <?=$write["bd3"]=="호주"?"selected":""?>>호주</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>상점 위치(층수) </th>
				<td colspan="5">
					<select name="bd4" class="input">
						<option value="">선택</option>
						<option value="0" <?=$write["bd4"]=="0"?"selected":""?>>지하1층</option>
						<option value="1" <?=$write["bd4"]=="1"?"selected":""?>>1층</option>
						<option value="2" <?=$write["bd4"]=="2"?"selected":""?>>2층</option>
						<option value="3" <?=$write["bd4"]=="3"?"selected":""?>>3층</option>
						<option value="4" <?=$write["bd4"]=="4"?"selected":""?>>4층</option>
						<option value="5" <?=$write["bd4"]=="5"?"selected":""?>>5층</option>
						<option value="6" <?=$write["bd4"]=="6"?"selected":""?>>6층</option>
						<option value="7" <?=$write["bd4"]=="7"?"selected":""?>>7층</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>상점 전화번호</th>
				<td><input type="text" class="input" style="width:150px;" title="상점 전화번호" name="bd6" value="<?=$write["bd6"]?>" ></td>
			</tr>
			<tr>
				<th>상점 영업시간</th>
				<td><input type="text" class="input" style="width:150px;" title="상점 영업시간" name="bd7" value="<?=$write["bd7"]?>" ></td>
			</tr>
			<? } ?>
			<? if($BoardName == "faq"){ ?>
			<tr>
				<th>노출순서</th>
				<td><input type="text" class="input num" style="width:50px;" name="border" value="<?=$write["border"]?>" ></td>
			</tr>
			<? } ?>
			<? if($BoardName == "brand" || $BoardName == "square1" || $BoardName == "hall"){ ?>
			<!--tr>
				<th>노출순서</th>
				<td><input type="text" class="input num" style="width:50px;" name="border" value="<?=$write["border"]?>" ><span style="color:#e00000;font-weight:bold;">※ 노출순서가 클 수록 먼저 나타나게 됩니다.</span></td>
			</tr-->
			<tr>
				<th>이벤트기간</th>
				<td><input type="text" class="input datepick" style="width:100px;" name="bd1" readonly value="<?=$write["bd1"]?>" > ~ <input type="text" class="input datepick" style="width:100px;" name="bd2" readonly value="<?=$write["bd2"]?>" ></td>
			</tr>
			<? if($BoardName == "square1"){ ?>
			<tr>
				<th>응모 사용</th>
				<td><input type="radio" name="bd3" <?=$write["bd3"]==""||$write["bd3"]=="Y"?"checked":""?> value="Y" /> 사용&nbsp;&nbsp;<input type="radio" name="bd3" <?=$write["bd3"]=="N"?"checked":""?> value="N" /> 사용안함</td>
			</tr>
			<tr>
				<th>응모기간</th>
				<td><input type="text" class="input datepick" style="width:100px;" name="bd4" readonly value="<?=$write["bd4"]?>" > ~ <input type="text" class="input datepick" style="width:100px;" name="bd5" readonly value="<?=$write["bd5"]?>" ></td>
			</tr>
			<? } ?>
			<? } ?>
			<? if($BoardName == "prizewinner"){ ?>
			<tr>
				<th>해당 이벤트</th>
				<td>
					<select class="input exp" name="eidx" title="이벤트">
						<option value="">선택</option>
						<?
						$esql = " select * from ".$site_prefix."board_square1 where 1=1 order by BoardIdx desc ";
						$eresult = sql_query($esql);
						for($i=0;$erow = sql_fetch_array($eresult);$i++){
							if($erow["BoardIdx"] == $write['bd1']) $esel = " selected";
							else $esel = "";
							echo "<option value='".$erow["BoardIdx"]."' ".$esel.">".$erow["Title"]."</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<? } ?>
			<?
			if($BoardName == "lost"){
				if($workType == "I"){
					$write["bd10"] = "S".date("Ymdhis",time());
				}
			?>
			<tr>
				<th>관리번호</th>
				<td><input type="text" class="input exp" style="width:150px;" readonly title="관리번호" name="bd10" value="<?=$write["bd10"]?>" ><span style="color:#e00000;font-weight:bold;">※ 관리번호는 자동으로 입력됩니다.</span></td>
			</tr>
			<tr>
				<th>습득물 명</th>
				<td><input type="text" class="input exp" style="width:150px;" title="습득물 명" name="bd1" value="<?=$write["bd1"]?>" ></td>
			</tr>
			<tr>
				<th>습득 장소</th>
				<td><input type="text" class="input exp" style="width:150px;" title="습득 장소" name="bd2" value="<?=$write["bd2"]?>" ></td>
			</tr>
			<tr>
				<th>습득일</th>
				<td><input type="text" class="input exp datepick" readonly style="width:80px;" title="습득일" name="bd3" value="<?=$write["bd3"]?>" ></td>
			</tr>
			<? } ?>
			<?
			if($BoardName == "request"){
			?>
			<tr>
				<th>단체(개인)명</th>
				<td><input type="text" class="input exp" style="width:150px;" title="단체(개인)명" name="bd1" value="<?=$write["bd1"]?>" ></td>
			</tr>
			<tr>
				<th>연락처</th>
				<td><input type="text" class="input" style="width:150px;" title="연락처" name="bd2" value="<?=$write["bd2"]?>" ></td>
			</tr>
			<tr>
				<th>휴대폰번호</th>
				<td><input type="text" class="input" style="width:150px;" title="휴대폰번호" name="bd3" value="<?=$write["bd3"]?>" ></td>
			</tr>
			<tr>
				<th>대관일정</th>
				<td><input type="text" class="input datepick" readonly style="width:80px;" title="대관일정" name="bd4" value="<?=$write["bd4"]?>" > ~ <input type="text" class="input datepick" readonly style="width:80px;" title="대관일정" name="bd5" value="<?=$write["bd5"]?>" ></td>
			</tr>
			<tr>
				<th>공연자인원</th>
				<td><input type="text" class="input" style="width:100px;" title="인원" name="bd6" value="<?=$write["bd6"]?>" > </td>
			</tr>
			<tr>
				<th>진행인원</th>
				<td><input type="text" class="input" style="width:100px;" title="인원" name="bd7" value="<?=$write["bd7"]?>" > </td>
			</tr>
			<? } ?>
			<tr>
				<th>작성일 </th>
				<td><input type="text" class="input wd140" name="RegDate" value="<?=$write["RegDate"]?>" ></td>
			</tr>
			<tr <?=$BoardName=="floor"?"style='display:none;'":""?>>
				<th>내용 </th>
				<td colspan="5">
					<textarea name="Content" id="Content" class='txtarea02'><?=$write['Content']?></textarea>
				</td>
			</tr>
			<? if($BoardName == "qna"){ ?>
			<tr>
				<th>답변 </th>
				<td colspan="5">
					<textarea name="bd1" id="bd1" class='txtarea02'><?=$write['bd1']?></textarea>
				</td>
			</tr>
			<? } ?>
			<?
			if($BoardName == "store"){
				/*
				bd1 = 상점 영문상세
				bd2 = 고유코드
				bd3 = 상점 국가
				bd4 = 상점 위치(층수)
				bd5 = 상점 영문이름
				bd6 = 상점 전화번호
				bd7 = 상점 영업시간
				*/
			?>
			<tr>
				<th>상점 영문상세 </th>
				<td colspan="5">
					<textarea name="bd1" id="bd1" class='txtarea02'><?=$write['bd1']?></textarea>
				</td>
			</tr>
			<? } ?>
			<? if(!empty($img_size_info)){ ?>
			<tr>
				<td colspan='2'><span style="color:#e00000;font-weight:bold;">※ <?=$img_size_info?></span></td>
			</tr>
			<? } ?>
			<tr>
				<th>첨부파일 <span onclick="add_file();" style="cursor:pointer;"><img src="/board/admn/images/btn/btn_file_add.gif"></span> <span onclick="del_file();" style="cursor:pointer;"><img src="/board/admn/images/btn/btn_file_minus.gif"></span></th>
				<td>
					<table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
					<script type="text/javascript">
					var flen = 0;
					function add_file(delete_code)
					{
						var upload_count = <?=(int)$board_setting[FileCnt]?>;
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
		</table>
		</form>

		<div class="mt5 btn_group">
			<button type="button" class="btn_a_n" onclick="board_check();"><?=$workType=="I"?"쓰 기":"수 정"?></button>
			<button type="button" class="btn_a_b" onclick="location.href='/board/admn/board/board.php?<?=$searchVal?>';">목 록</button>
		</div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<div id="campaign_div" style="position:absolute;top:100px;left:50%;margin-left:-350px;width:700px;z-index:999999999999;display:none;background:#fff;">
	<img src="/board/admn/images/campaigntop.jpg" width="700"><Br>
	<p style="width:100%;margin-top:15px;font-weight:bold;color:red;">※ 1번과 3번은 이미지 사이즈 222 x 360, 2번은 이미지 사이즈 472 x 200 입니다.</p>
	<p style="width:100%;margin-top:5px;font-weight:bold;color:red;">※ 상단 고정시 이미지 사이즈를 정확히 맞춰주셔야 이미지가 정상적으로 출력됩니다.</p>
	<p style="width:100%;text-align:right;font-weight:bold;"><a href="javascript:fix_ck('close');">[확인]</a></p>
</div>
<script language="javascript">
<? if($is_html){ ?>
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "Content",
	sSkinURI: "/board/se2/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});
<? } ?>

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
	var f = document.write_form;

	if(FormCheck("write_form") == true){
		<? if($is_html){ ?>
		oEditors.getById["Content"].exec("UPDATE_CONTENTS_FIELD", []);
		<? } ?>
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

function cat_sel(val){
	jQuery.ajax({
		url: "ajax_cat.php",
		type: 'POST',
		data: "ca_id="+val+"&sel_id=<?=$write['bd2']?>",

		error: function(xhr,textStatus,errorThrown){
			alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
		},
		success: function(data){
			$("#cat2").html(data);
		}
	});
}

function fix_ck(type){
	switch(type){
		case "open":
			if($("#top_fix").is(":checked") == true){
				$.blockUI({"message":""});
				$("#campaign_div").show();
				$("#loc_span").show();
				$("#top_loc").val("<?=$write['bd2']?>");
			} else {
				$("#top_loc").val('');
				$("#loc_span").hide();
			}
			break;
		case "close":
			$("#campaign_div").hide();
			$.unblockUI({"message":""});
			break;
	}
}

window.onload = function(){
	<? if($workType == "M"){ ?>
	fix_ck('open');
	<? } ?>
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>