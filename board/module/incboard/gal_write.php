<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);
$BoardName = $BoardDateRow["BoardName"];
$WriterName = $user[NAME];

$row = get_member($user[ID]);
$UserPw = $row[Password];
$UserEmail = $row[UserEmail];

$BoardType = 2;
$BoardIdx = $_REQUEST["board_idx"];

$password1 = sql_password($_REQUEST[password1]);

$file_script = "";
$file_length = -1;

if($BoardIdx != ""){
	$BoardSQL = "select * from ".$mode." where BoardIdx=".$BoardIdx;
	$BoardRow =sql_fetch($BoardSQL);
	$Content = $BoardRow["Content"];
	$UserPw = $BoardRow["UserPw"];

	if(!$user[ID]){
		if ($UserPw!=$password1){
			err_back("Your password is incorrect..");
		}
	} else {
		if($user[Level] < 4){
			if($BoardRow[UserID] != $user[ID]){
				err_back("Access Denied");
			}
		}
	}
	// 이미지 업로드 사용 (1은 사용안함)
	$upload_image = '0';
	// 미디어 업로드 사용 (1은 사용안함)
	$upload_media = '0';

	$WriterName = $BoardRow[UserName];
	$UserEmail = $BoardRow[UserEmail];

	$file = get_file($mode, $BoardIdx);

	for ($i=0; $i<$file[count]; $i++)
	{
		$row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$BoardIdx' and file_no = '$i' ");
		if ($row[file_source])
		{
			$file_script .= "add_file(\"<input type='checkbox' name='bf_file_del[$i]' value='1'><a href='{$file[$i][href]}'>{$file[$i][file_name]}</a> 파일 삭제";
			if ($is_file_content)
				//$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='{$row[bf_content]}' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
				// 첨부파일설명에서 ' 또는 " 입력되면 오류나는 부분 수정
				$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
			$file_script .= "\");\n";
		}
		else
			$file_script .= "add_file('');\n";
	}
	$file_length = $file[count] - 1;

}

if ($file_length < 0)
{
    $file_script .= "add_file('');\n";
    $file_length = 0;
}


$Category = explode(",",$BoardDateRow[Category]);
$Category_select = "<select name=Category>";
for($l=0;$l<count($Category);$l++){
	if($Category[$l]==$BoardRow['Category']) {
		$Category_select .= "<option value='".$Category[$l]."'  selected> ".trim($Category[$l])."</option>";
	}else{
		$Category_select .= "<option value='".$Category[$l]."'> ".trim($Category[$l])."</option>";
	}
}
$Category_select .= "</select>";

$returnpage = $_SERVER["PHP_SELF"];

$phone = explode("-",$BoardRow["phone"]);
//echo $mode;


