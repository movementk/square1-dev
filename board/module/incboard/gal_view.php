<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
//$date_idx = $_REQUEST["date_idx"];
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

if(!$is_admin && !empty($BoardDateRow["ViewAuthority"]) && $user["Level"] < $BoardDateRow["ViewAuthority"]) err_back("권한이 없습니다.");

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$fileURL="../board/upload/".$BoardName."/";

$BoardIdx = $_REQUEST["board_idx"];

$BoardViewSQL = "select * from ".$mode." where BoardIdx=".$BoardIdx;
$BoardViewRow = sql_fetch($BoardViewSQL);

$sql1 = "update ".$mode." set ReadNum=ReadNum+1 where BoardIdx=".$BoardIdx;
mysql_query($sql1);


$CommentSQL = "select * from ".$CommentName." where DBName='".$BoardName."' and BoardIdx=".$BoardIdx." and Ref = '0' order by CommentIdx desc";
$CommentResult = mysql_query($CommentSQL);

$q_next = "select BoardIdx, Title, RegDate from ".$mode." where BoardIdx>".$BoardIdx;
if($Category){
   $q_next .= " AND Category='".$Category."' ";
}
$q_next .= " order by BoardIdx  limit 0,1";
$q_next_row = sql_fetch($q_next);

$q_prev = "select BoardIdx, Title, RegDate from ".$mode." where BoardIdx<".$BoardIdx;
if($Category){
   $q_prev .= " AND Category='".$Category."' ";
}
$q_prev .= "  order by BoardIdx desc limit 0,1";
$q_prev_row = sql_fetch($q_prev);


$files = get_file($mode,$BoardIdx);
$file_num = $files[count];

$url = $rp.basename($_SERVER["PHP_SELF"])."?board_code=board_view&board_idx=".$BoardIdx."&page=".$page."&start_page=".$start_page."&".$searchVal;
$returnpage = $_SERVER["PHP_SELF"];

if($password1){
	$upw = sql_password($password1);

	if($upw != $BoardViewRow[UserPw]){
		err_back('비밀번호가 맞지 않습니다.');
		exit;
	}
}

