<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t106 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

function icon($act, $link="", $target="_parent")
{
    global $g4;

    $img = array("입력"=>"insert", "추가"=>"insert", "생성"=>"insert", "수정"=>"modify", "삭제"=>"delete", "이동"=>"move", "그룹"=>"move", "보기"=>"view", "미리보기"=>"view", "복사"=>"copy");
	$icon = "<button type='button' class='mbtn_a_b'";
    if ($link)
		$icon .= "onclick='cat_move(\"".$link."\");'";
	$icon .= ">".$act."</button>&nbsp;";
    return $icon;
}

$searchVal = "page=".$page;
$PageBlock = 10;
$board_list_num = 20;
$board_tit_len = 75;

$mode = $site_prefix."category";

$TotalSQL = " select * from ".$mode." where 1=1 $sql_common order by ca_id asc  ";
$TotalResult = sql_query($TotalSQL);
$TotalCount = @mysql_num_rows($TotalResult);

$total_page = ceil($TotalCount / $board_list_num);
if(!$page) $page = 1;
$from_record = ($page - 1) * $board_list_num;

$sql = $TotalSQL." limit $from_record, $board_list_num ";
$result = sql_query($sql);
$Count = @mysql_num_rows($result);

$write_pages = get_paging_admin($PageBlock, $page, $total_page, $_SERVER['PHP_SELF']."?page=");

?>
<div id="container">
	<div class="content_view">
		<div class="con_title">분류관리</div>
		<table class="list_table mt15">
			<colgroup>
				<col width="10%">
				<col width="">
				<col width="15%">
				<col width="20%">
			</colgroup>
			<thead>
			<tr>
				<th>코드</th>
				<th>클래스명</th>
				<th>노출순서</th>
				<th>관리</th>
			</tr>
			</thead>
			<?
			for ($i=0; $row=sql_fetch_array($result); $i++) 
			{
				$s_level = "";
				$level = strlen($row[ca_id]) / 2 - 1;
				if ($level > 0) // 2단계 이상
				{
					$s_level = "&nbsp;&nbsp;<img src='/board/admn/images/common/icon_catlevel.gif' border=0 width=17 height=15 align=absmiddle alt='".($level+1)."단계 분류'>";
					for ($k=1; $k<$level; $k++)
						$s_level = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $s_level;
				} 

				if($is_super){
					$s_add = icon("추가", "/board/admn/category/cat_write.php?ca_id=$row[ca_id]&page=$page");
					$s_upd = icon("수정", "/board/admn/category/cat_write.php?w=u&ca_id=$row[ca_id]&page=$page");
					$s_del = icon("삭제", "/board/admn/_proc/category/_cat_proc.php?w=d&ca_id=$row[ca_id]&URI=".urlencode('/board/admn/category/cat.php?page='.$page));
				}

				if(!empty($row["ca_subject"])) $ca_subject = " (".$row["ca_subject"].")";
				else $ca_subject = "";
				
				$list = $i%2;
				echo "
				<input type=hidden name='ca_id[$i]' value='$row[ca_id]'>
				<tr>
					<td class='h24'>$row[ca_id]</td>
					<td class='subject'>$s_level ".get_text($row[ca_name])." ".$ca_subject."</td>
					<td class='textcen'>".$row["ca_order"]."</td>
					<td class='textcen'>$s_upd $s_del $s_vie $s_add</td>
				</tr>";
			}

			if ($i == 0) {
				echo "<tr><td colspan=20 height=100 bgcolor='#ffffff' align=center><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
			}
			?>
		</table>
		<div class="page_group mt10">
			<div class='page_navi_box'>
				<ul>
					<?
					if($Count>0){
					//	$write_pages = str_replace("처음", "<img src='/board/admn/images/common/start_btn.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
					//	$write_pages = str_replace("이전", "<img src='/board/admn/images/common/prev_btn.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
					//	$write_pages = str_replace("다음", "<img src='/board/admn/images/common/next_btn.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
					//	$write_pages = str_replace("맨끝", "<img src='/board/admn/images/common/end_btn.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
						//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
						$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
						echo $write_pages;
					}
					?>
				</ul>
			</div>
		</div>
		<div class="mt5 btn_group"><button type="button" class="btn_a_b" onclick="cat_move('/board/admn/category/cat_write.php');">등 록</button></div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script>
function cat_move(loc){
	location.href = loc;
}
function form_ck(){
	var f = document.info_form;
	if(FormCheck(f) == true){
		f.submit();
	} else {
		return;
	}
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>