<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php');
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/member.css">
</head>
<body class="sub member mypage">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>회원전용</small>MEMBERSHIP</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의<br class="visible-xs">
					라이프 스타일 공간입니다.<br class="hidden-xs"> FASHION · F&amp;B · CGV <br class="visible-xs">
					<span class="hidden-xs"> · </span>HOME PLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<?
		$sql = " select * from WEB_POINT where WEB_CARD_NO = '".$member["mb_1"]."' ";
		$result = mssql_query($sql,$mconn);
		$cardInfo = mssql_fetch_array($result);

		if(!$page) $page = 1;
		$PageBlock = 5;  //넘길 페이지 갯수
		if(!$board_list_num) $board_list_num = 5; //게시판 게시글 수

		$totalSql = " select * from WEB_POINT_DETAIL where Web_CUST_NO = '".$cardInfo["WEB_CUST_NO"]."' order by Web_IndexNo desc ";
		$totalResult = mssql_query($totalSql,$mconn);
		$TotalCount = @mssql_num_rows($totalResult);

		$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산

		$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?page=");

		$sql = $totalSql." offset ".intval(($page - 1) * $board_list_num)." rows fetch next ".$board_list_num." rows only";
		$result = mssql_query($sql,$mconn);
		$Count = @mssql_num_rows($result);
		for($i=0;$row = mssql_fetch_array($result);$i++){
			$row["Web_Aname"] = iconv("EUC-KR","UTF-8",$row["Web_Aname"]);
			$list[$i] = $row;
		}
		?>
		<main id="content">
			<div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
				<h2>나의 포인트</h2>
				<hr>
				<p>
					스퀘어원 포인트카드는 스퀘어원 이용 시 구매금액의 <i>1%를<br class="visible-xs"> 적립</i> 할 수 있으며,<br class="hidden-xs"> 누적된 포인트가 일정 수준이상이 되면<br class="visible-xs"> 이를 포인트 금액대별 차감 기프트로 교환하실 수  있습니다.
				</p>
				<div class="snb">
					<div class="container">
						<button class="btn btn-block" type="button">
							마이포인트
						</button>
						<nav>
							<ul>
								<li><a href="/member/edit_form.php">회원정보 수정</a></li>
								<li class="active"><a href="/member/mypoint.php">마이포인트</a></li>
								<li><a href="/member/inquiry_list.php">1:1 문의</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="mypoint">
					<div class="section-content">
						<div class="point">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-lg-3">
									<div class="u-point">
										<p class="user">
											<i class="u-name"><?=$member["UserName"]?></i>님의<br class="hidden-xs"> 포인트 내역입니다.
										</p>
										<p class="attention">
											<i class="icon-attention-circled"></i> 포인트는 6,000점 이상부터 사용 가능합니다.
										</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-lg-9">
									<div class="point-info">
										<div class="row">
											<div class="col-xs-12 col-lg-4">
												<dl>
													<dt>
														<img src="/assets/images/member/point_img01.gif" alt="적립 포인트">
													</dt>
													<dd class="t-orange">
														<p class="title">적립 포인트</p>
														<p class="amount"><?=number_format($cardInfo["WEB_TOT_POINT"])?> <span> 원</span></p>
													</dd>
												</dl>
											</div>
											<div class="col-xs-12 col-lg-4">
												<dl>
													<dt>
														<img src="/assets/images/member/point_img02.gif" alt="사용 포인트">
													</dt>
													<dd class="t-gray">
														<p class="title">사용 포인트</p>
														<p class="amount"><?=number_format($cardInfo["WEB_USE_POINT"])?> <span> 원</span></p>
													</dd>
												</dl>
											</div>
											<div class="col-xs-12 col-lg-4">
												<dl>
													<dt class="dt-mb">
														<img src="/assets/images/member/point_img03.gif" alt="가용 포인트">
													</dt>
													<dd class="t-green">
												<p class="title">가용 포인트</p>
												<p class="amount"><?=number_format($cardInfo["WEB_CUR_POINT"])?> <span> 원</span></p>
											</dd>
												</dl>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="point-history">
							<div class="table-wrap">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>적립일자</th>
											<th>매장</th>
											<th>매출금액</th>
											<th>포인트</th>
										</tr>
									</thead>
									<tbody>
										<?
										for($i=0;$i<sizeof($list);$i++){
										?>
										<tr>
											<td class="date"><?=date("Y년 m월 d일",strtotime($list[$i]["Web_YYYYMMDD"]))?></td>
											<td><?=$list[$i]["Web_Aname"]?></td>
											<td><?=number_format($list[$i]["Web_SALE_AMT"])?> 원</td>
											<td><?=number_format($list[$i]["Web_GPOINT"])?> 원</td>
										</tr>
										<?
										}
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
					</div>
				</div>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>