if($is_member || $is_admin) $modify_link_in_view = "modify_chk(document.view_form);";
else $modify_link_in_view = "pwd_ck('".$BoardViewRow["BoardIdx"]."');";

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
		<table class="view_tbl" border="0" cellspacing="0" summary="글 내용을 표시">
		<colgroup>
			<col width="10">
			<col width="80">
			<col>
			<col width="80">
			<col width="160">
			<col width="80">
			<col width="50">
			<col width="10">
		</colgroup>
		<thead>
			<tr>
				<td class="board_lbg"></td>
				<th scope="row" class="view_tit bbs_br">제목</th>
				<th colspan="5" class="view_con"><?=$BoardViewRow["Title"]?></th>
				<td class="board_rbg"></td>
			</tr>
			<tr>
				<td class="board_lbg"></td>
				<th scope="row" class="view_tit bbs_br">작성자</th>
				<th class="view_con bbs_br"><?=$BoardViewRow["UserName"]?></th>
				<th scope="row" class="view_tit bbs_br">작성일</th>
				<th class="view_con bbs_br"><?=$BoardViewRow["RegDate"]?></th>
				<th scope="row" class="view_tit bbs_br">조회</th>
				<th class="view_con"><?=number_format($BoardViewRow[ReadNum])?></th>
				<td class="board_rbg"></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th></td>
				<th scope="row" class="view_tit bbs_br">첨부파일</th>
				<th colspan="5" class="view_con">
					<table>
					<?
					if($file_num > 0){
						for($i=0;$i<$file_num;$i++){
							if($files[$i][image_type]=="1" || $files[$i][image_type]=="2" || $files[$i][image_type]=="3" || $files[$i][image_type]=="6") continue;
					?>
						<tr><th class="view_con" style="border:0;padding-left:0px;"><a href="<?=$files[$i][href]?>"><?=$files[$i][file_name]?></a></th></tr>
						<? } ?>
					<? } else { echo "<tr><td>&nbsp;</td></tr>"; } ?>
					</table>
				</th>
				<th class="board_rbg"></th>
			</tr>
			<tr>
				<td class="cont" colspan="8">
					<?
					if($BoardName == "movie") $fstart = 1;
					else $fstart = 1;
					for($i=$fstart;$i<$file_num;$i++){
						if($files[$i][file_source]){
							if($files[$i][image_type]=="1" || $files[$i][image_type]=="2" || $files[$i][image_type]=="3" || $files[$i][image_type]=="6"){
								$dir2 = $files[$i]["path"]."/".$files[$i][file_source];
								?>
									<img src="<?=$dir2?>"  name='target_resize_image[]' ><br>
								<?
							 } else if(preg_match("/\.(avi|wmv|asf)$/i",$files[$i][file_source])){
							?>
								<embed src="../board/upload/<?=$BoardName?>/<?=$files[$i][file_source]?>" AutoStart="true" width=600 height=420><br>
							<?
							}
						}
					}
					?>
					</center>
					<br>
					<?

					if($workType == "video"){
						if(!empty($BoardViewRow[Etc1])) echo $BoardViewRow[Etc1];
					}
					
					if($BoardViewRow["HtmlChk"]=="Y"){
						 echo $BoardViewRow["Content"];
					} else {
						echo nl2br($BoardViewRow["Content"]);
					}
					?>
				</td>
			</tr>
		</tbody>
		</table>
		<form name="view_form" method="post" action="/board/module/incboard/board_ok.php">
		<input type="hidden" name="board_code" value="board_delete">
		<input type="hidden" name="BoardIdx" value="<?=$BoardViewRow[BoardIdx]?>">
		<input type="hidden" name="board_idx" value="<?=$BoardViewRow[BoardIdx]?>">
		<input type="hidden" name="mode" value="<?=$mode?>">
		<input type="hidden" name="returnpage" value="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="page" value="<?=$page?>">
		<input type="hidden" name="start_page" value="<?=$start_page?>">
		<input type="hidden" name="Category" value="<?=$Category?>">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="sT" value="<?=$sT?>">
		<input type="hidden" name="sF" value="<?=$sF?>">
		<input type="hidden" name="pwdck">
		<div class="board_btn">
			<ul>
				<li class="fleft"><a href="<?=$_SERVER['PHP_SELF']?>?board_code=board_list&page=<?=$page?>&start_page=<?=$start_page?>&<?=$searchVal?>" title="목록"><img src="/images/board/btn_list.gif" alt="목록"></a></li>
				<?
				if($BoardDateRow["WriteAuthority"]<=$levelchk || $is_admin){
					if($BoardViewRow[UserID] == $user[ID] || $is_admin){
				?>
				<li class="fright pl5"><a href="javascript:;" onclick="delete_chk();"><img src="/images/board/btn_del.gif" alt="삭제"></a></li>
				<li class="fright pl5"><a href="javascript:;" onclick="<?=$modify_link_in_view?>"><img src="/images/board/btn_modify.gif" alt="수정"></a></li>
				<?
					}
				?>
				<li class="fright"><a href="<?=$_SERVER["PHP_SELF"]?>?board_code=board_write&<?=$searchVal?>"><img src="/images/board/btn_write.gif" alt="쓰기"></a></li>
				<?
				}
				?>
			</ul>
		</div>
		</form>
		<div style='border-top:1px solid #999;width:100%;height:1px;margin-top:15px;'></div>
		<?
		if($BoardDateRow["CommentFlag"]){
			include $dir."/module/incboard/comment.php";
		}
		?>
	</div>
</div>


<script>
function modify_chk(f){
	f.method = "get";
	f.board_code.value = "board_write";
	f.action = "<?=$_SERVER['PHP_SELF']?>";
	f.submit();
}
function pwd_ck(idx){
	var f = document.view_form;
	f.board_code.value = "board_write";
	f.board_idx.value = idx;
	f.pwdck.value = "1";
	f.action = "<?=$_SERVER['PHP_SELF']?>";
	f.submit();
}
function resizeBoardImage(imageWidth, borderColor) {
	var target = document.getElementsByName('target_resize_image[]');
	var imageHeight = 0;

	if (target) {
		for(i=0; i<target.length; i++) { 
			// 원래 사이즈를 저장해 놓는다
			target[i].tmp_width  = target[i].width;
			target[i].tmp_height = target[i].height;
			// 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
			if(target[i].width > imageWidth) {
				imageHeight = parseFloat(target[i].width / target[i].height)
				target[i].width = imageWidth;
				target[i].height = parseInt(imageWidth / imageHeight);
			//	target[i].style.cursor = 'pointer';

				// 스타일에 적용된 이미지의 폭과 높이를 삭제한다
				target[i].style.width = '';
				target[i].style.height = '';
			}

			if (borderColor) {
				target[i].style.borderWidth = '1px';
				target[i].style.borderStyle = 'solid';
				target[i].style.borderColor = borderColor;
			}
		}
	}
}

window.onload = function(){
	resizeBoardImage(650);
}
</script>
<?
if($BoardDateRow[ViewInList] == "1"){
	include_once("../board/module/incboard/board_list.php");
}
?>
