<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t107 = "navi_mon";
$left = "l1";
$fileURL = "../../upload/category/";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

if(empty($workType)) $workType = "HI";

switch($workType){
	case "HI":
	case "HM":
		$t01 = "<b>";
		$mode = $site_prefix."hollyday";
		$sql = " select * from ".$mode." where idx = '".$idx."' ";
		$row = sql_fetch($sql);
		break;
	case "CI":
	case "CM":
		$t02 = "<b>";
		$mode = $site_prefix."charge";
		$sql = " select * from ".$mode." where idx = '".$idx."' ";
		$row = sql_fetch($sql);
		$row["files"] = get_file($mode,$idx);
		$mon_array = explode("|",$row["mon_time"]);
		$tue_array = explode("|",$row["tue_time"]);
		$wed_array = explode("|",$row["wed_time"]);
		$thu_array = explode("|",$row["thu_time"]);
		$fri_array = explode("|",$row["fri_time"]);
		
		$mon_array2 = explode("|",$row["mon_day"]);
		$tue_array2 = explode("|",$row["tue_day"]);
		$wed_array2 = explode("|",$row["wed_day"]);
		$thu_array2 = explode("|",$row["thu_day"]);
		$fri_array2 = explode("|",$row["fri_day"]);
		break;
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">예약관련 설정</div>
		<div class="pb10">
			<a href="<?=$_SERVER['PHP_SELF']?>?workType=HI"><?=$t01?>[휴일 설정]</b></a>&nbsp;&nbsp;
			<a href="<?=$_SERVER['PHP_SELF']?>?workType=CI"><?=$t02?>[의료진 설정]</b></a>&nbsp;&nbsp;
		</div>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?
			switch($workType){
				case "HI":
				case "HM":
			?>
			<tr>
				<td width="100%" valign="top">
					<form name="hollyday_form" method="post" action="/board/admn/_proc/setup/_admin_proc.php">
					<input type="hidden" name="workType" value="<?=$workType?>">
					<input type="hidden" name="idx" value="<?=$row["idx"]?>">
					<input type="hidden" name="URI" value="<?=$_SERVER['PHP_SELF']?>?workType=HI">
					<div class="con_title_sub">휴일 설정</div>
					<table class="write_table">
						<colgroup>
							<col style="width:120px;"></col>
							<col></col>
						</colgroup>
						<tbody>
						<tr>
							<th><label>날짜</label></th>
							<td><input type="text" class="input datepick" name="cdate" exp title="날짜" value="<?=$row["cdate"]?>"></td>
						</tr>
						<tr>
							<th><label>휴일명</label></th>
							<td><input type="text" class="input" name="cname" exp title="휴일명" value="<?=$row["cname"]?>"></td>
						</tr>
						</tbody>
					</table>

					<div class="btn_group">
						<button type="button" class="btn_a_b" onclick="form_ck('hollyday');"><?=$workType=="HI"?"등 록":"수 정"?></button>
					</div>
					</form>

					<table class="list_table mt15">
						<colgroup>
							<col width="15%">
							<col width="">
							<col width="15%">
						</colgroup>
						<thead>
						<tr>
							<th>날짜</th>
							<th>휴일명</th>
							<th>관리</th>
						</tr>
						</thead>
						<tbody>
						<?
						$sql = " select * from ".$site_prefix."hollyday where 1=1 order by cdate desc ";
						$result = sql_query($sql);
						for($i=0;$row = sql_fetch_array($result);$i++){
						?>
						<tr>
							<td><?=$row["cdate"]?></td>
							<td><?=$row["cname"]?></td>
							<td>
								<div class="floatL pt5" style="width:100%;"><button type="button" class="mbtn_a_n" onclick="modify('HM','<?=$row["idx"]?>');">수 정</button></div>
								<div class="floatL pt5 pb5" style="width:100%;"><button type="button" class="mbtn_a_b" onclick="modify('HD','<?=$row["idx"]?>');">삭 제</button></div>
							</td>
						</tr>
						<? } ?>
						</tbody>
					</table>
					</form>
				</td>
			</tr>
			<?
					break;
				case "CI":
				case "CM":
			?>
			<tr>
				<td width="100%" valign="top">
					<form name="charge_form" method="post" action="/board/admn/_proc/setup/_admin_proc.php" enctype="MULTIPART/FORM-DATA">
					<input type="hidden" name="workType" value="<?=$workType?>">
					<input type="hidden" name="idx" value="<?=$row["idx"]?>">
					<input type="hidden" name="URI" value="<?=$_SERVER['PHP_SELF']?>?workType=CI">
					<div class="con_title_sub">의료진 설정</div>
					<table class="write_table">
						<colgroup>
							<col style="width:120px;"></col>
							<col></col>
						</colgroup>
						<tbody>
						<tr>
							<th><label>진료과</label></th>
							<td><input type="text" class="input" name="part" exp title="진료과" value="<?=$row["part"]?>"></td>
						</tr>
						<tr>
							<th><label>이름</label></th>
							<td><input type="text" class="input" name="name" exp title="이름" value="<?=$row["name"]?>"></td>
						</tr>
						<!--tr>
							<th><label>비고</label></th>
							<td><input type="text" class="input" name="etc" title="비고" style="width:600px;" value="<?=$row["etc"]?>"></td>
						</tr-->
						<tr>
							<th><label>첨부파일</label></th>
							<td>
								<input type="file" name="bf_file[0]" value="" class="input" style="width:300px;">
								<? if($row["files"][0][file_source]){ ?>
								&nbsp;<input type='checkbox' name='bf_file_del[0]' value='1'> <?=$row["files"][0][file_name]?>삭제
								<?
								switch($row["files"][0][image_type]){
									case "1":
									case "2":
									case "3":
										if(file_exists($fileURL."/".$row["files"][0]["file_source"])){
											echo "<br><img src='/board/upload/category/".$row["files"][0]["file_source"]."' width='65' height='65' >";
										}
										break;
								}
								}
								?>
						</tr>
						<tr>
							<td colspan="2"><span style="color:#e00000;font-weight:bold;">※ 이미지사이즈는 90 x 120 입니다.</span></td>
						</tr>
						<tr>
							<th><label>진료시간</label></th>
							<td>
								<div style="width:100%;">
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">월요일</li>
										<li style="float:left;"><input type="checkbox" name="mon_day[]" value="오전" <?=in_array("오전",$mon_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전</li>
										<li style="float:left;"><input type="checkbox" name="mon_day[]" value="오후" <?=in_array("오후",$mon_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">화요일</li>
										<li style="float:left;"><input type="checkbox" name="tue_day[]" value="오전" <?=in_array("오전",$tue_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전</li>
										<li style="float:left;"><input type="checkbox" name="tue_day[]" value="오후" <?=in_array("오후",$tue_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">수요일</li>
										<li style="float:left;"><input type="checkbox" name="wed_day[]" value="오전" <?=in_array("오전",$wed_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전</li>
										<li style="float:left;"><input type="checkbox" name="wed_day[]" value="오후" <?=in_array("오후",$wed_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">목요일</li>
										<li style="float:left;"><input type="checkbox" name="thu_day[]" value="오전" <?=in_array("오전",$thu_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전</li>
										<li style="float:left;"><input type="checkbox" name="thu_day[]" value="오후" <?=in_array("오후",$thu_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">금요일</li>
										<li style="float:left;"><input type="checkbox" name="fri_day[]" value="오전" <?=in_array("오전",$fri_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전</li>
										<li style="float:left;"><input type="checkbox" name="fri_day[]" value="오후" <?=in_array("오후",$fri_array2)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후</li>
									</ul>
								</div>
							</td>
						</tr>
						<!--tr>
							<th><label>진료시간</label></th>
							<td>
								<div style="width:100%;">
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">월요일</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오전 09:00" <?=in_array("오전 09:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오전 09:30" <?=in_array("오전 09:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:30</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오전 10:00" <?=in_array("오전 10:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오전 10:30" <?=in_array("오전 10:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:30</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오전 11:00" <?=in_array("오전 11:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오전 11:30" <?=in_array("오전 11:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:30</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 12:00" <?=in_array("오후 12:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 12:30" <?=in_array("오후 12:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:30</li>
									</ul>
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-left:46px;">&nbsp;</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 02:00" <?=in_array("오후 02:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 02:30" <?=in_array("오후 02:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:30</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 03:00" <?=in_array("오후 03:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 03:30" <?=in_array("오후 03:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:30</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 04:00" <?=in_array("오후 04:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 04:30" <?=in_array("오후 04:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:30</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 05:00" <?=in_array("오후 05:00",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:00</li>
										<li style="float:left;"><input type="checkbox" name="mon_time[]" value="오후 05:30" <?=in_array("오후 05:30",$mon_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:30</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">화요일</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오전 09:00" <?=in_array("오전 09:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오전 09:30" <?=in_array("오전 09:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:30</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오전 10:00" <?=in_array("오전 10:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오전 10:30" <?=in_array("오전 10:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:30</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오전 11:00" <?=in_array("오전 11:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오전 11:30" <?=in_array("오전 11:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:30</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 12:00" <?=in_array("오후 12:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 12:30" <?=in_array("오후 12:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:30</li>
									</ul>
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-left:46px;">&nbsp;</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 02:00" <?=in_array("오후 02:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 02:30" <?=in_array("오후 02:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:30</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 03:00" <?=in_array("오후 03:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 03:30" <?=in_array("오후 03:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:30</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 04:00" <?=in_array("오후 04:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 04:30" <?=in_array("오후 04:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:30</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 05:00" <?=in_array("오후 05:00",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:00</li>
										<li style="float:left;"><input type="checkbox" name="tue_time[]" value="오후 05:30" <?=in_array("오후 05:30",$tue_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:30</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">수요일</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오전 09:00" <?=in_array("오전 09:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오전 09:30" <?=in_array("오전 09:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:30</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오전 10:00" <?=in_array("오전 10:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오전 10:30" <?=in_array("오전 10:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:30</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오전 11:00" <?=in_array("오전 11:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오전 11:30" <?=in_array("오전 11:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:30</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 12:00" <?=in_array("오후 12:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 12:30" <?=in_array("오후 12:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:30</li>
									</ul>
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-left:46px;">&nbsp;</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 02:00" <?=in_array("오후 02:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 02:30" <?=in_array("오후 02:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:30</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 03:00" <?=in_array("오후 03:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 03:30" <?=in_array("오후 03:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:30</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 04:00" <?=in_array("오후 04:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 04:30" <?=in_array("오후 04:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:30</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 05:00" <?=in_array("오후 05:00",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:00</li>
										<li style="float:left;"><input type="checkbox" name="wed_time[]" value="오후 05:30" <?=in_array("오후 05:30",$wed_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:30</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">목요일</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오전 09:00" <?=in_array("오전 09:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오전 09:30" <?=in_array("오전 09:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:30</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오전 10:00" <?=in_array("오전 10:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오전 10:30" <?=in_array("오전 10:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:30</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오전 11:00" <?=in_array("오전 11:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오전 11:30" <?=in_array("오전 11:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:30</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 12:00" <?=in_array("오후 12:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 12:30" <?=in_array("오후 12:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:30</li>
									</ul>
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-left:46px;">&nbsp;</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 02:00" <?=in_array("오후 02:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 02:30" <?=in_array("오후 02:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:30</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 03:00" <?=in_array("오후 03:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 03:30" <?=in_array("오후 03:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:30</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 04:00" <?=in_array("오후 04:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 04:30" <?=in_array("오후 04:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:30</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 05:00" <?=in_array("오후 05:00",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:00</li>
										<li style="float:left;"><input type="checkbox" name="thu_time[]" value="오후 05:30" <?=in_array("오후 05:30",$thu_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:30</li>
									</ul>
									<ul style="float:left;padding-top:10px;width:100%;">
										<li style="float:left;padding-top:3px;padding-right:15px;">금요일</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오전 09:00" <?=in_array("오전 09:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오전 09:30" <?=in_array("오전 09:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 09:30</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오전 10:00" <?=in_array("오전 10:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오전 10:30" <?=in_array("오전 10:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 10:30</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오전 11:00" <?=in_array("오전 11:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오전 11:30" <?=in_array("오전 11:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오전 11:30</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 12:00" <?=in_array("오후 12:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 12:30" <?=in_array("오후 12:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 12:30</li>
									</ul>
									<ul style="float:left;width:100%;">
										<li style="float:left;padding-left:46px;">&nbsp;</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 02:00" <?=in_array("오후 02:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 02:30" <?=in_array("오후 02:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 02:30</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 03:00" <?=in_array("오후 03:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 03:30" <?=in_array("오후 03:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 03:30</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 04:00" <?=in_array("오후 04:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 04:30" <?=in_array("오후 04:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 04:30</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 05:00" <?=in_array("오후 05:00",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:00</li>
										<li style="float:left;"><input type="checkbox" name="fri_time[]" value="오후 05:30" <?=in_array("오후 05:30",$fri_array)?"checked":""?>></li>
										<li style="float:left;padding-top:3px;padding-right:5px;">오후 05:30</li>
									</ul>
								</div>
							</td>
						</tr-->
						</tbody>
					</table>

					<div class="btn_group">
						<button type="button" class="btn_a_b" onclick="form_ck('charge');"><?=$workType=="CI"?"등 록":"수 정"?></button>
					</div>
					</form>

					<table class="list_table mt15">
						<colgroup>
							<col width="15%">
							<col width="15%">
							<col width="">
							<col width="15%">
						</colgroup>
						<thead>
						<tr>
							<th>진료과</th>
							<th>이름</th>
							<th>비고</th>
							<th>관리</th>
						</tr>
						</thead>
						<tbody>
						<?
						$sql = " select * from ".$site_prefix."charge where 1=1 order by idx asc ";
						$result = sql_query($sql);
						for($i=0;$row = sql_fetch_array($result);$i++){
						?>
						<tr>
							<td><?=$row["part"]?></td>
							<td><?=$row["name"]?></td>
							<td><?=$row["etc"]?></td>
							<td>
								<div class="floatL pt5" style="width:100%;"><button type="button" class="mbtn_a_n" onclick="modify('CM','<?=$row["idx"]?>');">수 정</button></div>
								<div class="floatL pt5 pb5" style="width:100%;"><button type="button" class="mbtn_a_b" onclick="modify('CD','<?=$row["idx"]?>');">삭 제</button></div>
							</td>
						</tr>
						<? } ?>
						</tbody>
					</table>
					</form>
				</td>
			</tr>
			<?
					break;
			}
			?>
		</table>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script>
function modify(type,val){
	var f = document.info_form;
	switch(type){
		case "HD":
			f = document.hollyday_form;
			break;
		case "CD":
			f = document.charge_form;
			break;
	}
	if(type == "HD" || type == "CD" || type == "TD"){
		if(!confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 삭제하시겠습니까?")){
			return;
		}
		f.idx.value = val;
		f.workType.value = type;
		f.submit();
	} else {
		location.href = "<?=$_SERVER['PHP_SELF']?>?workType="+type+"&idx="+val;
	}
}
function form_ck(fname){
	var f = eval("document."+fname+"_form");
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