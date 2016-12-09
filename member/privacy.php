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
                <section class="terms-info privacy">
                    <div class="section-header">
                        <h2>개인정보취급방침</h2>
                        <hr>
                        <p>스퀘어원의 개인정보취급방침입니다.</p>
                    </div>
                    <div class="section-content">
                        <h3>개인정보취급방침</h3>
                        <div class="terms">
                            <?=get_agree(2)?>
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