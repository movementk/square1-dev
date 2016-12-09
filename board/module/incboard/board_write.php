<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 

$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);
$BoardName = $BoardDateRow["BoardName"];
$WriterName = $member["UserName"];
$is_html = $BoardDateRow["HtmlFlag"];

$UserPw = $member[Password];
$UserEmail = $member[Email];

if(empty($BoardIdx)) $BoardIdx = $_REQUEST["board_idx"];

$password1 = sql_password($_REQUEST[password1]);

$file_script = "";
$file_length = -1;

if($is_guest) $member["UserLevel"] = 1;

if($BoardDateRow["WriteAuthority"] > $member["UserLevel"] && !$is_admin) GetAlert("사용 권한이 없습니다.",$_SERVER['PHP_SELF']);

if($BoardIdx != ""){
	$BoardSQL = "select * from ".$mode." where BoardIdx=".$BoardIdx;
	$write =sql_fetch($BoardSQL);
	$Content = $write["Content"];
	$Title = $write["Title"];
	$UserPw = $write["UserPw"];

	if(!$member["UserID"] && !$is_admin && !$is_manager){
		if ($UserPw!=$password1){
			GetAlert("비밀번호가 맞지 않습니다.",$URI);
			exit;
		}
	} else {
		if($member["UserLevel"] < 4 && !$is_admin && !$mob){
			if($write["UserID"] != $member["UserID"]){
				GetAlert("접근권한이 없습니다.",$URI);
				exit;
			}
		}
	}

	if(!$is_admin && !$is_manager && $member["UserID"] != $write["UserID"]){
		if($write["Secret"] == 1 && !$password1) GetAlert("비밀번호를 입력해주시기 바랍니다.",$_SERVER['PHP_SELF']);
	}

	if($BoardName == "qna"){
		$tel = explode("-",$write["bd1"]);
	}

	$WriterName = $write["UserName"];
	$UserEmail = $write["UserEmail"];

	$file = get_file($mode, $BoardIdx);

	for ($i=0; $i<$file[count]; $i++)
	{
		$row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$BoardIdx' and file_no = '$i' ");
		if ($row[file_source])
		{
			$file_script .= "add_file(\"&nbsp;<input type='checkbox' name='bf_file_del[$i]' value='1'><a href='{$file[$i][href]}'>{$file[$i][file_name]}</a> 파일 삭제";
			if ($is_file_content)
				//$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='{$row[bf_content]}' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
				// 첨부파일설명에서 ' 또는 " 입력되면 오류나는 부분 수정
				$file_script .= " <input type='text' class=ed size=50 name='bf_content[$i]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
			$file_script .= "\");\n";
		}
		else
			$file_script .= "add_file('');\n";
	}
	$file_length = $file[count] - 1;

	if(!empty($mob)){
		if(!$is_html) $br = "\n";
		else $br = "<br>";
		$write["Content"] = "================================ [원 문] ================================".$br.$br.$Content.$br.$br.$br.$br."================================ [답 변] ================================".$br.$br;
		$Title = "[답변] ".$Title;
		$file_script = "add_file('');\n";
		$file_length = 0;
		$WriterName = $member["NAME"];
		$write["UserID"] = $member["ID"];
	}

}

if ($file_length < 0)
{
    $file_script .= "add_file('');\n";
    $file_length = 0;
}


$Categorys = explode("|",$BoardDateRow[Category]);
$Category_select = "<select name=Category>";
$Category_select .= "<option value=''>선택</option>";
for($l=0;$l<count($Categorys);$l++){
	if($Categorys[$l]==$write['Category']) {
		$Category_select .= "<option value='".$Categorys[$l]."'  selected> ".trim($Categorys[$l])."</option>";
	}else{
		$Category_select .= "<option value='".$Categorys[$l]."'> ".trim($Categorys[$l])."</option>";
	}
}
$Category_select .= "</select>";
?>
<script type="text/javascript" src="/board/se2/js/HuskyEZCreator.js" charset="utf-8"></script>
<form name="write_form" action="<?=$loc?>/board/module/incboard/board_ok.php" method="post" ENCTYPE="MULTIPART/FORM-DATA">
<input type="hidden" name="date_idx" value="<?=$date_idx?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="BoardType" value="<?=$BoardType?>">
<? if(!empty($mob)){?>
<input type="hidden" name="BoardIdx" value="">
<input type="hidden" name="ppw" value="<?=$write["UserPw"]?>">
<? }else{?>
<input type="hidden" name="BoardIdx" value="<?=$write["BoardIdx"]?>">
<? }?>
<input type="hidden" name="Ref" value="<?=$_REQUEST["Ref"]?>">
<input type="hidden" name="ReStep" value="<?=$_REQUEST["ReStep"]?>">
<input type="hidden" name="ReLevel" value="<?=$_REQUEST["ReLevel"]?>">
<input type="hidden" name="Category" value="<?=$_REQUEST[Category]?>">
<input type="hidden" name="UserID" value="<?=$write[UserID]?>">
<input type="hidden" name="URI" value="<?=$_SERVER["PHP_SELF"]?>">
<input type="hidden" name="FileCnt" value="<?=$BoardDateRow[FileCnt]?>">
<input type="hidden" name="HtmlChk" value="<?=$is_html?"Y":"N"?>">
<? if(!empty($BoardDateRow["Secret"])){ ?>
<input type="hidden" name="Secret" value='1'>
<? } ?>
<input type="hidden" name="wr_key_enabled"  id="wr_key_enabled"   value="" />
<? if($is_member){ ?>
<input type="hidden" name="UserName" value="<?=$WriterName?>">
<input type="hidden" name="UserPw" value="<?=$UserPw?>">
<input type="hidden" name="UserEmail" value="<?=$UserEmail?>">
<? } ?>
<div class="page-header page-header-1">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
			<li><a href="#">홍보센터</a></li>
			<li class="active">공지사항</li>
		</ol>
		<hr>
		<h1>공지사항</h1>
		<p>다비육종의 공지사항</p>
	</div>
