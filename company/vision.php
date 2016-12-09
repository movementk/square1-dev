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
                            비전
                        </button>
                        <nav>
                            <ul>
                                <li><a href="/company/history.php">연혁</a></li>
                                <li><a href="/company/ideology.php">경영이념</a></li>
                                <li class="active"><a href="/company/vision.php">비전</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container">
                <section class="vision">
                    <div class="section-header">
                        <h3>SEOBU'S <br class="visible-xs"> TREASURE &amp; DREAM</h3>
                        <p>
                            보유 부동산들을 대규모 선진형 복합 쇼핑몰, 도심형<br class="visible-xs">
                            첨단 물류시설,<br class="hidden-xs"> HOTEL COMPLEX 등 다양한 선진형<br class="visible-xs">
                            상업시설로 개발 및 순차적으로 운영
                        </p>
                    </div>
                    <div class="section-content">
                        <hr>
                        <h4>VISION</h4>
                        <div class="vision-summary">
                            <p class="figure">
                                <img src="/assets/images/company/vision_xs_img.png" class="img-responsive visible-xs" alt="">
                                <img src="/assets/images/company/vision_sm_img.png" class="img-responsive visible-sm" alt="">
                                <img src="/assets/images/company/vision_md_img.png" class="img-responsive visible-md" alt="">
                                <img src="/assets/images/company/vision_md_img.png" class="img-responsive visible-lg" alt="">
                            </p>
                            <div class="sr-only">
                                <div>
                                    <h5>2009</h5>
                                    물류사업 / 임대사업
                                </div>
                                <div>
                                    <h5>2010</h5>
                                    신유통 사업 (복합쇼핑몰 개발)
                                </div>
                                <div>
                                    <h5>2014</h5>
                                    신유통사업의 마켓리더
                                </div>
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