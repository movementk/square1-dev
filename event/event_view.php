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
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 브랜드 이벤트</h1>
                <h2>즐거운 소식이 가득한<br class="visible-xs"> 스퀘어원 이벤트입니다.</h2>
                <p>복합 문화 소비공간 스퀘어원만의<br class="visible-xs"> 다양한 이벤트를 경험해 보세요~</p>
            </div>
            <div class="container">
                <section class="event-view">
                    <div class="section-content">
                        <article class="content-view">
                            <div class="article-header">
                                포인트카드에 대하여 문의드릴게 있습니다.
                            </div>
                            <div class="article-content">
                                <div class="content">
                                    안녕하세요.<br>
                                    누적 포인트가 6,000포인트 정도 있어서 영화<br>
                                    관람권으로 교환하고 싶은데 어디에서 해야 하나요??<br>
                                    답변 부탁드립니다.
                                </div>
                                <div class="user-info">
                                    <ul>
                                        <li>
                                            <dl>
                                                <dt>등록일</dt>
                                                <dd>2016-10-16</dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <dl>
                                                <dt>작성자</dt>
                                                <dd>sqsq</dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <dl>
                                                <dt>조회수</dt>
                                                <dd>12</dd>
                                            </dl>
                                        </li>
                                    </ul>
                                    <div class="hidden-xs">
                                        <p class="print">
                                            <a href="#"><i class="icon-print"></i>인쇄하기</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="attach">
                                    <dl class="file">
                                        <dt><i class="icon-attach"></i>첨부파일</dt>
                                        <dd>-</dd>
                                    </dl>
                                </div>
                                <div class="btn-area">
                                    <p>
                                        <a href="#" class="btn-sm btn-orange" role="button">글쓰기</a>
                                        <a href="#" class="btn-sm btn-default" role="button">수정하기</a>
                                        <a href="#" class="btn-sm btn-default" role="button">삭제하기</a>
                                    </p>
                                    <p class="basic-btn">
                                        <a href="#" class="btn btn-gray" role="button">목록보기</a>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
            </div><!-- container -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>