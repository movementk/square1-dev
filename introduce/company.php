<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g01 = "selected";
$s01 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/introduce.css">
</head>
<body class="sub introduce company square1">
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
                            SQUARE1
                        </button>
                        <nav>
                            <ul>
                                <li class="active"><a href="/introduce/company.php">SQUARE1</a></li>
                                <li><a href="/introduce/concept.php">SQUARE1 CONCEPT</a></li>
                                <li><a href="/introduce/bi.php">SQUARE1 BI</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="summary">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-push-6">
                                <p class="figure">
                                    <img class="img-responsive" src="/assets/images/introduce/img_eye_view.png" alt="">
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-sm-pull-6">
                                <h3>생활의 격을 높일 <br class="visible-sm">Malling Island, SQUARE1 <br class="visible-sm visible-lg">인천에 새로운 문화와 <br class="visible-sm">라이프 스타일이 시작됩니다.</h3>
                                
                            </div>
                            <div class="col-xs-12 col-lg-6 col-lg-pull-6">
                                <p class="detials">
                                    인천에 세워진 대형 복합 쇼핑몰 SQUARE1은 보고, 느끼고, 먹고, 즐기고, 체험하는<br class="visible-lg">
                                    원스톱 몰링 공간입니다. 일탈을 꿈꾸고, 어디론가 떠나 즐겁고 편안한 휴식을 갖고 싶을 때<br class="visible-lg">
                                    SQUARE1을 찾아보세요. 낭만과 설레임, 새로운 감동이 기다리고 있습니다.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 컨텐츠 영역 -->
            
            <div class="feature">
                <div class="container">
                    <ul class="row">
                        <li class="col-xs-6 col-sm-4 col-sm-offset-1 col-lg-3 col-lg-offset-0">
                            <span>01</span>
                            <h4>LOCATION</h4>
                            <p>스퀘어원은 인천시 연수구 동춘동 926에 위치해 있으며 세계의 라이프 스타일을 선도하는 한류의 중심에 있습니다.</p>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-sm-offset-2 col-lg-3 col-lg-offset-0">
                            <span>02</span>
                            <h4>FLOOR</h4>
                            <p>B2 ~ 4F. 지하 2층부터 지상 4층까지 음식, 쇼핑 문화를 마음껏 즐기세요.</p>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-sm-offset-1 col-lg-3 col-lg-offset-0">
                            <span>03</span>
                            <h4>PARKING</h4>
                            <p>1,871대의 넓은 주차공간을 이용해 빠르게 스퀘어원을 이용하실 수 있습니다.</p>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-sm-offset-2 col-lg-3 col-lg-offset-0">
                            <span>04</span>
                            <h4>BRAND</h4>
                            <p>약 170여 개의 많은 브랜드가 입점해 있습니다.</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="figure">
                <ul>
                    <li>
                        <p>
                            <img src="/assets/images/introduce/img_figure_1.jpg" class="img-responsive" alt="">
                        </p>
                    </li>
                    <li>
                        <p>
                            <img src="/assets/images/introduce/img_figure_2.jpg" class="img-responsive" alt="">
                        </p>
                    </li>
                    <li>
                        <p>
                            <img src="/assets/images/introduce/img_figure_3.jpg" class="img-responsive" alt="">
                        </p>
                    </li>
                    <li>
                        <p>
                            <img src="/assets/images/introduce/img_figure_4.jpg" class="img-responsive" alt="">
                        </p>
                    </li>
                </ul>
            </div>
            <!-- // 컨텐츠 영역 -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>