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
				<section class="login">
					<div class="section-header">
						<h2>LOGIN</h2>
						<hr>
						<p>스퀘어원을 방문해주셔서 감사합니다.</p>
					</div>
					<div class="section-content">
						<div class="login-form">
							<?
							$member_code = "Login";
							include $dir."/module/member.php";
							?>
							<!--form>
								<div class="form-group">
									<input type="text" id="user-id" class="form-control" placeholder="아이디">
									<input type="password" id="user-pw" class="form-control" placeholder="비밀번호">
								</div>
								<div class="btn-area">
									<p>
										<a href="#" class="btn btn-gray" role="button">로그인</a>
									</p>
								</div>
							</form-->
						</div>
						<ul class="dot-list">
							<li>
								아직 square1 가입이 안되셨나요?<br>
								<a href="terms.php">회원가입하기</a>
							</li>
							<li>
								아이디 또는 비밀번호가 생각나지 않으세요?<br>
								<a href="find.php">아이디/비밀번호 찾기</a>
							</li>
						</ul>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>