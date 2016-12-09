<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g02 = "selected";
$s06 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/store.css">
</head>
<body class="sub store parking">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
    <div id="wrapper">
        <div id="top-bn">
        </div>
        <header id="header">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
            <div class="jumbo">
                <h1><small>매장안내</small>SQUARE1 GUIDE</h1>
                <p>
                    새로운 공간을 선두하는 스퀘어원의 라이프 스타일 공간입니다.<br>
                    FASHION · F&amp;B · CGV · HOMEPLUS 등의 다양한 서비스를 소개합니다.
                </p>
            </div>
        </header>
        <main id="content">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb2.php'); ?>
            <div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 주차시설안내</h1>
            </div>
            <!-- 컨텐츠 영역 -->
            <div class="page-summary">
                <div class="container">
                    <h3>편리하고 여유로운 주차공간이<br> 마련되어 있습니다</h3>
                    <p>
                        스퀘어원의 주차시설을 소개합니다.
                    </p>
                </div>
            </div>
            <div class="container">
                <div class="parking-map">
                    <img src="/assets/images/store/parking_maps.gif" class="img-responsive" alt="주차장 입구">
                </div>
                <div class="parking-info">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="summary">
                                <h4><i class="icon-cab"></i> SQUARE1 주차안내</h4>
                                <ul class="dot-list">
                                    <li>SQUARE1 주차장 입구는 총 4곳으로 구성되어 있습니다.</li>
                                    <li>1층 ~ 3층 주차장은 매장으로 직출입이 가능합니다.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="fare">
                                <h4><i class="icon-cab"></i> SQUARE1 주차요금 안내</h4>
                                <ul class="dot-list">
                                    <li>
                                        최초 30분 무료. 초과 시 10분당 500원<br>
                                        (무료 주차는 당일 영수증에 한함)
                                    </li>
                                    <li>
                                        영수증 3만원 미만 - 3시간 무료 / 영수증 3만원  이상 - 5시간 무료
                                    </li>
                                    <li>스퀘어원, CGV, 홈플러스 영수증 합산 가능</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // 컨텐츠 영역 -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>