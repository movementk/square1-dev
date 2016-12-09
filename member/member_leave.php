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
                <section class="member-leave">
                    <div class="section-header">
                        <h2>회원탈퇴</h2>
                        <hr>
                        <p>고객님을 위하여 더욱 노력하는 스퀘어원이 되겠습니다.</p>
                    </div>
                    <div class="section-content">
                        <h3>회원탈퇴 시 유의사항</h3>
                        <div class="attention-point">
                            <ul class="dot-list">
                                <li>
                                    SQUARE 1 회원 탈퇴 시 <i>동일한 아이디로 재 가입이 불가능</i> 하오니 유의하시기 바랍니다.
                                </li>
                                <li>
                                    SQUARE 1 회원 탈퇴 시 온라인 상으로 멤버쉽카드 포인트 모두 소멸되며,<br class="visible-sm"> 오프라인 매장에서 신규 발급 받으셔야합니다.
                                </li>
                                <li>
                                    온라인 회원 탈퇴 시 이벤트에 참여한 경품, 우편물 발송은 모두 취소됩니다.(발송 전 일 경우)
                                </li>
                                <li>
                                    회원 탈퇴시 EDM, SMS 발송이 되지않습니다.
                                </li>
                            </ul>
                        </div>
                        <form name="breakForm" method="post" action="/board/module/incmember/memberBreak_ok.php">
                            <div class="reason">
                                <h4><label for="leave">탈퇴사유</label></h4>
                                <div class="leave-form">
                                    <textarea id="leave" class="form-control" name="Content"></textarea>
                                </div>
                            </div>
                            <div class="btn-area">
                                <p>
                                    <a href="javascript:;" class="btn btn-orange" role="button" onclick="leaveCk();">확인</a>
                                    <a href="/" class="btn btn-default" role="button">취소</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </section>
            </div><!-- container -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script>
	function leaveCk(){
		if(!confirm("정말 탈퇴하시겠습니까?")) return;
		document.breakForm.submit();
	}
	</script>
</body>
</html>