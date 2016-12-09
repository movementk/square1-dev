<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g03 = "selected";
$s02 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/community.css">
</head>
<body class="sub community">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
    <div id="wrapper">
        <div id="top-bn">
        </div>
        <header id="header">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
            <div class="jumbo">
                <h1><small>커뮤니티</small>COMMUNITY</h1>
                <p>
                    스퀘어원 고객님의 편의를 위한<br>
                    정보와 서비스 내용을 안내드립니다.
                </p>
            </div>
        </header>
        <main id="content">
			<?php
			$s02 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb3.php');
			?>
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 보도자료</h1>
                <h2>스퀘어원의 새로운 소식을<br class="visible-xs"> 알려드립니다.</h2>
                <p>고객님의 편의를 위한 스퀘어원의<br class="visible-xs"> 정보를 전해드립니다.</p>
            </div>
            <div class="container">
				<?
				$workType = "press";
				include $dir."/module/board.php";
				?>
                <!--section class="notice press-list">
                    <div class="section-content">
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
                </section-->
            </div><!-- container -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>