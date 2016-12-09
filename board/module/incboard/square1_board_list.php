<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$PageBlock   = 5;  //넘길 페이지 갯수
$board_list_num = 6;                     //게시판 게시글 수
$fileURL = "../board/upload/".$BoardName."/";

$TotalSQL = "select * from ".$mode." where 1 ";

if($sF || $sT){
	$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
}

if($Category){
	$TotalSQL .= " and Category = '".$Category."' ";
}

switch($gubun){
	case "ing":
		$TotalSQL .= " and ( bd1 <= '".date("Y-m-d")."' and bd2 >= '".date("Y-m-d")."' ) ";
		break;
	case "end":
		$TotalSQL .= " and bd2 < '".date("Y-m-d")."' ";
		break;
}

$searchVal = $searchVal."&gubun=".$gubun;

$order_flag = "border desc, RegDate desc ";

if(empty($order_flag) && empty($order_type)){
	$order_flag = "RegDate";
	$order_type = "desc";
}

$TotalSQL.= "order by $order_flag $order_type";
$TotalResult = mysql_query($TotalSQL);
$TotalCount  = @mysql_num_rows($TotalResult);

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
$Count       = @mysql_num_rows($Result);

$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&page=");
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
<section class="brand-event prizewinner-list">
	<div class="section-header">
		<h2>스퀘어원의 이벤트 소식을<br class="visible-xs"> 한번에 보실 수 있습니다.</h2>
		<p>
			복합 문화 소비공간 스퀘어원만의<br class="visible-xs"> 다양한 이벤트를 경험해 보세요~
		</p>
	</div>
	<div class="section-content">
		<div class="event-list">
			<ul class="row">
				<?
				for($i=0;$row = sql_fetch_array($Result);$i++){
					$Title = $row[Title];
					$Title = cut_string($Title, 75);

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

					if($row["files"][0]["file_source"]){
						$row["files"][0]["thumb_src"] = "/board/upload/".$BoardName."/".$row["files"][0]["file_source"];
					} else {
						$row["files"][0]["thumb_src"] = "/image/about_img/noimg.gif";
					}

					$auth_link = '<a href="'.$_SERVER["PHP_SELP"].'?board_code=board_view&board_idx='.$row["BoardIdx"].'&page='.$page.'&'.$searchVal.'">';
					$pwd_link = "<a href=\"javascript:pwd_ck('".$row[BoardIdx]."');\">";

					$list_href = $auth_link;
				?>
				<li class="col-xs-12 col-sm-6 col-md-4">
					<?=$auth_link?>
						<div class="item-img">
							<img src="<?=$row["files"][0]["thumb_src"]?>" class="img-responsive" alt="">
						</div>
						<div class="details">
							<h4><?=$Title?> <!--i class="ico-star"></i--></h4>
							<p class="date"><?=preg_replace("/\-/i",".",$row["bd1"])?> - <?=preg_replace("/\-/i",".",$row["bd2"])?></p>
						</div>
					</a>
				</li>
				<?
				}
				if($i == 0) echo '<div class="none-event"><h1 class="no-event-title">해당하는 이벤트가 없습니다. <br> 감사합니다.</h1></div>';
				?>
			</ul>
		</div>
		<nav aria-label="Page navigation" class="paging">
			<ul class="pagination">
				<?
				if($Count>0){
					echo $write_pages;
				}
				?>
			</ul>
		</nav>
	</div>
</section>