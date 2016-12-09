<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php');
$s02 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/company.css">
</head>
<body class="sub company">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
    <div id="wrapper">
        <div id="top-bn">
        </div>
        <header id="header">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
            <div class="jumbo">
                <h1><small>회사소개</small>SEOBU T&amp;D</h1>
                <p>
                    인천의 풍요로운 라이프 스타일을 제공하는<br>
                    (주)서부 T&amp;D 입니다.
                </p>
            </div>
        </header>
        <main id="content">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb6.php'); ?>
            <div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
                <h1>서부 T&amp;D</h1>
                <div class="snb">
                    <div class="container">
                        <button class="btn btn-block" type="button">
                            경영이념
                        </button>
                        <nav>
                            <ul>
                                <li><a href="/company/history.php">연혁</a></li>
                                <li class="active"><a href="/company/ideology.php">경영이념</a></li>
                                <li><a href="/company/vision.php">비전</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container">
                <section class="ideology">
                    <div class="section-header">
                        <h3>언제나 새로운 도약을<br class="visible-xs"> 준비하는 기업,<br> (주)서부 T&amp;D만의 경영이념입니다.</h3>
                    </div>
                    <div class="section-content">
                        <div class="rule">
                            <ul class="row">
                                <li class="col-xs-12 col-sm-4">
                                    <div class="human">
                                        <div class="subject">
                                            <h4>CARE FOR <b>HUMAN</b></h4>
                                        </div>
                                        <div class="details">
                                            <h5>인재 우선주의의 인간 존중 경영</h5>
                                            <p>
                                                인재를 최고의 가치,<br class="hidden-xs"> 최고의 재산으로 여기며,<br>
                                                그들과 함께하는 가치창조를<br class="hidden-xs"> 완성해가는 기업
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-4">
                                    <div class="distribution">
                                        <h4>DEVELOP FOR<br><b>DISTRIBUTION</b></h4>
                                        <div class="details">
                                            <h5>21세기 신유통개발</h5>
                                            <p>
                                                쾌적한 상업시설,<br class="hidden-xs"> 효율적인 유통시설의 개발과<br>
                                                운영을 위해 부단한 노력을 경주하는 기업
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-4">
                                    <div class="risk">
                                        <h4>DARE TO <b>RISK</b></h4>
                                        <div class="details">
                                            <h5>과감한 도전에 의한 혁신 추구</h5>
                                            <p>
                                                과거에 안주하지않고 고객의 만족과<br>
                                                가치 창조를 위해서는<br>
                                                과감한 투자와 혁신을 추구하는 기업
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <div class="summary-img">
                                <p class="figure">
                                    <img src="/assets/images/company/ideology_sm_img.png" class="img-responsive visible-xs" alt="경영방침">
                                    <img src="/assets/images/company/ideology_img.png" class="img-responsive hidden-xs" alt="경영방침">
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