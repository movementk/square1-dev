<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g01 = "selected";
$s01 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/introduce.css">
</head>
<body class="sub introduce company bi">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
    <div id="wrapper">
        <div id="top-bn">
        </div>
        <header id="header">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
            <div class="jumbo">
                <h1><small>스퀘어원 소개</small>SQUARE1</h1>
                <p>
                    인천에 새로운 문화와 라이프 스타일이 시작됩니다.<br>
                    새로운 쇼핑세상으로 초대합니다.
                </p>
            </div>
        </header>
        <main id="content">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb1.php'); ?>
            <div class="page-header has-snb">
                <h1><span class="square1">SQUARE<i>1</i></span> 소개</h1>
                <div class="snb">
                    <div class="container">
                        <button class="btn btn-block" type="button">
                            SQUARE1 BI
                        </button>
                        <nav>
                            <ul>
                                <li><a href="/introduce/company.php">SQUARE1</a></li>
                                <li><a href="/introduce/concept.php">SQUARE1 CONCEPT</a></li>
                                <li class="active"><a href="/introduce/bi.php">SQUARE1 BI</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- 컨텐츠 영역 -->
            <div class="page-summary">
                <div class="container">
                    <h3>고객의 행복을 지향하는 스퀘어원만의 <br>BRAND IDENTITY</h3>
                    <p>
                        열정<span class="color red">(RED)</span>, 신뢰<span class="color blue">(BLUE)</span>, 에너지<span class="color orange">(ORANGE)</span>,  풍요로운 라이프스타일<span class="color green">(GREEN)</span>
                    </p>
                </div>
            </div>
            <div class="container">
                <section class="bi-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-lg-3">
                            <header>
                                <h4>SIGNATURE</h4>
                            </header>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <div class="details">
                                <p>
                                    스퀘어원의 시그니처는 심벌마크와 로고 타입의 조합으로 스퀘어원의 이미지를 담고 있습니다.<br>
                                    위치, 비례, 형태, 색상의 변형 없이 사용되어야 하며 사용시 스퀘어원 표시물 관리지침에 의거하여 사용되어야 합니다. 
                                </p>
                            </div>
                            <div class="figure">
                                <p>
                                    <img class="img-responsive visible-xs" src="/assets/images/introduce/img_bi_signature_xs.gif" alt="">
                                    <img class="img-responsive visible-sm" src="/assets/images/introduce/img_bi_signature_sm.gif" alt="">
                                    <img class="img-responsive visible-md visible-lg" src="/assets/images/introduce/img_bi_signature_lg.gif" alt="">
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bi-content bi-logo">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-lg-3">
                            <header>
                                <h4>LOGO TYPE</h4>
                            </header>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <div class="details">
                                <p>
                                    로고 타입은 신개념 라이프스타일 공간을 표현하며 신뢰의(BLUE) Color와 품격의(BLACK) Color를 혼합한 흑청색을 사용하여 
                                    스퀘어원만의 차별화와 품격을 표현함과 동시에, 충분한 여백을 이용한 구성으로 풍요로운 라이프스타일을 표현하고 있습니다. 
                                </p>
                                <p>
                                    1은 처음, 최초, 최고 1을 의미하며, 이러한 스퀘어원의 열정과 에너지를 ORANGE Color로 나타내어 최고를 지향하는 스퀘어원을 표현합니다.<br>
                                    또한 처음으로 만나는 새로운 생활문화공간 최상의 쇼핑 및 엔터테인먼트 시설 최고의 경험을 제공하는 스퀘어원의 브랜드 이미지를 표현합니다.
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-sm-offset-4 col-lg-6 col-lg-offset-3">
                            <div class="figure figure-1">
                                <p>
                                    <img class="img-responsive visible-xs" src="/assets/images/introduce/img_bi_logotype1_xs.gif" alt="">
                                    <img class="img-responsive visible-sm" src="/assets/images/introduce/img_bi_logotype1_sm.gif" alt="">
                                    <img class="img-responsive visible-md visible-lg" src="/assets/images/introduce/img_bi_logotype1_lg.gif" alt="">
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="figure figure-2">
                                <p>
                                    <img class="img-responsive visible-xs" src="/assets/images/introduce/img_bi_logotype2_xs.gif" alt="">
                                    <img class="img-responsive visible-sm" src="/assets/images/introduce/img_bi_logotype2_sm.gif" alt="">
                                    <img class="img-responsive visible-md visible-lg" src="/assets/images/introduce/img_bi_logotype2_lg.gif" alt="">
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bi-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-lg-3">
                            <header>
                                <h4>SYMBOL</h4>
                            </header>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <div class="details">
                                <p>
                                    스퀘어원의 심벌마크는 다양한 라이프스타일의 시너지를 이루는 유통 허브의 기업 이미지를 표현합니다. 각각의 컬러는 열정(RED), 신뢰(BLUE), 에너지 (ORANGE), 풍요로운 라이프스타일(GREEN)을 상징하며 ㈜서부 T&amp;D의 기업 정신을 발전 계승하였습니다. 
                                </p>
                            </div>
                            <div class="figure">
                                <p>
                                    <img class="img-responsive visible-xs" src="/assets/images/introduce/img_bi_symbol_xs.gif" alt="">
                                    <img class="img-responsive visible-sm" src="/assets/images/introduce/img_bi_symbol_sm.gif" alt="">
                                    <img class="img-responsive visible-md visible-lg" src="/assets/images/introduce/img_bi_symbol_lg.gif" alt="">
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- // 컨텐츠 영역 -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>