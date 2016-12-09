<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g05 = "selected";
$s02 = "active";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/center.css">
</head>
<body class="sub center">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>고객센터</small>CUSTOMER</h1>
				<p>
					스퀘어원 고객님의 편의를 위한<br>
					정보와 서비스 내용을 안내드립니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php
			$s02 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb5.php');
			?>
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 대관신청안내</h1>
                <h2>스퀘어원은 고객의<br class="visible-xs">문화향유를 지원합니다.</h2>
                <p>
                    스퀘어원 4층 문화홀은 어린이 북카페, 공연공간,<br class="visible-xs">
                    오픈갤러리로 구성되어 있습니다.<br>
                    고객여러분의 문화향유를 위한 문화 공간을 지원합니다.
                </p>
                <hr>
                <small>
                    아래의 대관신청 접수를 해주시면, <br class="visible-xs">
                    대관 이용이 가능한 단체에 연락을 드립니다. <br>
                    단 기업홍보를 위한 행사 또는 상업목적을 둔 내용은 <br class="visible-xs">
                    무료대관지원을 하지 않습니다.
                </small>
            </div>
			<div class="container">
				<section class="culture-hall">
					<div class="section-content">
						<article class="privacy">
							<h4>개인정보취급방침</h4>
							<div class="article-content">
								<?=get_agree(2)?>
							</div>
							<div class="check-box">
								<label><input type="checkbox" id="agree11" class="agrees" >동의합니다.</label>
								<label><input type="checkbox" id="agree12" class="agrees" >동의하지 않습니다.</label>
							</div>
						</article>
						<div class="input-form type-1">
							<form name="write_form" action="<?=$loc?>/board/module/incboard/board_ok.php" method="post" ENCTYPE="MULTIPART/FORM-DATA" onsubmit="return write_chk();">
							<input type="hidden" name="mode" value="<?=$site_prefix?>board_request">
							<input type="hidden" name="BoardType" value="<?=$BoardType?>">
							<input type="hidden" name="BoardIdx" value="<?=$write["BoardIdx"]?>">
							<input type="hidden" name="Ref" value="<?=$_REQUEST["Ref"]?>">
							<input type="hidden" name="ReStep" value="<?=$_REQUEST["ReStep"]?>">
							<input type="hidden" name="ReLevel" value="<?=$_REQUEST["ReLevel"]?>">
							<input type="hidden" name="UserID" value="<?=$write[UserID]?>">
							<input type="hidden" name="URI" value="<?=$_SERVER["PHP_SELF"]?>">
							<input type="hidden" name="FileCnt" value="<?=$BoardDateRow[FileCnt]?>">
							<input type="hidden" name="HtmlChk" value="N">
							<input type="hidden" name="wr_key_enabled"  id="wr_key_enabled"   value="" />
								<dl>
									<dt><label for="u-name">단체(개인)명</label></dt>
									<dd><input type="text" id="u-name" class="form-control exp" name="bd1"></dd>
									<dt><label for="performance">공연분야</label></dt>
									<dd>
										<select class="form-control" id="performance" name="Category">
											<option value="">선택하세요</option>
											<option value="연극">연극</option>
											<option value="연주회">연주회</option>
										</select>
									</dd>
									<dt><label for="mfic">담당자명</label></dt>
									<dd class="mfic"><input type="text" id="mfic" class="form-control exp" name="UserName"></dd>
									<dt><label for="tel">연락처</label></dt>
									<dd><input type="text" id="tel" class="form-control exp" name="bd2"></dd>
									<dt><label for="phone">휴대폰번호</label></dt>
									<dd><input type="text" id="phone" class="form-control" name="bd3"></dd>
									<dt><label for="u-email">E-MAIL</label></dt>
									<dd><input type="email" id="u-email" class="form-control exp" name="UserEmail"></dd>
									<dt>대관일정</dt>
									<dd>
										<div class="calendar-form">
											<div class="calendar">
												<p class="selecter">
													<input type="text" id="datepicker" class="form-control in-mr" name="bd4" readonly >
													<label for="datepicker">
														<i class="icon-calendar">
															<span class="sr-only">시작날짜조회</span>
														</i>
													</label>
												</p>
												-
												<p class="selecter">
													<input type="text" id="datepicker-2" class="form-control in-mr" name="bd5" readonly>
													<label for="datepicker-2">
														<i class="icon-calendar">
															<span class="sr-only">종료날짜조회</span>
														</i>
													</label>
												</p>
											</div>
										</div>
									</dd>
									<dt>인원</dt>
									<dd class="people">
										<label for="num-1">공연자인원</label><input type="text" id="num-1" class="form-control" name="bd6">
										<label for="num-2">진행인원</label><input type="text" id="num-2" class="form-control" name="bd7">
									</dd>
									<dt>참고사진</dt>
									<dd class="file">
										<input type="file" id="file" class="form-control" name='bf_file[]'>
										<label for="file">
											<i class="icon-upload">
												<span class="sr-only">파일올리기</span>
											</i>
										</label>
									</dd>
									<dt>공연경력사항 <br class="hidden-xs"><i>(<font id="ncnt">0</font>자/2000자)</i></dt>
									<dd>
										<textarea class="form-control" name="Content" id="Content"></textarea>
									</dd>
									<? if($is_guest){ ?>
									<dt>자동입력방지</dt>
									<dd><?php echo $captcha_html ?></dd>
									<? } ?>
								</dl>
								<div class="btn-area">
									<p>
										<a href="javascript:;" class="btn btn-orange" role="button" onclick="write_chk();">전송</a>
										<a href="javascript:;" class="btn btn-default" role="button" onclick="location.reload();">취소</a>
									</p>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<!-- calendar 없는 페이지 제거 -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><!-- calendar -->
	<script src="/board/config/recaptcha/recaptcha.js"></script>
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

			$(document).on("keyup", "#Content", function(){
				var tcnt = $(this).val().length;
				$("#ncnt").html(tcnt);
			});

			$(document).on("click", ".agrees", function(){
				var id = $(this).attr("id");
				$(".agrees").each(function(){
					$(this).prop("checked",false);
				});

				$("#"+id).prop("checked",true);
			});
		})(jQuery);
		
		function write_chk(){
			var expCk = true;
			<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

			if($("#agree11").prop("checked") == false){
				alert("개인정보취급방침에 동의하셔야합니다.");
				expCk = false;
			}
			
			$(".exp").each(function(){
				if(expCk){
					if($(this).val() == ""){
						alert($(this).attr("title")+"은(는) 필수입력사항 입니다.");
						expCk = false;
					}
				}
			});

			if(expCk == true){
				document.write_form.submit();
			}
		}
	</script>
</body>
</html>