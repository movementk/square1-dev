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
	if($sT == "Etc1"){
		$TotalSQL .= " AND Etc1 >= '".$y1."' and Etc1 <= '".$y2."' ";
	} else {
		$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
	}
}

if($Category){
	$TotalSQL .= " and Category = '".$Category."' ";
}

if(!empty($yorder)){
	$order_flag = 'Etc1';
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


$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

$SQL = $TotalSQL." limit $from_record, $board_list_num";
$Result      = mysql_query($SQL);
$Count       = mysql_num_rows($Result);

$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&start_page=0&category=".$category."&page=");
$mod = 2;

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

include_once($dir."/config/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$thumb_width = 74;
$thumb_height = 103;

?>
<script>
var uck = false;
function st_sel(val){
	if(val == "Etc1"){
		$("#search_txt").html("<input name='y1' type='text' class='input' size='4' value='<?=$y1?>'/>년도~ <input name='y2' type='text' class='input' size='4' value='<?=$y2?>'/>년도<select name='yorder' class='input'><option value='asc'>오름차순</option><option value='desc' <?=$yorder=='desc'?'selected':''?>>내림차순</option></select>");
	} else {
		$("#search_txt").html("");
	}
}
function port_view(idx){
	var vck = $("#div_port").css("display");
	if(uck == false){
		jQuery.blockUI();
	}
	jQuery.ajax({
		url: "/board/config/ajax/ajax_portview.php",
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
<div class="portfolio">
	<ul class="search">
		<li>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="center">
						<form name="search_form" action="" method="get">
						<input type="hidden" name="workType" value="<?=$workType?>">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<select name="sT" class="input" onchange="st_sel(this.value);">
										<option value=''>선택</option>
										<option value="Etc1" <?=$_GET['sT']=="Etc1"?"selected":""?>>제작년도</option>
										<option value="Title" <?=$_GET['sT']=="Title"?"selected":""?>>제목</option>
										<option value="Content" <?=$_GET['sT']=="Content"?"selected":""?>>발주처</option>
									</select>
									<span id="search_txt">
									<input name="y1" type="text" id="year1" class="input" size="4"  value='<?=$y1?>'/>년도~
									<input name="y2" type="text" id="year2" class="input" size="4"  value='<?=$y2?>'/>년도
									<select name="yorder" class="input">
										<option value="오름차순">오름차순</option>
										<option value="내림차순" <?=$yorder=='desc'?'selected':''?>>내림차순</option>
									</select>
									</span>
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
			<div id="port" class="sliderkit carousel-demo1">
				<div class="sliderkit-nav">
					<div class="sliderkit-nav-clip">
						<ul>
							<?
							$tk=0;
							for($i=0;$i<$total_page;$i++){
								$fl = $board_list_num * $i;
								$el = $board_list_num * intval($i+1);
							?>
							<li>
								<table width="605" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<?
										$k=0;
										for($j=$fl;$j<$el;$j++){
											if(empty($list[$j][BoardIdx])) continue;
											$img_ck = false;
											if($j && $j%$mod==0){
												$k = 0;
												if($tk > 1){
													$tk = 0;
												} else {
													echo "</tr><tr><td height='3' colspan='3'></td></tr><tr>";
													$tk++;
												}
											}
											if($k > 0) echo "<td width='5'>&nbsp;</td>";
											$Title = $list[$j][Title];
											$Title = cut_string($Title, 70);
											$content = cut_string($list[$j][Content],10000);
											$str="";
											$new_img = "";
											$wdate = $list[$j]["RegDate"];
											$today		= date("Y-m-d H:i:s");
											$chk		= strtotime($today) - strtotime($wdate);
											$chk_new	= (60 * 60 * 24) * 7;
											if(($chk_new - $chk)>0){
												$new_img = "<img src=\"../image/board_img/new_icon.gif\" align=\"absmiddle\" >"; 
											}

											$f_row = get_file($mode,$list[$j]["BoardIdx"]);
											if($f_row[0][image_type]=="1" || $f_row[0][image_type]=="2" || $f_row[0][image_type]=="3" || $f_row[0][image_type]=="6"){
												$img_ck = true;
												$img = makeThumbs($fileURL, $f_row[0][file_source], $thumb_width, $thumb_height, "thumbs","");
											} else {
												$img = "<img src='/images/main/story_noimg.jpg'>";
											}

											$auth_link = '<a href="javascript:port_view(\''.$list[$j][BoardIdx].'\')">';
											$pwd_link = "<a href=\"javascript:pwd_ck('".$list[$j][BoardIdx]."');\">";

											if($secret_img){
												if(!$is_admin){
													if(!empty($list[$j][UserID]) && $user[ID] == $list[$j][UserID]) $list_href = $auth_link;
													else $list_href = $pwd_link;
												} else {
													$list_href = $auth_link;
												}
											} else {
												$list_href = $auth_link;
											}
										?>
										<td width="300" height="122" valign="top" class="list_box">
											<table width="296" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td width="87" height="118" align="center"><?=$list_href.$img?></a></td>
													<td valign="top">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td width="55" valign="top" class="box_text"><img src="../image/board_img/title.png"/></td>
																<td class="box_text"><?=$Title?></td>
															</tr>
															<tr>
																<td valign="top" class="box_text"><img src="../image/board_img/title_02.png"/></td>
																<td class="box_text"><?=$list[$j][Etc1]?></td>
															</tr>
															<tr>
																<td valign="top" class="box_text"><img src="../image/board_img/title_03.png"/></td>
																<td class="box_text"><?=$list[$j][Content]?></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<?
											$k++;
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
							</li>
							<? } ?>
						</ul>
					</div>
					<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev"><a href="#" title="Scroll to the left"><img src='/image/portfolio_img/left_a.png'></a></div>
					<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next"><a href="#" title="Scroll to the right"><img src='/image/portfolio_img/right_a.png'></a></div>
				</div>
			</div>
		</li>
	</ul>
</div>
