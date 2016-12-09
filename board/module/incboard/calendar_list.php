<?
if (!function_exists("get_first_day")) {
	// mktime() 함수는 1970 ~ 2038년까지만 계산되므로 사용하지 않음
	// 참고 : http://phpschool.com/bbs2/inc_view.html?id=3924&code=tnt2&start=0&mode=search&s_que=mktime&field=title&operator=and&period=all
	function get_first_day($year, $month)
	{
		$day = 1;
		$spacer = array(0, 3, 2, 5, 0, 3, 5, 1, 4, 6, 2, 4);
		$year = $year - ($month < 3);
		$result = ($year + (int) ($year/4) - (int) ($year/100) + (int) ($year/400) + $spacer[$month-1] + $day) % 7;
		return $result;
	}
}
// 오늘
$today = getdate(time());

$year  = (int)substr($schedule_ym, 0, 4);
$month = (int)substr($schedule_ym, 4, 2);
if ($year  < 1)                $year  = $today[year];
if ($month < 1 || $month > 12) $month = $today[mon];
$current_ym = sprintf("%04d%02d", $year, $month);

$end_day = array(1=>31, 28, 31, 30 , 31, 30, 31, 31, 30 ,31 ,30, 31);
// 윤년 계산 부분이다. 4년에 한번꼴로 2월이 28일이 아닌 29일이 있다.
if( $year%4 == 0 && $year%100 != 0 || $year%400 == 0 )
	$end_day[2] = 29; // 조건에 적합할 경우 28을 29로 변경

// 해당월의 1일을 mktime으로 변경
$mktime = mktime(0,0,0,$month,1,$year);
$mkdate = getdate(strtotime(date("Y-m-1", $mktime)));

// 1일의 첫번째 요일 (0:일, 1:월 ... 6:토)
$first_day = get_first_day($year, $month);
// 해당월의 마지막 날짜,
$last_day  = $end_day[$month];

if ($month - 1 < 1) {
	$before_ym = sprintf("%04d%02d", ($year-1), 12);
} else {
	$before_ym = sprintf("%04d%02d", $year, ($month-1));
}

if ($month + 1 > 12) {
	$after_ym  = sprintf("%04d%02d", ($year+1), 1);
} else {
	$after_ym  = sprintf("%04d%02d", $year, ($month+1));
}

$fd = $year."-".$month."-01";
$ed = $year."-".$month."-".$last_day;

$month_e = date("F",strtotime($fd));

$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$fileURL="../board/upload/".$BoardName."/";

$PageBlock   = 10;  //넘길 페이지 갯수
$board_list_num = 7;                     //게시판 게시글 수
$pagebt1=$loc."/img/common/bullet_board_list_first.gif";
$pagebt2=$loc."/img/common/bullet_board_list_prev.gif";
$pagebt3=$loc."/img/common/bullet_board_list_next.gif";
$pagebt4=$loc."/img/common/bullet_board_list_end.gif";

if(isset($_REQUEST["page"]) && $page !=""){
	$page = $_REQUEST["page"];
}else{
	$page = 1;
}

if(isset($_REQUEST["start_page"]) && $_REQUEST["start_page"] != ""){
	$start_page  = $_REQUEST["start_page"]; 
} else {
	$start_page  = 0;
}

$start_for = ($PageBlock*$start_page)+1; //for문 처음 시작 수
$last_for  = ($start_for+$PageBlock)-1;  //for문 끝나는 수
$start_list_num = ($page - 1)*$board_list_num; //게시글 시작 번호

$TotalSQL = "select * from ".$mode." where 1 ";

if($sF && $sT){
	$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
}

//if($Category){
	$TotalSQL .= " and Category = '".$lan."' ";
//}

if($year && $month){
	if($day){
		$TotalSQL .= " and Sdate = '".$year."-".$month."-".$day."' ";
	} else {
		$TotalSQL .= " and Sdate >= '".$fd."' and Sdate <= '".$ed."' ";
	}
}

$TotalSQL.= "order by RegDate desc";
$SQL = $TotalSQL." limit ".$start_list_num.",".$board_list_num;

