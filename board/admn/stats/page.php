<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";
include_once $dir."/config/FusionCharts.php";

$t500 = "top_mon";
$t502 = "navi_mon";
$left = "l5";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

if(empty($searchSDate)) $searchSDate = date("Y-m-d");
if(empty($searchEDate)) $searchEDate = date("Y-m-d");

$counter = GetCounter("PAGE", $searchSDate, $searchEDate);

if($searchSDate == $searchEDate){
	for($i=0;$i<sizeOf($counter);$i++){
		$list[$counter[$i]['visitDate']][$counter[$i]['visitHour']] = $counter[$i]['visitCount'];
	}
}
else{
	for($i=0;$i<sizeOf($counter);$i++){
		$list[$counter[$i]['visitDate']] = $counter[$i]['visitCount'];
	}
}
?>

<script>
$(window).load(function(){
	$('#searchSDate').datepicker({yearRange: '2012:<?=date('Y')?>'});
	$('#searchEDate').datepicker({yearRange: '2012:<?=date('Y')?>'});

//	$('div.ui-datepicker').css('font-size', '75%');
});
function GoSearch(){
	location.href = '<?=$_SERVER["PHP_SELF"]?>?searchSDate='+$("#searchSDate").val()+'&searchEDate='+$("#searchEDate").val();
}
function GoSearchCurrent(period){
	var urls = "";
	switch(period){
		case 1 :
			<?
			$SDate = date('Y-m-d');
			$EDate = date('Y-m-d');
			?>
			urls = "searchSDate=<?=$SDate?>&searchEDate=<?=$EDate?>";
			break;
		case 7 :
			<?
			$SDate = strtotime(date('Y-m-d'));
			$SDate = date('Y-m-d',mktime(0, 0, 0, date('m',$SDate), date('d',$SDate) - 6, date('Y',$SDate)));
			$EDate = date('Y-m-d');
			?>
			urls = "searchSDate=<?=$SDate?>&searchEDate=<?=$EDate?>";
			break;
		case 30 :
			<?
			$SDate = strtotime(date('Y-m-d'));
			$SDate = date('Y-m-d',mktime(0, 0, 0, date('m',$SDate), date('d',$SDate) - 29, date('Y',$SDate)));
			$EDate = date('Y-m-d');
			?>
			urls = "searchSDate=<?=$SDate?>&searchEDate=<?=$EDate?>";
			break;
	}
	location.href = '<?=$_SERVER["PHP_SELF"]?>?' + urls;
}
</script>
<div id="container">
	<div class="content_view">
		<div class="con_title">페이지뷰</div>
		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="1">
			<tr> 
				<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="title1">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr> 
							<td height="35" class="menu">
								<table width='100%' border='0' cellpadding='0' cellspacing='0'>
									<tr height='25'>
										<td align='right'>
											<input id='searchSDate' name='searchSDate' size='10' type='text' value='<?=$searchSDate?>' readonly class='input'>
											~
											<input id='searchEDate' name='searchEDate' size='10' type='text' value='<?=$searchEDate?>' readonly class='input'>
											<a href='javascript:GoSearch();'><img src='/board/admn/images/btn/btn_search.gif' border='0' align='absmiddle'></a>
										</td>
									</tr>
									<tr height='25'>
										<td align='right'>
											<a href='javascript:GoSearchCurrent(1);'><img src='/board/admn/images/btn/btn_today.gif' border='0'></a>
											<a href='javascript:GoSearchCurrent(7);'><img src='/board/admn/images/btn/btn_7day.gif' border='0'></a>
											<a href='javascript:GoSearchCurrent(30);'><img src='/board/admn/images/btn/btn_month.gif' border='0'></a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding-top:20px;" align="center">
								<?
								$searchSTime = strtotime($searchSDate);
								$searchETime = strtotime($searchEDate);

								if($searchSTime == $searchETime){
									for($i=0;$i<24;$i++){
										if(strlen($i)==1)	$time_s = "0".$i;
										else				$time_s = $i;

										$grpData[$i]['title'] = $time_s;
										$grpData[$i]['color'] = "#3399FF";
										$grpData[$i]['data'] = $list[$searchSTime][$time_s];
									}
								}
								else{
									$loop = ($searchETime - $searchSTime) / 86400;
									$sTime = $searchSTime;
									for($i=0;$i<=$loop;$i++){
										$time_s = date('d',$sTime);

										$grpData[$i]['title'] = $time_s;
										$grpData[$i]['color'] = "#3399FF";
										$grpData[$i]['data'] = $list[$sTime];

										$sTime = $sTime + 86400;
									}
								}

								GetCounterCharts('column',$grpData,$grpCate,NULL,NULL);
								unset($grpData);
								?>
							</td>
						</tr>
						<tr>
							<td height='12'></td>
						</tr>
						<tr>
							<td>
								<table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tr height='2' bgcolor='#0c1735'><td colspan='6'></td></tr>
									<tr height='30'>
										<td align='center'>일시</td>
										<td align='center'>페이지뷰</td>
										<td align='center'>전일 페이지뷰</td>
										<td align='center'>증감</td>
									</tr>
									<tr height='1' bgcolor='#0c1735'><td colspan='6'></td></tr>
								<?
								if($searchSTime == $searchETime){
									for($i=0;$i<24;$i++){
										if(strlen($i)==1)	$time_s = "0".$i;
										else				$time_s = $i;

										$Ncnt = $list[$searchSTime][$time_s];
										$Pcnt = $list[$searchSTime-86400][$time_s] + $list[$searchSTime-86400][$time_s];

										$cntUP = $Ncnt - $Pcnt;
										if($cntUP == 0)		$cntUPStr = "";
										else if($cntUP < 0)	$cntUPStr = "<span style='color:red;font-weight:bold'>↓</span>";
										else				$cntUPStr = "<span style='color:blue;font-weight:bold'>↑</span>";

										$NcntT  += $Ncnt;
										$PcntT  += $Pcnt;
										$cntUPT += $cntUP;

								?>
									<tr height='30'>
										<td align='center'><?=$time_s?>시</td>
										<td align='center'><?=DfVal3($Ncnt,number_format($Ncnt),"-")?></td>
										<td align='center'><?=DfVal3($Pcnt,number_format($Pcnt),"-")?></td>
										<td align='center'><?=DfVal3($cntUP,number_format($cntUP),"-").$cntUPStr?></td>
									</tr>
									<tr height='1' bgcolor='#cbcbcf'><td colspan='6'></td></tr>
								<?
									}

									if($cntUPT == 0)		$cntUPStr = "";
									else if($cntUPT < 0)	$cntUPStr = "<span style='color:red;font-weight:bold'>↓</span>";
									else					$cntUPStr = "<span style='color:blue;font-weight:bold'>↑</span>";
								?>
									<tr height='30'>
										<td align='center'>합계</td>
										<td align='center'><?=DfVal3($NcntT,number_format($NcntT),"-")?></td>
										<td align='center'><?=DfVal3($PcntT,number_format($PcntT),"-")?></td>
										<td align='center'><?=DfVal3($cntUPT,number_format($cntUPT),"-").$cntUPStr?></td>
									</tr>
								<?
								}
								else{
									$loop = ($searchETime - $searchSTime) / 86400;
									for($i=0;$i<=$loop;$i++){
										$time_s = date('Y-m-d',$searchSTime);

										$Ncnt = $list[$searchSTime];
										$Pcnt = $list[$searchSTime-86400] + $list[$searchSTime-86400];

										

										$cntUP = $Ncnt - $Pcnt;
										if($cntUP == 0)		$cntUPStr = "";
										else if($cntUP < 0)	$cntUPStr = "<span style='color:red;font-weight:bold'>↓</span>";
										else				$cntUPStr = "<span style='color:blue;font-weight:bold'>↑</span>";

										$NcntT  += $Ncnt;
										$PcntT  += $Pcnt;
										$cntUPT += $cntUP;

								?>
									<tr height='30'>
										<td align='center'><?=$time_s?></td>
										<td align='center'><?=DfVal3($Ncnt,number_format($Ncnt),"-")?></td>
										<td align='center'><?=DfVal3($Pcnt,number_format($Pcnt),"-")?></td>
										<td align='center'><?=DfVal3($cntUP,number_format($cntUP),"-").$cntUPStr?></td>
									</tr>
									<tr height='1' bgcolor='#cbcbcf'><td colspan='6'></td></tr>
								<?
										$searchSTime = $searchSTime + 86400;
									}

									if($cntUPT == 0)		$cntUPStr = "";
									else if($cntUPT < 0)	$cntUPStr = "<span style='color:red;font-weight:bold'>↓</span>";
									else					$cntUPStr = "<span style='color:blue;font-weight:bold'>↑</span>";
								?>
									<tr height='30'>
										<td align='center'>합계</td>
										<td align='center'><?=DfVal3($NcntT,number_format($NcntT),"-")?></td>
										<td align='center'><?=DfVal3($PcntT,number_format($PcntT),"-")?></td>
										<td align='center'><?=DfVal3($cntUPT,number_format($cntUPT),"-").$cntUPStr?></td>
									</tr>
								<?
								}
								?>
								</table>
							</td>
						</tr>
						<tr height='30'><td></td></tr>
					</table>
				</td>
				<!-- <td width="1" rowspan="8" bgcolor="BDBEBD"></td> -->
			</tr>
		</table>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<?
include_once $dir."/admn/include/tail.php";
?>