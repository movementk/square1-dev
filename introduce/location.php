<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g01 = "selected";
$s03 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/introduce.css">
</head>
<body class="sub introduce">
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
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 오시는길</h1>
                <h2>Malling Island SQUARE1 MAP</h2>
                <p>
                    몰링 아일랜드, 스퀘어원으로 오시는 길입니다.
                </p>
            </div>
            <section class="location">
                <div class="section-content">
                    <div class="map-info">
						<div class="container">
							<p class="maps embed-responsive embed-responsive-16by9" id="maps">
								<img src="/assets/images/company/map.gif" class="img-responsive" alt="오시는길 지도">
							</p>
							<dl class="addr">
								<dt>주소</dt>
								<dd>인천광역시 연수구 동춘동 926</dd>
								<dd class="block-dd visible-xs"></dd>
								<dt class="call">대표전화</dt>
								<dd>032-456-4000</dd>
							</dl>
						</div>
                    </div>
                    <div class="container">
                        <div class="traffic">
                            <div class="subway">
                                <dl>
                                    <dt>지하철</dt>
                                    <dd><h5><i class="hidden-xs">인천1</i>동춘</h5><b>인천 1호선</b> 동춘역 1번 출구에서 50M 거리</dd>
                                </dl>
                            </div>
                            <div class="bus">
                                <dl>
                                    <dt>버스</dt>
                                    <dd>
                                        <h5>동춘역(38-346) 정류장</h5>
                                        <ul class="row">
                                            <li class="col-xs-6 col-md-4">
                                                <p class="mb"><span class="blue">간선</span>103-1</p>
                                            </li>
                                            <li class="col-xs-6 col-md-4">
                                                <p class="mb"><span class="green">지선</span>522, 522A</p>
                                            </li>
                                            <li class="col-xs-12 col-md-4">
                                                <p class="mb"><span class="red">광역</span>M6724</p>
                                            </li>
                                            <li class="col-xs-6 col-md-4">
                                                <p><span class="purple">급행</span>908, 909</p>
                                            </li>
                                            <li class="col-xs-6 col-md-4">
                                                <p><span class="blue">좌석</span>303, 304, 320</p>
                                            </li>
                                        </ul>
                                        <h5>동춘역(38-070) 정류장</h5>
                                        <ul class="row">
                                            <li class="col-xs-6 col-md-4">
                                                <p class="mb"><span class="blue">간선</span>6, 68, 103-1</p>
                                            </li>
                                            <li class="col-xs-6 col-md-4">
                                                <p class="mb"><span class="green">지선</span>522, 522A</p>
                                            </li>
                                            <li class="col-xs-12 col-md-4">
                                                <p class="mb"><span class="red">광역</span>1300, M6724</p>
                                            </li>
                                            <li class="col-xs-6 col-md-4">
                                                <p><span class="purple">급행</span>908, 909</p>
                                            </li>
                                            <li class="col-xs-6 col-md-4">
                                                <p><span class="blue">좌석</span>303, 304, 320</p>
                                            </li>
                                        </ul>
                                        <h5>동춘역/이마트 정류장</h5>
                                        <ul class="row">
                                            <li class="col-xs-12 col-md-4">
                                                <p><span class="blue">간선</span>6-1</p>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div><!-- //container  -->
                </div>
            </section>
        </main>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByhGey8Yst_xb0o5xb8lY7jXuuRAx1ch4&signed_in=true&callback=initMap"></script>
	<script>
	var geocoder;
	var map;
	function google_init() {
		geocoder = new google.maps.Geocoder();
		var myLatlng = new google.maps.LatLng('>', '');
		var myOptions = {
			zoom: <?=$is_mobile?"15":"17"?>,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		var map = new google.maps.Map(document.getElementById("maps"), myOptions);

		var image = "";

		var marker = new google.maps.Marker({
			position: myLatlng, 
			map: map,
			icon: image
		});

		
		var address = "인천광역시 연수구 동춘동 926";
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map, 
					position: results[0].geometry.location,
					icon: image
				});
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}

	window.onload = function(){
		google_init();
	}
	</script>
</body>
</html>