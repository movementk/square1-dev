<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
//$date_idx = $_REQUEST["date_idx"];
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$fileURL="../board/upload/".$BoardName."/";

if(empty($BoardIdx)) $BoardIdx = $_REQUEST["board_idx"];

$BoardViewSQL = "select * from ".$mode." where BoardIdx=".$BoardIdx;
$view = sql_fetch($BoardViewSQL);

$sql1 = "update ".$mode." set ReadNum=ReadNum+1 where BoardIdx=".$BoardIdx;
mysql_query($sql1);

//$q_next = "select BoardIdx, Title, RegDate from ".$mode." where ReLevel = 0 and BoardIdx>".$BoardIdx;
$q_next = "select BoardIdx, Title, RegDate from ".$mode." where ReLevel = 0 and RegDate > '".$view["RegDate"]."' ";
if($Category){
   $q_next .= " AND Category='".$Category."' ";
}
//$q_next .= " order by BoardIdx  limit 0,1";
$q_next .= " order by RegDate asc limit 0, 1 ";
$q_next_row = sql_fetch($q_next);

//$q_prev = "select BoardIdx, Title, RegDate from ".$mode." where ReLevel = 0 and BoardIdx<".$BoardIdx;
$q_prev = "select BoardIdx, Title, RegDate from ".$mode." where ReLevel = 0 and RegDate < '".$view["RegDate"]."' ";
if($Category){
   $q_prev .= " AND Category='".$Category."' ";
}
//$q_prev .= "  order by BoardIdx desc limit 0,1";
$q_prev .= " order by RegDate desc limit 0, 1 ";
$q_prev_row = sql_fetch($q_prev);

$view["files"] = get_file($mode,$BoardIdx);

if($is_member || $is_admin){
	$modify_link_in_view = "modify_chk(document.view_form);";
	$delete_link_in_view = "delete_chk();";
} else {
	$modify_link_in_view = "pwd_ck('".$view["BoardIdx"]."','board_write');";
	$delete_link_in_view = "pwd_ck('".$view["BoardIdx"]."','board_delete');";
}
$fstart = 1;

