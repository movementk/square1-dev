<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
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
				<section class="terms">
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
								<li class="active">
									<p class="pcd-img">
										<img src="/assets/images/member/procedure_img01.gif" alt="약관동의">
									</p>
									<h3>01.<br class="visible-xs"> 약관동의</h3>
								</li>
								<li>
									<p class="pcd-img">
										<img src="/assets/images/member/procedure_non_img02.gif" alt="실명확인">
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
						<form name="joinForm" method="post" action="sms.php">
							<article class="service">
								<h4>이용약관</h4>
								<div class="article-content">
									<?=get_agree(1)?>
								</div>
								<div class="check-box">
									<label><input type="checkbox" id="agree11" name="agree1" value="Y" class="agrees exp" title="이용약관">동의합니다.</label>
									<label><input type="checkbox" id="agree12" name="agree1" value="N" class="agrees">동의하지 않습니다.</label>
								</div>
							</article>
							<article class="privacy">
								<h4>개인정보취급방침</h4>
								<div class="article-content">
									<?=get_agree(2)?>
								</div>
								<div class="check-box">
									<label><input type="checkbox" id="agree21" name="agree2" value="Y" class="agrees exp" title="개인정보취급방침">동의합니다.</label>
									<label><input type="checkbox" id="agree22" name="agree2" value="N" class="agrees">동의하지 않습니다.</label>
								</div>
							</article>
							<article class="email-terms">
								<h4>이메일무단수집거부</h4>
								<div class="article-content">
									<?=get_agree(3)?>
								</div>
								<div class="check-box">
									<label><input type="checkbox" id="agree31" name="agree3" value="Y" class="agrees exp" title="이메일무단수집거부">동의합니다.</label>
									<label><input type="checkbox" id="agree32" name="agree3" value="N" class="agrees">동의하지 않습니다.</label>
								</div>
							</article>
							<div class="btn-area">
								<p>
									<a href="javascript:;" class="btn btn-orange" role="button" onclick="check_valid();">확인</a>
									<a href="/" class="btn btn-default" role="button">취소</a>
								</p>
							</div>
						</form>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script>
	$(document).on("click", ".agrees", function(){
		var ckId = $(this).attr("id");
		$("input[name='"+$(this).attr("name")+"']").each(function(){
			$(this).prop("checked",false);
		});

		$("#"+ckId).prop("checked",true);
	});

	function check_valid(){
		var expCk = true;
		$(".exp").each(function(){
			if(expCk){
				if($(this).prop("checked") == false){
					alert($(this).attr("title")+" 항목에 동의하시기 바랍니다.");
					expCk = false;
				}
			}
		});

		if(expCk){
			document.joinForm.submit();
		}
	}
	</script>
</body>
</html>