</div>
<main id="content" tabindex="-1" class="promotional data-write">
	<div class="container">
		<div class="table-wrap">
			<table class="table table-border">
				<colgroup>
					<col style="width: 170px;">
					<col style="width: 1000px;">
				</colgroup>
				<tbody>
					<tr>
						<th><label for="subject">제목</label></th>
						<td><input name="Title" type="text" class="exp" id="Title" style="width:90%;" exp title="제목" value="<?=$Title?>"></td>
					</tr>
					<? if($is_guest){ ?>
					<tr>
						<th><label for="user-name">작성자</label></th>
						<td><input name="UserName" type="text" id="user-name" class="exp" exp title="이름" value="<?=$WriterName?>"></td>
					</tr>
					<tr>
						<th><label for="user-pw">비밀번호</label></th>
						<td><input type="password" id="user-pw" name="UserPw" class="exp" type="password" exp title="비밀번호"></td>
					</tr>
					<? } else { ?>
					<input type="hidden" name="UserName" value="<?=$WriterName?>">
					<input type="hidden" name="UserPw" value="<?=$UserPw?>">
					<input type="hidden" name="UserEmail" value="<?=$UserEmail?>">
					<? } ?>
					<tr>
						<td colspan="2">
							<textarea  name="Content" id="Content"><?=$view["Content"]?></textarea>
						</td>
					</tr>
					<tr>
						<th class="file"><label for="file">첨부파일</label></th>
						<td>
							<table id="variableFiles" cellpadding=0 cellspacing=0 style="margin:0px;padding:0px;"></table><?// print_r2($file); ?>
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
								objCell.style.border = "none";
								objCell.style.padding = "0px";

								objCell.innerHTML = "<input type='file' class='input02' style='width:300px;display:inline-block' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
								if (delete_code)
									objCell.innerHTML += delete_code;
								else
								{
									<? if ($is_file_content) { ?>
									objCell.innerHTML += " <input type='text' class='ed' size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
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
					<? if($is_guest){ ?>
					<tr>
						<td class="title"><label for="subject">자동등록방지</label></td>
						<td class="con" colspan="3"><?php echo $captcha_html ?></td>
					</tr>
					<? } ?>
					<? if($BoardName == "news"){ ?>
					<!--tr>
						<th><label for="link">Youtube 링크</label></th>
						<td class="youtube"><input type="text" id="link" style="width:50px;" name="bd1" value="<?=$write["bd1"]?>"></td>
					</tr-->
					<? } ?>
				</tbody>
			</table>
			<div class="btn-area">
				<p>
					<a href="<?=$_SERVER["PHP_SELF"]?>?board_code=board_list&page=<?=$page?>&<?=$searchVal?>" class="btn btn-gray" role="button">목록보기</a>
					<a href="javascript:write_chk();" class="btn btn-green" role="button">저장하기</a>
				</p>
			</div>
		</div>
	</div>
</main>
</form>
<script type="text/javascript">
<? if($is_html){ ?>
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "Content",
	sSkinURI: "/board/se2/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
<? } ?>

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

function write_chk(){
	var form = document.write_form;
	var expCk = true;
	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
	
	$(".exp").each(function(){
		if(expCk){
			if($(this).val() == ""){
				alert($(this).attr("title")+"은(는) 필수입력사항 입니다.");
				expCk = false;
			}
		}
	});

	<? if($is_html){ ?>
	oEditors.getById["Content"].exec("UPDATE_CONTENTS_FIELD", []);
	<? } ?>
	
	if(expCk){
		form.submit();
	}
}
</script>