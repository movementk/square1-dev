<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$PageBlock   = 10;  //넘길 페이지 갯수
$board_list_num = 8;                     //게시판 게시글 수
$pagebt1=$loc."/image/board_img/first_btn.png";
$pagebt2=$loc."/image/board_img/prev_btn.png";
$pagebt3=$loc."/image/board_img/next_btn.png";
$pagebt4=$loc."/image/board_img/end_btn.png";
$fileURL = "../board/upload/".$BoardName."/";


$TotalSQL = "select * from ".$mode." where 1 ";

if($sF || $sT){
	if($sT == "Etc2"){
		$TotalSQL .= " AND Etc2 >= '".$y1."' and Etc2 <= '".$y2."' ";
	} else {
		$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
	}
}

if($Category){
	$TotalSQL .= " and Category = '".$Category."' ";
}

if(!empty($yorder)){
	$order_flag = 'Etc2';
	$order_type = $yorder;
}

if(empty($order_flag) && empty($order_type)){
	$order_flag = "RegDate";
	$order_type = "desc";
}

$TotalSQL.= "order by $order_flag $order_type";
$TotalResult = mysql_query($TotalSQL);
$TotalCount  = mysql_num_rows($TotalResult);

for($i=0;$row = sql_fetch_array($TotalResult);$i++){
	$list[$i] = $row;
}

$thmPath = $dir."/upload/".$BoardName."/thumbs/";

$dir_ck = is_dir($thmPath);

