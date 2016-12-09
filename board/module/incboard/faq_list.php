<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);
$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$PageBlock   = 10;  //넘길 페이지 갯수
$board_list_num = 1000;                     //게시판 게시글 수
$pagebt1=$loc."/image/board_img/prev_btn02.gif";
$pagebt2=$loc."/image/board_img/prev_btn.gif";
$pagebt3=$loc."/image/board_img/next_btn.gif";
$pagebt4=$loc."/image/board_img/next_btn02.gif";
$fileURL = "../board/upload/".$BoardName."/";

$thmPath = $dir."/upload/".$BoardName."/thumbs/";

$dir_ck = is_dir($thmPath);

if($dir_ck != "1"){
	if(!@mkdir("$thmPath", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$thmPath", 0707)){ echo "퍼미션변경 실패"; exit;}
}

$TotalSQL = "select * from ".$mode." where Notice != '1' ";

if($sF && $sT){
	$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
}

if($Category){
	$TotalSQL .= " and Category = '".$Category."' ";
}

$TotalSQL.= "order by border asc, BoardIdx desc";
$TotalResult = @mysql_query($TotalSQL);
$TotalCount  = @mysql_num_rows($TotalResult);



$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

$SQL = $TotalSQL." limit $from_record, $board_list_num";
$Result      = @mysql_query($SQL);
$Count       = @mysql_num_rows($Result);

$new_img = "&nbsp;<img src=\"/images/bbs/icon_new.gif\" align=\"absmiddle\" >";

$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&start_page=0&category=".$category."&page=");
?>
<div class="faq_list">
	<?
	$num = $TotalCount - ($page-1)*$board_list_num;
	for($i=0;$row = sql_fetch_array($Result);$i++){
		$Title = $row[Title];
		$Title = cut_string($Title, 95);
		
		$str="";
		$new_img = "";
		$wdate = $row["RegDate"];
		$today		= date("Y-m-d H:i:s");
		$chk		= strtotime($today) - strtotime($wdate);			
		$chk_new	= (60 * 60 * 24) * 1;
		if(($chk_new - $chk)>0){
			$new_ck = true;
		}
		$c_sql = " select count(*) as cnt from ".$CommentName." where DBName = '".$mode."' and BoardIdx = '".$row[BoardIdx]."' ";
		$c_row = sql_fetch($c_sql);
		$Comment_count = $c_row[cnt];
		$img = "";

		if($row[Secret]){
			$secret_img = '<img style="margin-left:5px;" src="/image/board_img/secret_icon.gif" alt="Secret" />';
		} else {
			$secret_img = "";
		}

		$list_href = "<a href='javascript:;'>";

		$files = get_file($mode,$row[BoardIdx]);
		$file_num = $files[count];
	?>
	<div class="faq_q">
		<ul>
			<li class="q_icon"><img src="../image/board_img/faq_q.gif" alt=""></li>
			<li class="q_title"><?=$row["Title"]?></li>
			<li class="q_on"><img src="../image/board_img/faq_on.gif" class="onoff" osrc="../image/board_img/faq_off.gif" hsrc="../image/board_img/faq_on.gif" alt="on"></li>
		</ul>
	</div>
	<div class="faq_a">
		<ul>
			<li class="a_icon"><img src="../image/board_img/faq_a.gif" alt=""></li>
			<li class="a_title">
				<?
				$fstart = 0;
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
				if($row["HtmlChk"]=="Y" && $BoardName != "free"){
					 echo $row["Content"];
				} else {
					echo nl2br($row["Content"]);
				}
				?>
			</li>
		</ul>
	</div>
	<?
		$num--;
	}

	if($Count == 0){ echo "<ul class='faq_q'><li style='width:100%;padding:40px 0px 40px 0px; text-align:center;' class='faq_title'>게시물이 없습니다</li></ul>"; }
	?>
</div>
<!--//list-->

<!--게시판 리스트 페이지-->
<div class="bbs_page">
	<?
	if($Count>0){
		$write_pages = str_replace("처음", "<img src='$pagebt1' border='0' align='absmiddle' class='pt2' title='처음'>", $write_pages);
		$write_pages = str_replace("이전", "<img src='$pagebt2' border='0' align='absmiddle' class='pt2' title='이전'>", $write_pages);
		$write_pages = str_replace("다음", "<img src='$pagebt3' border='0' align='absmiddle' class='pt2' title='다음'>", $write_pages);
		$write_pages = str_replace("맨끝", "<img src='$pagebt4' border='0' align='absmiddle' class='pt2' title='맨끝'>", $write_pages);
		//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
		$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
		echo $write_pages;
	}
	?>
</div>
<!--//게시판 리스트 페이지-->

<form name="search_form" action="" method="get">
<input type="hidden" name="workType" value="<?=$workType?>">
<div class="bbs_search fcenter">
	<ul>
		<li>
			<select name="sT" class="input03" id="sT" style="width:125px;">
				<option value="Title">질문</option>
				<option value="Content" <?=$_GET["sT"]=="Content"?"selected":""?>>답변</option>
			</select>
		</li>
		<li class="pl5"><input name="sF" type="text" class="input03" id="sF" style="width:390px;" value="<?=$_GET[sF]?>"></li>
		<li><input type="image" src="../image/board_img/search_btn.gif" alt="검색하기"></a></li>
	</ul>
</div>
</form>


<script type="text/javascript"> 
$(document).ready(function(){
//	$(".faq_c").addClass("active");
	$(".faq_a").hide();

	$(".faq_q").click(function(){
		var n = $(".faq_q").index(this);
		$(this).next(".faq_a").slideToggle("slow").siblings(".faq_a").slideUp("slow");
		$(".onoff").each(function(i){
			if(i == n){
				$(this).attr({"src":$(this).attr("hsrc")});
			} else {
				$(this).attr({"src":$(this).attr("osrc")});
			}
		});
	//	var dh = parseInt($(this).next(".faq_a").find("dd:first").height());
	//	$(this).next(".faq_a").find("dt").css({"height":dh+"px"});
	});
	resizeBoardImage(650);
});
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

$(window).load(function(){
});
</script>