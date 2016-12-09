<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
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
			$s04 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb5.php');
			?>
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> Q&amp;A</h1>
                <h2>
                    스퀘어원과 관련된 궁금한 사항은<br>
                    무엇이든 물어보세요.
                </h2>
                <p>
                    제안ㆍ건의ㆍ만족ㆍ불만족 등과<br class="visible-xs">
                    관련된 고객님의 소중한 의견을 남겨주시면<br>
                    접수후 빠른 대응을 하도록하겠습니다.
                </p>
            </div>
			<div class="container">
				<section class="confirm">
					<div class="section-content">
						<div class="confirm-form">
							<form>
								<h4>비밀번호확인</h4>
								<p class="circle"><i></i><i></i><i></i><i></i></p>
								<p class="c-txt">고객님의 비밀번호를 입력해주세요.</p>
								<div class="form-group">
									<input type="password" id="u-pw" class="form-control" placeholder="비밀번호">
									<label for="u-pw" class="sr-only">비밀번호 확인</label>
									<p class="btn-basics">
										<a href="#" class="btn btn-gray" role="button">확인</a>
									</p>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>