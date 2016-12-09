<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t106 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."category";
$fileURL = "../../upload/category/";

if(empty($w)) $w = "i";

if ($w == "i") 
{
    $len = strlen($ca_id);
    if ($len == 10) 
        alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

    $len2 = $len + 1;

    $sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from $mode
              where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
    $row = sql_fetch($sql);

    $subid = base_convert($row[max_subid], 36, 10);
    $subid += 36;
    if ($subid >= 36 * 36) 
    {
        //alert("분류를 더 이상 추가할 수 없습니다.");
        // 빈상태로
        $subid = "  ";
    }
    $subid = base_convert($subid, 10, 36);
    $subid = substr("00" . $subid, -2);
    $subid = $ca_id . $subid;

    $sublen = strlen($subid);

    if ($ca_id) // 2단계이상 분류
    { 
        $sql = " select * from $mode where ca_id = '$ca_id' ";
        $ca = sql_fetch($sql);
        $html_title = $ca[ca_name] . " 하위분류추가";
        $ca[ca_name] = "";
    } 
    else // 1단계 분류
    {
        $html_title = "1단계분류추가";
    }
} 
else if ($w == "u") 
{
    $sql = " select * from $mode where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
    if (!$ca[ca_id]) 
        alert("자료가 없습니다.");

    $html_title = $ca[ca_name] . " 수정";
    $ca[ca_name] = get_text($ca[ca_name]);
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">분류관리</div>
		<form name="fcategoryform" method="post" action="/board/admn/_proc/category/_cat_proc.php" enctype="multipart/form-data" onsubmit='return fcategoryformcheck(this);'>
		<input type="hidden" name="workType"	value="<?=$workType?>">
		<input type="hidden" name="codedup"		value="1">
		<input type="hidden" name="w"			value="<?=$w?>">
		<input type="hidden" name="page"		value="<?=$page?>">
		<input type="hidden" name="URI"			value="/board/admn/category/cat.php?page=<?=$page?>">
		<table class="write_table mt15">
			<tr>
				<th width="120">분류코드</th>
				<td>
					<? if ($w == "i") { ?>
						<input type=text class="input" id=ca_id name=ca_id itemname='분류코드' size='<?=$sublen?>' maxlength='<?=$sublen?>' value='<?=$subid?>'>
						<button type="button" class="btn_a_n" align="absmiddle" style="margin-left:10px;" onclick="codedupcheck(document.getElementById('ca_id').value)">코드검색</button>
					<? } else { ?>
						<input type=hidden name=ca_id value='<?=$ca[ca_id]?>'><?=$ca[ca_id]?>
						<button type="button" class="btn_a_n" align="absmiddle" style="width:100px;margin-left:10px;" onclick="document.location.href='<?=$_SERVER['PHP_SELF']?>?ca_id=<?=$ca_id?>'">하위메뉴 추가</button>
					<? } ?>
				</td>
			</tr>
			<tr>
				<th>분류명</th>
				<td>
					<input type="text" name="ca_name" style="width:200px" class="input" exp title="분류명" value="<?=$ca[ca_name]?>">&nbsp;
					<input type="text" name="ca_subject" style="width:200px" class="input" title="분류명(영문)" value="<?=$ca[ca_subject]?>">
					<span style="color:#e00000;font-weight:bold;">※ 추가분류명이 필요할 경우 두번째 입력상자에 입력하시기 바랍니다.</span>
				</td>
			</tr>
			<tr>
				<th>노출순서</th>
				<td><input type="text" name="ca_order" style="width:50px" class="input" exp num title="노출순서" value="<?=$ca[ca_order]?>"></td>
			</tr>
			<!--
			<?
			$cidx = "";
			$subfile = false;
			switch(substr($ca_id,0,2)){
				case "20":
				case "30":
					$subfile = true;
					break;
			}
			switch($w){
				case "i":
					if(strlen($ca_id) >= 2 && strlen($ca_id) <= 4){
						$cidx = $subid;
					}
					if(strlen($ca_id) == 6){
						$eidx = $subid;
					}
					break;
				case "u":
					if(strlen($ca_id) >= 4 && strlen($ca_id) <= 6){
						$cidx = $ca["ca_id"];
					}
					if(strlen($ca_id) == 8){
						$eidx = $ca["ca_id"];
					}
					break;
			}
			if($eidx){
			?>
			<tr>
				<th>분류설명</th>
				<td><input type="text" name="ca_subject" style="width:200px" class="input" exp title="분류설명" value="<?=$ca[ca_subject]?>"></td>
			</tr>
			<?
			}

			if($cidx){
				$files = get_file($mode,$cidx);
			?>
			<tr>
				<th>첨부파일</th>
				<td>
					<input type="file" name="bf_file[0]" value="" class="input" style="width:300px;">
					<? if($files[0][file_source]){ ?>
					&nbsp;<input type='checkbox' name='bf_file_del[0]' value='1'> <?=$files[0][file_name]?>삭제
					<?
						switch($files[0][image_type]){
							case "1":
							case "2":
							case "3":
								if(file_exists($fileURL."/".$files[0]["file_source"])){
									if($files[0][image_width] > 600) $fwidth = 600;
									else $fwidth = $files[0][image_width];
									echo "<br><img src='/board/upload/category/".$files[0]["file_source"]."' width='".$fwidth."' >";
								}
								break;
						}
					}
					?>
				</td>
			</tr>
			<?
			}
			if($subfile){
			?>
			<tr>
				<th>첨부파일2</th>
				<td>
					<input type="file" name="bf_file[1]" value="" class="input" style="width:300px;">
					<? if($files[1][file_source]){ ?>
					&nbsp;<input type='checkbox' name='bf_file_del[1]' value='1'> <?=$files[1][file_name]?>삭제
					<?
						switch($files[1][image_type]){
							case "1":
							case "2":
							case "3":
								if(file_exists($fileURL."/".$files[1]["file_source"])){
									if($files[1][image_width] > 600) $fwidth = 600;
									else $fwidth = $files[1][image_width];
									echo "<br><img src='/board/upload/category/".$files[1]["file_source"]."' width='".$fwidth."' >";
								}
								break;
						}
					}
					?>
				</td>
			</tr>
			<?
			}
			?>
			-->
		</table>
		<div class="mt5 btn_group"><button type="button" class="btn_a_b" onclick="this.form.submit();">저 장</button></div>
		
		</form>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script language='javascript'>
function fcategoryformcheck(f)
{
	if (f.w.value == "") {
		if (f.codedup.value == '1') {
			alert("코드 중복검사를 하셔야 합니다.");
			return false;
		}
	}

	if(FormCheck(f) == true){
		return true;
	} else {
		return false;
	}
}

function codedupcheck(id) 
{
    if (!id) {
        alert('분류코드를 입력하십시오.');
        f.ca_id.focus();
        return;
    }

    window.open("./codedupcheck.php?ca_id="+id+'&frmname=fcategoryform', "hiddenframe");
}

</script>
<?
include_once $dir."/admn/include/tail.php";
?>