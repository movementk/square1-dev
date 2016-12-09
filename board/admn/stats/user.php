<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";
include_once $dir."/config/FusionCharts.php";

$t500 = "top_mon";
$t501 = "navi_mon";
$left = "l5";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

if(empty($searchSDate)) $searchSDate = date("Y-m-d");
if(empty($searchEDate)) $searchEDate = date("Y-m-d");

$counter = GetCounter("USER", $searchSDate, $searchEDate);

if($searchSDate == $searchEDate){
	for($i=0;$i<sizeOf($counter);$i++){
		$list[$counter[$i]['visitDate']][$counter[$i]['visitHour']][$counter[$i]['visitType']] = $counter[$i]['visitCount'];
	}
}
else{
	for($i=0;$i<sizeOf($counter);$i++){
		$list[$counter[$i]['visitDate']][$counter[$i]['visitType']] = $counter[$i]['visitCount'];
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
		<div class="con_title">접속자수</div>
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
									$grpData[0]['title'] = "순방문자";
									$grpData[0]['color'] = "#3399FF";
									$grpData[1]['title'] = "재방문자";
									$grpData[1]['color'] = "#ff3300";

									for($i=0;$i<24;$i++){
										if(strlen($i)==1)	$time_s = "0".$i;
										else				$time_s = $i;

										$grpCate[$i] = $time_s;
										$grpData[0]['data'][$i] = $list[$searchSTime][$time_s]['N'];
										$grpData[1]['data'][$i] = $list[$searchSTime][$time_s]['R'];
									}
								}
								else{
									$grpData[0]['title'] = "순방문자";
									$grpData[0]['color'] = "#3399FF";
									$grpData[1]['title'] = "재방문자";
									$grpData[1]['color'] = "#ff3300";

									$loop = ($searchETime - $searchSTime) / 86400;
									$sTime = $searchSTime;
									for($i=0;$i<=$loop;$i++){
										$time_s = date('d',$sTime);

										$grpCate[$i] = $time_s;
										$grpData[0]['data'][$i] = $list[$sTime]['N'];
										$grpData[1]['data'][$i] = $list[$sTime]['R'];

										$sTime = $sTime + 86400;
									}
								}

								GetCounterCharts('column_multi',$grpData,$grpCate,NULL,NULL);
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
										<td align='center'>순방문자</td>
										<td align='center'>재방문자</td>
										<td align='center'>전체방문자</td>
										<td align='center'>전일방문자</td>
										<td align='center'>증감</td>
									</tr>
									<tr height='1' bgcolor='#0c1735'><td colspan='6'></td></tr>
								<?
								if($searchSTime == $searchETime){
									for($i=0;$i<24;$i++){
										if(strlen($i)==1)	$time_s = "0".$i;
										else				$time_s = $i;

										$Ncnt = $list[$searchSTime][$time_s]['N'];
										$Rcnt = $list[$searchSTime][$time_s]['R'];
										$Tcnt = $Ncnt + $Rcnt;

										$Pcnt = $list[$searchSTime-86400][$time_s]['N'] + $list[$searchSTime-86400][$time_s]['R'];

										$cntUP = $Tcnt - $Pcnt;
										if($cntUP == 0)		$cntUPStr = "";
										else if($cntUP < 0)	$cntUPStr = "<span style='color:red;font-weight:bold'>↓</span>";
										else				$cntUPStr = "<span style='color:blue;font-weight:bold'>↑</span>";

										$NcntT  += $Ncnt;
										$RcntT  += $Rcnt;
										$TcntT  += $Tcnt;
										$PcntT  += $Pcnt;
										$cntUPT += $cntUP;

								?>
									<tr height='30'>
										<td align='center'><?=$time_s?>시</td>
										<td align='center'><?=DfVal3($Ncnt,number_format($Ncnt)."명","-")?></td>
										<td align='center'><?=DfVal3($Rcnt,number_format($Rcnt)."명","-")?></td>
										<td align='center'><?=DfVal3($Tcnt,number_format($Tcnt)."명","-")?></td>
										<td align='center'><?=DfVal3($Pcnt,number_format($Pcnt)."명","-")?></td>
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
										<td align='center'><strong>합계</strong></td>
										<td align='center'><strong><?=DfVal3($NcntT,number_format($NcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($RcntT,number_format($RcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($TcntT,number_format($TcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($PcntT,number_format($PcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($cntUPT,number_format($cntUPT),"-").$cntUPStr?></strong></td>
									</tr>
								<?
								}
								else{
									$loop = ($searchETime - $searchSTime) / 86400;
									for($i=0;$i<=$loop;$i++){
										$time_s = date('Y-m-d',$searchSTime);

										$Ncnt = $list[$searchSTime]['N'];
										$Rcnt = $list[$searchSTime]['R'];
										$Tcnt = $Ncnt + $Rcnt;

										$Pcnt = $list[$searchSTime-86400]['N'] + $list[$searchSTime-86400]['R'];

										$cntUP = $Tcnt - $Pcnt;
										if($cntUP == 0)		$cntUPStr = "";
										else if($cntUP < 0)	$cntUPStr = "<span style='color:red;font-weight:bold'>↓</span>";
										else				$cntUPStr = "<span style='color:blue;font-weight:bold'>↑</span>";

										$NcntT  += $Ncnt;
										$RcntT  += $Rcnt;
										$TcntT  += $Tcnt;
										$PcntT  += $Pcnt;
										$cntUPT += $cntUP;

								?>
									<tr height='30'>
										<td align='center'><?=$time_s?></td>
										<td align='center'><?=DfVal3($Ncnt,number_format($Ncnt)."명","-")?></td>
										<td align='center'><?=DfVal3($Rcnt,number_format($Rcnt)."명","-")?></td>
										<td align='center'><?=DfVal3($Tcnt,number_format($Tcnt)."명","-")?></td>
										<td align='center'><?=DfVal3($Pcnt,number_format($Pcnt)."명","-")?></td>
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
										<td align='center'><strong>합계</strong></td>
										<td align='center'><strong><?=DfVal3($NcntT,number_format($NcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($RcntT,number_format($RcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($TcntT,number_format($TcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($PcntT,number_format($PcntT)."명","-")?></strong></td>
										<td align='center'><strong><?=DfVal3($cntUPT,number_format($cntUPT),"-").$cntUPStr?></strong></td>
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