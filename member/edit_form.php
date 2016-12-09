<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
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
		<main id="content">
			<div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
                <h2>회원정보수정</h2>
                <hr>
                <p>
                    변경된 고객님의 회원정보를 입력해주세요
                </p>
                <div class="snb">
                    <div class="container">
                        <button class="btn btn-block" type="button">
                            회원정보 수정
                        </button>
                        <nav>
                            <ul>
                                <li class="active"><a href="/member/edit_form.php">회원정보 수정</a></li>
                                <li><a href="/member/mypoint.php">마이포인트</a></li>
                                <li><a href="/member/inquiry_list.php">1:1 문의</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
			<div class="container">
				<section class="edit">
					<div class="section-content">
						<div class="edit-form">
							<h3>회원정보수정</h3>
							<?
							$member_code = "Mypage";
							include $dir."/module/member.php";
							?>
							<!--form>
								<div class="input-form type-1">
									<dl>
										<dt class="bold-before"> 이름</dt>
										<dd>스퀘어원</dd>
										<dt class="bold-before"> 아이디</dt>
										<dd class="user-dd user-id">SQUARE1</dd>
										<dt class="card"> 포인트카드번호</dt>
										<dd class="user-dd">1234-5678-9012-3456</dd>
										<dt class="bold-before">
											<label for="user-pw">비밀번호</label>
										</dt>
										<dd class="user-pw">
											<input type="password" id="user-pw" class="form-control" placeholder="※ 영문, 숫자 조합 6~12자">
											<p class="attention">
												※ 영문, 숫자 조합 6~12자
											</p>
										</dd>
										<dt class="bold-before">
											<label for="confirm-pw">비밀번호확인</label>
										</dt>
										<dd>
											<input type="password" id="confirm-pw" class="form-control">
										</dd>
										<dt class="bold-before">
											<label for="email">E-MAIL</label>
										</dt>
										<dd>
											<input type="text" id="email" class="form-control" placeholder="SQUARE1@square1.com">
										</dd>
										<dt class="bold-before">
											휴대폰번호
										</dt>
										<dd class="phone">
											<select class="form-control">
												<option value="">선택</option>
												<option value="">010</option>
											</select> &nbsp;&nbsp;-&nbsp;&nbsp;
											<label for="u-phone-2" class="sr-only">두번째 번호</label>
											<input type="text" id="u-phone-2" class="form-control" placeholder="4567"> &nbsp;&nbsp;-&nbsp;&nbsp;
											<label for="u-phone-3" class="sr-only">마지막 번호</label>
											<input type="text" id="u-phone-3" class="form-control" placeholder="4000">
										</dd>
										<dt class="bold-before">
											이메일수신동의
										</dt>
										<dd>
											<div class="check-box">
												<label><input type="checkbox">동의합니다.</label>
												<label><input type="checkbox">동의하지 않습니다.</label>
											</div>
										</dd>
									</dl>
								</div>
								<div class="btn-area">
                                    <p class="pull-left">
                                        <a href="#" class="btn btn-orange" role="button">완료</a>
                                        <a href="#" class="btn btn-default" role="button">취소</a>
                                    </p>
                                    <p class="pull-right">
                                        <a href="/member/member_leave.php" class="btn-leave">회원탈퇴</a>
                                    </p>
                                </div>
							</form-->
						</div>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script type="text/javascript" src="/board/config/mypage.js"></script>
</body>
</html>