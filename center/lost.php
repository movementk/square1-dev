<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g05 = "selected";
$s01 = "active";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/center.css">
</head>
<body class="sub center">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>고객센터</small>CUSTOMER</h1>
				<p>
					스퀘어원 고객님의 편의를 위한<br>
					정보와 서비스 내용을 안내드립니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php
			$s01 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb5.php');
			?>
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 분실물센터안내</h1>
                <h2>
                    스퀘어원은 고객님의 물건<br class="visible-xs">
                    하나하나<br class="visible-sm"> 소중히 생각합니다.
                </h2>
                <p>
                    소중한 물건을 분실하였나요?<br class="visible-xs">
                    안내데스크로 연락주세요. <a href="<?=$is_mobile?"tel:0314564011":"javascript:;"?>"> Tel. 032-456-4011</a><br>
                    물건을 찾는 즉시 안전하게 되돌려 드립니다.<br>
                    먼저 아래 습득물 리스트에 분실한 물건이 있는지<br class="visible-xs">
                    확인해보세요.
                </p>
            </div>
			<div class="container">
				<section class="lost">
					<div class="section-content">
						<div class="calendar-form">
							<form name="searchForm" method="get">
								<div class="calendar">
									<p class="selecter">
										<input type="text" id="datepicker" name="sdate" class="form-control in-mr" value="<?=$_GET["sdate"]?>" />
										<label for="datepicker">
											<i class="icon-calendar">
												<span class="sr-only">시작날짜조회</span>
											</i>
										</label>
									</p>
									-
									<p class="selecter">
										<input type="text" id="datepicker-2" name="edate" class="form-control in-mr" value="<?=$_GET["edate"]?>" />
										<label for="datepicker-2">
											<i class="icon-calendar">
												<span class="sr-only">종료날짜조회</span>
											</i>
										</label>
									</p>
								</div>
								<div class="c-search">
									<div class="form-group">
										<select class="form-control" name="Category">
											<option value="">전체</option>
											<option value="의류" <?=$_GET["Category"]=="의류"?"selected":""?>>의류</option>
											<option value="패션잡화" <?=$_GET["Category"]=="패션잡화"?"selected":""?>>패션잡화</option>
											<option value="기타" <?=$_GET["Category"]=="기타"?"selected":""?>>기타</option>
										</select>
										<label for="search-keyword" class="sr-only">검색어</label>
										<input id="search-keyword" type="text" class="form-control" name="stx" value="<?=$_GET["stx"]?>" />

										<button type="submit" class="btn">
											<span class="glyphicon glyphicon-search"></span>
										</button>
									</div>
								</div>
							</form>
						</div>
						<?
						$sql_common = "";
						$mode = $site_prefix."board_lost";

						$PageBlock   = 5;  //넘길 페이지 갯수
						if(!$board_list_num) $board_list_num = 5;                     //게시판 게시글 수

						if($Category){
							$sql_common .= " and Category = '".$Category."' ";
						}

						if($stx){
							$sql_common .= " and (Title like '%".$stx."%' or bd1 like '%".$stx."%' or bd2 like '%".$stx."%') ";
						}

						if($sdate){
							$sql_common .= " and bd3 >= '".$sdate."' ";
						}
						if($edate){
							$sql_common .= " and bd3 <= '".$edate."' ";
						}
						/*
						if($sdate || $edate){
							if($sdate && $edate){
								$sql_common .= " and (bd3 between '".$sdate."' and '".$edate."') ";
							} else {
								if($sdate){
									$sql_common .= " and bd3 >= '".$sdate."' ";
								}
								if($edate){
									$sql_common .= " and bd3 <= '".$edate."' ";
								}
							}
						}
						*/
						$TotalSQL = "select * from ".$mode." where Notice != '1' $sql_common order by RegDate desc, Ref desc, ReLevel asc, ReStep asc";
						$TotalResult = mysql_query($TotalSQL);
						$TotalCount  = mysql_num_rows($TotalResult);

						$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산
						if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
						$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

						$SQL = $TotalSQL." limit $from_record, $board_list_num";
						$Result      = mysql_query($SQL);
						$Count       = mysql_num_rows($Result);
						$searchVal .= "&list_type=".$list_type."&board_list_num=".$board_list_num."&bd4=".$bd4."&bd5=".$bd5;

						$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&category=".$category."&page=");
						?>
						<div class="table-wrap">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><i>관리</i>번호</th>
										<th>분류</th>
										<th>습득물<i>명</i></th>
										<th><i>습득</i>제목</th>
										<th><i>습득</i>장소</th>
										<th>습득일<i>자</i></th>
									</tr>
								</thead>
								<tbody>
									<?
									$num = $TotalCount - ($page-1)*$board_list_num;
									for($i=0;$row = sql_fetch_array($Result);$i++){
										$Title = $row[Title];
										$Title = cut_string($Title, 120);
									?>
									<tr>
										<td><?=$row["bd10"]?></td>
										<td><?=$row["Category"]?></td>
										<td><?=$row["bd1"]?></td>
										<td><?=$row["Title"]?></td>
										<td><?=$row["bd2"]?></td>
										<td><i><?=date("Y",strtotime($row["bd3"]))?>-</i><?=date("m-d",strtotime($row["bd3"]))?></td>
									</tr>
									<?
									}
									if($Count == 0){ echo "<tr><td colspan='6' style='text-align:center;padding:100px 0px;'>등록된 분실물이 없습니다</td></tr>"; }
									?>
								</tbody>
							</table>
						</div>
						<nav aria-label="Page navigation" class="paging">
							<ul class="pagination">
								<?
								if($Count>0){
									echo $write_pages;
								}
								?>
							</ul>
						</nav>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<!-- calendar 없는 페이지 제거 -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><!-- calendar -->
	<script><!-- calendar -->
		(function($) {
			$("#datepicker, #datepicker-2").datepicker({
				dateFormat: 'yy-mm-dd',
				prevText: '이전 달',
				nextText: '다음 달',
				monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
				monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
				dayNames: ['일','월','화','수','목','금','토'],
				dayNamesShort: ['일','월','화','수','목','금','토'],
				dayNamesMin: ['일','월','화','수','목','금','토'],
				showMonthAfterYear: true,
				changeMonth: true,
				changeYear: true,
				yearSuffix: '년'
			});
		})(jQuery);
	</script>
</body>
</html>