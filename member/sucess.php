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
                <section class="sucess">
                    <div class="section-header">
                        <h2>회원가입</h2>
                        <hr>
                        <p>
                            스퀘어원 회원가입을 하시면<br class="visible-xs"> 
                            더많은 혜택을 이용하실 수 있습니다.
                        </p>
                    </div>
                    <div class="section-content">
                        <nav class="procedure">
                            <ol>
                                <li>
                                    <p class="pcd-img">
                                        <img src="/assets/images/member/procedure_non_img01.gif" alt="약관동의">
                                    </p>
                                    <h3>01.<br class="visible-xs"> 약관동의</h3>
                                </li>
                                <li>
                                    <p class="pcd-img">
                                        <img src="/assets/images/member/procedure_non_img02.gif" alt="실명확인">
                                    </p>
                                    <h3>02.<br class="visible-xs"> 실명확인</h3>
                                </li>
                                <li>
                                    <p class="pcd-img">
                                        <img src="/assets/images/member/procedure_non_img03.gif" alt="정보입력">
                                    </p>
                                    <h3>03.<br class="visible-xs"> 정보입력</h3>
                                </li>
                                <li class="active">
                                    <p class="pcd-img">
                                        <img src="/assets/images/member/procedure_img04.gif" alt="가입완료">
                                    </p>
                                    <h3>04.<br class="visible-xs"> 가입완료</h3>
                                </li>
                            </ol>
                        </nav>
                        <div class="join-sucess">
                            <h4>
                                당신의 또다른<br class="visible-xs"> LIFE STYLE, <b>SQUARE<i>1</i></b>
                            </h4>
                            <p class="underline">
                                회원가입이 완료되신 것을 <br class="visible-xs">진심으로 축하드립니다.
                            </p>
                            <p class="join-txt">
                                지금부터 SQUARE1에서만 즐기실 수 있는<br class="visible-xs"> 다양한 혜택을 누려보세요.
                            </p>
                            <div class="btn-area">
                                <p>
                                    <a href="/" class="btn btn-default" role="button">메인으로 이동</a>
                                    <a href="/member/login.php" class="btn btn-orange" role="button">로그인</a>
                                </p>
                            </div>
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