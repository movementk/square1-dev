<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/member.css">
</head>
<body class="sub member">
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
		<main id="content">
			<div class="container">
				<section class="find">
					<div class="section-header">
						<h2>아이디/비밀번호 찾기</h2>
						<hr>
						<p>해당정보를 입력하시면 아이디와 비밀번호를<br class="visible-xs"> 바로 확인하실수 있습니다.</p>
					</div>
					<?
					$member_code = "Search";
					include $dir."/module/member.php";
					?>
					<!--div class="section-content">
						<h3>아이디 찾기</h3>
						<div class="id-find">
							<form>
								<div class="find-form">
									<dl>
										<dt><label for="u-name">이름</label></dt>
										<dd><input type="text" id="u-name" class="form-control"></dd>
										<dt class="mt-dt"><label for="u-mail">E-MAIL</label></dt>
										<dd>
											<input type="email" id="u-mail" class="form-control">
											<p class="reference">가입하신 이메일 주소로 아이디가 발송됩니다.</p>
										</dd>
									</dl>
								</div>
								<div class="btn-area">
									<p>
										<a href="#" class="btn btn-orange" role="button">확인</a>
										<a href="#" class="btn btn-default" role="button">취소</a>
									</p>
								</div>
							</form>
						</div>
						<h3>비밀번호 찾기</h3>
						<div class="pw-find">
							<form>
								<div class="find-form">
									<dl>
										<dt><label for="u-name2">이름</label></dt>
										<dd><input type="text" id="u-name2" class="form-control"></dd>
										<dt class="mt-dt"><label for="u-id">아이디</label></dt>
										<dd><input type="text" id="u-id" class="form-control"></dd>
										<dt class="mt-dt"><label for="u-mail2">E-MAIL</label></dt>
										<dd>
											<input type="email" id="u-mail2" class="form-control">
											<p class="reference">가입하신 이메일 주소로 아이디가 발송됩니다.</p>
										</dd>
									</dl>
								</div>
								<div class="btn-area">
									<p>
										<a href="#" class="btn btn-orange" role="button">확인</a>
										<a href="#" class="btn btn-default" role="button">취소</a>
									</p>
								</div>
							</form>
						</div>
					</div-->
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>