if($dir_ck != "1"){
	if(!@mkdir("$thmPath", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$thmPath", 0707)){ echo "퍼미션변경 실패"; exit;}
}

$thmPath2 = $dir."/upload/".$BoardName."/thumbs2/";

$dir_ck2 = is_dir($thmPath2);

if($dir_ck2 != "1"){
	if(!@mkdir("$thmPath2", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$thmPath2", 0707)){ echo "퍼미션변경 실패"; exit;}
}

$thmPath3 = $dir."/upload/".$BoardName."/thumbs3/";

$dir_ck3 = is_dir($thmPath3);

if($dir_ck3 != "1"){
	if(!@mkdir("$thmPath3", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$thmPath3", 0707)){ echo "퍼미션변경 실패"; exit;}
}

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
$mod = 2;

include_once($dir."/config/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$thumb_width = 129;
$thumb_height = 95;

?>
<script>
var uck = false;
function port_view(idx){
	var vck = $("#div_port").css("display");
	if(uck == false){
		jQuery.blockUI();
	}
	jQuery.ajax({
		url: "/board/config/ajax/ajax_libview.php",
		type: 'POST',
		data: "Idx=" + idx,

		error: function(xhr,textStatus,errorThrown){
			alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
		},
		success: function(data){
			$("#span_port").html(data);
			uck = true;
			if(vck == "none"){
				$("#div_port").animate({ opacity : "toggle" }, "slow");
			}
		}
	});
}
function port_close(){
	$("#div_port").animate({ opacity : "toggle" }, "slow");
	uck = false;
	jQuery.unblockUI();
}
</script>
<div class="library">
	<ul class="search2">
		<li>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="center">
						<form name="search_form" action="" method="get">
						<input type="hidden" name="workType" value="<?=$workType?>">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<select name="sT" class="input">
										<option value=''>선택</option>
										<option value="Title" <?=$_GET['sT']=="Title"?"selected":""?>>제목</option>
										<option value="Content" <?=$_GET['sT']=="Content"?"selected":""?>>발주처</option>
									</select>
									<input name="y1" type="text" id="year1" class="input" style="width:50px;height:15px;" value='<?=$y1?>'/>년도~
									<input name="y2" type="text" id="year2" class="input" style="width:50px;height:15px;" value='<?=$y2?>'/>년도
									<select name="yorder" class="input">
										<option value=''>선택</option>
										<option value="asc" <?=$yorder=='asc'?'selected':''?>>오름차순</option>
										<option value="desc" <?=$yorder=='desc'?'selected':''?>>내림차순</option>
									</select>
								</td>
								<td>&nbsp;</td>
								<td width="170px" class="search_bg">
									<input name="sF" type="text" id="sF" class="input_glass" size="20" value="<?=$_GET['sF']?>"/><input type="image" src="../image/board_img/search_btn.png" />
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</li>
	</ul>
	<ul class="list">
		<li>
			<table width="685" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="40" rowspan="5" align="left"><?=!empty($prev_page)?"<a href='".$_SERVER['PHP_SELF']."?Category=".urlencode($Category)."&page=".$prev_page."&cat=".$cat."'><img src='../image/portfolio_img/left_a.png' onmouseover='this.src=\"/image/portfolio_img/left_a_on.png\"' onmouseout='this.src=\"/image/portfolio_img/left_a.png\"'/></a>":""?></td>
					<td width="605" valign="top" height="400">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<?
								$num = $TotalCount - ($page-1)*$board_list_num;
								$j=0;
								for($i=0;$row = sql_fetch_array($Result);$i++){
									$Title = $row[Title];
									$Title = cut_string($Title, 75);

									if($i && $i % $mod == 0) echo "</tr><tr><td height='3' colspan='3'></td></tr><tr>";

									if($j > 0) echo "<td width='5'>&nbsp;</td>";
									
									$str="";
									$new_img = "";
									$wdate = $row["RegDate"];
									$today		= date("Y-m-d H:i:s");
									$chk		= strtotime($today) - strtotime($wdate);			
									$chk_new	= (60 * 60 * 24) * 1;
									if(($chk_new - $chk)>0){
									//	$new_img = "&nbsp;<img src=\"/images/bbs/icon_new.gif\" align=\"absmiddle\" >"; 
									}
									$c_sql = " select count(*) as cnt from ".$CommentName." where DBName = '".$mode."' and BoardIdx = '".$row[BoardIdx]."' ";
									$c_row = sql_fetch($c_sql);
									$Comment_count = $c_row[cnt];
									$img = "";

									$f_row = get_file($mode,$row["BoardIdx"]);
									switch($f_row[0][image_type]){
										case "1":
										case "2":
										case "3":
											$img_ck = true;
											if(file_exists($fileURL."/thumbs/".$f_row[0][file_source])){
												$img = "<img src='/board/upload/".$BoardName."/".$f_row[0][file_source]."' width='".$thumb_width."' height='".$thumb_height."' >";
											} else {
												$img = makeThumbs($fileURL, $f_row[0][file_source], $thumb_width, $thumb_height, "thumbs","");
											}
											break;
										case "6":
											$img_ck = true;
											$img = "<img src='/board/upload/".$BoardName."/".$f_row[0][file_source]."' width='".$thumb_width."' height='".$thumb_height."' >";
											break;
										default:
											$img = "<img src='/docs/image/common_img/noimg.gif'>";
									}

									$auth_link = '<a href="javascript:port_view(\''.$row[BoardIdx].'\')">';
									$pwd_link = "<a href=\"javascript:pwd_ck('".$row[BoardIdx]."');\">";

									$list_href = $auth_link;
								?>
								<td width="300" height="115" valign="top" class="list_box2">
									<table width="296" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="145" height="111" align="center"><?=$list_href.$img?></a></td>
											<td valign="middle">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="55" valign="top" class="box_text2"><img src="../image/board_img/title_11.png"/></td>
														<td class="box_text2"><?=$row[Etc1]?></td>
													</tr>
													<tr>
														<td valign="top" class="box_text2"><img src="../image/board_img/title_12.png"/></td>
														<td class="box_text2"><?=$row[Etc2]?></td>
													</tr>
													<tr>
														<td valign="top" class="box_text2"><img src="../image/board_img/title_13.png"/></td>
														<td class="box_text2"><?=$row[Link1]?></td>
													</tr>
													<tr>
														<td valign="top" class="box_text2"><img src="../image/board_img/title_14.png"/></td>
														<td class="box_text2"><?=$row[Link2]?></td>
													</tr>          
													<tr>
														<td valign="top" class="box_text2"><img src="../image/board_img/title_15.png"/></td>
														<td class="box_text2"><?=$Title?></td>
													</tr> 
													<tr>
														<td valign="top" class="box_text2"><img src="../image/board_img/title_16.png"/></td>
														<td class="box_text2"><?=$row[Content]?></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
								<?
								}
								/*/ 나머지 td 를 채운다.
								if (($cnt = $j%$mod) != 0)
									for ($l=$cnt; $l<$mod; $l++)
										echo "<td>&nbsp;</>\n";
								*/
								if($Count == 0){ echo "<td align='center' height=200>게시물이 없습니다.</tr>"; }
								?>
							</tr>
						</table>
					</td>
					<td width="40" rowspan="5" align="right"><?=!empty($next_page)?"<a href='".$_SERVER['PHP_SELF']."?Category=".urlencode($Category)."&page=".$next_page."&cat=".$cat."'><img src='../image/portfolio_img/right_a.png' onmouseover='this.src=\"/image/portfolio_img/right_a_on.png\"' onmouseout='this.src=\"/image/portfolio_img/right_a.png\"'/></a>":""?></td>
				</tr>
			</table>
		</li>
	</ul>
	<ul class="page_no">
		<li>
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
		</li>
	</ul>
</div>
