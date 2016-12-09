<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g02 = "selected";
$s05 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/store.css">
</head>
<body class="sub store point">
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
                <h1><span class="square1">SQUARE<i>1</i></span> 포인트카드</h1>
            </div>
            <!-- 컨텐츠 영역 -->
            <div class="summary">
                <div class="container">
                    <article class="point-card">
                        <h2 class="visible-xs visible-sm">SQUARE1 POINT CARD로<br> 다양한 혜택을 누리세요.</h2>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-5">
                                <p class="card-img">
                                    <img src="/assets/images/store/membership_card.gif" class="img-responsive" alt="membership card">
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-7">
                                <div class="my-point">
                                    <h2 class="hidden-xs hidden-sm">SQUARE1 POINT CARD로<br> 다양한 혜택을 누리세요.</h2>
                                    <p>
                                        스퀘어원 포인트카드는 스퀘어원 이용 시 구매금액의 <i>1%를 적립</i> 할수 있으며,<br class="hidden-xs hidden-sm"> 누적된 포인트가 일정 수준이상이 되면 이를 포인트 금액대별 차감 기프트로<br class="hidden-xs hidden-sm"> 교환하실 수 있습니다.
                                    </p>
                                    <a href="/member/mypoint.php">내 포인트 보기</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="card-information">
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-chat"></i> 스퀘어원 포인트카드 안내</h4>
                                <p class="info-txt">
                                    결제 기능 없이 단순 포인트 적립 및 사용만 가능한 카드이며, 적립된 포인트가 6,000포인트 금액대별 차감 기프트를 제공합니다. <br class="visible-md visible-lg"> 만 14세이상 대한민국 거주 내/외국인 누구나 발급 가능하며, 별도의 연회비가 없습니다.
                                </p>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-users"></i> 포인트카드 회원혜택 <small> (기준일 : 2015년 3월 2일) </small></h4>
                                <ul class="benefit-list row">
                                    <li class="col-xs-6 col-sm-4">
                                        <div class="cgv">
                                            <p class="item-icon">
                                                <img src="/assets/images/introduce/item_001.gif" class="img-responsive" alt="CGV">
                                            </p>
                                            <dl>
                                                <dt>인천연수점 전품목<br class="visible-xs">콤보세트</dt>
                                                <dd>3,000원 할인</dd>
                                            </dl>
                                        </div>
                                    </li>
                                    <li class="col-xs-6 col-sm-4">
                                        <div class="chinaf">
                                            <p class="item-icon">
                                                <img src="/assets/images/introduce/item_002.gif" class="img-responsive" alt="차이나팩토리">
                                            </p>
                                            <dl>
                                                <dt>차이나팩토리</dt>
                                                <dd>10% 상시 할인</dd>
                                            </dl>
                                        </div>
                                    </li>
                                    <li class="col-xs-6 col-sm-4">
                                        <div class="bibigo">
                                            <p class="item-icon">
                                                <img src="/assets/images/introduce/item_003.gif" class="img-responsive" alt="비비고">
                                            </p>
                                            <dl>
                                                <dt>비비고</dt>
                                                <dd>10% 상시 할인</dd>
                                            </dl>
                                        </div>
                                    </li>
                                    <li class="col-xs-6 col-sm-4">
                                        <div class="hakoya">
                                            <p class="item-icon">
                                                <img src="/assets/images/introduce/item_004.gif" class="img-responsive" alt="하코야">
                                            </p>
                                            <dl>
                                                <dt>하코야</dt>
                                                <dd>10% 상시 할인</dd>
                                            </dl>
                                        </div>
                                    </li>
                                    <li class="col-xs-6 col-sm-4">
                                        <div class="smoothie">
                                            <p class="item-icon">
                                                <img src="/assets/images/introduce/item_005.gif" class="img-responsive" alt="스무디킹">
                                            </p>
                                            <dl>
                                                <dt>스무디킹</dt>
                                                <dd>5% 상시 할인</dd>
                                            </dl>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details point-benefit">
                                <h4><i class="icon-star"></i> 적립 포인트 혜택 <small> (기준일 : 2015년 2월 1일) </small></h4>
                                <p class="info-txt">
                                    포인트 금액대별 차감 기프트가 제공되며, 1층 포인트카드 데스크에서 포인트 차감 후 지급해 드립니다. 또한 우수고객을 대상으로 LMS 문자를 통해 문화공연 및 시사회 초대 혜택을 드립니다.
                                </p>
                                <div class="table-wrap">
                                    <table class="table table-bordered">
                                        <colgroup>
                                            <col style="width: 30%">
                                            <col style="width: 70%">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>포인트</th>
                                                <th>혜택</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>6,000포인트</td>
                                                <td>CGV인천연수점 무료영화관람권 1매</td>
                                            </tr>
                                            <tr>
                                                <td>12,000포인트</td>
                                                <td>CGV인천연수점<br class="visible-xs">무료영화관람권 1매 + CGV콤보세트</td>
                                            </tr>
                                            <tr>
                                                <td>30,000포인트</td>
                                                <td>스퀘어원 매장 금액권(3만원)</td>
                                            </tr>
                                            <tr>
                                                <td>60,000포인트</td>
                                                <td>스퀘어원 매장 금액권(6만원)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <dl class="attention">
                                    <dt>금액권 사용 불가 매장</dt>
                                    <dd>홈플러스, CGV, CU편의점, 약국, 병원, LG하우스, 게임센터</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-credit-card"></i> 카드 발급 및 적립 안내</h4>
                                <ul class="dot-list">
                                    <li>
                                        <dl>
                                            <dt>카드 발급</dt>
                                            <dd>1층 포인트카드 데스크</dd>
                                        </dl>
                                    </li>
                                    <li>
                                        <dl>
                                            <dt>포인트 적립</dt>
                                            <dd>구매 매장 및 1층 포인트카드 센터</dd>
                                        </dl>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4>
                                    <i class="icon-cancel-circled2"></i> 스퀘어원 포인트 적립 제외 매장<br class="visible-xs">
                                    <small class="s-margin"> (기준일 : 2015년 5월 3일)</small>
                                </h4>
                                <p class="info-txt">
                                    ZARA, H&amp;M, 유니클로, 마시모두띠, 폴앤베어, 버쉬카, 스트라디바리우스, 빕스, 차이나팩토리, 투썸플레이스, CU편의점, LG하우시스, CGV, 홈플러스, <br class="visible-lg">
                                    올리브영, 베세토메디컬(병원/약국), 고정현헤어, 게임센터, 반짇고리
                                </p>
                                <p class="point-txt">적립 제외 매장은 추후 변경될 수 있습니다.</p>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-credit-card"></i> 카드 재발급 및 카드 분실</h4>
                                <dl class="dot-dl">
                                    <dt>카드 재발급</dt>
                                    <dd>
                                        스퀘어원 포인트카드를 재발급 받으실 경우 본인 신분증 소지 후,
                                        1층 포인트카드 데스크에 방문 하시면 재발급 신청이 가능합니다.
                                    </dd>
                                    <dt>카드 분실신고</dt>
                                    <dd>
                                        스퀘어원카드를 분실하였을 경우 본인 신분증 소지 후,
                                        1층포인트 카드 데스크에 직업 방문하여 신고하시고 재발급 받으시면 됩니다.
                                    </dd>
                                    <dt>문의전화</dt>
                                    <dd class="mb-zero">
                                        456-4030(스퀘어원 포인트카드 데스크) 스퀘어원 포인트카드 분실에 의한
                                        부정사용 및 손실에 대한 책임은 본인 회원에게 있습니다.
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-credit-card"></i> 포인트카드 마일리지 유효기간 및 소멸안내 </h4>
                                <p class="info-txt">
                                    스퀘어원 포인트카드 마일리지 유효기간은 마일리지 적립일로부터 1년(12개월)까지 사용 가능합니다.<br class="hidden-xs"> 기간 내 미사용 시 월 단위로 소멸됩니다.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <!-- // 컨텐츠 영역 -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>