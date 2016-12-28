<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/board/config/use_db.php');
$mode = $site_prefix."board_store";
$BoardName = "store";
$fileURL = "../board/upload/".$BoardName."/";
$startnum = $page * 6;

if($sF){
	switch($sF){
		case "name":
			$sql_common = " and Title like '%".$sT."%' ";
			break;
		case "number":
			$sql_common = " and bd2 like '%".$sT."%' ";
			break;
	}
} else {
	if($sT){
		$sql_common = " and (Title like '%".$sT."%' or bd2 like '%".$sT."%') ";
	}
}
if($Category){
	$sql_common .= " and Category = '".$Category."' ";
}

if($bd1){
	$bd1 = substr($bd1,1);
	$sql_common .= " and bd1 = '".$bd1."' ";
}

$thmPath = $dir."/upload/".$BoardName."/thumbs/";

$dir_ck = is_dir($thmPath);

if($dir_ck != "1"){
	if(!@mkdir("$thmPath", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$thmPath", 0707)){ echo "퍼미션변경 실패"; exit;}
}

include_once($dir."/config/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$thumb_width = 198;
$thumb_height = 80;

$sql = " select * from ".$site_prefix."board_store where Category != '퇴점' $sql_common order by BoardIdx desc limit ".$startnum.", 6 ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$row["files"] = get_file($mode,$row["BoardIdx"]);
	switch($row["files"][0][image_type]){
		case 1:
		case 2:
		case 3:
			if(file_exists($fileURL."/thumbs/".$row["files"][0][file_source])){
				$row["img"] = "<img src='/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source]."' class='img-responsive' >";
			} else {
				if($row["files"][0]["image_width"] <= $thumb_width && $row["files"][0]["image_height"] <= $thumb_height){
					$row["img"] = "<img src='/board/upload/".$BoardName."/".$row["files"][0][file_source]."' class='img-responsive'>";
				} else {
					$row["img"] = makeThumbs($fileURL, $row["files"][0][file_source], $thumb_width, $thumb_height, $thmPath,"");
					$row["img"] = "<img src='/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source]."' class='img-responsive' >";
				}
			}
			break;
		case 6:
			$row["img"] = "<img src='".$row["files"][0]["path"]."/thumbs/".$row["files"][0][file_source]."' class='img-responsive'>";
			break;
		default:
			$row["img"] = "<img src='/assets/images/introduce/brand_logo01.jpg' class='img-responsive'/>";
	}

	switch($row["bd1"]){
		case "0":
			$floor = "B1";
			break;
		case "1":
		case "2":
		case "3":
		case "4":
		case "5":
		case "6":
		case "7":
			$floor = $row["bd1"]."F";
			break;
	}
?>
<li class="col-xs-12 col-sm-6">
	<div class="category-item">
		<div class="row">
			<div class="col-xs-6">
				<div class="figure">
					<p>
						<?=$row["img"]?>
					</p>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="details">
					<dl>
						<dt><?=$row["Title"]?></dt>
						<dd class="c-tel">
							<i class="icon-phone"></i>
							<? if($is_mobile){ ?>
							<a href="tel:<?=$row["bd2"]?>"><?=$row["bd2"]?></a>
							<? } else { ?>
							<?=$row["bd2"]?>
							<? } ?>
						</dd>
						<dd class="c-clock">
							<i class="icon-clock"></i><?=$row["bd3"]?>
						</dd>
						<dd class="c-floor">
							<i class="icon-location"></i><?=$floor?>
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</li>
<?
}
?>