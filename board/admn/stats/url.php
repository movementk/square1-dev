<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";
include_once $dir."/config/FusionCharts.php";

$t500 = "top_mon";
$t503 = "navi_mon";
$left = "l5";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

if(empty($searchSDate)) $searchSDate = date("Y-m-d");
if(empty($searchEDate)) $searchEDate = date("Y-m-d");

$counter = GetCounter("URL", $searchSDate, $searchEDate);
$list = $counter['list'];
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
		<div class="con_title">접근URL</div>
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
								for($i=0;$i<sizeOf($list);$i++){
									$grpData[$i]['title'] = ($i+1);
									$grpData[$i]['color'] = $colorArr[$i];
									$grpData[$i]['data'] = $list[$i]['vCnt'];

									$sTime = $sTime + 86400;
								}

								GetCounterCharts('pie',$grpData,$grpCate,NULL,NULL);
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
										<td align='center' width='50'>순위</td>
										<td align='center'>접근URL</td>
										<td align='center'>접근수</td>
										<td align='center'>비율</td>
									</tr>
									<tr height='1' bgcolor='#0c1735'><td colspan='6'></td></tr>
								<?
									for($i=0;$i<sizeOf($list);$i++){
										$perStr = ($list[$i]['vCnt'] / $counter['total']) * 100;

								?>
									<tr height='30'>
										<td align='center'><?=$i+1?></td>
										<td align='left' style='padding-left:10px;'><?=$list[$i]['visitPage']?></td>
										<td align='center'><?=number_format($list[$i]['vCnt'])?></td>
										<td align='center'><?=number_format($perStr,1)?>%</td>
									</tr>
									<tr height='1' bgcolor='#cbcbcf'><td colspan='6'></td></tr>
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