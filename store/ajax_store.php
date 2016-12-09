<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/board/config/use_db.php');

$startnum = $page * 6;

if($sF){
	switch($sF){
		case "name":
			$sql_common = " and (Title like '%".$sT."%' or bd5 like '%".$sT."%') ";
			break;
		case "number":
			$sql_common = " and bd6 like '%".$sT."%' ";
			break;
	}
} else {
	if($sT){
		$sql_common = " and (Title like '%".$sT."%' or bd5 like '%".$sT."%' or bd6 like '%".$sT."%') ";
	}
}

if($Category){
	$sql_common .= " and Category = '".$Category."' ";
}

if($bd4){
	$bd4 = substr($bd4,1);
	$sql_common .= " and bd4 = '".$bd4."' ";
}

$sql = " select * from ".$site_prefix."board_store where Category != '퇴점' $sql_common order by BoardIdx desc limit ".$startnum.", 6 ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$row["files"] = get_file($mode,$row["BoardIdx"]);
	switch($row["files"][0][image_type]){
		case "1":
		case "2":
		case "3":
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
		case "6":
			$row["img"] = "<img src='".$row["files"][0]["path"]."/thumbs/".$row["files"][0][file_source]."' class='img-responsive'>";
			break;
		default:
			$row["img"] = "<img src='/assets/images/introduce/brand_logo01.jpg' class='img-responsive'/>";
	}

	switch($row["bd4"]){
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
			$floor = $row["bd4"]."F";
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
							<a href="tel:<?=$row["bd6"]?>"><?=$row["bd6"]?></a>
						</dd>
						<dd class="c-clock">
							<i class="icon-clock"></i><?=$row["bd7"]?>
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