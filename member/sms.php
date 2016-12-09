<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php');
/**************************************************************************************************************
NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED

서비스명 :  체크플러스 - 안심본인인증 서비스
페이지명 :  체크플러스 - 메인 호출 페이지
보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다. 

[ PHP 확장모듈 설치 안내 ]
	1.	Php.ini 파일의 설정 내용 중 확장모듈 경로(extension_dir)로 지정된 위치에 첨부된 CPClient.so 파일을 복사합니다.
	2.	Php.ini 파일에 다음과 같은 설정을 추가 합니다.
			extension=CPClient.so
	3.	아파치 재 시작 합니다.
**************************************************************************************************************/

/*****************************
  //아파치에서 모듈 로드가 되지 않았을경우 동적으로 모듈을 로드합니다.

	if(!extension_loaded('CPClient')) {
		dl('CPClient.' . PHP_SHLIB_SUFFIX);
	}
	$module = 'CPClient';
	*****************************/

session_start();

$sitecode = "G3779";				// NICE로부터 부여받은 사이트 코드
$sitepasswd = "0S6ZT2AYXPFY";			// NICE로부터 부여받은 사이트 패스워드


$authtype = "M";      	// 없으면 기본 선택화면, X: 공인인증서, M: 핸드폰, C: 카드
	
$popgubun 	= "N";		//Y : 취소버튼 있음 / N : 취소버튼 없음
$customize 	= "";			//없으면 기본 웹페이지 / Mobile : 모바일페이지
	
	 
$reqseq = "REQ_0123456789";     // 요청 번호, 이는 성공/실패후에 같은 값으로 되돌려주게 되므로

// 업체에서 적절하게 변경하여 쓰거나, 아래와 같이 생성한다.
	//if (extension_loaded($module)) {// 동적으로 모듈 로드 했을경우
		$reqseq = get_cprequest_no($sitecode);
	//} else {
	//	$reqseq = "Module get_request_no is not compiled into PHP";
	//}


// CheckPlus(본인인증) 처리 후, 결과 데이타를 리턴 받기위해 다음예제와 같이 http부터 입력합니다.
$returnurl = "http://".$_SERVER["HTTP_HOST"]."/member/sms_success.php";	// 성공시 이동될 URL
$errorurl = "http://".$_SERVER["HTTP_HOST"]."/member/sms_fail.php";		// 실패시 이동될 URL

// reqseq값은 성공페이지로 갈 경우 검증을 위하여 세션에 담아둔다.

$_SESSION["REQ_SEQ"] = $reqseq;

// 입력될 plain 데이타를 만든다.
$plaindata =  "7:REQ_SEQ" . strlen($reqseq) . ":" . $reqseq .
						  "8:SITECODE" . strlen($sitecode) . ":" . $sitecode .
						  "9:AUTH_TYPE" . strlen($authtype) . ":". $authtype .
						  "7:RTN_URL" . strlen($returnurl) . ":" . $returnurl .
						  "7:ERR_URL" . strlen($errorurl) . ":" . $errorurl .
						  "11:POPUP_GUBUN" . strlen($popgubun) . ":" . $popgubun .
						  "9:CUSTOMIZE" . strlen($customize) . ":" . $customize ;


	//if (extension_loaded($module)) {// 동적으로 모듈 로드 했을경우
		$enc_data = get_encode_data($sitecode, $sitepasswd, $plaindata);
	//} else {
	//	$enc_data = "Module get_request_data is not compiled into PHP";
	//}

if( $enc_data == -1 )
{
	$returnMsg = "암/복호화 시스템 오류입니다.";
	$enc_data = "";
}
else if( $enc_data== -2 )
{
	$returnMsg = "암호화 처리 오류입니다.";
	$enc_data = "";
}
else if( $enc_data== -3 )
{
	$returnMsg = "암호화 데이터 오류 입니다.";
	$enc_data = "";
}
else if( $enc_data== -9 )
{
	$returnMsg = "입력값 오류 입니다.";
	$enc_data = "";
}
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/member.css">
</head>
<body class="sub member">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>회원전용</small>MEMBERSHIP</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의<br class="visible-xs">
					라이프 스타일 공간입니다.<br class="hidden-xs"> FASHION · F&amp;B · CGV <br class="visible-xs">
					<span class="hidden-xs"> · </span>HOME PLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<main id="content">
			<div class="container">
				<section class="sms">
					<div class="section-header">
						<h2>회원가입</h2>
						<hr>
						<p>
							스퀘어원 회원가입을 하시면<br class="visible-xs"> 
							더많은 혜택을 이용하실 수 있습니다.
						</p>
					</div>
					<div class="section-content">
						<nav class="procedure">
							<ol>
								<li>
									<p class="pcd-img">
										<img src="/assets/images/member/procedure_non_img01.gif" alt="약관동의">
									</p>
									<h3>01.<br class="visible-xs"> 약관동의</h3>
								</li>
								<li class="active">
									<p class="pcd-img">
										<img src="/assets/images/member/procedure_img02.gif" alt="실명확인">
									</p>
									<h3>02.<br class="visible-xs"> 실명확인</h3>
								</li>
								<li>
									<p class="pcd-img">
										<img src="/assets/images/member/procedure_non_img03.gif" alt="정보입력">
									</p>
									<h3>03.<br class="visible-xs"> 정보입력</h3>
								</li>
								<li>
									<p class="pcd-img">
										<img src="/assets/images/member/procedure_non_img04.gif" alt="가입완료">
									</p>
									<h3>04.<br class="visible-xs"> 가입완료</h3>
								</li>
							</ol>
						</nav>
						<article class="verify">
							<div class="article-header">
								<h4>실명확인</h4>
								<p>
									해당 사이트는 고객님의 개인정보 유출 방지 및 피해 방지를 위하여 실명인증 제도를 시행하고 있습니다.
								</p>
							</div>
							<form name="form_chk" method="post">
							<input type="hidden" name="m" value="checkplusSerivce">
							<input type="hidden" name="EncodeData" value="<?= $enc_data ?>">
							<div class="article-content">
								<p class="sms-img">
									<img src="/assets/images/member/sms_img.gif" alt="휴대전화 인증하기">
								</p>
								<div class="btn-area">
									<p>
										<a href="javascript:fnPopup();" class="btn btn-sms" role="button">휴대전화 인증하기</a>
									</p>
								</div>
								<ul class="dot-list">
									<li>
										정보통신망법(2012.08.18 시행)제 23조 2(주민번호 사용제한) 규정에 따라 온라인 상 주민번호의 수집/이용을 제한합니다.
									</li>
									<li>
										입력하신 정보는 본인확인을 위해 스퀘어원에 제공되며, 본인확인 용도 외  사용되거나 저장되지 않습니다.
									</li>
								</ul>
							</div>
							</form>
						</article>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<form name="resultForm" method="post" action="join.php">
	<input type="hidden" name="name" value=""/>
	<input type="hidden" name="di" value=""/>
	</form>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script language='javascript'>
	window.name ="Parent_window";
	
	function fnPopup(){
		window.open('', 'popupChk', 'width=500, height=550, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no');
		document.form_chk.action = "https://nice.checkplus.co.kr/CheckPlusSafeModel/checkplus.cb";
		document.form_chk.target = "popupChk";
		document.form_chk.submit();
	}
	</script>
</body>
</html>