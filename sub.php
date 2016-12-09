<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/assets/css/sub.css">
</head>
<body class="sub">
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
            <div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
                <h1><span class="square1">SQUARE<i>1</i></span> 소개</h1>

                <div class="snb">
                    <div class="container">
                        <button class="btn btn-block" type="button">
                            SQUARE1
                        </button>
                        <nav>
                            <ul>
                                <li class="active"><a href="#">SQUARE1</a></li>
                                <li><a href="#">SQUARE1 CONCEPT</a></li>
                                <li><a href="#">SQUARE1 BI</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- 가이드 작성 영역 -->
            
            <div class="container">
                <div style="margin: 30px 0;">
                    <p class="reference">
                        금액권 사용 불가 매장 : 홈플러스, CGV, CU편의점, 약국, 병원,  LG하우스, 게임센터
                    </p>
                    <ul class="dot-list">
                        <li>카드 발급</li>
                        <li>포이트 적립</li>
                    </ul>

                    <nav aria-label="Page navigation" class="paging">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous" class="ap">
                                    <i aria-hidden="true" class="icon-angle-double-left"></i>
                                </a> 
                            </li>
                            <li>
                                <a href="#" aria-label="Previous" class="ap ap-mr">
                                    <i aria-hidden="true" class="icon-angle-left"></i>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#" class="ap-mr">5</a></li>
                            <li>
                                <a href="#" aria-label="Next" class="ap">
                                    <i aria-hidden="true" class="icon-angle-right"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" aria-label="Next" class="ap">
                                    <i aria-hidden="true" class="icon-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="btn-area">
                        <p>
                            <a href="#" class="btn btn-orange" role="button">확인</a>
                            <a href="#" class="btn btn-default" role="button">취소</a>
                            <a href="#" class="btn btn-gray" role="button">로그인</a>
                            <a href="#" class="btn btn-sms" role="button">휴대폰인증하기</a>
                        </p>
                    </div>
                    <p class="btn-basic">
                        <a href="#" class="btn" role="button">중복확인</a>
                    </p>
                </div>
                <nav class="board-list">
                    <ul class="row">
                        <li class="col-xs-4 col-sm-2 active">
                            <a href="#">ALL</a>
                        </li>
                        <li class="col-xs-4 col-sm-2">
                            <a href="#">매장안내</a>
                        </li>
                        <li class="col-xs-4 col-sm-2">
                            <a href="#">이벤트</a>
                        </li>
                        <li class="col-xs-4 col-sm-2">
                            <a href="#">편의시설</a>
                        </li>
                        <li class="col-xs-4 col-sm-2">
                            <a href="#">주차/교통</a>
                        </li>
                        <li class="col-xs-4 col-sm-2">
                            <a href="#">기타</a>
                        </li>
                    </ul>
                </nav>
                <div style="margin: 30px 0;">
                    <div class="calendar-form">
                        <form>
                            <div class="calendar">
                                <p class="selecter">
                                    <input type="text" id="datepicker" class="form-control in-mr">
                                    <label for="datepicker">
                                        <i class="icon-calendar">
                                            <span class="sr-only">시작날짜조회</span>
                                        </i>
                                    </label>
                                </p>
                                -
                                <p class="selecter">
                                    <input type="text" id="datepicker-2" class="form-control in-mr">
                                    <label for="datepicker-2">
                                        <i class="icon-calendar">
                                            <span class="sr-only">종료날짜조회</span>
                                        </i>
                                    </label>
                                </p>
                            </div>
                            <div class="c-search">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="">전체</option>
                                    </select>
                                    <label for="search-keyword" class="sr-only">검색어</label>
                                    <input id="search-keyword" type="text" class="form-control">
                                    
                                    <button type="submit" class="btn">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <div class="search-form">
                        <form>
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="">전체</option>
                                </select>
                                <label for="search-keyword" class="sr-only">검색어</label>
                                <input id="search-keyword" type="text" class="form-control">
                            </div>
                            <button type="submit" class="btn">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </div>
                </div>
                <h1 style="font-size:20px; color:#f54c4c; margin: 30px 0;">카테고리별안내</h1>
                <div style="margin-bottom: 30px;">
                    <div class="category-list">
                        <ul class="row">
                            <li class="col-xs-12 col-sm-6">
                                <div class="category-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="figure">
                                                <p>
                                                    <img class="img-responsive" src="/assets/images/introduce/category_item01.jpg" alt="유니클로">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="details">
                                                <dl>
                                                    <dt>유니클로</dt>
                                                    <dd class="c-tel">
                                                        <i class="icon-phone"></i>
                                                        <a href="tel:0314564466">032-456-4466</a>
                                                    </dd>
                                                    <dd class="c-clock">
                                                        <i class="icon-clock"></i>10:00 - 22:00
                                                    </dd>
                                                    <dd class="c-floor">
                                                        <i class="icon-location"></i>2F
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-xs-12 col-sm-6">
                                <div class="category-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="figure">
                                                <p>
                                                    <img class="img-responsive" src="/assets/images/introduce/category_item02.jpg" alt="숲">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="details">
                                                <dl>
                                                    <dt>숲</dt>
                                                    <dd class="c-tel">
                                                        <i class="icon-phone"></i>
                                                        <a href="tel:0314564466">032-456-4466</a>
                                                    </dd>
                                                    <dd class="c-clock">
                                                        <i class="icon-clock"></i>10:00 - 22:00
                                                    </dd>
                                                    <dd class="c-floor">
                                                        <i class="icon-location"></i>2F
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-xs-12 col-sm-6">
                                <div class="category-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="figure">
                                                <p>
                                                    <img class="img-responsive" src="/assets/images/introduce/category_item03.jpg" alt="lap">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="details">
                                                <dl>
                                                    <dt>LAP</dt>
                                                    <dd class="c-tel">
                                                        <i class="icon-phone"></i>
                                                        <a href="tel:0314564466">032-456-4466</a>
                                                    </dd>
                                                    <dd class="c-clock">
                                                        <i class="icon-clock"></i>10:00 - 22:00
                                                    </dd>
                                                    <dd class="c-floor">
                                                        <i class="icon-location"></i>2F
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-xs-12 col-sm-6">
                                <div class="category-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="figure">
                                                <p>
                                                    <img class="img-responsive" src="/assets/images/introduce/category_item04.jpg" alt="클라이드앤">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="details">
                                                <dl>
                                                    <dt>클라이드앤</dt>
                                                    <dd class="c-tel">
                                                        <i class="icon-phone"></i>
                                                        <a href="tel:0314564466">032-456-4466</a>
                                                    </dd>
                                                    <dd class="c-clock">
                                                        <i class="icon-clock"></i>10:00 - 22:00
                                                    </dd>
                                                    <dd class="c-floor">
                                                        <i class="icon-location"></i>2F
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-xs-12 col-sm-6">
                                <div class="category-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="figure">
                                                <p>
                                                    <img class="img-responsive" src="/assets/images/introduce/category_item05.jpg" alt="로엠">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="details">
                                                <dl>
                                                    <dt>로엠</dt>
                                                    <dd class="c-tel">
                                                        <i class="icon-phone"></i>
                                                        <a href="tel:0314564466">032-456-4466</a>
                                                    </dd>
                                                    <dd class="c-clock">
                                                        <i class="icon-clock"></i>10:00 - 22:00
                                                    </dd>
                                                    <dd class="c-floor">
                                                        <i class="icon-location"></i>2F
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-xs-12 col-sm-6">
                                <div class="category-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="figure">
                                                <p>
                                                    <img class="img-responsive" src="/assets/images/introduce/category_item06.jpg" alt="플라스틱아일랜드">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="details">
                                                <dl>
                                                    <dt>플라스틱아일랜드</dt>
                                                    <dd class="c-tel">
                                                        <i class="icon-phone"></i>
                                                        <a href="tel:0314564466">032-456-4466</a>
                                                    </dd>
                                                    <dd class="c-clock">
                                                        <i class="icon-clock"></i>10:00 - 22:00
                                                    </dd>
                                                    <dd class="c-floor">
                                                        <i class="icon-location"></i>2F
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <h1 style="font-size:20px; color:#f54c4c; margin: 30px 0;">층별안내</h1>
                <div style="margin-bottom: 30px;">
                    <div class="floor-information">
                        <ul>
                            <li class="f-info1">엘레베이터</li>
                            <li class="f-info2">화장실</li>
                            <li class="f-info3">장애인화장실</li>
                            <li class="f-info4">유아휴게실</li>
                            <li class="f-info5">수유실</li>
                            <li class="f-info6">유아놀이방</li>
                            <li class="f-info7">딜리버리서비스</li>
                            <li class="f-info8">ATM</li>
                            <li class="f-info9">수선실</li>
                        </ul>
                    </div>
                </div>

                <h1 style="font-size:20px; color:#f54c4c; margin: 30px 0;">편의시설안내</h1>
                <div style="margin-bottom: 30px;">
                    <div class="amenity-list">
                        <ul class="row">
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info1">
                                    <div class="a-header">
                                        <h3>
                                            <small>INFORMATION</small>
                                            안내데스크
                                        </h3>
                                        <p>
                                            SQUARE1 이용 전반에 대한<br>
                                            정보를 친절히 안내해드립니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dt>운영시간</dt>
                                        <dd>10:30 ~ 22:00</dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info2">
                                    <div class="a-header">
                                        <h3>
                                            <small>STROLLER RENTAL</small>
                                            유모차 대여소
                                        </h3>
                                        <p>
                                            유아동반 고객의 편안한<br class="visible-xs">
                                            쇼핑을 위해<br class="hidden-xs"> 유모차를 무료로<br  class="visible-xs">
                                            대여해드립니다.<br>
                                            <i>(24개월 이상 유아 대여불가)</i>
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dt>운영시간</dt>
                                        <dd>10:30 ~ 22:00</dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info3">
                                    <div class="a-header">
                                        <h3>
                                            <small>NURSING ROOM</small>
                                            수유실
                                        </h3>
                                        <p>
                                            엄마과 아기가 편안하게<br>
                                            쉬어갈 수 있도록 마련한<br class="visible-xs">
                                            공간입니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dd>
                                            2층 <i class="icon-location"></i>
                                        </dd>
                                        <dd class="clear">
                                            3층 <i class="icon-location"></i>
                                        </dd>
                                        <dd>
                                            4층 <i class="icon-location"></i>
                                        </dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info4">
                                    <div class="a-header">
                                        <h3>
                                            <small>HANDICAPPED ONLY</small>
                                            장애인 화장실
                                        </h3>
                                        <p>
                                            장애인을 위한 화장실이<br>
                                            구비되어 있습니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dd>
                                            2층 <i class="icon-location"></i>
                                        </dd>
                                        <dd class="clear">
                                            3층 <i class="icon-location"></i>
                                        </dd>
                                        <dd>
                                            4층 <i class="icon-location"></i>
                                        </dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info5">
                                    <div class="a-header">
                                        <h3>
                                            <small>ATM</small>
                                            ATM기
                                        </h3>
                                        <p>
                                            쇼핑 이용의 편리함을 돕고자<br>
                                            곳곳에 구비되어 있습니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dd>
                                            4층 <i class="icon-location"></i>
                                        </dd>
                                        <dt>운영시간</dt>
                                        <dd>10:30 ~ 22:00</dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info6">
                                    <div class="a-header">
                                        <h3>
                                            <small>CLOTHING ALTERATION SERVICE</small>
                                            수선실
                                        </h3>
                                        <p>
                                            쇼핑 이용의 편리함을 돕고자<br>
                                            곳곳에 구비되어 있습니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dt>운영시간</dt>
                                        <dd>10:30 ~ 22:00</dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info7">
                                    <div class="a-header">
                                        <h3>
                                            <small>POINTCARD DESK</small>
                                            포인트카드 데스크
                                        </h3>
                                        <p>
                                            포인트카드 이용에 대한 정보를<br>
                                            친절히 안내해드립니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dt>운영시간</dt>
                                        <dd>10:30 ~ 22:00</dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info8">
                                    <div class="a-header">
                                        <h3>
                                            <small>LOCKER</small>
                                            물품보관함
                                        </h3>
                                        <p>
                                            쇼핑 이용의 편리함을 돕고자<br>
                                            곳곳에 구비되어 있습니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                        <dd>
                                            2층 <i class="icon-location"></i>
                                        </dd>
                                        <dd class="clear">
                                            3층 <i class="icon-location"></i>
                                        </dd>
                                    </dl>
                                </a>
                            </li>
                            <li class="col-xs-12 col-sm-6 col-md-4">
                                <a href="#" class="a-info9">
                                    <div class="a-header">
                                        <h3>
                                            <small>SMOKING AREA</small>
                                            흡연실
                                        </h3>
                                        <p>
                                            쇼핑 이용의 편리함을 돕고자<br>
                                            곳곳에 구비되어 있습니다.
                                        </p>
                                    </div>
                                    <dl>
                                        <dt>위치</dt>
                                        <dd>
                                            1층 <i class="icon-location"></i>
                                        </dd>
                                    </dl>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <h1 style="font-size:20px; color:#f54c4c; margin: 30px 0;">영업시간안내</h1>
                <div style="padding: 30px 0;">
                    <div class="store-hours">
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7">
                                        <div class="brand">
                                            <p class="brand-icon">
                                                <img src="/assets/images/introduce/brand_logo01.jpg" class="img-responsive" alt="스퀘어원">
                                            </p>
                                            <p class="b-ico-name hidden-xs">
                                                스퀘어원
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="details-time">
                                            <p class="b-name visible-xs">스퀘어원</p>
                                            <p class="b-time">AM 10:30 - PM 10:00</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7">
                                        <div class="brand">
                                            <p class="brand-icon">
                                                <img src="/assets/images/introduce/brand_logo02.jpg" class="img-responsive" alt="CGV">
                                            </p>
                                            <p class="b-ico-name hidden-xs">
                                                CGV
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="details-time">
                                            <p class="b-name visible-xs">CGV</p>
                                            <p class="b-time">
                                                AM 08:00 - PM 25:00(성수기)<br>
                                                <i>AM 09:00 - PM 24:00(비수기)</i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7">
                                        <div class="brand">
                                            <p class="brand-icon">
                                                <img src="/assets/images/introduce/brand_logo03.jpg" class="img-responsive" alt="홈플러스">
                                            </p>
                                            <p class="b-ico-name hidden-xs">
                                                홈플러스
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="details-time">
                                            <p class="b-name visible-xs">홈플러스</p>
                                            <p class="b-time">
                                                AM 09:00 - PM 12:00<br>
                                                <i>(2,4째주 일요일 휴무)</i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7">
                                        <div class="brand">
                                            <p class="brand-icon">
                                                <img src="/assets/images/introduce/brand_logo04.jpg" class="img-responsive" alt="베세토메디컬 병원">
                                            </p>
                                            <p class="b-ico-name hidden-xs">
                                                병원<br>
                                                (베세토메디컬)
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="details-time">
                                            <p class="b-name visible-xs">
                                                병원<br>
                                                <small>(베세토메디컬)</small>
                                            </p>
                                            <p class="b-time">AM 10:30 - PM 08:00</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7">
                                        <div class="brand">
                                            <p class="brand-icon">
                                                <img src="/assets/images/introduce/brand_logo05.jpg" class="img-responsive" alt="편의점">
                                            </p>
                                            <p class="b-ico-name hidden-xs">
                                                편의점
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="details-time">
                                            <p class="b-name visible-xs">편의점</p>
                                            <p class="b-time">AM 07:00 - AM 01:00</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <h1 style="font-size:20px; color:#f54c4c; margin: 30px 0;">포인트카드</h1>
                <div style="padding: 30px 0;">
                    <article class="card-information">
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-chat"></i> 스퀘어원 포인트카드 안내</h4>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-users"></i> 포인트카드 회원혜택 <small> (기준일 : 2015년 3월 2일) </small></h4>

                                <ul class="benefit-list">
                                    <li class="cgv">
                                        <p class="item-icon">
                                            <img src="/assets/images/introduce/card_benefit_logo01.jpg" class="img-responsive" alt="CGV">
                                        </p>
                                        <dl>
                                            <dt>인청연수점 전품목<br class="visible-xs">콤보세트</dt>
                                            <dd>3,000원 할인</dd>
                                        </dl>
                                    </li>
                                    <li class="chinaf">
                                        <p class="item-icon">
                                            <img src="/assets/images/introduce/card_benefit_logo02.jpg" class="img-responsive" alt="차이나팩토리">
                                        </p>
                                        <dl>
                                            <dt>차이나팩토리</dt>
                                            <dd>10% 상시 할인</dd>
                                        </dl>
                                    </li>
                                    <li class="bibigo">
                                        <p class="item-icon">
                                            <img src="/assets/images/introduce/card_benefit_logo03.jpg" class="img-responsive" alt="비비고">
                                        </p>
                                        <dl>
                                            <dt>비비고</dt>
                                            <dd>10% 상시 할인</dd>
                                        </dl>
                                    </li>
                                    <li class="hakoya">
                                        <p class="item-icon">
                                            <img src="/assets/images/introduce/card_benefit_logo04.jpg" class="img-responsive" alt="하코야">
                                        </p>
                                        <dl>
                                            <dt>하코야</dt>
                                            <dd>10% 상시 할인</dd>
                                        </dl>
                                    </li>
                                    <li class="smoothie">
                                        <p class="item-icon">
                                            <img src="/assets/images/introduce/card_benefit_logo05.jpg" class="img-responsive" alt="스무디킹">
                                        </p>
                                        <dl>
                                            <dt>스무디킹</dt>
                                            <dd>5% 상시 할인</dd>
                                        </dl>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-star"></i> 적립 포인트 혜택 <small> (기준일 : 2015년 2월 1일) </small></h4>

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
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-credit-card"></i> 카드 발급 및 적립 안내</h4>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4>
                                    <i class="icon-cancel-circled2"></i> 스퀘어원 포인트 적립 제외 매장<br class="visible-xs">
                                    <small class="s-margin"> (기준일 : 2015년 5월 3일)</small>
                                </h4>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-credit-card"></i> 카드 재발급 및 카드 분실</h4>
                            </div>
                        </div>
                        <div class="article-list">
                            <div class="c-details">
                                <h4><i class="icon-credit-card"></i> 포인트카드 마일리지 유효기간 및 소멸안내 </h4>
                            </div>
                        </div>
                    </article>
                </div>
                
                <div style="margin: 30px 0;">
                    <div class="table-wrap">
                        <table class="table table-bordered notice-table">
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>작성일</th>
                                    <th>조회수</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>100</td>
                                    <td class="t-content"><a href="#">4F 전문식당가 리뉴얼/매장이동 안내입니다.</a></td>
                                    <td class="date">2016-10-06</td>
                                    <td>123</td>
                                </tr>
                                <tr>
                                    <td>99</td>
                                    <td class="t-content"><a href="#">바르미 샤브샤브 칼국수 입점 오픈 안내</a></td>
                                    <td class="date">2016-10-06</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>98</td>
                                    <td class="t-content"><a href="#">포베이 입점 오픈 안내</a></td>
                                    <td class="date">2016-10-06</td>
                                    <td>77</td>
                                </tr>
                                <tr>
                                    <td>97</td>
                                    <td class="t-content"><a href="#">4F 푸드코너 리뉴얼 공사 안내</a></td>
                                    <td class="date">2016-10-06</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>96</td>
                                    <td class="t-content"><a href="#">더제이케이키친박스 입점 오픈 안내</a></td>
                                    <td class="date">2016-10-06</td>
                                    <td>96</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="margin: 30px 0;">
                    <div class="input-form type-1">
                        <dl>
                            <dt><label for="u-name">단체(개인)명</label></dt>
                            <dd><input type="text" id="u-name" class="form-control"></dd>
                            <dt><label for="performance">공연분야</label></dt>
                            <dd>
                                <select class="form-control" id="performance">
                                    <option value="">선택하세요</option>
                                </select>
                            </dd>
                            <dt><label for="mfic">담당자명</label></dt>
                            <dd><input type="text" id="mfic" class="form-control"></dd>
                        </dl>
                    </div>
                </div>
            </div><!-- // container -->
            <!-- // 가이드 작성 영역 -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
    
    
    
    <!-- calendar 없는 페이지 제거 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><!-- calendar -->
    <script><!-- calendar -->
        (function($) {
            $("#datepicker, #datepicker-2").datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '이전 달',
                nextText: '다음 달',
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                dayNames: ['일','월','화','수','목','금','토'],
                dayNamesShort: ['일','월','화','수','목','금','토'],
                dayNamesMin: ['일','월','화','수','목','금','토'],
                showMonthAfterYear: true,
                changeMonth: true,
                changeYear: true,
                yearSuffix: '년'
            });
        })(jQuery);
    </script>
</body>
</html>