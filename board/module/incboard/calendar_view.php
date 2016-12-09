<?
//$date_idx = $_REQUEST["date_idx"];
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

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


$i=0;
$files = array();
$fsql = " select * from ".$site_prefix."file where board_table = '".$mode."' and board_idx = '".$BoardIdx."' order by file_no";
$fresult = mysql_query($fsql);
while($frow = mysql_fetch_array($fresult)){
	$files[$i] = $frow;
	$files[$i][href]=$dir."/upload/".$BoardName."/".$frow['file_source'];
	$i++;
}
$file_num = count($files);
$searchVal = $searchVal."&schedule_ym=".$schedule_ym."&day=".$day;
$url = $rp.basename($_SERVER["PHP_SELF"])."?board_code=board_view&board_idx=".$BoardIdx."&page=".$page."&start_page=".$start_page."&".$searchVal;
//echo $url;
$returnpage = $rp.basename($_SERVER["PHP_SELF"]);
//echo $BoardViewSQL;

if($password1){
	$upw = sql_password($password1);

	if($upw != $BoardViewRow[UserPw]){
		err_back('비밀번호가 맞지 않습니다.');
		exit;
	}
}

?>
<div style="position:absolute; padding-left:0px; width:0px; margin-right:-450px; left:50%; height:120px; top:125px; z-index-1;">
		<script language="javascript">activex_flash('500','120','<?=$loc?>/flash/st02.swf',1);</script>
</div>
<div id="sub_bg"></div>
<div id="sub_top02">
	<div id="left_menu"><script language="javascript">activex_flash('230','320','<?=$loc2?>/flash/left_02.swf<?=$nums?>',1);</script></div>
	<div style="width:230px; height:auto; position:absolute; left:-30px; top:270px;"><script language="javascript">activex_flash('230','140','<?=$loc?>/flash/sub_flag.swf<?=$nums?>',1);</script></div>
	<div id="left_shadow"></div>
</div>
<div id="sub">
	<div id="sub_title">
		<div id="s_title"><img src="<?=$loc?>/img/sub/title/title_Event & Schedule.png"></div>
		<div id="s_navi">
			HOME &nbsp;&nbsp;<img src="<?=$loc?>/img/common/bullet_arrow.gif">&nbsp;&nbsp; News and Activities &nbsp;&nbsp;<img src="<?=$loc?>/img/common/bullet_arrow.gif">&nbsp;&nbsp; Event & Schedule
		</div>
	</div>
	<!--컨텐츠 시작 //-->
	<div id="contents">
	<!--컨텐츠 내용//-->
		<div id="board_view">
		<!-- 게시판 보기// -->
			<ul class="b_view">
				<li class="view_txt">
					<div class="v_subject"><?=$BoardViewRow["Title"]?> <?=$BoardViewRow[Secret]=="2"?"[비밀글]":""?></div><!--게시판 제목-->
					<div class="v_txt">
					<div class="v_name"><?=$BoardViewRow["UserName"]?></div><!--글쓴이-->
					<div class="v_date"><?=substr($BoardViewRow["RegDate"],0,10)?></div><!--작성일-->
					<div class="v_hit"><?=number_format($BoardViewRow[ReadNum])?></div><!--조회수-->
					</div>
				</li>
				<!-- 게시판 내용 -->
				<li class="view_con">
					<?
					for($i=0;$i<=$file_num;$i++){
						if($files[$i][file_source]){
							if($files[$i][image_type]=="1" || $files[$i][image_type]=="2" || $files[$i][image_type]=="3" || $files[$i][image_type]=="6"){
								$ImageSize = getimagesize($dir."/upload/".$BoardName."/".$files[$i][file_source]);
								$dir2 = $loc."/board/upload/".$BoardName."/".$files[$i][file_source];
								if($ImageSize[0] > 600){
									$Width = 600;
								} else {
									$Width = $ImageSize[0];
								}
								?>
									<img src="<?=$dir2?>" width="<?=$Width?>" ><br>
									<?
							 } else if(strtolower($fn[1]) == "avi" || strtolower($fn[1]) == "wmv" || strtolower($fn[1]) == "asf" ){
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
					
					if($BoardViewRow["HtmlChk"]=="Y"){
						 echo $BoardViewRow["Content"];
					} else {
						echo nl2br($BoardViewRow["Content"]);
					}
					?>
				</li>
			</ul>
			<!--//게시판 보기-->
		</div>
		<!--게시판 버튼 -->
		<div class="board_btn">
		<form name="view_form" method="post" action="<?=$loc?>/board/module/incboard/board_ok.php">
		<input type="hidden" name="board_code" value="board_delete">
		<input type="hidden" name="BoardIdx" value="<?=$BoardViewRow[BoardIdx]?>">
		<input type="hidden" name="board_idx" value="<?=$BoardViewRow[BoardIdx]?>">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="mode" value="<?=$mode?>">
		<input type="hidden" name="returnpage" value="<?=$_SERVER['PHP_SELF']?>">
			<a href="<?=$_SERVER['PHP_SELF']?>?board_code=board_list&page=<?=$page?>&start_page=<?=$start_page?>&<?=$searchVal?>" title="List"><img src="<?=$loc?>/img/common/btn_list.gif"></a>
		</form>
		</div>
		<!--//컨텐츠 내용-->
	</div>
	<!--//컨텐츠 끝-->
</div>

<script>
function modify_chk(f){
	<? if(!$user[ID]){ ?>
		if(f.upw.value == ""){
			alert("비밀번호를 입력해주세요");
			f.upw.focus();
			return;
		}
	<? } ?>
	f.method = "get";
	f.board_code.value = "board_write";
	f.action = "<?=$_SERVER['PHP_SELF']?>";
	f.submit();
}
</script>
<?
if($BoardDateRow[ViewInList] == "1"){
	include_once("../board/module/incboard/board_list.php");
}
?>
