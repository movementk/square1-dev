<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$PageBlock   = 10;  //넘길 페이지 갯수
$board_list_num = 6;                     //게시판 게시글 수
$pagebt1=$loc."/image/board_img/first_btn.png";
$pagebt2=$loc."/image/board_img/prev_btn.png";
$pagebt3=$loc."/image/board_img/next_btn.png";
$pagebt4=$loc."/image/board_img/end_btn.png";
$fileURL = "../board/upload/".$BoardName."/";


$TotalSQL = "select * from ".$mode." where 1 ";

if($sF || $sT){
	$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
}

if($idx){
	$tsql = " select * from ".$mode." where BoardIdx = '".$idx."' ";
	$trow = sql_fetch($tsql);
} else {
	$tsql = " select * from ".$mode." where Category = '".$Category."' order by RegDate desc limit 0, 1 ";
	$trow = sql_fetch($tsql);
}
$trow["file"] = get_file($mode,$trow["BoardIdx"]);

if($Category){
	$TotalSQL .= " and Category = '".$Category."' ";
}

if(empty($order_flag) && empty($order_type)){
	$order_flag = "RegDate";
	$order_type = "desc";
}

$TotalSQL.= "order by $order_flag $order_type";
$TotalResult = mysql_query($TotalSQL);
$TotalCount  = mysql_num_rows($TotalResult);

$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)

if($page > 1) $prev_page = intval($page-1);
else $prev_page = "";

if($page == $total_page) $next_page = "";
else $next_page = intval($page+1);

if($TotalCount < $board_list_num){
	$prev_page = "";
	$next_page = "";
}

$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

$SQL = $TotalSQL." limit $from_record, $board_list_num";
$Result      = mysql_query($SQL);
$Count       = mysql_num_rows($Result);

$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&start_page=0&category=".$category."&page=");
$mod = 3;

$thmPath = $dir."/upload/".$BoardName."/thumbs/";

$dir_ck = is_dir($thmPath);

if($dir_ck != "1"){
	if(!@mkdir("$thmPath", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$thmPath", 0707)){ echo "퍼미션변경 실패"; exit;}
}

include_once($dir."/config/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$thumb_width = 300;
$thumb_height = 225;
?>

<!--search-->

<form name="search_form" action="" method="get">
<input type="hidden" name="workType" value="<?=$workType?>">
<div class="search">
	<ul>
		<li>
			<select name="search_list" class="search_form" id="search_list" style="width:100px;">
				<option value="Title">제목</option>
				<option value="Content" <?=$_GET["sT"]=="Content"?"selected":""?>>내용</option>
			</select>
		</li>
		<li class="pl5"><input name="sF" type="text" class="form" id="search_txt" style="width:300px;" value="<?=$_GET[sF]?>"></li>
		<li class="pl5"><input type="image" src="../image/story_img/search_btn.gif" alt="검색"></li>
	</ul>
</div>
</form>
<!--//search-->

<!--list-->
<ul class="news">
	<?
	for($i=0;$row = sql_fetch_array($Result);$i++){
		$Title = $row[Title];
		$Title = cut_string($Title, 75);

	//	if($i && $i % $mod == 0) echo "</tr><tr>";
		if($i % $mod < 2) $lcss = "mr14";
		else $lcss = "";

		$new_img = "";
		$wdate = $row["RegDate"];
		$today		= date("Y-m-d H:i:s");
		$chk		= strtotime($today) - strtotime($wdate);			
		$chk_new	= (60 * 60 * 24) * 1;
		if(($chk_new - $chk)>0){
		//	$new_img = "&nbsp;<img src=\"/images/bbs/icon_new.gif\" align=\"absmiddle\" >"; 
		}
		$img = "";

		$row["files"] = get_file($mode,$row["BoardIdx"]);
		switch($row["files"][0][image_type]){
			case "1":
			case "2":
			case "3":
				if(file_exists($fileURL."/thumbs/".$row["files"][0][file_source])){
					$row["files"][0]["thumb_src"] = "/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source];
				} else {
					if($row["files"][0]["image_width"] <= $thumb_width && $row["files"][0]["image_height"] <= $thumb_height){
						$row["files"][0]["thumb_src"] = "/board/upload/".$BoardName."/".$row["files"][0][file_source];
					} else {
						$row["files"][0]["thumb_src"] = makeThumbs($fileURL, $row["files"][0][file_source], $thumb_width, $thumb_height, "thumbs","");
						if(file_exists($fileURL."/thumbs/".$row["files"][0][file_source])){
							$row["files"][0]["thumb_src"] = "/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source];
						} else {
							$row["files"][0]["thumb_src"] = "/board/upload/".$BoardName."/".$row["files"][0][file_source];
						}
					}
				}
				break;
			case "6":
				$img_ck = true;
				$row["files"][0]["thumb_src"] = "/board/upload/".$BoardName."/".$row["files"][0][file_source];
				break;
			default:
				$row["files"][0]["thumb_src"] = "/image/about_img/noimg.gif";
		}

		$img = "<img src='".$row["files"][0]["thumb_src"]."'>";

		$auth_link = '<a href="'.$_SERVER["PHP_SELP"].'?board_code=board_view&board_idx='.$row["BoardIdx"].'&page='.$page.'&bd1='.$bd1.'&'.$searchVal.'" class="bbs">';
		$pwd_link = "<a href=\"javascript:pwd_ck('".$row[BoardIdx]."');\">";

		$list_href = $auth_link;
	?>
	<li class="<?=$lcss?>">
		<p><?=$list_href.$img?></a></p>
		<?=$list_href.$row["Title"]?></a>
		<span><?=substr($row["RegDate"],0,10)?></span>
	</li>
	<?
	}
	// 나머지 td 를 채운다.
	if (($cnt = $i%$mod) != 0)
		for ($l=$cnt; $l<$mod; $l++)
	//		echo "<li>&nbsp;</li>\n";
	
	if($Count == 0){ echo "<li>게시물이 없습니다.</li>"; }
	?>
</ul>
<!--//list-->

<!--page-->
<div class="page">
	<ul>
		<?
		if($Count>0){
			$write_pages = str_replace("처음", "<img src='$pagebt1' border='0' align='absmiddle' title='처음'>", $write_pages);
			$write_pages = str_replace("이전", "<img src='$pagebt2' border='0' align='absmiddle' title='이전'>", $write_pages);
			$write_pages = str_replace("다음", "<img src='$pagebt3' border='0' align='absmiddle' title='다음'>", $write_pages);
			$write_pages = str_replace("맨끝", "<img src='$pagebt4' border='0' align='absmiddle' title='맨끝'>", $write_pages);
			//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
			$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
			echo $write_pages;
		}
		?>
	</ul>
</div>
<!--//page-->
