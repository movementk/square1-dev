<nav id="gnb-aside" class="hidden-lg" aria-hidden="true" tabindex="-1">
    <div class="back"></div>
    <div class="content">
        <header>
            <h1><img src="/assets/images/logo_white.png" alt="스퀘어원"></h1>
            <button class="btn btn-close" type="button"><img src="/assets/images/btn_close.png" alt="닫기"></button>
        </header>
        <div>
            <div class="member">
                <ul>
                    <li><a href="/">HOME</a></li>
					<? if($is_member){ ?>
					<li><a href="/member/logout.php">LOGOUT</a></li>
					<li><a href="/member/edit_form.php">MYPAGE</a></li>
					<? } ?>
					<? if($is_guest){ ?>
					<li><a href="/member/login.php">LOGIN</a></li>
					<li><a href="/member/terms.php">JOIN</a></li>
					<? } ?>
                </ul>
            </div>
            <div class="quick">
                <ul>
                    <li class="time">
                        <div>
                            <a href="/store/hours.php">
                                <small>BUSINESS HOUR</small>
                                <b>영업시간 안내</b>
                            </a>
                        </div>
                    </li>
                    <li class="floor">
                        <div>
                            <a href="/store/floor.php">
                                <small>FLOOR GUIDE</small>
                                <b>층별 안내</b>
                            </a>
                        </div>
                    </li>
                    <li class="contact">
                        <div>
                            <a href="/introduce/location.php">
                                <small>LOCATION</small>
                                <b>찾아오시는 길</b>
                            </a>
                        </div>
                    </li>
                    <li class="membership">
                        <div>
                            <a href="/store/point.php">
                                <small>MEMBERSHIP</small>
                                <b>멤버십 서비스</b>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="menu">
                <ul>
                    <li class="active">
                        <a href="#">스퀘어원 소개</a>
                        <ul>
                            <li><a href="/introduce/company.php">SQUARE1 소개</a></li>
                            <li><a href="/introduce/special.php">SQUARE1의 특별함</a></li>
                            <li><a href="/introduce/location.php">오시는길</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">매장/이용안내</a>
                        <ul>
                            <li><a href="/store/category.php">카테고리별 안내</a></li>
                            <li><a href="/store/floor.php">층별안내</a></li>
                            <li><a href="/store/place.php">편의시설안내</a></li>
                            <li><a href="/store/hours.php">영업시간안내</a></li>
                            <li><a href="/store/point.php">포인트카드</a></li>
                            <li><a href="/store/parking.php">주차시설안내</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">커뮤니티</a>
                        <ul>
                            <li><a href="/community/notice_list.php">공지사항</a></li>
                            <li><a href="/community/press_list.php">보도자료</a></li>
                            <li><a href="/community/pr_list.php">온라인전단</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">이벤트</a>
                        <ul>
                            <li><a href="/event/brand_event.php">브랜드이벤트</a></li>
                            <li><a href="/event/square1_event_list.php">SQUARE1이벤트</a></li>
                            <li><a href="/event/art_hall.php">문화홀 공연/전시</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">고객센터</a>
                        <ul>
                            <li><a href="/center/lost.php">분실물 센터안내</a></li>
                            <li><a href="/center/culture_hall.php">대관신청안내</a></li>
                            <li><a href="/center/faq_list.php">FAQ</a></li>
                            <li><a href="/center/qna_list.php">1:1문의</a></li>
                            <!--li><a href="/center/guest_write.php">고객의 소리</a></li-->
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
