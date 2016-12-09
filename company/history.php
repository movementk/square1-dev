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
        <main id="content" class="history-info">
            <div class="history-bg">
                <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb6.php'); ?>
                <div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
                    <h1>서부 T&amp;D</h1>
                    <div class="snb">
                        <div class="container">
                            <button class="btn btn-block" type="button">
                                연혁
                            </button>
                            <nav>
                                <ul>
                                    <li class="active"><a href="/company/history.php">연혁</a></li>
                                    <li><a href="/company/ideology.php">경영이념</a></li>
                                    <li><a href="/company/vision.php">비전</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <section class="history">
                            <div class="section-header">
                                <h3>서부 T&amp;D의 가치를<br class="visible-xs"> 한 눈에 보실 수 있습니다.</h3>
                            </div>
                            <div class="section-content">
                                <div class="table-wrap">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>회사명</th>
                                                <td>주식회사 서부 T&amp;D</td>
                                            </tr>
                                            <tr>
                                                <th>대표이사</th>
                                                <td>승만호</td>
                                            </tr>
                                            <tr>
                                                <th>설립일</th>
                                                <td>1979 7월</td>
                                            </tr>
                                            <tr>
                                                <th>자산</th>
                                                <td>7,730  억 원 (2012년 상반기)</td>
                                            </tr>
                                            <tr>
                                                <th>KOSDAQ 상장기업</th>
                                                <td>KOSDAQ  시가총액 상위기업</td>
                                            </tr>
                                            <tr>
                                                <th>사업분야</th>
                                                <td>부동산개발, 창고등 임대사업, <br class="visible-xs">주차사업, 유류판매사업</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </section>
                </div><!-- container -->
            </div>
            <div class="history-list">
                <div class="list-img">
                    <p>
                        <img src="/assets/images/company/history_img.gif" class="img-responsive" alt="">
                    </p>
                </div>
                <div class="list">
                    <ol>
                        <li>
                            <h4>1979</h4>
                            <dl>
                                <dt>01</dt>
                                <dd>(주) 서부트럭터미날 설립</dd>
                            </dl>
                        </li>
                        <li>
                            <h4>1995</h4>
                            <dl>
                                <dt>02</dt>
                                <dd>코스닥 등록</dd>
                            </dl>
                        </li>
                        <li>
                            <h4>2008</h4>
                            <dl>
                                <dt>03</dt>
                                <dd>용산 관광버스터미날 합병</dd>
                            </dl>
                        </li>
                        <li>
                            <h4>2010</h4>
                            <dl>
                                <dt>04</dt>
                                <dd>(주) 서부T&amp;D로 사명 변경</dd>
                            </dl>
                        </li>
                        <li>
                            <h4>2012</h4>
                            <dl>
                                <dt>05</dt>
                                <dd>복합쇼핑몰 'SQUARE1' 오픈</dd>
                            </dl>
                        </li>
                    </ol>
                </div>
            </div>
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>