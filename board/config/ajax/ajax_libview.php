<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";

$mode = $site_prefix."board_library";

$sql = " select * from ".$mode." where BoardIdx = '".$Idx."' ";
$row = sql_fetch($sql);
$files = get_file($mode,$Idx);

$q_next = "select BoardIdx, Title, RegDate from ".$mode." where BoardIdx>".$Idx." AND Category='".$row["Category"]."' order by BoardIdx  limit 0,1";
$q_next_row = sql_fetch($q_next);

$q_prev = "select BoardIdx, Title, RegDate from ".$mode." where BoardIdx<".$Idx." AND Category='".$row["Category"]."' order by BoardIdx desc limit 0,1";
$q_prev_row = sql_fetch($q_prev);

$fileURL = "../../../board/upload/library";

include_once($dir."/config/skin.lib.php");

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$thumb_width = 335;
$thumb_height = 376;
?>
<div class="">
	<ul class="view2">
		<li>
			<table width="613px" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="360" rowspan="3" align="center">
						<?
						if($files[0][image_type]=="1" || $files[0][image_type]=="2" || $files[0][image_type]=="3" || $files[0][image_type]=="6"){
						//	$img = "<img src='".$files[0][path]."/".$files[0][file_source]."' width='279' height='353'>";
							$img = makeThumbs($fileURL, $files[0][file_source], $thumb_width, $thumb_height, "thumbs2","");
						} else {
							$img = "<img src='/images/main/story_noimg.jpg'>";
						}
						echo $img;
						?>
					</td>
					<td height="40" align="right"><a href="javascript:;" onclick="port_close();"><img src="../image/board_img/list_btn.png" /></a></td>
				</tr>
				<tr>
					<td height="210">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td rowspan="6" width="30">&nbsp;</td>
								<td width="55" valign="top" class="view_box_text"><img src="../image/board_img/title_11.png"/></td>
								<td class="view_box_text"><?=$row["Etc1"]?></td>
							</tr>
							<tr>
								<td valign="top" class="view_box_text"><img src="../image/board_img/title_12.png"/></td>
								<td class="view_box_text"><?=$row["Etc2"]?></td>
							</tr>
							<tr>
								<td valign="top" class="view_box_text"><img src="../image/board_img/title_13.png"/></td>
								<td class="view_box_text"><?=$row["Link1"]?></td>
							</tr>
							<tr>
								<td valign="top" class="view_box_text"><img src="../image/board_img/title_14.png"/></td>
								<td class="view_box_text"><?=$row["Link2"]?></td>
							</tr>
							<tr>
								<td valign="top" class="view_box_text"><img src="../image/board_img/title_15.png"/></td>
								<td class="view_box_text"><?=$row["Title"]?></td>
							</tr>
							<tr>
								<td valign="top" class="view_box_text"><img src="../image/board_img/title_16.png"/></td>
								<td class="view_box_text"><?=$row["Content"]?></td>
							</tr>
					  </table>
					</td>
				</tr>
				<tr>
					<td height="215" align="center">
						<table width="240" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="120" align="center">
									<?if($q_prev_row[BoardIdx]){ ?>
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td height="40" align="center"><?="<a href='javascript:;' onclick='port_view(\"".$q_prev_row[BoardIdx]."\");'>"?><img src="../image/board_img/view_prev.png" /></a></td>
										</tr>
										<tr>
											<td align="center">
												<?
												$pfiles = get_file($mode,$q_prev_row[BoardIdx]);
												if($pfiles[0][image_type]=="1" || $pfiles[0][image_type]=="2" || $pfiles[0][image_type]=="3" || $pfiles[0][image_type]=="6"){
												//	$img = "<img src='".$pfiles[0][path]."/".$pfiles[0][file_source]."' width='108' height='138'>";
													$img = makeThumbs($fileURL, $pfiles[0][file_source], 99, 72, "thumbs3", "");
												} else {
													$img = "<img src='/images/main/story_noimg.jpg'>";
												}
												echo "<a href='javascript:;' onclick='port_view(\"".$q_prev_row[BoardIdx]."\");'>".$img."</a>";
												?>
											</td>
										</tr>
									</table>
									<? } ?>
								</td>
								<td>
									<?if($q_next_row[BoardIdx]){ ?>
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td height="40" align="center"><?="<a href='javascript:;' onclick='port_view(\"".$q_next_row[BoardIdx]."\");'>"?><img src="../image/board_img/view_next.png" /></a></td>
										</tr>
										<tr>
											<td align="center">
												<?
												$nfiles = get_file($mode,$q_next_row[BoardIdx]);
												if($nfiles[0][image_type]=="1" || $nfiles[0][image_type]=="2" || $nfiles[0][image_type]=="3" || $nfiles[0][image_type]=="6"){
												//	$img = "<img src='".$nfiles[0][path]."/".$nfiles[0][file_source]."' width='108' height='138'>";
													$img = makeThumbs($fileURL, $nfiles[0][file_source], 99, 72, "thumbs3", "");
												} else {
													$img = "<img src='/images/main/story_noimg.jpg'>";
												}
												echo "<a href='javascript:;' onclick='port_view(\"".$q_next_row[BoardIdx]."\");'>".$img."</a>";
												?>
											</td>
										</tr>
									</table>
									<? } ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</li>
	</ul>
</div>