include_once($dir."/config/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$sthumb_width = 100;
$sthumb_height = 90;

$ssql = " select * from ".$site_prefix."storymaster where 1=1 order by Idx desc limit 0, 1 ";
$srow = sql_fetch($ssql);

$sfiles = get_file($site_prefix."storymaster",$srow["Idx"]);
if($sfiles[0][image_type]=="1" || $sfiles[0][image_type]=="2" || $sfiles[0][image_type]=="3" || $sfiles[0][image_type]=="6"){
	$simg = makeThumbs("../board/upload/storymaster/", $sfiles[0][file_source], $sthumb_width, $sthumb_height, "");
} else {
	$simg = "<img src='/images/story/profile_img.jpg'>";
}

?>
<form name="write_form" action="<?=$loc?>/board/module/incboard/board_ok.php" method="post" ENCTYPE="MULTIPART/FORM-DATA">
<input type="hidden" name="date_idx" value="<?=$date_idx?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="BoardType" value="<?=$BoardType?>">
<input type="hidden" name="BoardIdx" value="<?=$BoardRow["BoardIdx"]?>">
<input type="hidden" name="Ref" value="<?=$_REQUEST["Ref"]?>">
<input type="hidden" name="ReStep" value="<?=$_REQUEST["ReStep"]?>">
<input type="hidden" name="ReLevel" value="<?=$_REQUEST["ReLevel"]?>">
<input type="hidden" name="Category" value="<?=$_REQUEST[Category]?>">
<input type="hidden" name="UserID" value="<?=$BoardRow[UserID]?>">
<input type="hidden" name="returnpage" value="<?=$returnpage?>">
<input type="hidden" name="FileCnt" value="<?=$BoardDateRow[FileCnt]?>">
<? if($BoardDateRow["Secret"]){ ?>
<input type="hidden" name="Secret" value='1'>
<? } ?>
<div style="overflow:hidden;">
	<div class="story_top">
		<div class="story_content">
			<div class="story_img">
				<div class="sliderkit photosgallery-vertical">
					<div class="sliderkit-nav">
						<div class="sliderkit-nav-clip">
							<ul>
								<?
								$tsql = " select * from ".$mode." where Etc1 = 'Y' order by RegDate desc ";
								$tresult = sql_query($tsql);
								for($i=0;$trow = sql_fetch_array($tresult);$i++){
									$tlist[$i] = $trow;
									$tfiles = get_file($mode,$trow["BoardIdx"]);
								?>
								<li><a href="#" rel="nofollow" title=""><img src="<?=$tfiles[1][path]?>/<?=$tfiles[1][file_source]?>" alt="<?=$trow["Title"]?>" /></a></li>
								<?
								}
								?>
							</ul>
						</div>
						<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-prev"><a rel="nofollow" href="#" title="Previous line"><span>Previous</span></a></div>
						<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-next"><a rel="nofollow" href="#" title="Next line"><span>Next</span></a></div>
					</div>
					<div class="sliderkit-panels">
						<?
						for($i=0;$i<sizeof($tlist);$i++){
							$tfiles = get_file($mode,$tlist[$i]["BoardIdx"]);
						?>
						<div class="sliderkit-panel">
							<a href="/story/story.php?board_code=board_view&board_idx=<?=$tlist[$i]["BoardIdx"]?>"><img src="<?=$tfiles[1][path]?>/<?=$tfiles[1][file_source]?>" alt="<?=$tlist[$i]["Title"]?>" width="490" height="270"/></a>
							<div class="sliderkit-panel-textbox">
								<div class="sliderkit-panel-text">
									<p><?=$tlist[$i]["Etc2"]?></p>
								</div>
								<div class="sliderkit-panel-overlay"></div>
							</div>
						</div>
						<?
						}
						?>
					</div>
				</div>
			</div>
			<div class="story_profile">
				<p><img src="/images/story/profile-tit.jpg"></p>
				<div class="overflow pt10">
					<p class="profile_img fleft"><?=$simg?></p>
					<ul class="fleft">
						<li class="font_bold pt50 pl10"><?=$srow["name"]?></li>
						<li class="pl10 pt5"><?=$srow["now"]?></li>
					</ul>
				</div>
				<ul class="profile_con">
					<li class="cboth pt10"><?=nl2br($srow["content"])?></li>
					<li class="fleft pt10"><a href="<?=$srow["fb"]?>" target="_blank"><img src="/images/story/facebook_btn.jpg"></a></li>
					<li class="fleft pt10"><a href="<?=$srow["tw"]?>" target="_blank"><img src="/images/story/twitter_btn.jpg"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="cboth" ><img src="/images/story/story_sh.jpg"></div>
	<div class="story_tab">
		<ul>
			<li><a href="javascript:link('4')"><img src="/images/story/story_tab1_on.jpg" name="image" onmouseover='this.src="/images/story/story_tab1_on.jpg"' onmouseout='this.src="/images/story/story_tab1_on.jpg"' ></a></li>
			<!--li><a href="javascript:link('4_2')"><img src="/images/story/story_tab2.jpg" name="image" onmouseover='this.src="/images/story/story_tab2_on.jpg"' onmouseout='this.src="/images/story/story_tab2.jpg"' ></a></li>
			<li><a href="javascript:link('4_3')"><img src="/images/story/story_tab3.jpg" name="image" onmouseover='this.src="/images/story/story_tab3_on.jpg"' onmouseout='this.src="/images/story/story_tab3.jpg"' ></a></li-->
		</ul>
	</div>
	<div class="tab_con pt20">
		<table class="write_tbl" border="0" cellspacing="0" summary="글쓰기 페이지">
			<colgroup>
				<col width="10">
				<col width="80">
				<col>
				<col width="80">
				<col width="120">
				<col width="80">
				<col width="120">
				<col width="10">
			</colgroup>
			<thead>
				<? if(!$user[ID]){ ?>
				<tr>
					<td class="board_lbg"></td>
					<th scope="row" class="view_tit bbs_br">이름</th>
					<th colspan="5" class="view_con"><input type="text" name="UserName" class="text w300px" exp title="작성자" value="<?=$WriterName?>"></th>
					<td class="board_rbg"></td>
				</tr>
				<tr>
					<td class="board_lbg"></td>
					<th scope="row" class="view_tit bbs_br">비밀번호</th>
					<th colspan="5" class="view_con"><input type="text" name="UserPw" class="text w300px" exp title="비밀번호"></th>
					<td class="board_rbg"></td>
				</tr>
				<tr>
					<td class="board_lbg"></td>
					<th scope="row" class="view_tit bbs_br">이메일</th>
					<th colspan="5" class="view_con">
						<input name="Email1" type="text" id="Email1" class="text" style="width:80px;" exp title="Email"/>&nbsp;@&nbsp;<input name="Email2" type="text" id="Email2" class="text" style="width:100px;" exp ela title="Email"/>&nbsp;
						<select onChange="javascript:changeEmail(this.form);" name="Email3" class="text" style="width:150px;">
							<?
							foreach($EMAIL_CODE AS $KEY => $VALUES){
							?>
							<option value="<?=$VALUES?>" <?if($VALUES == $email2){echo "selected";}?>><?=$VALUES?></option>
							<? } ?>
							<option value=""  <?if($method!="modify"){echo "selected";}?>>==Direct input==</option>
						</select>
					</th>
					<td class="board_rbg"></td>
				</tr>
				<? } else { ?>
				<input type="hidden" name="UserName" value="<?=$WriterName?>">
				<input type="hidden" name="UserPw" value="<?=$UserPw?>">
				<input type="hidden" name="UserEmail" value="<?=$UserEmail?>">
				<? } ?>
				<tr>
					<td class="board_lbg"></td>
					<th scope="row" class="view_tit bbs_br">제목</th>
					<th colspan="5" class="view_con"><input type="text" name="Title" class="text w800px" exp title="제목" value="<?=$BoardRow["Title"]?>"></th>
					<td class="board_rbg"></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="write_box" colspan="8">
						<?
						$CKEditor = new CKEditor();
						$CKFinder = new CKFinder();
						$CKFinder->SetupCKEditor($CKEditor, '/ckfinder/');
						$CKEditor->editor('Content', $BoardRow['Content'], array('width'=>'100%','height'=>'300px'));
						?>
					</td>
				</tr>
				<tr>
					<td colspan='2' class="bbs_br">첨부  <span onclick="add_file();" style="cursor:pointer;"><img src="/board/manager/img/btn_file_add.gif"></span> <span onclick="del_file();" style="cursor:pointer;"><img src="/board/manager/img/btn_file_minus.gif"></span></td>
					<td colspan='6'>
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
							objCell.style.border = "none";

							objCell.innerHTML = "<input type='file' class='input' style='width:500px;' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
							if (delete_code)
								objCell.innerHTML += delete_code;
							else
							{
								<? if ($is_file_content) { ?>
								objCell.innerHTML += "<br><input type='text' class='ed' size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
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
			</tbody>
		</table>
		<div class="board_btn">
			<ul>
				<li class="textcen pt10"><a href="javascript:write_chk();"><img src="/images/board/btn_ok.gif" alt="확인" class="pr10"></a><a href="<?=$_SERVER["PHP_SELF"]?>?board_code=board_list&page=<?=$page?>&start_page=<?=$start_page?>&<?=$searchVal?>"><img src="/images/board/btn_cancel.gif" alt="취소"></a></li>
			</ul>
		</div>
		</form>
	</div>
</div>
<script>
function changeEmail(fName){		
	if (fName.Email3.value != "직접입력") {
		fName.Email2.value = fName.Email3.value;
		fName.Email2.style.display = "none";
	} else {
		fName.Email2.style.display = "inline";
		fName.Email2.value = "";
		fName.Email2.focus();
	}
}
function tip_view(){
	var tops = $("body,html").scrollTop()+100;
	var tg = $("#tip");
	tg.animate({ opacity : "toggle" } , "slow");
	tg.css("top", tops);
}
function write_chk(){
	var form = document.write_form;
	if(FormCheck(form) == true){
		form.submit();
	} else {
		return;
	}
}
</script>