<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g01 = "selected";
$s01 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/introduce.css">
</head>
<body class="sub introduce company concept">
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
                            SQUARE1 CONCEPT
                        </button>
                        <nav>
                            <ul>
                                <li><a href="/introduce/company.php">SQUARE1</a></li>
                                <li class="active"><a href="/introduce/concept.php">SQUARE1 CONCEPT</a></li>
                                <li><a href="/introduce/bi.php">SQUARE1 BI</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- 컨텐츠 영역 -->
            <div class="page-summary">
                <div class="container">
                    <h3>쉼, 즐거움, 휴식이 있는 스퀘어원은 <br>또 하나의 공간입니다.</h3>
                    <p>
                        SQUARE1은 마치 ‘섬(ISLAND)’으로 떠나는 여행처럼 일상을 벗어난 <br class="visible-sm">상상, 동경, 설레임, 탐험, 환상, 즐거움을 <br class="visible-md visible-lg">체험할 수 있는 곳으로  가고 싶고, 머물고 싶은 공간입니다. <br class="hidden-xs">쇼핑은 물론 외식, 문화와 체험, 여가생활까지 한 곳에서 즐길 수 있는 복합 문화소비공간, SQUARE1 
                    </p>
                </div> 
            </div>
            <div class="container concept-container">
                <div class="concept-content concept-1">
                    <div>
                        <span>01</span>
                        <p>
                            <i>지역사회의 사랑을 받는</i>
                            <b>만남의 공간</b>
                        </p>
                    </div>
                    <div></div>
                </div>
                <div class="concept-content concept-2">
                    <div>
                        <span>02</span>
                        <p>
                            <i>윤택한 생활을 위한</i>
                            <b>차세대 <br class="visible-sm">라이프 <br class="visible-xs">스타일 공간</b>
                        </p>
                    </div>
                    <div></div>
                </div>
            </div>
            <div class="concept-slogan">
                <div class="container">
                    <div class="slogan-content">
                        <i><span>YOUNG &amp; FAMILY</span>를 위한</i>
                        <span class="bar"></span>
                        <p>
                            <small>생활 여유형</small><br>
                            대규모 복합 쇼핑몰
                        </p>
                    </div>
                </div>
            </div>
            <div class="container concept-container">
                <div class="concept-content concept-3">
                    <div></div>
                    <div>
                        <span>03</span>
                        <p>
                            <i>폭넓은 세대가 <br class="hidden-lg">함께 즐길 수 있는</i>
                            <b>문화의 공간</b>
                        </p>
                    </div>
                </div>
                <div class="concept-content concept-4">
                    <div></div>
                    <div>
                        <span>04</span>
                        <p>
                            <i>새로움을 경험할 수 있는</i>
                            <b>창조의 공간</b>
                        </p>
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