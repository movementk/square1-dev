<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g04 = "selected";
$s02 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/event.css">
</head>
<body class="sub event">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>이벤트&amp;뉴스</small>EVENT &amp; NEWS</h1>
				<p>
					복합문화 쇼핑공간 스퀘어원만의 이벤트 소식과<br>
					보도자료를 전해드립니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php
			$s02 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb4.php');
			?>
			<div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
				<h1><span class="square1">SQUARE<i>1</i></span> 이벤트</h1>
				<div class="snb">
					<div class="container">
						<button class="btn btn-block" type="button">
							당첨자 발표
						</button>
						<nav>
							<ul>
								<li><a href="square1_event_list.php?gubun=ing">진행 중 이벤트</a></li>
								<li><a href="square1_event_list.php?gubun=end">지난 이벤트</a></li>
								<li class="active"><a href="prizewinner_list.php">당첨자 발표</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
				<?
				$workType = "prizewinner";
				include $dir."/module/board.php";
				?>
				<!--section class="prizewinner-list">
					<div class="section-header">
						<h2>스퀘어원의 이벤트 소식을<br class="visible-xs"> 한번에 보실 수 있습니다.</h2>
						<p>
							복합 문화 소비공간 스퀘어원만의<br class="visible-xs"> 다양한 이벤트를 경험해 보세요~
						</p>
					</div>
					<div class="section-content">
						<div class="search-form">
							<form>
								<div class="form-group">
									<select class="form-control">
										<option value="">전체</option>
									</select>
									<label for="search-keyword" class="sr-only">검색어</label>
									<input id="search-keyword" type="text" class="form-control">
								</div>
								<button type="submit" class="btn">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</form>
						</div>
						<div class="table-wrap">
							<table class="table table-bordered notice-table">
								<thead>
									<tr>
										<th>번호</th>
										<th>제목</th>
										<th>작성일</th>
										<th>조회수</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>100</td>
										<td class="t-content"><a href="#">골드바 40돈의 주인공 당첨자 발표</a></td>
										<td class="date">2016-10-06</td>
										<td>123</td>
									</tr>
									<tr>
										<td>99</td>
										<td class="t-content"><a href="#">LOVE&amp;THANKS 경품 페스티벌 당첨자 발표</a></td>
										<td class="date">2016-10-06</td>
										<td>15</td>
									</tr>
									<tr>
										<td>98</td>
										<td class="t-content"><a href="#">발렌타인데이 LOVE이벤트 당첨자발표</a></td>
										<td class="date">2016-10-06</td>
										<td>77</td>
									</tr>
									<tr>
										<td>97</td>
										<td class="t-content"><a href="#">새해 소원을 말해봐 당첨자 발표</a></td>
										<td class="date">2016-10-06</td>
										<td>23</td>
									</tr>
									<tr>
										<td>96</td>
										<td class="t-content"><a href="#">cool summer! 캠핑 경품 이벤트 당첨자 발표</a></td>
										<td class="date">2016-10-06</td>
										<td>96</td>
									</tr>
								</tbody>
							</table>
						</div>
						<nav aria-label="Page navigation" class="paging">
							<ul class="pagination">
								<li>
									<a href="#" aria-label="Previous" class="ap">
										<i aria-hidden="true" class="icon-angle-double-left"></i>
									</a> 
								</li>
								<li>
									<a href="#" aria-label="Previous" class="ap ap-mr">
										<i aria-hidden="true" class="icon-angle-left"></i>
									</a>
								</li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#" class="ap-mr">5</a></li>
								<li>
									<a href="#" aria-label="Next" class="ap">
										<i aria-hidden="true" class="icon-angle-right"></i>
									</a>
								</li>
								<li>
									<a href="#" aria-label="Next" class="ap">
										<i aria-hidden="true" class="icon-angle-double-right"></i>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</section-->
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>