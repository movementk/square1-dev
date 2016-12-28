<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g02 = "selected";
$s03 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/store.css">
</head>
<body class="sub store place">
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
                <h1><span class="square1">SQUARE<i>1</i></span> 편의시설안내</h1>
            </div>
            <!-- 컨텐츠 영역 -->
            <div class="page-summary">
                <div class="container">
                    <h3>고객님의 편리한 시설 이용을 위하여 <br>다양한 서비스를 제공합니다.</h3>
                    <p>
                        스퀘어원의 편의시설을 소개합니다.
                    </p>
                </div>
            </div>
            <div class="container">
                <div class="amenity-list">
                    <ul class="row">
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info1">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info1-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dt>운영시간</dt>
                                    <dd>10:30 ~ 22:00</dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info2">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info2-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dt>운영시간</dt>
                                    <dd>10:30 ~ 22:00</dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info3">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info3-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd>
                                        <a href="#" data-toggle="modal" data-target="#a-info3-f2"><span>2층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd class="clear">
                                        <a href="#" data-toggle="modal" data-target="#a-info3-f3"><span>3층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd>
                                        <a href="#" data-toggle="modal" data-target="#a-info3-f4"><span>4층</span> <i class="icon-location"></i></a>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info4">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info4-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd>
                                        <a href="#" data-toggle="modal" data-target="#a-info4-f2"><span>2층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd class="clear">
                                        <a href="#" data-toggle="modal" data-target="#a-info4-f3"><span>3층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd>
                                        <a href="#" data-toggle="modal" data-target="#a-info4-f4"><span>4층</span> <i class="icon-location"></i></a>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info5">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info5-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dt>운영시간</dt>
                                    <dd>10:30 ~ 22:00</dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info6">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info6-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dt>운영시간</dt>
                                    <dd>10:30 ~ 22:00</dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info7">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info7-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dt>운영시간</dt>
                                    <dd>10:30 ~ 22:00</dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info8">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info8-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd>
                                        <a href="#" data-toggle="modal" data-target="#a-info8-f2"><span>2층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd class="clear">
                                        <a href="#" data-toggle="modal" data-target="#a-info8-f3"><span>3층</span> <i class="icon-location"></i></a>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <div class="a-info9">
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
                                        <a href="#" data-toggle="modal" data-target="#a-info9-f1"><span>1층</span> <i class="icon-location"></i></a>
                                    </dd>
                                    <dd>
                                        <a href="#" data-toggle="modal" data-target="#a-info9-f4"><span>4층</span> <i class="icon-location"></i></a>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // 컨텐츠 영역 -->
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
        <!-- a-info1 -->
        <div id="a-info1-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info1_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info2 -->
        <div id="a-info2-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info2_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info3 -->
        <div id="a-info3-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info3_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info3-f2" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info3_f2.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info3-f3" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info3_f3.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info3-f4" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info3_f4.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info4 -->
        <div id="a-info4-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info4_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info4-f2" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info4_f2.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info4-f3" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info4_f3.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info4-f4" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info4_f4.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info5 -->
        <div id="a-info5-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info5_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info6 -->
        <div id="a-info6-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info6_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info7 -->
        <div id="a-info7-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info7_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info8 -->
        <div id="a-info8-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info8_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info8-f2" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info8_f2.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info8-f3" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info8_f3.gif" alt=""></p>
                </div>
            </div>
        </div>
        
        <!-- a-info9 -->
        <div id="a-info9-f1" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info9_f1.gif" alt=""></p>
                </div>
            </div>
        </div>
        <div id="a-info9-f4" class="modal fade a-info-modal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/assets/images/store/btn_popup_close.gif" alt="">
                    </button>
                    <p><img class="img-responsive" src="/assets/images/store/img_a_info9_f4.gif" alt=""></p>
                </div>
            </div>
        </div>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
    <script>
        (function($) {
            $('.a-info-modal').on('shown.bs.modal', function (e) {
                //$('html').css('overflow', 'hidden');
                $('body').css('padding-right', 0);
            });
//            $('.a-info-modal').on('hidden.bs.modal', function (e) {
//                $('html').removeAttr('style');
//            }); 
        })(jQuery);
    </script>
</body>
</html>