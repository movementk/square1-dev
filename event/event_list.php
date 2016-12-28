<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/event.css">
</head>
<body class="sub event">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
    <div id="wrapper">
        <div id="top-bn">
        </div>
        <header id="header">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
            <div class="jumbo">
                <h1><small>이벤트&amp;뉴스</small>EVENT &amp; NEWS</h1>
                <p>
                    복합문화 쇼핑공간 스퀘어원만의 이벤트 소식과<br>
                    보도자료를 전해드립니다.
                </p>
            </div>
        </header>
        <main id="content">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb4.php'); ?>
            <div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
                <h1><span class="square1">SQUARE<i>1</i></span> 이벤트</h1>
                <div class="snb">
                    <div class="container">
                        <button class="btn btn-block" type="button">
                            진행 중 이벤트
                        </button>
                        <nav>
                            <ul>
                                <li class="active"><a href="/event/event_list.php">진행 중 이벤트</a></li>
                                <li><a href="/event/prizewinner_list.php">당첨자 발표</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container">
                <section class="event-list brand-event">
                    <div class="section-header">
                        <h2>스퀘어원의 이벤트 소식을<br class="visible-xs"> 한번에 보실 수 있습니다.</h2>
                        <p>
                            복합 문화 소비공간 스퀘어원만의<br class="visible-xs"> 다양한 이벤트를 경험해 보세요~
                        </p>
                    </div>
                    <div class="section-content">
                        <div class="event-list">
                            <ul class="row">
                                <li class="col-xs-12 col-sm-6 col-md-4">
                                    <a href="/event/event_identify01.php">
                                        <div class="item-img">
                                            <img src="/assets/images/event/event_img01.gif" class="img-responsive" alt="김소현 팬 사인회">
                                        </div>
                                        <div class="details">
                                            <h4>김소현 팬 사인회 <i class="ico-star"></i></h4>
                                            <p class="date">2016.10.12 - 2016.10.15</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4">
                                    <a href="/event/event_identify01.php">
                                        <div class="item-img">
                                            <img src="/assets/images/event/event_img02.gif" class="img-responsive" alt="아웃도어 특집전">
                                        </div>
                                        <div class="details">
                                            <h4>스포츠아웃도어 특집전 <i class="ico-clothes"></i></h4>
                                            <p class="date">2016.10.12 - 2016.10.15</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4">
                                    <a href="/event/event_identify01.php">
                                        <div class="item-img">
                                            <img src="/assets/images/event/event_img03.gif" class="img-responsive" alt="스퀘어원 개점 4주년감사제">
                                        </div>
                                        <div class="details">
                                            <h4>스퀘어원 개점 4주년 행사 <i class="ico-event"></i></h4>
                                            <p class="date">2016.10.12 - 2016.10.15</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4">
                                    <a href="/event/event_identify01.php">
                                        <div class="item-img">
                                            <img src="/assets/images/event/event_img04.gif" class="img-responsive" alt="4주년 응모 이벤트">
                                        </div>
                                        <div class="details">
                                            <h4>4주년 응모 이벤트-골드바40돈 <i class="ico-event"></i></h4>
                                            <p class="date">2016.10.12 - 2016.10.15</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4">
                                    <a href="/event/event_identify01.php">
                                        <div class="item-img">
                                            <img src="/assets/images/event/event_img05.gif" class="img-responsive" alt="수입주방용품대전">
                                        </div>
                                        <div class="details">
                                            <h4>수입주방용품대전 <i class="ico-event"></i></h4>
                                            <p class="date">2016.10.12 - 2016.10.15</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4">
                                    <a href="/event/event_identify01.php">
                                        <div class="item-img">
                                            <img src="/assets/images/event/event_img06.gif" class="img-responsive" alt="남성패션 특별전">
                                        </div>
                                        <div class="details">
                                            <h4>남성패션 특별전 <i class="ico-clothes"></i></h4>
                                            <p class="date">2016.10.12 - 2016.10.15</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                    </div>
                </section>
            </div><!-- container -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>