$TotalResult = mysql_query($TotalSQL);
$Result      = mysql_query($SQL);
$TotalCount  = mysql_num_rows($TotalResult);
$Count       = mysql_num_rows($Result);

$TotalPage   = $TotalCount/$board_list_num;
$TotalPage   = (int)$TotalPage;

if($TotalCount%$board_list_num != 0){
	$TotalPage++;
}

if($TotalPage >= $PageBlock){
	$last_page = ($TotalPage/$PageBlock)-1;
	$last_page   = (int)$last_page;

	if($TotalPage%$PageBlock != 0){
		$last_page++;
	}
} else {
	$last_page = 0;
}


$searchVal .= "&schedule_ym=$schedule_ym&day=$day";
?>
<!-- bbs -->

<form name="list_form" method="post">
<input type="hidden" name="BoardName" value="<?=$BoardName?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="returnpage" value="<?=$_SERVER['PHP_SELF']?>">
<input type="hidden" name="board_code" value="">
<input type="hidden" name="board_idx" value="">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="start_page" value="<?=$start_page?>">
<input type="hidden" name="Category" value="<?=$Category?>">
<input type="hidden" name="workType" value="<?=$workType?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="sT" value="<?=$sT?>">
<input type="hidden" name="sF" value="<?=$sF?>">
</form>
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
	<div id="contents">
		<ul id="event">
			<li class="event_date"><?=$month_e?> <?=$day?$day:""?>, <?=$year?></li>
			<li class="event_list">
				<?
				$num = $TotalCount - ($page-1)*$board_list_num;
				for($i=0;$row = sql_fetch_array($Result);$i++){
					$Title = $row[Title];
					$Title = cut_string($Title, 75);
					
					$str="";
					$new_img = "";
					$wdate = $row["RegDate"];
					$today		= date("Y-m-d H:i:s");
					$chk		= strtotime($today) - strtotime($wdate);			
					$chk_new	= (60 * 60 * 24) * 1;
					if(($chk_new - $chk)>0){
					//	$new_img = "&nbsp;<img src=\"/images/bbs/icon_new.gif\" align=\"absmiddle\" >"; 
					}
					$c_sql = " select * from ".$CommentName." where DBName = '".$BoardName."' and BoardIdx = '".$row[BoardIdx]."' ";
					$c_result = mysql_query($c_sql);
					$Comment_count = mysql_num_rows($c_result);
					$img = "";

					if($row[Secret] == 2){
						$secret_img = '<img style="margin-left:5px;" src="$loc/images/bbs/secret.gif" alt="비밀글" />';
					} else {
						$secret_img = "";
					}

				?>
				<div class="event_subject">
					<div class="event_con"><a href="<?=$_SERVER["PHP_SELP"]?>?board_code=board_view&board_idx=<?=$row["BoardIdx"]?>&page=<?=$page?>&start_page=<?=$start_page?>&<?=$searchVal?>"><?=$Title?></a></div>
					<div class="event_view" style="display:none;"  id="research_con<?=$row[BoardIdx]?>"><?=$row[Content]?></div>
				</div>
				<?
					$num--;
				}

				if($Count == 0){ echo "<tr><td colspan='7' height='100'>not existed</td></tr>"; }
				?>
			</li>
			<div id="event_page_num"><? if($Count>0){ include $dir.$configDir.'/user_paging.php';  }?></div>
		</ul>
		<div id="line_shadow"></div>
		<ul id="cld" style="padding-top:50px;">
			<li id="cld_title"><img src="<?=$loc?>/img/main/title_calendar.png" /></li>
			<li id="cld_left"></li>
			<li id="cld_load">
				<div id="cld_month">
					<ul>
						<li class="cld_arrow"><a href="<?=$_SERVER['PHP_SELF']?>?schedule_ym=<?=$before_ym?>"><img src="<?=$loc?>/img/main/callendar_btn_prev.gif" /></a></li>
						<li class="cld_month_no"><?=$month_e?></li>
						<li class="cld_year"><?=$year?></li>
						<li class="cld_arrow"><a href="<?=$_SERVER['PHP_SELF']?>?schedule_ym=<?=$after_ym?>"><img src="<?=$loc?>/img/main/callendar_btn_next.gif" /></a></li>
					</ul>
				</div>
				<div id="cld_day">
					<ul>
						<li class="sun">S</li>
						<li class="week">M</li>
						<li class="week">T</li>
						<li class="week">W</li>
						<li class="week">T</li>
						<li class="week">F</li>
						<li class="sat">S</li>
					</ul>
					<?
					$csql = " select * from ".$site_prefix."board_calendar where 1=1 and Category = '".$lan."' and Sdate >= '".$fd."' and Sdate <= '".$ed."' order by Sdate desc ";
					$cresult = sql_query($csql);
					for($m=0;$crow = sql_fetch_array($cresult);$m++){
						$clist[$m] = $crow;
						$cday[] = intval(date("d",strtotime($crow[Sdate])));

					}

					if($cday) $cday = array_unique($cday);


					$cnt = $day = 0;
					for ($i=0; $i<6; $i++) {
						echo "<ul>";
						for ($k=0; $k<7; $k++) {
							$cnt++;
							
							if($k == 0) $day_class = "sun";
							else if ($k == 6) $day_class = "sat";
							else $day_class = "";
							echo "<li ";

							if ($cnt > $first_day) {
								$day++;
								if ($day <= $last_day) {
									$current_ymd = $current_ym . sprintf("%02d", $day);

									if(count($cday) > 0 && in_array($day,$cday) == true){
										if($month == date("m",time())){
											if($day >= date("d",time())){
												$day_class = "holi";
											} else {
												$day_class = "holi";
											}
										} else if($month > date("m",time())){
											$day_class = "holi";
										}
										$linkck = true;
									} else {
										$linkck = false;
									}
									
									if($linkck) echo "onclick=\"javascript:location.href='".$_SERVER['PHP_SELF']."?schedule_ym=".$schedule_ym."&workType=calendar&day=".$day."';\" style='cursor:pointer;' class='".$day_class."'>".$day;
									else echo " class='".$day_class."'>".$day;
								} else {
									echo ">";
								}
							} else {
								echo ">";
							}

							echo "</li>";
						}
						echo "</ul>\n";
						if($day >= $last_day)
							break;
					}
					?>
				</div>
			</li>
			<li id="cld_right"></li>
		</ul>
	</div>
