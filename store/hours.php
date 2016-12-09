<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g02 = "selected";
$s04 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/store.css">
</head>
<body class="sub store hours">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>매장안내</small>SQUARE1 GUIDE</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의 라이프 스타일 공간입니다.<br>
					FASHION · F&amp;B · CGV · HOMEPLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php 
			$s04 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb2.php');
			?>
			<div class="page-header">
				<h1><span class="square1">SQUARE<i>1</i></span> 영업시간안내</h1>
			</div>
			<!-- 컨텐츠 영역 -->
			<div class="page-summary">
				<div class="container">
					<h3>설레임을 즐기기위한 시간안내 입니다.</h3>
					<p>
						SQUARE1은 글로벌 SPA, CGV, 홈플러스, 병원등 일상 생활에 있어 다양하고 필요한 전문 브랜드가 입점해 있으며, <br class="visible-md visible-lg">
						각 브랜드 별 영업시간에 다소 차이가 있을 수 있습니다.
					</p>
				</div>
			</div>
			<div class="square1-hours">
				<div class="container">
					<div>
						<h3><b>SQUARE<i>1</i></b> <span>영업시간 안내</span></h3>
						<p><small>AM</small> 10:30 - <small>PM</small> 10:00</p>
					</div>
				</div>
			</div>
			<div class="store-hours">
				<div class="container">
					<ul>
						<li>
							<div class="row">
								<div class="col-xs-12 col-sm-7">
									<div class="brand">
										<p class="brand-icon">
											<img src="/assets/images/introduce/brand_logo01.jpg" class="img-responsive" alt="스퀘어원">
										</p>
										<p class="b-ico-name hidden-xs">
											스퀘어원
										</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="details-time">
										<p class="b-name visible-xs">스퀘어원</p>
										<p class="b-time">AM 10:30 - PM 10:00</p>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-12 col-sm-7">
									<div class="brand">
										<p class="brand-icon">
											<img src="/assets/images/introduce/brand_logo02.jpg" class="img-responsive" alt="CGV">
										</p>
										<p class="b-ico-name hidden-xs">
											CGV
										</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="details-time">
										<p class="b-name visible-xs">CGV</p>
										<p class="b-time">
											AM 08:00 - PM 25:00(성수기)<br>
											<i>AM 09:00 - PM 24:00(비수기)</i>
										</p>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-12 col-sm-7">
									<div class="brand">
										<p class="brand-icon">
											<img src="/assets/images/introduce/brand_logo03.jpg" class="img-responsive" alt="홈플러스">
										</p>
										<p class="b-ico-name hidden-xs">
											홈플러스
										</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="details-time">
										<p class="b-name visible-xs">홈플러스</p>
										<p class="b-time">
											AM 09:00 - PM 12:00<br>
											<i>(2,4째주 일요일 휴무)</i>
										</p>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-12 col-sm-7">
									<div class="brand">
										<p class="brand-icon">
											<img src="/assets/images/introduce/brand_logo04.jpg" class="img-responsive" alt="베세토메디컬 병원">
										</p>
										<p class="b-ico-name hidden-xs">
											병원<br>
											(베세토메디컬)
										</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="details-time">
										<p class="b-name visible-xs">
											병원<br>
											<small>(베세토메디컬)</small>
										</p>
										<p class="b-time">AM 10:30 - PM 08:00</p>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-12 col-sm-7">
									<div class="brand">
										<p class="brand-icon">
											<img src="/assets/images/introduce/brand_logo05.jpg" class="img-responsive" alt="편의점">
										</p>
										<p class="b-ico-name hidden-xs">
											편의점
										</p>
									</div>
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="details-time">
										<p class="b-name visible-xs">편의점</p>
										<p class="b-time">AM 07:00 - AM 01:00</p>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- // 컨텐츠 영역 -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>