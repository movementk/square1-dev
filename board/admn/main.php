<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";
GetAlert('',"/board/admn/setup/modify.php");
$t000 = "top_mon";
$t001 = "navi_mon";
$left = "l0";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$main_counter = GetMainCounter();
?>
<script type="text/javascript" src="/board/config/js/FusionCharts.js"></script>
<div id="container">
	<div class="content_view">
		<div class="con_title">관리자홈</div>
		<div id="main_top">
			<div id="chartdiv" class="mt_chart"></div>

			<table class="mt_table">
				<thead>
				<tr>
					<th>연도</th>
					<th>1월</th>
					<th>2월</th>
					<th>3월</th>
					<th>4월</th>
					<th>5월</th>
					<th>6월</th>
					<th>7월</th>
					<th>8월</th>
					<th>9월</th>
					<th>10월</th>
					<th>11월</th>
					<th>12월</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td><?=date("Y",time())?></td>
					<?
					for($i=1;$i<13;$i++){
						echo "<td>".number_format($main_counter[$i]["visitCount"])."</td>";
					}
					?>
				</tr>
				</tbody>
			</table>
		</div>
		<div class="l_bar"></div>
		<?
		$bsql = " select * from ".$site_prefix."board_setting where LinkFlag = '1' order by Idx desc limit 0, 3 ";
		$bresult = sql_query($bsql);
		for($i=0;$brow = sql_fetch_array($bresult);$i++){
			$blist[$i] = $brow;
		}
		?>
		<div id="main_bot">
			<div class="mb_l">
				<dl class="mb_bbs">
					<dt>
						<ul>
							<li class="title">최근 회원목록</li>
							<li class="more"><a href="/board/admn/member/mem_lst.php">more</a></li>
						</ul>
					</dt>
					<dd>
						<ul>
							<?
							$msql = " select * from ".$memberdb." where Flag = 'Y' order by idx desc limit 0, 10 ";
							$mresult = sql_query($msql);
							for($i=0;$mrow = sql_fetch_array($mresult);$i++){
							?>
							<li class="subject"><?=$mrow["UserLevel"]?></li>
							<li class="date">123</li>
							<? } ?>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="mb_c">&nbsp;</div>
			<? if($blist[0]["Idx"]){ ?>
			<div class="mb_r">
				<dl class="mb_bbs">
					<dt>
						<ul>
							<li class="title">최근 <?=$blist[0]["BoardTitle"]?></li>
							<li class="more"><a href="/board/admn/board/board.php?bidx=<?=$blist[0]["Idx"]?>">more</a></li>
						</ul>
					</dt>
					<dd>
						<ul>
							<?=latest($blist[0]["BoardName"],7,80,"latest_admin","board/admn/board/board_view.php?bidx=".$blist[0]["Idx"]."?board_code=board_view","");?>
						</ul>
					</dd>
				</dl>
			</div>
			<? } ?>
			<? if($blist[1]["Idx"]){ ?>
			<div class="mb_l mt20">
				<dl class="mb_bbs">
					<dt>
						<ul>
							<li class="title">최근 <?=$blist[1]["BoardTitle"]?></li>
							<li class="more"><a href="/board/admn/board/board.php?bidx=<?=$blist[1]["Idx"]?>">more</a></li>
						</ul>
					</dt>
					<dd>
						<ul>
							<?=latest($blist[1]["BoardName"],7,80,"latest_admin","board/admn/board/board_view.php?bidx=".$blist[1]["Idx"]."?board_code=board_view","");?>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="mb_c">&nbsp;</div>
			<? } ?>
			<? if($blist[2]["Idx"]){ ?>
			<div class="mb_r mt20">
				<dl class="mb_bbs">
					<dt>
						<ul>
							<li class="title">최근 <?=$blist[2]["BoardTitle"]?></li>
							<li class="more"><a href="/board/admn/board/board.php?bidx=<?=$blist[2]["Idx"]?>">more</a></li>
						</ul>
					</dt>
					<dd>
						<ul>
							<?=latest($blist[2]["BoardName"],7,80,"latest_admin","board/admn/board/board_view.php?bidx=".$blist[2]["Idx"]."?board_code=board_view","");?>
						</ul>
					</dd>
				</dl>
			</div>
			<? } ?>
		</div>
	</div>
	<div class="cboth pt50">&nbsp;</div>
</div>

<script type="text/javascript">
window.onload = function(){
	var chart = new FusionCharts("/board/config/js/chart/FCF_Line.swf", "ChartId", parseInt($("#chartdiv").width()), "292");
	chart.setDataURL("main_graph.php");
	chart.render("chartdiv");
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>