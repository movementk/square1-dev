<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);
$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$PageBlock   = 5;  //넘길 페이지 갯수
if(!$board_list_num) $board_list_num = 5;                     //게시판 게시글 수
if(!$list_type) $list_type = "thumbs";
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

$is_search = false;

if($sF && $sT){
	$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
	$is_search = true;
}

if($Category){
	$TotalSQL .= " and Category = '".$Category."' ";
	$is_search = true;
}

$TotalSQL.= "order by RegDate desc, Ref desc, ReLevel asc, ReStep asc";
$TotalResult = mysql_query($TotalSQL);
$TotalCount  = mysql_num_rows($TotalResult);

$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

$SQL = $TotalSQL." limit $from_record, $board_list_num";
$Result      = mysql_query($SQL);
$Count       = mysql_num_rows($Result);

$new_img = "&nbsp;<img src=\"/image/board_img/new_icon.gif\" align=\"absmiddle\" >";

$searchVal .= "&list_type=".$list_type."&board_list_num=".$board_list_num."&bd4=".$bd4."&bd5=".$bd5;

$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&category=".$category."&page=");
?>
<section class="notice press-list">
	<div class="section-content">
		<div class="search-form">
			<form name="search_form" action="" method="get">
				<div class="form-group">
					<select class="form-control" name="sT">
						<option value="Title">제목</option>
						<option value="Content" <?=$_GET["sT"]=="Content"?"selected":""?>>내용</option>
					</select>
					<label for="search-keyword" class="sr-only">검색어</label>
					<input id="search-keyword" type="text" class="form-control" name="sF" value="<?=$_GET['sF']?>">
				</div>
				<button type="submit" class="btn">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			</form>
		</div>
		<div class="table-wrap">
			<table class="table table-bordered notice-table">
				<thead>
					<tr>
						<th>번호</th>
						<th>제목</th>
						<th>작성일</th>
						<th>조회수</th>
					</tr>
				</thead>
				<tbody>
					<?
					$nsql = " select * from ".$mode." where Notice = '1' order by BoardIdx desc ";
					$nresult = sql_query($nsql);
					for($i=0;$nrow = sql_fetch_array($nresult);$i++){
						$Title = $nrow[Title];
						$Title = cut_string($Title, 120);
						$wdate = $nrow["RegDate"];
						$today		= date("Y-m-d H:i:s");
						$chk		= strtotime($today) - strtotime($wdate);			
						$chk_new	= (60 * 60 * 24) * 1;
						if(($chk_new - $chk)>0){
							$new_ck = true;
						}
						$auth_link = '<a href="'.$_SERVER["PHP_SELP"].'?board_code=board_view&board_idx='.$nrow["BoardIdx"].'&page='.$page.'&'.$searchVal.'">';
						$list_href = $auth_link;
						
						if($new_ck) echo $new_img;
						echo $secret_img;

						$nrow["files"] = get_file($mode,$nrow["BoardIdx"]);
						if($nrow["files"]["count"] > 0){
							$nrow["img"] = $nrow["files"][0]["path"]."/".$nrow["files"][0]["file_soruce"];
						} else {
							$nrow["img"] = "/assets/images/promotional/promote_no_img.jpg";
						}
					?>
					<tr>
						<td>[공지]</td>
						<td class="t-content"><?=$list_href.$Title?></a></td>
						<td class="date"><?=substr($nrow["RegDate"],0,10)?></td>
						<td><?=number_format($nrow["ReadNum"])?></td>
					</tr>
					<?
					}
					$num = $TotalCount - ($page-1)*$board_list_num;
					for($i=0;$row = sql_fetch_array($Result);$i++){
						$Title = $row[Title];
						$Title = cut_string($Title, 120);
						
						$str="";
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
							$secret_img = '<img style="margin-left:5px;" src="/images/community/icon_secret.gif" alt="Secret" />';
						} else {
							$secret_img = "";
						}

						$username = $row["UserName"];

						$auth_link = '<a href="'.$_SERVER["PHP_SELP"].'?board_code=board_view&board_idx='.$row["BoardIdx"].'&page='.$page.'&'.$searchVal.'">';
						$pwd_link = "<a href=\"javascript:pwd_ck('".$row[BoardIdx]."');\">";

						if($secret_img){
							if(!$is_admin && !$is_manager){
								if(!empty($row["UserID"]) && $member["UserID"] == $row["UserID"]) $list_href = $auth_link;
								else {
									$list_href = $pwd_link;
									$osql = " select * from ".$mode." where Ref = '".$row["Ref"]."' and ReLevel = 0 ";
									$orow = sql_fetch($osql);
									if($row["ReLevel"] > 0 && $member["UserID"] == $orow["UserID"]){
										$list_href = $auth_link;
										if($is_guest) $list_href = $pwd_link;
									}
								}
							} else {
								$list_href = $auth_link;
							}
						} else {
							$list_href = $auth_link;
						}

						$row["files"] = get_file($mode,$row["BoardIdx"]);
						if($row["files"]["count"] > 0){
							$row["img"] = $row["files"][0]["path"]."/".$row["files"][0]["file_source"];
						} else {
							$row["img"] = "/assets/images/promotional/promote_no_img.jpg";
						}
					?>
					<tr>
						<td><?=$num?></td>
						<td class="t-content"><?=$list_href?><?=$Title?></a></td>
						<td class="date"><?=substr($row["RegDate"],0,10)?></td>
						<td><?=number_format($row["ReadNum"])?></td>
					</tr>
					<?
						$num--;
					}

					if($Count == 0){ echo "<tr><td colspan='5' style='text-align:center;padding:100px 0px;'>게시물이 없습니다</td></tr>"; }
					?>
				</tbody>
			</table>
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
<script type="text/javascript">
function pwd_ck(idx){
	var f = document.list_form;
	f.board_code.value = "board_view";
	f.board_idx.value = idx;
	f.action = "<?=$_SERVER['PHP_SELF']?>";
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