$searchVal .= "&list_type=".$list_type."&board_list_num=".$board_list_num."&bd4=".$bd4."&bd5=".$bd5;
?>
<section class="square1-event prizewinner-list event-view">
	<div class="section-header" style="padding-top:0px !important;">
		<h2 style="margin-bottom:40px !important;">스퀘어원의 이벤트 소식을<br class="visible-xs"> 한번에 보실 수 있습니다.</h2>
		<p>
			복합 문화 소비공간 스퀘어원만의<br class="visible-xs"> 다양한 이벤트를 경험해 보세요~
		</p>
	</div>
	<div class="section-content">
		<div class="event-img">
			<?
			if($view["HtmlChk"]=="Y"){
				$view["Content"] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' class='img-responsive' \\2 \\3", $view["Content"]);
				echo $view["Content"];
			} else {
				echo nl2br($view["Content"]);
			}
			?>
		</div>
		<? if($view["bd3"] == "Y"){ ?>
		<div class="event-form">
			<form name="write_form" method="post" action="/event/_proc_square1_event.php" onsubmit="return request_chk();"/>
			<input type="hidden" name="eidx" value="<?=$view["BoardIdx"]?>"/>
				<h3>개인정보취급방침</h3>
				<div class="privacy">
					<?=get_agree(2)?>
				</div>
				<label><input type="checkbox" id="agree11">동의합니다.</label>
				<h3>접수/응모란</h3>
				<div class="form-group">
					<dl>
						<dt><label for="u-name">이름</label></dt>
						<dd><input type="text" id="u-name" class="form-control exp" name="uname" title="이름"></dd>
						<dt>휴대폰번호</dt>
						<dd class="phone">
							<select class="form-control exp" name="phone1" title="휴대폰번호">
								<option value="">선택</option>
								<option value="010">010</option>
								<option value="011">011</option>
								<option value="016">016</option>
								<option value="016">018</option>
								<option value="019">019</option>
							</select>
							-
							<input type="text" id="phone-2" class="form-control exp" name="phone2" title="휴대폰번호"> -
							<label for="phone-2" class="sr-only">중간 번호</label>
							<input type="text" id="phone-3" class="form-control exp" name="phone3" title="휴대폰번호">
							<label for="phone-3" class="sr-only">마지막 번호</label>
						</dd>
						<dt class="dl-mb">참여일자</dt>
						<dd class="date dl-mb">
							<select class="form-control" name="er1">
								<option value="">선택하세요</option>
								<?
								$sdate = strtotime($view["bd4"]." 00:00:00");
								$edate = strtotime($view["bd5"]." 23:59:59");
								for($i=$sdate;$i<$edate;$i=$i+86400){
									echo "<option value='".date("Y-m-d",$i)."'>".date("Y년 m월 d일",$i)."</option>";
								}
								?>
							</select>
						</dd>
					</dl>
				</div>
				<div class="btn-area">
					<p class="btn-basic">
						<a href="event_identify01.php?idx=<?=$view["BoardIdx"]?>" class="btn-gray" role="button">참여 신청 내역 확인</a>
					</p>
					<p class="float-r">
						<button type="submit" class="btn btn-orange">응모하기</button>
						<a href="<?=$_SERVER["PHP_SELF"]?>" class="btn btn-default" role="button">취소</a>
					</p>
				</div>
			</form>
		</div>
		<? } ?>
		<?
		if($view["bd2"] < date("Y-m-d")){ // 지난이벤트라면
		?>
		<div class="event-form">
			<form name="searchForm" method="post" action="event_identify02.php" onsubmit="return write_chk();">
			<input type="hidden" name="workType" value="RS" />
				<h3>접수/응모확인</h3>
				<div class="form-group">
					<dl>
						<dt><label for="u-name">이벤트선택</label></dt>
						<dd>
							<?
							if($view["BoardIdx"]){
								echo "<span style='line-height:30px;'>".$view["Title"]."</span><input type='hidden' name='idx' value='".$view["BoardIdx"]."' />";
							}
							?>
						</dd>
						<dt><label for="u-name">이름</label></dt>
						<dd><input type="text" id="u-name" class="form-control exp" name="UserName" title="이름"></dd>
						<dt class="dl-mb">휴대폰번호</dt>
						<dd class="phone dl-mb">
							<select class="form-control exp" name="phone1" title="휴대폰번호">
								<option value="">선택</option>
								<option value="010">010</option>
								<option value="011">011</option>
								<option value="016">016</option>
								<option value="016">018</option>
								<option value="019">019</option>
							</select>
							-
							<input type="text" id="phone-2" class="form-control exp" name="phone2" title="휴대폰번호"> -
							<label for="phone-2" class="sr-only">중간 번호</label>
							<input type="text" id="phone-3" class="form-control exp" name="phone3" title="휴대폰번호">
							<label for="phone-3" class="sr-only">마지막 번호</label>
						</dd>
					</dl>
				</div>
				<div class="btn-area">
					<p class="float-r">
						<button type="submit" class="btn btn-orange">응모확인</button>
						<a href="/event/square1_event_list.php" class="btn btn-default" role="button">취소</a>
					</p>
				</div>
			</form>
		</div>
		<? } ?>
		<article class="content-view">
			<div class="article-content" style="margin-top:40px;border-top:1px solid #dfdfdf;">
				<div class="btn-area">
					<? if($view[UserID] == $user[ID] || $is_admin){ ?>
					<p>
						<a href="javascript:;" onclick="<?=$delete_link_in_view?>" class="btn-sm btn-default" role="button">삭제하기</a>
					</p>
					<? } ?>
					<p class="basic-btn">
						<a href="<?=$_SERVER['PHP_SELF']?>?board_code=board_list&page=<?=$page?>&<?=$searchVal?>" class="btn btn-gray" role="button">목록보기</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>