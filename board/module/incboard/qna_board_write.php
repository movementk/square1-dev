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

$list_href = $_SERVER["PHP_SELF"];

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

	$list_href = "/member/inquiry_list.php";

}

if ($file_length < 0)
{
    $file_script .= "add_file('');\n";
    $file_length = 0;
}


$Categorys = explode("|",$BoardDateRow[Category]);
for($l=0;$l<count($Categorys);$l++){
	if($Categorys[$l]==$write['Category']) {
		$Category_select .= "<option value='".$Categorys[$l]."'  selected> ".trim($Categorys[$l])."</option>";
	}else{
		$Category_select .= "<option value='".$Categorys[$l]."'> ".trim($Categorys[$l])."</option>";
	}
}
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
<input type="hidden" name="URI" value="/member/inquiry_view.php?board_idx=">
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
<input type="hidden" name="bd1" value="<?=$write["bd1"]?>">
<? } ?>
<section class="write">
	<div class="section-content">
		<div class="input-form type-1">
			<form>
				<dl>
					<dt>상담유형</dt>
					<dd>
						<select class="form-control" id="performance" name="Category">
							<option value="">선택하세요</option>
							<?=$Category_select?>
						</select>
					</dd>
					<? if($is_guest){ ?>
					<dt><label for="subject">이름</label></dt>
					<dd class="subject"><input type="text" id="uname" class="form-control exp" name="UserName" title="이름" value="<?=$WriterName?>"></dd>
					<dt><label for="subject">비밀번호</label></dt>
					<dd class="subject"><input type="password" id="upw" class="form-control exp" name="UserPw" title="비밀번호"></dd>
					<dt><label for="subject">이메일</label></dt>
					<dd class="subject"><input type="text" id="email" class="form-control" name="UserEmail" title="이메일" value="<?=$UserEmail?>"></dd>
					<? } ?>
					<dt><label for="subject">제목</label></dt>
					<dd class="subject"><input type="text" id="subject" class="form-control exp" name="Title" title="제목" value="<?=$Title?>"></dd>
					<dt>첨부파일</dt>
					<dd class="file">
						<input type="file" id="file" class="form-control" name='bf_file[]'>
						<label for="file">
							<i class="icon-upload">
								<span class="sr-only">파일올리기</span>
							</i>
						</label>
					</dd>
					<dt>내용 <br class="hidden-xs"><i>(<font id="ncnt">0</font>자/2000자)</i></dt>
					<dd>
						<textarea class="form-control" name="Content" id="Content" title='내용' ><?=$write['Content']?></textarea>
					</dd>
					<? if($is_guest){ ?>
					<dt><label for="subject">자동등록방지</label></dt>
					<dd class="subject"><?php echo $captcha_html ?></dd>
					<? } ?>
				</dl>
				<div class="btn-area">
					<p>
						<a href="javascript:write_chk();" class="btn btn-orange" role="button">전송</a>
						<a href="<?=$list_href?>" class="btn btn-default" role="button">취소</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</section>

</form>