</div>
<div style="clear:both;"></div>
<script type="text/javascript">
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
function research_view(idx){
	/*
	if(document.getElementById('research_con'+idx).style.display == "none"){
		document.getElementById('research_con'+idx).style.display = 'block';
	} else {
		document.getElementById('research_con'+idx).style.display = 'none';
	}
	*/
	$(document).ready(function(){
		$("#research_con"+idx).slideToggle("slow");
	});
}
function pwd_ck(idx){
	var f = document.list_form;
	f.board_code.value = "board_view";
	f.board_idx.value = idx;
	f.action = loc+"/board/module/incboard/password.php";
	f.submit();
}
function all_checked(sw) {
    var f = document.list_form;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_idx[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str) {
    var f = document.list_form;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_idx[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function list_del() {
    var f = document.list_form;

    str = "삭제";
    if (!check_confirm(str))
        return;

    if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
        return;

    f.action = loc+"/board/config/delete_all.php";
    f.submit();
}
</script>


<!-- Contents 끝 -->
<div id="pop_memo" style="width:85px;display:none;position:absolute;left:0;top:0;">
<form name="memo_form" method="post">
<input type="hidden" name="uname">
<input type="hidden" name="tn">
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="border: 2px solid #ababab;">
	<tr>
		<td style="padding:10px;"><a href="#" onClick="javascript:pop_memo();" >쪽지보내기</a></td>
	</tr>
</table>
<script>
function pop_memo(){
	var form = document.memo_form;
	window.open('/members/popup_note.php','memos', 'left=50,top=50,width=820,height=400,scrollbars=yes');
	form.target = "memos";
	form.action = "/members/popup_note.php?tn="+form.tn.value;
	form.submit();
}
</script>
</div>